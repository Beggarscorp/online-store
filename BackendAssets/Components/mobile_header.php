<?php
require('config/db.php');
$categories;
$fetch_category = $conn->prepare("SELECT * FROM `category`");
if ($fetch_category->execute()) {
    $fetch_category_result = $fetch_category->get_result();
    $categories = $fetch_category_result->fetch_all(MYSQLI_ASSOC);
}

?>
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
                                            <a href="<?=BASE_URL?>dashboard">Dashboard</a>
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
                                            <li><a href="<?= BASE_URL ?>logout.php">Logout</a></li>
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
        </div>
    
    <div class="mobile_sidebar">
        <h4 class="menu_heading">Menu</h4>
        <ul class="my-auto">
            <li><a href="<?= BASE_URL ?>">Home</a></li>
            <li><a href="<?= BASE_URL ?>shop">Don't Donate, Purchase</a></li>
            <li><a href="<?= BASE_URL ?>shop/bagful-of-dreams">Bagful of Dreams</a></li>
            <li><a href="<?= BASE_URL ?>shop/enchanted-shirt">Enchanted Shirt</a></li>
            <li><a href="<?= BASE_URL ?>shop/home-and-decor">Home & Decor</a></li>
            <li><a href="<?= BASE_URL ?>poonya">Poonya</a></li>
            
        </ul>
    </div>                        

    </header>