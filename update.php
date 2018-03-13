<?php
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
	
	//計算資料筆數
	//$people = mysql_num_rows($res);
?>

<!DOCTypE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>學生資料管理系統-修改資料</title>
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<center>
		<h1 align="center">學生資料管理系統 - 修改資料</h1>
		<p align="center">
			<input type="button" value="回到主畫面" onclick="location.href='index.php'">
		</p>
		<form action="db_update.php" method="post">
			<?php
				//SQL語法，選擇資料表「student」撈出該id之資料
				//$array_field = array('姓名', '性別', '生日', '電子郵件', '電話', '住址');
				
				if (isset($_GET['id'])){
					$sql_str = "select *from `student` where `id` = ".$_GET['id'];
					$res = mysql_query($sql_str) or die("SQL語法錯誤");
					$row_array = mysql_fetch_assoc($res);
				}
				else{
					$row_array['id'] = "";
					$row_array['name'] = "";
					$row_array['gender'] = "";
					$row_array['birthday'] = "";
					$row_array['email'] = "";
					$row_array['phone'] = "";
					$row_array['address'] = "";
				}
				$_SESSION['id'] = $row_array['id'];
			?>
			<table border="1" align="center" >
				<tr>
					<th>欄位</th>
					<th>資料</th>
				</tr>
				
				<tr>
					<td>姓名</td>
					<td><input type="text" name="name" value="<?=$row_array['name']?>" required="required"></td>
				</tr>
				<tr>
					<td>性別</td>
					<td>
						<?php
							if (isset($_GET['id'])){
								if ($row_array['gender']=='M'){
								?>
									<input type="radio" name="gender" value="M" checked>男
									<input type="radio" name="gender" value="F">女<?php
								}
								else{?>
									<input type="radio" name="gender" value="M">男
									<input type="radio" name="gender" value="F" checked>女<?php
								}
							}
							else{?>
								<input type="radio" name="gender" value="M" >男
								<input type="radio" name="gender" value="F" checked>女 <?php
							}
						?>
						
					</td>
				</tr>
				<tr>
					<td>生日</td>
					<td><input type="date" name="birthday" placeholder="格式為：2015-01-01" value="<?=$row_array['birthday']?>" required="required"></td>
				</tr>
				<tr>
					<td>電子郵件</td>
					<td><input type="email" name="email" value="<?=$row_array['email']?>" required="required"></td>
				</tr>
				<tr>
					<td>電話</td>
					<td><input type="text" name="phone" value="<?=$row_array['phone']?>" required="required"></td>
				</tr>
				<tr>
					<td>住址</td>
					<td><input type="text" name="address" value= "<?=$row_array['address']?>" required="required" size="40"></td>
				</tr>				
			</table>
			<br>
			<input type="submit" value="修改資料">
			<input type="reset"  value="重新填寫">
		</form>
		</center>
		<?php
			mysql_close($conn);
		?>
	</body>
</html>

