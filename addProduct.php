<?php
include("config/db.php");
error_reporting(0);
$sql="SELECT * FROM `category`";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="<?=BASE_URL?>BackendAssets/css/addproduct.css">
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
                    <div class="msg">
                    <?php
                    if (isset($_GET['msg'])) {
                        echo "<div class='alert alert-success' role='alert'>
                      " . $_GET['msg'] . "
                    </div>";
                    }
                    ?>
                    </div>
                    <h3>Add Product from here</h3>
                    <form action="BackendAssets/mysqlcode/addproduct.php" method="post" enctype="multipart/form-data">
                        <label for="name">Product Name:</label><br>
                        <input type="text" id="name" placeholder="Enter product name here" name="name" required><br>

                        <label for="description">Short Description:</label><br>
                        <textarea id="description" rows="10" oninput="convertText(this)" placeholder="Enter prouduct short discription here" name="description" required></textarea><br>
                        
                        <label for="sizeAndfit">Size & fit:</label><br>
                        <textarea id="sizeAndfit" rows="10" oninput="convertText(this)" placeholder="Enter prouduct size & fit here" name="sizeAndfit" required></textarea><br>
                        
                        <label for="materialAndCare">Material & Care:</label><br>
                        <textarea id="materialAndCare" rows="10" oninput="convertText(this)" placeholder="Enter prouduct material & care here" name="materialAndCare" required></textarea><br>
                        
                        <label for="spacification">Spacification:</label><br>
                        <textarea id="spacification" rows="10" oninput="convertText(this)" placeholder="Enter prouduct spacification here" name="spacification" required></textarea><br>
                        
                        <label for="product_color">Product color</label><br>
                        <select name="product_color" id="product_color">
                            <option value="Default">Select Product Color</option>
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
                        <input type="number" id="price" placeholder="Enter product price here" name="price" step="0.01" required><br>

                        <label for="category">Category:</label><br>
                        <select name="category" id="category" class="addcate-select" required>
                            <option value="default" disabled selected>Select product category</option>
                            <?php
                                $cateid;
                                $allCategory = $conn->prepare("SELECT * FROM `category`");
                                if ($allCategory->execute()) {
                                    $allCategory_result = $allCategory->get_result();
                                    foreach ($allCategory_result->fetch_all(MYSQLI_ASSOC) as $cates) {
                                        $cateid = $cates['id'];
                                ?>
                                        <option value="<?= $cates['category'] ?>"><?= $cates['category'] ?></option>
                                        <?php
                                        $sub_allCategories = $conn->prepare("SELECT subcategory,subcategory_id FROM `subcategory` WHERE cate_id=$cateid");
                                        if ($sub_allCategories->execute()) {
                                            $sub_allCategories_result = $sub_allCategories->get_result();
                                            if ($sub_allCategories_result->num_rows > 0) {
                                        ?>
                                                    <?php
                                                    foreach ($sub_allCategories_result->fetch_all(MYSQLI_ASSOC) as $all_SubCates) {
                                                    ?>
                                                        <option value="<?= $all_SubCates['subcategory'] ?>"><h5>Subcategory :</h5> <?= $all_SubCates['subcategory'] ?></option>
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
                        <input type="number" id="stock" placeholder="Enter product stock here" name="stock" value="0"><br>

                        <label for="min_order">Min order quantity</label><br>
                        <input type="number" id="min_order" placeholder="Enter min order pices of the product" name="min_order"><br>

                        <label for="image">Product Image:</label><br>
                        <input type="file" id="image" accept="image/*" name="image" required><br>

                        <label for="productGallery">Upload Product Images for Gallery:</label><br>
                        <span id="error" style="color:red;" class="error"></span><br>
                        <input type="file" id="productGallery" name="productGallery[]" accept="image/*" multiple required><br>

                        <button type="submit" name="submit">Add Product</button>
                    </form>


                    <?php
                    if (isset($_GET['uploaded'])) 
                    {
                        popupshow("Product uploaded");
                    }
                    ?>
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
