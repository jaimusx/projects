<?php
include_once 'master.php';
if (session_status() === PHP_SESSION_NONE) {
  exit(header("Location: ../CST499/index.php"));
}
?>
<head>
  <title>Profile Page</title>
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
<div style="float: left; justify-content: space-between;">
    <?php
      if( isset($_SESSION['username'])) {
        include_once 'student_nav_bar.php';
        }
    ?>
  <div style="float: right; padding-left: 400px;" class="profile-container">
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
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>