<?php
session_start();
header('Content-Type: application/json'); 
include("../../config/db.php");


if(isset($_POST['product_id']))
{
    $product_cart_id=intval($_POST['product_id']);
    $product_cart_quantity;

    foreach($_SESSION['cart'] as $key=>$carts_products)
    {
        if((int)$_SESSION['cart'][$key]['product_id'] === (int)$product_cart_id)
        {
            if((int)$_SESSION['cart'][$key]['product_count'] > 1)
            {
                $_SESSION['cart'][$key]['product_count']--;
                $product_cart_quantity=$_SESSION['cart'][$key]['product_count'];
                echo json_encode(['status'=>'success','quantity'=>$product_cart_quantity]);
            }
            else
            {
                unset($_SESSION['cart'][$key]);
                echo json_encode(['status'=>'success','quantity'=>0]);
            }
        }
    }



    // foreach($_SESSION['cart'] as $key=>$cart_product)
    // {
    //     if((int)$_SESSION['cart'][$key]['product_id'] === (int)$product_cart_id)
    //     {
    //         if((int)$_SESSION['cart'][$key]['product_count'] > 1)
    //         {
    //            $_SESSION['cart'][$key]['product_count']--;
    //            $product_cart_quantity=$_SESSION['cart'][$key]['product_count'];
    //            echo json_encode(['status'=>'success','quantity'=>$product_cart_quantity]);
    //         }
    //         else
    //         {
    //             unset($_SESSION['cart'][$key]);
    //             echo json_encode(['status'=>'success','quantity'=>0]);
    //         }
    //     }
    //     else
    //     {
    //         echo json_encode(['status'=>'success','quantity'=>'id not match']);

    //     }
    // }
}

if(isset($_POST['action']) && $_POST['action'] === 'fix_quantity_product_remover_from_cart')
{
    session_start();
    $id=$_POST['id'];
    $data='';
    foreach($_SESSION['cart'] as $key=>$cart)
    {
        if((int)$_SESSION['cart'][$key]['product_id'] === (int)$id)
        {
            unset($_SESSION['cart'][$key]);
            $cart_count=count($_SESSION['cart']);
        }
    }
    echo json_encode(["status"=>true,"data"=>$data,"cart_count"=>$cart_count]);
}


// if(isset($cartid))
// {
//     $sql="DELETE FROM `productscart` WHERE `cartid`=$cartid";
//     $result=mysqli_query($conn,$sql);
//     if($result)
//     {
//         if($_GET['page'] == "/checkout.php")
//         {
//             header("Location:$page?delete=true&id=$cartid");
//             exit();
//         }
//         else
//         {
//             header("Location:$page?delete=true");
//             exit();
//         }
//     }
//     else
//     {
//         if($_GET['page'] == "/checkout.php")
//         {
//             header("Location:$page?delete=false&id=$cartid");
//             exit();
//         }
//         else
//         {
//             header("Location:$page?delete=false");
//             exit();
//         }

//     }
// }

?>