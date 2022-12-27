<?php
  error_reporting(E_ALL ^ E_NOTICE);
  include_once 'master.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Registration Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    h1 {
      color: #444;
      font-size: 50px;
    }
    label {
      width: 200px;
      display: inline-block;
	    text-align: left;
      padding: 5px;
    }
	  input {
	    width: 225px;
      display: inline-block;
      padding: 5px;
	  }
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      padding: 12px;
      margin: 15px;
      font-size: 18px;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<div class="reg-container">
  <div class="form-reg-container">
    <h1>Registration Form</h1>
    <form action='mysql_conn.php' method="POST">
      <label for="fname">First Name:</label>
      <input type='text' name='fname' id="fname" required/>
      <br>
      <label for="lname">Last Name:</label>
      <input type='text' name='lname' id="lname" required/>
      <br>
      <label for="address">Address:</label>
      <input type='text' name='address' id="address" required/>
      <br>
      <label for="phone">Phone Number:</label>
      <input type='text' name='phone' id="phone" required/>
      <br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="pwd" name="pwd" required>
      <br>
      <label for="password-confirm">Confirm Password:</label>
      <input type="password" id="password-confirm" name="password-confirm" required>
      <br>
      <input type="submit" name="register" value="Register" id-"register">
    </form>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>