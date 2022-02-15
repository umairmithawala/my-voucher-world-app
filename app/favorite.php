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
      <style>
         html,
         body {
         position: relative;
         height: 100%;
         }
         body {
         /* background: #eee; */
         /* font-family: Helvetica Neue, Helvetica, Arial, sans-serif; */
         /* font-size: 14px; */
         color: #000;
         margin: 0;
         padding: 0;
         }
         .swiper {
         width: 100%;
         height: 100%;
         }
         .swiper-slide {
         text-align: center;
         font-size: 18px;
         background: #fff;
         /* Center slide text vertically */
         display: -webkit-box;
         display: -ms-flexbox;
         display: -webkit-flex;
         display: flex;
         -webkit-box-pack: center;
         -ms-flex-pack: center;
         -webkit-justify-content: center;
         justify-content: center;
         -webkit-box-align: center;
         -ms-flex-align: center;
         -webkit-align-items: center;
         align-items: center;
         }
         .swiper-slide img {
         display: block;
         width: 100%;
         height: 100%;
         /* object-fit: cover; */
         }
      </style>
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
               Favorite
               </span>
            </div>
            <div class="b-head-left">
               <p style="float: right;">
               </p>
            </div>
         </div>
      </div>
      <br>
      <br>
      <?php
         $query1 = "SELECT * FROM `favorite` WHERE `user_id` = $user_id ORDER BY `id` DESC";
         $run_query1 = mysqli_query($con, $query1);
         $rows1     = mysqli_num_rows($run_query1);
         if ($rows1 >0 && $run_query1 == TRUE) { 
           while ($data1 = mysqli_fetch_assoc($run_query1)) { 
         
           
           ?>
      <!-- Search Box -->
      <?php
         if($data1['voucher_type'] == "normal"){
             
         
            
         
         
         ?>
      <!-- Featured heading -->
      <div class="container-fluid mt-2">
      <br>
      <!-- new section for vouchers -->
      <div class="row">
         <?php 
            $favorite_voucher_id = $data1['voucher_id'];
            
            $query2 = "SELECT * FROM `voucher` WHERE `is_deleted` = 0 AND `id` = $favorite_voucher_id";
               
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
            <a href="voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
               <div class="" style=" width:100%; border:0px solid black;">
                  <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px; <?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?>" alt="Voucher image">
                  <div class="f-slider-v-info">
                     <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                     <p class="text-left" style="font-size:18px; margin-bottom:0px;"><span style="color:black;"><?php if($codes_available == 0){ echo "(Not Available)"; }?> <?php echo  $voucher_name; ?>  </span>
            <a href="remove-from-favorite.php?id=<?php echo $voucher_id ?>&type=normal" style="text-decoration:none !important; color:black;">
            <span  style="color:#FF0000;">&nbsp; <i id="fav-id" class="fas fa-heart"></i> </span>
            </a>
            </p>
            <p class="text-left"> <span style="font-size:20px;"> <?php echo $voucher_price."₹"; ?> </span> <span style="color:#CCCCCC;"> <?php echo "(".$voucher_discount_price."₹)"; ?> </span>  </p>
            </div>
            </div>
            </a>
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
      <?php
         }else if($data1['voucher_type'] == "dynamic"){
         
            ?>
      <!-- Featured heading -->
      <div class="container-fluid mt-2">
         <!-- new section for vouchers -->
         <div class="row">
            <?php 
               $favorite_voucher_id = $data1['voucher_id'];
               
               $query2 = "SELECT * FROM `variable_voucher` WHERE `is_deleted` = 0 AND `id` = $favorite_voucher_id";
                                    
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
            <div class="col-md-6 my-2">
               <a href="dynamic-voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                  <div class="" style=" width:100%; border:0px solid black;">
                     <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px; <?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?> " alt="Voucher image">
                     <div class="f-slider-v-info">
                        <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                        <p class="text-left" style="font-size:18px; margin-bottom:0px;"><span style="color:black;"><?php if($codes_available == 0){ echo "(Not Available)"; }?>  <?php echo  $voucher_name; ?></span>
               <a href="remove-from-favorite.php?id=<?php echo $voucher_id ?>&type=dynamic" style="text-decoration:none !important; color:black;">
               <span  style="color:#FF0000;">&nbsp; <i id="fav-id" class="fas fa-heart"></i> </span>
               </a>
               </p>
               <p class="text-left"> <span style="font-size:20px;"> <?php echo $min_price."₹ - ".$max_price."₹"; ?> </p>
               </div>
               </div>
               </a>
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
         <?php
            }
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