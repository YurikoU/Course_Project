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
            <h1 class="display-4">Welcome <strong><?= "{$user['first_name']} {$user['last_name']}" ?></strong></h1>
          </div>
        </div>
      </header>
      <main>
        <div style="display:flex; justify-content:center;">
          <h3>Your Profile</h3>
        </div>
        <form>
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
                <label>Phone Number<input type="tel" name="phone" class="form-control"  value="<?= "{$user['phone']}" ?>" readonly></label>
              </div>
              <div class="form-group">
                <label>E-mail Address<input type="email" name="email" class="form-control" value="<?= "{$user['email']}" ?>" readonly></label>
              </div>

              <div class="form-group">
                <label>City<input type="text" name="city" class="form-control" value="<?= "{$user['city']}" ?>" readonly></label>
              </div>
              <div class="form-group">
                <label>SNS (URL)<input type="url" name="sns" class="form-control" value="<?= "{$user['sns']}" ?>" readonly></label>
              </div>
              <div class="form-group">
                <label>Skills<input type="text" name="skills" class="form-control" value="<?= "{$user['skills']}" ?>" readonly></label>
              </div>

              <a class="btn btn-info" href="member_update.php">Update</a>
              <a class="btn btn-outline-secondary" href="logout.php">Logout</a>
            </div>
            <div class="col-4">
              <p></p>
              <label>Profile Photo</label>
              <img src="image.php" width="300" height="300" alt="profile photo">
            </div>
          </div>
        </form>


        <div style="margin-top: 85px; margin-bottom:9px;">
          <div style="display:flex; justify-content:center;">
            <h3>Booking History</h3>
          </div>
          <form action="member_top.php" method="get"> 
            <div class="row">
              <div class="col">
                <label>Serch Term<input type="text" name="search_terms" placeholder="Search by"></label>
              </div>
              <button class="btn btn-info" name="search" style="margin-right:4px;">Search</button>
              <button class="btn btn-outline-secondary" name="reset">Reset</button>
            </div>
          </form>       
        </div>


<!-- Handle the search field-------------------------------------------------------------------------------------- -->
        <?PHP
          //Initialize variables
          $search_terms = null;
          $search = null;
          $reset = null;

          //Store the user input 
          $search_terms = filter_input(INPUT_GET, 'search_terms');
          $search = filter_input(INPUT_GET, 'search');
          $reset = filter_input(INPUT_GET, 'reset');

          //connect to the database 
          require_once('connect.php'); 
          $conn = dbo();

          if(isset($search))
          {
            //If a user is searching something
            if(!empty($search_terms))
            {
              //If the search term is valid
              $multiple_terms = substr_count($search_terms, ' ');
              if (0 < $multiple_terms)
              {

                //If a user enter multiple words splited by a space
                $sql = "SELECT * FROM booking_history WHERE 0 < booking_id";
                $terms = preg_split("/[ ]+/", $_GET['search_terms']);
                foreach($terms as $term)
                {
                  //Plus another term a user want to search to the above original query
                  $sql .= " AND room_type LIKE :term";
                  $statement = $conn->prepare($sql);
                  $statement->bindValue(':term', '%'.$term.'%');
                }
                $sql .= ";";

              } else 
              {
                //If a user enter a single word
                $search_reviews_query = "SELECT * FROM booking_history WHERE room_type LIKE :search_terms";
                $statement = $conn->prepare($search_reviews_query);
                $statement->bindValue(':search_terms', '%'.$search_terms.'%');
              }

              $statement->execute();

              //check for results and display, if not, let the user know that no results  found 
              if($statement->rowCount() >= 1) 
              {
                
                $num_of_results = $statement->rowCount();
                //Display the word a user entered
                echo "<p>Search term: \"$search_terms\" &nbsp;&nbsp;&nbsp;&nbsp;$num_of_results Results</p>"; 
                
                //creating the top of the table 
                echo "<table class='table table-striped'><tbody>"; 
                echo "<tr><td>Booking ID</td><td>Room Type</td><td>Check-in Date</td><td>Check-out Date</td></tr>"; 
              
                $reviews = $statement->fetchAll();
                foreach($reviews as $review) 
                {
                  echo "<tr><td>" . $review['booking_id'] . "</td>
                       <td>" . $review['room_type'] . "</td>
                       <td>" . $review['check_in_date'] . "</td>
                       <td>" . $review['check_out_date'] . "</td>
                       </tr>";
                }
                echo "</tbody></table>"; 
                $statement->closeCursor(); 

              } else
              {
                //If any result wasn't found, the message will be displayed.
                $num_of_results = $statement->rowCount();
                //Display the word a user entered
                echo "<p>Search term: \"$search_terms\" &nbsp;&nbsp;&nbsp;&nbsp;  $num_of_results Results</p>"; 
                echo "<p>No results found! Please try to search by another word.</p>"; 
              }

            } else 
            {
              //If the search term is not valid
              echo "<p>Search term: \"$search_terms\"</p>"; 
              echo "<p>Please enter a proper word.</p>"; 
            }   

          } else if ((!isset($search)) || (!empty($reset)))
          {
            //If a user is not searching or clicks a reset button, simply display all customer reviews
            $view_reviews_query = "SELECT * FROM booking_history"; 
            $statement = $conn->prepare($view_reviews_query); 
            $statement->execute(); 
            $reviews = $statement->fetchAll();
    
            //creating the top of the table 
            echo "<table class='table table-striped'><tbody>"; 
            echo "<tr><td>Booking ID</td><td>Room Type</td><td>Check-in Date</td><td>Check-out Date</td></tr>"; 
            foreach($reviews as $review) 
            {
              echo "<tr><td>" . $review['booking_id'] . "</td>
                   <td>" . $review['room_type'] . "</td>
                   <td>" . $review['check_in_date'] . "</td>
                   <td>" . $review['check_out_date'] . "</td>
                   </tr>";
            }
            echo "</tbody></table>"; 
            $statement->closeCursor(); 
          }
      ?>
<!-- End of the search field---------------------------------------------------------------------------------------- -->


        <div class="delete" style="display:flex; justify-content:flex-end; margin-top:160px;">
          <a class="btn btn-danger btn-sm" href='member_delete_process.php' onclick='return confirmation()'><small>delete account</small></a>
        </div>
      </main>


<!-- Alert for deleting account-------------------------------------------------------------------------------------- -->
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
<!-- End of alert------------------------------------------------------------------------------------------------------ -->

      <?PHP include('Head_and_footer/footer.php'); ?>