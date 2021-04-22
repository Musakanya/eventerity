<?php 
	session_start();

	include('connection.php');
 
    //Create Connection
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// variable declaration 
	$errors   = array(); 
	// call the create account function if button is clicked
	if (isset($_POST['signup-btn'])) {
		create_user_ac();
	}
	// call the create user function if button is clicked
	if (isset($_POST['cre_usr'])) {
		cre_usr();
	}
	// call the login function if login_user button is clicked
	if (isset($_POST['login-btn'])) {
		login();
	}
	// call the create event function if create button is clicked    
	if (isset($_POST['create_eve'])) {
		create_eve();
	}
	// call the create event function if create button is clicked    
	if (isset($_POST['create_onl_eve'])) {
		create_onl_eve();
	}
	// call the buy function if buy button is clicked 
	if (isset($_POST['buy_btn'])) {
		buy_eve();
	}
	// call the  edit article function if edit button clicked
	if (isset($_POST['edd_eve'])) {
		ed_eve();
	}
	// call the  update user details function if update button clicked 
	if (isset($_POST['update-btn'])) {
		update_usr_details();
	}
	// call the  update user details function if update button clicked 
	if (isset($_POST['up_usr'])) {
		up_usr();
	}
	// call the  update admin details function if update button clicked 
	if (isset($_POST['ad_upd'])) {
		ad_upd();
	}
	// call the  update user details function if update button clicked
	if (isset($_POST['chg-pass-btn'])) { 
		update_usr_pass();
	}
	// call the  update user password function if update button clicked
	if (isset($_POST['chg_usr_pass'])) { 
		up_usr_pass();
	}
	// call the  update admin password function if update button clicked
	if (isset($_POST['ad_pass'])) { 
		ad_pass();
	}
	// call the  delete user function if update button clicked
	if (isset($_POST['del_usr'])) {
		del_usr();
	}
	// call the  delete event function if update button clicked
	if (isset($_POST['del_eve'])) {
		del_eve();
	}



	// REGISTER USER
	function create_user_ac(){
		global $connection, $errors;

		// receive all input values from the form
		$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
        
        //Check if user exists
        $sql = "SELECT * FROM user WHERE email = '$email' ";
        $ret = mysqli_query($connection, $sql);
        $retresults = mysqli_num_rows($ret);

		if ($retresults == 0) {
			if (count($errors) == 0) {
			//Encrypt Password
			$hash = password_hash($password, PASSWORD_DEFAULT);

			$sql_ac = mysqli_query($connection, "INSERT INTO user (email, password, first_name, last_name, phone_no, user_type) 
			VALUES ('$email', '$hash', '$first_name', '$last_name', '$phone_no', 'US')");
			
			if ($sql_ac){
				//Add sucess to session
				$_SESSION['success'] = "<h5>Account Created! You can sign in<h5>";
			// echo '<script>alert("Account created")</script>';
			echo "<script>window.location='login.php'</script>";
			}
			}
			// die(print_r($re2));
		}else {
			array_push($errors, "Email is in use");
		}
	}
	// REGISTER USER from admin
	function cre_usr(){
		global $connection, $errors;

		// receive all input values from the form
		$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$user_type = mysqli_real_escape_string($connection, $_POST['user_type']);
        
        //Check if user exists
        $sql = "SELECT * FROM user WHERE email = '$email' ";
        $ret = mysqli_query($connection, $sql);
        $retresults = mysqli_num_rows($ret);

		if ($retresults == 0) {
			if (count($errors) == 0) {
			//Encrypt Password
			$hash = password_hash($password, PASSWORD_DEFAULT);

			$sql_ac = mysqli_query($connection, "INSERT INTO user (email, password, first_name, last_name, phone_no, user_type) 
			VALUES ('$email', '$hash', '$first_name', '$last_name', '$phone_no', '$user_type')");
			
			if ($sql_ac > 0){
			echo '<script>alert("Account created")</script>';
			echo "<script>window.location='../admin.php'</script>";
			}
			}
			// die(print_r($re2));
		}else {
			array_push($errors, "Email is in use");
		}
	}
	// LOGIN USER
	function login(){
		global $connection, $errors;

		// grab form values
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);

		// Check inputs
		if (empty($email) and empty($password)) {array_push($errors, "Email and password are required");}
        
        // attempt login if no errors on form
		if (count($errors) == 0) {

			$checkUserSql =  "SELECT * FROM user WHERE email='$email' LIMIT 1";//Check if details exist
			$result = mysqli_query($connection, $checkUserSql) or die(mysqli_error($connection));

			if (mysqli_num_rows($result) > 0){
			$fetchres = mysqli_fetch_array($result);

				if (password_verify($password, $fetchres['password'])){//Check if the password entered matches the one in db

					$ut = $fetchres['user_type'];
					$u_email = $fetchres['email'];

					// die(print_r($fetchres));
					

					if ($ut == 'AD') {
						$_SESSION['AD'] = $u_email;
						header('location: admin.php');
					}
					elseif ($ut == 'US'){
						$_SESSION['US'] = $u_email;
						header('location: ../index.php');
				}
			}
                else {
			array_push($errors, "Invalid Email or Password"); 
		} }else {
			array_push($errors, "Invalid Email or Password"); 

		}
	}
}

	function create_eve(){
		global $connection;
		if (isset($_SESSION['US'])){
			$email = $_SESSION['US'];

			$ename = mysqli_real_escape_string($connection, $_POST['ename']);
			$ptype = mysqli_real_escape_string($connection, $_POST['ptype']);
			$eprice = mysqli_real_escape_string($connection, $_POST['eprice']);
			$edate = mysqli_real_escape_string($connection, $_POST['edate']); 
			$etime = mysqli_real_escape_string($connection, $_POST['etime']);
			$etype = mysqli_real_escape_string($connection, $_POST['etype']);
			$eve_desc = mysqli_real_escape_string($connection, $_POST['eve_desc']);
			$saddress = mysqli_real_escape_string($connection, $_POST['saddress']);
			$vcity = mysqli_real_escape_string($connection, $_POST['vcity']);
			$pcode = mysqli_real_escape_string($connection, $_POST['pcode']);
			$vcountry = mysqli_real_escape_string($connection, $_POST['vcountry']);
			$vcapacity = mysqli_real_escape_string($connection, $_POST['vcapacity']);
			
			$cret_eve = "INSERT INTO events (event_name, event_date, 
			event_time, street_address, city, post_code, country, price, event_description, 
			tickets_available, event_owner, event_type, participation_type)
			VALUES ('$ename', '$edate', '$etime', '$saddress', '$vcity', '$pcode', '$vcountry', 
			'$eprice', '$eve_desc', '$vcapacity', '$email', '$etype', '$ptype')";

			$res = mysqli_query($connection, $cret_eve);

			// die(print_r($cret_eve));


			if ($res > 0){
				echo '<script>alert("Event Created")</script>';
			}else{
				echo '<script>alert("Creation Failed")</script>';
			}

		}else{
			echo '<script>alert("Something went wrong")</script>';
		}
	}
	function create_onl_eve(){
		global $connection;
		if (isset($_SESSION['US'])){
			$email = $_SESSION['US'];

			$ename = mysqli_real_escape_string($connection, $_POST['ename']);
			$ptype = mysqli_real_escape_string($connection, $_POST['ptype']);
			$eprice = mysqli_real_escape_string($connection, $_POST['eprice']);
			$edate = mysqli_real_escape_string($connection, $_POST['edate']); 
			$etime = mysqli_real_escape_string($connection, $_POST['etime']);
			$etype = mysqli_real_escape_string($connection, $_POST['etype']);
			$eve_desc = mysqli_real_escape_string($connection, $_POST['eve_desc']);
			$eve_url = mysqli_real_escape_string($connection, $_POST['eve_url']);
			$saddress = mysqli_real_escape_string($connection, $_POST['saddress']);
			$vcity = mysqli_real_escape_string($connection, $_POST['vcity']);
			$pcode = mysqli_real_escape_string($connection, $_POST['pcode']);
			$vcountry = mysqli_real_escape_string($connection, $_POST['vcountry']);
			$vcapacity = mysqli_real_escape_string($connection, $_POST['vcapacity']);
			
			$cret_eve = "INSERT INTO events (event_name, event_date, 
			event_time, street_address, city, post_code, country, price, event_description, event_url, 
			tickets_available, event_owner, event_type, participation_type)
			VALUES ('$ename', '$edate', '$etime', '$saddress', '$vcity', '$pcode', '$vcountry', 
			'$eprice', '$eve_desc', '$eve_url', '$vcapacity', '$email', '$etype', '$ptype')";

			$res = mysqli_query($connection, $cret_eve);

			// die(print_r($cret_eve));


			if ($res > 0){
				echo '<script>alert("Event Created")</script>';
			}else{
				echo '<script>alert("Creation Failed")</script>';
			}

		}else{
			echo '<script>alert("Something went wrong")</script>';
		}
	}

	//Buy event
	function buy_eve(){
		global $connection;

		if (isset($_SESSION['US'])){
			$email = $_SESSION['US'];
			$eve_id = $_POST['eve_id'];
			$ran = (random_int(10000, 99999));


			// $sql = "INSERT INTO user_on_event (email, event_id) VALUES('$email', '$eve_id')";
			$sql = "INSERT INTO order_history (order_id, event_id, order_date, user) VALUES('$ran', '$eve_id', CURDATE(), '$email')";

			$res = mysqli_query($connection, $sql);
			// $res2 = mysqli_query($connection, $qry) ;
			

			if ($res){
				$get_eve_name = "SELECT * FROM events WHERE id = $eve_id";
				$ret = mysqli_query($connection, $get_eve_name);

				if ($ret){
					$conf = mysqli_fetch_array($ret);
					$eve_name = $conf['event_name'];
					$eve_price = $conf['price'];
					$eve_url = $conf['event_url'];


					$_SESSION['eve_name']  = $eve_name;
					$_SESSION['eve_price']  = $eve_price;
					$_SESSION['order_num']  = $ran;
					$_SESSION['eve_url'] = $eve_url;

					$ord_id = $ran;
					$ord_date = date('Y/m/d');
					//Sending Email
					$par_type = $conf['participation_type'];
					if ($par_type == "on_site"){
						// email starts
                        
						$contri =
                        // coding for style and design for the email content the body of the email
					   "<!DOCTYPE html>
                  <html>
                  <head>
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
                      <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                          <tr>
                              <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>
                                  <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                      <tr>
                                          <td align='center' valign='top' style='font-size:0; padding: 35px;' bgcolor='#f82249'>
                                              <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;'>
                                                  <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                      <tr>
                                                          <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;' class='mobile-center'>
                                                              <h1 style='font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;'>Eventerity</h1>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </div>
                                              <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;' class='mobile-hide'>
                                                  <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                      <tr>
                                                          <td align='right' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;'>
                                                              <table cellspacing='0' cellpadding='0' border='0' align='right'>
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
                                                      <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'> <img src='../img/checked-checkbox.png' width='125' height='120' style='display: block; border: 0px;' /><br>
                                                          <h2 style='font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;'> Thank You For Your Order! </h2>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                                                          <p style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'> (Please keep a copy of this receipt for your records.)</p>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='left' style='padding-top: 20px;'>
                                                          <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                                              <tr>
                                                                  <td width='75%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'> Order #</td>
                                                                  <td width='25%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'> $ord_id</td>
                                                              </tr>
                                                              <tr>
                                                                  <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> Purchased Item ($eve_name) </td>
                                                                  <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'>ZMW$eve_price</td>
                                                              </tr>
                  
                                                          </table>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='left' style='padding-top: 20px;'>
                                                          <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                                              <tr>
                                                                  <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'> TOTAL </td>
                                                                  <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>ZMW$eve_price</td>
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
                                                                          <p>$email</p>
                                                                      </td>
                                                                  </tr>
                                                              </table>
                                                          </div>
                                                          <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                                              <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                                  <tr>
                                                                      <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                                          <p style='font-weight: 800;'>Order Date</p>
                                                                          <p>$ord_date</p>
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
                                          <td align='center' style='padding: 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                                              <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                                  <tr>
                                                      <td align='center'> <img src='../img/add2.svg' width='37' height='37' style='display: block; border: 0px;' /> </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;'>
                                                          <p style='font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;'> Eventerity<br> House No 3 Chilanga<br> LS, ZM 10101 </p>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;'>
                                                          <p style='font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;'> If you didn't create an account using this email address, please ignore this email</p>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                  </table>
                              </td>
                          </tr>
                      </table>
                  </body>
                  
                  </html>
                  ";
    
                 //link to the phpmailerautoload file in the folder
                 require 'phpmailer/PHPMailerAutoload.php';

                 $mail = new PHPMailer;
                 
                 //$mail->SMTPDebug = 4;                            // Enables verbose debug output to check errors

                 $mail->isSMTP();                                   // Sets mailer to use SMTP
                 $mail->Host = 'smtp.gmail.com';                    // Main and backup SMTP servers
                 $mail->SMTPAuth=true;                              // Enables SMTP authentication
                 $mail->Username = 'eventeritysp@gmail.com';        // SMTP username - change this to the email of the sender
                 $mail->Password = 'tS!Hci:YV65ZGTH';               // SMTP password - the password for the email of the sender
                 $mail->SMTPSecure='tls';                           // Enables TLS encryption, `ssl` also accepted
                 $mail->Port=587;               
                        
                 $mail->setFrom('eventeritysp@gmail.com', 'Order Receipt'); // what the email is called
                 $mail->addAddress($email);                          // a recipient - the person receiving the email
                 $mail->addReplyTo('eventeritysp@gmail.com');
                 $mail->isHTML(true);                                // Email format is HTML
                 $mail->Subject = "Eventerity Order Receipt";
                 // this is the body variable that is style on top
                 $mail->Body    = "$contri";   
                       
                  // if email is sent go to article page        
                  if(!$mail->send()) {
                     echo 'Message could not be sent.';
                     echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                    //   echo '<script>alert("Email sent")</script>';
                     // echo '<script>alert("Thank you for your purchase")</script>';
					 echo "<script>window.location='order_confirmation.php'</script>";
				  }
				  
					}elseif ($par_type == "online"){
						// email starts
                        
						$contri =
                        // coding for style and design for the email content the body of the email
					   "<!DOCTYPE html>
                  <html>
                  <head>
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
                      <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                          <tr>
                              <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>
                                  <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                      <tr>
                                          <td align='center' valign='top' style='font-size:0; padding: 35px;' bgcolor='#f82249'>
                                              <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;'>
                                                  <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                      <tr>
                                                          <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;' class='mobile-center'>
                                                              <h1 style='font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;'>Eventerity</h1>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </div>
                                              <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;' class='mobile-hide'>
                                                  <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                      <tr>
                                                          <td align='right' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;'>
                                                              <table cellspacing='0' cellpadding='0' border='0' align='right'>
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
                                                      <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'> <img src='../img/checked-checkbox.png' width='125' height='120' style='display: block; border: 0px;' /><br>
                                                          <h2 style='font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;'> Thank You For Your Order! </h2>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                                                          <p style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'> (Please keep a copy of this receipt for your records.)</p>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='left' style='padding-top: 20px;'>
                                                          <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                                              <tr>
                                                                  <td width='75%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'> Order #</td>
                                                                  <td width='25%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'> $ord_id</td>
                                                              </tr>
                                                              <tr>
                                                                  <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> Purchased Item ($eve_name) </td>
                                                                  <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'>ZMW$eve_price</td>
                                                              </tr>
                  
                                                          </table>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='left' style='padding-top: 20px;'>
                                                          <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                                              <tr>
                                                                  <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'> TOTAL </td>
                                                                  <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>ZMW$eve_price</td>
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
                                                                          <p>$email</p>
																		  <p style='font-weight: 800;'>Event Link</p>
																		  <p>$eve_url</p>
                                                                      </td>
                                                                  </tr>
                                                              </table>
                                                          </div>
                                                          <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                                              <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                                                  <tr>
                                                                      <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                                          <p style='font-weight: 800;'>Order Date</p>
                                                                          <p>$ord_date</p>
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
                                          <td align='center' style='padding: 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                                              <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                                                  <tr>
                                                      <td align='center'> <img src='../img/add2.svg' width='37' height='37' style='display: block; border: 0px;' /> </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;'>
                                                          <p style='font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;'> Eventerity<br> House No 3 Chilanga<br> LS, ZM 10101 </p>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;'>
                                                          <p style='font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;'> If you didn't create an account using this email address, please ignore this email</p>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                  </table>
                              </td>
                          </tr>
                      </table>
                  </body>
                  
                  </html>
                  ";
    
                 //link to the phpmailerautoload file in the folder
                 require 'phpmailer/PHPMailerAutoload.php';

                 $mail = new PHPMailer;
                 
                 //$mail->SMTPDebug = 4;                            // Enables verbose debug output to check errors

                 $mail->isSMTP();                                   // Sets mailer to use SMTP
                 $mail->Host = 'smtp.gmail.com';                    // Main and backup SMTP servers
                 $mail->SMTPAuth=true;                              // Enables SMTP authentication
                 $mail->Username = 'eventeritysp@gmail.com';        // SMTP username - change this to the email of the sender
                 $mail->Password = 'tS!Hci:YV65ZGTH';               // SMTP password - the password for the email of the sender
                 $mail->SMTPSecure='tls';                           // Enables TLS encryption, `ssl` also accepted
                 $mail->Port=587;               
                        
                 $mail->setFrom('eventeritysp@gmail.com', 'Order Receipt'); // what the email is called
                 $mail->addAddress($email);                          // a recipient - the person receiving the email
                 $mail->addReplyTo('eventeritysp@gmail.com');
                 $mail->isHTML(true);                                // Email format is HTML
                 $mail->Subject = "Eventerity Order Receipt";
                 // this is the body variable that is style on top
                 $mail->Body    = "$contri";   
                       
                  // if email is sent go to article page        
                  if(!$mail->send()) {
                     echo 'Message could not be sent.';
                     echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                    //   echo '<script>alert("Email sent")</script>';
                     // echo '<script>alert("Thank you for your purchase")</script>';
					 echo "<script>window.location='order_confirmation.php'</script>";
				  }
					}
				}
			}else {
				echo '<script>alert("Purchase Failed")</script>';
			}

		}
	}
	//Edit event
	function ed_eve(){
		global $connection;

			// $email = $_SESSION['US'];
			$eve_id = $_POST['edd_eve'];

			$ename = mysqli_real_escape_string($connection, $_POST['ename']);
			$eprice = mysqli_real_escape_string($connection, $_POST['eprice']);
			$edate = mysqli_real_escape_string($connection, $_POST['edate']); 
			$etime = mysqli_real_escape_string($connection, $_POST['etime']);
			$etype = mysqli_real_escape_string($connection, $_POST['etype']);
			$eve_desc = mysqli_real_escape_string($connection, $_POST['eve_desc']);
			$saddress = mysqli_real_escape_string($connection, $_POST['saddress']);
			$vcity = mysqli_real_escape_string($connection, $_POST['vcity']);
			$pcode = mysqli_real_escape_string($connection, $_POST['pcode']);
			$vcountry = mysqli_real_escape_string($connection, $_POST['vcountry']);
			$vcapacity = mysqli_real_escape_string($connection, $_POST['vcapacity']);


			$sql = "UPDATE events set event_name ='$ename', event_date ='$edate', 
			event_time = '$etime', street_address = '$saddress', 
			city = '$vcity' , post_code = '$pcode', country = '$vcountry', 
			price = '$eprice', event_description = '$eve_desc', tickets_available = '$vcapacity', 
			event_type = '$etype' WHERE id = '$eve_id'";
			$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Update successful')</script>";
							echo "<script>window.location='../pages/events.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
					}

					//Updating user profile from user account
				function update_usr_details() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$em = $_SESSION['US'];

					$sql = "UPDATE user set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE email = '$em'";
					$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Update successful')</script>";
							echo "<script>window.location='../pages/profile.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating user profile from admin account
				function up_usr() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$em = $_POST['up_usr'];

					$sql = "UPDATE user set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE email = '$em'";
					$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Update successful')</script>";
							echo "<script>window.location='../pages/admin.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating admin profile from admin account
				function ad_upd() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$em = $_SESSION['AD'];

					$sql = "UPDATE user set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE email = '$em'";
					$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Update successful')</script>";
							echo "<script>window.location='../pages/admin.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}

				//Updating user password from user profile
				function update_usr_pass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$em = $_SESSION['US'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE user set password = '$hash' WHERE email = '$em'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							$_SESSION['update'] = "Update successful";
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../pages/login.php'</script>";
							// remove all session variables
							session_unset();

							// destroy the session
							session_destroy();
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating user password from admin profile
				function up_usr_pass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$em = $_POST['chg_usr_pass'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE user set password = '$hash' WHERE email = '$em'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../pages/admin.php'</script>";
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating admin password from admin profile
				function ad_pass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$em = $_SESSION['AD'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE user set password = '$hash' WHERE email = '$em'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>window.location='../pages/login.php'</script>";
							// remove all session variables
							session_unset();

							// destroy the session
							session_destroy();
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Delete user from admin
				function del_usr(){
					global $connection;
						
					$uem = $_POST['del_usr'];
					$del_usr = mysqli_query($connection, "DELETE FROM user WHERE email = '$uem'");

						// die (print_r($chk_eve));
						if ($del_usr == 1){
							echo '<script>alert("Deletion successful")</script>';
							echo "<script>window.location='../pages/admin.php'</script>";
						}else {
							echo '<script>alert("Something went wrong")</script>';
						}
					}

				//Delete events without customers
				function del_eve(){
					global $connection;
						
					$eve_id = $_POST['del_eve'];

					$chk_eve = mysqli_query($connection, "SELECT event_id FROM order_history WHERE event_id ='$eve_id'");//Check for event_id
					$ret_eve = mysqli_num_rows($chk_eve);

					if ($ret_eve > 0){
						echo '<script>alert("You cannot delete an event with customers on it!")</script>'; 
						echo "<script>window.location='../pages/events.php'</script>";
					}else{
						$del_eve = mysqli_query($connection, "DELETE FROM events WHERE id = '$eve_id'");

						// die (print_r($chk_eve));
						if ($del_eve == 1){
							echo '<script>alert("Deletion successful")</script>';
							echo "<script>window.location='../pages/events.php'</script>";
						}else {
							echo '<script>alert("Something went wrong")</script>';
						}
					}
				}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>