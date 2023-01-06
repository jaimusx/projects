<?php

if (session_status() === PHP_SESSION_NONE) {
  exit(header("Location: ../CST499/index.php"));
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
    <li><a href="my_courses.php">My Courses</a></li>
    <li><a href="#MyContact">My Contacts</a></li>
    <li><a href="course_registration.php">Register for a Course</a></li>
  </ul>
</div>
</body>
</html>
