<?php
	require_once('var.inc.php');
	$server=mysql_connect($host,$username,$password) or die('Could not connect to MySQL');
	mysql_select_db($database,$server);
?>