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
  $member_id = $user['member_id'];

  try {
    require_once('connect.php');
    $conn = dbo();
    $sql = "DELETE FROM membership WHERE member_id = :member_id;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
    $stmt->execute();
    header("Location: index.php");
    exit;
  } catch (Exception $error) {
    $errors[] = $error->getMessage();
  }

?>