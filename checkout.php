<?php
include("BackendAssets/Components/header.php");
require("config/db.php");

if(isset($_GET['msg']) && (int)$_GET['msg'] === 1)
{
    echo "<script>Swal.fire({
      title:'Your order placed successfully',
      icon:'success'
    });</script>";
}
if(isset($_GET['msg']) && (int)$_GET['msg'] === 2)
{
    echo "<script>Swal.fire({
      title:'All field are required',
      icon:'error'
    });</script>";
}
if(isset($_GET['msg']) && (int)$_GET['msg'] === 3)
{
    echo "<script>Swal.fire({
      title:'Something gone wrong',
      icon:'error'
    });</script>";
}
if(isset($_GET['msg']) && (int)$_GET['msg'] === 4)
{
    echo "<script>Swal.fire({
      text:'Your order has been placed successfully. Further details will be shared with you via WhatsApp shortly. Stay tuned.',
      icon:'success'
    });</script>";
}
if(isset($_GET['msg']) && (int)$_GET['msg'] === 5)
{
    echo "<script>Swal.fire({
      title:'Order failed',
      icon:'error'
    });</script>";
}

$order_product_session;
$user_id=$_SESSION['id'] != "" ? $_SESSION['id'] : "";

?>

<main>

    <form action="<?=BASE_URL?>BackendAssets/mysqlcode/checkout_2.php" method="POST" name="place_order_form"  id="place_order_form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="checkout-form">
                        <label for="username">Name :</label><br>
                        <input type="text" name="username" placeholder="Enter your name" id="username"  required><br>

                        <label for="useremail">Email :</label><br>
                        <input type="email" name="useremail" placeholder="Enter your email" id="useremail"  required><br>

                        <div class="position-relative">
                            <label for="usernumber">Number :</label><br>
                            <input type="number" name="usernumber" placeholder="Enter your number" id="usernumber" required><br>
                            <span class="position-absolute end-0 number-msg"></span>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="country">Enter country name</label>
                                <input type="text" name="country" id="country" placeholder="Enter your country">
                            </div>

                            <div class="col-sm-4">
                                <label for="states">Enter state name</label><br>
                                <input type="text" name="state" id="states" placeholder="Enter your state">
                            </div>

                            <div class="col-sm-4">
                                <label for="city">Enter city name</label>
                                <input type="text" name="city" id="city" placeholder="Enter your city">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="pincode">Enter pin code</label>
                                <input type="number" id="pincode" name="userpincode" placeholder="Enter pin code here" required>
                            </div>
                            <div class="col-sm-6">
                                <div></div><br><br>
                                <span class="pincodeMsg"></span>
                            </div>
                        </div><br>

                        <label for="useraddress">Address :</label><br>
                        <textarea name="useraddress" placeholder="Flat/House no./Floor/Building" id="useraddress" required></textarea><br>
                        


                </div>
            </div>
            <div class="col-sm-4">
                <div style="border:1px solid lightgray;margin:10px;padding:10px;border-radius:10px;">
                    <div class="product-div">
                        <?php
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart']) && !isset($_GET['dummy'])) {

                            $order_product_session='cart';
                        ?>
                            <div class="addtocart-card cart_products">

                            </div>
                            <div class="cart_price_ele">
                                <h6>Total Price :</h6>
                                <h6 id="ptc_total_price">0</h6>
                                <input type="hidden" name="total_price_input" id="total_price_input">
                            </div>
                            <?php
                        } else {
                            if (isset($_GET['dummy']) && $_GET['dummy'] === 'product' && isset($_SESSION['proceed_to_checkout'][0]['product_id'])) {
                                $order_product_session='proceed_to_checkout';
                                $data=$_SESSION['proceed_to_checkout_data'];
                            ?>

                                <div class='proceed_to_checkout_container'>
                                    <?php
                                    if($data[0][0] === 0)
                                    {
                                        ?>
                                        <h3>No Product available now</h3>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <div class='row'>
                                                <div class='col-sm-4'>
                                                    <img src='<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $data[0]['productimage'] ?>'
                                                        alt='<?= $data[0]['productimage'] ?>' class='img-thumbnail'>
                                                </div>
                                                <div class='col-sm-8'>
                                                    <h6><?= $data[0]['productname'] ?></h6>
                                                    <?php
                                                    if((int)$data[0]['min_order'] > 0)
                                                    {
                                                        ?>
                                                        <div class='fix_quantity_div'>QTY : <?=$data[0]['min_order']?> <span>(min order)</span></div>
                                                        <div class='price' id='price-<?=$data[0]['id']?>' price='<?=$data[0]['price']?>' quantity='<?=$data[0]['min_order']?>'>
                                                            <h6><i class='bi bi-currency-rupee'></i> <?=$data[0]['price']*$data[0]['min_order']?></h6>
                                                        </div>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div class='quantity_div'>
                                                        <button type="button" class='plus_icon' cart_product_id='<?= $data[0]['id'] ?>'>
                                                            <i class='bi bi-plus-lg'></i>
                                                        </button>
                                                        <span id='quantity'><?= $data[0][0] ?></span>
                                                        <button type="button" class='minus_icon' cart_product_id='<?= $data[0]['id'] ?>'>
                                                            <i class='bi bi-dash-lg'></i>
                                                        </button>
                                                    </div>
                                                    <div class='price' price='<?= $data[0]['price']?>' quantity='<?= $data[0][0] ?>'>   
                                                        <h6 class="ptc_price" id="price"><i class='bi bi-currency-rupee'></i><?= $data[0]['price']*$data[0][0] ?>
                                                        </h6>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="price_ele ptc_price_ele">
                                <h6>Total Price :</h6>
                                <h6 id="ptc_second_total_price"><i class='bi bi-currency-rupee'></i><?=$data[0]['price']?></h6>
                                <input type="hidden" name="ptc_total_price_input" id="ptc_total_price_input">
                            </div>
                            
                            <?php
                            } else {
                                echo "<h4>No products in cart</h4>";
                            }
                        }
                        
                        ?>
                    </div>
                    <div class="place_order_btn">
                        <button type="submit" name="place_order" id="place_order">Place Order</button>
                    </div>
                </div>
            </div>

            <!-- storing order product id and quantity -->

            <input type="hidden" name="product_id_and_quantity" value="<?=$order_product_session?>">

            <!-- end here -->

            <!-- storing razorpay ids -->

            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">

            <!-- end here -->

        </div>
    </div>
</form>

</main>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<?php

include("BackendAssets/Components/footer.php");
?>