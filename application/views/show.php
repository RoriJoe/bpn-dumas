<h1>Daily Notes</h1>
<table id="daily" class="ui-widget ui-widget-content" width="400px">
 <tr class="ui-widget-header ">
 <th>No</th>
 <th>Date</th>
 <th>Name</th>
 <th>Amount</th>
 <th>Edit</th>
 <th>Delete</th>
 </tr>
 
 <?
 $i=0;
 foreach ($query as $row){
 $i++;
 echo "<tr class=\"record\">";
 echo    "<td>$i</td>";
 echo    "<td>$row->date</td>";
 echo    "<td>$row->name</td>";
 echo    "<td>$row->amount</td>";
 echo    "<td><a class=\"edit\" href=\"#\"  id=\"$row->id\" date=\"$row->date\" name=\"$row->name\" amount=\"$row->amount\">Edit</a></td>";
 echo    "<td><a class=\"delbutton\" id=\"$row->id\" href=\"#\" >Delete</a></td>";
 echo    "<td><a id=\"tes\" href=\"#\" >Delete</a></td>";
 echo    "<td><input type='button' value='Edit' name=\"tess\" id=\"tess\"></td>";
 echo  "</tr>";
 echo '<a class="ajax" href="#" idx="'.$row->id.'">'.$row->id.'</a>';
 
 }
 ?>
</table>