<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
        <title><?php echo $title;?></title>
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
<div class='header'>Badan Pertanahan Nasional</div>
	<div>
		<a href='<?php echo site_url('master/entri_jenis_permohonan')?>'>Ref. Jenis Permohonan</a> |
		<a href='<?php echo site_url('master/entri_type_pengaduan')?>'>Ref. Type Pengaduan</a> |
		<a href='<?php echo site_url('master/entri_bagian')?>'>Ref. Bagian</a> |
		<a href='<?php echo site_url('master/entri_seksi')?>'>Ref. Seksi</a> |
		<a href='<?php echo site_url('master/entri_ref_lokasi')?>'>Ref. Lokasi</a> |
		<a href='<?php echo site_url('master/entri_user')?>'>Ref. User</a> |
		<a href='<?php echo site_url('login/logout')?>'>Logout</a> 
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
	<div class='footer'>Kepulauan Riau</div>
</body>
</html>
