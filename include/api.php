<?php 
	session_start();

	include('connection.php');
 
    //Create Connection
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// variable declaration 
	$errors   = array(); 
	// call the create student function if button is clicked
	if (isset($_POST['signup-btn'])) {
		create_user_ac();
	}
	// call the login function if login_user button is clicked
	if (isset($_POST['login-btn'])) {
		login();
	}
	// call the create event function if create button is clicked
	if (isset($_POST['create_eve'])) {
		create_eve();
	}


	
	// call the upload function if upload button clicked
	if (isset($_POST['upload_btn'])) {
		upload();
	}
	// call the  edit article function if edit button clicked
	if (isset($_POST['ed_art'])) {
		ed_art();
	}
	// call the  delete article function if delete button clicked
	if (isset($_POST['del_art'])) {
		del_art();
	}
	// call the  delete student function if delete button clicked
	if (isset($_POST['del_stu'])) {
		del_stu();
	}
	// call the  delete student function if delete button clicked
	if (isset($_POST['del_sta'])) {
		del_sta();
	}
	// call the  edit staff function if edit button clicked 
	if (isset($_POST['esta'])) {
		esta();
	}
	// call the  edit student function if edit button clicked 
	if (isset($_POST['estu'])) {
		estu();
	}
	
	// call the update student profile function if  button is clicked
	if (isset($_POST['update_btn'])) {
		update_stu_details();
	}
	// call the update marketing coordinator profile function if button is clicked
	if (isset($_POST['mcprof'])) {
		mcprof();
	}
	// call the update marketing manager profile function if button is clicked
	if (isset($_POST['mmprof'])) {
		mmprof();
	}
	// call the update stutent password function if  button is clicked 
	if (isset($_POST['studpass'])) {
		studpass();
	}
	// call the update staff password function if  button is clicked 
	if (isset($_POST['mcpass'])) {
		mcpass();
	}
	// call the update staff password function if  button is clicked 
	if (isset($_POST['mmpass'])) {
		mmpass();
	}
	
	// call the Updating staff password  function if  button is clicked
	if (isset($_POST['spass'])) {
		spass();
	}
	// call the Updating student password function if  button is clicked 
	if (isset($_POST['stupass'])) {
		stupass();
	}
	// call the update staff f_code function if  button is clicked  
	if (isset($_POST['fcode'])) {
		fcode();
	}
	// call the update student f_code function if  button is clicked  
	if (isset($_POST['stufcode'])) {
		stufcode();
	}
	// call the update staff role function if button is clicked
	if (isset($_POST['stype'])) {
		stype();
	}
	// call the all_zip function if all_zip button is clicked
	if (isset($_POST['all_zip'])) {
		all_zip();
	}
	// call the download article function if button is clicked
	if (isset($_GET['doc_id'])) {
		downdoc();
	}
	// call the download image function if button is clicked 
	if (isset($_GET['img_id'])) {
		downimg();
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
			
			//Add sucess to session
			echo '<script>alert("Account created")</script>';
			header('location: login.php');
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
						header('location: index.php');
				}
			}
                else {
			array_push($errors, "Wrong password or Email"); 
		} }else {
			array_push($errors, "Wrong password or Email"); 

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
     
    //Upload Articles and picture
	function uploaddp(){
        global $connection;
        //stores session for logged in student
        if (isset($_SESSION['STU'])){
            $email = $_SESSION['STU'];
        }
        $atitle = $_POST['article_title'];
        $atype = $_POST['article_type'];
        
        // gets infomartion on current directory
        $curdir = getcwd();
        
        // makes new folder for the student
        if (mkdir($curdir."/../upload/$email", 0777)){
            //for now can delete later
            echo "succesful";
        }
            else echo "failed";
       
        //Upload Image information
        $targetDir = "../upload/$email/";
        $image = addslashes($_FILES['image']['tmp_name']);
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        
        //Upload Document information
		$upload_doc=$_FILES['upload_doc']['name'];
		$size=$_FILES['upload_doc']['size'];
		$type=$_FILES['upload_doc']['type'];
		$doc_temp=$_FILES['upload_doc']['tmp_name'];
        $doc_name = $upload_doc;

		
    
        // if moving files is succesful than insert into database
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath) and move_uploaded_file($doc_temp,"../upload/$email/".$doc_name)){
            // Insert file information into database
            $insert = $connection->query("INSERT into articles (email,title,sub_date,art_type, img,document,doc_name,pic_name) VALUES ('$email','$atitle',current_timestamp(),'$atype','$image','$upload_doc','$doc_name','".$fileName."')");
        }
    
        }
    
	//Upload Article
	function upload(){
		global $connection, $errors;
		//Get inputs from user
		$article_title = mysqli_real_escape_string($connection, $_POST['article_title']);
		// $upload_date = $_POST['upload_date'];
		$article_type = $_POST['article_type'];
		$email = $_SESSION['STU'];
		$fcode = $_SESSION['F_CODE']; 
		$stu_id = $_SESSION['STU_ID'];
        
        // for email 
        if ($fcode == "FOIT"){
            $staffemail = "starrybcampusrootit@gmail.com";
        } 
        elseif ($fcode == "FOL"){
            $staffemail = "liamncampusrootl@gmail.com";
        }
        elseif ($fcode == "FOS"){
            $staffemail = "jeffacampusroots@gmail.com";
        }
        elseif ($fcode == "FOBA"){
            $staffemail = "sonamcampusrootba@gmail.com";
        }
        
		//Insert input into db
		if (isset($_SESSION['STU'])) {//Student insertion
			 // Upload files
			if (isset($_POST['upload_btn'])) { // if save button on the form is clicked
				// name of the uploaded files
				$doc_name = $_FILES['upload_doc']['name'];
				$img_name = $_FILES['upload_image']['name'];

				// destination of the file on the server
				$destination = '../upload/' . $doc_name;
				$img_destination = '../upload/' . $img_name;

				// get the file extension
				$extension = pathinfo($doc_name, PATHINFO_EXTENSION);
				$img_extension = pathinfo($img_name, PATHINFO_EXTENSION);

				// the physical file on a temporary upload directory on the server
				$doc_file = $_FILES['upload_doc']['tmp_name'];
				$img_file = $_FILES['upload_image']['tmp_name'];

				//Check if files uploaded exist
				$file_Check = mysqli_query($connection, "SELECT doc_name, img_name FROM articles WHERE doc_name = '$doc_name' AND img_name = '$img_name'");
				$retFile_check = mysqli_num_rows($file_Check);

				//Check for the correct file extension
				if (!in_array($extension, ['docx', 'doc'])) {
					echo array_push($errors, "Sorry the document you've uploaded must be .docx/.doc");
				}
				if (!in_array($img_extension, ['png', 'jpeg', 'jpg'])) {
					echo array_push($errors, "Sorry the image you've uploaded must be .png/.jpeg/.jpg");
				}

				if ($retFile_check == 0){
					if (count($errors) == 0){
						// move the uploaded (temporary) file to the specified destination
				if (move_uploaded_file($doc_file, $destination) and move_uploaded_file($img_file, $img_destination)) {
					
					$sql = "INSERT INTO articles (email, title, sub_date, art_type, doc_name, img_name, f_code, status, student_id) 
					VALUES ('$email', '$article_title', CURDATE(), '$article_type', '$doc_name', '$img_name', '$fcode', 'Waiting', '$stu_id')";

							if (mysqli_query($connection, $sql)) {
								//Confirmation Session
								$_SESSION['up_success']  = "ARTICLE UPLOADED"; 
                                // get current year
                                $year = date("Y");
                                // if year already exists or record exists change date or else add date
								$sql = "SELECT * FROM statistics WHERE YEAR='$year' AND f_code='$fcode'" ;
								$result = $connection->query($sql);   
											
								if ($result->num_rows > 0) {
									//counter for student uploading
									$plus = "UPDATE statistics SET articles = articles + 1 WHERE f_code = '".$fcode."' AND Year='$year' ";
									$counterr = $connection->query($plus);  
								} else{
								$sql = "INSERT INTO statistics (f_code,articles,approved,Year) VALUES ('$fcode',1,0,'$year') ";
								$result = $connection->query($sql);  
							}
                                
                              
//                            if (mysqli_query($connection, $plus)) {
//                              //echo "Counter added";
//                            } 
					   // email starts
                        
					   $contri =
                        // coding for style and design for the email content
					   "<!DOCTYPE html>
					   <html>
					   <head> 
					   <style>
					   body {background-color: powderblue;}

					   .tab {
					   font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; 
                       border-collapse: collapse;
					   width: 80%;
					   }

					   .tab td,.tab th {
					   border: 1px solid #ddd; 
                       padding: 8px;
					   }

					   .tab tr:nth-child(even){background-color: #f2f2f2;}

					   .tab tr:hover {background-color: #ddd;}

					   .tab th {
					   padding-top: 12px; padding-bottom:12px;text-align: left;
					   background-color: #4CAF50; color: white;
					   }

					   </style>
					   </head>
                       
					   <body>
					   <table class='tab'>
                 		<thead>
                 			<th>Email</th> <th>Article title</th> <th>Article type</th>
                 		</thead>
					   <tbody>
                        <tr>    
                           <td>$email</td>
                           <td>$article_title</td>  
                           <td>$article_type</td> 
                        </tr>
                    </tbody>
                   </table>

                 </body>
                 </html>
                  ";
    
                 //email sending
    
                 require 'phpmailer/PHPMailerAutoload.php';

                 $mail = new PHPMailer;
                 
                 //$mail->SMTPDebug = 4;                            // Enables verbose debug output to check errors

                 $mail->isSMTP();                                   // Sets mailer to use SMTP
                 $mail->Host = 'smtp.gmail.com';                    // Main and backup SMTP servers
                 $mail->SMTPAuth=true;                              // Enables SMTP authentication
                 $mail->Username = 'campusrootem@gmail.com';              // SMTP username
                 $mail->Password = '@campusroot2001';               // SMTP password
                 $mail->SMTPSecure='tls';                           // Enables TLS encryption, `ssl` also accepted
                 $mail->Port=587;               
                        
                 $mail->setFrom('campusrootem@gmail.com', 'New Student Contribution');
                 $mail->addAddress($staffemail);                          // a recipient
                 $mail->addReplyTo($staffemail);
                 $mail->isHTML(true);                                // Email format is HTML
                 $mail->Subject = "Student contribution";
                 $mail->Body    = "$contri";   
                       
                  // if email is sent go to article page        
                  if(!$mail->send()) {
                     echo 'Message could not be sent.';
                     echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                      echo '<script>alert("Your contribution has been uploaded succesfully")</script>';
                      // header("Location:../pages/article.php");
				  }
                  
				}
			}
		}
		}else {
			//echo '<script>alert("Article uploaded failed")</script>';
			 array_push($errors, "Sorry the files you've uploaded already exist");
			}
		}
	}
}

	//Upload Edited Article
	function ed_art(){
		global $connection;
		//Get inputs from user
		$article_title = $_POST['article_title'];
		$article_type = $_POST['article_type'];
		$art_id = $_SESSION['art_id'];
		$old_doc_name = $_SESSION['old_doc_name'];
		$old_img_name = $_SESSION['old_img_name'];

		$doc_sou = '../upload/' . $old_doc_name; // Get old document file from folder
		$img_sou = '../upload/' . $old_img_name; // Get old image file from folder
		//Insert input into db
		if (isset($_SESSION['art_id'])) {//Student insertion
			 // Upload files
			if (isset($_POST['ed_art'])) { // if save button on the form is clicked
				// name of the uploaded files
				$doc_name = $_FILES['upload_doc']['name'];
				$img_name = $_FILES['upload_image']['name'];

				// destination of the file on the server
				$destination = '../upload/' . $doc_name;
				$img_destination = '../upload/' . $img_name;

				// get the file extension
				$extension = pathinfo($doc_name, PATHINFO_EXTENSION);
				$img_extension = pathinfo($img_name, PATHINFO_EXTENSION);

				//Check for the correct file extension
				if (!in_array($extension, ['docx', 'doc'])) {
					echo array_push($errors, "Sorry the document you've uploaded must be .docx/.doc");
				}
				if (!in_array($img_extension, ['png', 'jpeg', 'jpg'])) {
					echo array_push($errors, "Sorry the image you've uploaded must be .png/.jpeg/.jpg");
				}

				// the physical file on a temporary upload directory on the server
				$doc_file = $_FILES['upload_doc']['tmp_name'];
				$img_file = $_FILES['upload_image']['tmp_name'];

				// move the uploaded (temporary) file to the specified destination
				if (move_uploaded_file($doc_file, $destination) and move_uploaded_file($img_file, $img_destination)) {
					$sql = "UPDATE articles SET title='$article_title', art_type='$article_type', doc_name='$doc_name', img_name='$img_name' WHERE id='$art_id'";

					if (mysqli_query($connection, $sql)) {
                       echo '<script>alert("Article re-uploaded success")</script>';
						echo "<script>window.location='../pages/article.php'</script>";
					}
				} else {
					echo '<script>alert("Article uploaded failed")</script>';
				}
			}
		}
		

		if(unlink($doc_sou) and unlink($img_sou)) //Delete files before uploading new ones
		{
			//Insert input into db
		if (isset($_SESSION['art_id'])) {//Student insertion
			// Upload files
		   if (isset($_POST['ed_art'])) { // if save button on the form is clicked
			   // name of the uploaded files
			   $doc_name = $_FILES['upload_doc']['name'];
			   $img_name = $_FILES['upload_image']['name'];

			   // destination of the file on the server
			   $destination = '../upload/' . $doc_name;
			   $img_destination = '../upload/' . $img_name;

			   // get the file extension
			   $extension = pathinfo($doc_name, PATHINFO_EXTENSION);
			   $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);

			   // the physical file on a temporary upload directory on the server
			   $doc_file = $_FILES['upload_doc']['tmp_name'];
			   $size = $_FILES['upload_doc']['size'];
			   $img_file = $_FILES['upload_image']['tmp_name'];
			   $img_size = $_FILES['upload_image']['size'];

			   // move the uploaded (temporary) file to the specified destination
			   if (move_uploaded_file($doc_file, $destination) and move_uploaded_file($img_file, $img_destination)) {
				   
				   $sql = "UPDATE articles SET title='$article_title', art_type='$article_type', doc_name='$doc_name', img_name='$img_name' WHERE id='$art_id'";

				   if (mysqli_query($connection, $sql)) {
						$_SESSION['ed_success']  = "EDIT SUCCESSFUL";
					    echo "<script>window.location='../pages/article.php'</script>";
				   }
			   } else {
				   echo '<script>alert("Deletion failed")</script>';
			   }
		   
		}
		}
	  }
	  else{
		echo 'Something Went Wrong';
	}
	}

	//Delete unapproved article from student
	function del_art(){
		global $connection;
			
		$art_id = $_POST['arc_id'];

		$ser_del = mysqli_query($connection, "SELECT * FROM articles WHERE id ='$art_id'");//Check for article id
		$fetch_res = mysqli_fetch_array($ser_del);
		$doc = $fetch_res['doc_name'];//Get document name from column in array
		$img = $fetch_res['img_name'];//Get image name from column in array



		$doc_sou = '../upload/' . $doc; // Get document file from folder
		$img_sou = '../upload/' . $img; // Get image file from folder
		

		if (isset($_POST['arc_id'])){ //Get id from post
			if (isset($_POST['del_art'])) { //Check if button has been pressed
				if(unlink($doc_sou) and unlink($img_sou)) //Delete files 
				{
					mysqli_query($connection, "DELETE FROM `articles` WHERE `articles`.`id` = '$art_id'");
					$_SESSION['del_success']  = "DELETION SUCCESSFUL";
                     echo '<script>alert("Deletion successful")</script>';
					echo "<script>window.location='../pages/article.php'</script>";
				}
			}
		}else{
			echo 'Something Went Wrong';
		}
	}
	//Downloads Document
	function downdoc(){
		global $connection;

		$id = $_GET['doc_id'];
		// fetch file to download from database
		$sql = "SELECT * FROM articles WHERE id=$id";
		$result = mysqli_query($connection, $sql);
		$file = mysqli_fetch_assoc($result);
		$filepath = '../upload/' . $file['doc_name'];
		
		if (file_exists($filepath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename($filepath));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize('../upload/' . $file['doc_name']));
			readfile('../upload/' . $file['doc_name']);
			exit;}
	}
	//Downloads Image
	function downimg(){
		global $connection;

		$id = $_GET['img_id'];

				// fetch file to download from database
				$sql = "SELECT * FROM articles WHERE id=$id";
				$result = mysqli_query($connection, $sql);

				$file = mysqli_fetch_assoc($result);
				$filepath = '../upload/' . $file['img_name'];

				if (file_exists($filepath)) {
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=' . basename($filepath));
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize('../upload/' . $file['img_name']));
					readfile('../upload/' . $file['img_name']);
					exit;
				}
	}

				//Updating staff profile from admin
				function esta() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$sid = $_SESSION['sid'];

					$sql = "UPDATE staff set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE id = '$sid'";
					$sql2 = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($sql2 > 0){
							$_SESSION['update'] = "Update successful";
							echo "<script>alert('Details Changed')</script>";
							echo "<script>window.location='../pages/astaff.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating student profile from admin
				function estu() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$sid = $_SESSION['stuid'];

					$sql = "UPDATE students set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE id = '$sid'";
					$sql2 = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($sql2 >  0){
							$_SESSION['update'] = "Update successful";
							echo "<script>alert('Details Changed')</script>";
							echo "<script>window.location='../pages/astudent.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Delete student profile from admin
				function del_stu() {
					global $connection;

					$stu_id = $_POST['stuid'];  //Get student id from post
					$ac_id = $_POST['stuemail']; //Get account email from post
					$sql = mysqli_query($connection, "DELETE FROM students WHERE id = '$stu_id'");
					$sql2 = mysqli_query($connection, "DELETE FROM accounts WHERE email = '$ac_id'");

					if ($sql and $sql2){
						echo "<script>alert('Student Deleted')</script>";
						echo "<script>window.location='../pages/astudent.php'</script>";
					}
					else {
						echo "<script>alert('Sorry something went wrong')</script>";
					}
				}
				//Delete student profile from admin
				function del_sta() {
					global $connection;

					$sta_id = $_POST['sid'];
					$ac_id = $_POST['email'];

					$sql = mysqli_query($connection, "DELETE FROM staff WHERE id = '$sta_id'");
					$sql2 = mysqli_query($connection, "DELETE FROM accounts WHERE email = '$ac_id'");

					if ($sql and $sql2){
						echo "<script>alert('Staff Deleted')</script>";
						echo "<script>window.location='../pages/astaff.php'</script>";
					}
					else {
						echo "<script>alert('Sorry something went wrong')</script>";
					}
				}

				//Updating staff password from admin
				function spass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$stamail = $_SESSION['stamail'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE accounts set password = '$hash' WHERE email = '$stamail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret > 0){
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../pages/astaff.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating student password from admin
				function stupass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$stamail = $_SESSION['stuemail'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE accounts set password = '$hash' WHERE email = '$stamail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret > 0){
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../pages/astudent.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating staff role admin
				function stype() {
					global $connection;
					
					$stamail = $_SESSION['stamail'];
					$u_id = $_POST['u_id'];

					$sql = "UPDATE accounts set u_id = '$u_id' WHERE email = '$stamail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret > 0){
							echo "<script>alert('Account Type Changed')</script>";
							echo "<script>window.location='../pages/astaff.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating staff faculty code
				function fcode() {
					global $connection;
					
					$stamail = $_SESSION['stamail'];
					$fcode = $_POST['f_code'];

					$sql = "UPDATE staff set f_code = '$fcode' WHERE email = '$stamail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret > 0){
							echo "<script>alert('Faculty Type Changed')</script>";
							echo "<script>window.location='../pages/astaff.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating student faculty code
				function stufcode() {
					global $connection;
					
					$stuemail = $_SESSION['stuemail'];
					$fcode = $_POST['f_code'];

					$sql = "UPDATE students set f_code = '$fcode' WHERE email = '$stuemail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret > 0){
							echo "<script>alert('Faculty Type Changed')</script>";
							echo "<script>window.location='../pages/astudent.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating student profile from stdent account
				function update_stu_details() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$email = $_SESSION['STU'];

					$sql = "UPDATE students set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE email = '$email'";
					$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Update successful')</script>";
							echo "<script>window.location='../pages/sprofile.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating marketing coordinator profile from mc account
				function mcprof() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$email = $_SESSION['MC'];

					$sql = "UPDATE staff set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE email = '$email'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Update successful')</script>";
							echo "<script>window.location='../pages/mc.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating marketing manager profile from mm account
				function mmprof() {
					global $connection;
					
					$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
					$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
					$phone_no = mysqli_real_escape_string($connection, $_POST['phone_no']);
					$email = $_SESSION['MM'];

					$sql = "UPDATE staff set first_name = '$first_name', last_name = '$last_name', phone_no = '$phone_no' WHERE email = '$email'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>window.location='../pages/mm.php'</script>";
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating student password from student profile
				function studpass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$stuemail = $_SESSION['STU'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE accounts set password = '$hash' WHERE email = '$stuemail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							$_SESSION['update'] = "Update successful";
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../login.php'</script>";
							// remove all session variables
							session_unset();

							// destroy the session
							session_destroy();
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating MC password from mc profile
				function mcpass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$stuemail = $_SESSION['MC'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE accounts set password = '$hash' WHERE email = '$stuemail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../login.php'</script>";
							// remove all session variables
							session_unset();

							// destroy the session
							session_destroy();
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}
				//Updating MM password from marketing manager profile page profile
				function mmpass() {
					global $connection;
					
					$password = mysqli_real_escape_string($connection, $_POST['password']);
					$stuemail = $_SESSION['MM'];
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE accounts set password = '$hash' WHERE email = '$stuemail'";
						$ret = mysqli_query($connection,$sql);
				//        die(print_r($sql));

						if ($ret >  0){
							echo "<script>alert('Password Changed')</script>";
							echo "<script>window.location='../login.php'</script>";
							// remove all session variables
							session_unset();

							// destroy the session
							session_destroy();
							
						}else {
							echo "<script>alert('Sorry something went wrong')</script>";
						}
				}

				function all_zip() {//Add all documents in zip file
					if(isset($_REQUEST['all_zip'])){
						extract($_REQUEST);
						
						global $connection;
						$findDoc =  "SELECT * FROM articles WHERE status = 'Approved'";
						$checkDoc = mysqli_query($connection, $findDoc);
						
						$filename	=	'all-contributions.zip';
						
						$zip = new ZipArchive;
						if ($zip->open($filename,  ZipArchive::CREATE)){
							while($row	=	$checkDoc->fetch_assoc()){
								$zip->addFile(getcwd().'/'.'../upload/'.$row['doc_name'], $row['doc_name']);
								$zip->addFile(getcwd().'/'.'../upload/'.$row['img_name'], $row['img_name']);
							}
							
							
							$zip->close();
							
							header("Content-type: application/zip"); 
							header("Content-Disposition: attachment; filename=$filename");
							header("Content-length: " . filesize($filename));
							header("Pragma: no-cache"); 
							header("Expires: 0"); 
							readfile("$filename");
							unlink($filename);
						}else{
						   echo 'Failed!';
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