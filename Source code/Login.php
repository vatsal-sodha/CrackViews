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

	<title>Sign In</title>
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/signin.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
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
		<form class="form-signin" action="Login.php" method="POST">
			<?php 
			if(isset($_SESSION['email_id']) && !isset($_POST['logout']) && !isset($_GET['logout'])) { echo '<h2 class="form-signin-heading" align="center">'.$_SESSION['first_name'].'&nbsp;'.$_SESSION['last_name'].'</h2>'; } else { echo '<h2 class="form-signin-heading" align="center">Please sign in</h2>'; } ?>

			<img class="img-responsive img-circle center-block" width="170" height="170" <?php if(isset($_SESSION['email_id']) && !isset($_POST['logout']) && !isset($_GET['logout'])) { echo 'alt="user_dp" src="IMG/avtar-'.$_SESSION['email_id'].'.jpg"'; } ?> >

			<fieldset <?php if(!isset($_SESSION['email_id']) || isset($_POST['logout']) || isset($_GET['logout'])) { echo 'hidden'; } ?> >
				<button class="btn btn-primary btn-block btn-lg"><a href="login.php?logout=1">Sign out</a></button>
				<button class="btn btn-primary btn-block btn-lg"><a href="home.php">Home</a></button>
				<button class="btn btn-primary btn-block btn-lg"><a href="dashboard.php">Dashboard</a></button>
			</fieldset>
			<fieldset <?php if(isset($_SESSION['email_id']) && !isset($_POST['logout']) && !isset($_GET['logout'])) { echo 'hidden'; } ?> >
				<label for="inputEmail" class="sr-only">Email address</label>
					<input type="email" id="emid" name="email_id" class="form-control" placeholder="Email address" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="cookiecheck" value="remember-me" disabled> Remember me
				</label>
				<?php if(!isset($_SESSION['email_id']) && !isset($_POST['logout']) && !isset($_GET['logout'])) { echo '<a href="forgot_password.php?id=forgot_password" class="pull-right">Forgot Password?</a>'; } ?>
			</div>
			<?php #error_reporting(E_ALL & ~E_NOTICE);
				if (isset($_SESSION['user_id']) && !isset($_SESSION['email_id'])) {
					unset($_SESSION['user_id']);
					echo '<div class="alert alert-success"><center>You are logged Out !!</center></div>';
				}

				$flag=0;
				if (isset($_POST['submit'])) {
					$connect=mysqli_connect('localhost','root','','question_bank');
					if(isset($_POST['email_id'])) {
						if ($_POST['email_id'] != '') {
							$record=mysqli_query($connect,"SELECT first_name,last_name,user_id,password FROM users WHERE email_id='$_POST[email_id]'");
							if($record==TRUE) {
								$data=mysqli_fetch_assoc($record);
								if ($data != '') {
									if($_POST['password']==$data['password']) {
										$_SESSION['email_id']=$_POST['email_id'];
										$_SESSION['first_name']=$data['first_name'];
										$_SESSION['last_name']=$data['last_name'];
										$_SESSION['user_id']=$data['user_id'];
										$flag=1;
										header('Location:dashboard.php');
									} else {
										echo '<div class="alert alert-danger"><center> Your email password combination is wrong !!'.$_SESSION['email_id'].'</center></div>';
									}
								} else {
									echo '<div class="alert alert-danger"><center> Please Register First !!</center></div>';
								}
							} else {
								echo 'Server is Down! We apologize for your inconviniency! Try again later.';
							}
						}
					}
				}
				// after signup message
				if ($_GET['id']=='success') {
					echo '<div class="alert alert-success"><center>You registered successfully!</center></div>';
				}
				// after logout message
				if(isset($_POST['logout'])) {
					unset($_SESSION['email_id']);
					unset($_SESSION['first_name']);
					unset($_SESSION['last_name']);
					unset($_SESSION['user_id']);
					echo '<div class="alert alert-success"><center>You are logged Out !!</center></div>';
				}
				if (isset($_GET['logout'])) {
					unset($_SESSION['email_id']);
					unset($_SESSION['first_name']);
					unset($_SESSION['last_name']);
					unset($_SESSION['user_id']);
					header('location:login.php');
				}
				// after password reset message
				if ($_GET['id']=='pwreset') {
					echo '<div class="alert alert-success"><center>Password successfully changed !!</center></div>';
				}
			?>
			<button class="form-control btn btn-lg btn-primary btn-block" type="submit" name="submit" >Sign in</button>
			<button class="form-control btn btn-lg btn-primary btn-block" name="signup"><a href="sign_up.php" >Click for Registration</a></button>
		</form>
	</div> <!-- /container -->

	<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery-2.2.1.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>