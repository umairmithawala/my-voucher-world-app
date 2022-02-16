<?php
   session_start(); ?>
<?php require_once '../database/db-con.php'; ?>
<?php
   $alert_show = 0;
   
   $err_message = '';
   if (isset($_POST['submit'])) {

       $email = $_POST['email'];
       $email = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
       $email = mysqli_real_escape_string($con, $email);

       $password = $_POST['password'];
       $password = htmlspecialchars($password, ENT_QUOTES, "UTF-8");
       $password = mysqli_real_escape_string($con, $password);

       $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
       $run_fetch = mysqli_query($con, $query);
       $noofrow = mysqli_num_rows($run_fetch);
       //code for account ban
       if ($noofrow > 0 && $run_fetch == true) { 
          $data = mysqli_fetch_assoc($run_fetch); 
          if ($data['is_ban'] == 1) { 
             $alert_show = 1; 
             $err_message = 'Your account is banned, please contact admin!'; 
            } else { 
               $user_id = $data['id']; 
               $_SESSION['user_session_var'] = $user_id; 
               ?>
<script>
   window.location = "index-1.php";
</script>
<?php
   }
   } else {
   $alert_show = 1;
   $err_message = 'Email or password is invalid';
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
      <title>Login Page</title>
   </head>
   <body>
      <div class="container-fluid">
         <div class="container">
            <div class="header-loginPage">
               <p>
                  Login
               </p>
            </div>
            <div id="alert_div" class="alert alert-danger" role="alert" style="display: none;">
               <span id="err_msg_span"></span>
            </div>
            <div class="loginpage-form">
               <form action="" method="POST">
                  <div class="mb-3">
                     <div>
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                     </div>
                     <div style="margin-top: -5px;">
                        <input type="text" class="input-textbox" name="email" />
                     </div>
                  </div>
                  <div class="mb-3">
                     <div style="margin-top: 30px;">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                     </div>
                     <div style="margin-top: -5px;" class="d-flex justify-content-between">
                        <input type="password" id="login_password_input" class="input-textbox" id="exampleInputPassword1" name="password" />
                     </div>
                  </div>
                  <div class="mb-3">
                     <div style="margin-top: -5px;">
                        <input type="checkbox" onclick="showPassword()" />
                        <label for="exampleInputEmail1" style="margin-left: 10px;"> Show Password </label>
                       <a href="forgot-password.php"> <label class="" style="float:right !important; color:black;"> Forgot Password?</label></a>
                     </div>
                  </div>
                  <div class="btn-main-login" style="box-shadow: 0px 19px 15px -13px #666;">
                     <a href="index-1.php"> <button type="submit" name="submit" class="btn btn-primary loginpage-btn" style="height: 50px;">Log in</button> </a>
                  </div>
               </form>
            </div>
            <div class="lbl-text" style="text-align: center;">
               <p>Don't have an account? <a href="signup.php"> Signup </a></p>
            </div>
         </div>
      </div>
      <!-- jquery js -->
      <script src="js/jquery.min.js"></script>
      <!-- Goback js -->
      <script src="js/goback.js"></script>
      <script>
         var counter = 1;
         
         function showPassword() {
             var get_login_password_input = document.getElementById("login_password_input");
         
             console.log(get_login_password_input);
             if (counter % 2 == 0) {
                 get_login_password_input.type = "password";
             } else {
                 get_login_password_input.type = "text";
             }
         
             counter++;
         }
      </script>
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