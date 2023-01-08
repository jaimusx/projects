<?php
  include_once 'master.php';  
?>
<html>
<head>
  <title>Student Registration Page</title>
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
      margin: 5px;
	  }
    input[type="submit"] {
      background-color: rgb(117, 38, 59);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      padding: 12px;
      margin: 15px;
      font-size: 18px;
    }
    input[type="submit"]:hover {
      background-color: rgb(105, 38, 59);
    }
  </style>
</head>
<body>
<div class="reg-container">
  <div class="form-reg-container">
    <h1>Registration Form</h1>
    <form action='checks.php' method="POST">
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
      <input type="text" id="email" name="email" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="pwd" name="pwd" required>
      <br>
      <label for="password-confirm">Confirm Password:</label>
      <input type="password" id="pwd-confirm" name="pwd-confirm" required>
      <br><br>
      <a href="login.php">Already Registered? Click Here to Login</a>
      <input type="submit" name="register" value="Register" id-"register">
    </form>
    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "passwordmatcherror") {
          echo '<p class="error">Passwords do not match! Please try again.</p>';
        } else if ($_GET["error"] == "invalidemail") {
          echo '<p class="error">The email address entered is invalid.</p>';
        } else if ($_GET["error"] == "userexists") {
          echo '<p class="error">The email address entered is already registered.</p>';
        } else if ($_GET["error"] == "badmethod") {
          echo '<p class="error">Error connecting to database or entry fields are incorect.</p>';
        }
      }
      if (isset($_GET["register"])) {
        if ($_GET["register"] == "success") {
          echo '<p class="success">You have successfully registered as a student!</p>';
        } else {
          echo '<p class="error">Error in student registration. Please contact your academic advisor.</p>';
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