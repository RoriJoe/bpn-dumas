<?php

echo $this->session->userdata('username');
$array_items = array('username' => '', 'email' => '');

$this->session->unset_userdata($array_items);

echo "<html>";
echo "<head>";
echo "<title> tes parsing data </title> </head>";
echo "<body>";
echo "hallo mas dab...";
echo "<font color=\"$color\">$nama</font>";
echo "</body>";
?>