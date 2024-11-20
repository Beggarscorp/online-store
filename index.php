<?php
require('BackendAssets/Components/header.php');
include('config/db.php');

$cate_sql=$conn->prepare("SELECT * FROM `category`");
$categories;
if($cate_sql->execute())
{
    $cate_result=$cate_sql->get_result();
    $categories=$cate_result->fetch_all(MYSQLI_ASSOC);
}

$product_sql=$conn->prepare("SELECT * FROM `products`");
$products;
if($product_sql->execute())
{
    $product_sql_result=$product_sql->get_result();
    $products=$product_sql_result->fetch_all(MYSQLI_ASSOC);
}


?>

<main>
    <div class="banner">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= BASE_URL ?>BackendAssets/assets/images/banner-img-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= BASE_URL ?>BackendAssets/assets/images/banner-img-2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= BASE_URL ?>BackendAssets/assets/images/banner-img-3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="category bg-light bg-gradient pb-5">
    <div class="container">
        <div class="heading">
            <h3>Cate<span class="golden">gories</span></h3>
        </div>
    <div class="swiper myswiper">
        <div class="swiper-wrapper">
            <?php
            foreach($categories as $category)
            {
                ?>
                    <div class="swiper-slide">
                        <div class="cate_div">
                            <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" alt="">
                            <h5><?=$category['category']?></h5>
                        </div>
                    </div>
                <?php
            }
            ?>
        </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</div>
    </div>

    <div class="featured_products container">
        <div class="heading">
            <h3>Featured <span class="golden">Products</span></h3>
        </div>
        <div class="content">
            <div class="swiper myswiper_2">
                <div class="swiper-wrapper">
                    <?php
                    foreach($products as $product)
                    {
                        ?>
                            <div class="swiper-slide">
                                <div class="featured_product_card">
                                    <a href="<?=BASE_URL?>singleProduct/<?=$product['category']?>/<?=$product['id']?>" target="_bland">
                                        <img src="<?=BASE_URL?>BackendAssets/assets/images/ProductImages/<?=$product['productimage']?>" alt="<?=$product['productimage']?>">
                                    </a>
                                    <h6><?=$product['productname']?></h6>
                                    <h6>Price: <?=$product['price']?></h6>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>

        <div class="featured_products container">
            <div class="heading">
                <h3>Best <span class="golden">Seller</span></h3>
            </div>
            <div class="content">
                <div class="swiper myswiper_2">
                    <div class="swiper-wrapper">
                        <?php
                        foreach($products as $product)
                        {
                            ?>
                                <div class="swiper-slide">
                                    <div class="featured_product_card">
                                        <a href="<?=BASE_URL?>singleProduct/<?=$product['category']?>/<?=$product['id']?>" target="_bland">
                                            <img src="<?=BASE_URL?>BackendAssets/assets/images/ProductImages/<?=$product['productimage']?>" alt="<?=$product['productimage']?>">
                                            <h6 class="out_of_stock">Out of Stock</h6>
                                        </a>
                                        <h6><?=$product['productname']?></h6>
                                        <h6>Price: <?=$product['price']?></h6>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>

    <div class="our_best_products bg-light bg-gradient">
        <div class="container">
            <div class="heading">
                <h3>Our <span class="golden">Best Products</span></h3>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/ban.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/begging-free-india-bag.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/co2.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/wed.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/Shakti fish 1.png" alt="">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/1.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/5.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/Yellow Elephant 3.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/6.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-sm-4">
                    <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/DSC04711.jpg" alt="">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/DSC04772.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/DSC04774.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="gallery_image" src="<?=BASE_URL?>/BackendAssets/assets/images/best_products/DSC04709.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

</main>
<?php
require('BackendAssets/Components/footer.php');
?>