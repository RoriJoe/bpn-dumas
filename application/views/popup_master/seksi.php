<link type="text/css" rel="stylesheet" href="<?=base_url('assets/table.css')?>" />
<script type="text/javascript">
function sendValue (s){
//var tmp = kelurahan.split("|");
		window.opener.document.getElementById('seksi').value =s;
		window.close();
}

</script>
<h1>Member</h1>
<table id="daily" class="bordered" width="100%">
<thead> 
 <tr>
 <th width="5px">No</th>
 <th width="155px">Sub Seksi</th>
 <th width="10px">Get</th>
 </tr>
 </thead> 
 <tbody> 
 <?
 $i=0;
 ?> 
 
  <form id="form_list" name="form_list" action="<?php echo site_url('popup_master/seksi/cariData');?>" method = "post">
  <?
  
  echo "<input type='text' name='cari' id='cari'  />";
  echo "<input type='submit' value='cari' /> ";
 foreach ($query as $row){
 $i++;
 echo "<tr class=\"record\">";
 echo    "<td>$i</td>";
 echo    "<td>$row->seksi</td>";
   echo "<td>
				<input type='button' value='Select' onClick='sendValue(\"".$row->kode_seksi."-".$row->seksi."\");' /> </td>";
 echo  "</tr>";
 echo "</form>";

 }
 ?>
 </tbody> 
</table>