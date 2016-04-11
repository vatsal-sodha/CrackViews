<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);
if (!isset($_SESSION['email_id'])) {
	header('location:login.php');
}
$connect=mysqli_connect('localhost','root','','question_bank');
if(!$connect)
{
	die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT SUM(difficulty*total_marks) AS xp,u_id FROM exam GROUP BY u_id ORDER BY xp DESC LIMIT 50";
$result=mysqli_query($connect,$query);
	
?>
<html lang="en">
<head>
	<!-- metadata -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Leaderboard</title>
	<!-- Bootstrap core CSS -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">
	<!-- <script type="text/javascript" src="dist/d3/d3.js"></script> -->

	<style type="text/css">
	</style>
</head>

<body>
<!-- Fixed navbar -->
	<nav id="myScrollSpy" class="navbar navbar-inverse" data-spy="affix" data-offset-top="100" style="margin-bottom: 0;z-index: 50;border-radius: 0">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#top"><span class="glyphicon glyphicon-home"></span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="home.php">Home</a></li>
					<li><a href="Profile.php">Profile</a></li>
					<li><a href="Dashboard.php">Dashboard</a></li>
					<li><a href="forumhome.php">Forum</a></li>
					<li class="active"><a href="#">Leaderboard</a></li>
				</ul>
				<div class="container-fluid btn-group pull-right">
					<?php
					if(isset($_SESSION['email_id'])) {
						echo '<button class="btn btn-primary navbar-btn" role="button"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button><button class="btn btn-primary navbar-btn" role="button"><a href="login.php?logout=1">Sign Out</a></button>';
						} else {
							echo '<button class="btn btn-primary navbar-btn" role="button"><a href="login.php">Sign In</a></button><button class="btn btn-primary navbar-btn" role="button"><a href="sign_up.php">Sign Up</a></button>';
						} 
					?>
				</div>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">
 <table class="table table-striped table-responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Last_name</th>
					<th>XPs</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while($row=mysqli_fetch_assoc($result)) {
					$user_id=$row['u_id'];
					$query1=mysqli_query($connect,"SELECT first_name,last_name from users where user_id=$user_id");
					$row2=mysqli_fetch_assoc($query1);
					$first_name=$row2['first_name'];
					$last_name=$row2['last_name'];
					
					echo '<tr>';
					echo '<td>'.$first_name.'</td>';
					echo '<td>'.$last_name.'</td>';
					echo '<td>'.$user_id.'</td>';
				}
				echo '</table>';
				mysqli_close($connect);
			?>
			</tbody>
		</table>
		</div>		
<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
		
</body>
</html>