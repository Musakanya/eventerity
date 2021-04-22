<?php include('../include/api.php');

      if (isset($_SESSION['AD'])){
        $em = $_SESSION['AD'];

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
     <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
    <title>Admin</title>

    

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/profile.css" rel="stylesheet">
<!-- font awesome -->
<link href="../font-awesome/css/all.css" rel="stylesheet">
<script defer src="../font-awesome/js/all.js"></script>
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
            <a class="nav-link active" aria-current="page" href="admin.php">
              <span data-feather="home"></span>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aprofile.php" >
              <span data-feather="profile"></span>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="auser.php" >
              <span data-feather="auser"></span>
              Create Account
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <h2>Users</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Email</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone No</th>
              <th>User Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <?php 
             $sql = "SELECT email, first_name, last_name, phone_no, user_type FROM user";//Check for all users
             $result = mysqli_query($connection, $sql);
             while($rw = $result->fetch_assoc()) {?>
          <tbody>
            <tr>
              <td><?php echo $rw['email']; ?></td>
              <td><?php echo $rw['first_name']; ?></td>
              <td><?php echo $rw['last_name']; ?></td>
              <td><?php echo $rw['phone_no']; ?></td>
              <td><?php echo $rw['user_type']; ?></td>
              <form action='euser.php' method='POST'>
              <td><button title="Edit User"  name="ed_usr" class="btn2 btn-edit" value="<?php echo $rw['email']; ?>"><i class="fas fa-edit"></i></button>
              <br><br>
              <!-- <button title="Delete User" name="del_usr" class="btn2 btn-del" value="<?php echo $rw['email']; ?>" onclick="return checkDel()"><i class="fas fa-trash-alt"></i></button> -->
              </form>
              <?php }?>
             </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
    <!-- <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
    function checkDel() {
        var c = confirm("Are you sure that you want to delete?");
        if (c == true) {
        return true;
    }else {
        return false;
    }
    }
</script> -->

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
