<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<?php
   require_once '../database/db-con.php';
   
    if (isset($_POST['add_vendor'])) {
   
      $name = $_POST['name'];
      $name = htmlspecialchars($name , ENT_QUOTES, "UTF-8");
     $name = mysqli_real_escape_string($con,$name);

     $company_name = $_POST['company_name'];
     $company_name = htmlspecialchars($company_name , ENT_QUOTES, "UTF-8");
    $company_name = mysqli_real_escape_string($con,$company_name);

    $email = $_POST['email'];
    $email = htmlspecialchars($email , ENT_QUOTES, "UTF-8");
   $email = mysqli_real_escape_string($con,$email);

   $phone = $_POST['phone'];
   $phone = htmlspecialchars($phone , ENT_QUOTES, "UTF-8");
  $phone = mysqli_real_escape_string($con,$phone);

  $vendor_api_key = "mvw_key_";
  $vendor_api_secret = "mvw_secret_";

  function generateRandomString($length = 10) {
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++) {
       $randomString .= $characters[rand(0, $charactersLength - 1)];
   }
   return $randomString;
}

$vendor_api_key .= generateRandomString(8);
$vendor_api_secret .= generateRandomString(12);





        $timestamp = time();
  
   
        $query1 = "INSERT INTO `vendors`(`id`, `name`, `company_name`, `email`, `phone`, 
        `vendor_api_key`,`vendor_api_secret`,`timestamp`) 
        VALUES (NULL,'$name','$company_name','$email','$phone','$vendor_api_key','$vendor_api_secret','$timestamp')";
   
        if ($con->query($query1) === true) {
            $voucher_id =  mysqli_insert_id($con);
            ?>

<?php
   }else{
      //   echo "Error: " . $query1 . "<br>" . $con->error;
   }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="pixelstrap">
      <link rel="icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon">
      <link rel="shortcut icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon">
      <title>Add Voucher | My Voucher World Admin panel </title>
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- Font Awesome-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fontawesome.css">
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
      <!-- Dropzone css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/dropzone.css">
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
   </head>
   <body>
      `
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         <?php 
            require_once("../element/header.php") 
            
            ?>
         <!-- Page Header Ends -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php
               require_once("../element/sidebar.php") 
               ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="page-header-left">
                              <h3>Add Vendor
                                 <small>My Voucher Admin panel</small>
                              </h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row product-adding">
                     <div class="card">
                        <div class="card-header">
                           <h5>Add Vendor</h5>
                        </div>
                        <div class="card-body">
                           <form action="" method="POST" enctype= "multipart/form-data" >
                              <div class="digital-add needs-validation">
                                 <div class="row">
                                 <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom01" class="col-form-label pt-0"> Name</label>
                                          <input class="form-control" id="validationCustom01" type="text" required="" name="name">
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom01" class="col-form-label pt-0">Company Name</label>
                                          <input class="form-control" id="validationCustom01" type="text" required="" name="company_name">
                                       </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom02" class="col-form-label"> Email</label>
                                          <input class="form-control" id="validationCustom02" type="email" required="" name="email">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom02" class="col-form-label"> Phone</label>
                                          <input class="form-control" id="validationCustom02" type="number" required="" name="phone">
                                       </div>
                                    </div>
                                   
                               
                              </div>
                              <div class="product-buttons text-center mt-5">
                                 <button type="submit" class="btn btn-primary" name="add_vendor">Add Vendor</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Container-fluid Ends-->
         </div>
         <!-- footer start-->
         <?php require_once("../element/footer.php") ?>
         <!-- footer end-->
      </div>
      </div>
      <!-- latest jquery-->
      <script src="../assets/js/jquery-3.3.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="../assets/js/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- Sidebar jquery-->
      <script src="../assets/js/sidebar-menu.js"></script>
      <!--dropzone js-->
      <script src="../assets/js/dropzone/dropzone.js"></script>
      <script src="../assets/js/dropzone/dropzone-script.js"></script>
      <!--ckeditor js-->
      <script src="../assets/js/editor/ckeditor/ckeditor.js"></script>
      <script src="../assets/js/editor/ckeditor/styles.js"></script>
      <script src="../assets/js/editor/ckeditor/adapters/jquery.js"></script>
      <script src="../assets/js/editor/ckeditor/ckeditor.custom.js"></script>
      <!--Customizer admin-->
      <!-- <script src="../assets/js/admin-customizer.js"></script> -->
      <!-- lazyload js-->
      <script src="../assets/js/lazysizes.min.js"></script>
      <!--right sidebar js-->
      <script src="../assets/js/chat-menu.js"></script>
      <!--script admin-->
      <script src="../assets/js/admin-script.js"></script>
   </body>
</html>