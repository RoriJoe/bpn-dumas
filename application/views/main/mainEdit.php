<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 
<title>Add data</title>
 
 	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/themes/base/jquery.ui.all.css">
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui//jquery.ui.widget.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui//jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/demos/demos.css">
 
</head>
<body>
<?php $username = $this->session->userdata('username');?>
    <div class="content">
        <h1><?php echo $title; ?></h1>
        <?php echo $message; ?>
		<table width="1024px" cellspacing="0" cellpadding="0">
			<tr>
				<td class="title_head">KANTOR PERTANAHAN KOTA PEKANBARU – <i>aplikasi pengaduan masyarakat (dumas)</i> </td>
				<td class="title_user">User : <?=$username?></td>
			</tr>	
		</table>	
        <form method="post" action="<?php echo $action; ?>">
        <div class="data">
        <table width="1024px" cellspacing="0" cellpadding="5">
			<tr >
				<td class="title_subhead" colspan="8">1. Data Pengaduan</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">1.a.</td>
                <td class="detil_field_left" width="150px">Nomor</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><input type="text" id="nomor_pengaduan" name="nomor_pengaduan"/></td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">1.b.</td>
                <td class="detil_field_left" width="150px">Petugas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><input type="text" id="petugas_pelayanan_pengaduan" name="petugas_pelayanan_pengaduan"/></td>
				
            </tr>
            <tr >
				<td class="title_subhead" colspan="8">2. Data Pengadu</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">2.a.</td>
                <td class="detil_field_left" width="150px">Nama</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px"><input type="text" id="nama_lengkap" name="nama_lengkap"/></td>
                <td class="detil_field_left" width="150px">No. Identitas</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px"><input type="text" id="nomor_identitas" name="nomor_identitas"/></td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">2.b.</td>
                <td class="detil_field_left" width="150px">Kuasa dari</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><input type="text" id="nama_kuasa" name="nama_kuasa"/></td>
            </tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">2.c.</td>
                <td class="detil_field_left" width="150px">Alamat</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><input type="text" id="alamat_kuasa" name="alamat_kuasa"/></td>
            </tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">2.d.</td>
                <td class="detil_field_left" width="150px">Nomor HP</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px"><input type="text" id="handphone" name="handphone"/></td>
                <td class="detil_field_left" width="150px">Telepon</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px"><input type="text" id="telepon" name="telepon"/></td>
				
            </tr>
			
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">2.e.</td>
                <td class="detil_field_left" width="150px">Email	</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><input type="text" id="email" name="email"/></td>
            </tr>
			 <tr >
				<td class="title_subhead" colspan="8">3. Materi Pengaduan</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">3.a.</td>
                <td class="detil_field_left" width="150px">No. Berkas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px"><input type="text" id="nomor_berkas" name="nomor_berkas"/></td>
                <td class="detil_field_left" width="150px">Tanggal</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px"><input type="text" id="tanggal_berkas" name="tanggal_berkas"/></td>
				
            </tr>
			     <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">3.b.</td>
                <td class="detil_field_left" width="150px">Jenis Permohonan 	</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><input type="text" id="kode_jenis_permohonan" name="kode_jenis_permohonan"/></td>
            </tr>
			            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">3.d.</td>
                <td class="detil_field_left" width="150px">Lokasi Kel</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px"><input type="text" id="kelurahan_aduan" name="kelurahan_aduan"/></td>
                <td class="detil_field_left" width="150px">Kecamatan</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px"><input type="text" id="kecamatan_aduan" name="kecamatan_aduan"/></td>
			</tr>
			 <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">3.e.</td>
                <td class="detil_field_left" width="150px">Isi Pengaduan</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><textarea id="uraian_aduan" name="uraian_aduan" rows="4" cols="50"></textarea></td>
            </tr>
			<tr >
				<td class="title_subhead" colspan="8">4. Penerusan Pengaduan</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">4.a.</td>
                <td class="detil_field_left" width="150px">Disposisi ke</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><input type="text" id="kode_bagian" name="kode_bagian"/></td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">4.b.</td>
                <td class="detil_field_left" width="150px">Petugas penghubung </td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><input type="text" id="petugas_penghubung" name="petugas_penghubung"/></td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="12px">&nbsp;</td>
                <td class="detil_field_left" width="30px">4.c.</td>
                <td class="detil_field_left" width="150px">Catatan </td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><input type="text" id="catatan" name="catatan"/></td>
				
            </tr>
            <tr >
                <td align="center"><input type="submit" value="Simpan"/></td>
            </tr>
        </table>
        </div>
        </form>
        <br />
        <?php echo $link_back; ?>
    </div>
</body>
</html>
