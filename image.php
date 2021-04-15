<?PHP

  // If they're NOT logged in, redirect them before they view any of this content  
  session_start();
  if (!isset($_SESSION["user"])) {
    $_SESSION["errors"][] = "Please login to access this content.";
    header("Location: login.php");
    exit();
  }

  // Assign the user (for logged in users)
  $user = $_SESSION["user"];

  header('Content-type:  image/jpg');
  echo $user['photo'];



