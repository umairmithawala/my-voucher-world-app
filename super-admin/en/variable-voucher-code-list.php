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
      <title>Voucher Code List - Admin | My Voucher World</title>
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- Font Awesome-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fontawesome.css">
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
      <!-- Datatables css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
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
            require_once("../element/header.php"); 
            ?>
         <!-- Page Header Ends -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php
               require_once("../element/sidebar.php");
               ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="page-header-left">
                              <h3>Variable Voucher Code List
                                 <small>Code List</small>
                              </h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">
                              <h5>Voucher Code List </h5>
                           </div>
                           <div class="card-body order-datatable" style="overflow-x:auto;">
                              <table class="display" id="basic-1">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Voucher Code Id </th>
                                       <th>Voucher Code </th>
                                       <th>Purchase Status</th>
                                       <th>Used</th>
                                       <th>Date</th>
                                     
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $query1  = "SELECT * FROM `variable_voucher_code`";
                                       $run_query1 = mysqli_query($con, $query1);
                                       $rows1     = mysqli_num_rows($run_query1);
                                               $index_one = 1;
                                       if ($rows1 > 0 && $run_query1 == TRUE) {
                                           while ($data1 = mysqli_fetch_assoc($run_query1)){
                                               
                                       
                                       ?>
                                    <tr>
                                       <td>
                                          <?php echo $index_one; ?>
                                       </td>
                                       <td>
                                          <?php echo "#".$data1['id']; ?>
                                       </td>
                                       <td>
                                          <?php echo $data1['voucher_code']; ?>
                                       </td>
                                      
                                       <td>
                                          <?php
                                             if($data1['is_purchased']==1){
                                                 echo "Code Not Received";
                                             }else{
                                                 echo "Code Received";
                                             }
                                             
                                             
                                             ?>
                                       </td>
                                       <td>
                                          <?php
                                             if($data1['is_purchased'] == 1){
                                                 ?>
                                          <span class="badge" style="background-color: #00B74A;">PUrchased</span>
                                          <?php
                                             }else if($data1['is_purchased'] == 0){
                                                 ?>
                                          <span class="badge" style="background-color: #F93154;" >Not Purchased</span>
                                          <?php
                                             }
                                             ?>
                                       </td>
                                      
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
                                           }
                                       }
                                       ?>
                                 </tbody>
                              </table>
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
      <!-- Datatable js-->
      <script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
      <script src="../assets/js/datatables/custom-basic.js"></script>
      <!-- lazyload js-->
      <script src="../assets/js/lazysizes.min.js"></script>
      <!--right sidebar js-->
      <script src="../assets/js/chat-menu.js"></script>
      <!--script admin-->
      <script src="../assets/js/admin-script.js"></script>
   </body>
</html>