<?php

if (isset($_POST['course_add'])) {

  include_once "classes.php";

  if(!empty($_POST['semester']) && !empty($_POST['course'])) {
  
    $semester_id = $_POST['semester'];
    $course_id = $_POST['course'];

    courseRegister::registerCourse($semester_id, $course_id);
  }
} elseif (isset($_POST['cancel'])) {
  # Return back to the student page
  exit(header("Location: ../CST499/student_page.php"));
}


?>