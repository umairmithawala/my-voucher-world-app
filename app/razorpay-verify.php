<?php
   session_start();
      require_once '../database/db-con.php';
      ?>
      <?php

require('razorpay-config.php');



require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
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


$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);

        
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{

    

    $checkout_id = $_SESSION['checkout_id'];

    $voucher_id = $_SESSION['voucher_id'];
    $voucher_code_id = $_SESSION['voucher_code_id'];
    $voucher_type = $_SESSION['voucher_type'];

    $razorpay_order_id = $attributes['razorpay_order_id'];
    $razorpay_payment_id = $attributes['razorpay_payment_id'];
    $razorpay_signature = $attributes['razorpay_signature'];


    //deriving voucher code again with noticing someone else is already bought that podha

    $voucher_code = '';
    $voucher_code_available = 0;
    
    if($voucher_type == "normal"){
        $query2 = "SELECT `voucher_code`,`is_purchased` FROM `voucher_code` WHERE `id` = $voucher_code_id";


      }else if($voucher_type == "dynamic"){
         
        $query2 = "SELECT `voucher_code`,`is_purchased` FROM `variable_voucher_code` WHERE `id` = $voucher_code_id";

      }

      $run_query2 = mysqli_query($con, $query2);
      $rows2     = mysqli_num_rows($run_query2);
  
      if ($rows2 > 0 && $run_query2 == TRUE) { 
          while ($data2 = mysqli_fetch_assoc($run_query2)) { 
            
            if($data2['is_purchased'] == 0){
                $voucher_code_available = 1;
                $voucher_code = $data2['voucher_code'];
            }else{
                $voucher_code_available = 0;
                $voucher_code = $data2['voucher_code'];
            }
            
          }
        }

        // echo $voucher_code_available;



//update checkout table for payment complete and other things 
    $payment_timestamp = time();

    if($voucher_code_available == 1){
        $payment_complete_code_not_available = 0;
    }else{
        $payment_complete_code_not_available = 1;
    }

    $query1 = "UPDATE `checkout` SET `razorpay_order_id`='$razorpay_order_id',`razorpay_payment_id`='$razorpay_payment_id',`razorpay_signature`='$razorpay_signature',`payment_complete_code_not_available`= $payment_complete_code_not_available,`is_paid`= 1,`payment_timestamp`= $payment_timestamp WHERE `id` = $checkout_id";
    if ($con->query($query1) === true) {}

    if($voucher_code_available == 1){
        //updating the voucher code table for purchase 
    if($voucher_type == "normal"){
        $query3 = "UPDATE `voucher_code` SET `is_purchased`= 1 WHERE `id` = $voucher_code_id";


      }else if($voucher_type == "dynamic"){
         
        $query3 = "UPDATE `variable_voucher_code` SET `is_purchased`= 1 WHERE `id` = $voucher_code_id";

      }
    if ($con->query($query3) === true) {}


    //decrease qty and set code available 

    if($voucher_type == "normal"){
        $query4 = "SELECT `qty` FROM `voucher` WHERE `id` = $voucher_id";
      }else if($voucher_type == "dynamic"){         
        $query4 = "SELECT `qty` FROM `variable_voucher` WHERE `id` = $voucher_id";
      }

      $run_query4 = mysqli_query($con, $query4);
      $rows4     = mysqli_num_rows($run_query4);
  
      if ($rows4 > 0 && $run_query4 == TRUE) { 
          while ($data4 = mysqli_fetch_assoc($run_query4)) { 

            $voucher_qty = $data4['qty'];

            $voucher_qty--;

            if($voucher_qty < 0){
                $voucher_qty = 0;
            }
            
            if($voucher_qty == 0){
                $voucher_code_available = 0;                
            }
            
          }
        }

        //set qty and code availability in table 

        // echo $voucher_id;
        // echo $voucher_code_available;

        if($voucher_type == "normal"){
            $query5 = "UPDATE `voucher` SET `qty`= $voucher_qty,`codes_available`= $voucher_code_available WHERE `id` = $voucher_id";
    
    
          }else if($voucher_type == "dynamic"){
             
            $query5 = "UPDATE `variable_voucher` SET `qty`= $voucher_qty,`codes_available`= $voucher_code_available WHERE `id` = $voucher_id";
    
          }
        if ($con->query($query5) === true) {


        }
    

    }

    

    if($payment_complete_code_not_available == 0){
        //redirecting to voucher code view page
        ?>
    <script>
        window.location = "your-voucher-code.php?id=<?php echo $checkout_id; ?>";
    </script>
        <?php
    }else if($payment_complete_code_not_available == 1){
        ?>
        <script>
            window.location = "payment-done-voucher-code-not-available.php?id=<?php echo $checkout_id; ?>";
        </script>
            <?php
    }

    // $html = "<p>Your payment was successful</p>
    //          <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
    $html = "<p></p>";
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
