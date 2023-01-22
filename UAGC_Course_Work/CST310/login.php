<?php
    error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Login Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style type="text/css">
    label{
      width: 110px;
      display: inline-block;
      text-align: left;
      margin: 15px;
    }
    input {
	  width: 225px;
    display: inline-block;
	  }
  </style>
</head>
<body>
<?php require 'master.php';?>

  <div class="container text-center">
    <h2>Welcome to the Login page</h2><br>
  </div>

  <form class="container text-center" action='mysql_conn.php' method="POST">

      <label for="email">eMail:</label>
      <input type='text' name='email' id="email" required/><br>

  	  <label for="pwd">Password:</label>
  	  <input type='password' name='pwd' id="pwd" required/><br><br>

      <button type='login' name='login' id-"login">Login</button>
  </form>

<?php require_once 'footer.php';?>
</body>
</html>
