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
          <div class="col-6">
            <h1 class="display-4">Hello <strong><?= "{$user['first_name']} {$user['last_name']}" ?></strong></h1>
            <hr class="my-4">
            <p>Your member ID: <strong><?= "{$user['member_id']}" ?></strong></p>
          </div>
        </div>
      </header>

      <a class="btn" href="logout.php">Logout</a>
    </div>
  </body>
</html>