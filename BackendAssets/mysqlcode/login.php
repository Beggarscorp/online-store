<?php
require("../Components/forsession.php");
include("../../config/db.php");
$baseurl=BASE_URL;

$email = isset($_POST['email']) ? $_POST['email'] : '';

$password = isset($_POST['password']) ? $_POST['password'] : '';

$msg="";

if($email != '' && $password != ""){

    if(!isset($_SESSION['user']))

    {

    $sql="SELECT * FROM `user` WHERE `email` = '$email'";

    $result = mysqli_query($conn, $sql);

    $userdata=mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) === 1){

        if((int)$userdata['user_verified'] === 1)
        {

    
            if(password_verify($password,$userdata['password']))
    
            {
                $_SESSION["user"] = $userdata['First_name'];
                $_SESSION["id"]= $userdata['id'];
    
                header("Location: ".$baseurl."shop.php");
    
                exit();
            }
            else
            {
                $msg="Credential wrong";
    
                header("Location: ".$baseurl."login.php?msg=".$msg);
    
                exit();
            }
        }
        else
        {
            $msg="Your email not verified";

            header("Location: ".$baseurl."login.php?msg=".$msg);

            exit();
        }
    }       
    else
    {
        $msg="Email or password wrong";

        header("Location: ".$baseurl."login.php?msg=".$msg);

        exit();
    }
    }
    else
    {
        $msg="User already exists";

        header("Location: ".$baseurl."shop.php?msg=".$msg);

        exit();
    }
}
elseif($email = '' || $password = ""){

    $msg="Put credential";

    header("Location: ".$baseurl."login.php?msg=".$msg);

    exit();
}

?>