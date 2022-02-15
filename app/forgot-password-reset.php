<?php
   session_start();

   if (!isset($_SESSION['forgot_password_reset'])) {
    ?>
    <script>
    window.location = "login.php";
    </script>
    <?php

    }
   ?>
<?php require_once '../database/db-con.php'; ?>
<?php
   $alert_show = 0;
   
   $err_message = '';
   if (isset($_POST['reset_password'])) {

    $password_one = $_POST['password_one'];
    $password_one = htmlspecialchars($password_one, ENT_QUOTES, "UTF-8");
    $password_one = mysqli_real_escape_string($con, $password_one);


    $password_two = $_POST['password_two'];
    $password_two = htmlspecialchars($password_two, ENT_QUOTES, "UTF-8");
    $password_two = mysqli_real_escape_string($con, $password_two);


    if($password_one == $password_two) {

        $email = $_SESSION['forgot_password_email'];

        $query3 = "UPDATE `users` SET `password`='$password_one' WHERE `email` = '$email';";   
  
           if ($con->query($query3) === true) {


            //get the user id from this email 

            $query4 = "SELECT `id` FROM `users` WHERE `email` = '$email'";
            $run_fetch4 = mysqli_query($con, $query4);
            $no_of_row4 = mysqli_num_rows($run_fetch4);
            if ($no_of_row4 > 0 && $run_fetch4 == true) { 
               $data4 = mysqli_fetch_assoc($run_fetch4); 



            $_SESSION['user_session_var'] = $data4['id'];
            

            ?>
            <script>
               window.location = "index-1.php";
            </script>
            <?php
            
           }



    }else{
        $alert_show = 1;
        $err_message = 'Something went wrong';
    }




           
     
       
    



   

     } else {
        $alert_show = 1;
        $err_message = 'Password not matched';
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
      <title>Reset Password </title>
   </head>
   <body>
      <div class="container-fluid">
         <div class="container">
            <div class="header-loginPage">
               <p>
                  Password Reset
               </p>
            </div>
            <div id="alert_div" class="alert alert-danger" role="alert" style="display: none;">
               <span id="err_msg_span"></span>
            </div>
            <div class="loginpage-form">
               <form action="" method="POST">
               <div class="mb-3">
                     <div>
                        <label for="exampleInputEmail1" class="form-label">New Password</label>
                     </div>
                     <div style="margin-top: -5px;">
                        <input type="password" class="input-textbox" name="password_one" />
                     </div>
                  </div>

                  <div class="mb-3">
                     <div>
                        <label for="exampleInputEmail1" class="form-label">Repeat Password</label>
                     </div>
                     <div style="margin-top: -5px;">
                        <input type="password" class="input-textbox" name="password_two" />
                     </div>
                  </div>
                  
                 
                  <div class="btn-main-login" style="box-shadow: 0px 19px 15px -13px #666;">
                     <a href="index-1.php"> <button type="submit" name="reset_password" class="btn btn-primary loginpage-btn" style="height: 50px;">Reset Now</button> </a>
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