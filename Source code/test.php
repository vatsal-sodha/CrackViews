<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);

if (!isset($_SESSION['test'])) {
	unset($_SESSION['question']);
	unset($_SESSION['level']);
} else {
	if (isset($_SESSION['cur_id'])) {
		header('location:test1.php?id='.$_SESSION['cur_id']);		// to continue from the question from where tab was closed
	}
}

$connect=mysqli_connect('localhost','root','','question_bank');
 
if(isset($_GET['difficulty'])) {
	$level=$_GET['difficulty'];
	$_SESSION['level']=$level;
	$_SESSION['question']=array();

	switch($level) {
		case 1: 
		
		$query1="SELECT no_of_test_given_easy FROM users WHERE email_id='$_SESSION[email_id]'";
		$result1=mysqli_query($connect,$query1);
		$test=mysqli_fetch_assoc($result1);
		$no_of_test=$test['no_of_test_given_easy'];
		
		$query2="SELECT count(q_id) FROM question_easy";
		$result2=mysqli_query($connect,$query2);
		$test2=mysqli_fetch_assoc($result2);
		$no_of_que=$test2['count(q_id)'];
		
		if(($no_of_que)/10 == $no_of_test) {
			$no_of_test=0;
		}
		easy($no_of_test,10);
		
		break;
		
		case 2:
		
		$query1="SELECT no_of_test_given_medium FROM users WHERE email_id='$_SESSION[email_id]'";
		$result1=mysqli_query($connect,$query1);
		$test=mysqli_fetch_assoc($result1);
		$no_of_test=$test['no_of_test_given_medium'];
		
		$query2="SELECT count(q_id) FROM question_medium";
		$result2=mysqli_query($connect,$query2);
		$test2=mysqli_fetch_assoc($result2);
		$no_of_que=$test2['count(q_id)'];
		
		if(($no_of_que)/10 == $no_of_test){
			$no_of_test=0;
		}
		medium($no_of_test,10);
		
		break;
		
		case 3:
		
		$query1="SELECT no_of_test_given_hard FROM users WHERE email_id='$_SESSION[email_id]'";
		$result1=mysqli_query($connect,$query1);
		$test=mysqli_fetch_assoc($result1);
		$no_of_test=$test['no_of_test_given_hard'];
		
		$query2="SELECT count(q_id) FROM question_hard";
		$result2=mysqli_query($connect,$query2);
		$test2=mysqli_fetch_assoc($result2);
		$no_of_que=$test2['count(q_id)'];
		
		if(($no_of_que)/10 == $no_of_test){
			$no_of_test=0;
		}
		hard($no_of_test,10);
		
		break;
	}
}

function easy($no_of_test,$no_of_que) {
	for($i=1;$i<=$no_of_que;$i=$i+1)
	{
		$_SESSION['question'][$i]=($no_of_test*$no_of_que)+$i;
		echo $_SESSION['question'][$i].'<br/>';
	}
}

function medium($no_of_test,$no_of_que) {
	for($i=1;$i<=$no_of_que;$i=$i+1)
	{
		$_SESSION['question'][$i]=($no_of_test*$no_of_que)+$i;
		echo $_SESSION['question'][$i].'<br/>';
	}
}

function hard($no_of_test,$no_of_que) {
	for($i=1;$i<=$no_of_que;$i=$i+1)
	{
		$_SESSION['question'][$i]=($no_of_test*$no_of_que)+$i;
		echo $_SESSION['question'][$i].'<br/>';
	}
}
if (isset($_SESSION['question'])) {
	header('Location:test1.php');
}
?>
<!DOCTYPE html>
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
	<style type="text/css">
	#dif {
		position: absolute;
		top: 35%;
	}
	h1 {
		max-width: 250px;
		margin-left: -29px;
	}
	body {
		background-color: #eee;
		height: auto;
		-webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
			   	box-sizing: border-box;
		max-width: 250px;
		padding: 15px;
		margin: 0 auto;
	}
	</style>
</head>
<body>
	<?php if (isset($_GET['difficulty'])) {
		echo '<div class="container hidden" id="dif">';
		} else {
			echo '<div class="container" id="dif">';
		}
	?>
		<h1>Choose Difficulty</h1>
		<center>
			<div class="btn-group center-block">
				<button class="btn btn-primary"><a href="test.php?difficulty=1">Easy</a></button>
				<button class="btn btn-primary"><a href="test.php?difficulty=2">Medium</a></butto>
				<button class="btn btn-primary"><a href="test.php?difficulty=3">Hard</a></button>
			</div>
		</center>
	</div>
</body>
</html>