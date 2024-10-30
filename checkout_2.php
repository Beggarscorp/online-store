<?php
include("BackendAssets/Components/header.php");
require("config/db.php");

$product_data = [];
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_product_ids = [];
    $cart_detail = [];

    // Extract product IDs from the cart session
    foreach ($_SESSION['cart'] as $cart_product) {
        if (isset($cart_product['product_id'])) {
            $cart_product_ids[] = $cart_product['product_id'];
        }
        $cart_detail[] = $cart_product;
    }


    // Check if there are any product IDs to fetch
    if (!empty($cart_product_ids)) {
        // Create placeholders for prepared statement
        $placeholders = rtrim(str_repeat('?,', count($cart_product_ids)), ',');
        $fetch_product_sql = $conn->prepare("SELECT * FROM `products` WHERE id IN ($placeholders)");

        // Create a type string for binding (assuming product_id is an integer)
        $types = str_repeat('i', count($cart_product_ids));
        $fetch_product_sql->bind_param($types, ...$cart_product_ids); // Use the spread operator

        if ($fetch_product_sql->execute()) {
            $fetch_product_result = $fetch_product_sql->get_result();
            $product_data = $fetch_product_result->fetch_all(MYSQLI_ASSOC);
        }
    } else {
        // Handle empty cart case
        $product_data = [];
    }

    $conn->close();
} else {
    // Handle the case where the cart session is not set
    $product_data = [];
}


foreach ($product_data as $key => $data) {
    if ($product_data[$key]['id'] === $cart_detail[$key]['product_id']) {
        array_push($product_data[$key], $product_data[$key]['product_id'] = $cart_detail[$key]['product_id']);
        array_push($product_data[$key], $product_data[$key]['product_count'] = $cart_detail[$key]['product_count']);
    }
}




?>

<main>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="checkout-form">
                    <form action="BackendAssets/mysqlcode/checkout.php" method="post" id="place_order_form">
                        <label for="username">Name :</label><br>
                        <input type="text" name="username" placeholder="Enter your name" id="username" value="<?= isset($address_data['name']) ? $address_data['name'] : "" ?>" onkeypress="return false" readonly required><br>

                        <label for="useremail">Email :</label><br>
                        <input type="email" name="useremail" placeholder="Enter your email" value="<?= isset($address_data['email']) ? $address_data['email'] : "" ?>" id="useremail" onkeypress="return false" readonly required><br>

                        <label for="usernumber">Number :</label><br>
                        <input type="number" name="usernumber" placeholder="Enter your number" value="<?= isset($address_data['phonenumber']) ? $address_data['phonenumber'] : ""  ?>" id="usernumber" required><br>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="country">Select country</label>
                                <input type="text" name="country" id="country" placeholder="Enter your country">
                            </div>

                            <div class="col-sm-4">
                                <label for="states">Select state</label><br>
                                <input type="text" name="state" id="states" placeholder="Enter your state">
                            </div>

                            <div class="col-sm-4">
                                <label for="city">Select city</label>
                                <input type="text" name="city" id="city" placeholder="Enter your city">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="pincode">Enter pin code</label>
                                <input type="number" id="pincode" name="userpincode" value="<?= isset($address_data['pincode']) ? $address_data['pincode'] : "" ?>" placeholder="Enter pin code here" required>
                            </div>
                            <div class="col-sm-6">
                                <div></div><br><br>
                                <span class="pincodeMsg"></span>
                            </div>
                        </div><br>

                        <label for="useraddress">Address :</label><br>
                        <textarea name="useraddress" placeholder="Flat/House no./Floor/Building" id="useraddress" required>
                        </textarea><br>


                </div>
            </div>
            <div class="col-sm-4">
                <div style="border:1px solid lightgray;margin:10px;padding:10px;border-radius:10px;">
                    <div class="product-div">
                        <?php
                        // if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        //     foreach ($product_data as $pro_data) {
                        ?>
                                <div class="addtocart-card cart_products">
                                    <!-- <div class="row">
                                        <div class="col-sm-4 p-2">
                                            <img src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $pro_data['productimage'] ?>" alt="<?= $pro_data['productimage'] ?>" class="checkout_cart_image">
                                        </div>
                                        <div class="col-sm-8 p-2">
                                            <h6><?= $pro_data['productname'] ?></h6>
                                            <h6><i class="bi bi-currency-rupee"></i><?= $pro_data['price'] ?></h6>
                                            <div class="quantity">
                                                <div class='plus_icon' cart_product_id='<?=$pro_data['id']?>'><i class='bi bi-plus-lg'></i></div>
                                                <span id='quantity-<?=$pro_data['id']?>'></span>
                                                <div class='minus_icon' cart_product_id='<?=$pro_data['id']?>'><i class='bi bi-dash-lg'></i></div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                        <?php
                        //     }
                        // } else {
                        //     echo "<h4>No products in cart</h4>";
                        // }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php
include("BackendAssets/Components/footer.php");
?>