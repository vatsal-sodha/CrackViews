<?php
session_start();
if (!isset($_SESSION['email_id'])) {
		header('location:login.php');
}
if(isset($_POST['imagebase64'])){
        $data = $_POST['imagebase64'];

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents('IMG/'.$_SESSION['email_id'].'.cropped.jpg', $data);
		require 'ImageManipulator.php';
		$manipulator = new ImageManipulator('IMG/'.$_SESSION['email_id'].'.cropped.jpg');
		// resizing to 200x200
		$newImage = $manipulator->resample(200, 200);
		$manipulator->save('IMG/avtar-'.$_SESSION['email_id'].'.jpg');
		// resizing to 50x50
		$newImage = $manipulator->resample(50, 50);
		$manipulator->save('IMG/thumb-'.$_SESSION['email_id'].'.jpg');
		echo 'success';
		header('location:dashboard.php');
    }
?>