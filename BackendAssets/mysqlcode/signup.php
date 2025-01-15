<?php
ob_start();
require('../../config/db.php');
// include('../Components/forsession.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_submit']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    if(!isset($_SESSION['user']) && $fname != "" && $lname != "" && $email != "" && $password != "")
    {
        $sql="SELECT * FROM `user` WHERE `email` = '$email'";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0)
        {
            $hash=password_hash($password, PASSWORD_DEFAULT );
            $sql = "INSERT INTO `user` (`First_name`, `Last_name`,`email`,`password`) VALUES ('$fname', '$lname','$email','$hash')";
            if ($conn->query($sql) === true) {
               
                $last_id=$conn->insert_id;
                header("Location: ../../BackendAssets/mysqlcode/sendmail.php?email=$email&id=$last_id");
                exit();
        }
        else 
        {
            echo $conn->error;
            $msg="Failed";
            header("Location: /signup?msg=$msg");
            exit();
            
        }
    }
    else
    {
        $msg="User already exists";
        header("Location: /signup?msg=$msg");
        exit();
        
      }
      }
      else
      {
        $msg="User already Logged in";
        header("Location: /signup?msg=$msg");
        exit();
      }
}
else
{
    $msg="user not submit";
    header("Location: /signup?msg=$msg");
    exit();
}
ob_end_flush();

?>