<?php
  session_start();
  
  if (!isset($_SESSION['user'])) { // If nobody's logged in
    header("Location: login.php");
    exit();
  }

  // Reset the log in session
  unset($_SESSION['user']);
  $_SESSION['successes'][] = "You have been logged out successfully.";
  header("Location: index.php");
  exit();