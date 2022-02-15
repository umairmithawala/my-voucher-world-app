<?php
   session_start(); ?>
<?php require_once '../database/db-con.php'; ?>
<?php
   $alert_show = 0;
   
   $err_message = '';
   if (isset($_POST['send_otp'])) {

       $email = $_POST['email'];
       $email = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
       $email = mysqli_real_escape_string($con, $email);


     //check if this email exist in database

     $query1 = "SELECT * FROM `users` WHERE `email` = '$email'";
     $run_fetch1 = mysqli_query($con, $query1);
     $no_of_row1 = mysqli_num_rows($run_fetch1);
     if ($no_of_row1 > 0 && $run_fetch1 == true) { 
      //email exist

      //if otp database have same email then delete older entries 

       
      $query2 = "DELETE FROM `otp` WHERE `email` = '$email' AND `type` = 'forgot_password_email_otp'";
      if ($con->query($query2) === TRUE) {

      }

      //create new otp in database 

      $six_digit_random_number = random_int(100000, 999999);


      //insert new otp in otp tablet
      $timestamp = time();

      $query3 = "INSERT INTO `otp`(`id`, `email`, `type`, `otp`, `timestamp`) 
      VALUES (NULL,'$email','forgot_password_email_otp','$six_digit_random_number',$timestamp)";   

         if ($con->query($query3) === true) {
            $_SESSION['forgot_password_email'] = $email; 


      //send mail 
      
      // mail logic
            

            // Multiple recipients
            $to = $email; // note the comma
            // Subject
            $subject = 'Forgot Password OTP';

            // Message
            $message = '<!DOCTYPE html>
            <html lang="en">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta
                  name="description"
                  content="Xolo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities."
                />
                <meta
                  name="keywords"
                  content="admin template, Xolo admin template, dashboard template, flat admin template, responsive admin template, web app"
                />
                <meta name="author" content="pixelstrap" />
                <link
                  rel="icon"
                  href="http://laravel.pixelstrap.com/xolo/assets/images/favicon.png"
                  type="image/x-icon"
                />
                <link
                  rel="shortcut icon"
                  href="http://laravel.pixelstrap.com/xolo/assets/images/favicon.png"
                  type="image/x-icon"
                />
                <title>THS Mining</title>
                <link
                  href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900"
                  rel="stylesheet"
                />
                <link
                  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                  rel="stylesheet"
                />
                <link
                  href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
                  rel="stylesheet"
                />
                <style type="text/css">
                  body {
                    width: 650px;
                    font-family: work-Sans, sans-serif;
                    background-color: #f6f7fb;
                    display: block;
                  }
                  a {
                    text-decoration: none;
                  }
                  span {
                    font-size: 14px;
                  }
                  p {
                    font-size: 13px;
                    line-height: 1.7;
                    letter-spacing: 0.7px;
                    margin-top: 0;
                  }
                  .text-center {
                    text-align: center;
                  }
                </style>
              </head>
              <body style="margin: 30px auto">
                <table style="width: 100%">
                  <tbody>
                    <tr>
                      <td>
                        <table style="background-color: #f6f7fb; width: 100%">
                          <tbody>
                            <tr>
                              <td>
                                <table
                                  style="width: 650px; margin: 0 auto; margin-bottom: 30px; margin-top:30px;"
                                >
                                  <tbody>
                                    <tr>
                                      <td>
                                        <img
                                          src="http://myvoucherworld.com/app/img/logo.png"
                                          alt=""
                                        />
                                      </td>
                                      <td style="text-align: right; color: #999">
                                        
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table
                                  style="
                                    width: 650px;
                                    margin: 0 auto;
                                    background-color: #fff;
                                    border-radius: 8px;
                                  "
                                >
                                  <tbody>
                                    <tr>
                                      <td style="padding: 30px">
                                        <p>Hi There,</p>
                                        <p>
                                        We got a request to change your password.
                                          </p>
                                          <p style="font-size:30px;">
                                           '.$six_digit_random_number.'
                                          </p>
                                        
                                        <p>
                                             Use this OTP to restore your password.
                                        </p>
                                        <p style="margin-bottom: 0">
                                          Good luck! Hope it works.
                                        </p>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table
                                  style="width: 650px; margin: 0 auto; margin-top: 30px"
                                >
                                  <tbody>
                                    <tr style="text-align: center">
                                      <td>
                                        <p style="color: #999; margin-bottom: 0">
                                            THS Mining LTD 
                                            20-22 WENLOCK ROAD
                                            LONDON 
                                            N1 7GU
                                        </p>
                                        <p style="color: #999; margin-bottom: 0">
                                          Dont Like These Emails?<a
                                            href="#"
                                            style="color: #655af3"
                                            >Unsubscribe</a
                                          >
                                        </p>
                                        
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </body>
            </html>';

            // To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // Additional headers
            $headers[] = 'From: My Voucher World Official <no-reply@myvoucherworld.com>';

            // Mail it
            $mailto = mail($to, $subject, $message, implode("\r\n", $headers));

            if($mailto){

               // echo "<script>var email_resend_alert = 1;</script>";
               //      echo "mail sent";

               
               ?>
<script>
   window.location = "forgot-password-otp.php";
</script>
<?php

            }

            // mail logic ends

            
         }

         


   

     }else {
      $alert_show = 1;
      $err_message = 'Email is invalid';
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
      <title>Forgot Password </title>
   </head>
   <body>
      <div class="container-fluid">
         <div class="container">
            <div class="header-loginPage">
               <p>
                  Forgot Password 
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
                  
                 
                  <div class="btn-main-login" style="box-shadow: 0px 19px 15px -13px #666;">
                     <a href="index-1.php"> <button type="submit" name="send_otp" class="btn btn-primary loginpage-btn" style="height: 50px;">Send OTP</button> </a>
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
         var alert_show = <?php echo $alert_show; ?>;
         var err_message = '<?php echo $err_message; ?>';
         
         
         if(alert_show == 1) {
                 document.getElementById('alert_div').style.display = 'block';
                 document.getElementById('err_msg_span').innerHTML = err_message;
         }
      </script>
   </body>
</html>