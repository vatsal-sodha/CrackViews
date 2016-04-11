<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
session_start();
error_reporting(~E_ALL);
	if (!isset($_SESSION['level'])) {
		header('location:test.php');
	}
	if (isset($_GET['id'])) {
			$str = explode('-',$_GET['id']);
			$IDstr = $str[0];
			// echo $str[0]."  ".$str[1];
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

	<title>Test</title>
	<!-- Bootstrap core CSS -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">
	<link href="dist/css/test.css" rel="stylesheet">
	<link href="dist/css/flattimer.css" rel="stylesheet">
	<script src="dist/js/timer.js"></script>
</head>
<body id="top" style="padding-top: 60px;">
	<div class="container">
		<div class="flat-clock pull-right col-lg-2 col-md-3 col-sm-3 col-xs-6 <?php if (!isset($IDstr) || isset($_GET['submit'])) { echo 'hidden'; } ?>" id="flatclock">
			<span class="hours"></span>
			<span class="separator1">:</span>
			<span class="minutes"></span>
			<span class="separator2">:</span>
			<span class="seconds"></span>
		</div>
	</div>
<?php
	$connect=mysqli_connect('localhost','root','','question_bank');
	if(!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$no_of_questions=10;
	if(!isset($IDstr)) {
		 if (isset($_SESSION['cur_id']) && $_SESSION['cur_id']>0 ) {
		 	echo '<div class="container"><form method="get"><center><button class="btn btn-primary" type="submit" name="id" value='.$_SESSION['cur_id'].'>Continue Test</button></center></form></div>';
		 } else {
			echo '<div class="container"><form method="get"><center><button class="btn btn-primary" type="submit" name="id" value="1">Start Test</button></center></form></div><script type="text/javascript">eraseCookie(\'myClock\');</script>';
		 }
	}

	if(isset($IDstr) && $IDstr<=$no_of_questions && !isset($_GET['submit'])) {
		echo '<script type="text/javascript">initializeClock(\'flatclock\', endtime );</script>';
		echo '<form class="form-test" action="test1.php" method="get">';
		$_SESSION['test']=1;
 		$_SESSION['cur_id']=$IDstr;
 		// echo 'session(test)='.$_SESSION['test'].'  current id='.$_SESSION['cur_id'].'<br>';
		if ($IDstr > $no_of_questions) {
			$i=1;
		} else {
			$i=$IDstr;
		}
		$current_id=$_SESSION['question'][$i];
			// select table to retrive question
			if($_SESSION['level']==1)
 			{$query2="SELECT * FROM question_easy WHERE q_id='$current_id'";}
			else if($_SESSION['level']==2)
			{$query2="SELECT * FROM question_medium WHERE q_id='$current_id'";}
			else if($_SESSION['level']==3)
			{$query2="SELECT * FROM question_hard WHERE q_id='$current_id'";}

			$result2=mysqli_query($connect,$query2);
			$row2=mysqli_fetch_assoc($result2);
			echo '<div class="container">';
			echo '<h2 class="form-test-heading">Q:'.$i.'&nbsp;'.$row2['descript'].'</h2>.';
			if ($row2["option_a"]!= '' && $row2["option_a"]!= ' ' && $row2["option_a"]!= NULL) {
		  		echo '<div class="radio"><label><input type="radio" name="questions" value="a"'; if(isset($_SESSION["answer"][$i]) && $_SESSION["answer"][$i]=="a") { echo 'checked'; } echo '>'.$row2['option_a'].'</label></div>';
			}
			if ($row2["option_b"]!= '' && $row2["option_b"]!= ' ' && $row2["option_b"]!= NULL) {
		  		echo '<div class="radio"><label><input type="radio" name="questions" value="b"'; if(isset($_SESSION["answer"][$i]) && $_SESSION["answer"][$i]=="b") { echo 'checked'; } echo '>'.$row2['option_b'].'</label></div>';
			}
			if ($row2["option_c"]!= '' && $row2["option_c"]!= ' ' && $row2["option_c"]!= NULL) {
		  		echo '<div class="radio"><label><input type="radio" name="questions" value="c"'; if(isset($_SESSION["answer"][$i]) && $_SESSION["answer"][$i]=="c") { echo 'checked'; } echo '>'.$row2['option_c'].'</label></div>';
			}
			if ($row2["option_d"]!= '' && $row2["option_d"]!= ' ' && $row2["option_d"]!= NULL) {
		  		echo '<div class="radio"><label><input type="radio" name="questions" value="d"'; if(isset($_SESSION["answer"][$i]) && $_SESSION["answer"][$i]=="d") { echo 'checked'; } echo '>'.$row2['option_d'].'</label></div>';
			}
			echo '</div>';
		 $j=0;
		// $answers=array($no_of_questions);
		
		if($IDstr==1)
		{
			if (!isset($_SESSION['answer'])) {
				$_SESSION['answer']=array();
			}
		}
		
		if($IDstr>=1 && isset($_GET['questions']))
		{
			if (isset($str[1])) {
				if ($str[1]=='n') {
					$j=$IDstr-1;
				} elseif ($str[1]='p') {
					$j=$IDstr+1;
				}
			}
			if ($_GET['questions']=='a'||$_GET['questions']=='b'||$_GET['questions']=='c'||$_GET['questions']=='d') {
				$_SESSION['answer'][$j]=$_GET['questions'];
			}
			//echo $_SESSION['answer'][$j];
		}
		if($IDstr>=1 && !isset($_GET['questions']))
		{
			if (isset($str[1])) {
				if ($str[1]=='n') {
					$j=$IDstr-1;
				} elseif ($str[1]='p') {
					$j=$IDstr+1;
				}
			}
		}
		
		// if($j==count($_SESSION['question'])) // after taking last answer it will redirect to evaluate_exam page
		// {
		// 	header('Location:test1.php?id=-1');
		// }
			if($IDstr == 1)
			{
				echo '<ul class="pager">
							<li class="next"><button type="submit" name="id" value="'.($i+1).'-n">Next&rarr;</button></li>
						</ul>';
			}
			else if($IDstr<=$no_of_questions && $IDstr>1)
			{
				echo '<ul class="pager">
							<li class="previous"><button type="submit" name="id" value="'.($i-1).'-p">&larr;Previous</button></li>
							<li class="next"><button type="submit" name="id" value="'.($i+1).'-n">Next&rarr;</button></li>
						</ul>';
			}
			echo '<div class="container-fluid"><center><ul class="pagination">';
				for($k = 0;$k < $no_of_questions; $k++ ) {
					echo '<li><a href="test1.php?id='.($k+1).'">'.($k+1).'</a></li>';
			}
			echo '<li><a href="test1.php?id='.($no_of_questions+1).'">S</a></li></ul></center></div>';			
 }
if(isset($IDstr) && $IDstr==$no_of_questions+1 && !isset($_GET['submit']))
{
	echo '<script type="text/javascript">initializeClock("flatclock", endtime );</script>';
	// check that all answers are being set or not !!
	if($IDstr>=1 && isset($_GET['questions']))
		{
			if (isset($str[1])) {
				if ($str[1]=='n') {
					$j=$IDstr-1;
				} elseif ($str[1]='p') {
					$j=$IDstr+1;
				}
			}
			if ($_GET['questions']=='a'||$_GET['questions']=='b'||$_GET['questions']=='c'||$_GET['questions']=='d') {
				$_SESSION['answer'][$j]=$_GET['questions'];
			}
			//echo $_SESSION['answer'][$j];
		}
			$j=0;
			$unset=array();
			echo "<form action='evaluate_exam.php' method='get'><div class='container'><div class='page-header'><h3>Confirm Your Answers</h3></div>
					<table class='table table-resposive table-hover'>
					<thead>
					<tr><th>No.</th>
						<th>Your Answer</th>
					</tr>
					</thead>
					<tbody>";
			for($i=1;$i<=$no_of_questions;$i=$i+1)
			{
				if(isset($_SESSION['answer'][$i]))
				{
					echo '<tr class="info"><td><a href="test1.php?id='.$i.'">'.$i.'</td><td>'.$_SESSION['answer'][$i].'</td></tr>';
				}
				else
				{
					echo '<tr class="warning"><td><a href="test1.php?id='.$i.'">'.$i.'</td><td>NA</td></tr>';
					$unset[$j]=$i;
					$j=$j+1;
				}
			}
			echo '</tbody></table>';

			if($j!=0) {
				echo '<br/><div class="masterQ"><b style="color:red">Total ';
				if ($j==1) { echo $j.' is '; } else { echo $j.' are '; }
				echo 'remaining !!</b></div>';
			}
			echo '<div class="container-fluid"><center><ul class="pagination">';
				for($k = 0;$k < $no_of_questions; $k++ ) {
					echo '<li><a href="test1.php?id='.($k+1).'">'.($k+1).'</a></li>';
			}
			echo '<li><a href="test1.php?id='.($no_of_questions+1).'">S</a></li></ul></center></div>';
			echo '<button type="submit" class="btn btn-primary" name="submit">Submit</button></div>';
}
if(isset($_GET['submit']))
{
	header('Location:evaluate_exam.php');
}
echo '</form>';
?>
	<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery-2.2.1.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		// $('.hours').on('change', function() {

		// });
		// $('.minutes').on('change', function() {
		// 	var val = $('.minutes').innerHTML;
		// 	$('input[name="minutes"]').value(19-parseInt(val));
		// });
		// $('.seconds').on('change', function() {
		// 	var val = $('.seconds').innerHTML;
		// 	$('input[name="seconds"]').value(59-parseInt(val));
		// });
	</script>
</body>
</html>