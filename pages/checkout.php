<?php include('../include/api.php');?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Checkout</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/checkout.css" rel="stylesheet">
    
  </head>
  <body class="bg-light">
    <?php 
    $eve_id = $_POST['eve_id'];           
    //Check for event name, description, price
      $sql = "SELECT id, event_name, event_description, price FROM events WHERE 
      id='$eve_id' " ;
      $result = $connection->query($sql);   
 
   if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
       $eve_id = $row['id'];
       $eve_name = $row['event_name'];
       $eve_des = $row['event_description'];
       $eve_pri = $row['price'];
   
   } }
    
    ?>


  
<div class="container">
  <main>
    <div class="py-5 text-center">

      <h2>Checkout form</h2>
      <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo "$eve_name";?></h6>
              <small class="text-muted"><?php echo "$eve_des";?></small>
            </div>
            <span class="text-muted">K<?php echo "$eve_pri";?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (ZMW)</span>
            <strong><?php echo "$eve_pri";?></strong>
          </li>
      </div>
      <div class="col-md-7 col-lg-8">
      <?php 
      if ($eve_pri == 0){
        echo "<h4 class='mb-3'>Payment</h4>
        <form class='needs-validation' action='checkout.php' method='POST' novalidate>
          <hr class='my-4'>
          <input type='hidden' name='eve_id'  value='$eve_id'>
          <button class='w-100 btn btn-primary btn-lg' type='submit' name='buy_btn'>BUY</button>
        </form>
      </div>";

      }else{
        echo"<h4 class='mb-3'>Payment</h4>
        <form class='needs-validation' action='checkout.php' method='POST' novalidate>
          <div class='my-3'>
            <div class='form-check'>
              <input id='credit' name='paymentMethod' type='radio' class='form-check-input' required>
              <label class='form-check-label' for='credit'>Credit card</label>
            </div>
            <div class='form-check'>
              <input id='debit' name='paymentMethod' type='radio' class='form-check-input' >
              <label class='form-check-label' for='debit'>Debit card</label>
            </div>
            <div class='invalid-feedback'>
               Please choose a payment type
              </div>
          </div>

          <div class='row gy-3'>
            <div class='col-md-6'>
              <label for='cc-name' class='form-label'>Name on card</label>
              <input type='text' class='form-control' id='cc-name' placeholder='' required>
              <small class='text-muted'>Full name as displayed on card</small>
              <div class='invalid-feedback'>
                Name on card is required
              </div>
            </div>

            <div class='col-md-6'>
              <label for='cc-number' class='form-label'>Credit card number</label>
              <input type='number' class='form-control' id='cc-number' placeholder='' required>
              <div class='invalid-feedback'>
                Credit card number is required
              </div>
            </div>

            <div class='col-md-3'>
              <label for='cc-expiration' class='form-label'>Expiration</label>
              <input type='text' class='form-control' id='cc-expiration' placeholder='' required>
              <div class='invalid-feedback'>
                Expiration date required
              </div>
            </div>

            <div class='col-md-3'>
              <label for='cc-cvv' class='form-label'>CVV</label>
              <input type='number' class='form-control' id='cc-cvv' placeholder='' required>
              <div class='invalid-feedback'>
                Security code required
              </div>
            </div>
          </div>

          <hr class='my-4'>
          <input type='hidden' name='eve_id'  value='$eve_id'>
          <button class='w-100 btn btn-primary btn-lg' type='submit' name='buy_btn'>BUY</button>
        </form>
      </div>";
      }
      
      ?>
        
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Eventerity</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>



    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/checkout.js"></script>
  </body>
</html>
