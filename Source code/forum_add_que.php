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
	<link href="dist/css/addQ.css" rel="stylesheet">
	<link href="dist/css/sticky-footer.css" rel="stylesheet">
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
		<form class="form-addQ form-horizontal" action='forum_add_que.php' method='POST'>
			<?php if (!isset($_SESSION['email_id'])) { echo '<div class="alert alert-warning"><center>Please sign in first!</center></div>'; } ?>
			<h2 class="form-addQ-heading" align="center">Fill up the details</h2><hr>
			<fieldset <?php if (!isset($_SESSION['email_id'])) { echo 'disabled'; } ?> >
				<div class="form-group">
					<label class="control-label col-xs-4 col-sm-4 col-md-3 col-lg-2">Title : </label>
					<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10">
						<input class="form-control" type="text"  name="title" required autofocus><span class="help-block"> Question title (in short) </span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-4 col-sm-4 col-md-3 col-lg-2">Description:</label>
					<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10">
						<textarea class="form-control"  name='description' rows="6" required></textarea><span class="help-block"> Question summary </span>
					</div>
				</div>
				<center>
					<div class="btn-group">
						<button class="btn btn-primary brn-lg center-block" type="submit" id="Submit" name="add" value="Add">Add</button>
						<button class="btn btn-primary brn-lg center-block" type="reset" id="Reset" name="Clear">Clear</button>
					</div>
				</center>
			</fieldset>
		</form>
	</div>

	<?php 
		if(isset($_POST['add'])) {
			$connect=mysqli_connect('localhost','root','','question_bank');
			// take user id of logged user
			$record=mysqli_query($connect,'SELECT user_id FROM users WHERE email_id="$_SESSION[email_id]"');
			if($record==TRUE) {
				while($data=mysqli_fetch_assoc($record)) {
					$uid=$data['user_id'];
				}
			}
			// enter data of forum_question into database 
			mysqli_query($connect,'INSERT INTO forum_questions(user_id,title,description) VALUES("$uid","'.htmlentities(htmlspecialchars($_POST['title'],ENT_SUBSTITUTE),ENT_SUBSTITUTE).'","'.htmlentities(htmlspecialchars($_POST['description'],ENT_SUBSTITUTE),ENT_SUBSTITUTE).'")');
			// Redirect to Forum_homepage
			header('Location:forumhome.php');
		}
	?>
	<div class="visible-xs btn-group col-xs-7">
		<?php if (isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button> &middot; <button class="btn btn-primary"><a href="login.php?logout=1">Sign out</a></button>'; } else { echo '<button class="btn btn-primary"><a href="login.php">Sign in</a></button> &middot; <button class="btn btn-primary"><a href="sign_up.php">Sign up</a></button>'; } ?>
	</div>
	<div class="footer container ">
		<ul class="nav nav-pills">
			<li><a href="home.php">Home</a></li>
			<li><a href="Dashboard.php">Dashboard</a></li>
			<li><a href="forumhome.php">Forum</a></li>
			<!-- <li><a href="forum_answer.php">Answers</a></li> -->
			<li class="active"><a href="forum_add_que.php">Add Question</a></li>
			<div class="pull-right btn-group nav">
				<?php if (isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button> &middot; <button class="btn btn-primary"><a href="login.php?logout=1">Sign out</a></button>'; } else { echo '<button class="btn btn-primary"><a href="login.php">Sign in</a></button> &middot; <button class="btn btn-primary"><a href="sign_up.php">Sign up</a></button>'; } ?>
			</div>
		</ul>
	</div>
<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>