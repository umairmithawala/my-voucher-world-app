<?php
   session_start();
   require_once '../database/db-con.php';
    

?>
<?php
   if (isset($_SESSION['user_session_var'])) {
       $user_id = $_SESSION['user_session_var'];

        //getting user email values
$query1 = "SELECT `email_verification`,`phone_verification` FROM `users` WHERE `id` = $user_id";
$run_fetch1 = mysqli_query($con, $query1);
$no_of_row1 = mysqli_num_rows($run_fetch1);
if ($no_of_row1 > 0 && $run_fetch1 == true) { 
    $data1 = mysqli_fetch_assoc($run_fetch1); 
    $email_verification = $data1['email_verification'];
    $phone_verification = $data1['phone_verification'];

    if($email_verification == 0){
       ?>
<script>
      window.location = "email-verification-otp.php";
   </script>
       <?php
    }

}else{
   ?>
   <script>
      window.location = "login.php";
   </script>
   <?php
}

   }else {
?>
<script>
    window.location = "login.php";
</script>
<?php
   }
    $query1 = "SELECT * FROM `address` WHERE `user_id` = $user_id";
    $runquery1 = mysqli_query($con, $query1);
    $norows     = mysqli_num_rows($runquery1);

    if ($norows == 0) {
        ?>
        <script> 
            window.location = "create-address.php";
        </script>
        <?php
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Main css -->
    <link rel="stylesheet" href="css/stylesheet.css">

    <!-- font awesome css -->
    <link rel="stylesheet" href="css/icon.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
        require_once 'elements/header.php';
    ?>

    <div class="container-fluid margin-top-head">
        <span style="font-size: 30px;">Address</span>
    </div>

    <!-- Address Card  -->
    <?php 
        
        $query = "SELECT * FROM `address` WHERE `user_id` = $user_id";
        $runquery1 = mysqli_query($con, $query);
        $rows1     = mysqli_num_rows($runquery1);

        if ($rows1 > 0 && $runquery1 == TRUE) { 
            while ($data1 = mysqli_fetch_assoc($runquery1)) { 
                $address_lane = $data1['address_lane'];
                $city = $data1['city'];
                // $postal_code = ['postal_code'];
                ?>
    <div class="container-fluid">
        <div class="card mt-3" style="height: auto;">
            <div style="width: 100%;">
                <div style="width: 90%; float: left;">
                    <div style="margin: 10px;">
                        <p>
                            <span><?php echo  $address_lane; ?></span><br>
                            <span> <?php echo $city; ?></span><br>
                            <!-- <span> <?php echo $postal_code; ?></span> -->
                        </p>
                    </div>
                </div>
                <div style="width: 10%; float: left;">
                    <div style="float: right; margin:35px 10px;">
                        <input type="radio" name="check" id="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
        }
    ?>
    <!-- End -->
    
    <!-- Footer button -->
    <div class="container-fluid position" style="left:0;">
        <div>
            <a href="create-address.php"><button type="submit" class="btn btn-primary"
                    style="width: 100%; color: #0d6efd; background-color: #fff; border: dotted; font-weight: 550;">Add
                    Address</button></a>
            <a href="checkout.php"><button type="submit" class="btn btn-primary loginpage-btn mt-3">Continue To
                    Payment</button></a>
        </div>
    </div>
    <!-- End -->

     <!-- Jquery js -->
     <script src="js/jquery.min.js"></script>

     <!-- Goback js -->
     <script src="js/goback.js"></script>
</body>

</html>