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
      <link
         rel="stylesheet"
         href="https://unpkg.com/swiper/swiper-bundle.min.css"
         />
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
                  My Vouchers
                  </span>
               </div>
            </div>
         </div>
         <br>
         <br>
         <?php
            $query1 = "SELECT * FROM `checkout` WHERE `user_id` = $user_id AND `is_paid` = 1 AND `payment_complete_code_not_available` = 0";
            $run_query1 = mysqli_query($con, $query1);
            $rows1     = mysqli_num_rows($run_query1);
            
            if ($rows1 > 0 && $run_query1 == TRUE) { 
                while ($data1 = mysqli_fetch_assoc($run_query1)) { 
            
                     $checkout_id = $data1['id'];
                      $voucher_id  = $data1['voucher_id'];
                      $voucher_code_id  = $data1['voucher_code_id'];
                      $voucher_type  = $data1['voucher_type'];
                      $buy_price  = $data1['buy_price'];
                      $razorpay_order_id  = $data1['razorpay_order_id'];
                      $razorpay_payment_id  = $data1['razorpay_payment_id'];
                      $razorpay_signature  = $data1['razorpay_signature'];
                      $payment_complete_code_not_available  = $data1['payment_complete_code_not_available'];
                      $is_paid  = $data1['is_paid'];
                      $payment_timestamp  = $data1['payment_timestamp'];
                      $timestamp  = $data1['timestamp'];
            
            
                      //getting voucher code
                      
            if($voucher_type == "normal"){
              $query5 = "SELECT * FROM `voucher_code` WHERE `id` = $voucher_code_id";    
            }else if($voucher_type == "dynamic"){             
              $query5 = "SELECT * FROM `variable_voucher_code` WHERE `id` = $voucher_code_id";    
            }
                
            $run_query5 = mysqli_query($con, $query5);
            $rows5     = mysqli_num_rows($run_query5);
            
            if ($rows5 > 0 && $run_query5 == TRUE) { 
                while ($data5 = mysqli_fetch_assoc($run_query5)) { 
            
                  $voucher_code = $data5['voucher_code'];
                  $voucher_code_is_used = $data5['is_used'];
            
                }
               }
            

               //getting voucher worth 

               if($voucher_type == "dynamic"){
                  $voucher_worth = $buy_price;
               }else if($voucher_type == "normal"){

                  $query6 = "SELECT `discount_price` FROM `voucher` WHERE `id` = $voucher_id";
                           
                  $run_query6 = mysqli_query($con, $query6);
                  $rows6     = mysqli_num_rows($run_query6);
                  
                  if ($rows6 >0 && $run_query6 == TRUE) { 
                    while ($data6 = mysqli_fetch_assoc($run_query6)) { 
                      $voucher_worth = $data6['discount_price'];  
                     
                    }
                  }else{
                     $voucher_worth = 0;
                  }

               }
            
            if($voucher_code_is_used == 1){
            ?>
         <div class="card m-2" style="heigt:auto; border-radius:10px;">
            <div class="card-body" style="padding:0px;">
               <?php
                  if($voucher_type == "normal"){
                      ?>
                      <div class="container-fluid mt-2" >
                  <div class="row">
                     <div class="col-md-12">
                        <p class="text-center" style="margin-bottom:0px;">
                           <span style="font-size:25px; color:#667eea; font-weight:400; ">
                           <?php echo $voucher_code; ?>
                           </span>
                        </p>
                     </div>
                  </div>
               </div>
               <div class="container-fluid">
                  <p class="text-center">
                     <span style="font-size:15px; color:#000000; font-weight:400; ">
                     Voucher worth:
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600;  ">
                     <?php echo "₹".$voucher_worth.".00/-"; ?>
                     </span>
                  </p>
                  <p class="text-center" >
                     <a href="your-voucher-code.php?id=<?php echo $checkout_id;?>" style="text-decoration:none !important;">
                     <span style="font-size:15px; font-weight:600;">
                     View Code <i class="fas fa-chevron-right" style="opacity:0.5; font-size:13px;"></i><i class="fas fa-chevron-right" style="margin-left:-2.5px; font-size:13px;"></i>
                     </span>
                     </a>   
                  </p>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-center">
                           <div style="border-top:2px solid #ccc; width:80% ">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Featured heading -->
               <div class="container-fluid mt-2">
                  
                  <!-- new section for vouchers -->
                  <div class="row">
                     <?php 
                        $query2 = "SELECT * FROM `voucher` WHERE `is_deleted` = 0 AND `id` = $voucher_id";
                           
                           $run_query2 = mysqli_query($con, $query2);
                           $rows2     = mysqli_num_rows($run_query2);
                           
                           if ($rows2 >0 && $run_query2 == TRUE) { 
                             while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                               $voucher_id = $data2['id'];  
                               $voucher_image = $data2['image_one']; 
                               $voucher_name = $data2['name'];
                               $voucher_price = $data2['price'];  
                               $voucher_discount_price = $data2['discount_price']; 
                               $rating = $data2['rating'];
                               $codes_available = $data2['codes_available'];
                               ?>
                     <div class="col-md-12 my-2">
                        <div class="row">
                           <div class="col-5">
                              <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px; " alt="Voucher image">
                           </div>
                           <div class="col-7">
                              <div class="f-slider-v-info">
                                 <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                                 <p class="text-left" style="font-size:18px; margin-bottom:0px;">
                                    <span style="color:black;"><?php echo  $voucher_name; ?>  </span>
                                    <a href="remove-from-favorite.php?id=<?php echo $voucher_id ?>&type=normal" style="text-decoration:none !important; color:black;">
                                    <span  style="color:#FF0000;">&nbsp; <i id="fav-id" class="fas fa-heart"></i> </span>
                                    </a>
                                 </p>
                                 <p class="text-left" style="margin-bottom:0px !important;"> 
                                    <span style="font-size:20px;"> <?php echo $voucher_price."₹"; ?> </span> 
                                    <span style="color:#CCCCCC;"> <?php echo "(".$voucher_discount_price."₹)"; ?> </span> 
                                 </p>
                                 <p class="text-left" >
                                    <a href="voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                                    <span style="font-size:15px;">
                                    View Details <i class="fas fa-chevron-right" style="opacity:0.5; font-size:13px;"></i><i class="fas fa-chevron-right" style="margin-left:-2.5px; font-size:13px;"></i>
                                    </span>
                                    </a>   
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php 
                        }
                        }else{
                           ?>
                     <div class="">
                        <div class="row my-5">
                           <div class="col-12 text-center">
                              No Data Available
                           </div>
                        </div>
                        </dv>
                        <?php
                           }
                           ?>
                     </div>
                  </div>
               </div>
              
               <?php
                  }else if($voucher_type == "dynamic"){
                  
                     ?>
               <div class="container-fluid mt-2" >
                  <div class="row">
                     <div class="col-md-12">
                        <p class="text-center" style="margin-bottom:0px;">
                           <span style="font-size:25px; color:#667eea; font-weight:400; ">
                           <?php echo $voucher_code; ?>
                           </span>
                        </p>
                     </div>
                  </div>
               </div>
               <div class="container-fluid">
                  <p class="text-center">
                     <span style="font-size:15px; color:#000000; font-weight:400; ">
                     Voucher worth:
                     </span>
                     <span style="font-size:15px; color:#667eea;font-weight:600;  ">
                     <?php echo "₹".$voucher_worth.".00/-"; ?>
                     </span>
                  </p>
                  <p class="text-center" >
                     <a href="your-voucher-code.php?id=<?php echo $checkout_id;?>" style="text-decoration:none !important;">
                     <span style="font-size:15px; font-weight:600;">
                     View Code <i class="fas fa-chevron-right" style="opacity:0.5; font-size:13px;"></i><i class="fas fa-chevron-right" style="margin-left:-2.5px; font-size:13px;"></i>
                     </span>
                     </a>   
                  </p>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-center">
                           <div style="border-top:2px solid #ccc; width:80% ">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Featured heading -->
               <div class="container-fluid mt-2">
                
                  <div class="row">
                     <?php 
                        $query2 = "SELECT * FROM `variable_voucher` WHERE `is_deleted` = 0 AND `id` = $voucher_id";
                                             
                        $run_query2 = mysqli_query($con, $query2);
                        $rows2     = mysqli_num_rows($run_query2);
                                             
                        if ($rows2 >0 && $run_query2 == TRUE) { 
                        while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                        $voucher_id = $data2['id'];  
                        $voucher_image = $data2['image_one']; 
                        $voucher_name = $data2['name'];
                        $min_price = $data2['min_price'];  
                        $max_price = $data2['max_price']; 
                        $rating = $data2['rating'];
                        $codes_available = $data2['codes_available'];
                        ?>
                     <div class="col-md-12 my-2">
                        <div class="row">
                           <div class="col-5">
                              <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px; " alt="Voucher image">
                           </div>
                           <div class="col-7">
                              <div class="f-slider-v-info">
                                 <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                                 <p class="text-left" style="font-size:18px; margin-bottom:0px;">
                                    <span style="color:black;"><?php echo  $voucher_name; ?>  </span>
                                    <a href="remove-from-favorite.php?id=<?php echo $voucher_id ?>&type=normal" style="text-decoration:none !important; color:black;">
                                    <span  style="color:#FF0000;">&nbsp; <i id="fav-id" class="fas fa-heart"></i> </span>
                                    </a>
                                 </p>
                                 <p class="text-left" style="margin-bottom:0px !important;"> 
                                    <span style="font-size:20px;"> 
                                    <?php echo $min_price."₹ - ".$max_price."₹"; ?> 
                                    </span>
                                 </p>
                                 <p class="text-left" >
                                    <a href="dynamic-voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                                    <span style="font-size:15px;">
                                    View Details <i class="fas fa-chevron-right" style="opacity:0.5; font-size:13px;"></i><i class="fas fa-chevron-right" style="margin-left:-2.5px; font-size:13px;"></i>
                                    </span>
                                    </a>   
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php 
                        }
                        }
                        else{
                           ?>
                     <div class="">
                        <div class="row my-5">
                           <div class="col-12 text-center">
                              No Data Available
                           </div>
                        </div>
                        </dv>
                        <?php
                           }
                           ?>
                     </div>
                  </div>
                  <?php 
                     }
                     ?>
               </div>
            </div>
         </div>

         <?php
         }
            }
            }else{
               ?>
         <div class="container-fluid text-center">
            <span class="w-100 text-center">
            No Data Available
            </span>
         </div>
         <?php
            }
            
            
            ?>

            <div class="container-fluid text-center mt-3">

            <p class="text-center" >
                     <a href="my-vouchers.php" style="text-decoration:none !important;">
                     <span style="font-size:15px; font-weight:600;">
                     View unused <i class="fas fa-chevron-right" style="opacity:0.5; font-size:13px;"></i><i class="fas fa-chevron-right" style="margin-left:-2.5px; font-size:13px;"></i>
                     </span>
                     </a>   
                  </p>
               
            </div>
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
   </body>
</html>