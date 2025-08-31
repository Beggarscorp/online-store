<?php
require("./BackendAssets/Components/admin_upperLinks.php");
include('BackendAssets/mysqlcode/allproducts.php');

if(isset($_GET['msg']))
{
    $msg=$_GET['msg'];
    echo "<script>alert('".$msg."')</script>";
}

if(isset($_GET['image-not-upload']) && $_GET['image-not-upload'] === 'true')
{
    echo "<script>alert('Product image not uploded')</script>";
}
?>
    <link rel="stylesheet" href="<?=BASE_URL?>BackendAssets/css/allproduct.css">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 p-0">
                <?php include 'sidebar.php'; ?>
            </div>
            <div class="col-sm-10">
            <div class="content vh-100 overflowY-visible p-3 table-responsiveness">
                    <h3>All products</h3>
                    <table class="w-100 py-2 shadow-lg">
                        <thead>
                            <tr class="lato-black">
                                <td>Product code</td>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Price</td>
                                <td>Stock</td>
                                <td colspan="3">Operations</td>
                                <td>Description</td>
                                <td>Product Color</td>
                                <td>Size & Fit</td>
                                <td>Material and Care</td>
                                <td>Spacification</td>
                                <td>Impact Product By</td>
                                <td>Min order quantity</td>
                                <!-- <td>Delete</td> -->
                            </tr>
                        </thead>
                        <tbody>
                            <h6 class="text-end">Total products : <?=count($data)?></h6>
                            <?php
                           foreach($data as $row) {
                            ?>
                            <tr>
                                <td>
                                    <form action="<?=BASE_URL?>BackendAssets/mysqlcode/product_code.php" method="post">
                                        <input type="number" name="product_code" value="<?=$row['product_code'] != "" ? $row['product_code'] : "" ?>" placeholder="Enter product code here">
                                        <input type="hidden" name="product_id" value="<?=$row['id']?>">
                                    </form>
                                </td>
                                <td>
                                <img src="<?=BASE_URL?>BackendAssets/assets/images/ProductImages/<?=$row['productimage']?>" alt="<?=$row['productimage']?>" style="height:60px;">    
                                </td>
                                <td><?=$row['productname']?></td>
                                <td><?=$row['category']?></td>
                                <td>INR <?=$row['price']?></td>
                                <td><?=$row['stock']?></td>
                                <?php
                                $id=$row['id'];
                                ?>
                                <td class="update" 
                                data-id="<?= $id ?>"
                                onclick="sendUpdateProduct(this)"
                                >
                                <i class="bi bi-pencil-square"></i></td>
                                <td class="delete" onclick="deleteProduct(<?=$row['id'] ?>)"><i class="bi bi-trash"></i></td>
                                <td><input type="checkbox" name="best_seller" onclick="best_seller(<?=$row['id']?>)"  value="<?=$row['id']?>" <?= (int)$row['best_seller'] === 1 ? "checked" : "" ?> ></td>
                                <td><?=$row['discription']?></td>
                                <td><?=$row['product_color']?></td>
                                <td><?=$row['sizeandfit']?></td>
                                <td><?=$row['materialandcare']?></td>
                                <td><?=$row['spacification']?></td>
                                <td><?=$row['impact_product']?></td>
                                <td><?=$row['min_order']?></td>
                            </tr>
                            <?php
                           }
                           ?>
                           <form action="<?=BASE_URL?>BackendAssets/mysqlcode/deleteproduct.php" method="post" id="delete">
                               <input type="hidden" name="delete">
                               <input type="hidden" name="id" class="deleteProductid" value="<?=$row['id'] ?>">
                           </form>
                           <form action="<?=BASE_URL?>BackendAssets/mysqlcode/best_seller.php" method="post" id="best_seller">
                                <input type="hidden" name="best-seller" id="best-seller-input">
                           </form>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <script>
       
        const deleteProduct=(id)=>{
            let deleteProductid=document.getElementsByClassName("deleteProductid");
            deleteProductid[0].value=id;
            if(confirm("Want to delete product"))
        {
            document.getElementById("delete").submit();
        }
        }

        const sendUpdateProduct=(updateproductdata)=>{
            const data=updateproductdata.dataset;
            
            if(confirm("Want to update product"))
        {
            window.location.href="/online-store/productUpdate.php?Id="+encodeURIComponent(data.id);
        }
        }
        

        function best_seller (id) {
            let best_seller_form=document.getElementById("best_seller");
            let=best_seller_id=document.getElementById("best-seller-input").value=id;
            if(best_seller_id.value != "")
            {
                best_seller_form.submit();

            }
        }

        // Function to remove a specific query parameter
        function removeQueryParam(param) {
            const url = new URL(window.location); // Get the current URL
            url.searchParams.delete(param); // Remove the query parameter

            // Update the URL in the browser without reloading the page
            history.pushState(null, '', url); // This adds a new entry in the browser history
            // or use history.replaceState(null, '', url); // to replace the current history entry
        }

        // Example usage to remove 'filter' parameter
    
        setTimeout(() => {
            
            removeQueryParam('msg');
            
        }, 2000);
        
    </script>
<?php
require("./BackendAssets/Components/admin_bottomLinks.php");
?>