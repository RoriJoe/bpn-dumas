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
<div class='header'>Badan Pertanahan Nasional</div>
	<div class='menubar'>
		<a href='<?php echo site_url('kode_etik_main/entri_pengaduan')?>'>Kode Etik</a>
		<a href='<?php echo site_url('main/logout')?>'>Logout</a> 
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
	<div ><blockquote>
			<h3><i>Kegiatan</i></h3>
				<ul>
					<li>Memeriksa jenis dan tipe pengaduan masyarakat</li>
					<li>Membuat laporan kode etik</li>
				</ul>	
				
	</blockquote></div>
	<div class='footer'>Kepulauan Riau</div>
</body>
</html>
