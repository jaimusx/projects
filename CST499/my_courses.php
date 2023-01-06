<?php
include_once 'master.php';
include_once "classes.php";

if (session_status() === PHP_SESSION_NONE) {
  exit(header("Location: ../CST499/index.php"));
}

if (isset($_GET['record']) && isset($_GET['course-name']) && isset($_GET['semester-id'])) {
  
  courseRegister::removeCourse($_GET['record'], $_GET['course-name'], $_GET['semester-id']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Courses</title>
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
    table td {
      white-space: nowrap;
    }
    .course-container {
      float: left;
      padding-left: 375px;
      font-family: Arial, sans-serif; 
      max-width: auto;
      margin: 0 auto;
      text-align: center; 
    }
    .course-form-container {
      border-radius: 5px;
      background-color: white;
      padding: 20px;
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
  <div class="course-container">
    <div class="course-form-container">
      <h1>My Courses</h1>
      <div class="card-body">  
        <table class="table table-bordered">
          <?php

          # Call to class to populate courses and display them in a table if available.
          $get_courses = courseRegister::getCourses();

          if (!$get_courses) {
            echo '<p style="font-size: 20px; color: red;">You are not registerd to any courses</p>';
          } else {
            echo $get_courses;
          }
          ?>
        </table>
      </div>
      <form method="POST" action="course_handling.php">
        <div>
          <button type="cancel" name="cancel" id="cancel">Cancel</button>
        </div> 
      </form>
      <?php
      # Error statements.
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "db-error") {
          echo '<p class="error">There was an error in the database. Please contact your system administrator.</p>';
        } 
      }
      # Successful enrollment statement.
      if (isset($_GET["course-delete"])) {
        if ($_GET["course-delete"] == "success") {
          echo '<p class="success">Course have been deleted.</p>';
        } else {
          echo '<p class="error">Error in course deletion. Please contact your academic advisor.</p>';
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