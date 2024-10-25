
<?php
include("../../config/db.php");

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM `orders` WHERE orderid=$id";

    if(mysqli_query($conn,$sql))
    {
        header("Location: /order.php?delete=successfully");
        exit();
    }
    else
    {
        header("Location: /order.php?delete=failed");
        exit();
    }
}
else
{
    echo "failed";
}

?>