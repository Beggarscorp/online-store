<?php
include('./BackendAssets/Components/header.php');
include('./config/db.php');

// unset($_SESSION['admin']);
// create new admin user qeury

// INSERT INTO `admin` (`admin_username`, `admin_password`) 
// VALUES ('admin', SHA2('Varanasi#2021', 256));

?>

<style>
     .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: auto;
        }

        .login-container h2 {
            color: #ae6c08;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            color: #9c9c9c;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #dcdcdc;
        }

        .btn-custom {
            background-color: #ae6c08;
            color: white;
        }

        .btn-custom:hover {
            background-color: #9c4f06;
        }

        .text-muted {
            color: #9c9c9c !important;
        }
</style>

<div class="container py-5">
    <div class="login-container">
        <h2>Login</h2>
        <form action="#"  method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                <div class="icon position-absolute" style="right:5px;bottom:5px"><i class="bi bi-eye-fill"></i></div>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
            <!-- <div class="text-center mt-3">
                <a href="#" class="text-muted">Forgot password?</a>
            </div> -->
        </form>
    </div>
</div>
<script>
    let psd_show_hide_icon = document.querySelector('.icon i');

    const password_show_hide = () => {
        let password_input = document.querySelector('#password');
        if(psd_show_hide_icon.classList.contains('bi-eye-fill'))
        {
            password_input.setAttribute('type','text');
            psd_show_hide_icon.classList.remove('bi-eye-fill');
            psd_show_hide_icon.classList.add('bi-eye-slash');
        }
        else
        {
            password_input.setAttribute('type','password');
            psd_show_hide_icon.classList.remove('bi-eye-slash');
            psd_show_hide_icon.classList.add('bi-eye-fill');
        }
    }

    psd_show_hide_icon.addEventListener("click",() => {
        password_show_hide();
    })

</script>

<?php

if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT admin_password FROM admin WHERE admin_username = '$username'";
    $result = mysqli_query($conn, $sql);
    if($result && $result->num_rows > 0)
    {
        $admin_response = mysqli_fetch_assoc($result);
        $hashed_admin_psd = $admin_response['admin_password'];
        if(hash('sha256', $password) === $hashed_admin_psd)
        {
            // session_start();
            $_SESSION['admin'] = $username;
            echo "<script>Swal.fire({title:'Admin logged in successfully',icon:'success'})</script>";
            echo  "<script>window.location.href='./admin'</script>";
            exit();
        }
        else
        {
            echo "<script>alert('Username and password not matched')</script>";
        }
    }
    else
    {
        echo "Admin not available";
    }

}


include('./BackendAssets/Components/footer.php');
?>