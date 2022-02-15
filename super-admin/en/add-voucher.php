<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<?php
   require_once '../database/db-con.php';
   
    if (isset($_POST['add_voucher'])) {
   
      $name = $_POST['name'];
      $name = htmlspecialchars($name , ENT_QUOTES, "UTF-8");
     $name = mysqli_real_escape_string($con,$name);


     $category = $_POST['category'];
     $category = htmlspecialchars($category , ENT_QUOTES, "UTF-8");
    $category = mysqli_real_escape_string($con,$category);


    $sub_category = $_POST['sub_category'];
    $sub_category = htmlspecialchars($sub_category , ENT_QUOTES, "UTF-8");
   $sub_category = mysqli_real_escape_string($con,$sub_category);


   $brand = $_POST['brand'];
   $brand = htmlspecialchars($brand , ENT_QUOTES, "UTF-8");
  $brand = mysqli_real_escape_string($con,$brand);
   
        $price = $_POST['price'];
        $price = htmlspecialchars($price , ENT_QUOTES, "UTF-8");
        $price = mysqli_real_escape_string($con,$price);
   
        
        $discount_price = $_POST['discount_price'];
        $discount_price = htmlspecialchars($discount_price , ENT_QUOTES, "UTF-8");
        $discount_price = mysqli_real_escape_string($con,$discount_price);
    
        $description = $_POST['description'];
        $description = htmlspecialchars($description , ENT_QUOTES, "UTF-8");
        $description = mysqli_real_escape_string($con,$description);
   
        $rating = $_POST['rating'];
        $rating = htmlspecialchars($rating , ENT_QUOTES, "UTF-8");
        $rating = mysqli_real_escape_string($con,$rating);
   
        $qty = $_POST['quantity'];
        $qty = htmlspecialchars($qty , ENT_QUOTES, "UTF-8");
        $qty = mysqli_real_escape_string($con,$qty);
   
        $timestamp = time();
   
        
        $image_name1 = "";
        $image_name2 = "";
        $image_name3 = "";
   
   if($_FILES['img1']['name'] != '' ){
           $image_name = '';
       
           $image_name_new = $_FILES['img1']['name'];// Get the Uploaded file Name.
       
           $image_extension = pathinfo($image_name_new,PATHINFO_EXTENSION); //Get the Extension of uploded file
       
           $valid_extensions = array("png","jpg","jpeg","gif");
       
           if(in_array($image_extension, $valid_extensions)){ // check if upload file is a valid image file.
               $timestamp = time();
   
               $new_name_one = "brand_image".$timestamp."akc".rand().".". $image_extension;
       
               $path_one = "../assets/images/uploads/".$new_name_one;
       
               move_uploaded_file($_FILES['img1']['tmp_name'], $path_one);
       
               $image_name1 =  $new_name_one;
           } else{
               
           }
       }else{
           $image_name1 = '';
       }
       
       if($_FILES['img2']['name'] != '' ){
           $image_name = '';
       
           $image_name_new = $_FILES['img2']['name'];// Get the Uploaded file Name.
       
           $image_extension = pathinfo($image_name_new,PATHINFO_EXTENSION); //Get the Extension of uploded file
       
           $valid_extensions = array("png","jpg","jpeg","gif");
       
           if(in_array($image_extension, $valid_extensions)){ // check if upload file is a valid image file.
               $timestamp = time();
   
               $new_name_one = "brand_image".$timestamp."akc".rand().".". $image_extension;
       
               $path_one = "../assets/images/uploads/" . $new_name_one;
       
               move_uploaded_file($_FILES['img2']['tmp_name'], $path_one);
       
               $image_name2 =  $new_name_one;
           } else{
               
           }
       }else{
           $image_name2 = '';
       }
   
       if($_FILES['img3']['name'] != '' ){
           $image_name = '';
       
           $image_name_new = $_FILES['img3']['name'];// Get the Uploaded file Name.
       
           $image_extension = pathinfo($image_name_new,PATHINFO_EXTENSION); //Get the Extension of uploded file
       
           $valid_extensions = array("png","jpg","jpeg","gif");
       
           if(in_array($image_extension, $valid_extensions)){ // check if upload file is a valid image file.
               $timestamp = time();
   
               $new_name_one = "brand_image".$timestamp."akc".rand().".". $image_extension;
       
               $path_one = "../assets/images/uploads/" . $new_name_one;
       
               move_uploaded_file($_FILES['img3']['tmp_name'], $path_one);
       
               $image_name3 =  $new_name_one;
           } else{
               
           }
       }else{
           $image_name3 = '';
       }
   
   
        $query = "INSERT INTO `voucher`(`id`, `name`, `price`, `discount_price`, `description`, `rating`,`qty`,`category`,`sub_category`,`brand`,`image_one`,`image_two`,`image_three`,`timestamp`) VALUES (NULL,'$name',$price,$discount_price,'$description',$rating,$qty,$category,$sub_category,$brand,'$image_name1','$image_name2','$image_name3',$timestamp)";
   
        if ($con->query($query) === true) {
            $voucher_id =  mysqli_insert_id($con);
            ?>
<script>
   window.location = "add-voucher-code.php?id=<?php echo $voucher_id; ?>&qty=<?php echo $qty; ?>";
</script>
<?php
   }else{
        echo "Error: " . $query . "<br>" . $con->error;
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
                              <h3>Add Voucher
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
                           <h5>Add Voucher</h5>
                        </div>
                        <div class="card-body">
                           <form action="" method="POST" enctype= "multipart/form-data" >
                              <div class="digital-add needs-validation">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="validationCustom01" class="col-form-label pt-0"> Voucher Name</label>
                                          <input class="form-control" id="validationCustom01" type="text" required="" name="name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="validationCustom01" class="col-form-label pt-0"> Category</label>
                                          <select class="form-control" name="category" aria-label="Default select example" required>
                                             <?php 
                                                $query1 = "SELECT * FROM `category` WHERE `is_deleted` = 0";
                                                $run_query1 = mysqli_query($con, $query1);
                                                $rows1     = mysqli_num_rows($run_query1);
                                                
                                                   if ($rows1 > 0 && $run_query1 == TRUE) { 
                                                          while ($data1 = mysqli_fetch_assoc($run_query1)) { 
                                                              
                                                   ?>
                                             <option value="<?php echo $data1['id']; ?>"> <?php echo $data1['name']; ?> </option>
                                             <?php
                                                }
                                                }
                                                ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="validationCustom01" class="col-form-label pt-0">Sub Category</label>
                                          <select class="form-control" name="sub_category" aria-label="Default select example" required>
                                             <?php 
                                                $query1 = "SELECT * FROM `sub_category` WHERE `is_deleted` = 0";
                                                $run_query1 = mysqli_query($con, $query1);
                                                $rows1     = mysqli_num_rows($run_query1);
                                                
                                                   if ($rows1 > 0 && $run_query1 == TRUE) { 
                                                          while ($data1 = mysqli_fetch_assoc($run_query1)) { 
                                                              
                                                   ?>
                                             <option value="<?php echo $data1['id']; ?>"> <?php echo $data1['name']; ?> </option>
                                             <?php
                                                }
                                                }
                                                ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="validationCustom01" class="col-form-label pt-0"> Brand</label>
                                          <select class="form-control" name="brand" aria-label="Default select example" required>
                                             <?php 
                                                $query1 = "SELECT * FROM `brands` WHERE `is_deleted` = 0";
                                                $run_query1 = mysqli_query($con, $query1);
                                                $rows1     = mysqli_num_rows($run_query1);
                                                
                                                   if ($rows1 > 0 && $run_query1 == TRUE) { 
                                                          while ($data1 = mysqli_fetch_assoc($run_query1)) { 
                                                              
                                                   ?>
                                             <option value="<?php echo $data1['id']; ?>"> <?php echo $data1['name']; ?> </option>
                                             <?php
                                                }
                                                }
                                                ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom02" class="col-form-label"> Price</label>
                                          <input class="form-control" id="validationCustom02" type="number" required="" name="price">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom02" class="col-form-label"> Discount Price</label>
                                          <input class="form-control" id="validationCustom02" type="number" required="" name="discount_price">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label class="col-form-label"> Description </label>
                                          <textarea class="form-control" rows="3" cols="12" name="description"></textarea>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom02" class="col-form-label"> Rating </label>
                                          <input class="form-control" id="validationCustom02" type="number" required="" max="5" min="1" value="5" name="rating">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="validationCustom02" class="col-form-label"> Quantity </label>
                                          <input class="form-control" id="validationCustom02" type="number" name="quantity">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="validationCustom02" class="col-form-label"> Upload Image </label>
                                    <div class="row">
                                       <div class="col">
                                          <input class="form-control" id="validationCustom02" type="file" name="img1" required>
                                       </div>
                                       <div class="col">
                                          <input class="form-control" id="validationCustom02" type="file" name="img2">
                                       </div>
                                       <div class="col">
                                          <input class="form-control" id="validationCustom02" type="file" name="img3">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="product-buttons text-center mt-5">
                                 <button type="submit" class="btn btn-primary" name="add_voucher">Add Voucher</button>
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