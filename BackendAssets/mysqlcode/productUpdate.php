<?php
include('../../config/db.php');
if (isset($_POST['submit'])) {
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productDescription = $_POST['description'];
    $color=$_POST['product_color'];
    $sizeAndfit=$_POST['sizeAndfit'];
    $materialandcare=$_POST['materialAndCare'];
    $spacification=$_POST['spacification'];
    $productPrice = $_POST['price'];
    $productCategory = $_POST['category'];
    $productStock = $_POST['stock'];
    $min_order= $_POST['min_order'];
    $productImage="";
    $productImageGallery="";
    $galleryfiles=$_FILES['productGallery']['name'];
    
    if ($_FILES['image']['name'] != "") {    
       $productImage = $_FILES['image']['name'];
       $productImageTmpName = $_FILES['image']['tmp_name'];
       $folder = '../assets/images/ProductImages/'. $productImage;
       move_uploaded_file($productImageTmpName,$folder);

    }   
    else
    {
        $productImage = $_POST['defaultImgPath'];

    }
    if($galleryfiles != [""])
    {
        $imagesName=$_FILES['productGallery']['name'];
       $productImageGallery=implode(',',$imagesName);
       $targetFolder="../assets/images/ProductGalleryImages/";
        if(!empty($productImageGallery)) {
        foreach($imagesName as $i => $imageval) {
           echo $targetPath= $targetFolder . $imageval;
            move_uploaded_file($_FILES['productGallery']['tmp_name'][$i],$targetPath);
        }
    }
    else
    {
        echo "Not any image available";
    }
   }
    else
    {
        $productImageGallery=$_POST['defaultImgGalleryPath'];
    }

    $sql =$conn->prepare("UPDATE products SET productname=?,

    discription=?,product_color=?,price=?,category=?,

    stock=?,productimage=?,sizeandfit=?,

    materialandcare=?,spacification=?,

    productimagegallery=? , min_order=? WHERE id=?");

    if($sql === false)
    {
        die("Prepare failed".$conn->error);
    }
    else
    {

        $sql->bind_param('sssisisssssii',$productName,$productDescription,$color,$productPrice,$productCategory,$productStock,$productImage,$sizeAndfit,$materialandcare,$spacification,$productImageGallery,$min_order,$productId);
    
        if ($sql->execute()) {
            header("Location: /allproduct.php?msg=product updated");
            exit();
        }
        else
        {
            echo "Failed to upload product";
        }

    }
    $conn->close();
    $sql->close();
}
