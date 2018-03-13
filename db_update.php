<?php
	//ini_set('display_errors',1);
	//error_reporting(E_ALL);
	session_start();
	
	if ($_SESSION['login'] != '1' || $_SESSION['type'] != 'T')
		header('Location: login.php');
	header("Content-Type:text/html; charset='utf-8'");
	//引入剛剛寫的連線檔案
	include('db_connect.php');
	//所要選擇的「資料庫名稱」變數
	$database = 'stu1103108147';
	//選擇資料庫，失敗的話則顯示「資料庫選擇失敗」
	$db_select = mysql_select_db($database) or die("資料庫選擇失敗");
	
	$id = $_SESSION['id'];
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$birthday = $_POST['birthday'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	
?>
<!DOCTypE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>學生資料管理系統</title>
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<?php
			$sql_str = "update `student` set `name` = '$name', `gender` = '$gender', `birthday` = '$birthday', `email` = '$email', `phone` = '$phone',`address` = '$address' where `id` = $id;";
			if ( mysql_query($sql_str) )
			{
				echo "修改成功";
			}
			else
				echo "修改失敗";
			
			mysql_close($conn);
		?>
		<br>本網頁將在3秒後自動回首頁
		<input type="button" value="給沒耐心等3秒的你" onclick="location.href='index.php'">
		<?php
			header("Refresh: 3; url=index.php");
		?>
	</body>
</html>