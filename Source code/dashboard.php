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
	<link href="dist/css/croppie.css" rel="stylesheet">
	<script type="text/javascript" src="dist/js/croppie.js"></script>
	<style type="text/css">
	#drop {
		max-height: 40px;
		height: 100%;
		max-width: 400px;
		width: 100%;
		/*border: 1px groove rgba(0,0,0,0.5);
		border-radius: 5px;*/
	}
	/*body {
		max-width: 95%; 
		margin-left: 2.5%;
		margin-right: 2.5%;
	}*/
	</style>
	
</head>
<body id="top" style="padding-top: 60px;">
<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand active" href="profile.php"><span class="glyphicon glyphicon-user"></span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<!-- <li class="active"><a href="#">Home</a></li> -->
					<li><a href="home.php">Home</a></li>
					<li><a href="profile.php">Profile</a></li>
					<li class="active"><a href="dashboard.php">Dashboard</a></li>
					<li><a href="forumhome.php">Forum</a></li>
					<li><a href="leaderboard.php">Leaderboard</a></li>
				</ul>
				<div class="container-fluid btn-group pull-right">
					<?php if(isset($_SESSION['email_id'])) { echo '<button class="btn btn-primary navbar-btn" role="button"><a href="dashboard.php">'.$_SESSION['first_name'].'</a></button><button class="btn btn-primary navbar-btn" role="button"><a href="login.php?logout=1">Sign Out</a></button>';} else { echo '<button class="btn btn-primary navbar-btn" role="button"><a href="login.php">Sign In</a></button><button class="btn btn-primary navbar-btn" role="button"><a href="sign_up.php">Sign Up</a></button>';} ?>
				</div>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

<div class="container">
	<div class="modal fade" id="uploadmodal" tabindex="-1" role="dialog" aria-labelledby="uploadmodallabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="pull-right btn btn-primary" data-dismiss="modal">Close</button>
					<h4 class="modal-title" id="myModalLabel">Upload</h4>
				</div>
				<div class="modal-body">
					<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
						<center><h2>Select</h2></center>
						<div class="container" id="drop">
							<input type="file" class="form-control" name="upl" id="upl" multiple />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
	if (isset($_SESSION['email_id'])) {
		$flag=0;
		 $connect=mysqli_connect('localhost','root','','question_bank');
		 $record=mysqli_query($connect,"SELECT * FROM users WHERE email_id='$_SESSION[email_id]' ");//Add the get or post email id $email 
		$data=mysqli_fetch_assoc($record);
			$userid=$data["user_id"];
			$lastname=$data["last_name"];
			$firstname=$data["first_name"];
			$intro=$data['intro'];
			$totaltest=$data['no_of_test_given_easy']+$data['no_of_test_given_medium']+$data['no_of_test_given_hard'];
		echo '<div class="container">
				<div class="media">
					<button id="edit" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-pencil"></button>
						<div class="container">
							<div id="croppar" class="hidden">
								<div id="crop" class="pull-right container col-xs-12 col-sm-8 col-md-6 col-lg-4">
								</div>
								<form id="crp" class="form-inline" action="crop.php" method="POST">
									<center>
										<h3>Set image and click Crop !<br> You\'re Done!</h3>
										<input name="imagebase64" id="imagebase64" type="hidden">
										<button id="RC" class="btn btn-primary">Crop</button>
									</center>
								</form>
							</div>
						</div>
						<div class="pull-right">
							<a data-toggle="tooltip" data-placement="left" title="Click here to upload a new image.	refresh if image is faulty"><img id="DP" data-toggle="modal" data-target="#uploadmodal" class="pull-right media-object img-circle img-responsive" width="170" height="170" src="IMG/avtar-'.$_SESSION['email_id'].'.jpg"></a>
							</div>
						<div class="media-body">
							<h2 class="media-heading"><a href="dashboard.php">Welcome '.$firstname.'&nbsp;!!</a></h2>
							<div class="container-fluid"><b>&raquo;&nbsp;'.$intro.'</b><br></div>
						</div>
					</div>
				</div?';
		
		echo   '<div class="container row">
					<div class="col-xs-6 col-sm-3 col-md-6 col-ld-6">
						<h2 class="lead">Total Test Given : &nbsp;'.$totaltest.'</h2>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2"><div class="flatcard"><h3>Easy</h3>'.$data['no_of_test_given_easy'].'</div></div>
					<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2"><div class="flatcard"><h3>Medium</h3>'.$data['no_of_test_given_medium'].'</div></div>
					<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2"><div class="flatcard"><h3>Hard</h3>'.$data['no_of_test_given_hard'].'</div></div>
			  	</div>';

		$record=mysqli_query($connect,"SELECT * FROM exam WHERE u_id='$_SESSION[user_id]' ORDER BY time_started DESC");
		$count=mysqli_query($connect,"SELECT COUNT(e_id) AS NO FROM exam WHERE u_id='$_SESSION[user_id]' ORDER BY time_started DESC");
			if(mysqli_fetch_assoc($count)["NO"])
			{
				echo "<table class='table table-responsive table-hover'><th>Sr No.</th><th>Difficulty</th><th>Total Marks</th><th>Started at</th>";//<th>Time</th>
				for($i=1;$data=mysqli_fetch_assoc($record);$i++)
				{
					echo '<tr>
						  <td>'.$i.'</td>
						  <td>'.$data['difficulty'].'</td>
						  <td>'.$data['total_marks'].'</td>
						  <td>'.$data["time_started"].'</td>
						  </tr>';
				}	//<td>'.$data["marks_obtained"].'/'.$data['total_marks'].'</td> <td>'.$data["time_taken"].'</td>
				echo "</table>";
			} else {
				echo "<center>Select 'Start a Test' and see what you get here...</center>";
			}
			echo '<center><button class="btn btn-primary btn-lg"><a href="test.php">Start a test</a></button></center>';
	} else {
		echo '<div class="alert alert-danger"><center>Please Sign in First!</center></div>';
	}
?>
	</div>
	<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery-2.2.1.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function () { $("[data-toggle='tooltip']").tooltip(); });
		</script>
		<script type="text/javascript">
			var el = document.getElementById('crop');
			var elp = document.getElementById('croppar');
			var dp = document.getElementById('DP');
			// elp.className="hidden";
			var vanilla = new Croppie(el, {
						viewport: {
							width: 200,
							height: 200,
							type: 'sqaure'
						},
						boundary: {
							width: 300,
							height: 300
						},
						enableZoom: true,
						showZoomer: true,
						mouseWheelZoom: true,
						update: function (cropper) { }
					});
			$('#edit').on('click', function(ev) {
				if (elp.className == "hidden") {
					vanilla.bind('<?php echo "IMG/".$_SESSION['email_id'].".original.jpg" ?>');	
					elp.className="container";
					dp.className="hidden";
				} else {
					elp.className="hidden";
					dp.className="pull-right media-object img-circle img-responsive";
				}
			});
			$('#RC').on('click', function(ev) {
				vanilla.result({type:'canvas',size:'original',format:'jpeg'}).then(function (resp) {
					$('#imagebase64').val(resp);
					$('#crp').submit();
				});
			});
			$('#upl').on('change', function() {
				$('#upload').submit();
			});
		</script>
</body>
</html>