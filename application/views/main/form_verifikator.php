<script>
function doCetak (no) {
var w = window.open("../report/tanda_terima/tanda_terima?nomor_pengaduan="+no);
}
</script>
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




<script>
$(function() {
//('setDate', new Date());
  
    $( "#tanggal_berkas" ).datepicker();
    $( "#tanggal_pengaduan" ).datepicker();
    $( "#perkiraan_penyelesaian" ).datepicker();
	
    $('#ppp tr').click(function (event) {
          //alert($(this).attr('id')); //trying to alert id of the clicked row
		$("#petugas_pelayanan_pengaduan").val($(this).attr('id'));

     });
 
    $('#jp tr').click(function (event) {
          //alert($(this).attr('id')); //trying to alert id of the clicked row
		$("#jenis_permohonan").val($(this).attr('id'));

     });
    $('#lokasi tr').click(function (event) {
		lokasi=$(this).attr('id');
		lokasi=lokasi.split("-") ;
		$("#kode_desa").val(lokasi[0]);
		$("#kelurahan_aduan").val(lokasi[1]);
		$("#kecamatan_aduan").val(lokasi[2]);
     });
    $('#disposisi tr').click(function (event) {
		$("#bagian").val($(this).attr('id'));
     });
    $('#subsi tr').click(function (event) {
		$("#seksi").val($(this).attr('id'));
     });
 
});
   
</script>	
<body>
<?php //echo validation_errors(); ?>

<div class="msg"><?php echo $message; ?></div>
<?php 
$username = $this->session->userdata('username');
$level = $this->session->userdata('level');
$apl_status=$pengaduan_data->apl_status;
if($level!="user"){
	$readonly="readonly='readonly'";
	$disabled="disabled='disabled'";
}else{
  if( $apl_status!="REG"){
  	$readonly="readonly='readonly'";
	$disabled="disabled='disabled'";
  }else{
	$readonly="";
	$disabled="";
	}	
};

?>
    <div class="content">
       
        
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
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Nomor</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="200px"><?php echo $pengaduan_data->nomor_pengaduan; ?></td>
				<input type="hidden" name="nomor_pengaduan" id="nomor_pengaduan" value="<?php echo $pengaduan_data->nomor_pengaduan; ?>" />
				<td class="detil_field_left" width="160px">Tanggal pengaduan</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px">
				<?php
						$date = date_create($pengaduan_data->tanggal_pengaduan);
						$date_ref1= date_format($date, 'd-m-Y');
				?>
				<?php echo $date_ref1;?>
				
				</td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Petugas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px">
				<?php echo $pengaduan_data->petugas_pelayanan_pengaduan; ?>
				</td>
				
            </tr>
			
            
            <tr >
				<td class="title_subhead" colspan="8">2. Data Pengadu</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Nama 
				
				</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px"><?php echo $pengaduan_data->nama_lengkap; ?></td>
                <td class="detil_field_left" width="160px">No. Identitas</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px"><?php echo $pengaduan_data->nomor_identitas; ?></td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Kuasa dari</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><?php echo $pengaduan_data->nama_kuasa; ?></td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Alamat</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px"><?php echo $pengaduan_data->alamat; ?></td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" colspan="5" width="160px">Nomor HP : <?php echo $pengaduan_data->handphone; ?>
						&nbsp;Telepon :<?php echo $pengaduan_data->telepon; ?>
						&nbsp;Email :<?php echo $pengaduan_data->email; ?>
						</td>
            </tr>
			
         
			 <tr >
				<td class="title_subhead" colspan="8">3. Materi Pengaduan</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">No. Berkas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px"><?php echo $pengaduan_data->nomor_berkas; ?></td>
                <td class="detil_field_left" width="160px">Tanggal</td>
                <td class="detil_field_left" width="5px">:</td>
				<td class="detil_field_left" width="372px"><?
						$date = date_create($pengaduan_data->tanggal_berkas);
						$date_ref2= date_format($date, 'd-m-Y');
						echo $date_ref2;
				?>
				
            </tr>
			     <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Jenis Permohonan 	</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><?php echo $pengaduan_data->jenis_permohonan; ?>
				</td>
            </tr>
				
            </tr>
			            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" colspan="3" >Lokasi Kel : <b><?php echo $pengaduan_data->kelurahan_aduan; ?></b>
				&nbsp;&nbsp;&nbsp;Kecamatan  :<b><?php echo $pengaduan_data->kecamatan_aduan; ?></b>
				&nbsp;&nbsp;&nbsp;Kode Desa  :<b><?php echo $pengaduan_data->kode_desa; ?></b>
				</td>
            </tr>
			 <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Isi Pengaduan</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><?php echo $pengaduan_data->uraian_aduan; ?></td>
            </tr>
			<tr >
				<td class="title_subhead" colspan="8">4. Penerusan Pengaduan</td>
			</tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" colspan="6">Disposisi ke :&nbsp;<b><?php echo $pengaduan_data->bagian; ?></b>
					&nbsp;&nbsp;&nbsp;Petugas penghubung  :<b><?php echo $pengaduan_data->petugas_penghubung; ?></b></td>
				</td>
				
            </tr>
			
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Catatan </td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><?php echo $pengaduan_data->catatan; ?></td>
				
            </tr>
			<?php
			if($level=="verifikator" OR $level=="plt" or $apl_status=="RES"){
			?>
			  <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">-</td>
                <td class="detil_field_left" width="160px">Disposisi ke Subseksi</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><input    type="text" id="seksi" name="seksi" maxlength="100px" size="50px" value="<?php echo $pengaduan_data->seksi; ?>" />
				
				</td>
				
            </tr>
			 <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">&nbsp;</td>
                <td class="detil_field_left" width="160px">&nbsp;</td>
                <td class="detil_field_left" width="5px">&nbsp;</td>
                <td class="detil_field_left" width="327px">
				<div class="content_table">
									<table id="subsi" class="tbselect" cellpadding="0" cellspacing="0">
									 <?
										
										foreach ($subsi as $row_subsi){
												echo '<tr id="'.$row_subsi->kode_seksi.'-'.$row_subsi->seksi.'" >
															  <td width="20px">'.$row_subsi->kode_seksi.'-</td>      
															  <td  width="300px">'.$row_subsi->seksi.'</td>      
															 </tr>';
										}
									?>		 
									</table>
									</div>				
			</td>
				
			<td class="detil_field_left"  colspan="3">Catatan Disposisi<br/>
			<textarea    id="catatan_disposisi" name="catatan_disposisi"  rows="4" cols="50"  ><?php echo $pengaduan_data->catatan_disposisi; ?></textarea>
			
			</td>	
            </tr>
			
			<?
				}
			?>
			<?php
			if( $level=="plt" or $apl_status=="RES"){
				if( $level=="plt"){$readonly="";};
			?>
			 <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">4.f.</td>
                <td class="detil_field_left" width="160px">Catatan Status Berkas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><textarea   <?=$readonly?> id="catatan_status_berkas" name="catatan_status_berkas"  rows="4" cols="50"  ><?php echo $pengaduan_data->catatan_status_berkas; ?></textarea></td>
				
            </tr>
			 <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">4.g.</td>
                <td class="detil_field_left" width="160px">Posisi saat ini</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px"><?=date('d-m-Y')?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan Penyelesaian : &nbsp;<input type="text"  <?=$readonly?> id="perkiraan_penyelesaian" name="perkiraan_penyelesaian" value="<?php echo $pengaduan_data->perkiraan_penyelesaian; ?>"  /></td>
            </tr>
			<?
				}
				if($apl_status!="RES"){
			?>
            <tr >
                <td align="center"><input type="submit" value="Simpan Edit"/></td>
				<? if($level=="verifikator"){?>
						<td align="center"  colspan="8"><a href="../kirim_verifikasi?nomor_pengaduan=<?php echo $pengaduan_data->nomor_pengaduan; ?>">Kirim Verifikasi</a>
						<a href="../verifikator_main/entri_pengaduan">Kembali ke Daftar Pengaduan</a></td>
					<? };?>
				
            </tr>
			<?
				}
			?>
            	
        </table>
        </div>
        </form>
        <br />
        <?php //echo $link_back; ?>
    </div>

	
	</body>
</html>