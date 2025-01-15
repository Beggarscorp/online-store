<?php
include('../../config/db.php');

if(isset($_POST['best-seller']))
{
    $product_id=$_POST['best-seller'];
    $sql=$conn->prepare("UPDATE `products` SET `best_seller` = CASE WHEN `best_seller` = 1 THEN 0 ELSE 1 END WHERE `id` =?");
    $sql->bind_param('i',$product_id);
    if($sql->execute())
    {
        echo "<script>window.location.href='".BASE_URL."allproduct'</script>";
        exit();
    }
    else
    {
        echo "<script>window.location.href='".BASE_URL."allproduct'</script>";
        exit();
    }
}


?>