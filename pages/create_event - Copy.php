<?php
    include('../include/api.php');
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Event Form</title>
    <script src="../jQuery/jquery-3.4.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="../css/create_event.css" rel="stylesheet">
    <script src="../datepicker/moment.min.js"></script>
    <script src="../datepicker/daterangepicker.js"></script>
    <link href="../datepicker/daterangepicker.css" rel="stylesheet" media="all">

  </head>
  <body>
    <div class="testbox">
      <form action="create_event.php" method="POST">
        <div class="banner">
          <h1>Event Creation Form</h1>
        </div>
        <div class="item">
          <p>Event Name</p>
          <input type="text" name="ename" maxlength="25" required/>
        </div>
        <div class="item">
          <p>Participation Type</p>
          <select name="ptype" required>
            <option value="" disabled selected></option>
            <option value="online">Online</option>
            <option value="on_site">On-site</option>
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
              <option value="kenya">Kenya</option>
              <option value="namibia">Namibia</option>
              <option value="south_africa">South Africa</option>
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
  </body>

  <!-- scripts -->
  <script src="../jQuery/jquery-3.4.1.min.js"></script>
  <script src="../datepicker/moment.min.js"></script>
  <script src="../datepicker/daterangepicker.js"></script>
  <script src="../js/global.js"></script>
</html>