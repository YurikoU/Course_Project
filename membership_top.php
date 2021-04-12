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

  <body>
    <div class="container">
      <header class="jumbotron my-5">
        <div class="row">
          <div class="col-8">
            <h1 class="display-4">Welcome <strong><?= "{$user['first_name']} {$user['last_name']}" ?></strong></h1>
          </div>
        </div>
      </header>
      <main>
        <h3>Your Personal Profile</h3>
        <table class='table table-striped'><tbody>
        <?PHP
          echo "<tr><td>Member ID: " . $user['member_id'] . "</td></tr>
                <tr><td>First Name: " . $user['first_name'] . "</td></tr>
                <tr><td>Last Name: " . $user['last_name'] . "</td></tr>
                <tr><td>Phone: " . $user['phone'] . "</td></tr>
                <tr><td>E-Mail Address: " . $user['email'] . "</td></tr>";
        ?>
        </tbody></table>
      <a class="btn btn-primary" href="logout.php">Logout</a>
      </main>

    </div>
  </body>
</html>