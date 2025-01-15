<?php
include "../../config/db.php";
$baseurl=BASE_URL;

if (isset($_POST['category']) && isset($_POST['cateSubmit'])) {
    
    $category = $_POST['category'];
    $category_slug=strtolower(str_replace(" ","-",$category));

    $msg;
    $sql = "SELECT * FROM `category` WHERE `category` = '$category'";
    $result = mysqli_query($conn, $sql);
    $numrow = mysqli_num_rows($result);
    if ($numrow === 0) {
        $sql = "INSERT INTO `category`(`category`, `category-slug`) VALUES ('$category','$category_slug')";
        if ($conn->query($sql)) {
            $msg = "Category added";
        }
    }
    else
    {
        $msg = "Category already exists";
    }
    $conn->close();
    header("Location: ".$baseurl."add?msg=". $msg);
    exit();
}
else if(isset($_POST['subcategory_submit']))
{
    $cateid=$_POST['cateid'];
    $subcategory=$_POST['subcategory'];
    $subcategory_slug=strtolower(str_replace(" ","-",$subcategory));
    $msg;
    
    $check_Subcategory=$conn->prepare("SELECT * FROM `subcategory` WHERE `subcategory`='$subcategory'");
    if($check_Subcategory->execute())
    {
        $check_Subcategory_result=$check_Subcategory->get_result();
        if((int)$check_Subcategory_result->num_rows === 0)
        {
            $check_Subcategory->close();
            $insert_Sebcategory=$conn->prepare("INSERT INTO `subcategory`(`cate_id`, `subcategory`,`subcategory-slug`) VALUES (?,?,?)");
            $insert_Sebcategory->bind_param('iss',$cateid,$subcategory,$subcategory_slug);
            if($insert_Sebcategory->execute())
            {
                $msg="Subcategory Inserted Successfully";
                $insert_Sebcategory->close();
            }
            else
            {
                $msg="Subcategory not Inserted";
            }
        }
        header("Location: ".$baseurl."add?msg=$msg");
        exit();
    }
    else
    {
        echo "Subcategory check sql gives error";
    }
}
else if(isset($_GET['function']) && $_GET['function'] === 'update_category_and_subcategory')
{
    $table=$_GET['table'];
    $id=$_GET['id'];
    $msg;

    if($table === 'category')
    {
        $fetch_category_details=$conn->prepare("SELECT * FROM `category` WHERE id=?");
        $fetch_category_details->bind_param('i',$id);
        if($fetch_category_details->execute())
        {
            $cate=$fetch_category_details->get_result()->fetch_array(MYSQLI_ASSOC);
            ?>
            <div style="display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background: lavender;
                        width: 100%;">
                <form action="./addcategory.php" method="post" enctype="multipart/form-data" style="padding: 20px 10px;
                                                                                                    box-shadow: 0 0 6px 0px #c2c2f3;
                                                                                                    border-radius: 10px;">
                    <label for="cate_update_value">Category Name</label><br>
                    <input type="text" name="cate_update_value" id="cate_update_value" value="<?=$cate['category']?>"><br><br>
                    <input type="hidden" name="cate_update_id" value="<?=$id?>">
                    <button type="submit" name="cate_update">Update</button>
                </form>
            </div>
            <?php
        }

    }
    else
    {
        $fetch_subcategory_details=$conn->prepare("SELECT * FROM `subcategory` WHERE subcategory_id=?");
        $fetch_subcategory_details->bind_param('i',$id);
        if($fetch_subcategory_details->execute())
        {
            $subcate=$fetch_subcategory_details->get_result()->fetch_array(MYSQLI_ASSOC);
            ?>
            <div style="display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background: lavender;
                        width: 100%;">
                <form action="./addcategory.php" method="post" style="padding: 20px 10px;
                                                                      box-shadow: 0 0 6px 0px #c2c2f3;
                                                                      border-radius: 10px;">
                    <input type="text" name="subcate_update_value" value="<?=$subcate['subcategory']?>">
                    <input type="hidden" name="subcate_update_id" value="<?=$id?>">
                    <button type="submit" name="subcate_update">Update</button>
                </form>
            </div>
            <?php
        }
    }
}
else if(isset($_GET['function']) && $_GET['function'] === 'delete_category_and_subcategory')
{
    $table=$_GET['table'];
    $id=$_GET['id'];
    $msg;
    
    if($table === 'category')
    {
        $check_Cate=$conn->prepare("SELECT cate_id FROM `subcategory` WHERE cate_id=$id");
        if($check_Cate->execute())
        {
            if((int)$check_Cate->get_result()->num_rows === 0)
            {
                $sql=$conn->prepare("DELETE FROM `category` WHERE id=?");
                $sql->bind_param('i',$id);
                if($sql->execute())
                {
                    $msg=urlencode("Category deleted successfully");
                    $sql->close();
                }
                else
                {
                    $msg=urlencode("Category not deleted");
                }
            }
            else
            {
                $msg="Category store some subcategories";
            }
        }
        else 
        {
            $msg="Category check sql failed";
        }
    }
    else
    {
        $sql=$conn->prepare("DELETE FROM `subcategory` WHERE subcategory_id=?");
            $sql->bind_param('i',$id);
            if($sql->execute())
            {
                $msg=urlencode("Subcategory deleted successfully");
                $sql->close();
            }
            else
            {
                $msg=urlencode("Subcategory not deleted");
            }

    }
    header("Location: ".$baseurl."/add?msg=$msg");
    exit();
}
else if(isset($_POST['cate_update']))
{
    $cate_update_value=$_POST['cate_update_value'];
    $cate_update_slug=strtolower(str_replace(" ","-",$cate_update_value));
    $cate_update_id=$_POST['cate_update_id'];
    $msg;

    $cate_update=$conn->prepare("UPDATE `category` SET `category`=?,`category-slug`=? WHERE id=?");
    $cate_update->bind_param('ssi',$cate_update_value,$cate_update_slug,$cate_update_id);
    if($cate_update->execute())
    {
        $msg="Category updated successfully";
    }
    else
    {
        $msg="Category updation failed";
    }
    $cate_update->close();
    header("Location: ".$baseurl."add?msg=$msg");
    exit();

}
else if(isset($_POST['subcate_update']))
{
    $subcate_update_value=$_POST['subcate_update_value'];
    $subcate_upate_slug=strtolower(str_replace(" ","-",$subcate_update_value));
    $subcate_update_id=$_POST['subcate_update_id'];
    $msg;

    $subcate_update=$conn->prepare("UPDATE `subcategory` SET `subcategory`=?,`subcategory-slug`=? WHERE subcategory_id=?");
    $subcate_update->bind_param('ssi',$subcate_update_value,$subcate_upate_slug,$subcate_update_id);
    if($subcate_update->execute())
    {
        $msg="Subcategory updated successfully";
    }
    else
    {
        $msg="Subcategory updation failed";
    }
    $subcate_update->close();
    header("Location: ".$baseurl."add?msg=$msg");
    exit();
}
