<?php
  error_reporting(E_ALL ^ E_NOTICE);
  include_once 'master.php'  
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
    h1 {
      font-size: 50px;
      margin-bottom: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    input[type="text"],
    input[type="password"] {
      width: 300px;
      height: 50px;
      font-size: 18px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 0 20px;
    }
    button[type="submit"] {
      width: 300px;
      height: 50px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin: 15px;
    }
  </style>
</head>
<body>
<div class="login-container">
  <div class="form-login-container">
    <h1>Welcome to the Login Page</h1>
    <form action="mysql_conn.php" method="POST">
      <label for="email">eMail:</label>
      <input type="text" name="email" id="email" required>
      <label for="pwd">Password:</label>
      <input type="password" name="pwd" id="pwd" required>
      <a href="registration.php">Not Registered Yet? Click Here</a>
      <button type="submit" name="login" id="login">Login</button>
    </form>
  <div class="error">
    <!-- Display error message here -->
  </div>
  <div class="success">
    <!-- Display success message here -->
  </div>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>