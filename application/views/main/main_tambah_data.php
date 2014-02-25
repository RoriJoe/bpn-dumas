<script>
function doCetak (no) {
var w = window.open("../report/tanda_terima/tanda_terima?nomor_pengaduan="+no);
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 
<title><?php echo $title; ?></title>
 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui//jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui//jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/demos/demos.css">
 
</head>
<script>
$(function() {
    $( "#tanggal_berkas" ).datepicker();
    $( "#tanggal_pengaduan" ).datepicker();
	
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
	
  });
   
</script>	
<body>

<div class="msg"><?php echo $message; ?></div>
<?php $username = $this->session->userdata('username');?>
    <div class="content">
        <h1><?php echo $title; ?></h1>
        <table width="1024px" cellspacing="0" cellpadding="0">
                <tr>
                        <td class="title_head">KANTOR PERTANAHAN KOTA PEKANBARU � <i>aplikasi pengaduan masyarakat (dumas)</i> </td>
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
                <td class="detil_field_left" width="10px">1.a.</td>
                <td class="detil_field_left" width="160px">Nomor</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px">
                    <input type="text" id="nomor_pengaduan" name="nomor_pengaduan"  readonly="readonly"/>
                </td>
                <td class="detil_field_left" width="160px">Tanggal pengaduan</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="372px">
                    <input type="text" id="tanggal_pengaduan" name="tanggal_pengaduan" value="<?php echo set_value('tanggal_pengaduan'); ?>"/>
                    <div class="form-error"><?php echo form_error('tanggal_pengaduan'); ?></div>
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">1.b.</td>
                <td class="detil_field_left" width="160px">Petugas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px">
                    <input type="text" id="petugas_pelayanan_pengaduan" value="<?php echo set_value('petugas_pelayanan_pengaduan'); ?>" maxlength="100px" size="50px" name="petugas_pelayanan_pengaduan"  value=" <?php set_value('petugas_pelayanan_pengaduan'); ?>"/>
                    <div class="form-error"><?php echo form_error('petugas_pelayanan_pengaduan'); ?></div>
                </td>		
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">&nbsp;</td>
                <td class="detil_field_left" width="160px">&nbsp;</td>
                <td class="detil_field_left" width="5px">&nbsp;</td>
                <td colspan="3" class="detil_field_left" width="827px">
                    <div class="content_table">
                        <table id="ppp" class="tbselect" cellpadding="0" cellspacing="0">
                         <?php foreach ($ppp as $row_ppp){
                                echo '<tr id="'.$row_ppp->id.'-'.$row_ppp->user.'" >
                                                          <td width="20px">'.$row_ppp->id.'-</td>      
                                                          <td  width="300px">'.$row_ppp->user.'</td>      
                                                         </tr>';
                                }
                        ?>		 
                        </table>
                    </div>				
                </td>	
            </tr>
            <tr >
                <td class="title_subhead" colspan="8">2. Data Pengadu</td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">2.a.</td>
                <td class="detil_field_left" width="160px">Nama</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px">
                    <input value="<?php echo set_value('nama_lengkap'); ?>" type="text" id="nama_lengkap" name="nama_lengkap" maxlength="100px" size="50px"/>
                    <div class="form-error"><?php echo form_error('nama_lengkap'); ?></div>
                </td>
                <td class="detil_field_left" width="160px">No. Identitas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="372px">
                    <input value="<?php echo set_value('nomor_identitas'); ?>" type="text" id="nomor_identitas" name="nomor_identitas"/>
                    <div class="form-error"><?php echo form_error('nomor_identitas'); ?></div>
                </td>	
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">2.b.</td>
                <td class="detil_field_left" width="160px">Kuasa dari</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px">
                    <input value="<?php echo !empty($_POST['nama_kuasa'])?$_POST['nama_kuasa']:''; ?>" 
                           type="text" id="nama_kuasa" name="nama_kuasa" maxlength="100px" size="50px"/>
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">2.c.</td>
                <td class="detil_field_left" width="160px">Alamat</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px">
                    <input value="<?php echo !empty($_POST['alamat_kuasa'])?$_POST['alamat_kuasa']:''; ?>" 
                           type="text" id="alamat_kuasa" name="alamat_kuasa" maxlength="100px" size="50px"/>
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">2.d.</td>
                <td class="detil_field_left" width="160px">Nomor HP</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px">
                    <input value="<?php echo set_value('handphone'); ?>" 
                           type="text" id="handphone" name="handphone" maxlength="100px" size="20px"/>
                    <div class="form-error"><?php echo form_error('handphone'); ?></div>
                </td>
                <td class="detil_field_left" width="160px">Telepon</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="372px">
                    <input value="<?php echo set_value('telepon'); ?>" type="text" id="telepon" name="telepon" maxlength="100px" size="20px"/>
                    <div class="form-error"><?php echo form_error('telepon'); ?></div>
                </td>
				
            </tr>
			
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">2.e.</td>
                <td class="detil_field_left" width="160px">Email	</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="3" class="detil_field_left" width="827px">
                    <input value="<?php echo !empty($_POST['email'])?$_POST['email']:''; ?>" 
                           type="text" id="email" name="email" maxlength="100px" size="50px"/>
                </td>
            </tr>
            <tr >
                <td class="title_subhead" colspan="8">3. Materi Pengaduan</td>
           </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">3.a.</td>
                <td class="detil_field_left" width="160px">No. Berkas</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px">
                    <input value="<?php echo set_value('nomor_berkas'); ?>" type="text" id="nomor_berkas" name="nomor_berkas"/>
                    <div class="form-error"><?php echo form_error('nomor_berkas'); ?></div>
                </td>
                <td class="detil_field_left" width="160px">Tanggal</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="372px">
                    <input value="<?php echo set_value('tanggal_berkas'); ?>" type="text" id="tanggal_berkas" name="tanggal_berkas"/>
                    <div class="form-error"><?php echo form_error('tanggal_berkas'); ?></div>
                </td>		
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">3.b.</td>
                <td class="detil_field_left" width="160px">Jenis Permohonan 	</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px">
                    <input value="<?php echo set_value('jenis_permohonan'); ?>" type="text" id="jenis_permohonan" name="jenis_permohonan" maxlength="100px"  size="50px"/>
                    <div class="form-error"><?php echo form_error('jenis_permohonan'); ?></div>
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">&nbsp;</td>
                <td class="detil_field_left" width="160px">&nbsp;</td>
                <td class="detil_field_left" width="5px">&nbsp;</td>
                <td colspan="3" class="detil_field_left" width="827px">
				<div class="content_table">
									<table id="jp" class="tbselect" cellpadding="0" cellspacing="0">
									 <?
										
										foreach ($jenis_permohonan as $row_jenis_permohonan){
												echo '<tr id="'.$row_jenis_permohonan->kode_jenis_permohonan.'-'.$row_jenis_permohonan->jenis_permohonan.'" >
															  <td width="20px">'.$row_jenis_permohonan->kode_jenis_permohonan.'-</td>      
															  <td  width="300px">'.$row_jenis_permohonan->jenis_permohonan.'</td>      
															 </tr>';
										}
									?>		 
									</table>
									</div>				
			</td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">3.d.</td>
                <td class="detil_field_left" width="160px">Lokasi Kel</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="300px">
                    <input value="<?php echo !empty($_POST['kelurahan_aduan'])?$_POST['kelurahan_aduan']:''; ?>" type="text" id="kelurahan_aduan" name="kelurahan_aduan" maxlength="100px" size="40px"/>
                    
                </td>
                <td class="detil_field_left" width="160px">Kecamatan</td>
                <td class="detil_field_left" width="5px">:</td>
                <td class="detil_field_left" width="372px">
                    <input value="<?php echo !empty($_POST['kecamatan_aduan'])?$_POST['kecamatan_aduan']:''; ?>" type="text" id="kecamatan_aduan" name="kecamatan_aduan" maxlength="100px" size="40px"/>
                    
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">&nbsp;</td>
                <td class="detil_field_left" width="160px">&nbsp;</td>
                <td class="detil_field_left" width="5px">&nbsp;</td>
                <td colspan="3" class="detil_field_left" width="827px">
				<div class="content_table_wide">
									<table id="lokasi" class="tbselect" cellpadding="0" cellspacing="0">
									 <?
										
										foreach ($lokasi as $row_lokasi){
												echo '<tr id="'.$row_lokasi->kode_desa.'-'.$row_lokasi->nama_desa.'-'.$row_lokasi->kecamatan.'" >
															  <td  width="150px">'.$row_lokasi->nama_desa.'</td>      
															  <td  width="200px">'.$row_lokasi->kecamatan.'</td>      
															 </tr>';
										}
									?>		 
									</table>
									</div>				
			</td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">3.e.</td>
                <td class="detil_field_left" width="160px">Kode Desa</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px">
                    <input value="<?php echo !empty($_POST['kode_desa'])?$_POST['kode_desa']:''; ?>" type="text" id="kode_desa" name="kode_desa" />
                    
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">3.f.</td>
                <td class="detil_field_left" width="160px">Isi Pengaduan</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px">
                    <textarea id="uraian_aduan" name="uraian_aduan" rows="4" cols="50"><?php echo !empty($_POST['uraian_aduan'])?$_POST['uraian_aduan']:''; ?></textarea>
                    
                </td>
            </tr>
            <tr >
                <td class="title_subhead" colspan="8">4. Penerusan Pengaduan</td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">4.a.</td>
                <td class="detil_field_left" width="160px">Disposisi ke</td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px">
                    <input value="<?php echo set_value('bagian'); ?>" type="text" id="bagian" name="bagian" maxlength="100px" size="62px"/>
                    <div class="form-error"><?php echo form_error('bagian'); ?></div>
                </td>	
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">&nbsp;</td>
                <td class="detil_field_left" width="160px">&nbsp;</td>
                <td class="detil_field_left" width="5px">&nbsp;</td>
                <td colspan="3" class="detil_field_left" width="827px">
				<div class="content_table_wide">
									<table id="disposisi" class="tbselect" cellpadding="0" cellspacing="0">
									 <?
										
										foreach ($disposisi as $row_disposisi){
												echo '<tr id="'.$row_disposisi->kode_bagian.'-'.$row_disposisi->bagian.'" >
															  <td  width="20px">'.$row_disposisi->kode_bagian.'-</td>      
															  <td  width="350px">'.$row_disposisi->bagian.'</td>      
															 </tr>';
										}
									?>		 
									</table>
									</div>				
			</td>
				
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">4.b.</td>
                <td class="detil_field_left" width="160px">Petugas penghubung </td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px">
                    <input value="<?php echo !empty($_POST['petugas_penghubung'])?$_POST['petugas_penghubung']:''; ?>" 
                           type="text" id="petugas_penghubung" name="petugas_penghubung"/>
                </td>
            </tr>
            <tr >
                <td class="detil_field_left" width="8px">&nbsp;</td>
                <td class="detil_field_left" width="10px">4.c.</td>
                <td class="detil_field_left" width="160px">Catatan </td>
                <td class="detil_field_left" width="5px">:</td>
                <td colspan="4" class="detil_field_left" width="827px">
                    <textarea  id="catatan" name="catatan"  rows="4" cols="50"><?php echo !empty($_POST['catatan'])?$_POST['catatan']:''; ?></textarea>
                </td>	
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