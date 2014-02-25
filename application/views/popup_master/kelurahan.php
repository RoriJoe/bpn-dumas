<link type="text/css" rel="stylesheet" href="<?=base_url('assets/table.css')?>" />
<script type="text/javascript">
function sendValue (kelurahan){
var tmp = kelurahan.split("|");
		window.opener.document.getElementById('kelurahan_aduan').value = tmp[0];
		window.opener.document.getElementById('kecamatan_aduan').value = tmp[1];
		window.opener.document.getElementById('kode_desa').value = tmp[2];
		window.close();
}

</script>
<h1>Member</h1>
<table id="daily" class="bordered" width="100%">
<thead> 
 <tr>
 <th width="5px">No</th>
 <th width="155px">Kelurahan</th>
 <th width="155px">Kecamatan</th>
 <th width="10px">Get</th>
 </tr>
 </thead> 
 <tbody> 
 <?
 $i=0;
 ?> 
 
  <form id="form_list" name="form_list" action="<?php echo site_url('popup_master/kelurahan/cariData');?>" method = "post">
  <?
  
  echo "<input type='text' name='cari' id='cari'  />";
  echo "<input type='submit' value='cari' /> ";
 foreach ($query as $row){
 $i++;
 echo "<tr class=\"record\">";
 echo    "<td>$i</td>";
 echo    "<td>$row->nama_desa</td>";
 echo    "<td>$row->kecamatan</td>";
   echo "<td>
				<input type='button' value='Select' onClick='sendValue(\"".$row->nama_desa."|".$row->kecamatan."|".$row->kode_desa."\");' /> </td>";
 echo  "</tr>";
 echo "</form>";

 }
 ?>
 </tbody> 
</table>