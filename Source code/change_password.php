<?php 
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);
if(!isset($_SESSION['mail']))
{
	header('Location:Login.php');
}
?>
<html lang="en">
<head>
	<!-- metadata -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Change Password</title>
	<!-- Bootstrap core CSS -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">
	<link href="dist/css/changepw.css" rel="stylesheet">
	<!-- <script type="text/javascript" src="dist/d3/d3.js"></script> -->
	<script type="text/javascript">
	var pwv=false;
	var conpwv=false;
		function validatepw() {
			var pw = document.getElementById('pw');
			var parent = document.getElementById('pwdiv');
			var span = document.getElementById('pwspan');
			var help = document.getElementById('pwhelp');
			if(pw.value.length < 8 || pw.value.length > 15) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				pwv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				pwv = true;
			}
		}
		function confirmpw() {
			var pw = document.getElementById('pw').value;
			var con_pw = document.getElementById('con_pw').value;
			var parent = document.getElementById('con_pwdiv');
			var span = document.getElementById('con_pwspan');
			var help = document.getElementById('conpwhelp');
			// alert("pw : "+pw+" con_pw : "+con_pw);
			if(pw != con_pw || pw.length == 0) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				conpwv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				conpwv = true;
			}
		}
		function Final() {
			var flag = true;
			if(pwv==false) {
				flag = false;
				validatepw();
				document.getElementById('fn').focus;
			}
			if(conpwv==false) {
				flag = false;
				confirmpw();
				document.getElementById('fn').focus;
			}
			return flag;
		}
	</script>

	<style type="text/css">
	.btn>a {
		color: white;
		display: block;
		text-decoration: none;
	}
	</style>
</head>
<body>

	<div class="conatiner">
		<?php 
		if(isset($_GET['email'])) {
			$email=$_GET['email'];
			$password=$_GET['password'];
			$user_id=$_GET['user_id'];
			$last_name=$_GET['last_name'];
			$first_name=$_GET['first_name'];
			$_SESSION['mail']=$email;
			//echo $email." ".$password." ".$user_id." ".$first_name." ".$last_name;
			$connect=mysqli_connect('localhost','root','','question_bank');
			$query="SELECT * FROM verification WHERE email_id='$email'";
			$result=mysqli_query($connect,$query);
			$row=mysqli_fetch_assoc($result);
			if($row['password']==$password && $row['email_id']==$email) {	
					echo '<form class="form-changepw form-horizontal" action="change_password.php"  method="POST">
						<center><h2 class="form-changepw-heading">Enter new password</h2></center><fieldset';
					if(isset($_SESSION['email_id'])) { echo '<div class="alert alert-warning"><center>Please sign out first !!</center></div>'; }
					if(isset($_SESSION['email_id'])) { echo 'disabled'; }
					echo '><div id="pwdiv" class="form-group has-feedback">
							<label class="sr-only" for="Password">Password : </label>
								<input type="password" name="password" id="pw" class="form-control" onkeyup="validatepw(),confirmpw()" placeholder="Password" required><span id="pwspan" class="form-control-feedback glyphicon"></span><span class="help-block text-muted"><small>Password must be 8 to 15 characters long</small></span>
						</div>
						<div id="con_pwdiv" class="form-group has-feedback">
							<label class="sr-only" for="Con_password">Confirm Password : </label>
								<input type="password" name="con_pw" id="con_pw" class="form-control" onkeyup="confirmpw(),validatepw()" placeholder="Retype password" requiredx><span id="con_pwspan" class="form-control-feedback glyphicon"></span><span class="help-block text-muted"><small>Passwords must match</small></span>
						</div>
						<center>
							<div class="form-group btn-group">
								<button class="btn btn-primary brn-lg center-block" type="submit" id="Submit" name="done_change_password">Submit</button>
								<button class="btn btn-primary brn-lg center-block" type="reset" id="Reset" name="Clear" onclick="confirmpw(),validatepw()">Clear</button>
							</div>
						</center>
						</fieldset>
					</form>';
			} /*else {
				header('Location:Login.php');
			}*/
		} else if(isset($_POST['done_change_password'])) {
				$email=$_SESSION['mail'];
				$password=$_POST['password'];
				$connect=mysqli_connect('localhost','root','','question_bank');
				$result=mysqli_query($connect,"UPDATE users SET password='$password' WHERE email_id='$email'");
				if($result==TRUE) {
					mysqli_query($connect,"DELETE FROM verification WHERE email_id='$email'");
					include('mail.php');
					$subject="Password Changed Successfully";
					$message=conformation();
					$mail_send=sendmail($email,$subject,$message,$first_name);
					for($i = 0; $mail_send != 1 && $i < 10; $i++) {
						$mail_send=sendmail($email,$subject,$message,$first_name);
					}
					if ($mail_send == 1) {
						echo '<div class="alert alert-info">Link has been sent to your email address!</div>';
					} else {
						echo '<div class="alert alert-info">Sorry! Link can\'t be sent right now! Please try again later...</div>';
					}
					unset($_SESSION['mail']);
					header('Location:login.php?id=pwreset');
				}
			}
		?>
	</div>
</body>
</html>