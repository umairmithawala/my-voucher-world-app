<?php
   session_start();
   require_once '../database/db-con.php'
   ?>
<?php
   if (isset($_SESSION['preloader_session_var'])) {
    ?>
<script>
   window.location = "index-1.php";
</script>
<?php
   }else {
      $_SESSION['preloader_session_var'] = 1;
   
   }
   ?>   
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="stylesheet" href="css/stylesheet.css" />
      <link rel="stylesheet" href="css/bootstrap.css" />
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Loader</title>
   </head>
   <body class="bg">
      <div style="height:100%; ">
         <div style="position:fixed; top:50%; margin-top:-100px; width:100%; text-align:center;">
            <img src="img/logo.png" alt="" style="height:200px;" />
         </div>
         <div style="position:fixed; top:50%; margin-top:100px; width:100%; text-align:center;">
           <span style='color:white;'>myvoucherworld.com</span>
         </div>
      </div>
   </body>
</html>
<script>
   setTimeout(function () {
     window.location = "welcome.php";
   }, 1000);
   </script>
