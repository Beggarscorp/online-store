
<?php
include("../../config/db.php");
header('Content-Type: application/json'); 

// cart product quantity increase

if(isset($_POST['product_id']))
{
    session_start();
    $cart_product_id=intval($_POST['product_id']);
    $cart_product_count;
    foreach($_SESSION['cart'] as $key=>$cart_product)
    {
        if((int)$_SESSION['cart'][$key]['product_id'] === (int)$cart_product_id)
        {
            $_SESSION['cart'][$key]['product_count']++;
            $cart_product_count=$_SESSION['cart'][$key]['product_count'];
        }
    }

    echo json_encode(['status'=>'success','quantity'=>$cart_product_count]);
}

if(isset($_POST['add_to_cart_product_id']))
{
    $productId=intval($_POST['add_to_cart_product_id']);
    $cart_product_count=1;
    $cart_products=array(
        "product_id"=>$productId,
        "product_count"=>$cart_product_count
    );
    session_start();
    if(isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $key=>$pro_cart)
        {
            if((int)$_SESSION['cart'][$key]['product_id'] === (int)$productId)
            {
                $_SESSION['cart'][$key]['product_count']++;
                // echo json_encode(['status'=>'success']);
            }
            else
            {
                // echo "yha aa rha hai";
            }
        }
        if((int)$_SESSION['cart'][$key]['product_id'] != (int)$productId)
        {
            $_SESSION['cart'][]=$cart_products;
        }
        echo json_encode(['status'=>'success']);
    }
    else
    {
        $_SESSION['cart'][]=$cart_products;
        echo json_encode(['status'=>'success']);
    }

}


// end here


// if(isset($_SESSION['user']) && $productId != "")
// {
//     $user = $_SESSION['user'];
//     $sql="SELECT * FROM `user` WHERE `First_name` = '$user'";
//     $result = mysqli_query($conn,$sql);
//     $row = mysqli_fetch_assoc($result);
//     $user_id= $row["id"];
//     $sqlThree="SELECT * FROM `productscart` WHERE `user_id`=$user_id";
//     $resultThree = mysqli_query($conn,$sqlThree);
//     $idCheck=[];
//     foreach($resultThree as $key => $value)
//     {
//         $idCheck[]=$value["product_id"];
//     }
//     if($resultThree && in_array($productId,$idCheck) === false)
//     {
//         $sqlTwo= "INSERT INTO `productscart` (`user_id`, `product_id`) VALUES ('$user_id', '$productId')";
//         $resultTwo = mysqli_query($conn,$sqlTwo);
//         if($resultTwo)
//         {
//             if(isset($_GET['page']))
//             {
//                 header("Location: /singleProduct.php?cart=updated&id=$productId&cate=$cate");
//                 exit();
//             }
//             else
//             {
//                 header("Location: /shop.php?cart=updated");
//                 exit();
//             }
//         }
//         else
//         {
//             header("Location: /shop.php?cart=not_updated");
//             exit();
//         }   
//     }
//     else
//     {
//         if(isset($_GET['page']))
//         {
//             header("Location:/singleProduct.php?cart=added_already&id=$productId&cate=$cate");
//             exit();
//         }
//         else
//         {
//             header("Location:/shop.php?cart=added_already");
//             exit();
//         }
//     }

// }
// else
// {
//     header("Location: /login.php");
//     exit();
// }
?>
