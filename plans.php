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
      <article>

      <div class="uk-child-width-1-2 uk-text-center" uk-grid>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-transition-toggle" tabindex="0" style="background: url(Images/room7.jpg);background-position:0% 50%; background-size:cover;" >
          <!-- the source of the photo https://www.pexels.com/search/hotel/ -->
            <div class="uk-transition-fade">
              <h3>Room A, 1 Queen Bed</h3>
              <ul>
                <li>203 sq ft</li>
                <li>Free WiFi</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Daily housekeeping</li>
                <li>CA $110 per night</li>
              </ul>
              <a href="plans.php#booking_form" class="uk-button">Book This Room</a>
            </div>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body  uk-transition-toggle" tabindex="0" style="background: url(Images/room13.jpg);background-position:0% 50%; background-size:cover;" >
          <!-- the source of the photo https://www.pexels.com/search/hotel/ -->
            <div class="uk-transition-fade">
              <h3>Room B, 1 Queeen Bed</h3>
              <ul>
                <li>203 sq ft</li>
                <li>Free WiFi</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Daily housekeeping</li>
                <li>CA $110 per night</li>
              </ul>
              <a href="plans.php#booking_form" class="uk-button">Book This Room</a>
            </div>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-transition-toggle" tabindex="0" style="background: url(Images/room14.jpg);background-position:0% 50%; background-size:cover;" >
          <!-- the source of the photo https://www.pexels.com/search/hotel/ -->
            <div class="uk-transition-fade">
              <h3>Room C, 1 King Bed</h3>
              <ul>
                <li>220 sq ft</li>
                <li>Free WiFi</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Daily housekeeping</li>
                <li>CA $114 per night</li>
              </ul>
              <a href="plans.php#booking_form" class="uk-button">Book This Room</a>
            </div>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-transition-toggle" tabindex="0" style="background: url(Images/room12.jpg);background-position:0% 50%; background-size:cover;" >
          <!-- the source of the photo https://www.pexels.com/search/hotel/ -->
            <div class="uk-transition-fade">
              <h3>Room D, 1 King Bed</h3>
              <ul>
                <li>220 sq ft</li>
                <li>Free WiFi</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Daily housekeeping</li>
                <li>CA $114 per night</li>
              </ul>
              <a href="plans.php#booking_form" class="uk-button">Book This Room</a>
            </div>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-transition-toggle" tabindex="0" style="background: url(Images/room10.jpg);background-position:0% 50%; background-size:cover;" >
          <!-- the source of the photo https://www.pexels.com/search/hotel/ -->
            <div class="uk-transition-fade">
              <h3>Room E, 1 Super King Bed</h3>
              <ul>
                <li>235 sq ft</li>
                <li>Free WiFi</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Daily housekeeping</li>
                <li>CA $124 per night</li>
              </ul>
              <a href="plans.php#booking_form" class="uk-button">Book This Room</a>
            </div>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-transition-toggle" tabindex="0" style="background: url(Images/room11.jpg);background-position:0% 50%; background-size:cover;" >
          <!-- the source of the photo https://www.pexels.com/search/hotel/ -->
            <div class="uk-transition-fade">
              <h3>Room F, 1 Super King Bed</h3>
              <ul>
                <li>235 sq ft</li>
                <li>Free WiFi</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Daily housekeeping</li>
                <li>CA $120 per night</li>
                <a href="plans.php#booking_form" class="uk-button ">Book This Room</a>
              </ul>
            </div>
            </div>
          </div>
        </div>
      </div>
      </article>

      <article>
        <div class="container">
          <div class="col">
            <form id="booking_form" action="booking_process.php" method="post" name="form" onsubmit="return confirmation()">
              <div class="row">
                <div class="col-sm-4 form-group">
                  <label class="form-label">First Name<input class="form-control" type="text" name="first_name" placeholder="E.g. John" required></label>
                </div>
                <div class="col-sm-4 form-group">
                  <label class="form-label">Last Name<input class="form-control" type="text" name="last_name" placeholder="E.g. Smith" required></label>
                </div>
                <div class="col-sm-4 form-group">
                  <label class="form-label">Phone Number<input class="form-control" type="tel" name="phone" placeholder="E.g. 604-1234-5678" required></label>
                </div>          
              </div>
              <div class="row">
                <div class="col-sm-3 form-group">
                  <label class="form-label">E-mail Address<input class="form-control" type="email" name="email" placeholder="E.g. example@gloryhotel.ca"></label>
                </div>
                <div class="col-sm-3 form-group">
                  <label class="form-label" for="room_type">Room Type</label>
                    <select class="form-control" id="room_type" name="room_type" required>
                      <option value="" selected> ---Please select from the menu--- </option>
                      <option value="Room A, 1 Queen Bed">Room A, 1 Queen Bed</option>
                      <option value="Room B, 1 Queen Bed">Room B, 1 Queen Bed</option>
                      <option value="Room C, 1 King Bed">Room C, 1 King Bed</option>
                      <option value="Room D, 1 King Bed">Room D, 1 King Bed</option>
                      <option value="Room E, 1 Super King Bed">Room E, 1 Super King Bed</option>
                      <option value="Room F, 1 Super King Bed">Room F, 1 Super King Bed</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                  <label class="form-label">Check-in<input class="form-control" type="datetime-local" name="check_in" required></label>
                </div>
                <div class="col-sm-3 form-group">
                  <label class="form-label">Check-out<input class="form-control" type="datetime-local" name="check_out"></label>
                </div>
              </div>
              <button class="btn btn-primary" name="submit">Book this room</button>
            </form>
          </div>
        </div>
      </article>


    </main>
    <script type="text/javascript">
        //   alert(document.form.first_name.value );
        //   alert(document.form.last_name.value );
        //   alert(document.form.phone.value );
        //   alert(document.form.email.value );
        //   alert(document.form.room_type.value );
        //   alert(document.form.check_in.value );
        //   alert(document.form.check_out.value );

        function confirmation() { 
          if (confirm("Do you want to book the room?"))
          {
            location.href = "booking_process.php";
            return true;
          } else {
            return false;
          }
        }
    </script>

<?PHP include('Head_and_footer/footer.php'); ?>