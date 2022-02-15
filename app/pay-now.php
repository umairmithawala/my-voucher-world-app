<?php
   session_start();
      require_once '../database/db-con.php';
      ?>
<?php
   //razor pay configuration 
   require('razorpay-config.php');
   require('razorpay-php/Razorpay.php');
   
   use Razorpay\Api\Api;
   
   $api = new Api($keyId, $keySecret);
         ?>
<?php
   if (isset($_SESSION['user_session_var'])) {
       $user_id = $_SESSION['user_session_var'];
   
       //getting user email values
   $query1 = "SELECT `email_verification`,`phone_verification` FROM `users` WHERE `id` = $user_id";
   $run_fetch1 = mysqli_query($con, $query1);
   $no_of_row1 = mysqli_num_rows($run_fetch1);
   if ($no_of_row1 > 0 && $run_fetch1 == true) { 
    $data1 = mysqli_fetch_assoc($run_fetch1); 
    $email_verification = $data1['email_verification'];
    $phone_verification = $data1['phone_verification'];
   
    if($email_verification == 0){
       ?>
<script>
   window.location = "email-verification-otp.php";
</script>
<?php
   }
   
   }else{
   ?>
<script>
   // window.location = "login.php";
</script>
<?php
   }
   
   
      
      }else {
          ?>
<script>
   // window.location = "login.php";
</script>
<?php
   }
   ?>
<?php 
   $alert = 0;
   $err_msg = "";
   $voucher_codes_available;
      if (isset($_SESSION['voucher_id']) && isset($_SESSION['voucher_type']) && isset($_SESSION['voucher_buy_price'])) {
          $voucher_id = $_SESSION['voucher_id'];
          $voucher_type = $_SESSION['voucher_type'];
          $voucher_buy_price = $_SESSION['voucher_buy_price'];          
          
          
          
   
           
          if($voucher_type == "normal" || $voucher_type == "dynamic"){
   
          if($voucher_type == "normal"){
            $query1 = "SELECT `is_deleted`,`codes_available`,`qty`,`price` FROM `voucher` WHERE `id` = $voucher_id";
   
   
          }else if($voucher_type == "dynamic"){
             
            $query1 = "SELECT `is_deleted`,`codes_available`,`qty`,`min_price`,`max_price` FROM `variable_voucher` WHERE `id` = $voucher_id";
   
          }
   
          $run_query1 = mysqli_query($con, $query1);
          $rows1     = mysqli_num_rows($run_query1);
      
          if ($rows1 > 0 && $run_query1 == TRUE) { 
              while ($data1 = mysqli_fetch_assoc($run_query1)) { 
   
               $voucher_is_deleted = $data1['is_deleted'];
               $voucher_codes_available = $data1['codes_available'];
               $voucher_qty = $data1['qty'];
               if($voucher_type == "normal"){
                  $voucher_price = $data1['price'];
               }else if($voucher_type == "dynamic"){
                  $voucher_min_price = $data1['min_price'];
                  $voucher_max_price = $data1['max_price'];
               }
                 
              }
            }
          //checking if voucher is deleted
          //checking if voucher codes available 
          //checking if voucher qty 
   
          if($voucher_is_deleted == 1){
   
            $alert = 1;
            $err_msg = "This voucher is deleted!";
   
          }else if($voucher_codes_available == 0){
   
            $alert = 1;
            $err_msg = "Voucher codes not available!";
          }else if($voucher_qty <= 0){
            $alert = 1;
            $err_msg = "Voucher is out of stock!";
          }
   
          
   
          //checking for price is correct in normal voucher 
          if($voucher_type == "normal"){
   
            if($voucher_price != $voucher_buy_price){
               $alert = 1;
               $err_msg = "Voucher price is not matched!";
            }
            
         }else if($voucher_type == "dynamic"){
          //checking for price is correct in dynamic voucher
   
          if($voucher_buy_price < $voucher_min_price || $voucher_buy_price > $voucher_max_price){
            $alert = 1;
            $err_msg = "Voucher price is not matched!";
   
          }
   
            
         }
   
         //checking if voucher codes available
         
   
         if($voucher_type == "normal"){
            $query2 = "SELECT `id`,`voucher_code` FROM `voucher_code` WHERE `voucher_id` = $voucher_id AND `is_purchased` = 0 LIMIT 1";
   
   
          }else if($voucher_type == "dynamic"){
             
            $query2 = "SELECT `id`,`voucher_code` FROM `variable_voucher_code` WHERE `voucher_id` = $voucher_id AND `is_purchased` = 0 LIMIT 1";
   
          }
   
          $run_query2 = mysqli_query($con, $query2);
          $rows2     = mysqli_num_rows($run_query2);
      
          if ($rows2 > 0 && $run_query2 == TRUE) { 
              while ($data2 = mysqli_fetch_assoc($run_query2)) { 
   
               //entry in a checkout table everything 

               $_SESSION['voucher_code_id'] = $data2['id'];
               // $_SESSION['voucher_code'] = $data2['voucher_code'];

               //checkout table work start 

               $checkout_user_id = $user_id;
               $checkout_voucher_id = $_SESSION['voucher_id'];
               $checkout_voucher_code_id = $_SESSION['voucher_code_id'];
               $checkout_voucher_type = $_SESSION['voucher_type'];
               $checkout_buy_price = $_SESSION['voucher_buy_price'];


               //deleting old entry of same user same voucher id same voucher code id and same voucher type 

               // $query4 = "DELETE FROM `checkout` WHERE `user_id` = $checkout_user_id AND `voucher_id` = $checkout_voucher_id AND `voucher_code_id` = $checkout_voucher_code_id AND `buy_price` = $checkout_buy_price AND `is_paid` = 0";
               // if ($con->query($query4) === true) {
               // }else{
               //    $alert = 1;
               //  $err_msg = "Something went wrong in checkout!";
               // }
   


               //insert data query in checkout table

              
               $timestamp = time();
   
               $query3 = "INSERT INTO `checkout`(`id`, `user_id`, `voucher_id`,
                `voucher_code_id`, `voucher_type`, `buy_price`,`timestamp`)
                 VALUES (NULL,$checkout_user_id,$checkout_voucher_id,$checkout_voucher_code_id,
                 '$checkout_voucher_type',$checkout_buy_price,$timestamp)";

                 if ($con->query($query3) === true) {
                  $checkout_id =  mysqli_insert_id($con);

                  // echo $checkout_id;
                  $_SESSION['checkout_id'] = $checkout_id;

                  
               }else{
                  $alert = 1;
                $err_msg = "Something went wrong in checkout!";
               }
   
               
   
              }
            }else{
                $alert = 1;
                $err_msg = "Voucher codes not available!";
            }
   
   
   
   
   
   
      //saving data into session variable
         if($alert == 0){
               
         }
          
          
   
         }else{
            ?>
<script>
   window.location = "index-1.php";
</script>
<?php
   }
   
   }else{
   ?>
<script>
   window.location = "index-1.php";
</script>
<?php
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- font awesome css -->
      <link rel="stylesheet" href="css/icon.css" />
      <!-- Slider Css -->
      <link href="css/swiper.min.css" rel="stylesheet" type="text/css" />
      <link href="css/style.css" rel="stylesheet" type="text/css" />
      <link href="css/global.css" rel="stylesheet" type="text/css" />
      <!-- Bootstrap Css -->
      <link rel="stylesheet" href="css/bootstrap.css" />
      <!-- Main Css -->
      <link rel="stylesheet" href="css/stylesheet.css" />
      <link rel="stylesheet" href="css/custom-slider.css" />
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Pay Now</title>
      <style>
         .hide {
         display: none;
         }
      </style>
      <!-- Latest compiled and minified CSS -->
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
      <!-- jQuery library -->
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
      <!-- Popper JS -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
      <!-- Latest compiled JavaScript -->
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
      <!-- swiper css -->

      <style>
         /* to change the design of pay now button */
         .razorpay-payment-button{
         display:none;
         }
      </style>
   </head>
   <body>
      <?php
         // require_once 'elements/header.php';
         ?>
      <div id="contain" style="margin-top:80px;" >
         <div class="container-fluid">
            <div class="b-head">
               <div class="b-head-right">
                  <span style="font-size:30px; font-weight:400;">
                     <!-- Payment -->
                  </span>
               </div>
            </div>
         </div>
         <br>
         <br>
         <?php 
            if($alert == 0){
            
               //fetch user details 
            $query3 = "SELECT `name`,`email`,`phone` FROM `users` WHERE `id` = $user_id";
            $run_query3 = mysqli_query($con, $query3);
            $rows3     = mysqli_num_rows($run_query3);
            
            if ($rows3 > 0 && $run_query3 == TRUE) { 
                while ($data3 = mysqli_fetch_assoc($run_query3)) { 
            
                  $user_name = $data3['name'];
                  $user_email = $data3['email'];
                  $user_phone = $data3['phone'];
            
            
              
                }
              }
            
               //fetch voucher details 
            
            
               $orderData = [
                  'receipt'         => $checkout_id,
                  'amount'          => $voucher_buy_price * 100, // 2000 rupees in paise
                  'currency'        => 'INR',
                  'payment_capture' => 1 // auto capture
              ];
            
              $razorpayOrder = $api->order->create($orderData);
            
              $razorpayOrderId = $razorpayOrder['id'];
              
               $_SESSION['razorpay_order_id'] = $razorpayOrderId;

               // echo $_SESSION['razorpay_order_id'];
            
               $displayAmount = $amount = $orderData['amount'];
            
            
               
            if ($displayCurrency !== 'INR')
            {
               $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
               $exchange = json_decode(file_get_contents($url), true);
            
               $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
            }
            
            $checkout = 'automatic';
            
            
            $data = [
               "key"               => $keyId,
               "amount"            => $voucher_buy_price,
               "name"              => "My Voucher World",
               "description"       => "V Id: ".$voucher_id." Type: ".$voucher_type,
               "image"             => "img/Logo.png",
               "prefill"           => [
               "name"              => "$user_name",
               "email"             => "$user_email",
               "contact"           => "$user_phone",
               ],
               "notes"             => [
               "address"           => "Not Applied",
               "merchant_order_id" => "12312321",
               ],
               "theme"             => [
               "color"             => "#667eea"
               ],
               "order_id"          => $razorpayOrderId,
            ];
            
            
            if ($displayCurrency !== 'INR')
            {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
            }
            
            
            $json = json_encode($data);
            
            require("checkout/{$checkout}.php");
            
            ?>
         <div class="container-fluid">
         </div>
         <?php
            }else{
               ?>
         <div class="container-fluid text-center">
            <span class="w-100 text-center">
            <?php
               echo $err_msg;
               ?>
            </span>
         </div>
         <?php
            }
                     ?>
      </div>
      <!-- Bootstrap min Js -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
      <!-- jquery cdn -->
      <script src="js/jquery.min.js"></script>
      <!-- Slider JS -->
      <script type="text/javascript" src="js/swiper.jquery.min.js"></script>
      <script type="text/javascript" src="js/swiper.min.js"></script>
      <script>
         $(document).ready(function () {
          $(".openbtn").click(function () {
            $("#contain").toggleClass("hide");
          });
         });
      </script>
      <!-- price slider -->
      <!-- Swiper JS -->
    
      <script>
         $(window).on('load', function() {
           $('.razorpay-payment-button').click();
         });
         
         
         
      </script>
   </body>
</html>