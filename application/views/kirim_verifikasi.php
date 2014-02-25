<script>
function goto_list(){
  window.location="main/entri_pengaduan";
}
</script>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="<?=base_url('assets/styleform.css')?>" />
</head>
<body>
<form name="konfirmasi" action="main/entri_pengaduan">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><h1>Form Kirim Pengaduan</h1></td>
		</tr>
		<tr>
			<td>Nomor Pengaduan</td>
			<td>:</td>
			<td><?
					$nomor_pengaduan = $_GET['nomor_pengaduan'];
					$bagian = !empty($_GET['bagian'])?$_GET['bagian']:'';
					echo "Nomor Pengaduan : ".$nomor_pengaduan;
					if($bagian=="" OR $bagian=="0"){
						echo "<br/><font color='red'>Bagian belum ada, data belum dikirim</font>";
					}else{
						$query = $this->db->query('update tbl_dumas_pengaduan set apl_status="VER" where nomor_pengaduan="'.$nomor_pengaduan.'"');
					}	
			?>
			</td>
		</tr>
		<tr>
			<td>Note </td>
			<td>:</td>
			<td><INPUT TYPE="button" VALUE="Back" onClick="goto_list()"></td>
		</tr>
		<tr>
		<td colspan="3" align="center">
		</td>
		</tr>
	</table>
</form>	
	
</body>
	