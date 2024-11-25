<?php
require('config/db.php');
$categories;
$fetch_category = $conn->prepare("SELECT * FROM `category`");
if ($fetch_category->execute()) {
    $fetch_category_result = $fetch_category->get_result();
    $categories = $fetch_category_result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>BackendAssets/css/main.css">
    <link rel="icon" type="image/x-icon" href="<?= SITE_ICON ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>BackendAssets/css/<?= CURRENT_PAGE ?>.css?version=<?= FILE_VERSION ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    

</head>
<?php

include("login_logout_msg.php");
?>

<body class="roboto-regular">
    <header>
        <div class="base_url_define" base_url="<?= BASE_URL ?>"></div>
        <div class="mobile_header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo text-center">
                            <img class="w-75" src="<?= SITE_LOGO ?>" alt="<?= BASE_URL ?>BackendAssets/assets/images/logos/header-logo3.png">
                        </div>
                    </div>
                </div>
                <div class="row border border-top py-1">
                    <div class="col-6">
                        <div class="menu_icon mobile_menu_icon">
                            <span class="first_line menu_line"></span>
                            <span class="middle_line menu_line"></span>
                            <span class="last_line menu_line"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="icons text-light text-end">
                            <i class="bi bi-search" id="filter_icon"></i>
                            <i class="bi bi-person-circle" id="user_icon_mobile"></i>
                            <i class="bi bi-cart3" id="cart_icon_mobile"></i>
                            <span class="cart_count">0</span>
                            <div class="dashboard_show">
                                <div class="dashboard_show_head">
                                    <h5><?= isset($_SESSION['user']) ? "Welcome " . $_SESSION['user'] . "," : "User Menu" ?></h5>
                                    <h5><i class="bi bi-x" id="hide_dashboard_mobile"></i></h5>
                                </div>
                                <div class="dashboard_show_body">
                                    <ol>
                                        <li>
                                            <a href="<?=BASE_URL?>Dashboard">Dashboard</a>
                                        </li>
                                        <li id="address">Address 1 <i class="bi bi-check2-circle" style="font-size:15px;"></i></li>
                                        <select name="select_address" id="select_address">
                                            <option value="">Select Address</option>
                                            <option value="1">Address 1</option>
                                            <option value="2">Address 2</option>
                                            <option value="3">Address 3</option>
                                        </select>
                                        <li>Orders</li>
                                        <li>Cart</li>
                                        <?php
                                        if (isset($_SESSION['user'])) {
                                        ?>
                                            <li><a href="<?= BASE_URL ?>/BackendAssets/mysqlcode/logout.php">Logout</a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a href="<?= BASE_URL ?>login">Login</a></li>
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
                                <option value="<?= $category['category'] ?>"><?= $category['category'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="header_second">
            <div class="container-fluid">
                <div class="row p-3">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <ul class="navbar_links my-auto d-none">
                            <li><a href="<?= BASE_URL ?>">Home</a></li>
                            <li><a href="<?= BASE_URL ?>shop">Don't Donate, Purchase</a></li>
                            <li><a href="<?= BASE_URL ?>about-us">About us</a></li>
                            <li><a href="<?= BASE_URL ?>shop/stole">Stole</a></li>
                            <li><a href="<?= BASE_URL ?>shop/bag">Bag</a></li>
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

                                    </div>
                                    <div class="cart_footer">
                                        <div class="price_ele">
                                            <h6>Total Price :</h6>
                                            <h6 class="total_price">0</h6>
                                        </div>
                                        <div>
                                            <a href="<?= BASE_URL ?>checkout_2" target="_blank" rel="noopener noreferrer">
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
        </div>
    
    <div class="mobile_sidebar">
        <h4 class="menu_heading">Menu</h4>
        <ul class="my-auto">
            <li><a href="<?= BASE_URL ?>">Home</a></li>
            <li><a href="<?= BASE_URL ?>shop">Shop</a></li>
            <li class="category">Categories
                <ul class="sub_menu">
                <?php
                foreach ($categories as $category) {
                ?>
                    <li><a href="<?=BASE_URL?>shop/<?=$category['category']?>"><?=$category['category']?></a></li>
                <?php
                }
                ?>
                </ul>
            </li>
            <li><a href="<?= BASE_URL ?>about-us">About us</a></li>
            <li><a href="<?= BASE_URL ?>shop/stole">Stole</a></li>
            <li><a href="<?= BASE_URL ?>shop/bag">Bag</a></li>
        </ul>
    </div>                        

    </header>