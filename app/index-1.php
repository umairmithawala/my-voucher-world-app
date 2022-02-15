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
      <title>Index</title>
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
      <!-- Search Box -->
      <form action="search-result.php" method="POST">
         <div class="container-fluid">
            <div class="searchbar-box">
               <div class="searchbar-box-right">
                  <div class="searchbar-box-right-input">
                     <input type="text" name="search" style="background: #F5F5F5" placeholder=" Search Voucher" />
                  </div>
               </div>
               <div class="searchbar-box-left text-center">
                  <i class="fas fa-sliders-h" data-toggle="modal" data-target="#filter_modal"></i>
               </div>
            </div>
         </div>
      </form>
      <!-- End PositionFixed -->
      <div class="container-fluid">
         <div class="py-2">
            <div class="swiper brand_swiper">
               <div class="swiper-wrapper" style="">
                  <?php
                     $query1    = "SELECT * FROM brands WHERE `is_deleted` = 0";    
                     $run_query1 = mysqli_query($con, $query1);
                     $rows1     = mysqli_num_rows($run_query1);
                     
                     if ($rows1 > 0 && $run_query1 == TRUE) { 
                       while ($data1 = mysqli_fetch_assoc($run_query1)) { 
                         $brand_image = $data1['image']; 
                         ?>
                  <div class="swiper-slide">
                     <img src="../super-admin/assets/images/uploads/<?php echo $brand_image;?>" alt="" />
                  </div>
                  <?php 
                     }
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>
      <!-- Featured heading -->
      <div class="container-fluid mt-2">
      <div class="b-head">
         <div class="b-head-right">
            <div>
               <span>Brand Vouchers</span>
            </div>
         </div>
         <div class="b-head-left">
            <p style="float: right;">
               <a href="view-all-vouchers.php?type=brand_vouchers" style="text-decoration:none; color: #A9A9A9;">More <i class="fas fa-arrow-right"></i></a>
            </p>
         </div>
      </div>
      <!-- new section for vouchers -->
      <div class="swiper brand_vouchers_swiper">
         <div class="swiper-wrapper" style="">
            <?php 
               $query2 = "SELECT * FROM `voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1 LIMIT 10";
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
                   ?>
            <div class="swiper-slide">
               <a href="voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                  <div class="" style=" width:100%; border:0px solid black;">
                     <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px;" alt="Voucher image">
                     <div class="f-slider-v-info">
                        <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                        <p class="text-left" style="font-size:18px; margin-bottom:0px;"> <?php echo  $voucher_name; ?>  </p>
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
      </div>
      <div class="container-fluid mt-2">
      <div class="b-head">
         <div class="b-head-right">
            <div>
               <span>Dynamic Vouchers</span>
            </div>
         </div>
         <div class="b-head-left">
            <p style="float: right;">
               <a href="view-all-vouchers.php?type=dynamic_vouchers" style="text-decoration:none; color: #A9A9A9;">More <i class="fas fa-arrow-right"></i></a>
            </p>
         </div>
      </div>
      <!-- new section for vouchers -->
      <div class="swiper brand_vouchers_swiper">
         <div class="swiper-wrapper" style="">
            <?php 
               $query2 = "SELECT * FROM `variable_voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1 LIMIT 10";
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
                   ?>
            <div class="swiper-slide">
               <a href="dynamic-voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                  <div class="" style=" width:100%; border:0px solid black;">
                     <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px;" alt="Voucher image">
                     <div class="f-slider-v-info">
                        <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                        <p class="text-left" style="font-size:18px; margin-bottom:0px;"> <?php echo  $voucher_name; ?>  </p>
                        <p class="text-left"> <span style="font-size:20px;"> <?php echo $min_price."₹ - ".$max_price."₹"; ?> </span> </p>
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
      </div>
      <div class="container-fluid mt-2">
      <div class="b-head">
         <div class="b-head-right">
            <div>
               <span>Trending Brand Vouchers </span>
            </div>
         </div>
         <div class="b-head-left">
            <p style="float: right;">
               <a href="view-all-vouchers.php?type=trending_brand_vouchers" style="text-decoration:none; color: #A9A9A9;">More <i class="fas fa-arrow-right"></i></a>
            </p>
         </div>
      </div>
      <!-- new section for vouchers -->
      <div class="swiper brand_vouchers_swiper">
         <div class="swiper-wrapper" style="">
            <?php 
               $query2 = "SELECT * FROM `voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1 AND `rating` > 4 LIMIT 10";
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
                   ?>
            <div class="swiper-slide">
               <a href="voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                  <div class="" style=" width:100%; border:0px solid black;">
                     <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px;" alt="Voucher image">
                     <div class="f-slider-v-info">
                        <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                        <p class="text-left" style="font-size:18px; margin-bottom:0px;"> <?php echo  $voucher_name; ?>  </p>
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
      </div>
      <div class="container-fluid mt-2">
      <div class="b-head">
         <div class="b-head-right">
            <div>
               <span>Trending Dynamic Vouchers</span>
            </div>
         </div>
         <div class="b-head-left">
            <p style="float: right;">
               <a href="view-all-vouchers.php?type=trending_dynamic_vouchers" style="text-decoration:none; color: #A9A9A9;">More <i class="fas fa-arrow-right"></i></a>
            </p>
         </div>
      </div>
      <!-- new section for vouchers -->
      <div class="swiper brand_vouchers_swiper">
         <div class="swiper-wrapper" style="">
            <?php 
               $query2 = "SELECT * FROM `variable_voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1 AND `rating` > 4 LIMIT 10";
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
                   ?>
            <div class="swiper-slide">
               <a href="dynamic-voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                  <div class="" style=" width:100%; border:0px solid black;">
                     <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px;" alt="Voucher image">
                     <div class="f-slider-v-info">
                        <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                        <p class="text-left" style="font-size:18px; margin-bottom:0px;"> <?php echo  $voucher_name; ?>  </p>
                        <p class="text-left"> <span style="font-size:20px;"> <?php echo $min_price."₹ - ".$max_price."₹"; ?> </span> </p>
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
      </div>
      <div class="container-fluid mt-2">
         <div class="b-head">
            <div class="b-head-right">
               <div>
                  <span>Less Price </span>
               </div>
            </div>
            <div class="b-head-left">
               <p style="float: right;">
                  <a href="view-all-vouchers.php?type=less_price_vouchers" style="text-decoration:none; color: #A9A9A9;">More <i class="fas fa-arrow-right"></i></a>
               </p>
            </div>
         </div>
         <!-- new section for vouchers -->
         <div class="swiper brand_vouchers_swiper">
            <div class="swiper-wrapper" style="">
               <?php 
                  $query2 = "SELECT * FROM `voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1 AND `discount_price` < 100 LIMIT 10";
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
                      ?>
               <div class="swiper-slide">
                  <a href="voucher-details.php?id=<?php echo $voucher_id ?>" style="text-decoration:none !important;">
                     <div class="" style=" width:100%; border:0px solid black;">
                        <img class="card-img-top" src="../super-admin/assets/images/uploads/<?php echo $voucher_image; ?>" style="heigh:100px !important; border-radius:10px;" alt="Voucher image">
                        <div class="f-slider-v-info">
                           <span class="float-right"style="font-size:15px; color:#F2D900;" ><i class="fas fa-star" ></i><?php echo " (".$rating.")";  ?></span>
                           <p class="text-left" style="font-size:18px; margin-bottom:0px;"> <?php echo  $voucher_name; ?>  </p>
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
          disableOnInteraction: false,
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
          disableOnInteraction: false,
         },
           pagination: {
             el: ".swiper-pagination",
             clickable: true,
           },
         });
      </script>
   </body>
</html>
<!-- Modal -->
<div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" >Apply Filter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="filter-result.php" method="POST">
         <div class="modal-body">
            
            
            <div class="wrapper">
               <?php
                  //getting smallest amount for slider 
                  
                  $query4 = "SELECT MIN(`price`) AS `min_price` FROM `voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1";
                  $run_query4 = mysqli_query($con, $query4);
                  $rows4     = mysqli_num_rows($run_query4);
                  
                  if ($rows4 >0 && $run_query4 == TRUE) { 
                    while ($data4 = mysqli_fetch_assoc($run_query4)) { 
                      $normal_voucher_min_price = $data4['min_price'];
                    }
                  }
                  
                  $query4 = "SELECT MIN(`min_price`) AS `min_price` FROM `variable_voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1";
                                       $run_query4 = mysqli_query($con, $query4);
                                       $rows4     = mysqli_num_rows($run_query4);
                                       
                                       if ($rows4 >0 && $run_query4 == TRUE) { 
                                         while ($data4 = mysqli_fetch_assoc($run_query4)) { 
                                           $dynamic_voucher_min_price = $data4['min_price'];
                                         }
                                       }
                  
                                 
                                       $range_min_price = 0;
                  
                                       if($normal_voucher_min_price <= $dynamic_voucher_min_price){
                                          $range_min_price = $normal_voucher_min_price;
                                       }
                  
                                       if($dynamic_voucher_min_price <= $normal_voucher_min_price ){
                                          $range_min_price = $dynamic_voucher_min_price;
                                       }
                  
                  //getting largest amount for slider
                  
                  
                  $query4 = "SELECT MAX(`price`) AS `max_price` FROM `voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1";
                  $run_query4 = mysqli_query($con, $query4);
                  $rows4     = mysqli_num_rows($run_query4);
                  
                  if ($rows4 >0 && $run_query4 == TRUE) { 
                    while ($data4 = mysqli_fetch_assoc($run_query4)) { 
                      $normal_voucher_max_price = $data4['max_price'];
                    }
                  }
                  
                  $query4 = "SELECT MAX(`max_price`) AS `max_price` FROM `variable_voucher` WHERE `is_deleted` = 0 AND `codes_available` = 1";
                                       $run_query4 = mysqli_query($con, $query4);
                                       $rows4     = mysqli_num_rows($run_query4);
                                       
                                       if ($rows4 >0 && $run_query4 == TRUE) { 
                                         while ($data4 = mysqli_fetch_assoc($run_query4)) { 
                                           $dynamic_voucher_max_price = $data4['max_price'];
                                         }
                                       }
                  
                                 
                                       $range_max_price = 0;
                  
                                       if($normal_voucher_max_price >= $dynamic_voucher_max_price){
                                          $range_max_price = $normal_voucher_max_price;
                                       }
                  
                                       if($dynamic_voucher_max_price >= $normal_voucher_max_price ){
                                          $range_max_price = $dynamic_voucher_max_price;
                                       }
                  
                  ?>
               <fieldset class="filter-price">
                  <span class="price-title">Price    :      <span id="filter_range_val" style=" font-weight:400;">
                  <?php echo $range_max_price; ?>
                  </span></span>
               </fieldset>
            </div>
          
            <input type="range" class="custom-range" id="customRange" value="<?php echo $range_max_price; ?>" name="filtered_price" min="<?php echo $range_min_price; ?>" max="<?php echo $range_max_price; ?>"  onInput="$('#filter_range_val').html($(this).val())">
            <div class="wrapper">
               <?php 
                  $query3 = "SELECT * FROM `category` WHERE `is_deleted` = 0";
                  $run_query3 = mysqli_query($con, $query3);
                  $rows3     = mysqli_num_rows($run_query3);
                  ?>
               <span class="price-title mb-2">Category</span>
               <select class="form-select" name="filtered_category" aria-label="Default select example">
                  <option value="all" selected>All</option>
                  <?php
                     if ($rows3 > 0 && $run_query3 == TRUE) { 
                            while ($data3 = mysqli_fetch_assoc($run_query3)) { 
                                $category_name = $data3['name'];
                     ?>
                  <option value="<?php echo $data3['id']; ?>"> <?php echo $category_name; ?> </option>
                  <?php
                     }
                     }
                     ?>
               </select>
            </div>
                  
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" name="filter" class="btn btn-primary blue_purple_gradient_bg border-none"  >Filter</button>
         </div>
         </form>
      </div>
   </div>
</div>