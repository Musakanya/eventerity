<?php include('../include/api.php');?> 
<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content='Mark Otto, Jacob Thornton, and Bootstrap contributors'>
    <meta name='generator' content='Hugo 0.82.0'>
    <title>Events</title>

    

    <!-- Bootstrap core CSS -->
<link href='../css/bootstrap.min.css' rel='stylesheet'>
<link href='../css/profile.css' rel='stylesheet'>
  </head>
  <body>
  <table class='table table-striped table-bordered table-hover'>
                     <thead>
                         <th>Student ID</th>
                         <th>Email</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Phone Number</th>
                         <th>Faculty Code</th>
                         <th>Action</th>
                      </thead>
                         <?php 
                         global $connection;
                         $sql = 'SELECT * FROM students';
                         $result = mysqli_query($connection, $sql);
                         while($row = $result->fetch_assoc()) {?>
                            
                      <tbody>
                         <tr>
                         <td><?php echo $row['id']; ?></td>
                         <td><?php echo $row['email']; ?></td>
                         <td><?php echo $row['first_name']; ?></td>
                         <td><?php echo $row['last_name']; ?></td>
                         <td><?php echo $row['phone_no']; ?></td>
                         <td><?php echo $row['f_code']; ?></td>
                         <form action='estudent.php' method='POST'>
                            <input type='hidden' name='stuid'  value='<?php echo $row['id'];?>'>
                            <input type='hidden' name='stuemail'  value='<?php echo $row['email'];?>'>
                         <td><button title='Edit this student details' name='edstu'>Edit</button>
                         <p></p>
                        <button title='Delete Student' class='btn btn-secondary2 btn-sm' name='del_stu' onclick='return checkDel()'>Del</button>
                         </td>
                         </form>
                         </tr>
                         <?php }?>
                      </tbody>
                </table>






  <div class='col-lg-4'>
            <div class='card mb-5 mb-lg-0'>
              <div class='card-body'>
                <h5 class='card-title text-muted text-uppercase text-center'>$eve_name</h5>
                <h6 class='card-price text-center'>K$eve_price</h6>
                <hr>
                <ul class='fa-ul'>
                  <li><span class='fa-li'>Description: </i></span>$eve_desc</li>
                  <li><span class='fa-li'>Date: </span>$eve_date</li>
                  <li><span class='fa-li'>Time: </i></span>$eve_time</li>
                  <li><span class='fa-li'>Address: </i></span>$eve_address</li>
                  <li><span class='fa-li'>City: </i></span>$eve_time</li>
                  <li><span class='fa-li'>Post Code: </i></span>$eve_post</li>
                  <li><span class='fa-li'>Country: </i></span>$eve_country</li>
                  <li><span class='fa-li'>Type: </i></span>$eve_type</li>
                  <li><span class='fa-li'>Available Tickets: </i></span>$eve_atickets</li>
                  <li><span class='fa-li'>Paticipation Type: </i></span>$eve_ptype</li>
                </ul>
                <hr>
                <div class='text-center'>
                <form action='checkout.php' method='POST'>
                    <input type='hidden' name='con_id'  value='$con_id'>
                    <button type='button' class='btn' name='buy_eve'>Buy Now</button>
                    </form>
                </div>
              </div>
            </div>
          </div>


          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
        <!-- <h3>Choose Event </h3> -->
        <table class='table table-striped table-bordered table-hover'>
                     <thead>
                     <th>Event Name</th>
                     <th>Customers</th>
                      </thead>
                         <?php 
                         $em = $_SESSION['US'];
                         $sql = 'SELECT * FROM events WHERE event_owner='$em'';
                         $result = mysqli_query($connection, $sql);
                         while($rw = $result->fetch_assoc()) {?>       
                      <tbody>
                         <tr>
                         <td><?php echo $rw['event_name']; ?></td>
                         <form action='customers.php' method='POST'>
                            <input type='hidden' name='eve_id'  value='<?php echo $row['id'];?>'>
                            <td><button title='View Customers'  type='submit' name='view_cus'>View</button></td>
                         </form>
                         </tr>
                         <?php }?>
                      </tbody>
                </table>

        <!-- <form method='POST' action='customers.php'>
        <select name='eve_type' required>
            <option value='' disabled selected>Choose Event Type</option>
            <option value='conference'>Conference</option>
            <option value='festival'>Festival</option>
            <option value='seminar'>Seminar</option>
            <option value='speaker_session'>Speaker Session</option>
            <option value='workshop'>Workshop</option>
          </select>
          <button type='submit'>Select</button>
        </form> -->
        </div>



  </body>
</html>
