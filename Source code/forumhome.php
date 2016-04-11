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
	<link href="dist/css/sticky-footer.css" rel="stylesheet">
</head>
<body>
	<div class="jumbotron" id="top">
		<div class="container">
			<h1>Forum<small> Home</small></h1>
		</div>
	</div>
	<div class="container">
		<div class="col-sm-8 col-md-8 col-lg-8">
		<?php // To display all Questions ...	
			$connect=mysqli_connect('localhost','root','','question_bank');
			$record=mysqli_query($connect,"SELECT forum_id,time_added,title FROM forum_questions ORDER BY time_added DESC");
			$flag=0;
			// if user logged in and want to add question than directly
			if(isset($_POST['add_question']) && isset($_SESSION['email_id'])) {
				header('Location:forum_add_que.php');
			}/* else if (isset($_POST['add_question']) && !isset($_SESSION['email_id'])) {
				header('Location:Login.php');
			}*/
			if($record==TRUE) {
				echo '<h2>Open Threads</h2>';
				while($data=mysqli_fetch_assoc($record)) {
					$date = date_create($data['time_added']);
					echo '<div class="masterQ"><a href="forum_answer.php?link='.$data['forum_id'].'"><span class="glyphicon glyphicon-chevron-right"></span><b>'. html_entity_decode(htmlspecialchars_decode($data['title'],ENT_SUBSTITUTE),ENT_SUBSTITUTE) .'</b></a><p class="text-muted">Asked on : '. date_format($date,"D j/M/y h:i:s") .'</p></div>'; // Get method used 
					$flag=1;
				}
			}
			if ($flag==0) {
				echo "<h3>No posts available !!</h3>";
			}
		?>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<h3>Trending Threads</h3>
			<?php
				$connect=mysqli_connect('localhost','root','','question_bank');
				$record=mysqli_query($connect,"SELECT forum_id,time_added,title FROM forum_questions ORDER BY time_added DESC");
				$flag=0;
				if($record==TRUE) {
					echo '<ul class="list-group">';
					while($data=mysqli_fetch_assoc($record)) {
						$date = date_create($data['time_added']);
						echo '<li class="list-group-item"><a href="forum_answer.php?link='.$data['forum_id'].'"><span class="glyphicon glyphicon-chevron-right"></span>'. html_entity_decode(htmlspecialchars_decode($data['title'],ENT_SUBSTITUTE),ENT_SUBSTITUTE) .'</a></li>';
						$flag++;
						if($flag >= 6)
							break;
					}
					echo '</ul>';
				}
				if ($flag==0) {
					echo "<h3> No posts available !!</h3>";
				}
			?>
			<div><center><button class="btn btn-primary"><a href="#" data-toggle="tooltip" title="This functionality will be added soon">Closed Threads</a></button></center></div>
		</div>
	</div>
	<?php
		// to give option of add question to forum for users only ...
			if (isset($_SESSION['email_id'])) {
				echo '<center><div class="container"><form action="forumhome.php" method="post"><input class="btn btn-primary" type="submit" name="add_question" value="Add Question" ></form></div></center>';
			} else {
				echo '<center><div class="container"><button class="btn btn-primary btn-lg"><a href="login.php">Login to ask question</a></button></div></center>';
			}
		?>
	<div class="visible-xs btn-group col-xs-7">
		<?php if (isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button> &middot; <button class="btn btn-primary"><a href="login.php?logout=1">Sign out</a></button>'; } else { echo '<button class="btn btn-primary"><a href="login.php">Sign in</a></button> &middot; <button class="btn btn-primary"><a href="sign_up.php">Sign up</a></button>'; } ?>
	</div>
	<div class="footer container ">
		<ul class="nav nav-pills">
			<li><a href="home.php">Home</a></li>
			<li><a href="Dashboard.php">Dashboard</a></li>
			<li class="active"><a href="forumhome.php">Forum</a></li>
			<!-- <li><a href="forum_answer.php">Answers</a></li> -->
			<li><a href="forum_add_que.php">Add Question</a></li>
			<div class="pull-right btn-group nav">
				<?php if (isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button> &middot; <button class="btn btn-primary"><a href="login.php?logout=1">Sign out</a></button>'; } else { echo '<button class="btn btn-primary"><a href="login.php">Sign in</a></button> &middot; <button class="btn btn-primary"><a href="sign_up.php">Sign up</a></button>'; } ?>
			</div>
		</ul>
	</div>
	<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function () { $("[data-toggle='tooltip']").tooltip(); });
	</script>
</body>
</html>