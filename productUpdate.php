<?php
include('./config/db.php');

$id=(int)$_GET['Id'];

$up_data="";
$update_product_sql = $conn->prepare("SELECT * FROM `products` WHERE `id` = ?");
$update_product_sql->bind_param('i',$id);
if($update_product_sql->execute())
{
    $result = $update_product_sql->get_result();
    $up_data=$result->fetch_assoc();
    $update_product_sql->close;
}
else
{
    echo "Failed";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="/BackendAssets/css/addproduct.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/main/favicon.png">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 p-0">
                <?php include 'sidebar.php'; ?>
            </div>
            <div class="col-sm-10">
            <div class="content vh-100 overflowY-visible p-3">
                    <h3>Update Product from here</h3>
                    <form action="/BackendAssets/mysqlcode/productUpdate.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?=$up_data['id']?>">
                    <label for="name">Product Name:</label><br>
                    <input type="text" id="name" name="name" value="<?=$up_data['productname']?>"><br>

                    <label for="description">Short Description:</label><br>
                    <textarea id="description" rows="10" oninput="convertText(this)" name="description"><?=$up_data['discription']?></textarea><br>

                    <label for="sizeAndfit">Size & fit:</label><br>
                    <textarea id="sizeAndfit" rows="10" oninput="convertText(this)" name="sizeAndfit"><?=$up_data['sizeandfit']?></textarea><br>
                        
                    <label for="materialAndCare">Material & Care:</label><br>
                    <textarea id="materialAndCare" rows="10" oninput="convertText(this)" name="materialAndCare"><?=$up_data['materialandcare']?></textarea><br>
                        
                    <label for="spacification">Spacification:</label><br>
                    <textarea id="spacification" rows="10" oninput="convertText(this)" name="spacification"><?=$up_data['spacification']?></textarea><br>
                    
                    <label for="product_color">Product color</label><br>
                        <select name="product_color" id="product_color">
                            <option value="<?=$up_data['product_color']?>"><?=$up_data['product_color']?></option>
                            <?php
                            $product_color_sql="SELECT * FROM `product_color`";
                            $product_color_result=mysqli_fetch_all(mysqli_query($conn,$product_color_sql),MYSQLI_ASSOC);
                            foreach($product_color_result as $color_data)
                            {
                            ?>
                                <option value="<?=$color_data['color']?>"><?=$color_data['color']?></option>
                            <?php
                            }
                            ?>
                        </select><br>

                    <label for="price">Price:</label><br>
                    <input type="number" id="price" name="price" value="<?=$up_data['price']?>"><br>

                    <label for="category">Category:</label><br>
                    <select name="category" id="category">
                        <option value="<?=$up_data['category']?>"><?=$up_data['category']?></option>
                            <?php
                                $cateid;
                                $allCategory = $conn->prepare("SELECT * FROM `category`");
                                if ($allCategory->execute()) {
                                    $allCategory_result = $allCategory->get_result();
                                    foreach ($allCategory_result->fetch_all(MYSQLI_ASSOC) as $cates) {
                                        $cateid = $cates['id'];
                                ?>
                                        <option value="<?= $cates['category-slug'] ?>"><?= $cates['category'] ?></option>
                                        <?php
                                        $sub_allCategories = $conn->prepare("SELECT `subcategory-slug`,`subcategory`,`subcategory_id` FROM `subcategory` WHERE cate_id=$cateid");
                                        if ($sub_allCategories->execute()) {
                                            $sub_allCategories_result = $sub_allCategories->get_result();
                                            if ($sub_allCategories_result->num_rows > 0) {
                                        ?>
                                                    <?php
                                                    foreach ($sub_allCategories_result->fetch_all(MYSQLI_ASSOC) as $all_SubCates) {
                                                    ?>
                                                        <option value="<?= $all_SubCates['subcategory-slug'] ?>"><h5>Subcategory :</h5> <?= $all_SubCates['subcategory'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                        </select>
                    <br>

                    <label for="stock">Stock:</label><br>
                    <input type="number" id="stock" name="stock" value="<?=$up_data['stock']?>"><br>

                    <label for="min_order">Min order pices</label><br>
                    <input type="number" id="min_order" value="<?=$up_data['min_order']?>" name="min_order"><br>

                    <label for="image">Product Image:</label><br>
                    <img src="/BackendAssets/assets/images/ProductImages/<?=$up_data['productimage']?>" imgPath="<?=$up_data['productimage']?>" class="defaultImgName" style="height:80px;border:1px solid gray;margin:0 10px;">
                    <input type="hidden" name="defaultImgPath" value="<?=$up_data['productimage']?>">
                    <input type="file" accept="image/*" class="chooseImgName" name="image" value="<?=$up_data['productimage']?>"><br><br>

                    <label for="productGallery">Product Image Gallery:</label><br>
                    <span id="error" style="color:red;" class="error"></span><br>
                    <input type="file" id="productGallery" name="productGallery[]" accept="image/*" multiple><br>
                    <?php
                    $json_d=json_decode($up_data['productimagegallery'],true);
                    $gllery_img_val=implode(',',$json_d);
                    ?>
                    <input type="hidden" name="defaultImgGalleryPath" value="<?=$gllery_img_val?>">

                    <?php
                     
                    $images=json_decode($up_data['productimagegallery']);
                    foreach ($images as $image) {
                        ?>
                            <img src="<?=BASE_URL?>BackendAssets/assets/images/ProductGalleryImages/<?=$image?>" imgPath="<?=$image?>" class="defaultImgName" style="height:80px;border:1px solid gray;margin:0 10px;">
                        <?php
                    }
                    ?>
                    <br>

                    <button type="submit" name="submit">Update Product</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const chooseImageElement=document.getElementById("productGallery");
        chooseImageElement.addEventListener("change",(e)=>{
            const errorSpan = document.getElementById('error');
            if(e.target.files.length > 3)
        {
            errorSpan.textContent = 'You can only select up to 3 images.';
            e.target.value='';
        }else
        {
            errorSpan.textContent="";
        }
        })

        const convertText=(e)=>{
            let text=e.value;
            let html=text.replace(/(\r\n|\n|\r)/g, '<br>');
            e.value=html;
        }

    </script>
</body>
</html>
