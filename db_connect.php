<?php
	header("Content-Type:text/html; charset=utf-8");
	
	$db_host = "203.64.91.58";
	
	$db_account = "stu1103108147";
	$db_password = "F129602477";
	
	$conn = @mysql_connect($db_host,$db_account,$db_password) or die("連線錯誤");
	
	mysql_query("SET CHARACTER SET 'utf8'");
	mysql_query("set names 'utf8'");
?>