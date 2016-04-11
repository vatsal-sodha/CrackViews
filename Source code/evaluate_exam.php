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

	<title>Result</title>
	<!-- Bootstrap core CSS -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">
</head>
<body id="top" style="padding-top: 60px;">
<?php
if (isset($_SESSION['test'])) {
	unset($_SESSION['test']);
	unset($_SESSION['cur_id']);
// print all answers
//for($i=1;$i<=3;$i=$i+1)
//echo $_SESSION['answer'][$i];

	if(!isset($_SESSION['email_id'])) {
		header('Location:Login.php');
	}
	$connect=mysqli_connect('localhost','root','','question_bank');
	
	$no_of_que=10;
	
	if($_SESSION['level']==1)
	{
		
			$query2="SELECT count(q_id) FROM question_easy";
			$result2=mysqli_query($connect,$query2);
			$test2=mysqli_fetch_assoc($result2);
			$no_of_que1=$test2['count(q_id)'];
			
			
			$record=mysqli_query($connect,"SELECT no_of_test_given_easy FROM users where email_id='$_SESSION[email_id]'");
			$data=mysqli_fetch_assoc($record);
			
			if(($no_of_que1)/10 == $data['no_of_test_given_easy'])
			{
				$no_of_test_given_easy=1;
			}
			else
			$no_of_test_given_easy=$data['no_of_test_given_easy']+1;  // update no. of test given by increment value by 1
		
			mysqli_query($connect,"UPDATE users SET no_of_test_given_easy=$no_of_test_given_easy where email_id='$_SESSION[email_id]'");
			$q_id=$no_of_test_given_easy-1;
			$record1=mysqli_query($connect,"SELECT answer,q_rank FROM question_easy where q_id>($q_id*$no_of_que) AND q_id<=(($q_id+1)*$no_of_que)");
	}
	else if($_SESSION['level']==2)
	{
			$query2="SELECT count(q_id) FROM question_medium";
			$result2=mysqli_query($connect,$query2);
			$test2=mysqli_fetch_assoc($result2);
			$no_of_que1=$test2['count(q_id)'];
			
			
			$record=mysqli_query($connect,"SELECT no_of_test_given_medium FROM users where email_id='$_SESSION[email_id]'");
			$data=mysqli_fetch_assoc($record);
			if(($no_of_que1)/10 == $data['no_of_test_given_medium'])
			{
				$no_of_test_given_medium=1;
			}
			else
			$no_of_test_given_medium=$data['no_of_test_given_medium']+1; // update no. of test given by increment value by 1
		
			mysqli_query($connect,"UPDATE users SET no_of_test_given_medium=$no_of_test_given_medium where email_id='$_SESSION[email_id]'");
			$q_id=$no_of_test_given_medium-1;
			$record1=mysqli_query($connect,"SELECT answer,q_rank FROM question_medium where q_id>($q_id*$no_of_que) AND q_id<=(($q_id+1)*$no_of_que)");
	}
	else if($_SESSION['level']==3)
	{
			$query2="SELECT count(q_id) FROM question_medium";
			$result2=mysqli_query($connect,$query2);
			$test2=mysqli_fetch_assoc($result2);
			$no_of_que1=$test2['count(q_id)'];
			
			
		$record=mysqli_query($connect,"SELECT no_of_test_given_hard FROM users where email_id='$_SESSION[email_id]'");
		$data=mysqli_fetch_assoc($record);
		
		if(($no_of_que1)/10 == $data['no_of_test_given_hard'])
			{
				$no_of_test_given_hard=1;
			}
		else
		$no_of_test_given_hard=$data['no_of_test_given_hard']+1; 	// update no. of test given by increment value by 1
	
		mysqli_query($connect,"UPDATE users SET no_of_test_given_hard=$no_of_test_given_hard where email_id='$_SESSION[email_id]'");
		$q_id=$no_of_test_given_hard-1;
		$record1=mysqli_query($connect,"SELECT answer,q_rank FROM question_hard where q_id>($q_id*$no_of_que) AND q_id<=(($q_id+1)*$no_of_que)");
	}
	// mysqli_query($connect,"INSERT INTO exam VALUES('')")
	$sum=0;
	$i=1;
	
	// Create Result table ...
	echo "<div class='container'><div class='page-header'><center><b><h1>Result</h1></b></center></div>";
			// $time=$_POST['hours'].":".$_POST['minutes'].":".$_POST['seconds'];
			// echo "<div class='pull-right'>Time taken : ".$time."</div>";
	echo "
	<table class='table table-responsive table-hover'>
	<thead>
	<tr><th>No.</th>
        <th>Your Answer</th>
        <th>Correct Answer</th>
		<th>Marks obtained</th>
	</tr>
	</thead>
	<tbody>";
	while($data1=mysqli_fetch_assoc($record1))
	{
		if(isset($_SESSION['answer'][$i]))
		{
			if($_SESSION['answer'][$i]==$data1['answer'])
			{
				$sum=$sum+$data1['q_rank'];
				echo '<tr class="success"><td>'.$i.'</td><td>'.$_SESSION['answer'][$i].'</td><td>'.$data1['answer'].'</td><td>'.$data1['q_rank'].'</td>';
			}
			else
			{
				echo '<tr class="danger"><td>'.$i.'</td><td>'.$_SESSION['answer'][$i].'</td><td>'.$data1['answer'].'</td><td>0</td>';
			}
			
		}
		else
		{
			echo '<tr class="danger"><td>'.$i.'</td><td>NA</td><td>'.$data1['answer'].'</td><td>0</td>';
		}
		$i=$i+1;
	}
	//echo 'Total marks is : '.$sum;
		echo '<tr class="info"><td colspan="3">Total Marks</td><td>'.$sum.'</td></tr></tbody></table></div>';
		//$j=count($_SESSION['answer']);
		//$k=count($_SESSION['question']);
		//for($i=1;$i<$j;$i=$i+1)
		// fill out exam table
		

		$record=mysqli_query($connect,"SELECT user_id FROM users WHERE email_id='$_SESSION[email_id]'");
		$data = mysqli_fetch_assoc($record);
		$user_id = $data['user_id'];

		$record=mysqli_query($connect,"SELECT total_marks FROM exam WHERE u_id=$user_id AND difficulty='$_SESSION[level]'");
		$data = mysqli_fetch_assoc($record);
		// if ($data['total_marks']==NULL) {
			mysqli_query($connect,"INSERT INTO exam (difficulty,total_marks,u_id) VALUES ('$_SESSION[level]','$sum','$user_id')");
		// }
		// } else {
		// 	$sum = $sum + $data['total_marks'];
		// 	mysqli_query($connect,"UPDATE exam SET total_marks=$sum WHERE u_id=$user_id AND difficulty='$_SESSION[level]'");
		// } 

		unset($_SESSION['answer']);
		unset($_SESSION['question']);
		unset($_SESSION['answer']);
		unset($_SESSION['level']);
		unset($_SESSION['question']);
		echo '<center><button class="btn btn-primary"><a href="Dashboard.php">Dashboard</a></button></center>';
		echo '<script src="dist/js/timer.js"></script>';
		echo '<script type="text/javascript">alert("Don\'t Refresh the page !!");eraseCookie(\'myClock\');</script>';
		
} else {
	echo '<script src="dist/js/timer.js"></script>';
	echo '<div class="container"><div class="alert alert-warning"><p>You can see all detailes on your Dashboard! (We\'ll see in future :p)</p></div></div>';
	echo '<center><button class="btn btn-primary"><a href="Dashboard.php">Dashboard</a></button></center>';
	echo '<script type="text/javascript"></script>';
}
?>
</body>
</html>

<!-- <script type="text/javascript">
	eraseCookie(\'myClock\');
	setTimeout(function() {window.location = "test.php"},5000);
	</script> -->