<?php

  // If they're NOT logged in, redirect them before they view any of this content  
  session_start();
  if (!isset($_SESSION["user"])) {
    $_SESSION["errors"][] = "Please login to access this content.";
    header("Location: login.php");
    exit();
  }

  // Assign the user (for logged in users)
  $user = $_SESSION["user"];
  include('Head_and_footer/head.php'); 
?>

  <title> MEMBERSITE | The Glory Hotel & Spa </title>
  </head>

  <body class="member_top">
    <div class="container">
      <header class="jumbotron my-5">
        <div class="row">
          <div class="col-8">
            <h1 class="display-4">Update Your Information</h1>
          </div>
        </div>
      </header>

      <main>
        <h3>Update Your Profile</h3>
          <form action="member_update_process.php" method="post">
            <div class="form-group">
              <label>Member ID<input type="text" name="member_id" class="form-control" value="<?= "{$user['member_id']}" ?>" readonly></label>
            </div>
            <div class="form-group">
              <label>First Name<input type="text" name="first_name" class="form-control" value="<?= "{$user['first_name']}" ?>" readonly></label>
            </div>
            <div class="form-group">
              <label>Last Name<input type="text" name="last_name" class="form-control" value="<?= "{$user['last_name']}" ?>" readonly></label>
            </div>
            <div class="form-group">
              <label>Phone Number<input type="tel" name="phone" class="form-control"  value="<?= "{$user['phone']}" ?>" required></label>
            </div>
            <div class="form-group">
              <label>E-Mail Address<input type="email" name="email" class="form-control" value="<?= "{$user['email']}" ?>" required></label>
            </div>
            <button name="update" class="btn btn-info" type="submit">Update Change</button>
            <a class="btn btn-outline-info" href="member_top.php">Cancel</a>
            <a class="btn btn-outline-info" href="logout.php">Logout</a>
            <p></p>
            <div class="delete" style="display:flex; justify-content:flex-end;">
              <a class="btn btn-danger btn-sm" href="member_delete_process.php" onclick='return confirmation()'><small>delete account</small></a>
            </div>
          </form>
      </main>
      <script type="text/javascript">
        function confirmation() { 
          if (confirm("Are you sure you want to delete your account?"))
          {
            location.href = "member_delete_process.php";
            return true;
          }
        }
      </script>

      <?PHP include('Head_and_footer/footer.php'); ?>