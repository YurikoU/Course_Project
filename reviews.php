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

      <?PHP
        //connect to the database 
        require('connect.php'); 


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

        //close the DB connection 
        $statement->closeCursor(); 


      ?>



      <!-- <div>
        <p class="uk-h5"> Comming soon ... </p>
      </div>
 -->


    </main>

<?PHP include('Head_and_footer/footer.php'); ?>