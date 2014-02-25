<?php
class Pengaduan_model extends CI_Model{
 /*  public function __construct (){
    parent::Model();
  } */
  public function __construct()
   {
      parent::__construct();
   }
    public function pengaduan_model() {
        parent::Model();
    } 
/*
   public function getAll(){
    $this->db->select('*');
    $this->db->from('tbl_dumas_pengaduan');
    $this->db->limit(5);
    $this->db->order_by('nomor_pengaduan','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
/*  public function get($id){
    $query = $this->db->getwhere('daily',array('id'=>$id));
    return $query->row_array();
  } */
 public function getData($nomor_pengaduan){
 

/*     $this->db->select('*');
    $this->db->from('tbl_dumas_pengaduan');
    //$this->db->limit(5);
    $this->db->where('nomor_pengaduan',$nomor_pengaduan);
    $query = $this->db->get(); */
	//$query = $this->db->query('SELECT * FROM tbl_dumas_pengaduan where nomor_pengaduan="'.$nomor_pengaduan.'"');
	//die('SELECT * FROM tbl_dumas_pengaduan where nomor_pengaduan="'.$nomor_pengaduan.'"');
  //  return $query;
	$this->db->select('*');
    $this->db->from('tbl_dumas_pengaduan');
		$this->db->where('nomor_pengaduan',$nomor_pengaduan);
    
//	$this->db->limit(5);
    $query = $this->db->get();
 
    return $query; 
  }
 
  public function save(){
   /*  $tanggal_pengaduan = $this->input->post('tanggal_pengaduan');
    $petugas_pelayanan_pengaduan = $this->input->post('petugas_pelayanan_pengaduan');
    $nomor_pengaduan=$this->input->post('nomor_pengaduan'); */
    //die();
				$nomor_pengaduan_baru=$this->pengaduan_model->gen_nomor_aduan();
				$nomor_pengaduan=$nomor_pengaduan_baru;
				$tanggal_pengaduan=$this->input->post('tanggal_pengaduan');
				$date = date_create($tanggal_pengaduan);
				$tanggal_pengaduan= date_format($date, 'Y-m-d');
				$nama_lengkap=$this->input->post('nama_lengkap'); 
				$nomor_identitas=$this->input->post('nomor_identitas'); 
				$alamat=$this->input->post('alamat'); 
				$email=$this->input->post('email');
				$telepon=$this->input->post('telepon'); 
				$handphone =$this->input->post('handphone'); 
				$nama_kuasa =$this->input->post('nama_kuasa'); 
				$jenis_permohonan =$this->input->post('jenis_permohonan'); 
				$bagian =$this->input->post('bagian'); 
				$kode_bagian =explode("-",$bagian); 
				$kode_bagian =$kode_bagian[0]; 
				$nomor_berkas =$this->input->post('nomor_berkas'); 
				$tanggal_berkas =$this->input->post('tanggal_berkas');
				$date = date_create($tanggal_berkas);
				$tanggal_berkas= date_format($date, 'Y-m-d');				
				$alamat_aduan =$this->input->post('alamat_aduan');
				$kode_desa =$this->input->post('kode_desa'); 
				$kelurahan_aduan =$this->input->post('kelurahan_aduan'); 
				$kecamatan_aduan =$this->input->post('kecamatan_aduan'); 
				$uraian_aduan =$this->input->post('uraian_aduan'); 
				$petugas_pelayanan_pengaduan =$this->input->post('petugas_pelayanan_pengaduan'); 
				$petugas_penghubung =$this->input->post('petugas_penghubung'); 
				$catatan =$this->input->post('catatan'); 
				$apl_status ="REG"; 
				$created =date('Y-m-d h:i:s'); 
				$last_update =date('Y-m-d h:i:s'); ;
	
//save data main
    $data = array(
				'nomor_pengaduan'=>$nomor_pengaduan,
				'tanggal_pengaduan'=>$tanggal_pengaduan,
				'nama_lengkap'=>$nama_lengkap, 
				'nomor_identitas'=>$nomor_identitas, 
				'alamat'=>$alamat, 
				'email'=>$email,
				'telepon'=>$telepon, 
				'handphone '=>$handphone, 
				'nama_kuasa '=>$nama_kuasa, 
				'jenis_permohonan '=>$jenis_permohonan, 
				'bagian '=>$bagian, 
				'kode_bagian '=>$kode_bagian, 
				'nomor_berkas '=>$nomor_berkas, 
				'tanggal_berkas '=>$tanggal_berkas, 
				'alamat_aduan '=>$alamat_aduan,
				'kode_desa '=>$kode_desa, 
				'kelurahan_aduan '=>$kelurahan_aduan, 
				'kecamatan_aduan '=>$kecamatan_aduan, 
				'uraian_aduan '=>$uraian_aduan, 
				'petugas_pelayanan_pengaduan '=>$petugas_pelayanan_pengaduan, 
				'petugas_penghubung '=>$petugas_penghubung, 
				'catatan '=>$catatan, 
				'apl_status'=>$apl_status, 
				'created' =>$created, 
				'last_update' =>$last_update,
    );
	//var_dump($data);
	//die();
    $this->db->insert('tbl_dumas_pengaduan',$data);
//save data ref nomor
	$nomor_pengaduan_arr=explode(".",$nomor_pengaduan_baru);
	$nomor_urut=$nomor_pengaduan_arr[0];
    $data = array(
       'nomor_urut'=>$nomor_urut,
       'bulan'=>date('m'),
      'tanggal'=>date('Y-m-d')
     );
    $this->db->update('tbl_ref_nomor',$data);
//	$this->load->view("report/tanda_terima/tanda_terima?nomor_pengaduan="+$nomor_pengaduan);
//	$this->load->view("main/entri_pengaduan");
echo "<a href='edit_data_pengaduan?nomor_pengaduan=".$nomor_pengaduan."'>Back</a>";
	
  }
 
  public function update(){
	
  $level=$this->session->userdata('level');
				$nomor_pengaduan=$this->input->post('nomor_pengaduan');
				$tanggal_pengaduan=$this->input->post('tanggal_pengaduan');
				$date = date_create($tanggal_pengaduan);
				$tanggal_pengaduan= date_format($date, 'Y-m-d');
				$nama_lengkap=$this->input->post('nama_lengkap'); 
				$nomor_identitas=$this->input->post('nomor_identitas'); 
				$alamat=$this->input->post('alamat'); 
				$email=$this->input->post('email');
				$telepon=$this->input->post('telepon'); 
				$handphone =$this->input->post('handphone'); 
				$nama_kuasa =$this->input->post('nama_kuasa'); 
				$alamat =$this->input->post('alamat'); 
				$jenis_permohonan =$this->input->post('jenis_permohonan'); 
				$bagian =$this->input->post('bagian'); 
				$kode_bagian =explode("-",$bagian); 
				$kode_bagian =$kode_bagian[0]; 
				$nomor_berkas =$this->input->post('nomor_berkas'); 
				$tanggal_berkas =$this->input->post('tanggal_berkas');
				$date = date_create($tanggal_berkas);
				
				$tanggal_berkas= date_format($date, 'Y-m-d');				
				$alamat_aduan =$this->input->post('alamat_aduan');
				$kode_desa =$this->input->post('kode_desa'); 
				$kelurahan_aduan =$this->input->post('kelurahan_aduan'); 
				$kecamatan_aduan =$this->input->post('kecamatan_aduan'); 
				$uraian_aduan =$this->input->post('uraian_aduan'); 
				$petugas_pelayanan_pengaduan =$this->input->post('petugas_pelayanan_pengaduan'); 
				$petugas_penghubung =$this->input->post('petugas_penghubung'); 
				$catatan =$this->input->post('catatan'); 
		/* 	if($level=="user" and ){$apl_status ="REG"; };
			if($level=="verifikator"){$apl_status ="VER"; };
			if($level=="plt"){$apl_status ="DIS"; }; */
				$last_update =date('Y-m-d h:i:s'); 
				$catatan_status_berkas =$this->input->post('catatan_status_berkas'); 
				$seksi =$this->input->post('seksi'); 
				$kode_seksi =explode("-",$seksi); 
				$kode_seksi =$kode_seksi[0]; 
				$catatan_disposisi =$this->input->post('catatan_disposisi');
				
				$perkiraan_penyelesaian =$this->input->post('perkiraan_penyelesaian');
				$date = date_create($perkiraan_penyelesaian);
				$perkiraan_penyelesaian= date_format($date, 'Y-m-d');	
				
				$catatan_status_berkas =$this->input->post('catatan_status_berkas'); 
//save data main
    $data = array(
				'nomor_pengaduan'=>$nomor_pengaduan,
				'tanggal_pengaduan'=>$tanggal_pengaduan,
				'nama_lengkap'=>$nama_lengkap, 
				'nomor_identitas'=>$nomor_identitas, 
				'alamat'=>$alamat, 
				'email'=>$email,
				'telepon'=>$telepon, 
				'handphone '=>$handphone, 
				'nama_kuasa '=>$nama_kuasa, 
				'alamat '=>$alamat, 
				'jenis_permohonan '=>$jenis_permohonan, 
				'bagian '=>$bagian, 
				'kode_bagian '=>$kode_bagian, 
				'nomor_berkas '=>$nomor_berkas, 
				'tanggal_berkas '=>$tanggal_berkas, 
				'alamat_aduan '=>$alamat_aduan,
				'kode_desa '=>$kode_desa, 
				'kelurahan_aduan '=>$kelurahan_aduan, 
				'kecamatan_aduan '=>$kecamatan_aduan, 
				'uraian_aduan '=>$uraian_aduan, 
				'petugas_pelayanan_pengaduan '=>$petugas_pelayanan_pengaduan, 
				'petugas_penghubung '=>$petugas_penghubung, 
				'catatan '=>$catatan, 
				'catatan_disposisi '=>$catatan_disposisi, 
			
				'last_update' =>$last_update,
				'seksi' =>$seksi, 
				'kode_seksi' =>$kode_seksi,
				'catatan_status_berkas' =>$catatan_status_berkas,
				'perkiraan_penyelesaian' =>$perkiraan_penyelesaian
				
    );
	//var_dum($data);
    $this->db->where('nomor_pengaduan',$nomor_pengaduan);
    $this->db->update('tbl_dumas_pengaduan',$data);
  }
  
  public function update_verifikator(){
  $level=$this->session->userdata('level');
				$nomor_pengaduan=$this->input->post('nomor_pengaduan');
				$last_update =date('Y-m-d h:i:s'); 
				$seksi =$this->input->post('seksi'); 
				$kode_seksi =explode("-",$seksi); 
				$kode_seksi =$kode_seksi[0]; 
				$catatan_disposisi =$this->input->post('catatan_disposisi');
			/* 	echo $seksi;
				echo $kode_seksi;
				echo $catatan_disposisi;
				die("die here"); */
//save data main
    $data = array(
				'nomor_pengaduan'=>$nomor_pengaduan,
				'catatan_disposisi '=>$catatan_disposisi, 
				'last_update' =>$last_update,
				'seksi' =>$seksi, 
				'kode_seksi' =>$kode_seksi
				
    );
	//var_dum($data);
	echo $nomor_pengaduan."asaved";
    $this->db->where('nomor_pengaduan',$nomor_pengaduan);
    $this->db->update('tbl_dumas_pengaduan',$data);
  }
  
public function update_res(){

  $level=$this->session->userdata('level');
				$nomor_pengaduan=$_GET['nomor_pengaduan'];
				
				
				//echo "update sukses".$nomor_pengaduan; die();
				$apl_status ="RES";
				$last_update =date('Y-m-d h:i:s'); 
//save data main
    $data = array(
				'apl_status'=>$apl_status, 
				'last_update' =>$last_update
    );
	//var_dum($data);
	if($level=='plt'){
		$this->db->where('nomor_pengaduan',$nomor_pengaduan);
		$this->db->update('tbl_dumas_pengaduan',$data);
	}else{
		echo "Previledge anda bukan PLT<br/>";
	};	
		echo "<a href='../disposisi_main/entri_pengaduan'>Kembali ke list</a>";
  }  
public function update_var(){

  $level=$this->session->userdata('level');
				$nomor_pengaduan=$_GET['nomor_pengaduan'];
				
				
				//echo "update sukses".$nomor_pengaduan; die();
				$apl_status ="VER";
				$last_update =date('Y-m-d h:i:s'); 
//save data main
    $data = array(
				'apl_status'=>$apl_status, 
				'last_update' =>$last_update
    );
	//var_dum($data);
	if($level=='user'){
		$this->db->where('nomor_pengaduan',$nomor_pengaduan);
		$this->db->update('tbl_dumas_pengaduan',$data);
	}else{
		echo "Previledge anda bukan PLT<br/>";
	};	
		echo "<a href='../disposisi_main/entri_pengaduan'>Kembali ke list</a>";
  }
  
public function update_dis(){

  $level=$this->session->userdata('level');
				$nomor_pengaduan=$_GET['nomor_pengaduan'];
				
				
				//echo "update sukses".$nomor_pengaduan; die();
				$apl_status ="DIS";
				$last_update =date('Y-m-d h:i:s'); 
//save data main
    $data = array(
				'apl_status'=>$apl_status, 
				'last_update' =>$last_update
    );
	//var_dum($data);
	if($level=='verifikator'){
		$this->db->where('nomor_pengaduan',$nomor_pengaduan);
		$this->db->update('tbl_dumas_pengaduan',$data);
	}else{
		echo "Previledge anda bukan PLT<br/>";
	};	
		echo "<a href='../disposisi_main/entri_pengaduan'>Kembali ke list</a>";
  }
  
  
 public function gen_nomor_aduan(){
 $bulan[1]="I";
 $bulan[2]="II";
 $bulan[3]="III";
 $bulan[4]="IV";
 $bulan[5]="V";
 $bulan[6]="VI";
 $bulan[7]="VII";
 $bulan[8]="VIII";
 $bulan[9]="IX";
 $bulan[10]="X";
 $bulan[11]="XI";
 $bulan[12]="XII";
 
		$this->db->select('*');
//		$this->db->from('tbl_ref_nomor');
		$query = $this->db->get('tbl_ref_nomor');
			foreach ($query->result() as $row)
			{
				$nomor_urut_ref= $row->nomor_urut;
				$bulan_ref= $row->bulan;
				$tanggal_ref= $row->tanggal;

			//echo $row->title;
			}
		$tanggal=date('Y-m-d');
		$tanggal_sekarang=date('d');
		$bulan_sekarang=(int)(date('m'));
		$tahun_sekarang=date('Y');
		$bulan_inject=0;
		$nomor_urut=0;
		$date = date_create($tanggal_ref);
		$date_ref= date_format($date, 'Y');
		//die($d);
		if($tanggal_ref<=$tanggal ){
			if($bulan_sekarang>$bulan_ref){
				$bulan_inject=$bulan_sekarang;
				$nomor_urut=1;
			}else{
				if($tahun_sekarang>$date_ref){
					$bulan_inject=$bulan_sekarang;
					$nomor_urut=1;
				}else{
					$bulan_inject=$bulan_ref;
					$nomor_urut=$nomor_urut_ref+1;;
				}
			};
		//231.24.I.2014 	
		};
		$nomor_pengaduan = $nomor_urut.".".$tanggal_sekarang.".".$bulan[$bulan_inject].".".$tahun_sekarang;
		return $nomor_pengaduan;
		
 }
 
   public  function get_by_id($id){
				$this->db->select('*');
				$this->db->from('tbl_dumas_pengaduan');
				$this->db->where('nomor_pengaduan', $id);
        return $this->db->get();
    }
public	function is_date($date)
{
       if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $date, $parts))
       {
          if(checkdate($parts[2],$parts[1],$parts[3]))
             return true;
          else
             return false;
        }
        else
          return false;
}

public function getPPP(){
    $this->db->select('*');
    $this->db->from('member');
    $this->db->order_by('id','ASC');
    $query = $this->db->get();
    return $query->result();
  }

public function getJenisPermohonan(){
    $this->db->select('*');
    $this->db->from('tbl_ref_jenis_permohonan');
    $this->db->order_by('kode_jenis_permohonan','ASC');
    $query = $this->db->get();
    return $query->result();
  }
public function getLokasi(){
    $this->db->select('*');
    $this->db->from('tbl_ref_kelurahan');
    $this->db->order_by('nama_desa','ASC');
    $query = $this->db->get();
    return $query->result();
  }
public function getDisposisi(){
    $this->db->select('*');
    $this->db->from('tbl_ref_bagian');
    $this->db->order_by('kode_bagian','ASC');
    $query = $this->db->get();
    return $query->result();
  }
public function getSubsi(){
    $this->db->select('*');
    $this->db->from('tbl_ref_seksi');
    $this->db->order_by('kode_seksi','ASC');
    $query = $this->db->get();
    return $query->result();
  }
  
}