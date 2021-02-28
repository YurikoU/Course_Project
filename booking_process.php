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
          <a href="membership_top.php" class="uk-h5">LOGIN YOUR PAGE</a>
          <a href="membership_top.php" class="uk-h5">SIGN UP</a>
        </div>
      </nav>
    </header>

    <main>
    <?PHP

      //Declare variables to store data from <form>
      $first_name = filter_input(INPUT_POST, 'first_name');
      $last_name = filter_input(INPUT_POST, 'last_name');
      $phone = filter_input(INPUT_POST, 'phone');
      $email = filter_input(INPUT_POST, 'email');
      $room_type = filter_input(INPUT_POST, 'room_type');
      $booking_id = filter_input(INPUT_POST, 'booking_id');

      //Convert the date and time value into a Unix timestamp 
      $check_in_string = filter_input(INPUT_POST, 'check_in');
      $check_in_unixstamp = strtotime($check_in_string);

      $check_in_date_string = date("Y-m-d", $check_in_unixstamp);
      $check_in_time_string = date("H:i", $check_in_unixstamp);
      $check_in_date_unixstamp = strtotime($check_in_date_string);

      $check_out_string = filter_input(INPUT_POST, 'check_out');
      $check_out_unixstamp = strtotime($check_out_string);

      $check_out_date_string = date("Y-m-d", $check_out_unixstamp);
      $check_out_time_string = date("H:i", $check_out_unixstamp);
      $check_out_date_unixstamp = strtotime($check_out_date_string);

      //Variables to store today's date
      $today = new DateTime();
      $today_string = $today -> format('Y-m-d');
      $today_unixstamp = strtotime($today_string);
      
      //Variables to store available check-in and check-out time.
      $check_in_start = "14:00";
      $check_in_end = "21:30";

      $check_out_start = "08:00";
      $check_out_end = "11:00";


      //Variable to store if any validations alerted a user
      $validation = true;

      //If a user updating their contact information
      if(is_null($booking_id) === false)
      {
        //If a user enter an email, validate it
        if (empty($email) === false) {
          if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {//E.g. yuriko_uchida@111111
            echo "<p>Please enter a properly formatted e-mail.</p>"; 
            $validation = false;
          }
        }
  
        if ($validation === false) 
        {
          //A user must double-check their data again once they enter invalid data
          echo "<a href='updating_info.php?id=$booking_id'>Back to INFORMATION UPDATE page</a>"; 
        } else 
        {

          try{
            //Connect to the database
            require('connect.php');

            $updating_sql = "update booking_info set phone = :phone, email = :email where booking_id = :booking_id";
            //Call the prepare method of the PDO object
            $statement = $dbo->prepare($updating_sql);
            //Bind parameters
            $statement->bindParam(':booking_id', $booking_id);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':email', $email);
            //Execute the query
            $statement->execute();
            //close the database connection
            $statement->closeCursor();  

            //Display updated contact information the user submitted just now
            echo "<p>The update has been successfully submitted!</p>";
            echo "<p>Your new contact information</p>";
            echo "<table class='table table-striped'><tbody>"; 
            echo "<tr><td>Booking ID: $booking_id</td></tr>
                  <tr><td>First Name: $first_name</td></tr>
                  <tr><td>Last Name: $last_name</td></tr>
                  <tr><td>Phone Number: $phone</td></tr>
                  <tr><td>e-Mail Address: $email</td></tr></tbody></table>";
            echo "<a href='index.php'>Back to TOP page</a><p></p>";   
            echo "<a href='plans.php'>Book another plan</a><p></p>";  
            echo "<a href='delete_plan.php?id=$booking_id'>Delete this reservation</a>";  
          }
          catch (PDOException $e)
          {
            //Error will be displayed once the server failed to update the data
            echo "<p>Failed to update.</p>";
            echo $e -> getMessage();
          }
        }

      }
      else  
      {  //If this process is for a new reservation


        //Validate input values
        if ((ctype_alpha($first_name) === false) || (ctype_alpha($last_name) === false)) {
          echo "<p>Last name and first name must be alphabets only.</p>";
          $validation = false;
        }

        if (empty($email) === false) {
          if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {//E.g. yuriko_uchida@111111
            echo "<p>Please enter a properly formatted e-mail.</p>"; 
            $validation = false;
          }
        }
  
        if (( $check_in_unixstamp < $today_unixstamp) || ($check_out_unixstamp <= $today_unixstamp)) {
          echo "<p>Check-in and check-out must be later than the current time.</p>";
          $validation = false;
        }
        if ($check_out_date_unixstamp <  $check_in_date_unixstamp) {
          echo "<p>Check-out date must be later than check-in date.</p>";
          $validation = false;
        }
        if (($check_in_time_string < $check_in_start) || ($check_in_end < $check_in_time_string)) {
          echo "<p>Check-in time must be from 2:00 PM to 9:30 PM.</p>";
          $validation = false;
        }
        if (($check_out_time_string < $check_out_start) || ($check_out_end < $check_out_time_string)) {
          echo "<p>Check-out time must be from 8:00 AM to 11:00 AM.</p>";
          $validation = false;
        }  
  

        if ($validation === false) 
        {
          //If any input data is not valid
          echo "<a href='plans.php'>Back to PLANS page</a>"; 
        } else {

          try {
            //Connect to the database
            require('connect.php');

            //Check the room availability
            $availability_query = 
            "select * from booking_info 
            where ( 
                   ((:check_in_date < check_out_date  AND  check_in_date <= :check_in_date)
                    OR (check_in_date < :check_out_date  AND  :check_out_date <= check_out_date)
                    OR (:check_in_date <= check_in_date  AND   check_out_date <= :check_out_date))
                    AND room_type = :room_type);";
            $statement = $dbo->prepare($availability_query);
            $statement->bindParam(':room_type', $room_type);
            $statement->bindParam(':check_in_date', $check_in_date_string);
            $statement->bindParam(':check_out_date', $check_out_date_string);
            $statement->execute();
            $double_booking = $statement->fetchAll();


            if (empty($double_booking) === false)
            {
              //If the room is already booked, the error will be displayed.
              echo "<p>Sorry! The room is already reserved.</p>";
              echo "<a href='plans.php'>Back to PLANS page</a>";          

            } else 
            {

              //If the room is available, continue booking process

              //Insert a new booking data
              $booking_query = 
              "insert into booking_info (first_name, last_name, phone, email, room_type, check_in_date, check_in_time, check_out_date, check_out_time) values (:first_name, :last_name, :phone, :email, :room_type, :check_in_date, :check_in_time, :check_out_date, :check_out_time);";
              //Call the prepare method of the PDO object
              $statement = $dbo->prepare($booking_query);
              //Bind parameters
              $statement->bindParam(':first_name', $first_name);
              $statement->bindParam(':last_name', $last_name);
              $statement->bindParam(':phone', $phone);
              $statement->bindParam(':email', $email);
              $statement->bindParam(':room_type', $room_type);
              $statement->bindParam(':check_in_date', $check_in_date_string);
              $statement->bindParam(':check_in_time', $check_in_time_string);
              $statement->bindParam(':check_out_date', $check_out_date_string);
              $statement->bindParam(':check_out_time', $check_out_time_string);
              //Execute the query
              $statement->execute();


              //Get all booking info of this new reservation to print it on the browser   
              $get_booking_info_query = 
              "select * from booking_info
              where first_name = :first_name AND last_name = :last_name AND phone = :phone AND email = :email AND 
              room_type = :room_type AND check_in_date = :check_in_date AND check_in_time = :check_in_time AND check_out_date = :check_out_date AND check_out_time = :check_out_time;";
              //Call the prepare method of the PDO object
              $statement = $dbo->prepare($get_booking_info_query);
              //Bind parameters
              $statement->bindParam(':first_name', $first_name);
              $statement->bindParam(':last_name', $last_name);
              $statement->bindParam(':phone', $phone);
              $statement->bindParam(':email', $email);
              $statement->bindParam(':room_type', $room_type);
              $statement->bindParam(':check_in_date', $check_in_date_string);
              $statement->bindParam(':check_in_time', $check_in_time_string);
              $statement->bindParam(':check_out_date', $check_out_date_string);
              $statement->bindParam(':check_out_time', $check_out_time_string);
              //Execute the query
              $statement->execute();
              //Store results 
              $all_booking_info = $statement->fetchAll();        
              //close the database connection
              $statement->closeCursor();    

              //Display all booking information the user submitted just now
              echo "<p>Your booking has been successfully submitted!</p>";
              echo "<p>Your booking information</p>";
              echo "<table class='table table-striped'><tbody>"; 
              foreach($all_booking_info as $booking_info)
              {
                echo "<tr><td>Booking ID: " . $booking_info['booking_id'] . "</td></tr>
                      <tr><td>First Name: " . $booking_info['first_name'] . "</td></tr>
                      <tr><td>Last Name: " . $booking_info['last_name'] . "</td></tr>
                      <tr><td>Phone Number: " . $booking_info['phone'] . "</td></tr>
                      <tr><td>e-Mail Address: " . $booking_info['email'] . "</td></tr>
                      <tr><td>Room Type: " . $booking_info['room_type'] . "</td></tr>
                      <tr><td>Check-in Date: " . $booking_info['check_in_date'] . "</td></tr>
                      <tr><td>Check-in Time: " . $booking_info['check_in_time'] . "</td></tr>
                      <tr><td>Check-out Date: " . $booking_info['check_out_date'] . "</td></tr>
                      <tr><td>Check-out Time: " . $booking_info['check_out_time'] . "</td></tr>";
              }
              echo "</tbody></table>"; 
              echo "<a href='index.php'>Back to TOP page</a><p></p>";   
              echo "<a href='updating_info.php?id=" . $booking_info['booking_id'] . "'>Update your contact information</a><p></p>";   
              echo "<a href='plans.php'>Book another plan</a><p></p>";   
              echo "<a href='delete_plan.php?id=" . $booking_info['booking_id'] . "'>Delete this reservation</a>";  
            }
          }  
          catch (PDOException $e) 
          {
            //Error will be displayed once the server failed to reserve the room
            echo "<p>Failed to reserve.</p>";
            echo $e -> getMessage();
          }
        }
      }
      
  ?>



  </main>

<?PHP include('Head_and_footer/footer.php'); ?>