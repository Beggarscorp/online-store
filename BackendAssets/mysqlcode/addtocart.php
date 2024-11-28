
<?php
include("../../config/db.php");
header('Content-Type: application/json');

// cart product quantity increase

if (isset($_POST['product_id'])) {
    session_start();
    $cart_product_id = intval($_POST['product_id']);
    $cart_product_count;
    foreach ($_SESSION['cart'] as $key => $cart_product) {
        if ((int)$_SESSION['cart'][$key]['product_id'] === (int)$cart_product_id) {
            $_SESSION['cart'][$key]['product_count']++;
            $cart_product_count = $_SESSION['cart'][$key]['product_count'];
        }
    }

    echo json_encode(['status' => 'success', 'quantity' => $cart_product_count]);
}

if (isset($_POST['add_to_cart_product_id']) && !empty($_POST['add_to_cart_product_id'])) {
    $productId = intval($_POST['add_to_cart_product_id']);
    $cart_product_count = 1;
    $cart_products = array(
        "product_id" => $productId,
        "product_count" => $cart_product_count
    );
    session_start();
    if (isset($_SESSION['cart'])) {
        $productFound = false;
        $status = "failed";

        foreach ($_SESSION['cart'] as $key => $pro_cart) {
            if ((int)$_SESSION['cart'][$key]['product_id'] === (int)$productId) {
                $_SESSION['cart'][$key]['product_count']++;
                $productFound = true;
                $status = "success";
                break;
            }
        }
        if (!$productFound) {
            $_SESSION['cart'][] = $cart_products;
            $status = "success";
        }
    } else {
        $_SESSION['cart'][] = $cart_products;
        $status = "success";
    }
    echo json_encode(['status' => $status]);
}

if (isset($_POST['fetch_data_form_cart'])) {

    session_start();
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $cart_product_ids = [];
        $product_data = [];
        $cart_detail=[];

        // Extract product IDs from the cart session
        foreach ($_SESSION['cart'] as $cart_product) {
            if (isset($cart_product['product_id'])) {
                $cart_product_ids[] = $cart_product['product_id'];
            }
            $cart_detail[]=$cart_product;
        }

        // Check if there are any product IDs to fetch
        if (!empty($cart_product_ids)) {
            // Create placeholders for prepared statement
            $placeholders = rtrim(str_repeat('?,', count($cart_product_ids)), ',');
            $fetch_product_sql = $conn->prepare("SELECT * FROM `products` WHERE id IN ($placeholders)");

            // Create a type string for binding (assuming product_id is an integer)
            $types = str_repeat('i', count($cart_product_ids));
            $fetch_product_sql->bind_param($types, ...$cart_product_ids); // Use the spread operator

            if ($fetch_product_sql->execute()) {
                $fetch_product_result = $fetch_product_sql->get_result();
                $product_data = $fetch_product_result->fetch_all(MYSQLI_ASSOC);
            }
        } else {
            // Handle empty cart case
            $product_data = [];
        }

        $conn->close();
    } else {
        // Handle the case where the cart session is not set
        $product_data = [];
    }

    // print_r($_SESSION['cart']);
    
    if((int)count($product_data) === (int)count($cart_detail))
    {
        $countval=(int)count($cart_detail);
        for($pc=0;$pc<$countval;$pc++)
        {
            foreach($cart_detail as $key=>$cart_val)
            {
                if((int)$cart_val['product_id'] === $product_data[$pc]['id'])
                {
                    if(isset($product_data[$pc]) || is_array($product_data[$pc]))
                    {
                        array_push($product_data[$pc],$cart_detail[$key]['product_count']);
                    }
                }
            }
        }
    }
    // print_r($product_data);
    
    echo json_encode(['status' => 'success', 'product_data' => $product_data]);
}

if (isset($_POST['get_quantity']) && $_POST['get_quantity'] != "") {
    session_start();
    $product_id = $_POST['get_quantity'];
    $quantity;
    foreach ($_SESSION['cart'] as $key => $cart_product) {
        if ((int)$_SESSION['cart'][$key]['product_id'] === (int)$product_id) {
            $quantity = $_SESSION['cart'][$key]['product_count'];
        }
    }
    // echo json_encode(['status' => 'success', 'quantity' => $quantity]);
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
