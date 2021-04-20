<?php include('../include/api.php');

      if (isset($_SESSION['US'])){
        $em = $_SESSION['US'];

        $chk = "SELECT * FROM user WHERE email = '$em'";
        $res = mysqli_query($connection, $chk);

        while($rw = mysqli_fetch_array($res)){
          $fn = $rw['first_name'];
          $ln = $rw['last_name'];
          $em = $rw['email'];
          $pn = $rw['phone_no'];
        }
      }

?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
    <title>Profile</title>

    

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/profile.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Welcome <?php echo $fn ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Log out</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
      <ul class="nav flex-column">
      <li class="nav-item">
            <a class="nav-link " href="../index.php">
              <span data-feather="home"></span>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="order_history.php">
              <span data-feather="home"></span>
              Order History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.php" >
              <span data-feather="profile"></span>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.php">
              <span data-feather="events"></span>
              Events
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_event.php">
              <span data-feather="create-event"></span>
              Create Event
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="customers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!-- Change Profile Info -->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form class="form-signin" action="profile.php" method="POST" autocomplete="off">
                <?php include('../include/errors.php'); ?>
                  <div class="text-center mb-4">
                  <h1 class="h2" >Profile</h1>
                  <p>You can change your profile information below. Though you cannot change your email.</p>
                  </div>
                  <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $em ?>" disabled>
                <label for="floatingInput">Email address</label>
                  </div>
            <div class="form-floating">
                <input type="text" name="first_name" class="form-control" id="floatingFname" placeholder="Firstname" value="<?php echo $fn ?>" required>
                <label for="floatingFname">Firstname</label>
              </div>
              <div class="form-floating">
                <input type="text" name="last_name" class="form-control" id="floatingLname" placeholder="Lastname" value="<?php echo $ln ?>" required>
                <label for="floatingLname">Lastname</label>
              </div>
              <div class="form-floating">
                <input type="tel" name="phone_no" class="form-control" id="floatingPnum" placeholder="Phone no" value="<?php echo $pn ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                <label for="floatingPnum">Phone (123-456-7890)</label>
              </div>
              <p></p>
              <button class="w-100 btn btn-lg btn-update" type="submit" name="update-btn">UPDATE</button>
              </form>
            </div>
            <!-- Change Password -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <form class="form-signin" action="profile.php" method="POST" autocomplete="off">
                <?php include('../include/errors.php'); ?>
                  <div class="text-center mb-4">
                  <h1 class="h2" >Password</h1>
                  <p>You can change your password below. You will be signed out after.</p>
                  </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"  minlength="5" required>
                <label for="floatingPassword">Password</label>
              <p></p>
              <button class="w-100 btn btn-lg btn-update" type="submit" name="chg-pass-btn">CHANGE PASSWORD</button>
              </form>
            </div>

    </main>
  </div>
</div>
    <script src="../js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
