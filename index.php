<?php
require('BackendAssets/Components/header.php');
include('config/db.php');

$category_image=['Bagful of Dreams.png','White Patchwork 2.jpg','Home & Decor.png','Poonya.png'];
$category_name=['bagful-of-dreams','enchanted-shirt','home-and-decor','poonya'];

$product_sql=$conn->prepare("SELECT * FROM `products` WHERE `best_seller`=1");
$products;
if($product_sql->execute())
{
    $product_sql_result=$product_sql->get_result();
    $products=$product_sql_result->fetch_all(MYSQLI_ASSOC);
}


?>

<main>
<!-- <div class="star-container"></div> -->
    <a href="<?=BASE_URL?>/shop/banarasi-stoles">
    <img src="<?=BASE_URL?>BackendAssets/assets/images/Banner.png" class="img-thumbnail border-0">
    </a>
    <div class="banner bg-light bg-gradient">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 p-4">
                    <video autoplay loop muted class="w-100 shadow banner-video">
                        <source src="<?=BASE_URL?>BackendAssets/assets/social_media_video/InShot_20241206_135831280.mp4">
                    </video>

                </div>
                <div class="col-sm-4 m-auto">
                    <div class="banner-content p-3" style="font-family: system-ui;">
                        <h4 class="mb-4 banner-heading">Don't Donate, Purchase</h4>
                        <p class="h6 text-secondary my-2">Don't be just a customer...<br>
                            Be a responsible citizen. By choosing Beggars' Corporation you are not just purchasing but becoming part of a solution rather than being a problem, that too without donating.</p>
                        <a href="<?=BASE_URL?>shop">
                            <button class="border-0 bg-gradient-warning px-4 py-1 shadow my-2 text-light" style="background:var(--golden);">See more <i class="bi bi-arrow-right-short"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="category">
        <div class="container-fluid">
            <div class="heading">
                <h3>Our collection</h3>
            </div>
        <div class="row p-4">
            <?php
            for($c=0;$c<count($category_image);$c++)
            {
                ?>
                    <div class="col-sm-3 category-content p-4">
                        <?php
                        if($category_name[$c] === 'poonya')
                        {
                            ?>
                            <a href="<?=BASE_URL?>poonya" target="_blank" rel="noopener noreferrer">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/category_images/<?=$category_image[$c]?>" alt="<?=$category_image[$c]?>">
                                <div class="category-title">
                                    <h5><?=$category_name[$c]?></h5>
                                </div>
                            </a>
                            <?php
                        }
                        else
                        {
                            ?>
                                <a href="<?=BASE_URL?>shop/<?=$category_name[$c]?>" target="_blank" rel="noopener noreferrer">
                                    <img src="<?=BASE_URL?>BackendAssets/assets/images/category_images/<?=$category_image[$c]?>" alt="<?=$category_image[$c]?>">
                                    <div class="category-title">
                                        <h5><?=$category_name[$c]?></h5>
                                    </div>
                                </a>
                            <?php
                        }
                        ?>
                    </div>
                <?php
            }
            ?>
        </div>
        </div>
    </div>
    
    
        <div class="featured_products container-fluid p-4 bg-light bg-gradient">
            <div class="heading">
                <h3>Best Seller</h3>
            </div>
            <div class="content">
                <div class="swiper myswiper_2">
                    <div class="swiper-wrapper">
                        <?php
                        foreach($products as $product)
                        {
                            ?>
                                <div class="swiper-slide light-bg">
                                    <div class="featured_product_card">
                                        <a href="<?=BASE_URL?>singleProduct/<?=$product['category']?>/<?=$product['id']?>" target="_bland">
                                            <img src="<?=BASE_URL?>BackendAssets/assets/images/ProductImages/<?=$product['productimage']?>" alt="<?=$product['productimage']?>">
                                        </a>
                                        <h6><?=$product['productname']?></h6>
                                        <h6>Rs. <?=$product['price']?></h6>
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

    
    
    <!-- office tour video -->

    <div class="heading">
        <h3>Visit beggars corporation studio in varanasi</h3>
    </div>
    <div class="container-fluid" style="padding:0;height:80vh;">
            <video autoplay loop muted style="width:100%;height:100%;object-fit:cover;" id="visit-beggars-corporation-video">
                <source src="BackendAssets/assets/social_media_video/Beggars Corporation Varanasi _ Office Tour _ National Award Winning Startup - Beggars Corporation (1080p50, h264, youtube).mp4">
            </video>
            <div class="loader" id="visit-beggars-corporation-video-loader"></div>
    </div>

    <!-- end here -->


    <!-- about sections -->
    

    <div class="bg-light bg-gradient pb-5" style="background:#ae6c0857 !important;">
        
        <div class="heading">
            <h3>who we are</h3>
        </div>
        <div class="container" id="why-we-started">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-12">
                    <div class="right-img">
                        <img src="BackendAssets/assets/images/Chandra sir.png" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-12">
                    <div class="left">
                        <div class="left-top">d</div>
                        <div class="left-center">
                            <div class="why-we-started-content r">
                                <div style="border:2px solid var(--golden);padding:10px;height:100%">
                                    <p class="text-dark" style="font-size:15px;">Beggars' Corporation is a pioneering "Profit with Purpose" startup dedicated to transforming lives and creating meaningful impact. As a first of its kind, we are trying to break both the poverty trap and the begging trap by turning beggars into entrepreneurs, restoring their dignity and independence.<br>With our call ‘Don’t Donate, Invest or Purchase’, network of Citizens for Begging Free India, and schemes like ‘One Beggar, One Mentor’, we are creating an ecosystem that can take care of beggary at the roots where it originated from.</p>
                                    <a href="https://beggarscorporation.com/" class="text-decoration-none" target="_blank"><button>Explore more</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="left-bottom">d</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="heading">
            <h3>Impact: You can See & Show</h3>
        </div>
        <div class="container" id="why-we-started">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-12 hide-on-mobile">
                    <div class="right-img">
                        <img src="BackendAssets/assets/images/RANI at Tripur Bhairavi Ghat, Varanasi.png" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-12">
                    <div class="left">
                        <div class="left-top">d</div>
                        <div class="left-center">
                            <div class="why-we-started-content">
                                <div style="border:2px solid var(--golden);padding:10px;height:100%">
                                    <p class="text-dark">Beggars' Corporation has transformed more than 100 lives. When you wear products made by former beggars, you carry the dreams of a mother for a better future, the joy of their children's innocent smiles, and the collective vision of begging -free India.<br> Our impact extends beyond changing lives to caring for the planet. Our products not only give a second chance to people but also to the Earth, as all our fabrics are sustainable and upcycled. <br><a href="/shop" class="text-decoration-none"><span style="color:var(--golden);">#DontDonatePurchase  #PurchasewithPurpose</span></a></p>
                                    <a href="https://beggarscorporation.com/media.html" class="text-decoration-none" target="_blank"><button>Explore more</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="left-bottom">d</div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-12 show-on-mobile">
                    <div class="right-img">
                        <img src="BackendAssets/assets/images/RANI at Tripur Bhairavi Ghat, Varanasi.png" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="heading">
            <h3>Journey from ‘Daanjeevi’ to ‘Karmajeevi’</h3>
        </div>
        <div class="container" id="why-we-started">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-12">
                    <div class="right-img">
                        <img src="BackendAssets/assets/images/Sonam.png" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-12">
                    <div class="left">
                        <div class="left-top">d</div>
                        <div class="left-center">
                            <div class="why-we-started-content r">
                                <div style="border:2px solid var(--golden);padding:10px;height:100%">
                                    <p class="text-dark">"It brought me an immense joy meeting for the first time with my mentee Sonam(Beggar Turned Entrepreneur) and her cute daughter Khushboo, who is now a child model for the hand-made products. In just 3 months, Sonam has come a long way from begging on the Ghats of Banaras to earning her own living. Sonam and Khushboo, both are getting educated as well; Sonam takes a monthly paycheque by learning to sign." - <strong>Namrata Mishra, Sonam's Mentor under OBOM scheme</strong></p>
                                    <a href="https://beggarscorporation.com/cbfi.html" class="text-decoration-none" target="_blank"><button>Explore more</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="left-bottom">d</div>
                    </div>
                </div>
                 
            </div>
        </div>

    </div>

    <!-- end here -->


    <div class="our_best_products bg-light bg-gradient">
        <div class="container">
            <div class="heading">
                <h3>Our Best Products</h3>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/ban.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/begging-free-india-bag.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/co2.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/wed.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/Shakti fish 1.png" alt="">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/1.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/ProductImages/Black Patchwork 1.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/White Patchwork 2.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="gallery_image" src="<?=BASE_URL?>BackendAssets/assets/images/best_products/6.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- recognitions code start from here -->

    <div class="heading">
        <h3>recognitions</h3>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-2 col-2">
                <div class="recognition-image">
                    <a href="https://www.youtube.com/watch?v=uIRsyIMiXaM" target="_blank">
                        <img src="BackendAssets/assets/images/recognitions/tedxlogo.png" alt="tedxlogo.png">
                    </a>
                </div>
            </div>
            <div class="col-sm-2 col-2">
                <div class="recognition-image">
                    <a href="https://www.weforum.org/stories/2024/05/5-ways-businesses-can-help-to-address-poverty/" target="_blank">
                        <img src="BackendAssets/assets/images/recognitions/word-ecnomy-form.png" alt="word-ecnomy-form.png">
                    </a>
                </div>
            </div>
            <div class="col-sm-2 col-2">
                <div class="recognition-image">
                    <a href="https://www.aajtak.in/business/utility/story/chandra-mishra-started-beggars-corporation-to-turn-beggars-in-to-entrepreneurs-know-how-tutc-1669173-2023-04-06" target="_blank">
                        <img src="BackendAssets/assets/images/recognitions/aaj-tak.jpg" alt="aaj-tak.jpg">
                    </a>
                </div>
            </div>
            <div class="col-sm-2 col-2">
                <div class="recognition-image">
                    <a href="https://www.youtube.com/watch?v=2Vqx_SZJBlw" target="_blank">
                        <img src="BackendAssets/assets/images/recognitions/lalantop.jpg" alt="lalantop.jpg">
                    </a>
                </div>
            </div>
            <div class="col-sm-2 col-2">
                <div class="recognition-image">
                    <a href="https://www.youtube.com/watch?v=AGKm_byi_HI" target="_blank">
                        <img src="BackendAssets/assets/images/recognitions/Doordarshan_Logo_.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-2 col-2">
                <div class="recognition-image">
                    <a href="https://www.femina.in/femina-mamaearth-beautiful-indians-2024/goodness-stories/chandra-mishra/1525" target="_blank">
                        <img src="BackendAssets/assets/images/recognitions/mamaearth.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- end here -->
    

</main>
<?php
require('BackendAssets/Components/footer.php');
?>