
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    // Razorpay credentials
    $keyId = 'rzp_live_OyvHUvi3gQtHGd';
    $secret = 'cAMKEYNQcJ1Ca0VhVkO2PSNA';

    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Ensure amount is provided in the request
    if (!isset($data['amount'])) {
        echo json_encode(['error' => 'Amount is required']);
        exit;
    }

    $amount = (int)$data['amount'];
    $currency = 'INR';

    // Initialize cURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$keyId:$secret");

    // Prepare the order data
    $postData = [
        'amount' => $amount,
        'currency' => $currency,
        'receipt' => 'receipt#1' // Optional: Add a receipt ID
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($postData))
    ]);

    // Execute cURL request
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        // Handle error
        echo json_encode(['error' => $err]);
    } else {
        // Send back the order response
        $data = json_decode($response, true);
        if (isset($data['id'])) {
            $order_id = $data['id'];
            echo json_encode(['order_id' => $order_id]);
        } else {
            echo json_encode(['error' => 'Order creation failed']);
        }
    }
} else {
    echo "<h4>Something went wrong with order ID generation</h4>";
}
?>
