<?php
include('./config/db.php');

if (isset($_POST['delete']) && isset($_POST['id'])) {
    deleteProduct();
}

$sql = "SELECT * FROM `products`";
$Allproducts = $conn->query($sql);

$data = [];
if ($Allproducts) {
  foreach ($Allproducts as $row) {
    $data[] = $row;
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
function deleteProduct()
{
  include '../db.php';
  $sql = "DELETE FROM `products` WHERE id=" . $_POST['id'];
  if ($conn->query($sql) === TRUE) {
    header("Location: /allproduct.php");
    exit();
  }
}