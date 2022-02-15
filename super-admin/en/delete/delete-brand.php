<?php
   session_start();
   if (!isset($_SESSION['admin_session_var'])) {
      header("location:login.php");
   }
   ?>
<?php
   // database requrired
   require_once '../../database/db-con.php';
   ?>
<?php

if (!empty($_GET['id'])) {
    $getid = $_GET['id'];

// $sql = "DELETE FROM enquiry WHERE id=$getid";
$sql = "UPDATE `brands` SET `is_deleted`= 1 WHERE `id` = $getid";

if ($con->query($sql) === TRUE) {
  // echo "Record deleted successfully";
 
  ?>
<script>
    var a_delete = 1;
</script>
  <?php
  
} else {
  // echo "Error deleting record: " . $con->error;
  header('location:../brand-list.php');
}

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Brand</title> 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <script>
    if(a_delete == 1){
swal({
  title: "Deleted",
  text: "Brand deleted successfully",
  icon: "warning",
  button: "Done",
});
setTimeout(function(){ window.location = "../brand-list.php"; }, 2000);
}
else{
  window.location = "../brand-list.php"; 
}



  </script>
</body>
</html>
