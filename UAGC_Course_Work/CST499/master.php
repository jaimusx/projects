<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('session.use_only_cookies','1');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ABC University</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
	body {
    background-image: url(img/university_B.jpg);
    background-repeat: no-repeat;
    background-size: cover;
	}
  </style>
</head>
<body>
<div class="banner">
  <img src="img/logo.png" alt="logo" />
  <h1>ABC Universtiy
	<?php
	if( isset($_SESSION['username'])) {
		echo "<span class='login-message'>Welcome {$_SESSION['username']}!</span>";
	}
	?>
  </h1>
</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				<li><a href="about_us"><span class="glyphicon glyphicon-exclamation-sign"></span> AboutUs</a></li>
				<li><a href="contact_us"><span class="glyphicon glyphicon-earphone"></span> ContactUs</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php
				if(isset($_SESSION['username'])) {
					echo '<li><a href="profile"><span class="glyphicon glyphicon-briefcase"></span> Profile</a></li>';
					echo '<li><a href="logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>';
					echo '<li><a href="student_page"><span class="glyphicon glyphicon-info-sign"></span> Student Page</a></li>';
				} else {
					echo '<li><a href="login"><span class="glyphicon glyphicon-user"></span> Login</a></li>';
					echo '<li><a href="registration"><span class="glyphicon glyphicon-pencil"></span> Student Registration</a></li>';
				}
			?>
			</ul>
		</div>
  </div>
</nav>
</body>
</html>