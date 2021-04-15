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


  </body>
</html>
