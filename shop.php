<!-- mainmenu-area -->
<?php
include("BackendAssets/Components/header.php");
include('BackendAssets/mysqlcode/allproducts.php');
include("config/db.php");
// include("/BackendAssets/Components/popup.php");
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
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="filter-main-head">
                <h5>Filters</h5>
                <div class="filter-icon-div">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>">
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
                    <a href="?cate=<?= $row['category'] ?>">
                        <h6 class="cate-heading"><?= $row['category'] ?></h6>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-10">
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
                        if (isset($_GET['cate'])) {
                            if ($_GET['cate'] == $row['category']) {
                    ?>
                                <div class="col-sm-3">
                                    <div class="productCard text-center">
                                        <a href="/singleProduct.php?id=<?= $row['id'] ?>&cate=<?= $row['category'] ?>" target="_blank">
                                            <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="">
                                        </a>
                                        <6><?= $row['productname'] ?></6>
                                        <h6>INR <?= $row['price'] ?></h6>
                                        <button class="add-to-cart-btn" product_cart_id="<?=$row['id']?>">Add to cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="col-sm-3">
                                <div class="productCard text-center">
                                    <a href="/singleProduct.php?id=<?= $row['id'] ?>&cate=<?= $row['category'] ?>" target="_blank">
                                        <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="">
                                    </a>
                                    <h6><?= $row['productname'] ?></h6>
                                    <h6>INR <?= $row['price'] ?></h6>
                                    <button class="add-to-cart-btn" product_cart_id="<?=$row['id']?>">Add to cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span></button>
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