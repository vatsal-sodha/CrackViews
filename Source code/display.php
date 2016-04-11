<?php
session_start();
 

 if(isset($_SESSION['email_id']))
	{  echo 'welcome '.$_SESSION['email_id'];
		echo "<form action='Login.php' method='post'><input type='submit' name='logout' value='Log Out'/></form>";
		}
?>