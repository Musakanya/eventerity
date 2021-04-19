<?php include('../include/api.php');?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Event Form</title>
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
  <script src="../datepicker/moment.min.js"></script>
  <script src="../datepicker/daterangepicker.js"></script>
  <link href="../datepicker/daterangepicker.css" rel="stylesheet" media="all">
  <script src="../jQuery/jquery-3.4.1.min.js"></script>

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
          <li><a href="../index.php">Home</a></li>
          <li><a href="#about">About</a></li>
          <?php 
              if (isset($_SESSION['US'])){
                echo " <li class='dropdown'><a href='#'><span>Create Event</span> <i class='bi bi-chevron-down'></i></a>
                <ul>
                <li><a href='pages/create_event.php'>Create Event</a></li>
                <li ><a href='pages/create_online_event.php'>Create Event(Online)</a></li>
                </ul>
              </li>";
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
  <section id="intro">
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">Want to know how to<br><span>Plan</span> an event?</h1>
      <p class="mb-4 pb-0">Play the video below</p>
      <a href="https://www.youtube.com/watch?v=I-XjdcpfXoI" class="venobox play-btn mb-4" data-vbtype="video"
        data-autoplay="true"></a>
    </div>
  </section>

  <main id="main">
    <!--==========================
      Create Event
    ============================-->
    <section id="create-event" class="section-with-bg wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Event creation form</h2>
          <p>You can create an event using the form below</p>
        </div>
      <div class="testbox">
      <form action="create_event.php" method="POST">
        <div class="item">
          <p>Event Name</p>
          <input type="text" name="ename" maxlength="25" required/>
        </div>
        <div class="item">
          <p>Participation Type</p>
          <select name="ptype" required>
            <option value="on_site">On-site</option>
            <!-- <option value="online">Online</option>
            <option value="on_site">On-site</option> -->
          </select>
        </div>
        <div class="item">
          <p>Price</p>
          <input type="number" name="eprice" placeholder="ZMW" required/>
        </div>
        <div class="item">
          <p>Date of Event</p>
          <input type="text" name="edate" class="input--style-3 js-datepicker form-control" required/>
          <i class="fas fa-calendar-alt"></i>
        </div>
        <!-- <div class="input-group">
        <input class="input--style-3 js-datepicker form-control" type="text" placeholder="Event Date" name="eve_date" required />
        <i class="fas fa-calendar-alt"></i>
        </div> -->
        <!-- <div class="item">
          <p>Date of Event</p>
          <input type="date" name="edate" required/>
          <i class="fas fa-calendar-alt"></i>
        </div> -->
        <div class="item">
          <p>Time of Event</p>
          <input type="time" name="etime" required/>
          <!-- <i class="fas fa-clock"></i> -->
        </div>
        <div class="item">
          <p>Event Type</p>
          <select name="etype" required>
            <option value="" disabled selected></option>
            <option value="conference">Conferencee</option>
            <option value="festival">Festival</option>
            <option value="seminar">Seminar</option>
            <option value="speaker_session">Speaker Session</option>
            <option value="workshop">Workshop</option>
          </select>
        </div>
        <div class="item">
          <p>Description of Event</p>
          <textarea rows="3" maxlength="150" name="eve_desc" required></textarea>
        </div>
        <!-- <div class="item">
          <p>Venue Name</p>
          <input type="text" name="vname" required/>
        </div> -->
        <div class="item">
          <p>Venue Address</p>
          <input type="text" name="saddress" placeholder="Street address" required/>
          <!-- <input type="text" name="name" placeholder="Street address line 2" /> -->
          <div class="city-item">
            <input type="text" name="vcity" placeholder="City" required/>
            <!-- <input type="text" name="name" placeholder="Region" /> -->
            <input type="text" name="pcode" placeholder="Postal / Zip code" required/>
            <select name="vcountry" required>
              <option value="">Country</option>
              <!-- <option value="kenya">Kenya</option>
              <option value="namibia">Namibia</option>
              <option value="south_africa">South Africa</option> -->
              <option value="zambia">Zambia</option>
            </select>
          </div>
        </div>
        <div class="item">
          <p>Capacity</p>
          <input type="number" name="vcapacity" required/>
        </div>
        <!-- <div class="item">
          <p>Contact Person</p>
          <div class="name-item">
            <input type="text" name="cont_fname" placeholder="Firstname" required/>
            <input type="text" name="cont_lname" placeholder="Lastname" required/>
          </div>
        </div>
        <div class="item">
          <p>Contact Email</p>
          <input type="text" name="cemail" required/>
        </div>
        <div class="item">
          <p>Contact Number</p>
          <input type="text" name="cnum" required/>
        </div> -->
        <div class="btn-block">
          <button type="submit" name="create_eve">CREATE</button>
        </div>
      </form>
    </div>

      </div>
    </section>
  </main>

   

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
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms & Conditions</a></li>
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
  <!-- scripts -->
  <script src="../jQuery/jquery-3.4.1.min.js"></script>
  <script src="../datepicker/moment.min.js"></script>
  <script src="../datepicker/daterangepicker.js"></script>
  <script src="../js/global.js"></script>
</body>

</html>
