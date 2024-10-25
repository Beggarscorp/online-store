<?php
require('BackendAssets/Components/header.php');
include('config/db.php');
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

    <div class="category">
        <div class="heading">
            <h3>Categories</h3>
        </div>
        <div class="content">
            <?php
            // $sql=$conn->prepare("SELECT * FROM `category`");
            // if($sql->execute())
            // {
            //     $result=$sql->get_result();
            //     while($data=$result->fetch_assoc())
            //     {
            //       echo $data['category'];  
            //     }
            // }
            ?>
            <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-wrapper container-sm d-flex  justify-content-around">
                            <div class="card  " style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Stole</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bag</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Curtains</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-wrapper container-sm d-flex   justify-content-around">
                            <div class="card  " style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Sari</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Enchanted Shirt</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Sakti</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-wrapper container-sm d-flex  justify-content-around">
                            <div class="card " style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Poonya</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="featured_products">
        <div class="heading">
            <h3>Featured <span class="golden">Products</span></h3>
        </div>
        <div class="content">
        <div id="carouselExampleControls_second" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-wrapper container-sm d-flex  justify-content-around">
                            <div class="card  " style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Stole</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bag</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Curtains</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-wrapper container-sm d-flex   justify-content-around">
                            <div class="card  " style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Sari</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Enchanted Shirt</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Sakti</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-wrapper container-sm d-flex  justify-content-around">
                            <div class="card " style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Poonya</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/banner2-img.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_second" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_second" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require('BackendAssets/Components/footer.php');
?>