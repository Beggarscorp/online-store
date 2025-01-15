<?php
header('Content-Type: application/json');
include("../../config/db.php");

if (isset($_POST['action']) && $_POST['action'] === 'fetch_all_products') {
    $output = '';
    $filter = $_POST['filter'];
    $value = strval($_POST['value']);
    
    if ($filter === 'category') {
        $category_id = $_POST['category_id'];
        $cate_fetch = $conn->prepare("SELECT `subcategory-slug` FROM `subcategory` WHERE `cate_id`=?");
        $cate_fetch->bind_param('i', $category_id);
        
        if ($cate_fetch->execute()) {
            $cate_fetch_result = $cate_fetch->get_result();
            $subcategories = [];
            
            // Fetch subcategory slugs and store them in an array
            while ($row = $cate_fetch_result->fetch_assoc()) {
                $subcategories[] = $row['subcategory-slug'];
            }
            array_push($subcategories,$value);
            
            // If subcategories are found
            if (count($subcategories) > 0) {
                // Create a string of placeholders for the IN clause
                $placeholders = implode(',', array_fill(0, count($subcategories), '?'));

                // Prepare the SQL query
                $sql = $conn->prepare("SELECT * FROM `products` WHERE `category` IN ($placeholders)");

                // Bind the parameters dynamically
                $types = str_repeat('s', count($subcategories)); // 's' for each string parameter
                $sql->bind_param($types, ...$subcategories); // Spread subcategories array into bind_param
            } else {
                // If no subcategories, no products
                $output = "<h4>No product found</h4>";
                echo json_encode(["status" => true, "data" => $output]);
                exit;
            }
        }
    } else {
        // Filter by a single category value
        $sql = $conn->prepare("SELECT * FROM `products` WHERE `category`=?");
        $sql->bind_param('s', $value);
    }
    
    // Execute the query and fetch results
    if ($sql->execute()) {
        $result = $sql->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        if (count($products) > 0) {
            foreach ($products as $pro) {
                $output .= "<div class='col-sm-3'>
                <div class='productCard text-center'>
                        <a href='" . BASE_URL . "singleProduct/" . urlencode($pro['category']) . "/" . $pro['id'] . "' target='_blank' rel='noopener noreferrer'>
                            <img src='" . BASE_URL . 'BackendAssets/assets/images/ProductImages/' . $pro['productimage'] . "'>
                        </a>
                        <h6>" . $pro['productname'] . "</h6>
                        <h6>" . $pro['price'] . "</h6>
                        <div class='row'>
                            <div class='col-sm-6 col-6'>
                                <button class='add-to-cart-btn' product_cart_id='" . $pro['id'] . "'>
                                Add to cart
                                <span style='padding: 0 5px;'><i class='bi bi-cart-check' aria-hidden='true'></i></span>
                                </button>
                            </div>
                            <div class='col-sm-6 col-6'>
                                 <button class='quick-view'><a href='".BASE_URL."singleProduct/".$pro['category']."/".$pro['id'] ."' target='_blank'>Quick View </a></button>
                            </div>
                        </div>
                </div>
                </div>";
            }
        } else {
            $output = "<h4>No product found</h4>";
        }
        echo json_encode(["status" => true, "data" => $output]);
    }
} else {
    echo json_encode(["status" => false]);
}

?>