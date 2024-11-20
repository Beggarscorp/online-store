<?php
include 'BackendAssets/Components/header.php';
include('config/db.php');

$userid = isset($_SESSION['id']) ? $_SESSION['id'] : 14;

$id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE id=$id";
$Allproducts = $conn->query($sql);
$row = mysqli_fetch_array($Allproducts);
?>
<!--<link rel="stylesheet" href="BackendAssets/css/singleProduct.css">-->
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
<div class="container">
    <div class="smain">
        <div class="row">
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="multipleImg">
                            <?php
                            $galleryImages = explode(",", $row["productimagegallery"]);
                            foreach ($galleryImages as $galleryImage) {
                            ?>
                                <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductGalleryImages/<?= $galleryImage ?>" alt="<?= $galleryImage ?>" onclick="galleryimages(this)">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="productImg" style="
                    --display:'none';
                    --zoom-x:88%;
                    --zoom-y:41.2%;
                    --imageurl:url('<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>');
;                    ">
                            <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div style="border-bottom:1px solid lightgray;">
                    <h2><?= $row['productname'] ?></h2>
                    <p class="font-16"><?= $row['discription'] ?></p>
                </div>
                <h4 class="productPrice">Price: ₹ <?= $row['price'] ?></h4>
                <?php
                if ($userid != "" && isset($_SESSION['id'])) {
                    if ($row['min_order'] > 0) {
                ?>
                        <h5>QTY : <?= $row['min_order'] ?> <span style="color:red;font-size:12px;">(Min order <?= $row['min_order'] ?> pices)</span></h5>
                        <?php
                    } else {
                        $productid = $row['id'];
                        $sqlForQty = "SELECT MAX(product_qty) FROM `checkout` WHERE product_id=$productid AND userid=$userid";
                        $resultForQty = mysqli_fetch_assoc(mysqli_query($conn, $sqlForQty));
                        if ($resultForQty['MAX(product_qty)'] > 0) {
                        ?>
                            <h5>QTY : <input type="number" name="quantityIncreaseDecrease" id="quantityIncreaseDecrease" value="<?= $resultForQty['MAX(product_qty)'] ?>" min="1" userid="<?= $_SESSION['id'] ?>" productid="<?= $row['id'] ?>" productprice="<?= $row['price'] ?>" onchange="quantityTotal(this)"></h5>
                        <?php
                        } else {
                        ?>
                            <h5>QTY : <input type="number" name="quantityIncreaseDecrease" id="quantityIncreaseDecrease" value="1" min="1" userid="<?= $_SESSION['id'] ?>" productid="<?= $row['id'] ?>" productprice="<?= $row['price'] ?>" onchange="quantityTotal(this)"></h5>
                <?php

                        }
                    }
                }
                ?>
                <div class="buttons">
                    <!--<a href="BackendAssets/mysqlcode/addtocart.php?id=<?= $row['id'] ?>&page=<?= $_SERVER['PHP_SELF'] ?>&cate=<?= $row['category'] ?>">-->
                    <button class="add-to-cart-btn" product_cart_id="<?= $row['id'] ?>">Add to Cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            <!--</a>-->
                        </span>
                    </button>
                </div>
                <?php
                if ($row['sizeandfit'] != "") {
                ?>
                    <div class="size_fit">
                        <h4>Size & Fit</h4>
                        <p class="font-16">
                            <?= $row['sizeandfit'] ?>
                        </p>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($row['materialandcare'] != "") {
                ?>
                    <div class="material_care">
                        <h4>Material & Care</h4>
                        <p class="font-16">
                            <?= $row['materialandcare'] ?>
                        </p>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($row['spacification'] != "") {

                ?>
                    <div class="spacifications">
                        <h4>Specification</h4>
                        <p class="font-16">
                            <?= $row['spacification'] ?>
                        </p>
                    </div>
                <?php
                }
                ?>
                <button class="proceed_to_checkout" product_cart_id="<?=$row['id']?>">Proceed to Checkout <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                <a href="<?=BASE_URL?>shop">
                    <button class="go_to_checkout">Continue Shopping <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </a>
            </div>
        </div>
        <div class="row">
            <!--<div class="container">-->
            <h3>Related Products</h3>
            <?php
            $relatedProductSql = "SELECT * FROM `products`";
            $RelatedAllProducts = $conn->query($relatedProductSql);
            foreach ($RelatedAllProducts as $row2) {
                if ($row2['category'] == $_GET['category']) {
            ?>
                    <div class="col-sm-3">
                        <div class="relatedProductCard">
                            <a href="<?= BASE_URL ?>singleProduct/<?= $row2['category'] ?>/<?= $row2['id'] ?>" target="_blank">
                                <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row2['productimage'] ?>" alt="">
                            </a>
                            <h5><?= $row2['productname'] ?></h5>
                            <h5>Rs . <?= $row2['price'] ?></h5>
                            <button class="add-to-cart-btn" product_cart_id="<?=$row2['id']?>">Add to Cart <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <!--</div>-->
        </div>
    </div>
</div>

<?php
include 'BackendAssets/Components/footer.php';

?>