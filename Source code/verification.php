<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Verify your Email</title>
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/verification.css" rel="stylesheet">
	<style type="text/css">
		.btn>a {
			color: white;
			display: block;
			text-decoration: none;
		}
		a:link{
			text-decoration:none;
		}
		body {
			padding-bottom: 45px;
			background: rgba(189,195,199,0.2);
			font-family: 'Josefin Sans', sans-serif;
			text-rendering: optimizeLegibility;	
		}
	</style>
</head>
<body>
	<div class="container">
	<?php
		if(isset($_GET['email'])) {
			$email=$_GET['email'];
			$password=$_GET['password'];
			$last_name=$_GET['last_name'];
			$first_name=$_GET['first_name'];
			$connect=mysqli_connect('localhost','root','','question_bank');
			$query="SELECT * FROM verification WHERE email_id='$email'";
			$result=mysqli_query($connect,$query);
			$row=mysqli_fetch_assoc($result);
			if($row['password']==$password && $row['email_id']==$email) {
				mysqli_query($connect,"DELETE FROM verification WHERE email_id='$email'");
				$query1="INSERT INTO users(first_name,last_name,email_id,password)
				VALUES('$first_name','$last_name','$email','$password')";
				$result=mysqli_query($connect,$query1);
				echo '<center><h2>Your account is verified!</h2><br><button class="btn btn-primary"><a href="Login.php">Login</a></button></center>';
			} else {
				echo '<center><h2>Something went wrong !</h2></center>';
			}
		}
	?>
	</div>
	<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>