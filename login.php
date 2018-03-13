<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>學生資料管理系統</title>
		<?php
			session_start();
			
			if (isset($_SESSION['login'])){
				switch( $_SESSION['login'] ){
					case '1':
						header("Location:index.php");
						break;
					case '2':
						?><script>alert("驗證碼錯誤")</script><?php
						session_unset();
						break;
					case '3':
						?><script>alert("帳號或密碼錯誤")</script><?php
						session_unset();
						break;
				}
			}
			else{}
		?>
		<link href="../../all.css" rel="stylesheet">
		<style>
			.captcha{
				color:red;
			}
		</style>
	</head>
	
	<body>
		<h1>學生資料管理系統</h1>
		<form action="login_check.php" method="post">
			帳號:<input type="text" name="account" required><br>
			密碼:<input type="password" name="passwd" required><br>
			請輸入驗證碼:<input type="text" name="check_num" size="3" required><span class="captcha">
			<?php
				$captcha = rand(100,999);
				echo $captcha;
				echo "<br>";
				$_SESSION['captcha'] = $captcha;
			?></span>
			<br>
			<input type="submit" value="登入">
			<input type="reset" value="清除">
			
		</form>
	</body>
</html>