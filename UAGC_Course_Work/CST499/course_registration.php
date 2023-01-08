<?php
include_once 'master.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  exit(header("Location: ../CST499/index"));
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Course Registration</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    h1 {
      color: #444;
      font-size: 50px;
      margin: 20px;
    }
    button, label, select {
      display: inline-block;
      margin: 0 4px;
    }
    form {
      margin: 15px;
    }
  </style>
</head>
<body>
<div style="float: left; justify-content: space-between;">
  <?php
    if(isset($_SESSION['username'])) {
      include_once 'student_nav_bar.php';
    }
  ?>
  <div style="float: left; padding-left: 356px;" class="profile-container">
    <div style="width: 700px;" class="form-profile-container">
      <p>
        <?php
          echo "Welcome {$_SESSION['username']} {$_SESSION['lastname']}";
        ?>
      </p>
      <h1>Course Registration</h1>
      <form method="POST" action="course_handling.php">
        <label style="font-size: 16px;" for="semester">Choose a Semester</label>
        <select name="semester" id= "semester" onchange="getCourses(this.value);">
          <option value="">Select a Semester</option>
            <?php
            include_once 'classes.php';
          
            $sql = $sql = "SELECT * FROM tblsemesters;";
            $semesters = courseRegister::getEducationalData("semesters", $sql);
            
            echo $semesters;
            ?>
        </select>
        <br><br>
        <label style="font-size: 16px;" for="course">Choose a Course</label>
        <select name="course" id="course">
          <option value="">Select a Semester First</option>
        </select>
        <br><br>
        <div>
          <button type="course_add" name="course_add" id="course_add">Add Course</button>
          <button type="cancel" name="cancel" id="cancel">Cancel</button>
        </div> 
      </form>
      <script src="javascript/loadCourses.js"></script>
      <?php
      # Error statements.
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "no-availability") {
          echo '<p class="error">Unfortunately this course has no availability. Please select a different course.</p>';
        } else if ($_GET["error"] == "no-data") {
          echo '<p class="error">No data returned from the database. Please contact your system administrator.</p>';
        } else if ($_GET["error"] == "db-error") {
          echo '<p class="error">There was an error in the database. Please contact your system administrator.</p>';
        } 
      }
      # Successful enrollment statement.
      if (isset($_GET["course-register"])) {
        if ($_GET["course-register"] == "success") {
          echo '<p class="success">You have successfully registered a course!</p>';
        } else {
          echo '<p class="error">Error in course registration. Please contact your academic advisor.</p>';
        }
      }
      # Already enrolled to the course statement.
      if (isset($_GET["enrolled"])) {
        if ($_GET["enrolled"] == "1") {
          echo '<p class="error">You are already enrolled for this course. Please choose a different course.</p>';
        }
      }
    ?>
    </div>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>