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

if (!empty($_GET['id']) && !empty($_GET['type'])) {
    $voucher_id = $_GET['id'];
    $voucher_type = $_GET['type'];
    

 

    $timestamp = time();

    if($voucher_type == "normal" || $voucher_type == "dynamic"){


        

       
        $query = "DELETE FROM `favorite` WHERE `user_id` = $user_id AND `voucher_id` = $voucher_id AND `voucher_type` = '$voucher_type'";

    if ($con->query($query) === true) {
        ?>

        <script> 
            window.history.back();
        </script>

        <?php

    }else {
        // echo "Error: " . $query . "<br>" . $con->error;
    }

}else{
    ?>

    <script> 
        window.history.back();
    </script>

    <?php
}
    
}
    else{
        //wrong link 


 ?>

        <script> 
            window.history.back();
        </script>

        <?php



    }

   


        

        ?>

        <script> 
            window.history.back();
        </script>

        <?php

 

 

?>