<?php
include("BackendAssets/Components/header.php");
include('BackendAssets/mysqlcode/allproducts.php');
include("config/db.php");
// error_reporting(0);

$category = isset($_GET['category']) ? $_GET['category'] : '';
$pegination_show=false;

if(isset($_GET['category']))
{
    // fetch category id from category slug

    $fetch_category=$conn->prepare("SELECT `id` FROM `category` WHERE `category-slug`=?");
    $fetch_category->bind_param('s',$category);
    if($fetch_category->execute())
    {
        $fetch_category_result=$fetch_category->get_result();
        $category_id=$fetch_category_result->fetch_all(MYSQLI_ASSOC);
        $category_id=isset($category_id[0]['id'])?$category_id[0]['id']:0;

        //get category id here

        // fetching subcategory from category id

        $fetch_subcategory=$conn->prepare("SELECT `subcategory-slug` FROM `subcategory` WHERE `cate_id`=?");
        $fetch_subcategory->bind_param('i',$category_id);
        if($fetch_subcategory->execute())
        {
            $fetch_subcategory_result=$fetch_subcategory->get_result();
            $all_Subcategory=$fetch_subcategory_result->fetch_all(MYSQLI_ASSOC);
            $subcategories=array();
            foreach($all_Subcategory as $subcate)
            {
                array_push($subcategories,$subcate['subcategory-slug']);
            }
            array_push($subcategories,$category);
            $subcategories = "'" . implode("','", $subcategories) . "'";

            //here i am gettig all subcategories accourding to category

            //here i am getting all products accourding to subcategories
            $product_sql="SELECT * FROM `products` WHERE `category` IN ($subcategories)";
            $product_result=$conn->query($product_sql);
            if($product_result)
            {
                $data=$product_result->fetch_all(MYSQLI_ASSOC);

                //end here
                if(count($data) > 16)
                {
                    $pegination_show=true;
                }
            }
            else
            {
                echo "Error";
            }
        }
    }
}
else
{
    //here i am getting all products without any categroy filter
    $product_sql=$conn->prepare("SELECT * FROM `products`");
    if($product_sql->execute())
    {
        $product_result=$product_sql->get_result();
        $data=$product_result->fetch_all(MYSQLI_ASSOC);
        //end here
        if(count($data) > 16)
        {
            $pegination_show=true;
        }
    }
}

$sql = "SELECT * FROM `category`";
$result = mysqli_query($conn, $sql);

?>

<div class="page-banner">
    <h2>Don't Donate, <span class="golden border-0">Purchase</span></h2>
</div>
<div class="container-fluid p-3">
        <p class="text-secondary py-3">..Be a Responsible Citizen. Your Purposeful Purchase can lift someone from the poverty trap and turn him or her from a Beggar To Entrepreneur (BTE). By purchasing from BTEs, you serve three purposes at once: Begging Free India, Plastic Free India, and Transforming lives without donating. Feel the magic of the hands who once begged for your coins. Explore the diverse range of products stitched with the dreams of a better life for their children.</p>
    <div class="row p-4">
        <div class="filters shadow mb-3">
            <div class="filter-main-head">
                <h5>Filters by category</h5>
                <div class="filter-icon-div">
                    <a href="<?=BASE_URL?>shop">
                        <button class="clear_all_category_btn">Clear all</button>
                    </a>
                    <i class="fa fa-filter"></i>
                </div>
            </div>
            <div class="filter-container">
                <?php
                foreach ($result as $row) {
                ?>
                    <h6 class="cate-heading" category-slug="<?= $row['category-slug'] ?>" category-id="<?= $row['id'] ?>"><?= $row['category'] ?></h6>
                    <ul style="list-style:none;">
                        <?php
                        $cate_id=$row['id'];
                        $fetch_subcategory=$conn->prepare("SELECT * FROM `subcategory` WHERE `cate_id`=?");
                        $fetch_subcategory->bind_param('i',$cate_id);
                        if($fetch_subcategory->execute())
                        {
                            $fetch_subcategory_result=$fetch_subcategory->get_result();
                            $all_Subcategory=$fetch_subcategory_result->fetch_all(MYSQLI_ASSOC);
                            foreach($all_Subcategory as $subcate)
                            {
                            ?>
                            <li class="cate-heading" subcategory-slug="<?=$subcate['subcategory-slug']?>"><?=$subcate['subcategory']?></li>
                            <?php
                            }
                        }
                        ?>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-12">
        <div class="product-container">
                <div class="row">
                    <?php
                    $for_pegination=$data;
                    $productCard = "";
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $productCard = $page * 16;
                        $data = array_slice($data, $productCard - 16, $productCard);
                    }
                    $data = array_slice($data, 0, 16);
                    foreach ($data as $row) {
                            ?>
                            <div class="col-sm-3 light-bg">
                                <div class="productCard text-center">
                                    <a href="<?=BASE_URL?>singleProduct/<?= $row['category']."/".$row['id'] ?>" target="_blank">
                                        <div class="product-image">
                                            <img class="first-image" src="<?= BASE_URL ?>BackendAssets/assets/images/ProductImages/<?= $row['productimage'] ?>" alt="<?= $row['productimage'] ?>">
                                            <img class="second-image" src="<?= BASE_URL ?>BackendAssets/assets/images/ProductGalleryImages/<?= json_decode($row['productimagegallery'])[0] ?>" alt="<?= json_decode($row['productimagegallery'])[0] ?>">
                                        </div>
                                        <?php
                                            if((int)$row['stock'] === 0)
                                            {
                                                ?>
                                                    <div class="out_of_stock">Out of Stock</div>
                                                <?php
                                            }
                                        ?>
                                    </a>
                                    <h6><?= $row['productname'] ?></h6>
                                    <h6>Rs. <?= $row['price'] ?></h6>
                                    <?php
                                        if((int)$row['stock'] === 0)
                                        {
                                            ?>
                                                <div class="row">
                                                    <div class="col-sm-6 col-6">
                                                        <button disabled  id="btn_tooltip" class="add-to-cart-btn">Add to cart
                                                            <span class="btn_tooltip">Product out of stock now</span>
                                                        </button>
                                                    </div> 
                                                    <div class="col-sm-6 col-6">
                                                        <button class="quick-view"><a href="<?=BASE_URL?>singleProduct/<?= $row['category']."/".$row['id'] ?>" target="_blank">Quick View</a></button>
                                                    </div> 
                                                </div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <div class="row">
                                                    <div class="col-sm-6 col-6">
                                                        <button class="add-to-cart-btn" product_cart_id="<?=$row['id']?>">Add to cart</button>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <button class="quick-view"><a href="<?=BASE_URL?>singleProduct/<?= $row['category']."/".$row['id'] ?>" target="_blank">Quick View</a></button>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php
                    }
                    $datacountnumber = ceil(count($for_pegination)/16);                 
                    ?>
                </div>
                <div class="pegination-div">
                    <ul>
                        <?php
                        
                        if ($pegination_show) {
                            for ($i = 1; $i <= $datacountnumber; $i++) {
                        ?>
                                <li><?= $i ?></li>
                        <?php
                            }
                        } else {
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include("BackendAssets/Components/footer.php");
?>