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
   ?>
<?php
    // Updating Profile data

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        
        $query2 = "UPDATE `users` SET `name`='$name',`phone`='$phone',`gender`='$gender' WHERE `id` = $user_id";
        if ($con->query($query2) === true) {
        }
    }
?>
<?php
   
   
   $query1 = "SELECT * FROM `users` WHERE `id` = $user_id";
   $runquery1 = mysqli_query($con, $query1);
   $rows1     = mysqli_num_rows($runquery1);
   
   if($rows1 >
   0 && $runquery1){ while($data1 = mysqli_fetch_assoc($runquery1)){ $name = $data1['name']; $email = $data1['email']; $gender = $data1['gender']; $phone = $data1['phone']; } } ?>



<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Main css -->
      <link rel="stylesheet" href="css/stylesheet.css" />
      <!-- font awesome css -->
      <link rel="stylesheet" href="css/icon.css" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.css" />
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Document</title>
   </head>
   <body>
      <?php
         require_once 'elements/header.php';
         ?>
      <!-- Headr body part-->
      <div class="container-fluid margin-top-head">
         <p style="font-size: 30px;">
            Profile
         </p>
      </div>
      <!-- End -->
      <!-- main part -->
      <div class="container-fluid">
         <div class="loginpage-form" style="margin-top: 50px;">
            <form method="post" action="">
               <div class="mb-3">
                  <div>
                     <label for="exampleInputEmail1" class="form-label">Name</label>
                  </div>
                  <div style="margin-top: -5px;">
                     <input type="text" class="input-textbox" name="name" value="<?php echo $name; ?> " />
                  </div>
               </div>
               <div class="mb-3">
                  <div>
                     <label for="exampleInputEmail1" class="form-label">Email</label>
                  </div>
                  <div style="margin-top: -5px;">
                     <input type="email" class="input-textbox" name="email" value="<?php echo $email; ?>" disabled style="background: transparent !important;" />
                  </div>
               </div>
               <div class="mb-3">
                  <div style="margin-top: 30px;">
                     <label for="exampleInputPassword1" class="form-label">Phone Number</label>
                  </div>
                  <div style="margin-top: -5px;" class="d-flex justify-content-between">
                     <input type="tel" class="input-textbox" id="exampleInputPassword1" name="phone" value="<?php echo $phone?>" />
                  </div>
               </div>
               <div class="mb-3">
                  <div style="margin-top: 30px;">
                     <label for="exampleInputPassword1" class="form-label">Gender</label>
                  </div>
                  <div style="margin-top: -5px;">
                     <label for="exampleInputPassword1" class="form-label">Male</label>
                     <input type="radio" name="gender" value="male"
                        <?php if($gender == 'male') {
                           echo 'checked';
                           } ?>>
                     <label for="exampleInputPassword1" class="form-label" style="padding-left: 30px;">Female</label>
                     <input type="radio" name="gender" value="female"
                        <?php if($gender == 'female') {
                           echo 'checked';
                           } ?>>
                  </div>
               </div>
               <div class="container-fluid">
                  <div class="btn-main-login" style="margin-bottom: 30px;">
                     <button type="submit" name="save" class="btn btn-primary loginpage-btn">Save</button>
                  </div>
               </div>
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