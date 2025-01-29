<?php
include('../../config/db.php');

$product_code=$_POST['product_code'];
$product_id=$_POST['product_id'];
$msg="";

$sql="UPDATE `products` SET `product_code` = ? WHERE NOT EXISTS ( SELECT 1 FROM `products` WHERE `product_code` = ? ) AND `id`=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param('iii',$product_code,$product_code,$product_id);
if($stmt->execute() && $stmt->affected_rows>0){
    $msg="Product code updated successfully";

}else{
    $msg="Product code already exists";
}
 header('location:'.BASE_URL.'/allproduct.php?msg='.$msg);
$stmt->close();

?>