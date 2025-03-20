<div class="listed_products">

    <?php
    $product_id = [];
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $listed_products) {
            array_push($product_id, $listed_products['product_id']);
        }
        $placeholders = implode(',', array_fill(0, count($product_id), '?'));
        $listedproduct = $conn->prepare("SELECT * FROM `products` WHERE id IN ($placeholders)");
        if ($listedproduct->execute($product_id)) {
            $listedproduct_result = $listedproduct->get_result();
            foreach ($listedproduct_result->fetch_all(MYSQLI_ASSOC) as $listed_products) {
    ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="listed_product_image">
                                    <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $listed_products['productimage'] ?>" alt="<?= $listed_products['productimage'] ?>" class="img-thumbnail border-0">
                                </div>
                            </div>
                            <div class="col-sm-8 m-auto">
                                <div class="listed_productname">
                                    <h6><?= $listed_products['productname'] ?></h6>
                                </div>
                                <div class="listed_product_category text-secondary">
                                    <p class="my-0"><?= $listed_products['category'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 m-auto">
                        <div class="listed_product_price text-secondary">
                            <p><i class="bi bi-currency-rupee"></i><?= $listed_products['price'] ?></p>
                        </div>
                    </div>
                    <div class="col-sm-3 p-4">
                        <div class="delete_icon text-end">
                            <i class="bi bi-trash3-fill text-secondary"></i>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    } else {
        echo "<h4>Listed product empty now</h4>";
    }

    ?>

</div>