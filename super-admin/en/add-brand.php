<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<!DOCTYPE html>
<html lang="en">

<?php
require_once '../database/db-con.php';

 if (isset($_POST['submit'])) {
     $name = $_POST['name'];
     $name = htmlspecialchars($name , ENT_QUOTES, "UTF-8");
     $name = mysqli_real_escape_string($con,$name);


     
if($_FILES['upload']['name'] != '' ){
        $image_name = '';
    
        $image_name_new = $_FILES['upload']['name'];// Get the Uploaded file Name.
    
        $image_extension = pathinfo($image_name_new,PATHINFO_EXTENSION); //Get the Extension of uploded file
    
        $valid_extensions = array("png","jpg","jpeg","gif");
    
        if(in_array($image_extension, $valid_extensions)){ // check if upload file is a valid image file.
            $timestamp = time();
    
     
            $new_name_one = "brand_image".$timestamp."akc".rand().".". $image_extension;
    
            $path_one = "../assets/images/uploads/" . $new_name_one;
    
            move_uploaded_file($_FILES['upload']['tmp_name'], $path_one);
    
            $image_name =  $new_name_one;
        } else{
            // echo 'false';
        }
    }
    
    $timestamp = time();
     $query = "INSERT INTO `brands`(`id`, `name`,`image`,`timestamp`) VALUES (NULL,'$name','$image_name',$timestamp)";

     if ($con->query($query) === true) {

        //  $user_id =  mysqli_insert_id($con);

     }else{
        //  echo "Error: " . $query . "<br>" . $con->error;
    }
   }
?>



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/dashboard/favicon.png" type="image/x-icon">
    <title>Add Voucher | My Voucher World </title>

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
                                <h3>Add Brand
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
                                <h5>Add Brand </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="#" enctype= "multipart/form-data" >
                                <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label pt-0"> Brand Name</label>
                                        <input class="form-control" id="validationCustom01" type="text" required="" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="col-form-label"> Upload Brand Image </label>
                                        <input class="form-control" id="validationCustom02" type="file" required="" name="upload">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                <div class="product-buttons text-center">
                                    <button type="submit" class="btn btn-primary" name="submit">Add Brand</button>
                                    
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
