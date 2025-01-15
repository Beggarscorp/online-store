<?php
session_start();
header('Content-Type: application/json');
include("../../config/db.php");


if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    $cart_product_count = 1;
    $cart_products = array(
        "product_id" => $productId,
        "product_count" => $cart_product_count
    );
    if (isset($_SESSION['proceed_to_checkout'])) {
        $productFound = false;
        $status = "failed";

        if((int)$_SESSION['proceed_to_checkout'][0]['product_id'] === (int)$_SESSION['proceed_to_checkout'][0]['product_id']) 
        {
            unset($_SESSION['proceed_to_checkout'][0]);
        }

        if (!$productFound) {
            $_SESSION['proceed_to_checkout'][0] = $cart_products;
            $status = "success";
        }
    } else {
        $_SESSION['proceed_to_checkout'][] = $cart_products;
        $status = "success";
    }

    $data=[];
    $id=$_SESSION['proceed_to_checkout'][0]['product_id'];
    $sql=$conn->prepare("SELECT * FROM `products` WHERE id=?");
    $sql->bind_param('i',$id);
    if($sql->execute())
    {
        $result=$sql->get_result();
        $data=$result->fetch_all(MYSQLI_ASSOC);
        array_push($data[0],$_SESSION['proceed_to_checkout'][0]['product_count']);
    }

    $_SESSION['proceed_to_checkout_data']=$data;
    echo json_encode(['status' => $status,"data"=>$_SESSION['proceed_to_checkout'][0]['product_id']]);

}

if(isset($_POST['increase_quantity']))
{

    $data=$_SESSION['proceed_to_checkout_data'][0][0]++;

    echo json_encode(['status'=>'success','data'=>$_SESSION['proceed_to_checkout_data'][0]]);
}

if(isset($_POST['decrease_quantity']))
{

    if((int)$_SESSION['proceed_to_checkout_data'][0][0] === 0)
    {
        unset($_SESSION['proceed_to_checkout_data'][0]);
    }
    else
    {
        $data=$_SESSION['proceed_to_checkout_data'][0][0]--;
    }

    echo json_encode(['status'=>'success','data'=>$_SESSION['proceed_to_checkout_data'][0]]);
}

?>