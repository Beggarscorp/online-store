<?php
include 'BackendAssets/Components/header.php';
include('config/db.php');


$category=$_GET['category'];
$id = $_GET['id'];
$color=isset($_GET['color']) ? $_GET['color'] : "";
if(isset($_GET['color']))
{
    $sql="SELECT * FROM `products` WHERE `category`='$category' AND `product_color`='$color'";
}
else
{
    $sql = "SELECT * FROM `products` WHERE id=$id";
}
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


//find the product color from his category

$product_color_sql=$conn->prepare("SELECT DISTINCT  `product_color` FROM `products` WHERE `category`=?");
$product_color_sql->bind_param('s',$category);
if($product_color_sql->execute())
{
    $product_color__sql_result=$product_color_sql->get_result();
    $product_color=$product_color__sql_result->fetch_all(MYSQLI_ASSOC);
}


// end here


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
    <div class="smain singleproductmian">
        <div class="row">
            <div class="col-sm-7">
                
                    <!-- <div class="col-sm-9"> -->
                        <div class="productImg" style="
                    --opacity:'0';
                    --zoom-x:0%;
                    --zoom-y:0%;
                    --imageurl:url('<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>');
;                    ">
                            <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="">
                        </div>
                    <div class="multipleImg">
                        <div class="row pe-md-5">
                                <?php
                            $galleryImages = json_decode($row["productimagegallery"]);
                            foreach ($galleryImages as $galleryImage) {
                                ?>
                                <div class="col-sm-4 col-4">
                                    <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductGalleryImages/<?= $galleryImage ?>"  alt="<?= $galleryImage ?>">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- </div> -->
                <!-- </div> -->
            </div>
            <div class="col-sm-5 detail_page_content">
                <div style="border-bottom:1px solid lightgray;">
                    <h2><?= $row['productname'] ?></h2>
                    <p class="font-16"><?= $row['discription'] ?></p>
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
                
                if ($row['spacification'] != "") {

                ?>
                    <div class="spacifications">
                        <h4>Specification</h4>
                        <p class="font-16">
                            <?= $row['spacification'] ?>
                        </p>
                    </div>
                    <!--<h5 class="productPrice my-3">Rs. <?= $row['price'] ?></h5>-->
                <?php
                }
                if($row['product_color'] != "")
                {
                    ?>
                    <div class="product_color">
                        <h4>Colour</h4>
                        <p class="font-16">
                            <?php
                            foreach($product_color as $color)
                            {
                                if(!empty($color['product_color']))
                                {
                                    if(strtolower($row['product_color']) === strtolower($color['product_color']))
                                    {
                                        ?>
                                        <a href="<?=BASE_URL?>singleProduct/<?=$row['category']?>/<?=$row['id']?>/<?=$color['product_color']?>">
                                            <button style="background:<?=strtolower($color['product_color'])?>;border:3px solid var(--golden);"></button>
                                        </a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a href="<?=BASE_URL?>singleProduct/<?=$row['category']?>/<?=$row['id']?>/<?=$color['product_color']?>">
                                            <button style="background:<?=strtolower($color['product_color'])?>;"></button>
                                        </a>
                                        <?php
                                    }
                                    
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <?php
                }

                if((int)$row['min_order'] > 0)
                {
                    ?>
                    <div class="fix_quantity_div my-3 text-light">
                        QTY : <?=$product_qty?> <span>(min order)</span>
                    </div>
                    <div class='price' id='price-<?=$row['id']?>' price='<?=$row['price']?>' quantity='<?=$product_qty?>'>
                        <h5>Rs. <i class='bi bi-currency-rupee'></i> <?=((int)$row['price']*(int)$product_qty)?></h5>
                    </div>
                    <?php
                }
                else
                {
                    if($add_to_cart_btn === 'show')
                    {
                        if((int)$row['stock'] === 0)
                        {
                    ?>
                    <div class="buttons">
                        <button class="add-to-cart-btn" id="btn_tooltip" disabled>Add to Cart 
                            <span style="padding: 0 5px;"><i class="bi bi-cart-check"></i></span>
                            <span class="btn_tooltip">Product out of stock now</span>
                        </button>
                    </div>
                    <?php
                        }
                        else
                        {
                            ?>
                            <div class="buttons">
                                <button class="add-to-cart-btn" product_cart_id="<?= $row['id'] ?>">Add to Cart 
                                    <span style="padding: 0 5px;"><i class="bi bi-cart-check"></i></span>
                                </button>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        if((int)$row['stock'] === 0)
                        {
                    ?>
                    <div id="btn_tooltip">
                        <span class="btn_tooltip">Product out of stock now</span>
                        <div class='quantity_div my-3'>
                            <button type='button' disabled><i class='bi bi-plus-lg'></i></button>
                                <span id='quantity-<?=$row['id']?>'><?=$product_qty?></span>
                            <button disabled><i class='bi bi-dash-lg'></i></button>
                        </div>
                        <div class='price' id='price-<?=$row['id']?>' price='<?=$row['price']?>' quantity='<?=$product_qty?>'>
                            <h5>Rs. <i class='bi bi-currency-rupee'></i> <?=((int)$row['price'])*((int)$product_qty)?></h5>
                        </div>
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
                            <div class='price' id='price-<?=$row['id']?>' price='<?=$row['price']?>' quantity='<?=$product_qty?>'>
                                <h5>Rs. <i class='bi bi-currency-rupee'></i> <?=((int)$row['price'])*((int)$product_qty)?></h5>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                
                <?php
                if((int)$row['stock'] === 0)
                {
                    ?>
                        <button class="proceed_to_checkout" disabled id="btn_tooltip">Proceed to Checkout <i class="bi bi-arrow-right-circle-fill"></i>
                            <span class="btn_tooltip">Product out of stock now</span>
                        </button>
                    <?php
                }
                else
                {
                    ?>
                        <button class="proceed_to_checkout" product_cart_id="<?=$row['id']?>">Proceed to Checkout <i class="bi bi-arrow-right-circle-fill"></i></button>
                    <?php
                }
                ?>
                <a href="<?=BASE_URL?>shop">
                    <button class="go_to_checkout">Continue Shopping <i class="bi bi-arrow-right-circle-fill"></i></button>
                </a>
            </div>
        </div>
        <div class="row py-5">
            <h4>Related Products</h4>
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