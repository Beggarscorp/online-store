<?php
// Include the database configuration file
include("./config/db.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Query to fetch all products
$sql = "SELECT * FROM `products`";
$Allproducts = $conn->query($sql);

$data = [];
if ($Allproducts) {
    // Fetch all the rows and store them in the $data array
    while ($row = $Allproducts->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // Output error message if query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();

// End output buffering and send output
?>
