<?php
include('BackendAssets/mysqlcode/allproducts.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="BackendAssets/css/allproduct.css">
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
                    <table class="w-100 py-2">
                        <thead>
                            <tr class="lato-black">
                                <td>Product code</td>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Price</td>
                                <td>Stock</td>
                                <td>Description</td>
                                <td>Product Color</td>
                                <td>Size & Fit</td>
                                <td>Material and Care</td>
                                <td>Spacification</td>
                                <td>Min order quantity</td>
                                <td colspan="2">Operations</td>
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
                                <td><?=$row['discription']?></td>
                                <td><?=$row['product_color']?></td>
                                <td><?=$row['sizeandfit']?></td>
                                <td><?=$row['materialandcare']?></td>
                                <td><?=$row['spacification']?></td>
                                <td><?=$row['min_order']?></td>
                                <?php
                                $id=$row['id'];
                                $productname=$row['productname'];
                                $category=$row['category'];
                                $price=$row['price'];
                                $stock=$row['stock'];
                                $discription=$row['discription'];
                                $color=$row['product_color'];
                                $sizeandfit=$row['sizeandfit'];
                                $materialandcare=$row['materialandcare'];
                                $specification=$row['spacification'];
                                $min_order=$row['min_order'];
                                $productimage=$row['productimage'];
                                $productImageGallery=$row['productimagegallery'];

                                // $discriptionJson=json_encode($row['discription']);
                                // $sizeandfitJson=json_encode($row['sizeandfit']);
                                // $materialandcareJson=json_encode($row['materialandcare']);
                                // $specificationJson=json_encode($row['spacification']);
                                
                                ?>
                                <td class="update" 
                                data-id="<?= $id ?>"
                                data-productname="<?= $productname ?>"
                                data-productcategory="<?= $category ?>"
                                data-productprice="<?= $price ?>"
                                data-productstock="<?= $stock ?>"
                                data-productdis="<?=$discription?>"
                                data-productcolor="<?=$color?>"
                                data-productsizeandfit="<?=$sizeandfit?>"
                                data-productmaterialandcare="<?=$materialandcare?>"
                                data-productspecification="<?=$specification?>"
                                data-productmin_order="<?= $min_order ?>"
                                data-productimage="<?= $productimage ?>"
                                
                                data-imggallery="<?= $productImageGallery ?>" 
                                onclick="sendUpdateProduct(this)"
                                >
                                <i class="bi bi-pencil-square"></i></td>
                                <td class="delete" onclick="deleteProduct(<?=$row['id'] ?>)"><i class="bi bi-trash"></i></td>
                            </tr>
                            <?php
                           }
                           ?>
                           <form action="/BackendAssets/mysqlcode/allproducts.php" method="post" id="delete">
                               <input type="hidden" name="delete">
                               <input type="hidden" name="id" class="deleteProductid" value="<?=$row['id'] ?>">
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
            window.location.href="/productUpdate.php?Id="+encodeURIComponent(data.id)
            +'&productName='+encodeURIComponent(data.productname)
            +'&'+'productCategory='+encodeURIComponent(data.productcategory)
            +'&productPrice='+encodeURIComponent(data.productprice)
            +'&productStock='+encodeURIComponent(data.productstock)
            +'&productDiscription='+encodeURIComponent(data.productdis)
            +'&product_color='+encodeURIComponent(data.productcolor)
            +'&sizeandfit='+encodeURIComponent(data.productsizeandfit)
            +'&materialandcare='+encodeURIComponent(data.productmaterialandcare)
            +'&spacification='+encodeURIComponent(data.productspecification)
            +'&min_order_quantity='+encodeURIComponent(data.productmin_order)
            +'&productImage='+encodeURIComponent(data.productimage)
            +'&productImageGallery='+encodeURIComponent(data.imggallery);
        }
        }
        


        // const updateProduct=(id,productname,productcategory,productprice,productstock,productdiscription,sizeandfit,materialandcare,spacification,min_order,productimage,productimagegallery)=>{
        //     // console.log(id+"<br>",productname+"<br>",productcategory+"<br>",productprice+"<br>",productstock+"<br>",productdiscription+"<br>",sizeandfit+"<br>",materialandcare+"<br>",spacification+"<br>",min_order+"<br>",productcategory)
        //     // console.log(id+"<br>",productname+"<br>",productcategory+"<br>",productprice+"<br>",productstock+"<br>",productdiscription+"<br>",sizeandfit+"<br>",materialandcare+"<br>",spacification+"<br>",min_order+"<br>",productimage,productimagegallery);
        //     if(confirm("Want to update product") === true)
        // {
        //     window.location.href="/productUpdate.php?Id="+encodeURIComponent(id)+'&productName='+encodeURIComponent(productname)+'&'+'productCategory='+encodeURIComponent(productcategory)+'&productPrice='+encodeURIComponent(productprice)+'&productStock='+encodeURIComponent(productstock)+'&productDiscription='+encodeURIComponent(productdiscription)+'&sizeandfit='+encodeURIComponent(sizeandfit)+'&materialandcare='+encodeURIComponent(materialandcare)+'&spacification='+encodeURIComponent(spacification)+'&min_order_quantity='+encodeURIComponent(min_order)+'&productImage='+encodeURIComponent(productimage)+'&productImageGallery='+encodeURIComponent(productimagegallery);
        // }
        // else
        // {
        //     alert("failed");
        // }
    </script>
</body>

</html>