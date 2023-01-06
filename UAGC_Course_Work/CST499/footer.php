<?php

if (session_status() === PHP_SESSION_NONE) {
  exit(header("Location: ../CST499/index.php"));
}
?>
<html>
<head>
</head>
<body>
<div class="navbar-fixed-bottom row-fluid">
  <div class="navbar-inner">
    <div style="color: white" class="container text-center">
      Copyright ABC University 2022
    </div>
  </div>
</div>
</body>
</html>
