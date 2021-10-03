<?php
session_start();
include("vt_settings.php");
error_reporting(0);

$myusername="";
$mypassword="";
$sql="";
$id="";

  mysqli_set_charset($conn ,'utf8'); //turkish character
  
if($_SERVER["REQUEST_METHOD"] == "POST") 
	{

      $myusername = $_POST['username'];
      $mypassword = str_replace('churn','', $_POST['pass']); 
      $mypassword = str_replace('CHURN','',$mypassword);
      
	if(is_numeric($mypassword)==false)
		{
			header("location:index.php");
			echo "<div class='auto-style1'>User Name and Password wrong!</div>";
		}
	$sql = sprintf("SELECT * FROM table WHERE Name = '%s' and Pass = %s",$myusername,$mypassword);

	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
		{
		$row = $result->fetch_assoc();
		$id =  $row["Pass"];
		$encodedId =  base64_encode($id);

		$_SESSION['username']= $row["ADSOYAD"];
		$_SESSION['last_login_timestamp']= time();
		$_SESSION['hastano']=$encodedId;
		$_SESSION['brans']=$row["BRANS"];
		
		$sql = sprintf("update table set LoginCorrect=1 WHERE Pass = %s",$mypassword);
		$result = $conn->query($sql);
		sleep(1);
		header("location:report.php");
		} 
	else 
		{
		echo "<div class='auto-style1'>User Name and Password wrong!</div>";
		}
	}

$conn->close();


?>

<!DOCTYPE html>
<html lang="tr">
<head>
<style type="text/css">
.auto-style1 {
	text-align: center;
	color: #F33B15;
	font-size: 20px
}
</style>
	<title>Kullanıcı Girişi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="tr" http-equiv="Content-Language">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div>
					<strong><h2 class="m-2 text-center" style="text-shadow:1px 1px 5px gray">Kullanıcı Girişi</h2></strong>
				</div>
				<form action = "" method = "post" class="login100-form p-l-55 p-r-55 p-t-178" style="left: 0px; top: 0px">
					<span class="login100-form-title">
					<img src="images/avatar-01.jpg"/>
						</span>
						<div class="wrap-input100 validate-input m-b-16" data-validate="username">
						<input class="input100" type="text" name="username" placeholder="Kullanıcı Adı">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "password">
						<input class="input100" type="password" name="pass" placeholder="Şifre">
						<span class="focus-input100"></span>
					</div>
					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
						<button class="login100-form-btn" style="height: 45px">
							Giriş Yap
						</button>
					<div class="container-login100-form-btn">
					</div>
							Kullanıcı Adı / Şifreyi
						</span>
						<a href="lost.php" onclick="goster()" class="txt2">
							Unuttum?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
