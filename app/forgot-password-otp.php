<?php
   session_start(); ?>
<?php require_once '../database/db-con.php'; ?>
<?php
   $alert_show = 0;
   
   $err_message = '';
   if (isset($_POST['verify_otp'])) {

       $otp = $_POST['otp'];
       $otp = htmlspecialchars($otp, ENT_QUOTES, "UTF-8");
       $otp = mysqli_real_escape_string($con, $otp);


     //check if this email exist in database

     $email = $_SESSION['forgot_password_email'];

     

     $query1 = "SELECT * FROM `otp` WHERE `email` = '$email' AND `otp` = '$otp' AND `type` = 'forgot_password_email_otp';";
     $run_fetch1 = mysqli_query($con, $query1);
     $no_of_row1 = mysqli_num_rows($run_fetch1);
     if ($no_of_row1 > 0 && $run_fetch1 == true) { 
      //all exist 

      //set to reset password done
      $_SESSION['forgot_password_reset'] = 1;


           
      ?>
      <script>
         window.location = "forgot-password-reset.php";
      </script>
      <?php
      
       
    



   

     } else {
        $alert_show = 1;
        $err_message = 'Please enter valid otp';
        }




     

            
   }
  
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Main css -->
      <link rel="stylesheet" href="css/stylesheet.css" />
      <!-- Bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.css" />
      <!-- icon css -->
      <link rel="stylesheet" href="css/icon.css" />
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>OTP </title>
   </head>
   <body>
      <div class="container-fluid">
         <div class="container">
            <div class="header-loginPage">
               <p>
                  Enter OTP
               </p>
            </div>
            <div id="alert_div" class="alert alert-danger" role="alert" style="display: none;">
               <span id="err_msg_span"></span>
            </div>
            <div class="loginpage-form">
               <form action="" method="POST">
                  <div class="mb-3">
                     <div>
                        <label for="exampleInputEmail1" class="form-label">Six Digit OTP</label>
                     </div>
                     <div style="margin-top: -5px;">
                        <input type="text" class="input-textbox" name="otp" />
                     </div>
                  </div>
                  
                 
                  <div class="btn-main-login" style="box-shadow: 0px 19px 15px -13px #666;">
                     <a href="index-1.php"> <button type="submit" name="verify_otp" class="btn btn-primary loginpage-btn" style="height: 50px;">Verify</button> </a>
                  </div>
               </form>
            </div>
            <!-- <div class="lbl-text" style="text-align: center;">
               <p>Don't have an account? <a href="signup.php"> Signup </a></p>
            </div> -->
         </div>
      </div>
      <!-- jquery js -->
      <script src="js/jquery.min.js"></script>
      <!-- Goback js -->
      <script src="js/goback.js"></script>
      
      <script>
         var alert_show = <?php echo $alert_show; ?>;
         var err_message = '<?php echo $err_message; ?>';
         
         
         if(alert_show == 1) {
                 document.getElementById('alert_div').style.display = 'block';
                 document.getElementById('err_msg_span').innerHTML = err_message;
         }
      </script>
   </body>
</html>