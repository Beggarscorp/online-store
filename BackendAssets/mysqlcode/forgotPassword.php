
<?php
include('../../config/db.php');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$email = $data['email'] ?? null;
// echo json_encode([]);  


$sql="SELECT * FROM `user` WHERE `email` = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    echo json_encode(['email' => $email,"msg"=>"Email matched"]);
} 
else
{
    echo json_encode(["msg"=> "Email wrong"]);
}

if(isset($_POST["change_password"]))
{
    $email=$_POST['password_change_email'];
    $password=$_POST['password_change_password'];
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    if($email != "" && $password != "" && $hashPassword)
    {
        $sql="UPDATE `user` SET  `password`='$hashPassword' WHERE `email`='$email'";
        if($result = mysqli_query($conn, $sql))
        {
            header("Location: /login.php?msg=password-changed");
            exit();
        }
        else
        {
            header("Location : /forgot_password.php?msg=password-not-changed");
            exit();
        }
    }
}

?>
