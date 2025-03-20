<?php
session_start();
include("../../config/db.php");
$msgnumber;



function insert_checkout_date_in_table ($conn,$user_id,$username, $country, $useremail, $usernumber, $state, $city, $userpincode, $useraddress,$razorpay_payment_id,$razorpay_order_id,$razorpay_signature) {
    
    $product_id_and_quantity = $_POST['product_id_and_quantity'];
    $order_status = 0;
    $total_price=78987;
        
        if($product_id_and_quantity === 'cart')
        {
            for ($p = 0; $p < count($_SESSION[$product_id_and_quantity]); $p++) {
                
                $product_id = $_SESSION[$product_id_and_quantity][$p]['product_id'];
                $product_count = $_SESSION[$product_id_and_quantity][$p]['product_count'];
                
                $insert_oreder_data=$conn->prepare("INSERT INTO `orders` (`userid`, `productid`, `productquantity`, `username`, `usercountry`, `useremail`, `usernumber`, `userstate`, `usercity`, `userpincode`, `useraddress`, `totalprice`, `order_status`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_oreder_data->bind_param('iiisssissisiisss', $user_id, $product_id, $product_count, $username, $country, $useremail, $usernumber, $state, $city, $userpincode, $useraddress,$order_status,$total_price,$razorpay_payment_id,$razorpay_order_id,$razorpay_signature);
                
                if($insert_oreder_data->execute())
                {
                    $msgnumber=1;
                }
                else
                {
                    $msgnumber=5;
                    $insert_oreder_data->close();
                    header("Location: ".BASE_URL."checkout?msg=".$msgnumber);
                    exit();
                }
            }  
            $insert_oreder_data->close();
            header("Location: ".BASE_URL."checkout?msg=".$msgnumber);
            exit();
            
        }
        if($product_id_and_quantity === 'proceed_to_checkout')
        {
            $product_id = $_SESSION['proceed_to_checkout'][0]['product_id']."<br>";
            $product_count = $_SESSION['proceed_to_checkout'][0]['product_count'];
            $insert_oreder_data=$conn->prepare("INSERT INTO `orders` (`userid`, `productid`, `productquantity`, `username`, `usercountry`, `useremail`, `usernumber`, `userstate`, `usercity`, `userpincode`, `useraddress`, `totalprice`, `order_status`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $insert_oreder_data->bind_param('iiisssissisiisss', $user_id, $product_id, $product_count, $username, $country, $useremail, $usernumber, $state, $city, $userpincode, $useraddress,$order_status,$total_price,$razorpay_payment_id,$razorpay_order_id,$razorpay_signature);
            if($insert_oreder_data->execute())
            {
                $msgnumber=1;
            }
            else
            {
                $msgnumber=5;
            }
            $insert_oreder_data->close();
            header("Location: ".BASE_URL."checkout?msg=".$msgnumber);
            exit();
        }
    }  


    $username = $_POST['username'] != "" ? $_POST['username'] : "";
    $useremail = $_POST['useremail'] != "" ? $_POST['useremail'] : "";
    $usernumber = $_POST['usernumber'] != "" ? $_POST['usernumber'] : "";
    $country = $_POST['country'] != "" ? $_POST['country'] : "";
    $state = $_POST['state'] != "" ? $_POST['state'] : "";
    $city = $_POST['city'] != "" ? $_POST['city'] : "";
    $userpincode = $_POST['userpincode'] != "" ? $_POST['userpincode'] : "";
    $useraddress = $_POST['useraddress'] != "" ? $_POST['useraddress'] : "";
    $razorpay_payment_id=$_POST['razorpay_payment_id'] != "" ? $_POST['razorpay_payment_id'] : "";
    $razorpay_order_id=$_POST['razorpay_order_id'] != "" ? $_POST['razorpay_order_id'] : "";   
    $razorpay_signature=$_POST['razorpay_signature'] != "" ? $_POST['razorpay_signature'] : "";

if ($username != "" && $useremail != "" && $usernumber != "" && $country != "" && $state != "" && $city != "" && $userpincode != "" && $useraddress != "" && $razorpay_payment_id != "" && $razorpay_order_id != "" && $razorpay_signature != "") 
{
    $user_id=123;
    // isset($_SESSION['user_id'])
    if($user_id != "")
    {
        // $user_id = $_SESSION['user_id'];
        insert_checkout_date_in_table($conn,$user_id,$username, $country, $useremail, $usernumber, $state, $city, $userpincode, $useraddress,$razorpay_payment_id,$razorpay_order_id,$razorpay_signature);
    }
    else
    {
        header("Location: ".BASE_URL."signup");
        exit();
    }

}
else
{
    $msgnumber = 2;
    header("Location: ".BASE_URL."checkout?msg=".$msgnumber);
    exit();
}

?>
