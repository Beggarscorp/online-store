

<?php
require('config/db.php');
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <span class="cart_count"></span>
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
                        <a href="shop.php"><li>Shop</li></a>
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
                                
                                </div>
                                <div class="cart_footer">
                                    <div class="price_ele">
                                        <h6>Total Price :</h6>
                                        <h6 class="total_price">0</h6>
                                    </div>
                                    <a href="<?=BASE_URL?>checkout_2.php" target="_blank" rel="noopener noreferrer">
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
    </header>
