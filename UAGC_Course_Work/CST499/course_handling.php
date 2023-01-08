<?php

# Prevent access for this file from a url request.
if(!isset($_SERVER['HTTP_REFERER'])){
  // redirect them to your desired location
  exit(header('Location: ../CST499/index.php'));
}

if (isset($_POST['course_add'])) {

  include_once "classes.php";

  if(!empty($_POST['semester']) && !empty($_POST['course'])) {
  
    $semester_id = $_POST['semester'];
    $course_id = $_POST['course'];

    courseRegister::registerCourse($semester_id, $course_id);
  }
} else if (isset($_POST['cancel'])) {
  # Return back to the student page
  exit(header("Location: ../CST499/student_page"));
}
?>