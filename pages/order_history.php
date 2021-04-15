<?php include('../include/api.php');?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Order History</title>

    

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
            <a class="nav-link " href="../index.php">
              <span data-feather="home"></span>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="order_history.php">
              <span data-feather="home"></span>
              Oder History
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
            <a class="nav-link" aria-current="page" href="customers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Order History</h1>
      </div>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h3>Choose Event </h3> -->
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
        
        ?>
      </div>

        

      
    </main>
  </div>
</div>
    <script src="../js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
