<?php
include('BackendAssets/mysqlcode/allproducts.php');

if(isset($_GET['image-not-upload']) && $_GET['image-not-upload'] === 'true')
{
    echo "<script>alert('Product image not uploded')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="<?=BASE_URL?>BackendAssets/css/allproduct.css">
</head>

<body>
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
                                <td><?=$row['id']?></td>
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
            window.location.href="/productUpdate.php?Id="+encodeURIComponent(data.id);
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

        
    </script>
</body>

</html>