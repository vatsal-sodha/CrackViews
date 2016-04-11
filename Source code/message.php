<?php
function verifpro($user_name,$link){
	$message='<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="dist/css/signin.css" rel="stylesheet">
</head>
<body style="padding-top: 40px;
  padding-bottom: 40px;font-family: \'Josefin Sans\' , sans-serif;
  background-color: #eee;">
	<div class="container" style="font-size:1.5em; margin-top:10%;text-align:center">
	Dear '.$user_name.' <br>Your link for verifcation is<br>
	<button style="display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px; color: #fff;
  background-color: #286090;
  border-color: #204d74;" name="signup"><a style="color:white;
	text-decoration: none;"href='.$link.' >Click for Registration</a></button>
	<br>
	<br>
	<footer>
			<p class="pull-right">
			 
			<p>&copy; CrackViews, Inc. </p>
			</body>
			</html>';
	return $message;
}
function confirmation(){
	$message='<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="dist/css/signin.css" rel="stylesheet">
</head>
<body style="padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;">
	<div class="container" style="font-size:1.5em; margin-top:10%;text-align:center">
	<b>Dear User,<br>Your password is changed successfully </b><br>
			<p>&copy; CrackViews, Inc. </p>
			</body>
			</html>';
			return $message;
	
}
function password($user_name,$link){
  $message='<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="dist/css/signin.css" rel="stylesheet">
</head>
<body style="padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;">
  <div class="container" style="font-size:1.5em; margin-top:10%;text-align:center">
  Dear '.$user_name.' <br>Click the button below to change the password<br>
  <button style="display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px; color: #fff;
  background-color: #286090;
  border-color: #204d74;" name="signup"><a style="color:white;
  text-decoration: none;"href='.$link.' >Click Here!</a></button>
  <br>
  <br>
  <footer>
      <p class="pull-right">
       
      <p>&copy; CrackViews, Inc. </p>
      </body>
      </html>';
  return $message;
}
/*<style>
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}
.btn > a {
	color:white;
	text-decoration: none;
}
.btn-primary {
  color: #fff;
  background-color: #337ab7;
  border-color: #2e6da4;
}
.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}
.btn.focus {
  color: #333;
  text-decoration: none;
}
.btn-primary:hover {
  color: #fff;
  background-color: #286090;
  border-color: #204d74;
}
</style>*/
?>
