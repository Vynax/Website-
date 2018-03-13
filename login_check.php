<?php
	session_start();
	
	header("Content-Type:text/html; charset='utf-8'");
	//引入剛剛寫的連線檔案
	include('db_connect.php');
	//所要選擇的「資料庫名稱」變數
	$database = 'stu1103108147';
	//選擇資料庫，失敗的話則顯示「資料庫選擇失敗」
	$db_select = mysql_select_db($database) or die("資料庫選擇失敗");
	
	$account = htmlspecialchars($_POST['account'],ENT_QUOTES);
	$passwd = htmlspecialchars($_POST['passwd'],ENT_QUOTES);
	$check_num = htmlspecialchars($_POST['check_num'],ENT_QUOTES);
	//$rand_num = htmlspecialchars($_POST['rand_num'],ENT_QUOTES);
	
	//$sql_str = "select *from `account` where `account` = $account";
	//$res = mysql_query($sql_str) or die("SQL語法錯誤");
	//計算資料筆數
	
	if ($check_num == $_SESSION['captcha']){
		$sql_str = "select *from `account` where `account` = '$account' and `passwd` = '$passwd'";
		$res = mysql_query($sql_str) or die("SQL語法錯誤");
		$row_array = mysql_fetch_assoc($res);
		if ($row_array != ""){
			
			$_SESSION['login'] = '1';
			$_SESSION['name'] = $row_array['name'];
			$_SESSION['type'] = $row_array['type'];
			header('Location: index.php');
		}
		else{
			$_SESSION['login'] = '3';
			header('Location: login.php');
		}
	}
	else{
		$_SESSION['login'] = '2';
		header('Location: login.php');
	}
	
?>