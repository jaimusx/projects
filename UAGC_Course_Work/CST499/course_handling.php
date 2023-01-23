<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('session.use_only_cookies','1');

include_once "classes.php";

# Prevent access to this file from a url request.
if(!isset($_SERVER['HTTP_REFERER'])){
  // redirect them to your desired location
  exit(header('Location: ../CST499/index'));
}

if (isset($_POST['course_add'])) {

  if(!empty($_POST['semester']) && !empty($_POST['course'])) {
  
    $semester_id = $_POST['semester'];
    $course_id = $_POST['course'];

    courseRegister::registerCourse($semester_id, $course_id);
  }
} else if (isset($_POST['wait_list'])) {
  # Add student to wait list
  courseRegister::addToWaitlist();
} else if (isset($_POST['cancel'])) {
  # Return back to the student page
  exit(header("Location: ../CST499/student_page"));
}
?>