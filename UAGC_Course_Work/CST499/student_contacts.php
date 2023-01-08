<?php
include_once 'master.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  exit(header("Location: ../CST499/index"));
}
?>
<html>
  <title>Student Page</title>
<body>
  <div style="float: left; justify-content: space-between;">
    <?php
      if( isset($_SESSION['username'])) {
        include_once 'student_nav_bar.php';
        }
    ?>
    <div style="float: right; padding-left: 200px; width: 1250px;" class="container">
      <div style="background-color: white;" class="jumbotron">
        <div class="row">
          <div class="col-sm-4">
            <h3></span>Academic Advisor</h3>
            <p>Samuel Twain<br>s.twain@abcu.edu<br>(800) 555-0584 ext: 33124<br>Mon-Fri 08:00-04:00 CST</p>
          </div>
          <div class="col-sm-4">
            <h3></span>Dean</h3>
            <p>Dr. Amr Elchouemi<br>a.elchouemi@abcu.edu<br>(800) 555-0584 ext: 61923<br>Mon-Fri 09:00-05:00 CST</p>
          </div>
          <div class="col-sm-4">
            <h3></span>Registrar Assistant</a></h3>
            <p>Gene Lucas<br>g.lucas@abcu.edu<br>(800) 555-0584 ext: 11157<br>Mon-Fri 09:00-05:00 CST</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<html>
<?php
  include_once 'footer.php';
?>