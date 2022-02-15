<?php
//database include 
require_once '../../database/db-con.php';
?>

<?php

//generate current timestamp 
$current_timestamp = time();

//deduct 48 hours seconds 

$forty_eight_hour_past = $current_timestamp - (86400 * 2);


    //get data for more then 48 seconds 
    $query1 = "SELECT `id` FROM `otp` WHERE `timestamp` < $forty_eight_hour_past";
     $run_fetch1 = mysqli_query($con, $query1);
     $no_of_row1 = mysqli_num_rows($run_fetch1);
     if ($no_of_row1 > 0 && $run_fetch1 == true) { 

        $data1 = mysqli_fetch_assoc($run_fetch1); 

        

        //delete data
        $otp_data_id = $data1['id'];

        $query2 = "DELETE FROM `otp` WHERE `id` = $otp_data_id";
      if ($con->query($query2) === TRUE) {

      }


        
     }


?>