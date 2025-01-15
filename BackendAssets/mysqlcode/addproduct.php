<?php
include '../../config/db.php';
$baseurl=BASE_URL;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

  $proname = $_POST['name'];
  $prodis = $_POST['description'];
  $proprice = $_POST['price'];
  $procategory = $_POST['category'];
  $prostock = $_POST['stock'];
  $sizeAndfit = $_POST['sizeAndfit'];
  $materialAndCare = $_POST['materialAndCare'];
  $spacification = $_POST['spacification'];
  $min_order = $_POST['min_order'];
  $color = $_POST['product_color'];
  $img_gallery=[];

  // Check if file was uploaded without errors
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && isset($_FILES["productGallery"])) {
    
    // Process main product image
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    $imageNameUnique = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $imageExtension; // Unique filename with timestamp

    // Set the target folder for main image
    $imageFolder = '../assets/images/ProductImages/' . $imageNameUnique;

    // Process product gallery images
    $galleryImagesName = $_FILES['productGallery']['name'];
    $galleryImagesNames = implode(',', $galleryImagesName);
    $targetFolder = "../assets/images/ProductGalleryImages/";

    // Process each gallery image
    if (!empty($galleryImagesNames)) {
        foreach ($galleryImagesName as $i => $imageval) {
            $galleryImageExtension = pathinfo($imageval, PATHINFO_EXTENSION);
            $galleryImageNameUnique = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $galleryImageExtension; // Unique filename for gallery images
            $galleryImagePath = $targetFolder . $galleryImageNameUnique;
            array_push($img_gallery,$galleryImageNameUnique);

            // Move uploaded gallery image to target folder
            move_uploaded_file($_FILES['productGallery']['tmp_name'][$i], $galleryImagePath);
        }
    }
    
    $img_gallery_json=json_encode($img_gallery);
    echo "error";
    // Insert data into the database
    $sql = $conn->prepare("INSERT INTO products (productname, discription, product_color, price, category, stock, productimage, sizeandfit, materialandcare, spacification, productimagegallery, min_order) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($sql === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters for the query
    $sql->bind_param("sssisisssssi", $proname, $prodis, $color, $proprice, $procategory, $prostock, $imageNameUnique, $sizeAndfit, $materialAndCare, $spacification, $img_gallery_json, $min_order);

    // Execute the query
    $sql->execute();

    // Handle file move and response message
    $responseMsg = "";
    if ($sql->affected_rows != 0) {
        // Move the uploaded main image
        if (move_uploaded_file($imageTmpName, $imageFolder)) {
            $responseMsg = "File uploaded and moved successfully.";
        } else {
            $responseMsg = "Failed to move uploaded main image.";
        }
    } else {
        $responseMsg = "Error inserting data into database: " . $conn->error;
    }

    echo $responseMsg; // Display response message for debugging
    echo "<script>window.location.href='".$baseurl."addProduct?uploaded=true'</script>";
    exit();
  } else {
    echo "No file uploaded or file upload error.";
  }
//   $sql->close();
//   $conn->close();
}
?>
