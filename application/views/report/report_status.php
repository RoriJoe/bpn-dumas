<?php
$hari[1]="Senin";
$hari[2]="Selasa";
$hari[3]="Rabu";
$hari[4]="Kamis";
$hari[5]="Jumat";
$hari[6]="Sabtu";
$hari[7]="Minggu";

/**
     * APLICATION INFO  : PDF Report with FPDF 1.6
     * DATE CREATED     : 21 April 2012
	 * DEVELOPED BY     : Anton Sofyan, A.Md
          
     * CONTACT    
     *   - Email        : antonsofyan@yahoo.com
     *   - Blog         : http://antonsofyan.stikeskuningan.ac.id/
     *   - Facebook     : http://facebook.com/antonsofyan     
     *   - Office       : Gedung Lantai 2 UPT Laboratorium Komputer
                          Sekolah Tinggi Ilmu Kesehatan Kuningan (STIKKU)
     *   - Address      : Jalan Lingkar Kadugede No. 02 Kabupaten Kuningan - Propinsi Jawa Barat
     
     * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
	 */

/* setting zona waktu */ 

date_default_timezone_set('Asia/Jakarta');

/* konstruktor halaman pdf sbb :    
   P  = Orientasinya "Potrait"
   cm = ukuran halaman dalam satuan centimeter
   A4 = Format Halaman
   
   jika ingin mensetting sendiri format halamannya, gunakan array(width, height)  
   contoh : $this->fpdf->FPDF("P","cm", array(20, 20));  
*/

$this->fpdf->FPDF("P","cm","A4");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1,1,1);


/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();

// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();

// Setting Font : String Family, String Style, Font size 
$this->fpdf->SetFont('Times','B',12);

/* Kita akan membuat header dari halaman pdf yang kita buat 
   -------------- Header Halaman dimulai dari baris ini -----------------------------
*/
/*
`nomor_pengaduan`, `tanggal_pengaduan`, `nama_lengkap`, `nomor_identitas`,
 `alamat`, `email`, `telepon`, `handphone`, `nama_kuasa`, `alamat_kuasa`, 
 `jenis_permohonan`, `kepada`, `bagian`, `kode_bagian`, `seksi`, `kode_seksi`,
 `nomor_berkas`, `tanggal_berkas`, `status_permohonan`, `alamat_aduan`, 
 `kode_pos`, `kode_desa`, `kelurahan_aduan`, `kecamatan_aduan`, 
 `uraian_aduan`, `petugas_pelayanan_pengaduan`, `petugas_penghubung`, 
 `catatan`, `catatan_disposisi`, `catatan_status_berkas`, `respon_melalui_telepon`, 
 `tanggal_telepon`, `keterangan_dari_telepon`, `respon_melalui_surat`, `tanggal_kirim_surat`,
 `keterangan_dari_surat`, `respon_pengadu_datang`, `tanggal_datang`, `keterangan_kedatangan`,
 `keterangan_respon`, `apl_status`, `perkiraan_penyelesaian`, `created`, `last_update`
*/
foreach($pengaduan->result() as $data)
{
    $nomor_pengaduan =  $data->nomor_pengaduan;
    $tranggal_pengaduan = $data->tanggal_pengaduan;
    $nama_lengkap = $data->nama_lengkap;
    $nomor_identitas = $data->nomor_identitas;
    $nama_kuasa = $data->nama_kuasa;
    $alamat = $data->alamat;
    $handphone = $data->handphone;
    $telepon = $data->telepon;
    $nomor_berkas = $data->nomor_berkas;
    $uraian_aduan = $data->uraian_aduan;
	
    $created = $data->created;
}
$date = date_create($created);
$created= date_format($date, 'Y-m-d');
$hari_created= $hari[date_format($date, 'N')];

	$username = $this->session->userdata('username');

$this->fpdf->Image(base_url().'assets/img/bpnlogo.png', 1, 1, 1.2, 1);
$this->fpdf->Ln(0.2);
$this->fpdf->Cell(1.5,0.7,'',0,0,'L');
$this->fpdf->Cell(19,0.7,'KANTOR PERTANAHAN KOTA PEKANBARU',0,0,'L');
$this->fpdf->Ln(2);
$this->fpdf->SetFont('Times','UB',12);
$this->fpdf->Cell(19,0.7,'TANDA TERIMA PENGADUAN',0,0,'C');
$this->fpdf->Ln();
$this->fpdf->SetFont('helvetica','',10);
$this->fpdf->Cell(19,0.7,'Nomor Pengaduan :'.$nomor_pengaduan,0,0,'C');

$this->fpdf->Ln();


$this->fpdf->Cell(3,1,'Pada hari :'.$hari_created,0,0,'L');
$this->fpdf->Cell(3.5,1,'Tanggal :' .date_format($date, 'd-m-Y'),0,0,'L');
$this->fpdf->Cell(2.3,1,'Jam :' .date_format($date, 'h:i:s'),0,0,'L');
$this->fpdf->Cell(1,1,', kami telah menerima pengaduan dari:',0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(3,1,'Nama',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(6,1,$nama_lengkap,0,0,'L');
$this->fpdf->Cell(1,1,'KTP',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(1,1,$nomor_identitas,0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->Cell(3,1,'Kuasa dari',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(6,1,$nama_kuasa,0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->Cell(3,1,'Alamat',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(6,1,$alamat,0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->Cell(3,1,'No. HP',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(6,1,$handphone,0,0,'L');
$this->fpdf->Cell(1,1,'Telepon',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(1,1,$telepon,0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->Cell(3,1,'Nomor Berkas',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');
$this->fpdf->Cell(1,1,$nomor_berkas,0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(3,1,'Materi Pengaduan',0,0,'L');
$this->fpdf->Cell(1,1,':',0,0,'L');

$this->fpdf->MultiCell( 11, 0.5, $uraian_aduan, 0);


$this->fpdf->Ln(0.8);
$this->fpdf->Cell(12,3,'',0,0,'L');
$this->fpdf->Cell(15,3,'Petugas Pengaduan,',0,0,'L');

$this->fpdf->Ln(3);
$this->fpdf->Cell(12,3,'',0,0,'L');
$this->fpdf->SetFont('helvetica','UB',10);
$this->fpdf->Cell(15,3,' '.$username.' ',0,0,'L');




// fungsi Ln untuk membuat baris baru

$this->fpdf->Ln();
/* Setting ulang Font : String Family, String Style, Font size
   kenapa disetting ulang ???
   jika tidak disetting ulang, ukuran font akan mengikuti settingan sebelumnya.
   tetapi karena kita menginginkan settingan untuk penulisan alamatnya berbeda,
   maka kita harus mensetting ulang Font nya.
   jika diatas settingannya : helvetica, 'B', '12'
   khusus untuk penulisan alamat, kita setting : helvetica, '', 10
   yang artinya string stylenya normal / tidak Bold dan ukurannya 10 
*/

/* generate hasil query disini */

/* setting posisi footer 3 cm dari bawah */

$this->fpdf->SetY(-3);

/* setting font untuk footer */
$this->fpdf->SetFont('Times','',10);

/* setting cell untuk waktu pencetakan */ 
$this->fpdf->Cell(9.5, 0.5, 'Printed on : '.date('d/m/Y H:i'),0,'LR','L');

/* setting cell untuk page number */
//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');

/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output("report_status.pdf","I");
die();
?>