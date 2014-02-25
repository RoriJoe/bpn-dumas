<script>
function go_add(){
	window.location="tambah_data_pengaduan";
}
</script>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): 
?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<link type="text/css" rel="stylesheet" href="<?=base_url('assets/styleform.css')?>" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/demos/demos.css">
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

</head>
<body>
<?
$username=$this->session->userdata('username');
$level=$this->session->userdata('level');
?>
<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td class="title_head">KANTOR PERTANAHAN KOTA PEKANBARU <i>aplikasi pengaduan masyarakat (dumas)</i> </td>
				<td class="title_user">User : <?=$username?></td>
			</tr>	
		</table>	

	<div class='menubar'>
		<a href='<?php echo site_url('main/entri_pengaduan')?>'>Input Pengaduan</a>
		<a href='<?php echo site_url('res_main/entri_pengaduan')?>'>Cek Pengaduan</a>
		<a href='<?php echo site_url('login/logout')?>'>Logout</a> 
	</div>
	
	<div style='height:20px;'></div>  
	<button onclick="go_add()">Tambah data</button>
	</div>  
    <div>
		<?php echo $output; ?>
    </div>
	<div class='footer'>Kepulauan Riau</div>
</body>
</html>
