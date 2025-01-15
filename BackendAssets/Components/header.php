<?php
session_start();
// session_set_cookie_params([
//     'lifetime' => 0,  // Browser session
//     'path' => '/',    // Available across entire website
//     'domain' => 'https://shop.beggarscorporation.com/',  // Your exact domain name
//     'secure' => true, // Use HTTPS
//     'httponly' => true // Prevent JavaScript access
// ]);
require('config/db.php');
$categories;
$fetch_category = $conn->prepare("SELECT * FROM `category`");
if ($fetch_category->execute()) {
    $fetch_category_result = $fetch_category->get_result();
    $categories = $fetch_category_result->fetch_all(MYSQLI_ASSOC);
    $fetch_category->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>BackendAssets/css/main.css?version=<?= FILE_VERSION ?>">
    <link rel="icon" type="image/x-icon" href="<?= SITE_ICON ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css?version=<?= FILE_VERSION ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css?version=<?= FILE_VERSION ?>" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>BackendAssets/css/<?= CURRENT_PAGE ?>.css?version=<?= FILE_VERSION ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js?version=<?= FILE_VERSION ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11?version=<?= FILE_VERSION ?>"></script>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css?version=<?= FILE_VERSION ?>" />
    

</head>
<?php

include("login_logout_msg.php");
?>

<body class="roboto-regular">
    <div class="header_sticky">
        
    <div class="header_for_desktop">
        <header>
            <div class="base_url_define" base_url="<?= BASE_URL ?>"></div>
            <div class="container-fluid upper_header">
                <div class="row p-3">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <div class="logo text-center">
                            <a href="<?=BASE_URL?>">
                                <img class="w-75" src="<?= SITE_LOGO ?>" alt="<?= BASE_URL ?>BackendAssets/assets/images/logos/header-logo3.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 my-auto">
                        <div class="icons text-light text-end">
                            <i class="bi bi-search" id="filter_icon" style="font-size:17px;"></i>
                            <i class="bi bi-person-circle" id="user_icon"></i>
                            <i class="bi bi-cart3" id="cart_icon"></i>
                            <span class="cart_count">0</span>
                            <div class="dashboard_show">
                                <div class="dashboard_show_head">
                                    <h5><?= isset($_SESSION['user']) ? "Welcome " . $_SESSION['user'] . "," : "User Menu" ?></h5>
                                    <h5><i class="bi bi-x" id="hide_dashboard"></i></h5>
                                </div>
                                <div class="dashboard_show_body text-light">
                                    <ol>
                                        <li>
                                            <a href="<?=BASE_URL?>dashboard">Dashboard</a>
                                        </li>
                                        <li id="address">Address 1 <i class="bi bi-check2-circle" style="font-size:15px;"></i></li>
                                        <select name="select_address" id="select_address">
                                            <option value="">Select Address</option>
                                            <option value="1">Address 1</option>
                                            <option value="2">Address 2</option>
                                            <option value="3">Address 3</option>
                                        </select>
                                        <li><a href="<?=BASE_URL?>dashboard">Orders</a></li>
                                        <li><a href="<?=BASE_URL?>dashboard">Cart</a></li>
                                        <?php
                                        if (isset($_SESSION['user'])) {
                                        ?>
                                            <li><a href="<?= BASE_URL ?>logout">Logout</a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a href="<?= BASE_URL ?>login">Login</a></li>
                                            <li><a href="<?= BASE_URL ?>signup">Sign up</a></li>
                                        <?php
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <select name="filter_text" class="filter_element">
                            <option>Filter by category</option>
                            <?php
                            foreach ($categories as $category) {
                            ?>
                                <option value="<?= $category['category-slug'] ?>"><?= $category['category'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="header_second">
                <div class="container-fluid">
                    <div class="row p-3">
                        <div class="col-sm-12">
                            <ul class="navbar_links my-auto">
                                <li><a href="<?= BASE_URL ?>">Home</a></li>
                                <li><a href="<?= BASE_URL ?>shop">Don't Donate, Purchase</a></li>
                                <li><a href="<?= BASE_URL ?>shop/bagful-of-dreams">Bagful of Dreams</a></li>
                                <li><a href="<?= BASE_URL ?>shop/enchanted-shirt">Enchanted Shirt</a></li>
                                <li><a href="<?= BASE_URL ?>shop/home-and-decor">Home & Decor</a></li>
                                <li><a href="<?= BASE_URL ?>poonya">Poonya</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    
        <!--sidebar code start from here-->
    <div class="sidebar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 col-2 sidebar_blank_area vh-100">
                                <!-- <div class=""></div> -->
                            </div>
                            <div class="col-sm-4 col-10 sidebar_content_area vh-100 p-0">
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
    
                                        </div>
                                        <div class="cart_footer">
                                            <div class="price_ele">
                                                <h6>Total Price :</h6>
                                                <h6 class="total_price">0</h6>
                                            </div>
                                            <div>
                                                <a href="<?= BASE_URL ?>checkout" target="_blank" rel="noopener noreferrer">
                                                    <button class="proceed_to_checkout">Proceed to Checkout</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--end here-->
                

    <div class="header_for_mobile">
        <?php
        include("./BackendAssets/Components/mobile_header.php");
        ?>
    </div>
    </div>
    