<div class="details_div">
            <div class="container">
                <div class="inner_dashboard">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="dashboard_sidebar">
                                <ul>
                                    <li id="profile_content" onclick="showContent(this)">Profile</li>
                                    <li id="orders" onclick="showContent(this)">Orders</li>
                                    <li id="past_orders" onclick="showContent(this)">Past Orders</li>
                                    <li id="list" onclick="showContent(this)">Listed Products</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="content">
                                <div class="profile_content data">
                                    <div class="buttons">
                                        <button style="opacity: 0;"></button>
                                        <button type="button" data-toggle="modal" data-target="#address_second_modal">Add Office Address</button>
                                        <button type="button" data-toggle="modal" data-target="#address_third_modal">Add Gift Address</button>
                                    </div>
                                    <?php
                                    $profileSql = $conn->prepare("SELECT * FROM `user_default_address_table` WHERE user_id=$userid");
                                    if ($profileSql->execute()) {
                                        $profileResult = $profileSql->get_result();
                                        while ($row = $profileResult->fetch_assoc()) {
                                            // print_r($row);
                                    ?>
                                            <form action="BackendAssets/mysqlcode/dashboard.php" method="post">
                                                <div class="form_group">
                                                    <label for="name">Name :</label>
                                                    <input type="text" name="name" id="name" value="<?= $row['name'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="email">Email :</label>
                                                    <input type="email" name="email" id="email" value="<?= $row['email'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="phonenumber">Number</label>
                                                    <input type="number" name="phonenumber" id="phonenumber" value="<?= $row['phonenumber'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="country">Country :</label>
                                                    <input type="text" name="country" id="country" value="<?= $row['country'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="state">State :</label>
                                                    <input type="text" name="state" id="state" value="<?= $row['state'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="city">City :</label>
                                                    <input type="text" name="city" id="city" value="<?= $row['city'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="pincode">Pincode :</label>
                                                    <input type="text" name="pincode" id="pincode" value="<?= $row['pincode'] ?>">
                                                </div>

                                                <div class="form_group">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" id="address" value="<?= $row['address'] ?>">
                                                </div>

                                                <input type="hidden" name="address_id" value="<?= $row['address_id'] ?>">

                                                <button type="submit" name="update_default_address">Update Address</button>
                                            </form>

                                    <?php
                                        }
                                    } else {
                                        echo $profileSql->error;
                                    }
                                    ?>
                                </div>

                                <div class="orders data">
                                    <h3 class="tc">All current orders</h3>
                                    <?php
                                    $order_Sql = $conn->prepare("SELECT p.id,p.productname,p.price,p.productimage, o.* FROM `orders` AS o JOIN products AS p ON o.productid=p.id WHERE o.userid=$userid");
                                    if ($order_Sql->execute()) {
                                        $order_result = $order_Sql->get_result();
                                        while ($order = $order_result->fetch_assoc()) {
                                    ?>
                                            <div class="product_card">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img src="BackendAssets/assets/images/ProductImages/<?= $order['productimage'] ?>" alt="">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="content_line">
                                                            <h4>Product Name :</h4>
                                                            <h5><?= $order['productname'] ?></h5>

                                                        </div>
                                                        <div class="content_line">
                                                            <h4>Price :</h4>
                                                            <h5><?= $order['price'] ?></h5>
                                                        </div>
                                                        <div class="content_line">
                                                            <h4>QTY :</h4>
                                                            <h5><?= $order['productquantity'] ?></h5>
                                                        </div>
                                                        <div class="content_line">
                                                            <h4>Total Price</h4>
                                                            <h5><?= $order['productquantity'] * $order['price'] ?></h5>
                                                        </div>
                                                        <div class="order_status">
                                                            <?php
                                                            if ((int)$order['order_status'] === 0) {
                                                            ?>
                                                                <div class="content_line">
                                                                    <h5>Order Status</h5>
                                                                    <h5 class="order_pending">Pending...</h5>
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="content_line">
                                                                    <h5>Order Status</h5>
                                                                    <h5 class="order_approve">Approved <i class="fa fa-check"></i></h5>
                                                                </div>
                                                                <span class="font-13">Estimated Delivery: 8 -12 working days from booking.</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="past_orders data">
                                    <h3 class="tc">Past orders not available now</h3>
                                </div>
                                <div class="list data">
                                    <h3 class="tc">Listed Products</h3>
                                    <?php
                                    $product_list_sql = $conn->prepare("SELECT * FROM `productscart` AS pc JOIN products AS p ON pc.product_id=p.id WHERE pc.user_id=$userid");
                                    if ($product_list_sql->execute()) {
                                        $product_list_sql_result = $product_list_sql->get_result();
                                        while ($list_data = $product_list_sql_result->fetch_assoc()) {
                                    ?>
                                            <div class="product_card">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <a href="/singleProduct.php?id=<?= $list_data['id'] ?>&cate=<?= $list_data['category'] ?>" target="_blank">
                                                            <img src="BackendAssets/assets/images/ProductImages/<?= $list_data['productimage'] ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="content_line">
                                                            <h4>Product Name :</h4>
                                                            <h5><?= $list_data['productname'] ?></h5>
                                                        </div>
                                                        <div class="content_line">
                                                            <h4>Price :</h4>
                                                            <h5><?= $list_data['price'] ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>