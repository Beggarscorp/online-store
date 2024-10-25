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
  $color=$_POST['product_color'];

  // Check if file was uploaded without errors
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && isset($_FILES["productGallery"])) {
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $folder = '../assets/images/ProductImages/' . $imageName;

    $imagesName=$_FILES['productGallery']['name'];
    $imagesNames=implode(',',$imagesName);
    $targetFolder="../assets/images/ProductGalleryImages/";
    if(!empty($imagesNames)) {
        foreach($imagesName as $i => $imageval) {
            $targetPath= $targetFolder . $imageval;
            move_uploaded_file($_FILES['productGallery']['tmp_name'][$i],$targetPath);
        }
    }

    // Insert data into the database
    $sql = $conn->prepare("INSERT INTO products (productname, discription,product_color, price, category, stock, productimage, sizeandfit, materialandcare, spacification, productimagegallery, min_order) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


    if ($sql === false)
    {
      die("Prepare failed". $conn->error);
    }

  $sql->bind_param("sssisisssssi", $proname, $prodis,$color, $proprice, $procategory, $prostock, $imageName, $sizeAndfit, $materialAndCare, $spacification, $imagesNames, $min_order);

  $sql->execute(); 

    $responseMsg = "";

    $result=$sql->get_result();


    
    if ($sql->affected_rows != 0) {
      // Move the uploaded file
      if (move_uploaded_file($tmpName, $folder)) {
        $responseMsg = "File uploaded and moved successfully.";
      } else {
        $responseMsg = "Failed to move uploaded file.";
      }
    } else {
      $responseMsg = "Error inserting data into database: " . $conn->error;
    }

    echo $responseMsg; // Display response message for debugging
    header("Location: ".$baseurl."addProduct?uploaded=true");
    exit();
  } else {
    echo "No file uploaded or file upload error.";
  }
  $sql->close();
  $conn->close();
}
