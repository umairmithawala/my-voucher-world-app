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
   if (!empty($_GET['id'])) {
       $voucher_id = $_GET['id'];
   
       $query = "SELECT * FROM `voucher` WHERE `id` = $voucher_id";
       $run_query1 = mysqli_query($con, $query);
       $rows1     = mysqli_num_rows($run_query1);
   
       if ($rows1 > 0 && $run_query1 == TRUE) { 
           while ($data1 = mysqli_fetch_assoc($run_query1)) { 
               $voucher_id = $data1['id'];
               $voucher_name = $data1['name'];
               $voucher_price = $data1['price'];
               $voucher_discount_price = $data1['discount_price'];
               $voucher_description = $data1['description'];
               $voucher_rating = $data1['rating'];
               $voucher_category = $data1['category'];
               $voucher_sub_category = $data1['sub_category'];
               $voucher_brand = $data1['brand'];
               $voucher_image1 = $data1['image_one'];
               $voucher_image2 = $data1['image_two'];
               $voucher_image3 = $data1['image_three'];
               $codes_available = $data1['codes_available'];
   
               
               //getting category name from category id 
   
               if($voucher_category == NULL || $voucher_category == ""){
                  $voucher_category = 0;
               }
   
               if($voucher_sub_category == NULL || $voucher_sub_category == ""){
                  $voucher_sub_category = 0;
               }
   
               if($voucher_brand == NULL || $voucher_brand == ""){
                  $voucher_brand = 0;
               }
               
               $query2 = "SELECT * FROM `category` WHERE `id` = $voucher_category";
               $run_query2 = mysqli_query($con, $query2);
               $rows2     = mysqli_num_rows($run_query2);              
               if ($rows2 > 0 && $run_query2 == TRUE) { 
                      while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                          $voucher_category_name = $data2['name'];
                      }
                     }else{
                        $voucher_category_name = "Not Applied";
                     }
               
               //getting sub category name from sub category id
   
               $query2 = "SELECT * FROM `sub_category` WHERE `id` = $voucher_sub_category";
               $run_query2 = mysqli_query($con, $query2);
               $rows2     = mysqli_num_rows($run_query2);              
               if ($rows2 > 0 && $run_query2 == TRUE) { 
                      while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                          $voucher_sub_category_name = $data2['name'];
                      }
                     }
                     else{
                        $voucher_sub_category_name = "Not Applied";
                     }
   
               //getting brand name from brand id 
               $query2 = "SELECT * FROM `brands` WHERE `id` = $voucher_brand";
               $run_query2 = mysqli_query($con, $query2);
               $rows2     = mysqli_num_rows($run_query2);              
               if ($rows2 > 0 && $run_query2 == TRUE) { 
                      while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                          $voucher_brand_name = $data2['name'];
                      }
                     }
                     else{
                        $voucher_brand_name = "Not Applied";
                     }
           }
       }else{
   
           ?>
<script>
   window.location = 'index-1.php';
</script>
<?php
   }
   
   }
   else {
   ?>
<script>
   window.location = 'index-1.php';
</script>
<?php
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- font awesome css -->
      <link rel="stylesheet" href="css/icon.css">
      <!-- Main css -->
      <link rel="stylesheet" href="css/stylesheet.css">
      <!-- Online Bootstrap cdn -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Voucher Details </title>
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
         object-fit: cover;
         }
      </style>
   </head>
   <body>
      <?php require_once "elements/header.php"; ?> 
      <!-- Topbar Menu Start -->
      <div class="container-fluid px-0" style="margin-top:60px;">
         <div class="swiper detail_image_slider">
            <div class="swiper-wrapper" style="">
               <?php 
                  $detail_image_slider_count = 0;
                  
                  if($voucher_image1 != NULL && $voucher_image1 != ""){
                  $detail_image_slider_count++;
                  ?>
               <div class="swiper-slide">
                  <img src="../super-admin/assets/images/uploads/<?php echo $voucher_image1; ?>" alt=""  style="<?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?>"/>
               </div>
               <?php
                  }
                  
                  
                  if($voucher_image2 != NULL && $voucher_image2 != ""){
                      $detail_image_slider_count++;
                      ?>
               <div class="swiper-slide">
                  <img src="../super-admin/assets/images/uploads/<?php echo $voucher_image2; ?>" alt="" style="<?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?>" />
               </div>
               <?php
                  }
                  
                  
                  
                  if($voucher_image3 != NULL && $voucher_image3 != ""){
                      $detail_image_slider_count++;
                      ?>
               <div class="swiper-slide">
                  <img src="../super-admin/assets/images/uploads/<?php echo $voucher_image3; ?>" alt="" style="<?php if($codes_available == 0){echo "-webkit-filter: grayscale(100%);filter: grayscale(100%);"; } ?>" />
               </div>
               <?php
                  }
                  
                              ?>
            </div>
         </div>
      </div>
      <!-- Voucher Details -->
      <div class="container-fluid mt-4">
         <div class="row">
            <div class="col">
               <span style="font-size: 30px; ">
               <?php echo $voucher_name; ?>
               <?php if($codes_available == 0){ echo "(Not Available)"; }?>  
               <br>
               </span> 
               <span style="color: #667EEA; font-size: 20px;">
            </div>
            <div class="col">
               <div class="favorite" style="float:right;">
                  <?php
                     $already_favorite = 0;
                     
                     $query1 = "SELECT `id` FROM `favorite` WHERE `user_id` = $user_id AND `voucher_id` = $voucher_id AND `voucher_type` = 'normal'";
                     
                     $run_fetch1 = mysqli_query($con, $query1);
                     $no_of_row1 = mysqli_num_rows($run_fetch1);
                     if ($no_of_row1 > 0 && $run_fetch1 == true) { 
                         $already_favorite = 1;
                      
                     }
                     
                     
                     if($already_favorite == 0){
                         //show add to favorite option
                     
                     
                         ?>
                  <a href="add-to-favorite.php?id=<?php echo $voucher_id ?>&type=normal" style="text-decoration:none; color:#111;">
                     <p onclick="fav()" style="color:#FF0000;">&nbsp; <i id="fav-id" class="far fa-heart"></i> </p>
                  </a>
                  <?php
                     }else{
                         //show remove from favorite option
                         ?>
                  <a href="remove-from-favorite.php?id=<?php echo $voucher_id ?>&type=normal" style="text-decoration:none; color:#111;">
                     <p onclick="fav()" style="color:#FF0000;">&nbsp; <i id="fav-id" class="fas fa-heart"></i> </p>
                  </a>
                  <?php
                     }
                     
                     
                     ?>
               </div>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-12">
               <p style="margin-bottom:0px;"><span style="font-size:20px; font-weight:400;">Price: </span><span style="font-size:20px; color:#667eea;font-weight:600; ">₹</span><span style="font-size:25px; color:#667eea; font-weight:600;"><?php echo $voucher_price."/-" ?></span></p>
               <p style="margin-bottom:0px;"><span style="font-size:20px; font-weight:400;">Worth: </span><span style="font-size:20px; color:#667eea;font-weight:600; ">₹</span><span style="font-size:25px; color:#667eea; font-weight:600;"><?php echo $voucher_discount_price."/-" ?></span><span>(Amount you will receive)<span></p>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-12">
               <p style="margin-bottom:0px;">
                  <span style="font-size:20px; font-weight:400;">Ratings: </span><span style="font-size:20px; color:#F2D900; font-weight:600;">
                  <?php 
                     if($voucher_rating >= 5){
                         ?>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <?php
                     }else if($voucher_rating >= 4){
                         ?>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <?php
                     }else if($voucher_rating >= 3){
                         ?>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <?php
                     }else if($voucher_rating >= 2){
                         ?>
                  <i class="fas fa-star" ></i>
                  <i class="fas fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <?php
                     }else if($voucher_rating >= 1){
                         ?>
                  <i class="fas fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <?php
                     }else{
                     
                         ?>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <i class="far fa-star" ></i>
                  <?php
                     }
                                      ?>
                  <?php echo "(".$voucher_rating.")"; ?>
                  <span>
               </p>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-6">
               <p style="margin-bottom:0px;"><span style="font-size:20px; font-weight:400;">Category: </span>
                  <br>
                  <span style="font-size:20px;"><?php echo $voucher_category_name; ?></span>
               </p>
            </div>
            <div class="col-6">
               <p style="margin-bottom:0px;"><span style="font-size:20px; font-weight:400;">Sub Category: </span>
                  <br>
                  <span style="font-size:20px;"><?php echo $voucher_sub_category_name; ?></span>
               </p>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-12">
               <div class="d-flex align-items-center justify-content-center">
                  <div style="border-top:2px solid #ccc; width:80% ">
                  </div>
               </div>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-12">
               <p style="margin-bottom:0px;"><span style="font-size:20px; font-weight:400;">Description: </span>
                  <br>
                  <span style="font-size:20px;"><?php echo $voucher_description; ?></span>
               </p>
            </div>
         </div>
      </div>
      <!-- End Voucher Details -->
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <?php
         if($codes_available == 1){
         
         ?>
      <div class="row position-fix-bottom-zero">
         <div class="col-12">
            <a href="checkout.php?id=<?php echo $voucher_id ?>&type=normal&price=<?php echo $voucher_price; ?>" style="text-decoration: none; color: #fff;">
               <div class="btn-buy-now">Buy Now</div>
            </a>
         </div>
      </div>
      <?php
         }
         ?>
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
         crossorigin="anonymous"></script>
      <!-- jQuery js -->
      <script src="js/jquery.min.js"></script>
      <!-- goback js -->
      <script src="js/goback.js"></script>
      <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
      <!-- Initialize Swiper -->
      <script>
         var swiper = new Swiper(".detail_image_slider", {
            lazy: true,
           slidesPerView: 1,
           spaceBetween: 30,
           freeMode: true,
           loop: true,
           autoplay: {
          delay: 3000,
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