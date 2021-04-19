<?php include('../include/api.php');?> 
<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content='Mark Otto, Jacob Thornton, and Bootstrap contributors'>
    <meta name='generator' content='Hugo 0.82.0'>
    <title>Events</title>

    

    <!-- Bootstrap core CSS -->
<link href='../css/bootstrap.min.css' rel='stylesheet'>
<link href='../css/profile.css' rel='stylesheet'>
  </head>
  <body>
  <table class='table table-striped table-bordered table-hover'>
                     <thead>
                         <th>Student ID</th>
                         <th>Email</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Phone Number</th>
                         <th>Faculty Code</th>
                         <th>Action</th>
                      </thead>
                         <?php 
                         global $connection;
                         $sql = 'SELECT * FROM students';
                         $result = mysqli_query($connection, $sql);
                         while($row = $result->fetch_assoc()) {?>
                            
                      <tbody>
                         <tr>
                         <td><?php echo $row['id']; ?></td>
                         <td><?php echo $row['email']; ?></td>
                         <td><?php echo $row['first_name']; ?></td>
                         <td><?php echo $row['last_name']; ?></td>
                         <td><?php echo $row['phone_no']; ?></td>
                         <td><?php echo $row['f_code']; ?></td>
                         <form action='estudent.php' method='POST'>
                            <input type='hidden' name='stuid'  value='<?php echo $row['id'];?>'>
                            <input type='hidden' name='stuemail'  value='<?php echo $row['email'];?>'>
                         <td><button title='Edit this student details' name='edstu'>Edit</button>
                         <p></p>
                        <button title='Delete Student' class='btn btn-secondary2 btn-sm' name='del_stu' onclick='return checkDel()'>Del</button>
                         </td>
                         </form>
                         </tr>
                         <?php }?>
                      </tbody>
                </table>






  <div class='col-lg-4'>
            <div class='card mb-5 mb-lg-0'>
              <div class='card-body'>
                <h5 class='card-title text-muted text-uppercase text-center'>$eve_name</h5>
                <h6 class='card-price text-center'>K$eve_price</h6>
                <hr>
                <ul class='fa-ul'>
                  <li><span class='fa-li'>Description: </i></span>$eve_desc</li>
                  <li><span class='fa-li'>Date: </span>$eve_date</li>
                  <li><span class='fa-li'>Time: </i></span>$eve_time</li>
                  <li><span class='fa-li'>Address: </i></span>$eve_address</li>
                  <li><span class='fa-li'>City: </i></span>$eve_time</li>
                  <li><span class='fa-li'>Post Code: </i></span>$eve_post</li>
                  <li><span class='fa-li'>Country: </i></span>$eve_country</li>
                  <li><span class='fa-li'>Type: </i></span>$eve_type</li>
                  <li><span class='fa-li'>Available Tickets: </i></span>$eve_atickets</li>
                  <li><span class='fa-li'>Paticipation Type: </i></span>$eve_ptype</li>
                </ul>
                <hr>
                <div class='text-center'>
                <form action='checkout.php' method='POST'>
                    <input type='hidden' name='con_id'  value='$con_id'>
                    <button type='button' class='btn' name='buy_eve'>Buy Now</button>
                    </form>
                </div>
              </div>
            </div>
          </div>


          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
        <!-- <h3>Choose Event </h3> -->
        <table class='table table-striped table-bordered table-hover'>
                     <thead>
                     <th>Event Name</th>
                     <th>Customers</th>
                      </thead>
                         <?php 
                         $em = $_SESSION['US'];
                         $sql = 'SELECT * FROM events WHERE event_owner='$em'';
                         $result = mysqli_query($connection, $sql);
                         while($rw = $result->fetch_assoc()) {?>       
                      <tbody>
                         <tr>
                         <td><?php echo $rw['event_name']; ?></td>
                         <form action='customers.php' method='POST'>
                            <input type='hidden' name='eve_id'  value='<?php echo $row['id'];?>'>
                            <td><button title='View Customers'  type='submit' name='view_cus'>View</button></td>
                         </form>
                         </tr>
                         <?php }?>
                      </tbody>
                </table>

        <!-- <form method='POST' action='customers.php'>
        <select name='eve_type' required>
            <option value='' disabled selected>Choose Event Type</option>
            <option value='conference'>Conference</option>
            <option value='festival'>Festival</option>
            <option value='seminar'>Seminar</option>
            <option value='speaker_session'>Speaker Session</option>
            <option value='workshop'>Workshop</option>
          </select>
          <button type='submit'>Select</button>
        </form> -->
        </div>

        <h4 class='mb-3'>Payment</h4>
        <form class='needs-validation' action='checkout.php' method='POST' novalidate>
          <div class='my-3'>
            <div class='form-check'>
              <input id='credit' name='paymentMethod' type='radio' class='form-check-input' required>
              <label class='form-check-label' for='credit'>Credit card</label>
            </div>
            <div class='form-check'>
              <input id='debit' name='paymentMethod' type='radio' class='form-check-input' >
              <label class='form-check-label' for='debit'>Debit card</label>
            </div>
            <div class='invalid-feedback'>
               Please choose a payment type
              </div>
          </div>

          <div class='row gy-3'>
            <div class='col-md-6'>
              <label for='cc-name' class='form-label'>Name on card</label>
              <input type='text' class='form-control' id='cc-name' placeholder='' required>
              <small class='text-muted'>Full name as displayed on card</small>
              <div class='invalid-feedback'>
                Name on card is required
              </div>
            </div>

            <div class='col-md-6'>
              <label for='cc-number' class='form-label'>Credit card number</label>
              <input type='number' class='form-control' id='cc-number' placeholder='' required>
              <div class='invalid-feedback'>
                Credit card number is required
              </div>
            </div>

            <div class='col-md-3'>
              <label for='cc-expiration' class='form-label'>Expiration</label>
              <input type='text' class='form-control' id='cc-expiration' placeholder='' required>
              <div class='invalid-feedback'>
                Expiration date required
              </div>
            </div>

            <div class='col-md-3'>
              <label for='cc-cvv' class='form-label'>CVV</label>
              <input type='number' class='form-control' id='cc-cvv' placeholder='' required>
              <div class='invalid-feedback'>
                Security code required
              </div>
            </div>
          </div>

          <hr class='my-4'>
          <input type='hidden' name='eve_id'  value='<?php echo '$eve_id';?>'>
          <button class='w-100 btn btn-primary btn-lg' type='submit' name='buy_btn'>BUY</button>
        </form>
      </div>


      <!-- Order page -->
      <!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <style type='text/css'>
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        @media screen and (max-width: 480px) {
            .mobile-hide {
                display: none !important;
            }

            .mobile-center {
                text-align: center !important;
            }
        }

        div[style*='margin: 16px 0;'] {
            margin: 0 !important;
        }
    </style>

<body style='margin: 0 !important; padding: 0 !important; background-color: #eeeeee;' bgcolor='#eeeeee'>
    <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
        For what reason would it be advisable for me to think about business content? That might be little bit risky to have crew member like them.
    </div>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
            <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td align='center' valign='top' style='font-size:0; padding: 35px;' bgcolor='#F44336'>
                            <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;'>
                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                    <tr>
                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;' class='mobile-center'>
                                            <h1 style='font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;'>BBBootstrap</h1>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;' class='mobile-hide'>
                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                    <tr>
                                        <td align='right' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;'>
                                            <table cellspacing='0' cellpadding='0' border='0' align='right'>
                                                <tr>
                                                    <td style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;'>
                                                        <p style='font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;'><a href='#' target='_blank' style='color: #ffffff; text-decoration: none;'>Shop &nbsp;</a></p>
                                                    </td>
                                                    <td style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;'> <a href='#' target='_blank' style='color: #ffffff; text-decoration: none;'><img src='https://img.icons8.com/color/48/000000/small-business.png' width='27' height='23' style='display: block; border: 0px;' /></a> </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding: 35px 35px 20px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                <tr>
                                    <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'> <img src='https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png' width='125' height='120' style='display: block; border: 0px;' /><br>
                                        <h2 style='font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;'> Thank You For Your Order! </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                                        <p style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='padding-top: 20px;'>
                                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                            <tr>
                                                <td width='75%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'> Order Confirmation # </td>
                                                <td width='25%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'> 2345678 </td>
                                            </tr>
                                            <tr>
                                                <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> Purchased Item (1) </td>
                                                <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> $100.00 </td>
                                            </tr>
                                            <tr>
                                                <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'> Shipping + Handling </td>
                                                <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'> $10.00 </td>
                                            </tr>
                                            <tr>
                                                <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'> Sales Tax </td>
                                                <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'> $5.00 </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='padding-top: 20px;'>
                                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                            <tr>
                                                <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'> TOTAL </td>
                                                <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'> $115.00 </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' height='100%' valign='top' width='100%' style='padding: 0 35px 35px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:660px;'>
                                <tr>
                                    <td align='center' valign='top' style='font-size:0;'>
                                        <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                            <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                <tr>
                                                    <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                        <p style='font-weight: 800;'>Delivery Address</p>
                                                        <p>675 Massachusetts Avenue<br>11th Floor<br>Cambridge, MA 02139</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                            <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                <tr>
                                                    <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                        <p style='font-weight: 800;'>Estimated Delivery Date</p>
                                                        <p>January 1st, 2016</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style=' padding: 35px; background-color: #ff7361;' bgcolor='#1b9ba3'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                <tr>
                                    <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                                        <h2 style='font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;'> Get 30% off your next order. </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='center' style='padding: 25px 0 15px 0;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius: 5px;' bgcolor='#66b3b7'> <a href='#' target='_blank' style='font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;'>Shop Again</a> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding: 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                <tr>
                                    <td align='center'> <img src='logo-footer.png' width='37' height='37' style='display: block; border: 0px;' /> </td>
                                </tr>
                                <tr>
                                    <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;'>
                                        <p style='font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;'> 675 Parko Avenue<br> LA, CA 02232 </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;'>
                                        <p style='font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;'> If you didn't create an account using this email address, please ignore this email or <a href='#' target='_blank' style='color: #777777;'>unsusbscribe</a>. </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>




    <!-- Edd eve -->
    <section id='create-event' class='section-with-bg wow fadeInUp'>
      <div class='container'>
      <div class='section-header'>
          <h2>Event edit form</h2>
          <p>You can edit the event using the form below</p>
          <br><br>
          <p>You can't edit the participation type. You'll need to recreate an event for that.</p>
        </div>
      <div class='testbox'>
      <form action='create_event.php' method='POST'>
        <div class='item'>
          <p>Event Name</p>
          <input type='text' name='ename' maxlength='25' value='' required/>
        </div>
        <div class='item'>
          <p>Participation Type</p>
          <input type='text' name='ptype' maxlength='25' value='<?php echo $eve_ptype; ?>' disabled selected/>
        </div>
        <div class='item'>
          <p>Price</p>
          <input type='number' name='eprice' placeholder='ZMW' required/>
        </div>
        <div class='item'>
          <p>Date of Event</p>
          <input type='text' name='edate' class='input--style-3 js-datepicker form-control' required/>
          <i class='fas fa-calendar-alt'></i>
        </div>
        <div class='item'>
          <p>Time of Event</p>
          <input type='time' name='etime' required/>
          <!-- <i class='fas fa-clock'></i> -->
        </div>
        <div class='item'>
          <p>Event Type</p>
          <select name='etype' required>
            <option value='' disabled selected></option>
            <option value='conference'>Conferencee</option>
            <option value='festival'>Festival</option>
            <option value='seminar'>Seminar</option>
            <option value='speaker_session'>Speaker Session</option>
            <option value='workshop'>Workshop</option>
          </select>
        </div>
        <div class='item'>
          <p>Description of Event</p>
          <textarea rows='3' maxlength='150' name='eve_desc' required></textarea>
        </div>
        <div class='item'>
          <p>Venue Address</p>
          <input type='text' name='saddress' placeholder='Street address' required/>
          <div class='city-item'>
            <input type='text' name='vcity' placeholder='City' required/>
            <input type='text' name='pcode' placeholder='Postal / Zip code' required/>
            <input type='text' name='vcountry' disabled/>
            <select name='vcountry' required>
              <option value=''>Country</option>
              <option value='zambia'>Zambia</option>
            </select>
          </div>
        </div>
        <div class='item'>
          <p>Capacity</p>
          <input type='number' name='vcapacity' required/>
        </div>
        <div class='btn-block'>
          <button type='submit' name='ed_eve'>EDIT</button>
        </div>
      </form>
    </div>

      </div>
    </section>
</body>

<?php 

if (isset($_SESSION['US'])){
  $email = $_SESSION['US'];
  //Check for events assigned to email
  $chk_eve = "SELECT * FROM order_history WHERE user = '$email'";
  $re = mysqli_query($connection, $chk_eve);

  if ($re->num_rows > 0){
      $res = mysqli_fetch_array($re);

      $ord_num = $res['id'];
      $eid = $res['event_id'];
      $odate = $res['order_date'];

      $chk = "SELECT * FROM events WHERE id = '$eid'";
      $ret = mysqli_query($connection, $chk);

    while ($row = mysqli_fetch_array($ret)){
        $eve_name = $row['event_name'];
        $eve_price = $row['price'];
        $eve_date = $row['event_date'];
        $eve_time = $row['event_time'];
        $eve_address = $row['street_address'];
        $eve_city = $row['city'];
        $eve_post = $row['post_code'];
        $eve_country = $row['country'];
        $eve_type = $row['event_type'];
        $eve_ptype = $row['participation_type'];


      echo "
    <div class='table-responsive'>
      <table class='table table-striped table-sm'>
        <thead>
          <tr>
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Event Name</th>
            <th>Price</th>
            <th>Event Date</th>
            <th>Event Time</th>
            <th>Address</th>
            <th>City</th>
            <th>Post Code</th>
            <th>Country</th>
            <th>Type</th>
            <th>Participation Type</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$ord_num</td>
            <td>$odate</td>
            <td>$eve_name</td>
            <td>K$eve_price</td>
            <td>$eve_date</td>
            <td>$eve_time</td>
            <td>$eve_address</td>
            <td>$eve_city</td>
            <td>$eve_post</td>
            <td>$eve_country</td>
            <td>$eve_type</td>
            <td>$eve_ptype</td>
          </tr>
        </tbody>
      </table>
    </div>";
      
    }
    
}else{
    echo "You haven't bought anything yet";
}
  
  
}

if (isset($_SESSION['US'])){
  $email = $_SESSION['US'];
  //Check for events assigned to email
  $chk_eve = "SELECT * FROM order_history, events WHERE order_history.event_id = events.id AND order_history.user = '$email'";
  $re = mysqli_query($connection, $chk_eve);

  if ($re->num_rows > 0){
    while ($row = mysqli_fetch_array($re)){
        $ord_num = $row['order_id'];
        $odate = $row['order_date'];
        $eve_name = $row['event_name'];
        $eve_price = $row['price'];
        $eve_date = $row['event_date'];
        $eve_time = $row['event_time'];
        $eve_address = $row['street_address'];
        $eve_city = $row['city'];
        $eve_post = $row['post_code'];
        $eve_country = $row['country'];
        $eve_type = $row['event_type'];
        $eve_ptype = $row['participation_type'];


      echo "
    <div class='table-responsive'>
      <table class='table table-striped table-sm'>
        <thead>
          <tr>
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Event Name</th>
            <th>Price</th>
            <th>Event Date</th>
            <th>Event Time</th>
            <th>Address</th>
            <th>City</th>
            <th>Post Code</th>
            <th>Country</th>
            <th>Type</th>
            <th>Participation Type</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$ord_num</td>
            <td>$odate</td>
            <td>$eve_name</td>
            <td>K$eve_price</td>
            <td>$eve_date</td>
            <td>$eve_time</td>
            <td>$eve_address</td>
            <td>$eve_city</td>
            <td>$eve_post</td>
            <td>$eve_country</td>
            <td>$eve_type</td>
            <td>$eve_ptype</td>
          </tr>
        </tbody>
      </table>
    </div>";
      
    }
    
}else{
    echo "You haven't bought anything yet";
}
  
  
}
$sql = "SELECT * FROM order_history, events WHERE order_history.event_id = events.id AND order_history.user = 'sumi@gmail.com'";
?>
 <table class="table table-striped table-bordered table-hover">
                     <thead>
                     <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Event Name</th>
                    <th>Price</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Post Code</th>
                    <th>Country</th>
                    <th>Type</th>
                    <th>Participation Type</th>
                      </thead>
                         <?php 
                         $email = $_SESSION['US'];
                         //Check for events assigned to email
                         $chk_eve = "SELECT * FROM order_history, events WHERE order_history.event_id = events.id AND order_history.user = '$email'";
                         $re = mysqli_query($connection, $chk_eve);             
                        // $em = $_SESSION['US'];
                        // $sql = "SELECT * FROM events WHERE event_owner='$em'";
                        // $result = mysqli_query($connection, $sql);
                         while($row = $re->fetch_assoc()) {?>       
                      <tbody>
                      <tr>
                      <td><?php echo $row['order_id']; ?></td>
                      <td><?php echo $row['order_date']; ?></td>
                      <td><?php echo $row['event_name']; ?></td>
                      <td><?php echo $row['event_name']; ?></td>
                    </tr>
                  </tr>
                         <?php }?>
                      </tbody>
                </table>




</html>


  </body>
</html>
