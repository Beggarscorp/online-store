<?php
// order placed 1
// order shipped 2 
// order delivered 0 
function shipped_order()
{
    include '../../config/db.php';
    $order_id = $_GET['orderid'];
    $sql = "UPDATE `orders` SET `order_status`=2 WHERE `orderid`=$order_id";
    if ($conn->query($sql)) {
        
        header("Location: ".BASE_URL."orders.php?order_status=true");
        exit();
    } else {
        header("Location: ".BASE_URL."orders.php?order_status=false");
        exit();
    }
}
function delivered_order()
{
    include '../../config/db.php';
    $order_id = $_GET['orderid'];
    $sql = "UPDATE `orders` SET `order_status`=0 WHERE `orderid`=$order_id";
    if ($conn->query($sql)) {
        header("Location: ".BASE_URL."orders.php?order_status=true");
        exit();
    } else {
        header("Location: ".BASE_URL."orders.php?order_status=false");
        exit();
    }
}
if (isset($_GET['shipped'])) {
    shipped_order();
}
if (isset($_GET['delivered'])) {
    delivered_order();
}

?>
