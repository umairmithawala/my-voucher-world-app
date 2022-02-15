<style>
   body {
   font-family: "Lato", sans-serif;
   }
   .sidebar {
   height: 100%;
   width: 0;
   position: fixed;
   z-index: 6;
   top: 0;
   left: 0;
   background-color: #fff;
   overflow-x: hidden;
   transition: 0.5s;
   padding-top: 100px;
   /* padding-left : 50px; */
   }
   .sidebar a {
   padding: 20px 20px;
   text-decoration: none;
   color: #818181;
   display: block;
   transition: 0.3s;
   }
   .sidebar a:hover {
   color: #f1f1f1;
   }
   .sidebar .closebtn {
   position: absolute;
   top: 0;
   right: 25px;
   font-size: 36px;
   margin-left: 50px;
   }
   .openbtn {
   font-size: 20px;
   cursor: pointer;
   background-color: #111;
   color: white;
   padding: 10px 15px;
   border: none;
   }
   .openbtn:hover {
   background-color: #444;
   }
   /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
   @media screen and (max-height: 450px) {
   .sidebar {padding-top: 15px;}
   .sidebar a {font-size: 18px;}
   }
</style>
<!-- Collepse Sidebar -->
<div id="mySidebar" class="sidebar" style="font-weight:500; box-shadow: 0px 1px 15px #d3d3d3;" >
   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
   <a href="index-1.php">Home</a>
   <a href="profile.php">Profile</a>
   <!-- <a href="cart.php">My Cart</a> -->
   <a href="favorite.php">Favorite</a>
   <a href="my-vouchers.php">My Vouchers</a>
   <a href="order-history.php">Order History</a>   
   <!-- <a href="#">Language</a> -->
   <a href="settings.php">Settings</a>
   <a href="logout.php">Logout</a>
</div>
<!-- End -->
<!-- Navbar -->
<div class="container-fluid pos" >
   <div class="row" >
      <div class="col">
         <i class="fas fa-bars " id="sidebar_open_btn"   onclick="openNav()" style="font-size:20px;"></i>
         <i class="fas fa-times" id="sidebar_close_btn" onclick="closeNav()" style="font-size:20px; display:none;" ></i>
      </div>
      <div class="col text-center" style="font-weight:600;">myvoucherworld.com</div>
      <div class="col">
         <div style="float: right; white-space: nowrap; overflow: hidden;">
            <a href="index-1.php"> <i class="fas fa-search text-dark" style="font-size:20px; padding: 0px 15px;"></i></a>
            <a href="favorite.php">  <i class="fas fa-heart" style="color:#FF0000; font-size:20px;"></i></a>
         </div>
      </div>
   </div>
</div>
<!-- End -->
<!-- Collepse Js -->
<script>
   function openNav() {
     document.getElementById("mySidebar").style.width = "250px";
     document.getElementById("sidebar_open_btn").style.display = "none";
     document.getElementById("sidebar_close_btn").style.display = "block";
   }
   
   function closeNav() {
     document.getElementById("mySidebar").style.width = "0";
     document.getElementById("sidebar_open_btn").style.display = "block";
     document.getElementById("sidebar_close_btn").style.display = "none";
   }
   
   function goBack() {
     window.history.back();
   }
   
</script>
<!-- End -->