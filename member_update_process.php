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
      
      $errors = [];

      //Update from the old info to the new info
      $member_id = filter_input(INPUT_POST, 'member_id', FILTER_SANITIZE_NUMBER_INT);
      $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      $email = strtolower($email);
      $city = filter_input(INPUT_POST, 'city');
      $sns = filter_input(INPUT_POST, 'sns', FILTER_VALIDATE_URL);
      $skills = filter_input(INPUT_POST, 'skills');
      //Store the image data as text
      $photo = file_get_contents($_FILES['photo']['tmp_name']);

      
      // Validate the email is in the correct format
      if (!$email) {
        echo $errors[] = "The email isn't in a valid format.";
      }
      if (!$sns) {
        echo $errors[] = "The URL isn't in a valid format.";
      }



      require_once('connect.php');
      $conn = dbo();
      $sql = "UPDATE membership SET phone=:phone, email=:email, city=:city, sns=:sns, skills=:skills WHERE member_id = :member_id;";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':photo', $photo);
      $stmt->bindParam(':city', $city);
      $stmt->bindParam(':sns', $sns);
      $stmt->bindParam(':skills', $skills);
      $stmt->execute();


      //Get whole user info to show the updated info on the main page
      $sql = "SELECT * FROM membership WHERE member_id = :member_id;";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      //Reset the session
      unset($_SESSION['user']);

      //Set the session again based on the updated information
      $_SESSION["user"] = $user;
      // header("Location: member_top.php");
      header("Location: member_top.php");

      exit;
    } catch (Exception $error) {
      $errors[] = $error->getMessage();
      error_handler($errors);
    }
  }


?>