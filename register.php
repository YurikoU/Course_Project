<?php

  // Include the recaptcha config
  include_once("./config.php");

  /* VALIDATION */
  // Build an error handling function
  session_start();
  function error_handler ($errors) {
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['form_values'] = $_POST;

      header("Location: signin.php");
      exit;
    }
  }

  // Create an array to hold all the field errors
  $errors = [];

  // Validate the recaptcha
  if (!empty($_POST['recaptcha_response'])) {
    $secret = SECRETKEY;
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$_POST['recaptcha_response']}");
    
    // json_decode() = convert json to PHP variables
    $response_data = json_decode($verify_response);
    if (!$response_data->success) {
      $errors[] = "Google reCaptcha failed: " . ($response_data->{'error-codes'})[0];
      error_handler($errors);
    }
  }

  // Collect our fields
  $first_name = filter_input(INPUT_POST, 'first_name');
  $last_name = filter_input(INPUT_POST, 'last_name');
  $phone = filter_input(INPUT_POST, 'phone');
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $email_confirmation = filter_input(INPUT_POST, 'email_confirmation');
  $password = filter_input(INPUT_POST, 'password');
  $password_confirmation = filter_input(INPUT_POST, 'password_confirmation');

  // Validate the necessary fields are not empty
  $required_fields = [
    'first_name',
    'last_name',
    'phone',
    'email',
    'email_confirmation',
    'password',
    'password_confirmation'
  ];

  foreach ($required_fields as $field) {
    if (empty($$field)) {
      $human_field = str_replace("_", " ", $field);
      $errors[] = "You cannot leave the {$human_field} blank.";
    } else {
      if ($field === "password" || $field === "password_confirmation") continue;
      // reason for FILTER_SANITIZE_STRING: If a user enter a HTML commemt, the application will render it as HTML and reload the page
      $$field = filter_var($$field, FILTER_SANITIZE_STRING);
    }
  }

  // Validate the email is in the correct format
  if (!$email) {
    $errors[] = "The email isn't in a valid format.";
  }

  // Validate the email matches the email_confirmation
  if ($email !== $email_confirmation) {
    $errors[] = "The email doesn't match the email confirmation field.";
  }

  // Validate the password matches the password_confirmation
  if ($password !== $password_confirmation) {
    $errors[] = "The password doesn't match the password confirmation field.";
  }
  
  // Check if there errors
  error_handler($errors);

  /* END OF VALIDATION */

  /* NORMALIZATION */
  // Normalize the string fields (convert to lowercase and capitalize the first letter)

  // Lowercase the email
  $email = strtolower($email);

  // Hash the password
  // 1st parameter = password
  // 2nd parameter = what algorithm do you want to apply the password. "PASSWORD_DEFAULT" is bcrypt
  $password = password_hash($password, PASSWORD_DEFAULT);
  /* END NORMALIZATION */

  /* SANITIZATION */
  // Sanitize all values on their insertion
  require('./connect.php');
  $sql = "INSERT INTO membership (
    first_name,
    last_name,
    phone,
    email,
    password
  ) VALUES (
    :first_name,
    :last_name,
    :phone,
    :email,
    :password
  )";
  $stmt = $dbo->prepare($sql);

  // Sanitize using the binding
  $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR); // Casts it to a string
  $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR); // Casts it to a string
  $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':password', $password, PDO::PARAM_STR);
  
  /* END SANITIZATION */

  // Insert our row
  try {
    $stmt->execute();
    $_SESSION['successes'][] = "You have been registered successfully.";
    header("Location: login.php");
    exit;
  } catch (Exception $error) {
    $errors[] = $error->getMessage();
    error_handler($errors);
  }
