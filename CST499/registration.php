<?php
  include_once 'master.php';  
?>
<head>
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
      <input type="password" id="pwd-confirm" name="pwd-confirm" required>
      <br>
      <input type="submit" name="register" value="Register" id-"register">
    </form>
    <?php
      #if($_GET['pwd'] !== $_GET['password-confirm']) {
      #  echo '<div class="error">Your password does not match! Please try again.</div>';
      #}
    ?>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>