<?php

  // Connect to the database
  require("connect.php");

  // Destructure our values
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  //strtolower() = convert all letters to lower cases
  $email = strtolower($email);
  $password = filter_input(INPUT_POST, 'password');
  
  // Create our SQL with an email placeholder
  $sql = "SELECT * FROM membership WHERE email = :email";
  
  // Prepare the SQL
  $stmt = $dbo->prepare($sql);
  
  // Bind the value to the placeholder (incidently this will also sanitize the value)
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  
  // Execute
  $stmt->execute();

  // Check if we have a user and their password is correct
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $auth = false;  // sort of "flag" to toggle log-in status

  // password_verify() = return TRUE/FALSE
  // 1st parameter = enterd password
  // 2nd parameter = hashed password stored in database
  if ($user) $auth = password_verify($password, $user['password']);


  session_start();
  if (!$auth) { // (1)Log-in info is NOT correct, or(2)Application cannot verify log-in 
    $_SESSION["errors"][] = "Your email/password could not be verified.";
    $_SESSION["form_values"] = $_POST;

    // Jump to login.php
    header("Location: login.php");

    // Not need else statement, because if a user fail logging in they suppose to jump to login.php
    // Otherwise, you have to also validate entire data inside else statement
    // End PHP operation
    exit();
  }

  $_SESSION["user"] = $user;
  $_SESSION["successes"][] = "You have logged in successfully.";
  header("Location: profile.php");

  // End PHP operation
  exit();