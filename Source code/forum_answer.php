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
			<h1>Forum <small>Answers</small></h1>
		</div>
	</div>
	<div class="container">
		<?php
			if(!isset($_GET['link']) && !isset($_POST['add'])) {
				header('location:forumhome.php');
			}
			$connect=mysqli_connect('localhost','root','','question_bank');
			$record=mysqli_query($connect,'SELECT title,time_added,description FROM forum_questions WHERE forum_id='.$_GET['link']);
			if($record==TRUE) {
				while($data=mysqli_fetch_assoc($record)) {
					$date = date_create($data['time_added']);
					echo '<div class="masterQ"><h3 class="form-addQ-heading"><p>'.html_entity_decode(htmlspecialchars_decode($data['title'],ENT_SUBSTITUTE),ENT_SUBSTITUTE).'</p> <small class="text-muted"> Asked on : '. date_format($date,"D j/M/y h:i:s") .'</small></h3><p> Description : '. $data['description'] .'</p></div><hr><h4 class="text-muted">Answers : </h4>';
				}
			}
		?>
	</div>
	<div class="container">	
		<div class="col-sm-8 col-md-8 col-lg-8">
			<?php
				$connect=mysqli_connect('localhost','root','','question_bank');
				// Get forum_id To display titles of forums ...
				if(!isset($_POST['add'])) {
					// for($i=1;;$i=$i+1) {
					// 	if($_GET['link']==$i) {
					// 		$_SESSION['forum_id']=$i;
					// 		break;
					// 	}
					// }
					$_SESSION['forum_id']=$_GET['link'];
				}

				// Add answer of the user first evaluate this than result will be displayed ...
				if(isset($_POST['add']) && isset($_SESSION['email_id'])) {
					// enter data of forum_answer into database
					mysqli_query($connect,"INSERT INTO forum_answer(user_id,forum_id,answer) VALUES ('$_SESSION[user_id]','$_SESSION[forum_id]','".htmlentities(htmlspecialchars($_POST['answer'],ENT_SUBSTITUTE),ENT_SUBSTITUTE)."')");
				} else if(isset($_POST['add']) && !isset($_SESSION['email_id'])) /* if person is not logged in than first log in ...*/{
					header('Location:Login.php');
				}

				// To show answers of various users ...
				$record=mysqli_query($connect,"SELECT user_id,answer FROM forum_answer WHERE forum_id=$_SESSION[forum_id] ORDER BY time_added DESC");
				$flag=0;
				if($record==TRUE) {
					echo '<div>';
					while($data=mysqli_fetch_assoc($record)) {
						$records=mysqli_query($connect,"SELECT first_name FROM users WHERE user_id=$data[user_id]");
						// fetch name of user by using user_id ...
						while($data1=mysqli_fetch_assoc($records)) {
							echo '<div class="panel panel-primary"><div class="panel-heading"><h4 class="panel-title">'.$data1['first_name'].'</h4></div><div class="panel-body">'.html_entity_decode(htmlspecialchars_decode($data['answer'],ENT_SUBSTITUTE),ENT_SUBSTITUTE).'</div></div>'; //answer_quantum
						}
						$flag=1;
					}
					echo '</div>';
				}
				if($flag==0)
					echo '<h4 class="form-addQ-heading">No answers available Yet !!</h4>';
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
					echo "<h3>No posts available !!</h3>";
				}
			?>
		</div>
	</div>
	<div class="container">
		<?php
			if (isset($_SESSION['email_id'])) {
				echo '<form class="from-horizontal" action="forum_answer.php?link='.$_GET['link'].'" method="POST">
						<div class="form-group">
							<label class="control-label">Add Your Answer : </label>
							<textarea class="form-control" name="answer" rows="6" required></textarea>
						</div>
						<div class="form-group">
							<input class="btn btn-primary" type="submit" name="add" value="Post">
						</div>
					</form>';
			} else {
				echo '<center><div class="container"><button class="btn btn-primary btn-lg"><a href="login.php">Login to Answer</a></button></div></center>';
			}
		?>
	</div>
	<div class="visible-xs btn-group col-xs-7">
		<?php if (isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button> &middot; <button class="btn btn-primary"><a href="login.php?logout=1">Sign out</a></button>'; } else { echo '<button class="btn btn-primary"><a href="login.php">Sign in</a></button> &middot; <button class="btn btn-primary"><a href="sign_up.php">Sign up</a></button>'; } ?>
	</div>
	<div class="footer container ">
		<ul class="nav nav-pills">
			<li><a href="home.php">Home</a></li>
			<li><a href="Dashboard.php">Dashboard</a></li>
			<li><a href="forumhome.php">Forum</a></li>
			<li class="active"><a href="forum_answer.php">Answers</a></li>
			<li><a href="forum_add_que.php">Add Question</a></li>
			<div class="pull-right btn-group nav">
				<?php if (isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button> &middot; <button class="btn btn-primary"><a href="login.php?logout=1">Sign out</a></button>'; } else { echo '<button class="btn btn-primary"><a href="login.php">Sign in</a></button> &middot; <button class="btn btn-primary"><a href="sign_up.php">Sign up</a></button>'; } ?>
			</div>
		</ul>
	</div>

<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery-2.2.1.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>

</body>
</html>