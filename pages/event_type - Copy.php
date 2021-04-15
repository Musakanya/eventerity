<?php include('../include/api.php');?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Home</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

  </head>
  <body>

    <?php 

    if (isset($_SESSION['US'])){
        if (isset($_POST['buy_now'])){
            if (isset($_POST['eve_type'])){
                $eve_type = $_POST['eve_type'];
                $email = $_SESSION['US'];


        $sql = "SELECT * FROM events WHERE event_type = '$eve_type'";
        $ret = mysqli_query($connection, $sql);

        //Get conference event type info 
        while ($row = mysqli_fetch_array($ret)){
            $eve_name = $row['event_name'];
            $eve_price = $row['price'];
            $eve_date = $row['event_date'];
            $eve_time = $row['event_time'];
            $eve_address = $row['street_address'];
            $eve_city = $row['city'];
            $eve_post = $row['post_code'];
            $eve_country = $row['country'];
            $eve_desc = $row['event_description'];
            $eve_type = $row['event_type'];
            $eve_ptype = $row['participation_type'];
            $eve_atickets = $row['tickets_available'];
            $con_id = $row['id'];

            echo "<section id='pack' class='packages'>
            <div class='container'>
                <div class='packages-content'>
                        <div class='row'>
        
                            <div class='col-md-4 col-sm-6'>
                                <div class='single-package-item'>
                                <h3>$eve_name <span class='pull-right'>ZMW $eve_price</span></h3>
                                        <div class='packages-para'>
                                            <p>
                                                <span>
                                                    <i class='fa fa-angle-right'></i> $eve_date
                                                </span>
                                                <i class='fa fa-angle-right'></i> $eve_time
                                            </p>
                                            <p>
                                                <span>
                                                    <i class='fa fa-angle-right'></i> $eve_address
                                                </span>
                                                <i class='fa fa-angle-right'></i> $eve_city
                                             </p>
                                             <p>
                                                <span>
                                                    <i class='fa fa-angle-right'></i> $eve_post
                                                </span>
                                                <i class='fa fa-angle-right'></i> $eve_country
                                            </p>
                                            <p>
                                                <span>
                                                    <i class='fa fa-angle-right'></i> $eve_desc
                                                </span>
                                                <i class='fa fa-angle-right'></i> $eve_type
                                            </p>
                                            <p>
                                                <span>
                                                    <i class='fa fa-angle-right'></i> $eve_ptype
                                                </span>
                                                <i class='fa fa-angle-right'></i> $eve_atickets
                                            </p>
                                            <p>  
                                        </div>
                                        <form action='checkout.php' method='POST'>
                                        <input type='hidden' name='con_id'  value='$con_id'>
                                        <button title='Buy' name='buy_eve'>Buy</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                </div>
                </div>
            </section>"; 

        }
            }
        }  
    }
        
    ?>
  </body>
</html>
