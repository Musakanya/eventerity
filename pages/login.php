<?php include('../include/api.php');?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

  </head>
  <body>
  
    <form class="form-signin" action="login.php" method="POST" autocomplete="off">
      <?php include('../include/errors.php'); ?>
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
        </div>
        <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
  </div>
  <button class="w-100 btn btn-lg btn-login" type="submit" name="login-btn">Log in</button>
  <p></p> 
  <p>Not a member? <a href="signup.php">Sign up</a></p>
</form>
  </body>
</html>
