<?PHP include('Head_and_footer/head.php'); ?>
    <title> CUSTOMER REVIWS | The Glory Hotel & Spa </title>
    <meta name="description" content="Customer reviews of the Glory Hotel & Spa" />
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
          <a href="reviews.php" class="current_page uk-h5">CUSTOMER REVIWS</a>
          <a href="access.php" class="uk-h5">ACCESS</a>
          <a href="membership_top.php" class="uk-h5">LOGIN YOUR PAGE</a>
          <a href="membership_top.php" class="uk-h5">SIGN UP</a>
        </div>
      </nav>
    </header>

    <main>
      <h2>Customer Reviews</h2>
        <form action="reviews.php" method="get"> 
          <div class="row">
            <div class="col">
              <label>Your name <i>(optional)</i><input type="text" name="name" ></label>
            </div>
            <div class="col">
              <label>Search reviews by the term<input type="text" name="search_term" placeholder="Please enter any word"></label>
            </div>
            <button  class="uk-button" name="submit">Search</button>
            <button  class="uk-button" name="reset">Reset</button>
          </div>
        </form>


      <?PHP
        session_start(); 

        $name = null;
        $search_term = null;
        $reset = null;
        $name = filter_input(INPUT_GET, 'name');
        $search_term = filter_input(INPUT_GET, 'search_term');
        $reset = filter_input(INPUT_GET, 'reset');
        $_SESSION['name'] = $name;

        //connect to the database 
        require('connect.php'); 


        if(!empty($search_term))
        {
          //If a user is searching some words

          //Set up SQL statement 
          $search_reviews_query = "select * from reviews where username like :search_term OR review OR :search_term";
          //Call the prepare method of the PDO object
          $statement = $dbo->prepare($search_reviews_query);
          //Bind parameter
          $statement->bindValue(':search_term', '%'.$search_term.'%');
          //Execute the query
          $statement->execute();

          //check for results and display, if not, let the user know that no results found 
          if($statement->rowCount() >= 1) 
          {
            //creating the top of the table 
            echo "<table class='table table-striped'><tbody>"; 
            echo "<tr><td>Post ID</td><td>Posted Date</td><td>Username</td><td>Reviews</td><td>Like</td></tr>"; 

            $reviews = $statement->fetchAll();
            foreach($reviews as $review) 
            {
              echo "<tr><td>" . $review['post_id'] . "</td>
                   <td>" . $review['post_date'] . "</td>
                   <td>" . $review['username'] . "</td>
                   <td>" . $review['review'] . "</td>
                   <td>" . $review['like'] . "</td>
                   </tr>";
            }
            echo "</tbody></table>"; 

          } else
          {
            //If any result wasn't found, the message will be displayed.
            echo "<p>Sorry, no results found!</p>"; 
          }


        } else if ((empty($search_term)) || (!empty($reset)))
        {

          //If the search field is empty or a user pushed a reset button, simply display all customer reviews

          //set up SQL statement 
          $view_reviews_query = "select * from reviews"; 
          //prepare 
          $statement = $dbo->prepare($view_reviews_query); 
          //execute 
          $statement->execute(); 
          //use fetchAll to store results 
          $reviews = $statement->fetchAll();
    
          //creating the top of the table 
          echo "<table class='table table-striped'><tbody>"; 
          echo "<tr><td>Post ID</td><td>Posted Date</td><td>Username</td><td>Reviews</td><td>Like</td></tr>"; 
          foreach($reviews as $review) 
          {
            echo "<tr><td>" . $review['post_id'] . "</td>
                 <td>" . $review['post_date'] . "</td>
                 <td>" . $review['username'] . "</td>
                 <td>" . $review['review'] . "</td>
                 <td>" . $review['like'] . "</td>
                 </tr>";
          }
          echo "</tbody></table>"; 
        }


        //close the DB connection 
        $statement->closeCursor(); 

      ?>

    </main>

<?PHP include('Head_and_footer/footer.php'); ?>