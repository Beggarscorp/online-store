<?php
include('BackendAssets/mysqlcode/allproducts.php');
include("config/db.php");

$sql = "SELECT * FROM `orders` AS o JOIN `products` AS p ON p.id=o.productid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$show_more_details = false;
?>
<link rel="stylesheet" href="BackendAssets/css/orders.css">
<div class="container-fluid" style="overflow:hidden;">
    <div class="row">
        <div class="col-sm-2 p-0">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="col-sm-10 p-2">
            <div class="content p-3 table-responsiveness">
                <h3 class="py-2 fw-bolder">Orders</h3>
                <table class="w-100 py-2">
                    <thead>
                        <tr>
                            <td>Product code</td>
                            <td>Product name</td>
                            <td>Product quantity</td>
                            <td>Date & Time</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Number</td>
                            <td>Country</td>
                            <td>State</td>
                            <td>City</td>
                            <td>Pincode</td>
                            <td>Address</td>
                            <td>Operations</td>
                            <td>Order Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($row as $order) {


                        ?>
                            <tr style="margin:20px 0;">
                                <td> <?= $order['id'] ?> </td>
                                <td> <?= $order['productname'] ?> </td>
                                <td> <?= $order['productquantity'] ?> </td>
                                <td> <?= $order['date'] ?> </td>
                                <td> <?= $order['username'] ?> </td>
                                <td> <?= $order['useremail'] ?> </td>
                                <td> <?= $order['usernumber'] ?> </td>
                                <td> <?= $order['usercountry'] ?> </td>
                                <td> <?= $order['userstate'] ?> </td>
                                <td> <?= $order['usercity'] ?> </td>
                                <td> <?= $order['userpincode'] ?> </td>
                                <td> <?= $order['useraddress'] ?> </td>
                                <td>
                                    <!-- order placed 1 -->
                                    <!-- order shipped 2 -->
                                    <!-- order delivered 0 -->
                                    <a href="BackendAssets/mysqlcode/order_status.php?shipped=true&orderid=<?= $order['orderid'] ?>">
                                        <button class="operation_approve_btn">Order placed <i class="bi bi-check-lg"></i></button>
                                    </a>
                                    <div>OR</div>
                                    <a href="BackendAssets/mysqlcode/order_status.php?delivered=true&orderid=<?= $order['orderid'] ?>">
                                        <button class="operation_cancel_btn">Order shipped <i class="bi bi-x-lg"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    if ((int)$order['order_status'] === 0) {
                                    ?>
                                        <button class="approved">Order Delivered</button>
                                    <?php
                                    } else if ((int)$order['order_status'] === 2) {
                                    ?>
                                        <button class="pending">Order Shipped <i class="bi bi-check2-circle"></i></button>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <button class="pending">Order placed <i class="bi bi-check2-circle"></i></button>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <!-- <td><button class="view_more" onclick="<?php $show_more_details = true ?>">view more <i class="bi bi-arrow-right-short"></i></button></td> -->

                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>