<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<?php
   require_once '../database/db-con.php';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
      <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app" />
      <meta name="author" content="pixelstrap" />
      <link rel="icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon" />
      <link rel="shortcut icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon" />
      <title>User List | Admin My Voucher World</title>
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
      <!-- Font Awesome-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fontawesome.css" />
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css" />
      <!-- jsgrid css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/jsgrid.css" />
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css" />
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/admin.css" />
      <!-- font awesome -->
      <script src="https://kit.fontawesome.com/12af21ff9f.js" crossorigin="anonymous"></script>
   </head>
   <body>
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         <?php
            require_once "../element/header.php"
            ?>
         <!-- Page Header Ends -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php 
               require_once "../element/sidebar.php"
               ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="page-header-left">
                              <h3>
                                 User List
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
                  <div class="card">
                     <div class="card-header">
                        <h5>User Details</h5>
                     </div>
                     <div class="card-body">
                        <!-- <div class="btn-popup pull-right">
                           <a href="create-user.html" class="btn btn-secondary">Create User</a>
                           </div> -->
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">User Id</th>
                                 <th scope="col">name</th>
                                 <th scope="col">email</th>
                                 <th scope="col">password</th>
                                 <th scope="col">Phone</th>
                                 <th scope="col" class="text-center">Email Verification</th>
                                 <th scope="col" class="text-center">Phone Verification</th>
                                 <th scope="col" class="text-center">Access</th>
                                 <th scope="col" class="text-center">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                 $query1 = "SELECT * FROM `users`";
                                 $runquery1 = mysqli_query($con, $query1);
                                 $rows1     = mysqli_num_rows($runquery1);
                                 $index_one = 1;
                                 if ($rows1 > 0 && $runquery1 == TRUE) { 
                                     while ($data1 = mysqli_fetch_assoc($runquery1)) { 
                                         
                                 ?>
                              <tr>
                                 <td>
                                    <?php 
                                       echo $index_one;
                                       
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo $data1['id'];
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo $data1['name'];
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo $data1['email'];
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo $data1['password'];
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo $data1['phone'];
                                       ?>
                                 </td>
                                 <td class="text-center">
                                    <?php 
                                       if($data1['email_verification'] == 1){
                                           ?>
                                    <i class="fas fa-check" style="color:#5cb85c;"></i>
                                    <?php
                                       }else{
                                           ?>
                                    <i class="fas fa-times" style="color:#d9534f;"></i>
                                    <?php
                                       }
                                       ?>
                                 </td>
                                 </td>
                                 <td class="text-center">
                                    <?php 
                                       if($data1['phone_verification'] == 1){
                                           ?>
                                    <i class="fas fa-check" style="color:#5cb85c;"></i>
                                    <?php
                                       }else{
                                           ?>
                                    <i class="fas fa-times" style="color:#d9534f;"></i>
                                    <?php
                                       }
                                       ?>
                                 </td>
                                 </td>
                                 <td class="text-center">
                                    <?php 
                                       if($data1['is_ban'] == 0){
                                           ?>
                                    <i class="fas fa-circle" style="color:#5cb85c;"></i>
                                    <?php
                                       }else{
                                           ?>
                                    <i class="fas fa-circle" style="color:#d9534f;"></i>
                                    <?php
                                       }
                                       ?>
                                 </td>
                                 <td class="text-center" style="min-width:100px;">
                                    <i class="fas fa-pen" ></i>
                                    &nbsp;
                                    <i class="fas fa-trash" style="color:#d9534f;"></i>
                                 </td>
                              </tr>
                              <?php
                                 $index_one++;
                                    }
                                    }
                                    
                                    ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <?php require_once "../element/footer.php" ?>
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
      <!-- Jsgrid js-->
      <script src="../assets/js/jsgrid/jsgrid.min.js"></script>
      <script src="../assets/js/jsgrid/griddata-users.js"></script>
      <script src="../assets/js/jsgrid/jsgrid-users.js"></script>
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