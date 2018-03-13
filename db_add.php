<?php
	//ini_set('display_errors',1);
	//error_reporting(E_ALL);
	session_start();
	
	if ($_SESSION['login'] != '1' || $_SESSION['type'] != 'T'){
		header('Location: login.php');
		exit();
	} 
	header("Content-Type:text/html; charset='utf-8'");
	
	//引入剛剛寫的連線檔案
	include('db_connect.php');
	//所要選擇的「資料庫名稱」變數
	$database = 'stu1103108147';
	//選擇資料庫，失敗的話則顯示「資料庫選擇失敗」
	$db_select = mysql_select_db($database) or die("資料庫選擇失敗");
	
	$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
	$gender = htmlspecialchars($_POST['gender'],ENT_QUOTES);
	$birthday = htmlspecialchars($_POST['birthday'],ENT_QUOTES);
	$email = htmlspecialchars($_POST['email'],ENT_QUOTES);
	$phone = htmlspecialchars($_POST['phone'],ENT_QUOTES);
	$address = htmlspecialchars($_POST['address'],ENT_QUOTES);
	
	$sql_str = "INSERT INTO `student` (`name`, `gender`,`birthday`, `email`, `phone`, `address`) VALUES ('$name', '$gender', '$birthday', '$email', '$phone', '$address')";
	//mysql_query($sql_str);
	if ( mysql_query($sql_str) /*or trigger_error(mysql_error()." ".$sql_str)*/ )
	{
		echo "新增成功";
	}
	else
		echo "新增失敗";

	//echo "hi";
	
?>
<!DOCTypE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>學生資料管理系統</title>
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<br>本網頁將在3秒後自動回首頁
		<input type="button" value="給沒耐心等3秒的你" onclick="location.href='index.php'">
		<?php
			header("Refresh: 3; url=index.php");
		?>
	</body>
</html>