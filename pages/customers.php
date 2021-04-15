<?php include('../include/api.php');

      if (isset($_SESSION['US'])){
        $em = $_SESSION['US'];

        $chk = "SELECT * FROM user WHERE email = '$em'";
        $res = mysqli_query($connection, $chk);

        while($rw = mysqli_fetch_array($res)){
          $fn = $rw['first_name'];
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
    <title>Customers</title>

    

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
        <!-- <h3>Choose Event </h3> -->
        <table class="table table-striped table-bordered table-hover">
                     <thead>
                     <th>Event Name</th>
                     <th>Customers</th>
                      </thead>
                         <?php 
                         $em = $_SESSION['US'];
                         $sql = "SELECT * FROM events WHERE event_owner='$em'";
                         $result = mysqli_query($connection, $sql);
                         while($rw = $result->fetch_assoc()) {?>       
                      <tbody>
                         <tr>
                         <td><?php echo $rw['event_name']; ?></td>
                         <form action='customers.php' method='POST'>
                            <input type="hidden" name="eve_id"  value="<?php echo $rw['id'];?>">
                            <td><button title='View Customers'  type='submit' name='view_cus'>View</button></td>
                         </form>
                         </tr>
                         <?php }?>
                      </tbody>
                </table>

        <!-- <form method="POST" action="customers.php">
        <select name="eve_type" required>
            <option value="" disabled selected>Choose Event Type</option>
            <option value="conference">Conference</option>
            <option value="festival">Festival</option>
            <option value="seminar">Seminar</option>
            <option value="speaker_session">Speaker Session</option>
            <option value="workshop">Workshop</option>
          </select>
          <button type="submit">Select</button>
        </form> -->
        </div>
        

        <?php 

        if (isset($_POST['view_cus'])){
          $email = $_SESSION['US'];
          $eve_id = $_POST['eve_id'];

          



          //Check for events assigned to email
          $chk_eve = "SELECT * FROM events WHERE event_owner = '$email' AND id = '$eve_id'";
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

              $sql = "SELECT * FROM events WHERE id = '$eve_id'";
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
