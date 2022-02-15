<?php
   session_start();
   require_once '../database/db-con.php'
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
?>

<?php 

   if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $address_lane = $_POST['address_lane'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $phone = $_POST['phone'];

        $query = "INSERT INTO `address`(`id`,`user_id`,`name`, `address_lane`, `city`, `postal_code`, `phone`) VALUES (NULL,$user_id,'$name','$address_lane','$city',$postal_code,$phone)";

        if ($con->query($query) === true) {

            ?>

            <script> 
                window.location = "checkout.php";
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

    <!-- Headr body part-->
    <div class="container-fluid margin-top-head">
        <span style="font-size: 30px;">
            Create Address
        </span>
    </div>
    <!-- End -->

    <!-- main part -->
    <div class="container-fluid">
        <div class="loginpage-form" style="margin-top: 50px;">
            <form method="POST">  
                <div class="mb-3">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                    </div>
                    <div style="margin-top: -5px;">
                        <input type="text" class="input-textbox" name="name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Address lane</label>
                    </div>
                    <div style="margin-top: -5px;">
                        <input type="text" class="input-textbox" name="address_lane" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div style="margin-top: 30px;">
                        <label for="exampleInputPassword1" class="form-label">City</label>
                    </div>
                    <div style="margin-top: -5px;" class="d-flex justify-content-between">
                        <input type="text" class="input-textbox" id="exampleInputPassword1" name="city" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div style="margin-top: 30px;">
                        <label for="exampleInputPassword1" class="form-label">Postal Code</label>
                    </div>
                    <div style="margin-top: -5px;" class="d-flex justify-content-between">
                        <input type="text" class="input-textbox" id="exampleInputPassword1" name="postal_code" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div style="margin-top: 30px;">
                        <label for="exampleInputPassword1" class="form-label">Phone Number</label>
                    </div>
                    <div style="margin-top: -5px;" class="d-flex justify-content-between">
                        <input type="tel" class="input-textbox" id="exampleInputPassword1" name="phone" required>
                    </div>
                </div>
                <!-- Footer button -->
                <div class="container-fluid">
                    <div style="margin-top: 100px; margin-bottom: 20px;">
                       <button type="submit" class="btn btn-primary loginpage-btn mt-3" name="submit">Submit</button>
                    </div>
                </div>
        <!-- End -->
            </form>
        </div>
    </div>
    <!-- end -->



    <!-- Jquery js -->
    <script src="js/jquery.min.js"></script>

    <!-- Goback js -->
    <script src="js/goback.js"></script>
    
</body>

</html>