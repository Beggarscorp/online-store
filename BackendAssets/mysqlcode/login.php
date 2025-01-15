<?php
require("../Components/forsession.php");
include("../../config/db.php");
$baseurl=BASE_URL;

$email = isset($_POST['email']) ? $_POST['email'] : '';

$password = isset($_POST['password']) ? $_POST['password'] : '';

$msg="";
$url="";

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
                $url=$baseurl.'shop';
            }
            else
            {
                $msg="Credential wrong";
                $url=$baseurl.'login?msg='.$msg;
            }
        }
        else
        {
            $msg="Your email not verified";
            $url=$baseurl.'login?msg='.$msg;
        }
    }       
    else
    {
        $msg="Email or password wrong";
        $url=$baseurl.'login?msg='.$msg;
    }
    }
    else
    {
        $msg="User already exists";
        $url=$baseurl.'shop?msg='.$msg;
    }
}
elseif($email = "" || $password = ""){

    $msg="Put credential";
    $url=$baseurl.'login?msg='.$msg;
}

echo "<script>window.location.href='$url'</script>";
exit();

?>