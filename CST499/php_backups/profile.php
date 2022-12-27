<?php
  error_reporting(E_ALL ^ E_NOTICE);
  include_once 'master.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Profile Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    label {
      width: 250px;
      display: inline-block;
	    text-align: left;
	    margin: 10px;
    }
  </style>
</head>
<body>
<div class="profile-container">
  <div class="form-profile-container">
    <h3>Your Profile Information</h3><br>
    <div class="profile-container text-center">
      <label for"email">eMail</label>
      <span>
        <label id="email"><?php echo $_SESSION['email'];?></label>
      </span>
    </div>
    <div class="profile-container text-center">
      <label for"pwd">Password</label>
      <span>
        <label id="pwd"><?php echo $_SESSION['pwd'];?></label>
      </span>
    </div>
    <div class="profile-container text-center">
      <label for"firstName">First Name</label>
      <span>
        <label id="firstName"><?php echo $_SESSION['username'];?></label>
      </span>
    </div>
    <div class="profile-container text-center">
      <label for"lastName">Last Name</label>
      <span>
        <label id="lastName"><?php echo $_SESSION['lastname'];?></label>
      </span>
    </div>
    <div class="profile-container text-center">
      <label for"address">Address</label>
      <span>
        <label id="address"><?php echo $_SESSION['address'];?></label>
      </span>
    </div>
    <div class="profile-container text-center">
      <label for"phone">Phone Number</label>
      <span>
        <label id="phone"><?php echo $_SESSION['phone'];?></label>
      </span>
    </div>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>