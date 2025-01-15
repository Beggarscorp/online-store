<?php
include('../../config/db.php');
// Function to delete product from the database
function deleteProduct($conn, $productId) {
    // Using a prepared statement to prevent SQL injection
    $sql = "DELETE FROM `products` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the product ID as an integer
    $stmt->bind_param("i", $productId);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the all products page after successful deletion
        header("Location: /allproduct.php");
        exit(); // Exit the script after the header redirect
    } else {
        // If execution fails, output the error
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

if (isset($_POST['delete']) && isset($_POST['id'])) {
    // Get the product ID from the POST request
    $productId = $_POST['id'];

    // Ensure product ID is an integer before using it in the delete operation
    if (filter_var($productId, FILTER_VALIDATE_INT)) {
        deleteProduct($conn, $productId);
    } else {
        echo "Invalid product ID.";
    }
}


?>