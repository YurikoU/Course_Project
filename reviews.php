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
              <label>Search reviews by the term<input type="text" name="search_terms" placeholder="Please enter any word"></label>
            </div>
            <button  class="uk-button" name="search">Search</button>
            <button  class="uk-button" name="reset">Reset</button>
          </div>
        </form>


      <?PHP
        session_start(); 

        //Initialize variables
        $name = null;
        $search_terms = null;
        $search = null;
        $reset = null;

        //Store the user input 
        $name = filter_input(INPUT_GET, 'name');
        $search_terms = filter_input(INPUT_GET, 'search_terms');
        $search = filter_input(INPUT_GET, 'search');
        $reset = filter_input(INPUT_GET, 'reset');
        //Session will be started by $name once a user enter their name
        $_SESSION['name'] = $name;

        //connect to the database 
        require('connect.php'); 


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

              $sql = "SELECT * FROM reviews WHERE 0 < post_id";
              $terms = preg_split("/[ ]+/", $_GET['search_terms']);
              foreach($terms as $term)
              {
                //Plus another term a user want to search to the above original query
                $sql .= " AND review LIKE :term";
                //Call the prepare method of the PDO object
                $statement = $dbo->prepare($sql);
                //Bind parameter
                $statement->bindValue(':term', '%'.$term.'%');
              }
              $sql .= ";";

            } else 
            {
              //If a user enter a single word

              //Set up SQL statement 
              $search_reviews_query = "SELECT * FROM reviews WHERE review LIKE :search_terms";
              //Call the prepare method of the PDO object
              $statement = $dbo->prepare($search_reviews_query);
              //Bind parameter
              $statement->bindValue(':search_terms', '%'.$search_terms.'%');
            }

            //Execute the query
            $statement->execute();


            //check for results and display, if not, let the user know that no results found 
            if($statement->rowCount() >= 1) 
            {
              //Display the word a user entered
              echo "<p>Searched term: \"$search_terms\"</p>"; 

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
              
              //close the DB connection 
              $statement->closeCursor(); 


            } else
            {
              //Display the word a user entered
              echo "<p>Searched term: \"$search_terms\"</p>"; 
              //If any result wasn't found, the message will be displayed.
              echo "<p>No results found! Please try to search by another word.</p>"; 
            }

          } else 
          {
            //If the search term is not valid
            echo "<p>Please enter a proper word.</p>"; 
          }   


        } else if ((!isset($search)) || (!empty($reset)))
        {
          //If a user is not searching or clicks a reset button, simply display all customer reviews

          //set up SQL statement 
          $view_reviews_query = "SELECT * FROM reviews"; 
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

          //Close the DB connection 
          $statement->closeCursor(); 
        }

      ?>

    </main>

<?PHP include('Head_and_footer/footer.php'); ?>