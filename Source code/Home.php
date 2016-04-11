<?php 
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);
if (isset($_POST['email_id'])) {
	$_SESSION['email_id'] = $_POST['email_id'];
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

	<title>CrackViews</title>
	<!-- Bootstrap core CSS -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">
	<!-- <script type="text/javascript" src="dist/d3/d3.js"></script> -->

</head>

<body  data-target="#myScrollSpy" data-offset="120" style="padding-bottom: 20px;">

	<!-- Jumbotron 
	============================================== -->
	<div class="jumbotron" id="top">
		<div class="container">
			<h1>CrackViews<small><small class="hidden-xs pull-right">Your Crack Tool</small></small></h1>
		</div>
	</div><!-- /jumbotron -->

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
					<li class="active"><a href="#top">Home</a></li>
					<li><a href="Profile.php">Profile</a></li>
					<li><a href="Dashboard.php">Dashboard</a></li>
					<li><a href="forumhome.php">Forum</a></li>
					<!-- <li><a href="#Feat">Features</a></li> -->
					<li><a href="leaderboard.php">Leaderboard</a></li>
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
	
	<!-- Carousel
	================================================== -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img class="first-slide" src="dist/img/carousel1.jpg" alt="First slide">
				<div class="container">
					<div class="carousel-caption">
						<!-- <h1>Create an account</h1>
						<p>Register youself by filling a simple form and get access to our services for free. So,</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today!</a></p> -->
					</div>
				</div>
			</div>
			<div class="item">
				<img class="second-slide" src="dist/img/carousel2.jpg" alt="Second slide">
				<div class="container">
					<div class="carousel-caption">
						<!-- <h1>Built up Sharpness</h1>
						<p>With our variety of specially structured tests for - students,employees - do a lot practice and track your progress.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Start a Test...</a></p> -->
					</div>
				</div>
			</div>
			<div class="item">
				<img class="third-slide" src="" alt="Third slide">
				<div class="container">
					<div class="carousel-caption">
						<h1>Have a look at your Dashboard</h1>
						<p>See the Dashboard we've built for you. Also, Add up something you like.</p>
						<p><a class="btn btn-lg btn-primary" href="dashboard.php" role="button">Your Dashboard &raquo;</a></p>
					</div>
				</div>
			</div>
			<div class="item">
				<img class="fourth-slide" src="" alt="Fourth slide">
				<div class="container">
					<div class="carousel-caption">
						<h1>Our future plan</h1>
						<p>To provide a virtual platform to companies for conducting interviews from away</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Join & Donate!</a></p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div><!-- /.carousel -->

	<div class="jumbotron">
		<div class="container">
			<h1>Cracking Interviews <small> was never this easy!</small></h1>
			<p>with our huge <strong>Question Database</strong> and <strong>Detailed Guidelines</strong><br>sharpen your mind with lots of practice.</p>
		</div>
	</div><!-- /jumbotron -->
	
	<!-- Page 
	============================================= -->
	<!-- START THE FEATURETTES -->

	<hr class="featurette-divider" id="Feat">

	<div class="container" style="margin-top: 80px">
		<div class="row featurette">
			<div class="col-md-7 col-lg-7">
				<h2 class="featurette-heading">Our Huge Question Database.<span class="text-muted">It'll blow your mind.</span></h2>
					<p class="lead">We've specialy picked questions in our Database. Well organised and divided in classes.</p>
			</div>
			<div class="col-md-5 col-lg-5">
				<?php
				$connect=mysqli_connect('localhost','root','','question_bank');

				$USR = mysqli_query($connect,"SELECT COUNT(user_id) AS total FROM users");
				$data=mysqli_fetch_assoc($USR);

				$easyQue = mysqli_query($connect,"SELECT COUNT(q_id) AS easyQue FROM question_easy");
				$eaq=mysqli_fetch_assoc($easyQue);

				$mediumQue = mysqli_query($connect,"SELECT COUNT(q_id) AS mediumQue FROM question_medium");
				$meq=mysqli_fetch_assoc($mediumQue);

				$hardQue = mysqli_query($connect,"SELECT COUNT(q_id) AS hardQue FROM question_hard");
				$haq=mysqli_fetch_assoc($hardQue);

				$total = $eaq['easyQue']+$meq['mediumQue']+$haq['hardQue'];

				echo'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="flatcard"><h3>Total Users</h3>'.$data['total'].'</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="flatcard"><h3>Total Questions</h3>'.$total.'</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="flatcard"><h3>Easy</h3>'.$eaq['easyQue'].'</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="flatcard"><h3>Medium</h3>'.$meq['mediumQue'].'</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="flatcard"><h3>Hard</h3>'.$haq['hardQue'].'</div>
					</div>';
				?>
			</div>
		</div>

		<hr class="featurette-divider" id="Rank">

		<div class="row featurette">
			<div class="col-md-7 col-md-push-5">
				<h2 class="featurette-heading">And lastly, this one.<br /><span class="text-muted">Global Rankings.</span></h2>
				<p class="lead">We've assigned XP's to every activity you do on website and it'll add up incresing your rank. of cource, it is based on your performance. Get the inspiration to Top.</p>
			</div>
			<div class="col-md-5 col-md-pull-7">
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
						$query = "SELECT SUM(difficulty*total_marks) AS xp,u_id FROM exam GROUP BY u_id ORDER BY xp DESC";
						$result=mysqli_query($connect,$query);

						while($row=mysqli_fetch_assoc($result)) {
							$user_id=$row['u_id'];
							$query1=mysqli_query($connect,"SELECT first_name,last_name FROM users WHERE user_id='$row[u_id]'");
							$row2=mysqli_fetch_assoc($query1);
							$first_name=$row2['first_name'];
							$last_name=$row2['last_name'];
							
							echo '<tr>';
							echo '<td>'.$first_name.'</td>';
							echo '<td>'.$last_name.'</td>';
							echo '<td>'.$user_id.'</td>';
						}
						mysqli_close($connect);
					?>
					</tbody>
				</table>
			</div>
		</div>

		<hr class="featurette-divider" id="SA">

		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
				<p class="lead">We've built an basic Dashboard for you with many add-ons to make it look more private and attractive.</p>
				</div>
			<div class="container col-md-5">
				<svg class="svg-responsive"></svg>
			</div>
		</div>


		<hr class="featurette-divider">

		<!-- /END THE FEATURETTES -->

		<!-- FOOTER -->
		<footer>
			<p class="pull-right">
			<?php
				if(isset($_SESSION['email_id'])) {
					echo '<a href="login.php?logout=1">Sign out</a>';
				} else {
					echo '<a href="login.php">Sign in</a>';
				}
			?> &middot; <a href="#">Back to top</a></p>
			<p>&copy; CrackViews, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
		</footer>

	</div><!-- /.container -->



	<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>