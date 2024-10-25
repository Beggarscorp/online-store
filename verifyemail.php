
<?php
include("./BackendAssets/db.php");

$user_id=$_GET['id'];

// check email verify or not

$sql="SELECT * FROM `user` WHERE id=$user_id AND user_verified=0";
$result=mysqli_num_rows(mysqli_query($conn,$sql));

if(isset($user_id) && $result === 1)
{
    $verifyEmailSql="UPDATE `user` SET `user_verified`='1' WHERE id=$user_id";
    $verifyEmailSqlResult=mysqli_query($conn,$verifyEmailSql);

    if($verifyEmailSqlResult)
    {
        $msg="Your email verified";
        header("Location: /login.php?msg=$msg");
        exit();
    }
    else
    {
        $msg="Your email not verified something gone wrong";
        header("Location: /signup.php?msg=$msg");
        exit();
    }
}
else
{
    $msg="Something gone wrong";
    header("Location: signup.php?msg=$msg");
    exit();
} 

?>