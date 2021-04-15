<?php include('../include/api.php');?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Customers</title>

    

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/profile.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Eventerity</a>
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
            <a class="nav-link " href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php" >
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
            <a class="nav-link active" aria-current="page" href="customers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customers</h1>
      </div>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h3>Choose Event Type </h3> -->
        <form method="POST" action="customers.php">
        <select name="eve_type" required>
            <option value="" disabled selected>Choose Event Type</option>
            <option value="conference">Conference</option>
            <option value="festival">Festival</option>
            <option value="seminar">Seminar</option>
            <option value="speaker_session">Speaker Session</option>
            <option value="workshop">Workshop</option>
          </select>
          <button type="submit">Select</button>
        </form>
        </div>

        <?php 

        if (isset($_POST['eve_type'])){
          $email = $_SESSION['US'];
          $eve_type = $_POST['eve_type'];

          //Check for events assigned to email
          $chk_eve = "SELECT * FROM events WHERE event_owner = '$email' AND event_type = '$eve_type'";
          $res = mysqli_query($connection, $chk_eve);

          if ($res->num_rows > 0){
            $row = mysqli_fetch_array($res);
            $eve_name = $row['event_name'];
            $id = $row['id'];
          

            //Check for user on specific event
            $chk = "SELECT * FROM user_on_event WHERE event_id = '$id'";
            $ret = mysqli_query($connection, $chk);

            while ($rw = mysqli_fetch_array($ret)){
              $eve_id = $rw['event_id'];
              $usr_mail = $rw['email'];

              $sql = "SELECT * FROM events WHERE event_owner = '$email'";
              $result = mysqli_query($connection, $sql);
              $ret_row = mysqli_fetch_array($result);

              $eve_name = $ret_row['event_name'];

              echo "<h2>Customers on: $eve_name</h2>
            <div class='table-responsive'>
              <table class='table table-striped table-sm'>
                <thead>
                  <tr>
                    <th>Customer Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>$usr_mail</td>
                  </tr>
                </tbody>
              </table>
            </div>";
              
            }
            
        }else {
          echo "No event has been created for this type";
        }
          
          
        }else {
          echo "No event has been slected";
        }
        
        ?>

      
    </main>
  </div>
</div>
    <script src="../js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
