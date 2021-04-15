<?php

if (isset($_POST["login"])) {
  // Connect to the database
  require_once("connect.php");  
  $conn = dbo();
  // Destructure our values
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $email = strtolower($email);
  $password = filter_input(INPUT_POST, 'password');

  // Create our SQL with an email placeholder
  $sql = "SELECT * FROM membership WHERE email = :email;";
    
  // Prepare the SQL
  $stmt = $conn->prepare($sql);
    
  // Bind the value to the placeholder (incidently this will also sanitize the value)
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
  // Execute
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $login = false;

  if ($user) {
    $login = password_verify($password, $user['password']);
  }

  session_start();
  if (!$login) { // (1)Log-in info is NOT correct, or(2)Application cannot verify log-in 
    $_SESSION["errors"][] = "Your email/password could not be verified.";
    $_SESSION["form_values"] = $_POST;
    header("Location: login.php");
    exit();
  }

  $_SESSION["user"] = $user;
  $_SESSION["successes"][] = "You have logged in successfully.";
  header("Location: member_top.php");
  exit();
}  
