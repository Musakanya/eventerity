<?php include('../include/api.php');?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Event Type</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../lib/venobox/venobox.css" rel="stylesheet">
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="../css/styles.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>



  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
        <a href="#intro"><img src="../img/logo.png" alt="" title=""></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="../index.php">Home</a></li>
          <li><a href="#about">About</a></li>
          <?php 
              if (isset($_SESSION['US'])){
                echo " <li><a href='create_event.php'>Create Event</a></li>";
                echo " <li class='dropdown'><a href='#'><span>Profile</span> <i class='bi bi-chevron-down'></i></a>
                <ul>
                  <li><a href='dashboard.php'>Dashboard</a></li>
                  <li><a href='logout.php'>Logout</a></li>
                </ul>
              </li>";
              }else{
                echo "<li><a href='login.php'>Login</a></li>
                <li><a href='signup.php'>Sign Up</a></li>";
              }
          ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->


  <!--==========================
    Intro Section
  ============================-->
  <section>
  </section>

  <main id="main">
    <!--==========================
      Buy Ticket Section
    ============================-->
    <section id="buy-tickets" class="section-with-bg wow fadeInUp">
      <div class="container">
        <div class="row">
        <?php
    if (isset($_SESSION['US'])){
        if (isset($_POST['buy_now'])){
            if (isset($_POST['eve_type'])){
                $eve_type = $_POST['eve_type'];
                $email = $_SESSION['US'];
                

                $sql = "SELECT * FROM events WHERE event_type = '$eve_type'";
                $ret = mysqli_query($connection, $sql);

                if($ret->num_rows > 0){
                   //Get event type info 
                while ($row = mysqli_fetch_array($ret)){
                  $eve_name = $row['event_name'];
                  $eve_price = $row['price'];
                  $eve_date = $row['event_date'];
                  $eve_time = $row['event_time'];
                  $eve_address = $row['street_address'];
                  $eve_city = $row['city'];
                  $eve_post = $row['post_code'];
                  $eve_country = $row['country'];
                  $eve_desc = $row['event_description'];
                  $eve_type = $row['event_type'];
                  $eve_ptype = $row['participation_type'];
                  $eve_atickets = $row['tickets_available'];
                  $eve_own = $row['event_owner'];
                  $eve_id = $row['id'];

                  $cur_date = date("Y-m-d");//Assign current date to variable

                  //Check if the event has been sold out
                  if ($eve_atickets > 0){
                    if ($eve_date >= $cur_date)//Check for events greater than or equal to current date
                  {
                    echo "<div class='col-lg-4'>
                  <div class='card mb-5 mb-lg-0'>
                    <div class='card-body'>
                      <h5 class='card-title text-muted text-uppercase text-center'>$eve_name</h5>
                      <br><h5 class='card-title text-muted text-uppercase text-center'>BY $eve_own</h5>
                      <br>
                      <h6 class='card-price text-center'>K$eve_price</h6>
                      <hr>
                      <ul class='fa-ul'>
                        <li><span class='fa-li'></span>Description: $eve_desc</li>
                        <li><span class='fa-li'></span>Type: $eve_type</li>
                        <li><span class='fa-li'></span>Paticipation Type: $eve_ptype</li>
                        <li><span class='fa-li'></span>Available Tickets: $eve_atickets</li>
                        <li><span class='fa-li'></span>Date: $eve_date</li>
                        <li><span class='fa-li'></span>Time: $eve_time</li>
                        <li><span class='fa-li'></span>Address: $eve_address</li>
                        <li><span class='fa-li'></span>City: $eve_city</li>
                        <li><span class='fa-li'></span>Post Code: $eve_post</li>
                        <li><span class='fa-li'></span>Country: $eve_country</li>
                      </ul>
                      <hr>
                      <div class='text-center'>
                      <form action='checkout.php' method='POST'>
                          <input type='hidden' name='eve_id'  value='$eve_id'>
                          <button type='submit' class='btn' name='buy_eve'>Buy Now</button>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>";
                  }else{
                    echo "<div class='section-header'>
                          <h2>Sorry ther are not events of this type yet</h2></div>";
                }
                  }else {
                    if ($eve_date >= $cur_date)//Check for events greater than or equal to current date
                  {
                    echo "<div class='col-lg-4'>
                  <div class='card mb-5 mb-lg-0'>
                    <div class='card-body'>
                      <h5 class='card-title text-muted text-uppercase text-center'>$eve_name <img src='../img/sold2.svg' width='30' height='30' alt='SOLD OUT' title='SOLD OUT'></h5>
                      <br><h5 class='card-title text-muted text-uppercase text-center'>BY $eve_own</h5>
                      <br>
                      <h6 class='card-price text-center'>K$eve_price</h6>
                      <hr>
                      <ul class='fa-ul'>
                        <li><span class='fa-li'></span>Description: $eve_desc</li>
                        <li><span class='fa-li'></span>Type: $eve_type</li>
                        <li><span class='fa-li'></span>Paticipation Type: $eve_ptype</li>
                        <li><span class='fa-li'></span>Available Tickets: SOLD OUT</li>
                        <li><span class='fa-li'></span>Date: $eve_date</li>
                        <li><span class='fa-li'></span>Time: $eve_time</li>
                        <li><span class='fa-li'></span>Address: $eve_address</li>
                        <li><span class='fa-li'></span>City: $eve_city</li>
                        <li><span class='fa-li'></span>Post Code: $eve_post</li>
                        <li><span class='fa-li'></span>Country: $eve_country</li>
                      </ul>
                      <hr>
                      <div class='text-center'>
                      <form action='checkout.php' method='POST'>
                          <input type='hidden' name='eve_id'  value='$eve_id'>
                          <button style='background-color:grey' class='btn' disabled>Buy Now</button>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>";
                  }else{
                    echo "<div class='section-header'>
                          <h2>Sorry ther are not events of this type yet</h2></div>";
                }
                  }
                  
                  
              }
             }
            }
          }
    }?>
      </div>

      </div>
    </section>
    </main><!-- End #main -->
   

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="../img/logo.png" alt="TheEvenet">
            <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>TheEvent</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/superfish/hoverIntent.js"></script>
  <script src="../lib/superfish/superfish.min.js"></script>
  <script src="../lib/wow/wow.min.js"></script>
  <script src="../lib/venobox/venobox.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="../contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="../js/main.js"></script>
</body>

</html>
