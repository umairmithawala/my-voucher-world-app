<?php
   session_start();
      require_once '../database/db-con.php';
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
   window.location = "login.php";
</script>
<?php
   }
   
   
      
      }else {
          ?>
<script>
   window.location = "login.php";
</script>
<?php
   }
   ?>
<?php 
   $alert = 0;
   $err_msg = "";
      if (!empty($_GET['id'])) {
          $checkout_id = $_GET['id'];

          //getting data from checkout table

          $query2 = "SELECT * FROM `checkout` WHERE `id` = $checkout_id";
          $run_query2 = mysqli_query($con, $query2);
          $rows2     = mysqli_num_rows($run_query2);
      
          if ($rows2 > 0 && $run_query2 == TRUE) { 
              while ($data2 = mysqli_fetch_assoc($run_query2)) { 

              
                    $voucher_id  = $data2['voucher_id'];
                    $voucher_code_id  = $data2['voucher_code_id'];
                    $voucher_type  = $data2['voucher_type'];
                    $buy_price  = $data2['buy_price'];
                    $razorpay_order_id  = $data2['razorpay_order_id'];
                    $razorpay_payment_id  = $data2['razorpay_payment_id'];
                    $razorpay_signature  = $data2['razorpay_signature'];
                    $payment_complete_code_not_available  = $data2['payment_complete_code_not_available'];
                    $is_paid  = $data2['is_paid'];
                    $payment_timestamp  = $data2['payment_timestamp'];
                    $timestamp  = $data2['timestamp'];
    
                
              }
            }

            //get voucher details 

            if($voucher_type == "normal"){
                $query3 = "SELECT `name` FROM `voucher` WHERE `id` = $voucher_id";
              }else if($voucher_type == "dynamic"){         
                $query3 = "SELECT `name` FROM `variable_voucher` WHERE `id` = $voucher_id";
              }
          $run_query3 = mysqli_query($con, $query3);
          $rows3     = mysqli_num_rows($run_query3);
      
          if ($rows3 > 0 && $run_query3 == TRUE) { 
              while ($data3 = mysqli_fetch_assoc($run_query3)) { 

              
                  $voucher_name = $data3['name'];
    
                
              }
            }

          //check if payment completed voucher code not available is set to 1 for this page 

          if($payment_complete_code_not_available == 0){
?>
<script>
    window.location = "your-voucher-code.php?id=<?php echo $checkout_id; ?>";
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
      <title>Favorite</title>
      <style>
         .hide {
         display: none;
         }
      </style>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- swiper css -->
   </head>
   <body>
      <?php
         require_once 'elements/header.php';
         ?>
      <div id="contain" style="margin-top:80px;" >
         <div class="container-fluid">
            <div class="b-head">
               <div class="b-head-right">
                  <span style="font-size:30px; font-weight:400;">
                     <!-- Voucher Code -->
                  </span>
               </div>
            </div>
         </div>
         <br>
         <br>
         <!-- main container -->
         <div class="container-fluid" style="margin-top:30px; height:100%;">
            <div class="card" style="box-shadow: 0px 1px 15px #d3d3d3; border-radius:10px; height:auto;">
               <div class="card-header">
                  <span style="font-size:20px; color:#667eea;font-weight:600;  ">
                  Voucher Code
                  </span>
               </div>
               <div class="card-body">
                  <p class="text-center">
                     <span style="font-size:25px; color:#000000; font-weight:400; ">
                     Voucher code not available
                     </span>
                  </p>
                  <br>
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     Checkout Id
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600; float:right; ">
                     <?php echo "#".$checkout_id; ?>
                     </span>
                  </p>
                  <br>
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     Voucher Name
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600; float:right; ">
                     <?php echo $voucher_name; ?>
                     </span>
                  </p>
                  <br>
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     Buy Price
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600; float:right; ">
                     <?php echo "₹".$buy_price.".00/-"; ?>
                     </span>
                  </p>
                  <br>
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     Order Id
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600; float:right; ">
                     <?php echo $razorpay_order_id; ?>
                     </span>
                  </p>
                  <br>
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     Payment Id
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600; float:right; ">
                     <?php echo $razorpay_payment_id; ?>
                     </span>
                  </p>
                  <br>
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     Time
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600; float:right; ">
                     <?php
                     $mydate=getdate($payment_timestamp);
                     echo "$mydate[mday]-$mydate[mon]-$mydate[year],";
                     echo " "."$mydate[hours]:$mydate[minutes]";
                     ?>
                     </span>
                  </p>
               </div>
               <div class="card-footer">
                  <p>
                     <span style="font-size:15px; color:#000000; font-weight:400; float:left; ">
                     <i class="fas fa-info-circle"></i> If amount is deducted from your account please report us on care@myvoucherworld.com with the screenshot of this screen!
                     </span>
                  </p>
               </div>
            </div>
         </div>
         <div class="row position-fix-bottom-zero">
            <div class="col-12">
               <a href="order-history.php" style="text-decoration: none; color: #fff;">
                  <div class="btn-buy-now">Back</div>
               </a>
            </div>
         </div>
      </div>
      <br><br><br><br>
      <!-- Bootstrap min Js -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
      <!-- jquery cdn -->
      <script src="js/jquery.min.js"></script>
      <!-- Slider JS -->
      <script>
         $(document).ready(function () {
          $(".openbtn").click(function () {
            $("#contain").toggleClass("hide");
          });
         });
      </script>
      <!-- price slider -->
      <!-- Swiper JS -->
   </body>
</html>