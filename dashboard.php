<?php
ob_start();
include("BackendAssets/Components/header.php");
include("./config/db.php");
if (isset($_SESSION['user'])) {

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

    // ;

$userSql=$conn->prepare("SELECT * FROM `user_default_address_table` WHERE default_address=1 AND user_id=? UNION SELECT * FROM `user_second_address_table` WHERE default_address=1 AND user_id=? UNION SELECT * FROM `user_third_address_table` WHERE default_address=1 AND user_id=?");
$userSql->bind_param('iii',$userid,$userid,$userid);
$userData;
if($userSql->execute())
{
    $userSql_result=$userSql->get_result();
    $userData=$userSql_result->fetch_all(MYSQLI_ASSOC)[0];
    $userSql->close();
}
?>

    <div class="dashboard_main bg-light bg-gradient py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 p-2 ">
                    <div class="profile_view dash_background dashboard_sidebar ">
                        <div class="row border-1 border-bottom pb-2">
                            <div class="col-sm-6 col-6">
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
                            </div>
                            <div class="col-sm-6 col-6">
                                <input type="file" id="imagefileInput" accept="image/*" onchange="handleFileSelect(event)">
                                <h6>Welcome,<br> <?= $img['First_name']?> </h6>
                            </div>
                        </div>
                        <div class="navigation">
                        <div class="menu_icon">
                            <span class="first_line menu_line"></span>
                            <span class="middle_line menu_line"></span>
                            <span class="last_line menu_line"></span>
                        </div>
                            <ul>
                                <li id="profile">Profile</li>
                                <li id="orders">Orders</li>
                                <li id="listed_products">Listed Products</li>
                                <li id="add_office_address">Add Office Address</li>
                                <li id="add_gift_address">Add Gift Address</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-9 p-2">
                    <div class="dash_background dash_content"> 
                        <div class="profile element_container">
                            <?php include("../online-store/BackendAssets/Components/dashboard/personal_information.php")?>
                        </div>
                        <div class="orders element_container">
                            <?php include("../online-store/BackendAssets/Components/dashboard/orders.php")?>
                        </div>
                        <div class="listed_products element_container">
                            <?php include("../online-store/BackendAssets/Components/dashboard/listed_products.php")?>
                        </div>
                        <div class="add_office_address element_container">
                            <?php include("../online-store/BackendAssets/Components/dashboard/add_office_address.php")?>
                        </div>
                        <div class="add_gift_address element_container">
                            <?php include("../online-store/BackendAssets/Components/dashboard/add_gift_address.php")?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    

<?php
} else {
    header("Location: ".BASE_URL."login.php");
    exit();
}
ob_end_flush();
?>

<script>

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