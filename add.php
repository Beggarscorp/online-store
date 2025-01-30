<?php
require("./BackendAssets/Components/admin_upperLinks.php");
?>

<link rel="stylesheet" href="./BackendAssets/css/add.css">
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
                <h3 class="py-2">Add additional things from here</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="product_category">
                            <h4 class="py-2">Add Products Categories from here</h4>
                            <form action="<?=BASE_URL?>BackendAssets/mysqlcode/addcategory.php" method="POST" enctype="multipart/form-data">
                                <label for="category">Add Category :</label><br>
                                <input type="text" name="category" placeholder="Enter your category here"><br>
                                <button type="submit" name="cateSubmit">Add Category</button>
                            </form>
                            <h5 class="py-2">Add subcategory</h5>
                            <form action="<?=BASE_URL?>BackendAssets/mysqlcode/addcategory.php" method="post">
                                <label for="cateid">Select Category</label><br>
                                <select name="cateid" id="cateid">
                                    <?php
                                    $category = $conn->prepare("SELECT * FROM `category`");
                                    if ($category->execute()) {
                                        $category_result = $category->get_result();
                                        foreach ($category_result->fetch_all(MYSQLI_ASSOC) as $cate) {
                                    ?>
                                            <option value="<?= $cate['id'] ?>">
                                                <?= $cate['category'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="subcategory"></label><br>
                                <input type="text" name="subcategory" id="subcategory" placeholder="Enter Subcategory"><br>
                                <button type="submit" name="subcategory_submit">Add Subcategory</button>
                            </form>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="category_show">
                            <h4>Categories & Subcategories</h4>
                            <ul class="list-unstyled">
                                <?php
                                $cateid;
                                $allCategory = $conn->prepare("SELECT * FROM `category`");
                                if ($allCategory->execute()) {
                                    $allCategory_result = $allCategory->get_result();
                                    foreach ($allCategory_result->fetch_all(MYSQLI_ASSOC) as $cates) {
                                        $cateid = $cates['id'];
                                ?>
                                        <li><?= $cates['category'] ?>
                                            <span class="operation_link">
                                                <a href="<?=BASE_URL?>BackendAssets/mysqlcode/addcategory.php?function=update_category_and_subcategory&table=category&id=<?= $cates['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                                                <a href="<?=BASE_URL?>BackendAssets/mysqlcode/addcategory.php?function=delete_category_and_subcategory&table=category&id=<?= $cates['id'] ?>"><i class="bi bi-x-square" style="color:red !important;"></i></a>
                                            </span>
                                        </li>
                                        <?php
                                        $sub_allCategories = $conn->prepare("SELECT subcategory,subcategory_id FROM `subcategory` WHERE cate_id=$cateid");
                                        if ($sub_allCategories->execute()) {
                                            $sub_allCategories_result = $sub_allCategories->get_result();
                                            if ($sub_allCategories_result->num_rows > 0) {
                                        ?>
                                                <ol>
                                                    <?php
                                                    foreach ($sub_allCategories_result->fetch_all(MYSQLI_ASSOC) as $all_SubCates) {
                                                    ?>
                                                        <li><?= $all_SubCates['subcategory'] ?>
                                                            <span class="operation_link">
                                                                <a href="<?=BASE_URL?>BackendAssets/mysqlcode/addcategory.php?function=update_category_and_subcategory&table=subcategory&id=<?= $all_SubCates['subcategory_id'] ?>"><i class="bi bi-pencil-square"></i></a>
                                                                <a href="<?=BASE_URL?>BackendAssets/mysqlcode/addcategory.php?function=delete_category_and_subcategory&table=subcategory&id=<?= $all_SubCates['subcategory_id'] ?>"><i class="bi bi-x-square" style="color:red !important;"></i></a>
                                                            </span>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ol>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product_color">
                    <h4 class="py-2">Add Products Colors from here</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <form action="<?=BASE_URL?>BackendAssets/mysqlcode/addcolor.php" method="POST">
                                <label for="product-color">Add Product Color :</label><br>
                                <input type="text" name="product-color" placeholder="Enter product color here"><br>
                                <button type="submit" name="product_color_submit">Add Color</button>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <div class="colors">
                                <h4>Colors</h4>
                                <ul>
                                    <?php
                                    $colors = $conn->prepare("SELECT * FROM `product_color`");
                                    if ($colors->execute()) {
                                        $colors_result = $colors->get_result();
                                        foreach ($colors_result->fetch_all(MYSQLI_ASSOC) as $all_colors) {
                                    ?>
                                            <li><?= $all_colors['color'] ?>
                                                <span class="operation_link">
                                                    <a href="<?=BASE_URL?>BackendAssets/mysqlcode/addcolor.php?function=update_color&id=<?=$all_colors['color_id']?>&color=<?= $all_colors['color'] ?>"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="<?=BASE_URL?>BackendAssets/mysqlcode/addcolor.php?function=delete_color&id=<?=$all_colors['color_id']?>"><i class="bi bi-x-square" style="color:red !important;"></i></a>
                                                </span>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require("./BackendAssets/Components/admin_bottomLinks.php");
?>