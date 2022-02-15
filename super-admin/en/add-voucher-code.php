<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<?php
   require_once '../database/db-con.php';
   
       if(!empty($_GET['id'])) {
       $voucher_id = $_GET['id'];
       $qty = $_GET['qty'];

       
       } else {
           ?>
<script> 
   window.history.back();
</script>
<?php
   }
   
   ?>
<?php
   $all_code_validation = 1;
   
   if(isset($_POST['add_voucher_code'])){
       
       $qty = $_POST['qty'];
       $voucher_id = $_POST['voucher_id'];
       $timestamp = time();
   
       
       //getting all the values passes by the user and
   
           // $user_input_voucher_code_array  = array();
   
           for($i = 1; $i<=$qty; $i++){
               $voucher_code = $_POST['voucher_code'.$i];
       
               $voucher_code = htmlspecialchars($voucher_code , ENT_QUOTES, "UTF-8");
               $voucher_code = mysqli_real_escape_string($con,$voucher_code);
   
   
               $user_input_voucher_code_array[] = $voucher_code;
       
           
          
          
           }
   
       
           
   
   
   
   
       for($i = 1; $i<=$qty; $i++){
           $voucher_code = $_POST['voucher_code'.$i];
           $voucher_code = htmlspecialchars($voucher_code , ENT_QUOTES, "UTF-8");
           $voucher_code = mysqli_real_escape_string($con,$voucher_code);
   
           $query    = "SELECT * FROM `voucher_code` WHERE `voucher_code` LIKE '$voucher_code'";
           $run_fetch = mysqli_query($con, $query);
           $no_of_row  = mysqli_num_rows($run_fetch);
           if ($no_of_row > 0 && $run_fetch == TRUE) {
               $all_code_validation = 0;
               $user_input_matched_voucher_code_array[] = $voucher_code;
               
           }
   
           $query    = "SELECT * FROM `variable_voucher_code` WHERE `voucher_code` LIKE '$voucher_code'";
           $run_fetch = mysqli_query($con, $query);
           $no_of_row  = mysqli_num_rows($run_fetch);
           if ($no_of_row > 0 && $run_fetch == TRUE) {
               $all_code_validation = 0;
               $user_input_matched_voucher_code_array[] = $voucher_code;
               
           }
   
   
   
   
       
       }
   
       
   
       if($all_code_validation == 1){
           for($i = 1; $i<=$qty; $i++){
               $voucher_code = $_POST['voucher_code'.$i];
       
               $voucher_code = htmlspecialchars($voucher_code , ENT_QUOTES, "UTF-8");
               $voucher_code = mysqli_real_escape_string($con,$voucher_code);
       
           $query = "INSERT INTO `voucher_code`(`id`,`voucher_id`,`voucher_code`,`timestamp`) VALUES (NULL,$voucher_id,'$voucher_code',$timestamp)";
          
           if ($con->query($query) === true) {
              ?>

<script>
   window.location = "voucher-list.php";
</script>

<?php
               
           }else{
               // echo "Error: " . $query . "<br>" . $con->error;
           }
           }
   
       }
   
     
       
       }else{
           
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
      <title>Add Voucher Code | My Voucher World </title>
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
                              <h3>Add voucher Code
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
                           <h5>Add Voucher Code </h5>
                        </div>
                        <div class="card-body">
                           <form action="" method="POST" action="#" enctype= "multipart/form-data" >
                              <div class="digital-add needs-validation">
                                 <div class="form-group">
                                    <input type="hidden" name="qty" value="<?php echo $qty; ?>">
                                    <input type="hidden" name="voucher_id" value="<?php echo $voucher_id; ?>">
                                    <?php
                                       for($i=1; $i<=$qty; $i++) {
                                           ?>
                                    <label for="validationCustom01" class="col-form-label pt-0"> Voucher Code <?php echo $i; ?> </label>
                                    <input class="form-control" value="<?php 
                                       if($all_code_validation == 0){ 
                                           echo $user_input_voucher_code_array[$i-1];
                                       } ?>" id="validationCustom01" type="text" name="voucher_code<?php echo $i; ?>" placeholder="Enter Voucher Code Here" required>
                                    <span  style="color:red; display:none; <?php
                                       if($all_code_validation == 0){  
                                       if(in_array($user_input_voucher_code_array[$i-1], $user_input_matched_voucher_code_array)){
                                           echo "display:block;";
                                       }else{ 
                                           echo "display:none;"; 
                                       }
                                       }
                                        ?>">This code is already exist!</span>
                                    <br><br>
                                    <?php
                                       }
                                           ?>
                                 </div>
                              </div>
                              <div class="product-buttons text-center mt-5">
                                 <button type="submit" class="btn btn-primary" name="add_voucher_code">Add Voucher Code</button>
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