<?php
include('../../config/db.php');

// if (isset($_POST["place_order"])) {



    $name = $_POST["username"];
    $email = $_POST["useremail"];
    $number = $_POST["usernumber"];
    $userid = $_POST['useridforstoreindatabase'];
    $usercountry=$_POST['country'];
    $userstate = $_POST["state"];
    $usercity = $_POST["city"];
    $userpincode = $_POST["userpincode"];
    $useraddress = $_POST["useraddress"];
    $totalPrice = $_POST["totalPrice"];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $razorpay_signature = $_POST['razorpay_signature'];
    $productidandquantity = $_POST['productidandquantity'];

    if ($name != "" && $email != "" && $number != "" && $usercountry != "" && $userstate != "" && $usercity != "" && $userpincode != "" && $useraddress != ""  && $userid != "" && $userid != "" && $totalPrice != "" && $productidandquantity != "" && $razorpay_payment_id != "" && $razorpay_order_id != "" && $razorpay_signature != "") {

        $productId = explode(',', rtrim(json_decode($productidandquantity)->productid, ','));

        $productQty = explode(',', rtrim(json_decode($productidandquantity)->productquantity, ','));

        // Step 1: Prepare and execute the count query safely
    $sqladdressCount = $conn->prepare("SELECT COUNT(*) AS count FROM `user_default_address_table` WHERE user_id = ?");
    $sqladdressCount->bind_param('i', $userid);
    $sqladdressCount->execute();
    $result = $sqladdressCount->get_result();
    $addressCount = $result->fetch_assoc();
    $sqladdressCount->close();


    // Step 3: Check the count and insert if necessary
    if ((int)$addressCount['count'] === 0) {
        // echo "No address found. Inserting default address.";

        // Step 4: Prepare the insert statement without quotes around placeholders
        $insertAddressSql = $conn->prepare("INSERT INTO `user_default_address_table`(`user_id`, `Name`, `email`, `phone_number`, `country`, `state`, `city`, `pincode`, `address`) VALUES (?,?,?,?,?,?,?,?)");

        // Step 5: Check if the preparation was successful
        if ($insertAddressSql === false) {
            // echo "Error preparing insert statement: " . $conn->error;
        } else {

            // Step 6: Bind parameters correctly
            $insertAddressSql->bind_param('ississsis', $userid, $name, $email, $number, $usercountry, $userstate, $usercity, $userpincode,$useraddress);

            // Step 7: Execute and check for errors
            if (!$insertAddressSql->execute()) {
                // echo "Default Address not inserted: " . $insertAddressSql->error;
            } else {
                // echo "Default Address inserted successfully!";
            }

            // Step 8: Close the statement
            $insertAddressSql->close();
        }
    }

        $success = true;

        for ($pq = 0; $pq < count($productId); $pq++) {
            $proID = $productId[$pq];
            $proQTY = $productQty[$pq];

            $stmt = $conn->prepare("INSERT INTO `orders` (`userid`, `productid`, `productquantity`, `username`, `usercountry`, `useremail`, `usernumber`, `userstate`, `usercity`, `userpincode`, `useraddress`, `totalprice`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                // ON DUPLICATE KEY UPDATE `productquantity` = VALUES(`productquantity`)

            $stmt->bind_param('iiisssissisisss', $userid, $proID, $proQTY, $name,
            $usercountry, $email, $number, $userstate, $usercity, $userpincode, $useraddress, $totalPrice, $razorpay_payment_id, $razorpay_order_id, $razorpay_signature);

            if (!$stmt->execute()) {
                $success = false;
                break; // Exit loop on failure
            }
        }

        if ($success) {
            header("Location: /order.php?order=successful");
        } else {
            header("Location: /checkout.php?order=failed");
        }

        exit();
    }
    else
    {
        echo "NOt get values";
    }
// }
?>