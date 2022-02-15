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
        <title>Brand List | My Voucher World  </title>

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
                                            Brands List
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
                                        <h5>Brand Lists</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Brand Name</th>
                                                    <th scope="col">Brand Image</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query1    = "SELECT * FROM brands WHERE `is_deleted` = 0";    
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
                                                        <img
                                                            src="../assets/images/uploads/<?php
                                                    echo $data1['image'];
                                                    ?>"
                                                            alt=""
                                                            style="max-width: 100px;"
                                                            
                                                        />
                                                    </td>

                                                    <td class="text-center" style="min-width:100px;">
                                    <i class="fas fa-pen" ></i>
                                    &nbsp;
                                    <a href="delete/delete-brand.php?id=<?php echo $data1['id']; ?>">
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
