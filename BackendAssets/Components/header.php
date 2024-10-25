

<?php
require('config/db.php');

session_start();
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_product_ids = [];
    
    // Extract product IDs from the cart session
    foreach ($_SESSION['cart'] as $cart_product) {
        if (isset($cart_product['product_id'])) {
            $cart_product_ids[] = $cart_product['product_id'];
        }
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


function get_product_quantity_by_session($product_id)
{
    foreach($_SESSION['cart'] as $key=>$cart_product)
    {
        if((int)$_SESSION['cart'][$key]['product_id'] === (int)$product_id)
        {
            return $_SESSION['cart'][$key]['product_count'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=SITE_NAME?></title>
    <link rel="stylesheet" href="BackendAssets/css/main.css">
    <link rel="icon" type="image/x-icon" href="<?=SITE_ICON?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=BASE_URL?>BackendAssets/css/<?=CURRENT_PAGE?>.css?version=<?=FILE_VERSION?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body class="roboto-regular">
    <header>
     <div class="container-fluid upper_header">
         <div class="row p-3">
             <div class="col-sm-4"></div>
             <div class="col-sm-4">
                 <div class="logo text-center">
                     <img class="w-75" src="<?=SITE_LOGO?>" alt="<?=SITE_LOGO?>">
                 </div>
            </div>
            <div class="col-sm-4 my-auto">
                <div class="icons text-light text-end icons">
                    <i class="bi bi-search" style="font-size:17px;"></i>
                    <i class="bi bi-person"></i>
                    <i class="bi bi-cart3" id="cart_icon"></i>
                </div>
            </div>
        </div>
     </div>
     <div class="header_second">
         <div class="container-fluid">
            <div class="row p-3">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <ul class="navbar_links my-auto">
                        <a href="<?=BASE_URL?>"><li>Home</li></a>
                        <a href="shop"><li>Shop</li></a>
                        <a href="about-us"><li>About us</li></a>
                        <a href="stole"><li>Stole</li></a>
                        <a href="bag"><li>Bag</li></a>
                        
                    </ul>
                </div>
                <div class="col-sm-3"></div>
            </div>
         </div>
         <div class="sidebar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 sidebar_blank_area vh-100">
                        <!-- <div class=""></div> -->
                    </div>
                    <div class="col-sm-4 sidebar_content_area vh-100 p-0">
                        <div class="">
                            <div class="continue_shopping">
                                <a href="shop">
                                    <h6>
                                        <i class="bi bi-chevron-left"></i>
                                        Continue Shopping
                                    </h6>
                                </a>
                            </div>
                            <div class="cart_content">
                                <div class="cart_heading">
                                    <h5>Your cart products</h5>
                                </div>
                                <div class="cart_products">
                                    <?php
                                    if(isset($_SESSION['cart']))
                                    {
                                        foreach($product_data as $product_row)
                                        {
                                            ?>
                                                <div class="product_cart">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <img src="<?=BASE_URL?>BackendAssets/assets/images/productImages/<?=$product_row['productimage']?>" alt="<?=$product_row['productimage']?>" class="img-thumbnail">
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <h6><?=$product_row['productname']?></h6>
                                                            <h6></h6>
                                                            <button class="plus_icon" cart_product_id="<?=$product_row['id']?>"><i class="bi bi-plus-lg"></i></button>
                                                            <span class="quantity">
                                                                <?php
                                                                echo get_product_quantity_by_session($product_row['id']);
                                                                ?>
                                                            </span>
                                                            <button class="minus_icon" cart_product_id="<?=$product_row['id']?>"><i class="bi bi-dash-lg"></i></button>
                                                            <div class="price" price="<?=$product_row['price']?>"><h6><i class="bi bi-currency-rupee"></i> <?=$product_row['price']?></h6></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <h6>Product not available in cart</h6>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="cart_footer">
                                    cart footer
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
     </div>
    </header>
