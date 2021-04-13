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


  if(isset($_POST['update'])) {
    try {
      //Declare variables to store data from <form>
      $member_id = filter_input(INPUT_POST, 'member_id', FILTER_SANITIZE_NUMBER_INT);
      $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

      require_once('connect.php');
      $conn = dbo();
      $sql = "UPDATE membership SET phone = :phone, email = :email WHERE member_id = :member_id;";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);

      $stmt->execute();
      header("Location: login.php");
      exit;
    } catch (Exception $error) {
      $errors[] = $error->getMessage();
    }
  }

?>