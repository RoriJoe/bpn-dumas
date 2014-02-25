<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Slick Login</title>
<meta name="description" content="slick Login">
<meta name="author" content="Webdesigntuts+">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/loginform')?>/style.css" />
</head> 	                       
<body >	
<center><img src="<?=base_url('assets')?>/img/bpn_dumas_logo.png" height="102" width="300"/></center>
<div id="signup_form">

<?php 
	echo form_open("login/usermasuk"); ?>
<p><label>Username</label><input type="text" name="user" ></p>
<p><label>Password</label><input type="password" name="pass"></p>
<p>
<p><input type="submit" value="Login"/></p>

	
</div>
</body>
</html>

