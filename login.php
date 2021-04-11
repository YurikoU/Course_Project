<?php
  session_start();
  if (isset($_SESSION['user'])) { // If a user's logged in
    header("Location: profile.php"); // Jump to profile.php
    exit();
  }

  // Before we render the form let's check for form values
  $form_values = $_SESSION['form_values'] ?? null;

  // Clear the form values
  unset($_SESSION['form_values']);  
?>

<?PHP include('Head_and_footer/head.php'); ?>
    <title> MEMBERSHIP | The Glory Hotel & Spa </title>
    <meta name="description" content="membership page" />
  </head>

  <body class="login text-center">
    <header>
        <nav class="menu_bar">
          <div class="menu_bar_title">
            <h3 class="uk-h3">The Glory Hotel & Spa</h3>
          </div>
          <div class="menu_bar_items">
            <a href="index.php" class="uk-h5">HOME</a>
            <a href="about.php" class="uk-h5">ABOUT</a>
            <a href="plans.php" class="uk-h5">PLANS</a>
            <a href="reviews.php" class="uk-h5">CUSTOMER REVIWS</a>
            <a href="access.php" class="uk-h5">ACCESS</a>
            <a href="#" class="current_page uk-h5">LOGIN YOUR PAGE</a>
            <a href="#" class="uk-h5">SIGN UP</a>
          </div>
        </nav>
    </header>

    
    <main class="form-signin" style="position: relative;">
      <form style="width:300px; margin:0 auto; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);" action="./login_process.php" method="post">
        <h3 class="mb-3 fw-normal">Log In</h3>
        <div class="form-floating">
          <input class="form-control" type="email" id="email" placeholder="Email address" style="height:58px;">
        </div>
        <div class="form-floating">
          <input class="form-control"  type="password" id="password" placeholder="Password" style="height:58px;">
        </div>
        <button class="btn btn-primary" type="submit" style="width:100%;">Log in</button>
      </form>
    </main>

<?PHP include('Head_and_footer/footer.php'); ?>