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
      <title>Voucher List | My Voucher World Admin</title>
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
      <!-- Font Awesome-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fontawesome.css" />
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css" />
      <!-- ico-font-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css" />
      <!-- Prism css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/prism.css" />
      <!-- Chartist css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css" />
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css" />
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="../assets/css/admin.css" />
      <script src="https://kit.fontawesome.com/12af21ff9f.js" crossorigin="anonymous"></script>
   </head>
   <body>
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         <?php
            require_once '../element/header.php';
            ?>
         <!-- Page Header Ends -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php require_once("../element/sidebar.php") ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="page-header-left">
                              <h3>
                                 Voucher List
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
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">
                              <h5>Voucher Lists</h5>
                           </div>
                           <div class="card-body" style="overflow-x:auto;">
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">Id</th>
                                       <th scope="col">Name</th>
                                       <th scope="col">Price</th>
                                       <th scope="col">Description</th>
                                       <th scope="col">Rating</th>
                                       <th scope="col">Qty</th>
                                       <th scope="col">Category</th>
                                       <th scope="col">Sub Category</th>
                                       <th scope="col">Brand</th>
                                       <th scope="col">Images</th>
                                       <th scope="col" class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $query1    = "SELECT * FROM voucher WHERE `is_deleted` = 0";
                                       $run_query1 = mysqli_query($con, $query1);
                                       $rows1     = mysqli_num_rows($run_query1);
                                           $index_one = 1;
                                        if ($rows1 > 0 && $run_query1 == TRUE) { 
                                           while ($data1 = mysqli_fetch_assoc($run_query1)) { 
                                               
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
                                             echo $data1['discount_price']."₹ "."<del>".$data1['price']."₹ </del>";
                                             ?>
                                       </td>
                                       <td>
                                          <?php
                                             echo $data1['description'];
                                             ?>
                                       </td>
                                       <td>
                                          <i class="fas fa-star" style="color:#f0ad4e;"></i>
                                          <?php
                                             echo $data1['rating'];
                                             ?>
                                       </td>
                                       <td>
                                          <?php
                                             if($data1['qty'] != NULL || $data1['qty'] != ""){
                                                echo $data1['qty'];
                                             }else{
                                                echo "Not Applied";
                                             }
                                             ?>
                                       </td>
                                       <td>
                                          <?php 
                                             if($data1['category'] != NULL || $data1['category'] != ""){
                                                                                    $category_id = $data1['category'];
                                             
                                             
                                                                                             $query2 = "SELECT `name` FROM `category` WHERE `id` = $category_id";
                                                                                             $run_query2 = mysqli_query($con, $query2);
                                                                                             $rows2     = mysqli_num_rows($run_query2);
                                                                                             
                                                                                                if ($rows2 > 0 && $run_query2 == TRUE) { 
                                                                                                       while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                                                                                              
                                                                                                         echo $data2['name'];
                                                                                              
                                                                                             }
                                                                                             }
                                                                                         }else{
                                                                                             echo "Not Applied";
                                                                                          }
                                                                                             ?>
                                       </td>
                                       <td>
                                          <?php 
                                             if($data1['sub_category'] != NULL || $data1['sub_category'] != ""){
                                                                                    $sub_category_id = $data1['sub_category'];
                                             
                                             
                                                                                             $query2 = "SELECT `name` FROM `sub_category` WHERE `id` = $sub_category_id";
                                                                                             $run_query2 = mysqli_query($con, $query2);
                                                                                             $rows2     = mysqli_num_rows($run_query2);
                                                                                             
                                                                                                if ($rows2 > 0 && $run_query2 == TRUE) { 
                                                                                                       while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                                                                                              
                                                                                                         echo $data2['name'];
                                                                                              
                                                                                             }
                                                                                             }
                                                                                         }else{
                                                                                             echo "Not Applied";
                                                                                          }
                                                                                             ?>
                                       </td>
                                       <td>
                                          <?php 
                                             if($data1['brand'] != NULL || $data1['brand'] != ""){
                                                                                    $brand_id = $data1['brand'];
                                             
                                             
                                                                                             $query2 = "SELECT `name` FROM `brands` WHERE `id` = $brand_id";
                                                                                             $run_query2 = mysqli_query($con, $query2);
                                                                                             $rows2     = mysqli_num_rows($run_query2);
                                                                                             
                                                                                                if ($rows2 > 0 && $run_query2 == TRUE) { 
                                                                                                       while ($data2 = mysqli_fetch_assoc($run_query2)) { 
                                                                                              
                                                                                                         echo $data2['name'];
                                                                                              
                                                                                             }
                                                                                             }
                                                                                         }else{
                                                                                             echo "Not Applied";
                                                                                          }
                                                                                             ?>
                                       </td>
                                       <td>
                                          <img
                                             src="../assets/images/uploads/<?php
                                                echo $data1['image_one'];
                                                ?>"
                                             alt=""
                                             style="max-width: 80px;"
                                             data-bs-toggle="modal" data-original-title="test" data-bs-target="#img_modal"
                                             onclick="prepareImageModal('<?php echo $data1['image_one']; ?>')"
                                             />
                                          <img
                                             src="../assets/images/uploads/<?php
                                                echo $data1['image_two'];
                                                ?>"
                                             alt=""
                                             style="max-width: 80px;"
                                             data-bs-toggle="modal" data-original-title="test" data-bs-target="#img_modal"
                                             onclick="prepareImageModal('<?php echo $data1['image_two']; ?>')"
                                             />
                                          <img
                                             src="../assets/images/uploads/<?php
                                                echo $data1['image_three'];
                                                ?>"
                                             alt=""
                                             style="max-width: 80px;"
                                             data-bs-toggle="modal" data-original-title="test" data-bs-target="#img_modal"
                                             onclick="prepareImageModal('<?php echo $data1['image_three']; ?>')"
                                             />
                                       </td>
                                       <td class="text-center" style="min-width:100px;">
                                          <i class="fas fa-pen" ></i>
                                          &nbsp;
                                          <a href="delete/delete-voucher.php?id=<?php echo $data1['id']; ?>">
                                          <i class="fas fa-trash" style="color:#d9534f;"></i>
                                          </a>
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
            <?php
               require_once '../element/footer.php';
               ?>
            <!-- footer end-->
         </div>
      </div>
      <!-- voucher image showcasing modal -->
      <div class="modal fade" id="img_modal" tabindex="-1" role="dialog" aria-labelledby="img_modal" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title f-w-600" id="exampleModalLabel">Voucher Image View</h5>
                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body text-center">
                  <img src="" alt="" id="modal_image_src" style="max-width:100%;">
               </div>
               <div class="modal-footer">
                  <!-- <button class="btn btn-primary" type="submit" name="submit">Save</button> -->
                  <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
               </div>
            </div>
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
<script>
   function prepareImageModal(img_link){
       var get_modal_image_src = document.getElementById('modal_image_src');
   
       get_modal_image_src.src = "../assets/images/uploads/" + img_link
   }
</script>