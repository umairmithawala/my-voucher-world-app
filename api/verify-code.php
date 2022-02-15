<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
require '../database/db-con.php';

$data = json_decode(file_get_contents("php://input"),true);

$vendor_api_key = $data['vendor_api_key'];
$vendor_api_secret = $data['vendor_api_secret'];

$voucher_code_1 = $data['vc_1'];
$voucher_code_2 = $data['vc_2'];
$voucher_code_3 = $data['vc_3'];
$voucher_code_4 = $data['vc_4'];
$voucher_code_5 = $data['vc_5'];
$voucher_code_6 = $data['vc_6'];
$voucher_code_7 = $data['vc_7'];
$voucher_code_8 = $data['vc_8'];
$voucher_code_9 = $data['vc_9'];
$voucher_code_10 = $data['vc_10'];

$danger_alert = 0;
$danger_alert_msg = "";


//checking for authentic vendor 


   $query1  = "SELECT * FROM `vendors` WHERE `vendor_api_key` = '$vendor_api_key' AND `vendor_api_secret` = '$vendor_api_secret'";
   $run_query1 = mysqli_query($con, $query1);
   $rows1     = mysqli_num_rows($run_query1);
           $index_one = 1;
   if ($rows1 > 0 && $run_query1 == TRUE) {
       while ($data1 = mysqli_fetch_assoc($run_query1)){
           $vendor_id = $data1['id'];
           $vendor_is_deleted = $data1['is_deleted'];

           if($vendor_is_deleted == 1){
               $danger_alert = 1;
               $danger_alert_msg = "Vendor account has been banned";
           }
       }
    }else{
        $danger_alert = 1;
        $danger_alert_msg = "Unauthentic vendor";
    }


//checking for all codes exist and owned by same user id

$voucher_code_owner = 0;
$voucher_code_owner_change = 0;
$voucher_code_not_exist = 0;
$voucher_code_type = "";



// for voucher code 1 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_1'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_1'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        // if($voucher_code_owner != $dat2['user_id']){
        //     $voucher_code_owner_change = 1;
        // }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 1  ends



// for voucher code 2 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_2'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_2'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 2  ends




// for voucher code 3 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_3'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_3'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 3  ends




// for voucher code 4 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_4'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_4'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 4  ends





// for voucher code 5 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_5'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_5'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 5  ends





// for voucher code 6 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_6'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_6'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 6  ends



// for voucher code 7 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_7'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_7'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 7  ends




// for voucher code 8 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_8'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_8'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 8  ends




// for voucher code 9 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_9'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_9'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 9  ends



// for voucher code 10 starts

//getting details from voucher code table
$query2  = "SELECT `id` FROM `voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_10'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "normal";
    }
}
//getting details from variable voucher code table
$query2  = "SELECT `id` FROM `variable_voucher_code` WHERE `is_purchased` = 1 AND `is_used` = 0 AND `voucher_code` = '$voucher_code_10'";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_id = $data2['id'];
        $voucher_code_type = "dynamic";
    }
}else{
    $voucher_code_not_exist = 1;
    $danger_alert = 1;
    $danger_alert_msg = "Voucher code not exist!";
}

//checking the owner in checkout table
if($voucher_code_not_exist == 0){
$query2  = "SELECT `user_id` FROM `checkout` WHERE `voucher_type` = '$voucher_code_type' AND `voucher_code_id` = $voucher_code_id";
$run_query2 = mysqli_query($con, $query2);
$rows2     = mysqli_num_rows($run_query2);
        $index_one = 2;
if ($rows2 > 0 && $run_query2 == TRUE) {
    while ($data2 = mysqli_fetch_assoc($run_query2)){
        $voucher_code_owner = $data2['user_id'];
        
        //uncomment this from second code validation 

        if($voucher_code_owner != $dat2['user_id']){
            $voucher_code_owner_change = 1;
            $danger_alert = 1;
            $danger_alert_msg = "Voucher owner changed";
        }

    }
}else{
    $danger_alert = 1;
    $danger_alert_msg = "Buyer not exist";
}

}


// for voucher code 10  ends

if($danger_alert == 1){
    echo json_encode(array('message'=>$danger_alert_msg,'status'=>FALSE));

}else{
    echo json_encode(array('message'=>'Verified','status'=>TRUE));
}



?>