<?php
  include_once 'master.php';
  if(isset($_SESSION['username'])) {
    session_start();
  } else {
    header("Location: ../CST499/index.php");
  }
?>
<body>
  <div style="float: left; justify-content: space-between;">
    <?php
      if( isset($_SESSION['username'])) {
        include_once 'student_nav_bar.php';
        }
    ?>
    <div style="float: right; padding-left: 200px;" class="container">
      <div style="background-color: white;" class="jumbotron">
        <div class="row">
          <div class="col-sm-4">
            <h3><span class="glyphicon glyphicon-asterisk"></span> What's New?</h3>
            <p>Winter decorations are making a return on your floor!</p>
            <p>We are look forward to seeing what new creations students have for us this year!</p>
          </div>
          <div class="col-sm-4">
            <h3><span class="glyphicon glyphicon-star"></span> Topics Of The Week</h3>
            <p>Finacial aid. If you have questions, we can help!</p>
            <p>What are the school holidays? Here are all the answers you need.</p>
          </div>
          <div class="col-sm-4">
            <h3><a href="#"><span class="glyphicon glyphicon-cog"></span> My Settings</a></h3>
            <p>Click here to access your personal settings.</p>
            <p>You can change your theme, edit your information, and contact an IT specialist for help.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
  include_once 'footer.php';
?>