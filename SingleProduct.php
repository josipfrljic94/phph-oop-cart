<!-- header -->
<?php require_once "includes/_Header.php" ?>


<!-- include -->
<?php require_once "action.php" ?>

    <!-- Nav Bar -->
    <?php require_once "includes/_Navbar.php"?>

<!-- end navbar -->

<div class="container-fluid">
<div class="row">
  <div class="col-lg-10 ml-auto" id="session-box" style="height:20vh">
   
  </div>
</div>
    <div class="row px-5" id="guitar-row">

    <!-- Get PRODUCT BY ID
 -->
 
<?php 

if(isset($_GET['id'])){
  $id= $_GET['id'];
  getProduct($id);
}
?>
 
<!-- END PRODUCT -->


    </div>
</div>

<script src="addcart.js"></script>
<?php require_once "includes/_Footer.php"  ?>

