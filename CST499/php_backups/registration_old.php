<?php
    error_reporting(E_ALL ^ E_NOTICE);
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
  <style type="text/css">

	.form-container {
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: white;
      padding: 20px;
    }

  label {
      width: 200px;
      display: inline-block;
	    text-align: left;
	    margin: 10px;
  }

	input {
	  width: 225px;
    display: inline-block;
	}

  </style>
</head>
<body>
<?php include 'master.php';?>

<div class="form-container">
    <div class="container text-center">
      <h2>Welcome to the Registration Page</h2><br>

      <form class="container text-center" action='mysql_conn.php' method="POST">
        <label for="email">eMail:</label>
        <input type='text' name='email' id="email" required/><br>

        <label for="pwd">Password:</label>
        <input type='text' name='pwd' id="pwd" required/><br>

        <label for="fname">First Name:</label>
        <input type='text' name='fname' id="fname" required/><br>

        <label for="lname">Last Name:</label>
        <input type='text' name='lname' id="lname" required/><br>

        <label for="address">Address:</label>
        <input type='text' name='address' id="address" required/><br>

        <label for="phone">Phone Number:</label>
        <input type='text' name='phone' id="phone" required/><br>

        <button style="float: center; width: 30%" type='register' name='register' id-"register">Register</button>
      </form>
    </div>
  </div>

<?php include 'footer.php';?>
</body>
</html>
