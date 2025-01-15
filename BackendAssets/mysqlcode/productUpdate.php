<?php
include('../../config/db.php');

ini_set('display_errors', 1);  // Display errors on the page
error_reporting(E_ALL);        // Report all errors

if (isset($_POST['submit'])) {
    // Retrieve data from form
    $productId = $_POST['product_id'];
    $productName = $_POST['name'];
    $productDescription = $_POST['description'];
    $color = $_POST['product_color'];
    $sizeAndfit = $_POST['sizeAndfit'];
    $materialandcare = $_POST['materialAndCare'];
    $spacification = $_POST['spacification'];
    $productPrice = $_POST['price'];
    $productCategory = $_POST['category'];
    $productStock = $_POST['stock'];
    $min_order = $_POST['min_order'];
    
    // Default image values
    $productImage = "";
    $gallery_img = [];
    $json_gallery = '';

    // Handle main product image
    if ($_FILES['image']['name'] !== "") {
        $productimage = $_FILES['image']['name'];
        $productImageTmpName = $_FILES['image']['tmp_name'];
        $imageExtension = pathinfo($productimage, PATHINFO_EXTENSION);
        $productImageUniqueName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $imageExtension;
        $productImage = $productImageUniqueName;
        $folder = '../assets/images/ProductImages/' . $productImageUniqueName;
        move_uploaded_file($productImageTmpName, $folder);
        

    } else {
        $productImage = $_POST['defaultImgPath'];
    }

    // Handle gallery images
    $galleryfiles = $_FILES['productGallery']['name'];
    if ($galleryfiles != [""]) {
        $galleryImagesName = $_FILES['productGallery']['name'];
        $productImageGallery = implode(',', $galleryImagesName);
        $targetFolder = "../assets/images/ProductGalleryImages/";

        if (!empty($galleryImagesName)) {
            foreach ($galleryImagesName as $i => $imageval) {
                $imageExtension = pathinfo($imageval, PATHINFO_EXTENSION);
                $galleryImageUniqueName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $imageExtension;
                array_push($gallery_img, $galleryImageUniqueName);
                $targetPath = $targetFolder . $galleryImageUniqueName;
                move_uploaded_file($_FILES['productGallery']['tmp_name'][$i], $targetPath);
                
            }
            $json_gallery = json_encode($gallery_img);
        }
    } else {
        
        $json_gallery = json_encode(explode(',',$_POST['defaultImgGalleryPath']));
        // $json_gallery = "rr";
    }
    

    // Prepare SQL query
        $sql = $conn->prepare("UPDATE `products` SET 
                                productname = ?, 
                                discription = ?, 
                                product_color = ?, 
                                price = ?, 
                                category = ?, 
                                stock = ?, 
                                productimage = ?, 
                                sizeandfit = ?, 
                                materialandcare = ?, 
                                spacification = ?, 
                                productimagegallery = ?, 
                                min_order = ? 
                                WHERE id = ?");
        if ($sql === false) {
            die("Prepare failed: " . $conn->error);
        } else {
            // Bind parameters
            $sql->bind_param('sssisisssssii', 
            $productName, $productDescription, $color, $productPrice, $productCategory, $productStock, $productImage, $sizeAndfit, $materialandcare, 
            $spacification, $json_gallery, $min_order, $productId);
    
            // Execute query
            if ($sql->execute()) {
                header("Location: /allproduct.php?msg=product updated");
                exit();
            } else {
                echo "Failed to update product: " . $conn->error;
            }
        }
    
        // Close connections
        $conn->close();
        $sql->close();
}
?>