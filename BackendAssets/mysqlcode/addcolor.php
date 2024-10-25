
<?php
include "../../config/db.php";
$baseurl=BASE_URL;

if(isset($_POST['product_color_submit']))
{
    $color=$_POST['product-color'];
    $fetch_color_sql=$conn->prepare("SELECT * FROM `product_color` WHERE color='$color'");
    if($fetch_color_sql->execute())
    {
        if((int)$fetch_color_sql->get_result()->num_rows === 0)
        {
            $sql=$conn->prepare("INSERT INTO `product_color`(`color`) VALUES (?)");
            $sql->bind_param('s',$color);
            if($sql->execute())
            {
                $msg="Color inserted in a table";
            }
            else
            {
                $msg="Color not inserted in a table";
            }

        }
        else
        {
            $msg="Color already in table";
        }
        header("Location: ".$baseurl."add?msg=$msg");
        exit();
    }
    else
    {
        $msg="color query not work";
        header("Location: ".$baseurl."add?msg=$msg");
        exit();
    }
}
else if(isset($_GET['function']) && $_GET['function'] === 'update_color')
{
    ?>
    <form action="./addcolor.php" method="post">
        <input type="text" name="color_text" value="<?=$_GET['color']?>">
        <input type="hidden" name="color_id" value="<?=$_GET['id']?>">
        <button type="submit" name="update_color">Update color</button>
    </form>
    <?php
}
else if(isset($_GET['function']) && $_GET['function'] === 'delete_color')
{
    $col_id=$_GET['id'];
    $msg;

    $delete_color=$conn->prepare("DELETE FROM `product_color` WHERE color_id=?");
    $delete_color->bind_param('i',$col_id);
    
    if($delete_color->execute())
    {
        $msg="Color deleted successfully";
    }
    else
    {
        $msg="Color deletion failed";
    }
    $delete_color->close();
    header("Location: ".$baseurl."add?msg=$msg");
    exit();
}
else if(isset($_POST['update_color']))
{
    $color=$_POST['color_text'];
    $color_id=$_POST['color_id'];
    $msg;

    $update_color_sql=$conn->prepare("UPDATE `product_color` SET `color`=? WHERE color_id=?");
    $update_color_sql->bind_param('si',$color,$color_id);

    if($update_color_sql->execute())
    {
        $msg="Color updated successfully";
    }
    else
    {
        $msg="Color updation failed";
    }
    $update_color_sql->close();
    header("Location: ".$baseurl."add?msg=$msg");
    exit();
}
?>