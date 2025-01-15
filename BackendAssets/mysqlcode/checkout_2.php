<?php
include("../../config/db.php");
$msgnumber;

session_start();

if (isset($_SESSION['user'])) {
    
    $user_id = $_SESSION['id'];
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usernumber = $_POST['usernumber'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $userpincode = $_POST['userpincode'];
    $useraddress = $_POST['useraddress'];
    $product_id_and_quantity = $_POST['product_id_and_quantity'] === 'proceed_to_checkout' ? $_POST['product_id_and_quantity'] . "_data" : $_POST['product_id_and_quantity'];
    $razorpay_payment_id = "odfgh549";
    $razorpay_order_id = "sdf34534";
    $razorpay_signature = "soih094khrdg";
    $totalPrice;
    $order_status = 0;
    
    

    if ($username != "" && $useremail != "" && $usernumber != "" && $country != "" && $state != "" && $city != "" && $userpincode != "" && $useraddress != "") {
        $product_id;
        $product_count;
        $product_key;
        if ($product_id_and_quantity === 'cart') {
            
            for ($p = 0; $p < count($_SESSION[$product_id_and_quantity]); $p++) {
                
                $product_id = $_SESSION[$product_id_and_quantity][$p]['product_id'];
                $product_count = $_SESSION[$product_id_and_quantity][$p]['product_count'];

                $totalPrice=$_POST['total_price_input'];

                $order_sql = $conn->prepare("INSERT INTO `orders` (`userid`, `productid`, `productquantity`, `username`, `usercountry`, `useremail`, `usernumber`, `userstate`, `usercity`, `userpincode`, `useraddress`, `totalprice`, `order_status`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $order_sql->bind_param('iiisssissisiisss', $user_id, $product_id, $product_count, $username, $country, $useremail, $usernumber, $state, $city, $userpincode, $useraddress, $totalPrice, $order_status, $razorpay_payment_id, $razorpay_order_id, $razorpay_signature);
                if ($order_sql->execute()) {
                    $msgnumber = 1;
                } else {
                    $msgnumber = 5;
                }
            }
            
        } 
        else 
        {
            $product_detail = [];
            $product_key;
            for ($p = 0; $p < count($_SESSION[$product_id_and_quantity]); $p++) {
                $product_detail['product_id'] = $_SESSION[$product_id_and_quantity][$p]['id'];
                $product_detail['product_qty'] = $_SESSION[$product_id_and_quantity][$p]['0'];
            }
            $product_id = $product_detail['product_id'];
            $product_count = $product_detail['product_qty'];
            $totalPrice=$_POST['ptc_total_price_input'];

            $order_sql=$conn->prepare("INSERT INTO `orders` (`userid`, `productid`, `productquantity`, `username`, `usercountry`, `useremail`, `usernumber`, `userstate`, `usercity`, `userpincode`, `useraddress`, `totalprice`, `order_status`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $order_sql->bind_param('iiisssissisiisss',$user_id,$product_id,$product_count,$username,$country,$useremail,$usernumber,$state,$city,$userpincode,$useraddress,$totalPrice,$order_status,$razorpay_payment_id,$razorpay_order_id,$razorpay_signature);
            if($order_sql->execute())
            {
                $msgnumber=1;
            }
            else
            {
                $msgnumber=5;
            }

        }
    } else {
        $msgnumber = 2;
    }

}
else 
{
    $msgnumber = 4;
}

header("Location: ".BASE_URL."checkout/$msgnumber");
exit();

?>