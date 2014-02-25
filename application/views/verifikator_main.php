<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): 
?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<link type="text/css" rel="stylesheet" href="<?=base_url('assets/styleform.css')?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

</head>
<body>
<?
$user=$this->session->userdata('username');
$level=$this->session->userdata('level');
echo 'User : <b>'.$user.'</b><br/>';
echo 'Level ID : <b>'.$level.'</b>';
?>
<div class='header'>Badan Pertanahan Nasional</div>
	<div class='menubar'>
		<a href='<?php echo site_url('verifikator_main/entri_pengaduan')?>'>Verifikasi</a>
		<a href='<?php echo site_url('login/logout')?>'>Logout</a>
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
	<div class='footer'>Kepulauan Riau</div>
</body>
</html>
