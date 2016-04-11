<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	$connect=mysqli_connect('localhost','root','','question_bank');
	if (!$connect) {
    	die('Could not connect: ' . mysqli_error($connect));
	}
	$query = "SELECT email_id FROM verification WHERE email_id LIKE '%".$_POST['emailcheck']."%'";
	$record=mysqli_query($connect,$query);
	if ($data=mysqli_fetch_assoc($record)) {
		echo 'Already under verification! Please check mail!';
	} else {
		$query = "SELECT email_id FROM users WHERE email_id LIKE '%".$_POST['emailcheck']."%'";
		$record=mysqli_query($connect,$query);
		if($data=mysqli_fetch_assoc($record)) {
			echo 'Email is already registered!';
		} else {
			echo '<span class="glyphicon glyphicon-thumbs-up pull-right"></span>';
		}
	}
?>
</body>
</html>