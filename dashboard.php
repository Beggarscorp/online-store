<?php
ob_start();
include("BackendAssets/Components/header.php");
include("./BackendAssets/db.php");
if(isset($_SESSION['user']))
{

$userid = $_SESSION['id'];

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo "<script>
    Swal.fire({
    title:'$msg',
    icon:'success'
    });
    </script>";
} else if (isset($_GET['failed_msg'])) {
    $msg = $_GET['failed_msg'];
    echo "<script>
    Swal.fire({
    title:'$msg',
    icon:'error'
    });
    </script>";
}
?>
<link rel="stylesheet" href="BackendAssets/css/dashboard.css">

<div class="dashboard_main">
    <div class="banner">
        <div class="banner_content">
            <?php
            $user_img = $conn->prepare("SELECT user_image,First_name FROM `user` WHERE id=$userid");
            if ($user_img->execute()) {
                $img = $user_img->get_result()->fetch_assoc();
                if ($img['user_image'] != "") {
            ?>
                    <img src="BackendAssets/assets/images/userimages/<?= $img['user_image'] ?>" class="img" alt="" onclick="triggeriamgeupload()" srcset="">
                <?php
                } else {
                ?>
                    <img src="BackendAssets/assets/images/userimages/default_image_upload_img.png" class="img" onclick="triggeriamgeupload()" alt="">
            <?php
                }
            }
            ?>
            <input type="file" id="imagefileInput" accept="image/*" onchange="handleFileSelect(event)">
            <h2>Welcome <?= $img['First_name'] ?></h2>
            <p></p>
        </div>
    </div>
    <div class="details_div">
        <div class="container">
            <div class="inner_dashboard">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="sidebar">
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
                                                        if((int)$order['order_status'] === 0)
                                                        {
                                                            ?>
                                                            <div class="content_line">
                                                                <h5>Order Status</h5>
                                                                <h5 class="order_pending">Pending...</h5>
                                                            </div>
                                                            <?php
                                                        }
                                                        else
                                                        {
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
</div>

<!-- additional addresses modals -->

<!--address second Modal -->
<div class="modal fade" id="address_second_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add your office address</h4>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float:inline-end;border-radius:50%;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="address_div_2">
                    <?php
                    $office_Address_sql = $conn->prepare("SELECT * FROM `user_second_address_table` WHERE user_id=$userid");
                    $office_Address_sql->execute();
                    $office_address = $office_Address_sql->get_result()->fetch_assoc();

                    ?>
                    <form action="BackendAssets/mysqlcode/dashboard.php" method="post">
                        <div class="form_group">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" value="<?= isset($office_address['name']) ? $office_address['name'] : '' ?>" required placeholder="Enter your name">
                        </div>

                        <div class="form_group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" id="email" value="<?= isset($office_address['email']) ? $office_address['email'] : '' ?>" required placeholder="Enter your email">
                        </div>

                        <div class="form_group">
                            <label for="phonenumber">Number</label>
                            <input type="number" name="phonenumber" id="phonenumber" value="<?= isset($office_address['phonenumber']) ? $office_address['phonenumber'] : '' ?>" required placeholder="Enter your phonenumber">
                        </div>

                        <div class="form_group">
                            <label for="country">Country :</label>
                            <input type="text" name="country" id="country" value="<?= isset($office_address['country']) ? $office_address['country'] : '' ?>" required placeholder="Enter your country">
                        </div>

                        <div class="form_group">
                            <label for="state">State :</label>
                            <input type="text" name="state" id="state" value="<?= isset($office_address['state']) ? $office_address['state'] : '' ?>" required placeholder="Enter your state">
                        </div>

                        <div class="form_group">
                            <label for="city">City :</label>
                            <input type="text" name="city" id="city" value="<?= isset($office_address['city']) ? $office_address['city'] : '' ?>" required placeholder="Enter your city city">
                        </div>

                        <div class="form_group">
                            <label for="pincode">Pincode :</label>
                            <input type="text" name="pincode" id="pincode" value="<?= isset($office_address['pincode']) ? $office_address['pincode'] : '' ?>" required placeholder="Enter your pincode">
                        </div>

                        <div class="form_group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="<?= isset($office_address['address']) ? $office_address['address'] : '' ?>" required placeholder="Flat/House no./Floor/Building">
                        </div>

                        <button type="submit" name="update_second_address">Add Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--address third Modal -->
<div class="modal fade" id="address_third_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add your gift address</h4>
                <button type="button" class="btn" data-dismiss="modal" style="float:inline-end;border-radius:50%;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="address_div_3">
                    <?php
                    $gift_Address_sql = $conn->prepare("SELECT * FROM `user_third_address_table` WHERE user_id=$userid");
                    $gift_Address_sql->execute();
                    $gift_address = $gift_Address_sql->get_result()->fetch_assoc();

                    ?>
                    <form action="BackendAssets/mysqlcode/dashboard.php" method="post">
                        <div class="form_group">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" value="<?= isset($gift_address['name']) ? $gift_address['name'] : '' ?>" required placeholder="Enter your name">
                        </div>

                        <div class="form_group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" id="email" value="<?= isset($gift_address['email']) ? $gift_address['email'] : '' ?>" required placeholder="Enter your email">
                        </div>

                        <div class="form_group">
                            <label for="phonenumber">Number</label>
                            <input type="number" name="phonenumber" id="phonenumber" value="<?= isset($gift_address['phonenumber']) ? $gift_address['phonenumber'] : '' ?>" required placeholder="Enter your phonenumber">
                        </div>

                        <div class="form_group">
                            <label for="country">Country :</label>
                            <input type="text" name="country" id="country" value="<?= isset($gift_address['country']) ? $gift_address['country'] : '' ?>" required placeholder="Enter your country">
                        </div>

                        <div class="form_group">
                            <label for="state">State :</label>
                            <input type="text" name="state" id="state" value="<?= isset($gift_address['state']) ? $gift_address['state'] : '' ?>" required placeholder="Enter your state">
                        </div>

                        <div class="form_group">
                            <label for="city">City :</label>
                            <input type="text" name="city" id="city" value="<?= isset($gift_address['city']) ? $gift_address['city'] : '' ?>" required placeholder="Enter your city">
                        </div>

                        <div class="form_group">
                            <label for="pincode">Pincode :</label>
                            <input type="text" name="pincode" id="pincode" value="<?= isset($gift_address['pincode']) ? $gift_address['pincode'] : '' ?>" required placeholder="Enter your pincode">
                        </div>

                        <div class="form_group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" required placeholder="Flat/House no./Floor/Building" value="<?= isset($gift_address['address']) ? $gift_address['address'] : '' ?>">
                        </div>

                        <button type="submit" name="update_third_address">Add Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
else
{
    header("Location: /login.php");
    exit();
}
ob_end_flush();
?>

<script>
    let data_div = document.getElementsByClassName("data");
    let data_div_array = [];

    for ($i = 1; $i < data_div.length; $i++) {
        data_div[$i].classList.add("content_hide");
    }
    const showContent = (e) => {
        document.getElementsByClassName(e.id)[0].classList.toggle("content_hide");
        for ($i = 0; $i < data_div.length; $i++) {
            if (!data_div[$i].classList.contains(e.id)) {
                data_div[$i].classList.add("content_hide");
            }
        }
    }


    const triggeriamgeupload = () => {
        document.getElementById("imagefileInput").click();
    }

    const handleFileSelect = (e) => {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('upload_user_image', file);

            // Use fetch API to send the file to the server
            fetch('BackendAssets/mysqlcode/dashboard.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    const show_adress_div = (e) => {
        let match = e.className.match(/_(\d+)$/);
        let class_number = parseInt(match[1], 10);
        document.getElementsByClassName("address_div_" + class_number)[0].classList.toggle("content_hide");
    }
</script>
<?php
include("BackendAssets/Components/footer.php");
?>