<?php
  include_once 'master.php';
?>
<html>
<head>
  <title>Login Page</title>
  <style>
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
      background-color: rgb(117, 38, 59);
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
    <form action="checks.php" method="POST">
      <label for="email">eMail:</label>
      <input type="text" name="email" id="email" required>
      <label for="pwd">Password:</label>
      <input type="password" name="pwd" id="pwd" required>
      <a href="registration.php">Not Registered Yet? Click Here</a>
      <button type="submit" name="login" id="login">Login</button>
    </form>
    <?php
      if(isset($_GET['login'])) {
        if ($_GET["login"] == "failed") {
          echo '<div class="error">Your email or password is incorrect! Please try again.</div>';
        } else if ($_GET["login"] == "error") {
          echo '<div class="error">Ther was a database error. Please contact your academic advisor.</div>';
        }
      }
    ?>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>