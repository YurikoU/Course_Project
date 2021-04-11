<?PHP include('Head_and_footer/head.php'); ?>
    <title> MEMBERSHIP | The Glory Hotel & Spa </title>
    <meta name="description" content="membership page" />
  </head>

  <body class="reviews">

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
            <!-- <a href="#" class="uk-h5">SIGN UP</a> -->
          </div>
        </nav>
    </header>

    <main>
    
    <div class="container">
      <div class="py-5 text-center">
        <h2 class="display-4">Membership Registeration</h2>
      </div>

      <div class="col">
        <form action="./register.php" method="post" novalidate>
          <div class="row">
            <div class="col-sm-6 form-group">
              <label for="first_name" class="form-label">First Name:</label>
              <input class="form-control" type="text" name="first_name" required placeholder="John" value="<?= $form_values['first_name'] ?? null ?>">
            </div>
            <div class="col-sm-6 form-group">
              <label for="last_name" class="form-label">Last Name:</label>
              <input class="form-control" type="text" name="last_name" required placeholder="Smith" value="<?= $form_values['last_name'] ?? null ?>">
            </div>
          </div>

          <div  class="row">
            <div class="col-sm-4 form-group">
              <label for="phone" class="form-label">Phone:</label>
              <input class="form-control" type="phone" name="phone" placeholder="604-1234-5678" required value="<?= $form_values['phone'] ?? null ?>">
            </div>
            <div class="col-sm-4 form-group">
              <label for="email" class="form-label">Email:</label>
              <input class="form-control" type="email" name="email" placeholder="example@gloryhotel.ca" required value="<?= $form_values['email'] ?? null ?>">
            </div>
            <div class="col-sm-4 form-group">
                <label for="email_confirmation" class="form-label">Email Confirmation:</label>
                <input class="form-control" type="email" name="email_confirmation" placeholder="example@gloryhotel.ca" required value="<?= $form_values['email_confirmation'] ?? null ?>">
            </div>

            <div  class="row">
              <div class="col-sm-6 form-group">
                <label for="password" class="form-label">Password:</label>
                <input class="form-control" type="password" name="password" required>
              </div>
              <div class="col-sm-6 form-group">
                <label for="password_confirmation" class="form-label">Password Confirmation:</label>
                <input class="form-control" type="password" name="password_confirmation" required>
              </div>
            </div>

          <!-- Add the recaptcha field -->
          <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

          <div class="row my-4">
            <div class="col form-group">
                <button class="btn btn-primary" type="submit">Register</button>
                <a class="btn" href="login.php">Have your account?</a>
            </div>
          </div>
        </form>
      </div>
    </div>



    <!-- Add the recaptcha scripts -->
    <?php include_once('config.php') ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
    <script>
      grecaptcha.ready(() => {
        grecaptcha.execute("<?= SITEKEY ?>", { action: "register" })
        .then(token => document.querySelector("#recaptchaResponse").value = token)
        .catch(error => console.error(error));
      });

      </script>

    </div>  
    </main>

<?PHP include('Head_and_footer/footer.php'); ?>