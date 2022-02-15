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
      if (!empty($_GET['id']) && !empty($_GET['type']) && !empty($_GET['price'])) {
          $voucher_id = $_GET['id'];
          $voucher_type = $_GET['type'];
          $voucher_buy_price = $_GET['price'];
   
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
   
   
      //saving data into session variable
         if($alert == 0){
               $_SESSION['voucher_id'] =  $voucher_id;
               $_SESSION['voucher_type'] =  $voucher_type;
               $_SESSION['voucher_buy_price'] =  $voucher_buy_price;
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
                  Checkout
                  </span>
               </div>
            </div>
         </div>
         <br>
         <br>
         <?php 
            if($alert == 0){
            
            ?>
         <?php
            if($voucher_type == "normal"){
                ?>
         <!-- Featured heading -->
         <div class="container-fluid mt-2">
            <div class="row">
               <div class="col-12">
                  <span style="font-size:20px; font-weight:400;">
                  Selected Voucher
                  </span>
               </div>
            </div>
            <!-- new section for vouchers -->
            <div class="row">
               <?php 
                  $query2 = "SELECT * FROM `voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1 AND `id` = $voucher_id";
                     
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
                        <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px; <?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?>" alt="Voucher image">
                     </div>
                     <div class="col-7">
                        <div class="f-slider-v-info">
                           <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                           <p class="text-left" style="font-size:18px; margin-bottom:0px;">
                              <span style="color:black;"><?php if($codes_available == 0){ echo "(Not Available)"; }?> <?php echo  $voucher_name; ?>  </span>
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
         <!-- Featured heading -->
         <div class="container-fluid mt-2">
            <div class="row">
               <div class="col-12">
                  <span style="font-size:20px; font-weight:400;">
                  Selected Voucher
                  </span>
               </div>
            </div>
            <!-- new section for vouchers -->
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
                        <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px; <?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?>" alt="Voucher image">
                     </div>
                     <div class="col-7">
                        <div class="f-slider-v-info">
                           <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                           <p class="text-left" style="font-size:18px; margin-bottom:0px;">
                              <span style="color:black;"><?php if($codes_available == 0){ echo "(Not Available)"; }?> <?php echo  $voucher_name; ?>  </span>
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
               }else{
                  ?>
            <div class="container">
               <div class="row">
                  <div class="col text-center">
                     No Data Found
                  </div>
               </div>
            </div>
            <?php
               }
               ?>
         </div>
         <div class="container-fluid d-flex align-items-center justify-content-center mt-3">
            <div style="border-top:2px solid #ccc; width:80%; m-auto">
            </div>
         </div>
         <div class="container-fluid mt-5">
            <div class="row mt-3 mb-3">
               <div class="col-6">
                  <p style="margin-bottom:0px;">
                     <span style="font-size:20px; font-weight:400;">Price: </span>
                  </p>
               </div>
               <div class="col-6">
                  <p style="margin-bottom:0px;">
                     <span style="font-size:25px; color:#667eea; font-weight:600;  float:right;">
                     <span style="font-size:20px; color:#667eea;font-weight:600;  ">₹</span>
                     <?php echo $voucher_buy_price.".00/-" ?>
                     </span>
                  </p>
               </div>
            </div>
            <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                  <div class="d-flex align-items-center justify-content-right">
                     <div style="border-top:2px solid #ccc; width:100% ">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-6">
                  <p style="margin-bottom:0px;">
                     <span style="font-size:20px; font-weight:500;">Total: </span>
                  </p>
               </div>
               <div class="col-6">
                  <p style="margin-bottom:0px;">
                     <span style="font-size:25px; color:#667eea; font-weight:600;  float:right;">
                     <span style="font-size:20px; color:#667eea;font-weight:600;  ">₹</span>
                     <?php echo $voucher_buy_price.".00/-" ?>
                     </span>
                  </p>
               </div>
            </div>
         </div>
         <div class="row position-fix-bottom-zero">
            <div class="col-12">
               <a href="pay-now.php" style="text-decoration: none; color: #fff;">
                  <div class="btn-buy-now">Pay Now</div>
               </a>
            </div>
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
      <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
      <!-- Initialize Swiper -->
      <script>
         var swiper = new Swiper(".brand_swiper", {
            lazy: true,
           slidesPerView: 3,
           spaceBetween: 30,
           freeMode: true,
           loop: true,
           autoplay: {
          delay: 10000,
          disableOnInteraction: true,
         },
           pagination: {
             el: ".swiper-pagination",
             clickable: true,
           },
         });
      </script>
      <script>
         var swiper = new Swiper(".brand_vouchers_swiper", {
            lazy: true,
           slidesPerView: 2,
           spaceBetween: 30,
           freeMode: true,
           loop: true,
           
           autoplay: {
          delay: 2500,
          disableOnInteraction: true,
         },
           pagination: {
             el: ".swiper-pagination",
             clickable: true,
           },
         });
      </script>
   </body>
</html>