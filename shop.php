<!-- mainmenu-area -->
<?php
include("BackendAssets/Components/header.php");
include('BackendAssets/mysqlcode/allproducts.php');
include("config/db.php");
// error_reporting(0);

$sql = "SELECT * FROM `category`";
$result = mysqli_query($conn, $sql);

?>

<?php
if (isset($_GET["cart"]) && $_GET['cart'] == "updated") {
    echo "<div class='alert alert-success' role='alert'>
  Product added to the cart
</div>";
} else if (isset($_GET["cart"]) && $_GET['cart'] == "added_already") {
    echo "<div class='alert alert-warning' role='alert'>
  Product already in the cart
</div>";
}
?>
<div class="shop-page-banner">
    <h2>Don't Donate, <span class="golden border-0">Purchase</span></h2>
</div>
<div class="container-fluid">
    <div class="row p-4">
        <p class="text-secondary text-center py-1">..Be a Responsible Citizen. Your Purposeful Purchase can lift someone from the poverty trap and turn him or her from a Beggar To Entrepreneur (BTE). By purchasing from BTEs, you serve three purposes at once: Begging Free India, Plastic Free India, and Transforming lives without donating. Feel the magic of the hands who once begged for your coins. Explore the diverse range of products stitched with the dreams of a better life for their children.</p>
        <!-- <div class="col-sm-2">
            <div class="filter-main-head">
                <h5>Filters</h5>
                <div class="filter-icon-div">
                    <a href="<?=BASE_URL?>shop">
                        <button class="clear_all_category_btn">Clear all</button>
                    </a>
                    <i class="fa fa-filter"></i>
                </div>
            </div>
            <div class="filter-container">
                <h5>Category</h5>
                <?php
                foreach ($result as $row) {
                ?>
                    <h6 class="cate-heading"><?= $row['category'] ?></h6>
                <?php
                }
                ?>
            </div>
        </div> -->
        <div class="col-sm-12">
        <div class="product-container">
                <div class="row">
                    <?php
                    $productCard = "";
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $productCard = $page * 16;
                        $data = array_slice($data, $productCard - 16, $productCard);
                    }
                    $data = array_slice($data, 0, 16);
                    foreach ($data as $row) {
                        if (isset($_GET['category'])) {
                            if ($_GET['category'] == $row['category']) {
                    ?>
                                <div class="col-sm-3 light-bg">
                                    <div class="productCard text-center">
                                        <a href="<?=BASE_URL?>singleProduct/<?= $row['category']."/".$row['id'] ?>" target="_blank">
                                        <div class="product-image">
                                            <img class="first-image" src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="<?= $row['productimage'] ?>">
                                            <img class="second-image" src="<?= BASE_URL ?>BackendAssets/assets/images/ProductGalleryImages/<?= explode(',',$row['productimagegallery'])[0] ?>" alt="<?= explode(',',$row['productimagegallery'])[0] ?>">
                                        </div>
                                            <?php
                                                if((int)$row['stock'] === 0)
                                                {
                                                    ?>
                                                        <div class="out_of_stock">Out of Stock</div>
                                                    <?php
                                                }
                                            ?>
                                        </a>
                                        <h6><?= $row['productname'] ?></h6>
                                        <h6>INR <?= $row['price'] ?></h6>
                                        <?php
                                            if((int)$row['stock'] === 0)
                                            {
                                                ?>
                                                    <button disabled id="btn_tooltip" class="add-to-cart-btn">Add to cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                        <span class="btn_tooltip">Product out of stock now</span>
                                                    </button>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <button class="add-to-cart-btn" product_cart_id="<?=$row['id']?>">Add to cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="col-sm-3 light-bg">
                                <div class="productCard text-center">
                                    <a href="<?=BASE_URL?>singleProduct/<?= $row['category']."/".$row['id'] ?>" target="_blank">
                                    <div class="product-image">
                                        <img class="first-image" src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="<?= $row['productimage'] ?>">
                                        <img class="second-image" src="<?= BASE_URL ?>BackendAssets/assets/images/ProductGalleryImages/<?= explode(',',$row['productimagegallery'])[0] ?>" alt="<?= explode(',',$row['productimagegallery'])[0] ?>">
                                    </div>
                                        <?php
                                            if((int)$row['stock'] === 0)
                                            {
                                                ?>
                                                    <div class="out_of_stock">Out of Stock</div>
                                                <?php
                                            }
                                        ?>
                                    </a>
                                    <h6><?= $row['productname'] ?></h6>
                                    <h6>INR <?= $row['price'] ?></h6>
                                    <?php
                                        if((int)$row['stock'] === 0)
                                        {
                                            ?>
                                                <button disabled  id="btn_tooltip" class="add-to-cart-btn">Add to cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                                                    <span class="btn_tooltip">Product out of stock now</span>
                                                </button>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <button class="add-to-cart-btn" product_cart_id="<?=$row['id']?>">Add to cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span></button>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    $datacountnumber = count($data);
                    $countnumber = 1;
                    if ($datacountnumber / 16) {
                        $countnumber++;
                    } else {
                        $countnumber = 0;
                    }
                    ?>
                </div>
                <div class="pegination-div">
                    <ul>
                        <?php
                        if ($countnumber > 16) {
                            for ($i = 1; $i <= $countnumber; $i++) {
                        ?>
                                <li><?= $i ?></li>
                        <?php
                            }
                        } else {
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include("BackendAssets/Components/footer.php");
?>