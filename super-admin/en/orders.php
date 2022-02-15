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
      <title>Orders List - Admin | My Voucher World</title>
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
                              <h3>Orders
                                 <small>Orders List</small>
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
                              <h5>Manage Order</h5>
                           </div>
                           <div class="card-body order-datatable" style="overflow-x:auto;">
                              <table class="display" id="basic-1">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Checkout Id</th>
                                       <th>User Id</th>
                                       <th>User Email</th>
                                       <th>Voucher Id</th>
                                       <th>Voucher Type</th>
                                       <th>Voucher Code Id</th>
                                       <th>Buy Price</th>
                                       <th>Razorpay Order Id</th>
                                       <th>Razorpay Payment Id</th>
                                       <th>Razorpay Signature</th>
                                       <th>Payment complete code not received</th>
                                       <th>Payment Status</th>
                                       <th>Payment Time</th>
                                       <th>Checkout Time</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $query1  = "SELECT * FROM `checkout`";
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
                                          <?php echo "uid_#".$data1['user_id']; ?>
                                       </td>
                                       <td>
                                          <?php
                                             $checkout_user_id = $data1['user_id'];
                                             //getting email data from user table 
                                             
                                             $query2  = "SELECT `email` FROM `users` WHERE `id` = $checkout_user_id";
                                             $run_query2 = mysqli_query($con, $query2);
                                             $rows2     = mysqli_num_rows($run_query2);
                                                     
                                             if ($rows2 > 0 && $run_query2 == TRUE) {
                                                 while ($data2 = mysqli_fetch_assoc($run_query2)){
                                             
                                                     $checkout_user_email = $data2['email'];
                                             
                                                 }
                                             }
                                             
                                             echo $checkout_user_email;
                                             
                                             
                                             
                                             ?>
                                       </td>
                                       <td>
                                          <?php echo "vid_#".$data1['voucher_id']; ?>
                                       </td>
                                       <td>
                                          <?php echo $data1['voucher_type']; ?>
                                       </td>
                                       <td>
                                          <?php echo "vcid_#".$data1['voucher_code_id']; ?>
                                       </td>
                                       <td>
                                          <?php 
                                             echo "₹".$data1['buy_price'].".00/-";
                                             ?>
                                       </td>
                                       <td>
                                          <?php 
                                             if($data1['razorpay_order_id'] != NULL && $data1['razorpay_order_id'] != ""){
                                                 echo $data1['razorpay_order_id'];
                                             }else{
                                                 echo "Not Applied";
                                             }
                                             ?>
                                       </td>
                                       <td>
                                          <?php 
                                             if($data1['razorpay_payment_id'] != NULL && $data1['razorpay_payment_id'] != ""){
                                                 echo $data1['razorpay_payment_id'];
                                             }else{
                                                 echo "Not Applied";
                                             }
                                             ?>
                                       </td>
                                       <td>
                                          <?php 
                                             if($data1['razorpay_signature'] != NULL && $data1['razorpay_signature'] != ""){
                                                 echo $data1['razorpay_signature'];
                                             }else{
                                                 echo "Not Applied";
                                             }
                                             ?>
                                       </td>
                                       <td>
                                          <?php
                                             if($data1['payment_complete_code_not_available']==1){
                                                 echo "Code Not Received";
                                             }else{
                                                 echo "Code Received";
                                             }
                                             
                                             
                                             ?>
                                       </td>
                                       <td>
                                          <?php
                                             if($data1['is_paid'] == 1){
                                                 ?>
                                          <span class="badge" style="background-color: #00B74A;">Paid</span>
                                          <?php
                                             }else if($data1['is_paid'] == 0){
                                                 ?>
                                          <span class="badge" style="background-color: #F93154;" >Not Paid</span>
                                          <?php
                                             }else if($data1['is_paid'] == 2){
                                                 ?>
                                          <span class="badge" style="background-color: #FFA900;">Refunded</span>
                                          <?php
                                             }else{
                                                 echo "Not Applied";
                                             }
                                             
                                             ?>
                                       </td>
                                       <td>
                                          <?php
                                             if($data1['payment_timestamp'] != NULL && $data1['payment_timestamp'] != ""){
                                             $mydate=getdate($data1['payment_timestamp']);
                                             echo "$mydate[mday]/$mydate[mon]/$mydate[year],";
                                             echo " "."$mydate[hours]:$mydate[minutes]";
                                             }else{
                                             echo "Not Applied";
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
                                       <td>
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