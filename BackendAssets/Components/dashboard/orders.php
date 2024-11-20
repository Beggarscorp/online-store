<div class="orders_element">
    <h4>Your orders</h4>
    <?php
    $user_id=$_SESSION['id'];
    $product_order_sql=$conn->prepare("SELECT * FROM `orders` as o INNER JOIN `products` AS p ON p.id=o.productid and o.userid=?");
    $product_order_sql->bind_param('i',$user_id);
    if($product_order_sql->execute())
    {
        $product_order_sql_result=$product_order_sql->get_result();
        foreach($product_order_sql_result as $order)
        {
            ?>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="image">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?=BASE_URL?>BackendAssets/assets/images/ProductImages/<?=$order['productimage']?>" alt="<?=$order['productimage']?>" class="img-thumbnail border-0">
                                </div>
                                <div class="col-sm-8 m-auto">
                                    <h6><?=$order['productname']?></h6>
                                    <p class="text-secondary"><?=$order['category']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <h6><i class="bi bi-currency-rupee"></i><?=$order['price']?></h6>
                    </div>
                    <div class="col-sm-4">
                        <div class="product_delivery_status">
                            <?php
                            if((int)$order['order_status'] === 0)
                            {
                                ?>
                                    <h6 class="d-flex align-items-center"><i style="font-size: 10px;" class="bi bi-circle-fill text-danger w-25"></i>Order pending now..</h6>
                                <?php
                            }
                            if((int)$order['order_status'] === 1)
                            {
                                ?>
                                    <h6 class="d-flex align-items-center"><i style="font-size: 10px;" class="bi bi-circle-fill text-success w-25"></i>Delivered soon</h6>
                                <?php
                            } 
                            ?>
                            
                        </div>
                    </div>
                </div>
            <?php
        }
    }
    ?>
</div>