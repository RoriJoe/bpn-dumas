<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="<?=base_url('assets/styleform.css')?>" />
</head>
<body>
<form name="konfirmasi" action="kakan_main/entri_pengaduan">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><h1>Form Kirim ke TIM Kode Etik</h1></td>
		</tr>
		<tr>
			<td>Nomor Pengaduan</td>
			<td>:</td>
			<td><?
			/*	
				REG = Register (entry new)
				VER = Verifikasi team
				KKT = Kepala Kantor
				KDE = kode etik
			*/
			$nomor_pengaduan = $_GET['nomor_pengaduan'];
			echo "Nomor Pengaduan : ".$nomor_pengaduan;
			$query = $this->db->query('update tbl_dumas_pengaduan set apl_status="PDU" where nomor_pengaduan='.$nomor_pengaduan);
			?></td>
		</tr>
		<tr>
			<td>Note </td>
			<td>:</td>
			<td>Data pengaduan sudah terkirim ke Kode Etik dan SPK</td>
		</tr>
		<tr>
		<td colspan="3" align="center">
		<input type ="submit" id="btnKirim" name="btnKirim" value="kembali ke list" /></td>
		</tr>
	</table>
</form>	
	
</body>
	