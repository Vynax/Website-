<?php
	header("Content-Type:text/html; charset='utf-8'");
	session_start();
	
	if ($_SESSION['login'] != '1')
		header('Location: login.php');
	//引入剛剛寫的連線檔案
	include('db_connect.php');
	//所要選擇的「資料庫名稱」變數
	$database = 'stu1103108147';
	//選擇資料庫，失敗的話則顯示「資料庫選擇失敗」
	$db_select = mysql_select_db($database) or die("資料庫選擇失敗");
	
	//SQL語法，選擇資料表「student」撈出所有資料
	$sql_str = "select *from `student`";
	$res = mysql_query($sql_str) or die("SQL語法錯誤");
	//計算資料筆數
	$people = mysql_num_rows($res);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>學生資料管理系統</title>
		<link href="../../all.css" rel="stylesheet">
		<script>
			function logout(){
				if (confirm("是否確定登出")){
					location.href='logout.php';
				}
			}
		</script>
	</head>
	<body>
	
		<h1 align="center">學生資料管理系統</h1>
		<!-- 顯示資料筆數 -->
		<?php
			$name = $_SESSION['name'];
			$type = $_SESSION['type'];
			if ($type == 'T')
				$appellation = '老師';
			else if ($type == 'S')
				$appellation = '學生';
			echo $name.$appellation."您好!";
		?>
		<br>
		<p align="center">目前資料筆數：
			<?php echo $people;?>&#160;<!--在此顯示資料筆數-->
			<?php 
				if ($_SESSION['type'] == 'T'){ ?>
					<input type="button" value="新增學生資料" onclick="location.href='add.php'">
				<?php }
			?>
			<input type="button" onclick="javascript:logout()" value="登出">
		</p>
			
			<table border="1" align="center">
				<tr>
					<th>ID</th>
					<th>姓名</th>
					<th>性別</th>
					<th>生日</th>
					<th>電子郵件</th>
					<th>電話</th>
					<th>住址</th>
					<?php if ($type == 'T'){ ?><th>功能</th><?php } ?>
				</tr>
			<!-- 顯示資料內容 -->
			<?php
				//從$res資料依次取出每筆學生的資料$row_array，直到回傳false停止while迴圈
				while($row_array = mysql_fetch_assoc($res)) {
			?>
					<tr>
						<!--印出$row_array陣列中的資料-->
						<?php
							foreach ($row_array as $key => $item)
								echo "<td>".$item."</td>";
						?>
						<?php 
							if ($type == 'T'){ ?>
							<td>
								<a href="update.php?id=<?=$row_array['id']?>">修改</a>
								<a href="delete.php?id=<?=$row_array['id']?>">刪除</a>
							</td>
							<?php } ?>
					</tr>
			<?php
				}
			?>
			</table>
			<?php
				mysql_close($conn);
			?>
			<div align="center">
				<!--<input type="button" value="修改資料" onclick="location.href='update.php'">
				<input type="button" value="刪除資料" onclick="location.href='delete.php'">-->
			</div>
	</body>
</html>