<?php
session_start();
// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','bmp');

// identify file format and generate file name 
$ar[0] = $_SESSION['email_id'];
$ar[1] = ".original.";
$ar[2] = substr($_FILES['upl']['name'],strrpos($_FILES['upl']['name'],'.')+1);

// Start uploading if no error
if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
	if (isset($ar)) {
		$_FILES['upl']['name'] = join("",$ar);
		echo $_FILES['upl']['name'];
	}
	if( move_uploaded_file( $_FILES['upl']['tmp_name'], 'IMG/'.$_FILES['upl']['name'])) {
		echo '{"status":"success"}';
		header('location:dashboard.php');
		exit;
	}
} else {
	echo '{"status":"error"}';
}
exit;
?>