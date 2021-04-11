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

  ob_start(); 
  
  try {
    $booking_id = filter_input(INPUT_GET, 'id'); 


    //Connect to the database
    require('connect.php'); 
    $delete_plan_query = "delete from booking_info where booking_id = :booking_id;"; 
    //Call the prepare method of the PDO object
    $statement = $dbo->prepare($delete_plan_query); 
    //Bind parameters
    $statement->bindParam(':booking_id', $booking_id); 
    //Execute the query
    $statement->execute(); 
    //Close the database connection
    $statement->closeCursor();
    echo "<p>The reservation has been successfully deleted.</p>";
  }
  catch(PDOException $e) {
    //Error will be displayed once the server failed to update the data
    echo "<p>Failed to delete this reservation.</p>";
    echo $e -> getMessage();
    exit();
  }

  ob_flush(); 

  ?> 

  </main>

<?PHP include('Head_and_footer/footer.php'); ?>