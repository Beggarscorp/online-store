<?php
require("config/config.php");
require("config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="<?=BASE_URL?>BackendAssets/css/admin.css">

    <!-- exported links start from here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- exported links end from here -->
</head>
<body>
   <div class="main w-100">
                <div class="sidebar vh-100 w-100">
                    <h3>Menu</h3>
                    <ul class="list-unstyled">
                        <li><a href="<?=BASE_URL?>shop.php" >Shop</a></li<?=BASE_URL?></li>
                        <li><a href="<?=BASE_URL?>signup.php" >Sign up</a></li>
                        <li><a href="<?=BASE_URL?>orders.php" >Orders</a></li>
                        <li><a href="<?=BASE_URL?>addProduct.php" >Add Product</a></li>
                        <li><a href="<?=BASE_URL?>add.php" >Add</a></li>
                        <li><a href="<?=BASE_URL?>allproduct.php" >All Product</a></li>
                        <li><a href="<?=BASE_URL?>login.php" >Login</a></li>
                    </ul>
                </div>
            </div>

            <script>
                    // setTimeout(() => {
                    //     const msgDiv=document.getElementsByClassName("msg");
                    //     msgDiv[0].style.display="none";
                    // }, 5000);
                document.addEventListener("DOMContentLoaded",()=>{
                    window.scrollTo(0,0);
                })
            </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>