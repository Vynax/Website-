<!DOCTPYE html>
<?php
	session_start();
	
	if ($_SESSION['login'] != '1' || $_SESSION['type'] != 'T')
		header('Location: login.php');
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>學生資料管理系統-刪除資料</title>
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<center>
		<h1 align="center">學生資料管理系統 - 刪除資料</h1>
		<form name="auto" action="db_delete.php" method="post">
			輸入所要刪除的ID：<input type="number" name="id" value="<?php if (isset($_GET['id'])) {echo $_GET['id'];} ?>" required="required">
			
			<br>
			<input type="submit" value="刪除資料">			
		</form>
		<script>
			auto.submit();
		</script>
		</center>
	</body>
</html>

