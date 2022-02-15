<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <?php require_once '../database/db-con.php';
      if (isset($_POST['submit'])) {
      
          $sub_cat_name = $_POST['sub_cat_name']; 
          $sub_cat_name = htmlspecialchars($sub_cat_name , ENT_QUOTES, "UTF-8");
      $sub_cat_name = mysqli_real_escape_string($con,$sub_cat_name);
      
      
          $category = $_POST['category'];
      
          $timestamp = time();
      
              $query = "INSERT INTO `sub_category`(`id`, `sub_category`, `category`,`timestamp`) VALUES (NULL,'$sub_cat_name',$category,$timestamp)";
      
          if ($con->query($query) === true) {
             
          }else{
          //  echo "Error: " . $query . "<br>" . $con->error;
          }
          
      }
      
      ?>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
      <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app" />
      <meta name="author" content="pixelstrap" />
      <link rel="icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon" />
      <link rel="shortcut icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon" />
      <title>Sub Category | My Voucher World</title>
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
      <script src="https://kit.fontawesome.com/12af21ff9f.js" crossorigin="anonymous"></script>
   </head>
   <body>
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         <?php 
            require_once('../element/header.php') 
            ?>
         <!-- Page Header Ends -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php
               require_once('../element/sidebar.php') 
               ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="page-header-left">
                              <h3>
                                 Sub Category
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
                              <h5>Sub Category</h5>
                           </div>
                           <div class="card-body">
                              <div class="btn-popup pull-right">
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add Sub Category</button>
                                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Sub Category</h5>
                                             <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                          </div>
                                          <div class="modal-body">
                                             <form method="POST" action="#" class="needs-validation">
                                                <div class="form">
                                                   <div class="form-group">
                                                      <label for="validationCustom01" class="mb-1">Sub Category Name</label>
                                                      <input class="form-control" id="validationCustom01" type="text" name="sub_cat_name" />
                                                   </div>
                                                   <div class="form-group">
                                                      <label for="validationCustom01" class="mb-1"> Category Name</label>
                                                      <select name="category" id="" style="width: 100%; border: 1px solid #ced4da; padding: 10px;border-radius: 5px;">
                                                         <option value=""> Choose here </option>
                                                         <?php 
                                                            $query1    = "SELECT * FROM `category` WHERE `is_deleted` = 0";
                                                            $runquery1 = mysqli_query($con, $query1);
                                                            $rows1     = mysqli_num_rows($runquery1);
                                                            
                                                            if ($rows1 > 0 && $runquery1 == TRUE) {
                                                               while ($data1 = mysqli_fetch_assoc($runquery1)) {
                                                                   $sub_category_name = $data1['name'];
                                                                   ?>
                                                         <option value="<?php echo $data1['id'] ?> " > <?php echo $sub_category_name ?> </option>
                                                         <?php    
                                                            }
                                                            }
                                                            ?>
                                                      </select>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button class="btn btn-primary" type="submit" name="submit"> Add </button>
                                                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- <div id="basicScenario" class="product-physical"></div> -->
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">Name</th>
                                       <th scope="col">Parent Category</th>
                                       <th scope="col" class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $query_view_table = "SELECT * FROM `sub_category` WHERE `is_deleted` = 0";
                                       $runquery1 = mysqli_query($con, $query_view_table);
                                       $rows1     = mysqli_num_rows($runquery1);
                                       $index_one = 1;
                                       if ($rows1 > 0 && $runquery1 == TRUE) {
                                           while ($data1 = mysqli_fetch_assoc($runquery1)) {
                                               $sub_category_id = $data1['id'];
                                               $sub_category_name = $data1['name'];
                                               $category = $data1['category'];
                                       
                                               //connecting to category table to fetch category name 
                                               $query2 = "SELECT * FROM `category` WHERE `id` = $category";
                                       $runquery2 = mysqli_query($con, $query2);
                                       $rows2     = mysqli_num_rows($runquery2);
                                       
                                       if ($rows2 > 0 && $runquery2 == TRUE) {
                                           while ($data2 = mysqli_fetch_assoc($runquery2)) {
                                               $category_name = $data2['name'];
                                           }
                                       }else{
                                           $category_name = "Not Applied";
                                       }
                                               ?>
                                    <tr>
                                       <td>
                                          <?php echo $index_one; ?>
                                       </td>
                                       <td>
                                          <?php echo $sub_category_name;?>
                                       </td>
                                       <td>
                                          <?php echo $category_name;?>
                                       </td>
                                       </td>
                                       <td class="text-center" style="min-width:100px;">
                                          <i class="fas fa-pen" ></i>
                                          &nbsp;
                                          <a href="delete/delete-sub-category.php?id=<?php echo $data1['id']; ?>">
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
      <!-- Jsgrid js-->
      <script src="../assets/js/jsgrid/jsgrid.min.js"></script>
      <script src="../assets/js/jsgrid/griddata-digital-sub.js"></script>
      <script src="../assets/js/jsgrid/jsgrid-digital-sub.js"></script>
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