<?php

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  exit(header("Location: ../CST499/index"));
}
?>
<html>
<head>
<style>
  html, body {
    height: 84%
  }
</style>
</head>
<body>
<div class="vertical-navbar">
  <ul>
    <li><a class="active" style="font-size: 18px">My Degree</a></li>
    <li><a href="my_courses">My Courses</a></li>
    <li><a href="student_contacts">My Contacts</a></li>
    <li><a href="course_registration">Register for a Course</a></li>
  </ul>
</div>
</body>
</html>