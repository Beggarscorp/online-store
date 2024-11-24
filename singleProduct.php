<?php
include 'BackendAssets/Components/header.php';
include('config/db.php');


$id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE id=$id";
$Allproducts = $conn->query($sql);
$row = mysqli_fetch_array($Allproducts);

$product_qty='';
$add_to_cart_btn='';
if((int)$row['min_order'] > 0)
{
    $product_qty=$row['min_order'];
}
else
{
    if(isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart']  as $key => $cartProduct)
        {
            if((int)$id === $cartProduct['product_id'])
            {
                $product_qty=$cartProduct['product_count'];
                $add_to_cart_btn='hide';
            }
            else
            {
                $add_to_cart_btn='show';
                $product_qty=1;
            }
        }
    }
    else
    {
        $add_to_cart_btn='show';
        $product_qty=1;
    }
}


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
                <!-- <h4 class="productPrice">Price: ₹ <?= $row['price'] ?></h4> -->
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

                if((int)$row['min_order'] > 0)
                {
                    ?>
                    <div class="fix_quantity_div my-3">
                        QTY : <?=$product_qty?> <span>(min order)</span>
                    </div>
                    <div class='price' id='price-<?=$row['id']?>' price='<?=$row['price']?>' quantity='<?=$product_qty?>'>
                        <h6>Price : <i class='bi bi-currency-rupee'></i> <?=((int)$row['price']*(int)$product_qty)?></h6>
                    </div>
                    <?php
                }
                else
                {
                    if($add_to_cart_btn === 'show')
                    {
                    ?>
                    <div class="buttons">
                        <button class="add-to-cart-btn" product_cart_id="<?= $row['id'] ?>">Add to Cart 
                            <span style="padding: 0 5px;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                        </button>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class='quantity_div my-3'>
                        <button type='button' class='plus_icon' cart_product_id='<?=$row['id']?>'><i class='bi bi-plus-lg'></i></button>
                            <span id='quantity-<?=$row['id']?>'><?=$product_qty?></span>
                        <button type='button' class='minus_icon' cart_product_id='<?=$row['id']?>'><i class='bi bi-dash-lg'></i></button>
                    </div>
                    <div class='price' id='price-<?=$row['id']?>' price='<?=$row['price']?>}' quantity='<?=$product_qty?>'>
                        <h6>Price : <i class='bi bi-currency-rupee'></i> <?=((int)$row['price'])*((int)$product_qty)?></h6>
                    </div>
                    <?php
                    }
                }
                ?>
                
                <button class="proceed_to_checkout" product_cart_id="<?=$row['id']?>">Proceed to Checkout <i class="bi bi-arrow-right-circle-fill"></i></button>
                <a href="<?=BASE_URL?>shop">
                    <button class="go_to_checkout">Continue Shopping <i class="bi bi-arrow-right-circle-fill"></i></button>
                </a>
            </div>
        </div>
        <div class="row">
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
        </div>
    </div>
</div>

<?php
include 'BackendAssets/Components/footer.php';

?>