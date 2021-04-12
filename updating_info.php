<?PHP include('Head_and_footer/head.php'); ?>
    <title> PLANS | The Glory Hotel & Spa </title>
    <meta name="description" content="Plans at the Glory Hotel & Spa and book it online" />
  </head>

  <body class="plans">

  <header>
      <nav class="menu_bar">
        <div class="menu_bar_title">
          <h3 class="uk-h3">The Glory Hotel & Spa</h3>
        </div>
        <div class="menu_bar_items">
          <a href="index.php" class="uk-h5">HOME</a>
          <a href="about.php" class="uk-h5">ABOUT</a>
          <a href="plans.php" class="current_page uk-h5">PLANS</a>
          <a href="reviews.php" class="uk-h5">CUSTOMER REVIWS</a>
          <a href="access.php" class="uk-h5">ACCESS</a>
          <a href="login.php" class="uk-h5">LOGIN YOUR PAGE</a>
        </div>
      </nav>
  </header>

  <main>


    <?PHP

      //grab id and store in a variable 
      $booking_id = filter_input(INPUT_GET, 'id');

      //Connect to the database 
      require_once('connect.php'); 
      $conn = dbo();
      $updating_info_query = "select * from booking_info where booking_id = :booking_id";
      //Call the prepare method of the PDO object
      $statement = $conn->prepare($updating_info_query); 
      //Bind the parameter
      $statement->bindParam(':booking_id', $booking_id); 
      //Execute the query
      $statement->execute(); 
      //use fetchAll method to store 
      $all_booking_info = $statement->fetchAll(); 
      foreach($all_booking_info as $booking_info) :
        $first_name = $booking_info['first_name']; 
        $last_name = $booking_info['last_name'];  
        $phone = $booking_info['phone'];  
        $email = $booking_info['email']; 
      endforeach; 
      $statement->closeCursor(); 

    ?>


    <form id="booking_form" action="booking_process.php" method="post">
      <div class="form-group">
        <label>Booking ID<input type="text" name="booking_id" class="form-control" class="form-control" value="<?php echo $booking_id; ?>" readonly></label>
      </div>
      <div class="form-group">
        <label>First Name<input type="text" name="first_name" class="form-control"  value="<?php echo $first_name; ?>" readonly></label>
      </div>
      <div class="form-group">
        <label>Last Name<input type="text" name="last_name" class="form-control"  value="<?php echo $last_name; ?>" readonly></label>
      </div>
      <div class="form-group">
        <label>Phone Number<input type="tel" name="phone" placeholder="E.g. 604-1234-5678" class="form-control"  value="<?php echo $phone; ?>" required></label>
      </div>
      <div class="form-group">
        <label>e-Mail Address<input type="email" name="email" placeholder="E.g. example@gloryhotel.ca" class="form-control" value="<?php echo $email; ?>"></label>
      </div>
      <button  class="uk-button" name="submit">Update information</button>
    </form>

  </main>

<?PHP include('Head_and_footer/footer.php'); ?>