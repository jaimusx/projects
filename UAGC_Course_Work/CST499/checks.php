<?php
include_once 'classes.php';
# All statements call to class functions within the class.php file.

if (isset($_POST['login'])) {
  studentLogin::setLogin();
} else if (isset($_POST['register'])) {
  studentRegister::setRegistration();
} else if (isset($_POST['id'])) {

  # Get the semester id and send it to the class function to retreive course list.
  $sid = $_POST['id'];
  $sql = "SELECT * FROM tblcourses WHERE semester_id = '$sid'";
  $courses = courseRegister::getEducationalData("courses", $sql);

  echo $courses;
} else {
  exit(header("Location: ../CST499/index.php"));
}
?>