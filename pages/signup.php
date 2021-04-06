<?php include('../include/api.php');?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Sign Up</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

  </head>
  <body>
  
    <form class="form-signin" action="signup.php" method="POST" autocomplete="off">
      <?php include('../include/errors.php'); ?>
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
        </div>
        <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"  minlength="5" required>
      <label for="floatingPassword">Password</label>
    </div>
  <div class="form-floating">
      <input type="text" name="first_name" class="form-control" id="floatingFname" placeholder="Firstname" required>
      <label for="floatingFname">Firstname</label>
    </div>
    <div class="form-floating">
      <input type="text" name="last_name" class="form-control" id="floatingLname" placeholder="Lastname" required>
      <label for="floatingLname">Lastname</label>
    </div>
    <div class="form-floating">
      <input type="tel" name="phone_no" class="form-control" id="floatingPnum" placeholder="Phone no" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
      <label for="floatingPnum">Phone (123-456-7890)</label>
    </div>
  </div>
  <button class="w-100 btn btn-lg btn-login" type="submit" name="signup-btn">Sign up</button>
  <p></p> 
  <p>Already a member? <a href="login.php">Login</a></p>
</form>


    
    
  </body>
</html>
