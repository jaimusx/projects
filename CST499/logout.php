<?php

# Prevent access for this file from a url request.
if(!isset($_SERVER['HTTP_REFERER'])){
  // redirect them to your desired location
  exit(header('Location: ../CST499/index.php'));
}

error_reporting(E_ALL ^ E_NOTICE);

session_start();
session_unset();
session_destroy();

header("Location: ../CST499/index?logout=1");
?>
