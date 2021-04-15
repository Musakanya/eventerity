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
    <title>Events</title>

    

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
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link "  href="../index.php">
              <span data-feather="home"></span>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php" >
              <span data-feather="profile"></span>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_event.php">
              <span data-feather="create-event"></span>
              Create Event
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="events.php">
              <span data-feather="events"></span>
              Events
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <h2>Events</h2>
                        <?php 
                        $em = $_SESSION['US'];
                        $sql = "SELECT * FROM events WHERE event_owner='$em'";
                        $result = mysqli_query($connection, $sql);
                    
                        if ($result->num_rows > 0){

                        
                        while($row = $result->fetch_assoc()) {?>
                        <div class="table-responsive">
                          <table class="table table-striped table-sm">
                          <thead>
                          <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date/Time</th>
                            <th>Tickets Left</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                          <tbody>
                            <tr>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['event_description']; ?></td>
                            <td><?php echo $row['event_date']; ?>
                            <br><br>
                            <?php echo $row['event_time']; ?>
                          </td>
                            <td><?php echo $row['tickets_available']; ?></td>
                            <form action="events.php" method="POST">
                            <td><button title="Edit Event"  name="ed_eve" value="<?php echo $row['id']; ?>">Edit</button>
                            <br><br>
                            <button title="Delete Event" name="del_eve" value="<?php echo $row['id']; ?>" onclick="return checkDel()">Del</button></td>
                            </tr>
                            </form>
                          </tbody>
                          </table>
                          </div>
                                <?php }}else{
                                  echo "You havent created any events";
                                } ?>
    </main>
  </div>
</div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
    function checkDel() {
        var c = confirm("Are you sure that you want to delete?");
        if (c == true) {
        return true;
    }else {
        return false;
    }
    }
</script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
