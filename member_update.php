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
        <div style="display:flex; justify-content:center;">
          <h3>Update Your Profile</h3>
        </div>
        <form action="member_update_process.php" method="post" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="col-4">
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
                <label>Phone Number <small style="color:red; font-weight:bold;">*</small><input type="tel" name="phone" class="form-control"  value="<?= "{$user['phone']}" ?>" required></label>
              </div>
              <div class="form-group">
                <label>E-mail Address <small style="color:red; font-weight:bold;">*</small><input type="email" name="email" class="form-control" value="<?= "{$user['email']}" ?>" required></label>
              </div>
              <div class="form-group">
                <label>City<input type="text" name="city" class="form-control" value="<?= "{$user['city']}" ?>" ></label>
              </div>
              <div class="form-group">
                <label>SNS (URL)<input type="url" name="sns" class="form-control" value="<?= "{$user['sns']}" ?>"></label>
              </div>
              <div class="form-group">
                <label>Skills<input type="text" name="skills" class="form-control" value="<?= "{$user['skills']}" ?>"></label>
              </div>

              <button name="update" class="btn btn-info" type="submit">Update Change</button>
              <a class="btn btn-outline-info" href="member_top.php">Cancel</a>
              <a class="btn btn-outline-secondary" href="logout.php">Logout</a>
              <p></p>
            </div>
            <div class="col-4">
            <p></p>
              <label>Profile Photo<input type="file" name="photo" class="form-control"></label>
              <img src="image.php" width="300" height="300" alt="profile photo">
            </div>
          </div>
        </form>
        <div class="delete" style="display:flex; justify-content:flex-end; margin-top:160px;">
          <a class="btn btn-danger btn-sm" href="member_delete_process.php" onclick='return confirmation()'><small>delete account</small></a>
        </div>
      </main>
      <script type="text/javascript">
        function confirmation() { 
          if (confirm("Are you sure you want to delete your account?"))
          {
            location.href = "member_delete_process.php";
            return true;
          } else {
            location.href = "member_top.php";
            return false;
          }
        }
      </script>

      <?PHP include('Head_and_footer/footer.php'); ?>