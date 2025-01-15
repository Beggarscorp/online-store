<?php
function conform_order()
{
    include '../db.php';
    $order_id = $_GET['orderid'];
    $sql = "UPDATE `orders` SET `order_status`=1 WHERE `orderid`=$order_id";
    if ($conn->query($sql)) {
        
        header("Location: /orders.php?order_status=true");
        exit();
    } else {
        header("Location: /orders.php?order_status=false");
        exit();
    }
}
function cancel_order()
{
    include '../db.php';
    $order_id = $_GET['orderid'];
    $sql = "UPDATE `orders` SET `order_status`=0 WHERE `orderid`=$order_id";
    if ($conn->query($sql)) {
        header("Location: /orders.php?order_status=true");
        exit();
    } else {
        header("Location: /orders.php?order_status=false");
        exit();
    }
}
if (isset($_GET['approve'])) {
    conform_order();
}
if (isset($_GET['cancel'])) {
    cancel_order();
}

?>
