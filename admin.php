<?php
include("./config/db.php");
// include("./config/config.php");
// product count code start from here

$sqlproductcount="SELECT COUNT(*) FROM `products`";
$sqlproductcountresult=mysqli_query($conn,$sqlproductcount);
$sqlproductcountval= mysqli_fetch_assoc($sqlproductcountresult);
$productcountvalue="";
if($sqlproductcount)
{
    $productcountvalue=$sqlproductcountval['COUNT(*)'];
}

// product count code end here

// user count code start from here

$usercount="SELECT COUNT(*) FROM `user`";
$usercountresult=mysqli_query($conn,$usercount);   
$usercountrow=mysqli_fetch_assoc($usercountresult);
$usercountvalue="";
if($usercountresult)
{
    $usercountvalue=$usercountrow["COUNT(*)"];
} 

// user count code end here

$ordercount="SELECT COUNT(*) FROM `orders`";
$order_count_result=mysqli_fetch_assoc(mysqli_query($conn,$ordercount));
$order_count_val;
if($order_count_result)
{
    $order_count_val=$order_count_result['COUNT(*)'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panle</title>
        <link rel="stylesheet" href="BackendAssets/css/admin.css">
        
        <!-- exported links start from here -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        
        <!-- exported links end from here -->
    </head>
    <body>
        <div class="main">
            <div class="container-fluid">
                <div class="row">
    <div class="col-sm-2 p-0">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-sm-10">
        <h2 class="m-3">Admin Panel</h2>
        <div class="row m-3">
            <div class="col-sm-3">
                <div class="products-box text-center">
                    <a href="/allproduct.php">
                        <h3>Products</h3>
                        <div class="productcount">
                            <?=$productcountvalue?>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="products-box text-center">
                    <a href="/allproduct.php">
                        <h3>Users</h3>
                        <div class="productcount">
                            <?=$usercountvalue?>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="products-box text-center">
                    <a href="/allproduct.php">
                        <h3>Stock</h3>
                        <div class="productcount">
                            0
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="products-box text-center">
                    <a href="/orders.php">
                        <h3>Orders</h3>
                        <div class="productcount">
                            <?=$order_count_val?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
   </div>

   <!-- <script src="<?=BASE_URL?>BackendAssets/js/newuser.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>