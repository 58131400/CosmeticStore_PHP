<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Crete+Round&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./assets/fontawesome/css/all.css">
	<link rel="stylesheet" href="./assets/css/styleLogin.css" type="text/css" media="screen" />
	<script type="text/javascript" src="./assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="./assets/js/popper.min.js"></script>
	<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
	<script>
      			function quay_lai_trang_truoc(){
          history.back();
      			}
  			</script>
</head>
<body>
	<?php 

	session_start();
	//xu ly dang nhap
	if(isset($_POST['submit']))
	{
		$conn =  mysqli_connect('localhost','root','','mypham','3306') or die('Không thể kết nối  tới database'.mysqli_connect_error());
	mysqli_set_charset($conn,'UTF8');
		$username = $_POST['username'];
		$password = trim($_POST['password']);
		
		if(!$username || !$password)
		{
			echo "vui lòng nhập đầy đủ username và password. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit();
		}
		$password = md5($password);
		
		$query = "select * from tai_khoan where ID = '$username'" ;
		$r = mysqli_query($conn,$query);
		if(mysqli_num_rows($r) == 0)
		{
			echo "Tên đăng nhập không tồn tại<br>";
			echo '<button type="button" onclick="quay_lai_trang_truoc()">Quay lại</button>';
			
			exit();
		}
		$row = mysqli_fetch_array($r);
		if($password != $row['pass'])
		{
			echo "Mật khẩu không đúng<br>";
			echo '<button type="button" onclick="quay_lai_trang_truoc()">Quay lại</button>';
			
			exit();
		}

		$_SESSION['username'] = $username;
		if($row['role'] == 0)
		header("Location: index.php");
		else
			header("Location: admin/index.php");
	}
	?>
	<img  class = "wave" src="assets/img/login/wave.png">
	<div class="container">
		<div class="img">
			<img  src="assets/img/login/learn.svg">
		</div>
		<div class="login-container">
			<form action="" method="post">
				<img class="avatar" src="assets/img/login/avatar.svg">
				<h2>Xin chào</h2>
				<div class="input-div focus one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5>Username: </h5>
						<input type="text" name="username" class="input">
					</div>
				</div>
				<div class="input-div two">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5>Password: </h5>
						<input type="password" name="password" class="input">
					</div>
				</div>
				<a href="register.php">Đăng kí</a>
				<a href="#">Quên mật khẩu?</a>
				<input type="submit" name="submit" class="btn" value="Đăng nhập">
			</form>
		</div>
	</div>

</body>
</html>