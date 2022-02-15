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
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="pixelstrap">
      <link rel="icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon">
      <link rel="shortcut icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon">
      <title>Dashboard | My Voucher World</title>
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- Font Awesome-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fontawesome.css">
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
      <!-- ico-font-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
      <!-- Prism css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/prism.css">
      <!-- Chartist css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
   </head>
   <body>
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         <?php require_once("../element/header.php") ?>
         <!-- Page Header Ends -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            =
            <!-- Page Sidebar Start-->
            <?php require_once('../element/sidebar.php') ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="page-header-left">
                              <h3>Dashboard
                                 <small>My Voucher Admin Panel</small>
                              </h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
               <?php
                  $total_earnings = 0;
                  $total_vouchers = 0;
                  $total_orders = 0;
                  $total_users = 0;
                  
                  $query1 = "SELECT SUM(`buy_price`) AS `total_earnings` FROM `checkout` WHERE `is_paid` = 1";
                  $run_fetch1 = mysqli_query($con, $query1);
                  $no_of_row1  = mysqli_num_rows($run_fetch1);
                  $data1 = mysqli_fetch_assoc($run_fetch1);
                  $total_earnings = $data1['total_earnings'];
                  if($total_earnings == ""){
                      $total_earnings = 0;
                  }
                  
                  
                  
                  //gettinng total vouchers
                  $query1 = "SELECT `id` FROM `voucher`";
                  $run_fetch1 = mysqli_query($con, $query1);
                  $no_of_row1  = mysqli_num_rows($run_fetch1);
                  $total_vouchers =  $no_of_row1;
                  
                  $query1 = "SELECT `id` FROM `variable_voucher`";
                  $run_fetch1 = mysqli_query($con, $query1);
                  $no_of_row1  = mysqli_num_rows($run_fetch1);
                  $total_vouchers +=  $no_of_row1;
                  
                  
                  
                  //gettinng total orders
                  $query1 = "SELECT `id` FROM `checkout`";
                  $run_fetch1 = mysqli_query($con, $query1);
                  $no_of_row1  = mysqli_num_rows($run_fetch1);
                  $total_orders =  $no_of_row1;
                  
                   //gettinng total users
                   $query1 = "SELECT `id` FROM `users`";
                   $run_fetch1 = mysqli_query($con, $query1);
                   $no_of_row1  = mysqli_num_rows($run_fetch1);
                   $total_users =  $no_of_row1;
                  
                  ?>
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                           <div class="bg-warning card-body">
                              <div class="media static-top-widget row">
                                 <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="navigation" class="font-warning"></i></div>
                                 </div>
                                 <div class="media-body col-8">
                                    <span class="m-0">Earnings</span>
                                    <h3 class="mb-0">₹ <span class="counter"><?php echo $total_earnings; ?></span></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden  widget-cards">
                           <div class="bg-secondary card-body">
                              <div class="media static-top-widget row">
                                 <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i></div>
                                 </div>
                                 <div class="media-body col-8">
                                    <span class="m-0">Vouchers</span>
                                    <h3 class="mb-0"> <span class="counter"><?php echo $total_vouchers; ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                           <div class="bg-primary card-body">
                              <div class="media static-top-widget row">
                                 <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="message-square" class="font-primary"></i></div>
                                 </div>
                                 <div class="media-body col-8">
                                    <span class="m-0">Orders</span>
                                    <h3 class="mb-0"> <span class="counter"><?php echo $total_orders; ?></span></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                           <div class="bg-danger card-body">
                              <div class="media static-top-widget row">
                                 <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i></div>
                                 </div>
                                 <div class="media-body col-8">
                                    <span class="m-0">Users</span>
                                    <h3 class="mb-0"><span class="counter"><?php echo $total_users; ?></span></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 xl-100">
                        <div class="card">
                           <div class="card-header">
                              <h5>Latest Orders</h5>
                              <div class="card-header-right">
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="user-status table-responsive latest-order-table">
                                 <table class="table table-bordernone">
                                    <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Checkout Id</th>
                                          <th scope="col">Voucher Id</th>
                                          <th scope="col">Voucher Code Id</th>
                                          <th scope="col">Buy price</th>
                                          <th scope="col">Payment</th>
                                          <th scope="col">Time</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          $query1 = "SELECT * FROM `checkout` ORDER BY `id` DESC LIMIT 10";
                                          $run_query1 = mysqli_query($con, $query1);
                                          $rows1     = mysqli_num_rows($run_query1);
                                          $index_one = 1;
                                          if ($rows1 > 0 && $run_query1 == TRUE) { 
                                              while ($data1 = mysqli_fetch_assoc($run_query1)) { 
                                          
                                                //connecting cart table to get voucher Id 
                                              
                                                        
                                                
                                                
                                          ?>
                                       <tr>
                                          <td><?php echo $index_one; ?></td>
                                          <td class="digits"><?php echo "#".$data1['id'];?></td>
                                          <td class="digits"><?php echo "#".$data1['voucher_id'];?></td>
                                          <td class="digits"><?php echo "#".$data1['voucher_code_id'];?></td>
                                          <td class="digits">₹<?php echo $data1['buy_price'].".00/-"; ?></td>
                                          
                                          <td><?php 
                                          
                                          
                                          if($data1['is_paid'] == 1){
                                             echo "<span style='color:green;'>Paid</span>";
                                          }else if($data1['is_paid'] == 0){
                                             echo "<span style='color:red;'>Not Paid</span>";
                                          }else if($data1['is_paid'] == 2){
                                             echo "Refunded";
                                          }else{
                                             echo "Not Applied";
                                          }
                                          
                                          ?></td>

                                          <td>
                                          <?php
                     $mydate=getdate($data1['timestamp']);
                     echo "$mydate[mday]/$mydate[mon]/$mydate[year],";
                     echo " "."$mydate[hours]:$mydate[minutes]";
                     ?>
                                          </td>
                                          
                                       </tr>
                                       <?php
                                          $index_one++;
                                          }}
                                          ?>
                                    </tbody>
                                 </table>
                                 <a href="orders.php" class="btn btn-primary">View All Orders</a>
                              </div>
                              <div class="code-box-copy">
                                 <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="" data-original-title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 xl-100">
                        <div class="card">
                           <div class="card-header">
                              <h5>Users</h5>
                           </div>
                           <div class="card-body">
                              <div class="user-status table-responsive latest-order-table">
                                 <table class="table table-bordernone">
                                    <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">ID</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Email</th>
                                          <th scope="col">Phone</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          $query1 = "SELECT * FROM `users` LIMIT 10 ";
                                          $runquery1 = mysqli_query($con, $query1);
                                          $rows1     = mysqli_num_rows($runquery1);
                                          $index_one = 1;
                                          if ($rows1 > 0 && $runquery1 == TRUE) { 
                                              while ($data1 = mysqli_fetch_assoc($runquery1)) { 
                                                  
                                          ?>
                                       <tr>
                                          <td><?php echo $index_one; ?></td>
                                          <td class="digits"><?php echo "#".$data1['id'];?></td>
                                          <td ><?php echo $data1['name']; ?></td>
                                          <td ><?php echo $data1['email']; ?></td>
                                          <td class="digits"><?php echo $data1['phone']; ?></td>
                                       </tr>
                                       <?php
                                          $index_one++;
                                          }}
                                          ?>
                                    </tbody>
                                 </table>
                                 <a href="user-list.php" class="btn btn-primary">View All Users</a>
                              </div>
                              <div class="code-box-copy">
                                 <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="" data-original-title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <?php require_once('../element/footer.php') ?>
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
      <!--chartist js-->
      <script src="../assets/js/chart/chartist/chartist.js"></script>
      <!--chartjs js-->
      <script src="../assets/js/chart/chartjs/chart.min.js"></script>
      <!-- lazyload js-->
      <script src="../assets/js/lazysizes.min.js"></script>
      <!--copycode js-->
      <script src="../assets/js/prism/prism.min.js"></script>
      <script src="../assets/js/clipboard/clipboard.min.js"></script>
      <script src="../assets/js/custom-card/custom-card.js"></script>
      <!--counter js-->
      <script src="../assets/js/counter/jquery.waypoints.min.js"></script>
      <script src="../assets/js/counter/jquery.counterup.min.js"></script>
      <script src="../assets/js/counter/counter-custom.js"></script>
      <!--peity chart js-->
      <script src="../assets/js/chart/peity-chart/peity.jquery.js"></script>
      <!--sparkline chart js-->
      <script src="../assets/js/chart/sparkline/sparkline.js"></script>
      <!--Customizer admin-->
      <!-- <script src="../assets/js/admin-customizer.js"></script> -->
      <!--dashboard custom js-->
      <script src="../assets/js/dashboard/default.js"></script>
      <!--right sidebar js-->
      <script src="../assets/js/chat-menu.js"></script>
      <!--height equal js-->
      <script src="../assets/js/height-equal.js"></script>
      <!-- lazyload js-->
      <script src="../assets/js/lazysizes.min.js"></script>
      <!--script admin-->
      <script src="../assets/js/admin-script.js"></script>
   </body>
</html>