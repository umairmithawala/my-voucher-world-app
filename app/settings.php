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

    $danger_alert = 0;
    $danger_alert_message = "";

    $success_alert = 0;
    $success_alert_message = "";


    if(isset($_POST['change_password'])){
        
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $repeat_password = $_POST['repeat_password'];



        

        //checking if new password and repeat password are same 
        if($new_password == $repeat_password){

              //checking for old password is it correct or not 
         
        $query1 = "SELECT `password` FROM `users` WHERE `id` = $user_id";
        $run_query1 = mysqli_query($con, $query1);
        $rows1     = mysqli_num_rows($run_query1);   
        if($rows1 > 0 && $run_query1){ 
            while($data1 = mysqli_fetch_assoc($run_query1)){
                $original_old_password = $data1['password'];
            }
         }

         
         if($original_old_password == $old_password){
            $query2 = "UPDATE `users` SET `password`='$new_password' WHERE `id` = $user_id";
            if ($con->query($query2) === true) {

                $success_alert = 1;
                $success_alert_message = "Password has been changed successfully!";
                

            }

         }else{

            $danger_alert = 1;
            $danger_alert_message = "Old password doesn't match!";

         }


             
        }else{

            $danger_alert = 1;
            $danger_alert_message = "Repeat password doesn't match!";
        }

      

        
       
    }
?>




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
      <div id="contain" style="margin-top:80px;" >
        <div class="container-fluid">
            <div class="b-head">
               <div class="b-head-right">
                  <span style="font-size:30px; font-weight:400;">
                  Settings
                  </span>
               </div>
            </div>
         </div>
         <br>
         
      <!-- End -->
      <!-- main part -->
      <form method="post" action="">
      <div class="container-fluid">


         <div class="loginpage-form" style="margin-top: 50px;">


         <div id="danger_alert_div" class="alert alert-danger" role="alert" style="display: none;">
               <span id="danger_alert_message_span"></span>
            </div>

            <div id="success_alert_div" class="alert alert-success" role="alert" style="display: none;">
               <span id="success_alert_message_span"></span>
            </div>
           
               <div class="mb-3">
                  <div>
                     <label for="exampleInputEmail1" class="form-label">Old Password</label>
                  </div>
                  <div style="margin-top: -5px;">
                     <input type="password" class="input-textbox" name="old_password" required/>
                  </div>
               </div>
               <div class="mb-3">
                  <div>
                     <label for="exampleInputEmail1" class="form-label">New Password</label>
                  </div>
                  <div style="margin-top: -5px;">
                     <input type="password" class="input-textbox" name="new_password"  required/>
                  </div>
               </div>

               <div class="mb-3">
                  <div>
                     <label for="exampleInputEmail1" class="form-label">Repeat Password</label>
                  </div>
                  <div style="margin-top: -5px;">
                     <input type="password" class="input-textbox" name="repeat_password"  required/>
                  </div>
               </div>
             
              
               
           
         </div>
      </div>
      <div class="container-fluid" style="width:100% !important; padding:0px 20px 0px 20px; margin:0px; position:fixed; bottom:0;">
                  <div class="btn-main-login" style="margin-bottom: 30px;">
                     <button type="submit" name="change_password" class="btn btn-primary loginpage-btn">Change Password</button>
                  </div>
               </div>
               </form>

                        </div>
      <!-- end -->
      <!-- Jquery js -->
      <script src="js/jquery.min.js"></script>
      <!-- Goback js -->
      <script src="js/goback.js"></script>

      <script>

        var danger_alert = "<?php echo $danger_alert; ?>";
        var danger_alert_message = "<?php echo $danger_alert_message; ?>";
        var success_alert = "<?php echo $success_alert; ?>";
        var success_alert_message = "<?php echo $success_alert_message; ?>";

          var get_danger_alert_div =  document.getElementById('danger_alert_div');
          var get_danger_alert_message_span =  document.getElementById('danger_alert_message_span');
          var get_success_alert_div =  document.getElementById('success_alert_div');
          var get_success_alert_message_span =  document.getElementById('success_alert_message_span');

          if(danger_alert == 1){
            get_danger_alert_div.style.display = 'block';
            get_danger_alert_message_span.innerHTML = danger_alert_message;


          }else if(success_alert == 1){
            get_success_alert_div.style.display = 'block';
            get_success_alert_message_span.innerHTML = success_alert_message;

          }

          
          
      </script>
   </body>
</html>