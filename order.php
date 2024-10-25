<?php
ob_start();
include("./BackendAssets/Components/header.php");
include("./BackendAssets/db.php");
$msg = '';

if (isset($_SESSION['user'])) {

    ob_end_flush();
    $user = $_SESSION['user'];

    $userselect = "SELECT id FROM `user` WHERE `First_name` = '$user'";

    $userselectresult = mysqli_fetch_assoc(mysqli_query($conn, $userselect));

    $userid = $userselectresult['id'];

    $sql = "SELECT o.*,p.productname,p.price,p.productimage FROM `orders` AS o JOIN `products` AS p ON p.id=o.productid AND o.userid='$userid'";

    $result = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

    if(isset($_GET['order']) && $_GET['order'] === 'successful')
    {
        echo "<script>
            Swal.fire({
                title:'Order Placed Successfully',
                text:'Order details and tracking info will be shared via email/SMS on your registered contact details',
                icon: 'success'
            })
        </script>";
    }
    else if(isset($_GET['order']) && $_GET['order'] === 'failed')
    {
        echo "<script>
            Swal.fire({
                title:'Order Failed',
                icon: 'error'
            })
        </script>";
    }
    else if(isset($_GET['delete']) && $_GET['delete'] === 'successfully')
    {
        echo "<script>
            Swal.fire({
                title:'Order Deleted',
                icon: 'success'
            })
        </script>";
    }


?>
    <link rel="stylesheet" href="BackendAssets/css/order.css">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 my-5">
                    <h2>Ordered <span class="golden">Products</span></h2>
                    <?php
                    $sno = 1;
                    ?>
                        <?php
                        if($result)
                        {
                            foreach($result as $orders)
                            {
                                // print_r($orders);
                                ?>

                                    <div class="order_product_main_div">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="imagetd"> <img src="BackendAssets/assets/images/ProductImages/<?= $orders['productimage'] ?>" alt="<?= $orders['productimage'] ?>"> </div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="product_inner_div">
                                                    <a href="BackendAssets/mysqlcode/cancelorder.php?id=<?= $orders['orderid'] ?>&pa=<?=$_SERVER['PHP_SELF']?>">
                                                        <div class="cancel_order_icon"><i class="fa fa-close" style="font-size:15px"></i></div>
                                                    </a>
                                                    <div>
                                                        <h3>Product Name :</h3>
                                                        <p class="change_text_format"><?= $orders['productname'] ?></p>
                                                    </div>
                                                    <div>
                                                        <h3>Qty :</h3>
                                                        <p class="change_text_format"><?= $orders['productquantity'] ?></p>
                                                    </div>
                                                    <div>
                                                        <h3>Price :</h3>
                                                        <p class="change_text_format">INR  <?= $orders['price'] ?></p>
                                                    </div>
                                                    <div class="product_total_price_amt">
                                                        <h3>Total Price :</h3>
                                                        <p class="change_text_format">INR <?= $orders['productquantity'] * $orders['price'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                            }
                            ?>
                            <div class="grand_total_div">
                                <div class="row">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-4">
                                        <div class="row" style="border-bottom:1px solid;">
                                            <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                                                <h4>Grand Total Price</h4>
                                            </div>
                                            <div class="col-md-6 col-sm-4 col-xs-6 col-6">
                                                <h5 id="grand_total" class="change_text_format">-</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        else
                        {
                            echo "<h1>No Order <span class='golden'>Available</span></h1>";
                        }
                        ?>
            </div>
        </div>
    </div>




<?php
    include("./BackendAssets/Components/footer.php");
} else {
    $msg = "You are not logged in";
    header("Location: /login.php?msg=" . urlencode($msg));
    exit();
}
?>
<script>

    const product_total_price_amt=document.querySelectorAll(".product_total_price_amt p");
    const grand_total=document.getElementById("grand_total");
    let grand_total_price_array=[];
    let grand_total_price;
    for($i=0;$i<product_total_price_amt.length;$i++)
    {
        grand_total_price_array.push(parseInt(product_total_price_amt[$i].innerText.replace("INR","").trim(),10));
    }
    grand_total_price="INR  "+ grand_total_price_array.reduce((a,c)=> a + c,0);
    grand_total.innerText=grand_total_price;
</script>