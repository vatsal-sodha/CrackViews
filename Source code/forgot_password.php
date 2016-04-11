<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);
?>
<html lang="en">
<head>
	<!-- metadata -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>CrackViews</title>
	<!-- Bootstrap core CSS -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">
	<link href="dist/css/forgot.css" rel="stylesheet">
	<!-- <script type="text/javascript" src="dist/d3/d3.js"></script> -->

	<style type="text/css">
	.btn>a {
		color: white;
		display: block;
		text-decoration: none;
	}
	body {
		font-family: 'Josefin Sans', sans-serif;
	}
	</style>
</head>
<body>
	<div class="container">
	<?php 	include('mail.php');
			include('message.php');

	if (isset($_GET['id'])){
		if($_GET['id']=='forgot_password') {
			echo '<form class="form-forgot" action="forgot_password.php" method="POST">
				<center><h2 class="form-forgot-heading">Forgot password?</h2>
				<p class="text-muted">Enter your email below</p></center>
				<div class="form-group">
					<label class="sr-only"> Email </label><input class="form-control" type="email" id="email" name="email_id" placeholder="Email here.." required>
				</div>
				<button class="btn btn-primary form-control" type="submit" name="forgot_password" id="forgot_password">Send link</button>
				</form>';
		}
	}
	if(isset($_POST['forgot_password'])) {
		$mail = new PHPMailer(); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, wordwrap(str)hich we need to catch

		$connect=mysqli_connect('localhost','root','','question_bank');
		$email=$_POST['email_id'];
			//Verifying that email id entered is already users or not
			
		$result=mysqli_query($connect,"SELECT * FROM users WHERE email_id='$email'");
		$rowCount=mysqli_num_rows($result);
		$row=mysqli_fetch_assoc($result);
		if($rowCount==1){
			$password=$row['password'];
			$last_name=$row['last_name'];
			$user_name=$row['first_name'];
			$subject='Change Password';
			$link='http://localhost/amoc/change_password.php?email='.$email.'&password='.$password.'&first_name='.$user_name.'&last_name='.$last_name;
			$message=password($user_name,$link);
			$mail_send=sendmail($email,$subject,$message,$user_name);
			for($i = 0; $mail_send != 1 && $i < 10; $i++) {
				$mail_send=sendmail($email,$subject,$message,$user_name);
			}
			if ($mail_send == 1) {
				mysqli_query($connect,"INSERT INTO verification(email_id,password)
				VALUES('$email','$password') ");
				$_SESSION['mail']=$email;//For resending the link
				echo '<div class="alert alert-info"><center>Link has been sent to your email address!</center></div>';
			} else {
				echo '<div class="alert alert-info"><center><p>Sorry! Link can\'t be sent right now! Please try again later...</p></center></div>';
			}
		} else if ($rowCount==0) {
			echo '<div class="alert alert-info"><center>This email is not registered !</center></div>';
			echo '<div class="alert alert-info"><center><a href="sign_up.php">Please register first!</a></center></div>';
		}
	}
	if($_GET['id']=='resend'){
		$email=$_SESSION['mail'];
		$connect=mysqli_connect('localhost','root','','question_bank');
		$result=mysqli_query($connect,"SELECT * FROM users WHERE email_id='$email'");
		$rowCount=mysqli_num_rows($result);
		$row=mysqli_fetch_assoc($result);
		if($rowCount==1){
			$password=$row['password'];
			$user_id=$row['user_id'];
			$last_name=$row['last_name'];
			$user_name=$row['first_name'];
			//include('mail.php');
			//include('message.php');
			$subject='Change Password';
			$link='http://localhost/amoc/change_password.php?email='.$email.'&password='.$password.'&user_id='.$user_id.'&first_name='.$user_name.'&last_name='.$last_name;
			$message=password($user_name,$link);
			$mail_send=sendmail($email,$subject,$message,$user_name);
			for($i = 0; $mail_send != 1 && $i < 10; $i++) {
			$mail_send=sendmail($email,$subject,$message,$user_name);
			}
			if ($mail_send == 1) {
				mysqli_query($connect,"INSERT INTO verification(email_id,password)
				VALUES('$email','$password') ");
				$_SESSION['mail']=$email;//For resending the link
				echo '<div class="alert alert-info"><center>Link has been sent to your email address!</center></div>';
			} else {
				echo '<div class="alert alert-info"><center>Sorry! Link can\'t be sent right now! Please try again later...</center></div>';
			}
		} else {
			echo '<div class="alert alert-danger"><center>Server is Down! We apologize for your inconviniency! Try again later.</center><div class="hidden">'.$mail->ErrorInfo.'</div></div><center><button class="btn btn-primary"><a href="login.php">Sign In</a></button></center>';
		}
	}
	?>
	</div>
</body>
</html>