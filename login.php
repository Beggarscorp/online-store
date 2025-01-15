<?php
ob_start();
require_once 'vendor/autoload.php';
include 'BackendAssets/Components/header.php';
if(!isset($_SESSION['user']))
{

include("config/google_config.php");
if(isset($_GET['code']))
{
  $token=$google_client->fetchAccessTokenWithAuthCode($_GET['code']);

  if(!isset($token['error']))
  {
    $google_client->setAccessToken($token['access_token']);

    $_SESSION['google_access_token']=$token['access_token'];

    $google_service= new Google_Service_Oauth2($google_client);

    $user_data=$google_service->userinfo->get();

    if(!empty($user_data['given_name']) && !empty($user_data['email']))
    {

    function randomPassword() {

      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

      for ($i = 0; $i < 8; $i++) {

          $n = rand(0, $alphaLength);

          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
    }

    $hashPassword=password_hash(randomPassword(),PASSWORD_DEFAULT);

    $name=$user_data['given_name'];

    $email=$user_data['email'];

    $last_name="";

    $user_verified=1;

    $user_image="";

    //INSERT INTO `user`(`First_name`, `Last_name`, `email`, `password`, `user_verified`, `user_image`) VALUES ('Team Begga','','beggarscorpoffice@gmail.com','$2y$10$noQkW1nzGQeB93o8yyuFdebiFDVZa5ePx9.jgEWMm/WnLMYtdKfDi','1','') ON DUPLICATE KEY UPDATE `First_name`='Team Begga',`Last_name`='',`email`='beggarscorpoffice@gmail.com',`password`='$2y$10$noQkW1nzGQeB93o8yyuFdebiFDVZa5ePx9.jgEWMm/WnLMYtdKfDi',`user_verified`='1',`user_image`='';


      $google_login_user_sql=$conn->prepare("INSERT INTO `user`(`First_name`, `Last_name`, `email`, `password`, `user_verified`, `user_image`) VALUES (?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `First_name`=?,`Last_name`=?,`email`=?,`password`=?,`user_verified`=?");

      $google_login_user_sql->bind_param('ssssisssssi',$name,$last_name,$email,$hashPassword,$user_verified,$user_image,$name,$last_name,$email,$hashPassword,$user_verified);

      if($google_login_user_sql->execute())
      {
          
        $_SESSION['id']=$google_login_user_sql->insert_id;

        $_SESSION['user']=$user_data['given_name'];

        header("Location: ".BASE_URL."shop");
      }
      else
      {
        echo "Query not executed";
      }

    }


  }
}
else
{ 
?>


<div class="main-of-signup signup_bg_image">
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 p-0">
        <div class="text-center small_signup_div">
          <?php
          if (isset($_GET['msg'])) {
            echo "<div class='alert alert-danger' role='alert'>
              " . $_GET['msg'] . "
            </div>";
          }
          ?>
          <h3 style="color:#fff;">Login from here</h3>
          <form action="<?=BASE_URL?>BackendAssets/mysqlcode/login.php" method="post">
            <div>
              <input type="email" name="email" placeholder="Insert your email address here" required style="margin:20px 0 !important;">
            </div>
            <div>
              <input type="password" name="password" placeholder="Insert your password here" required style="margin:20px 0 !important;">
            </div>
            <button type="submit">Login</button>
            <?php
            // if($google_button === 'show')
            // {
            //   ?>
              <a href="<?=$google_client->createAuthUrl()?>">
                <img src="<?=BASE_URL?>BackendAssets/assets/images/google-signin-button.jpg" alt="google-signin-button.jpg" class="w-25" style="border-radius:15px;">
              </a>
              <!-- <?php
            // }
            ?> -->
          </form>
          <div class="forgot_password">
            <a href="<?=BASE_URL?>forgot_password"><span>Forgot password</span></a>&nbsp;
            <a href="<?=BASE_URL?>signup" style="text-decoration: underline !important;font-size:15px;"><span>Create account</span></a>
          </div>
          <div class="continue-as-guest">
            <h2>Cotinue as a guest</h2>
            <a href="<?=BASE_URL?>shop"><button>Continue</button></a>
          </div>
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>
</div>
<?php
}
}
else
{
  echo "<h4 style='padding:0 50px;'>User already logged in 
  <a style='color:var(--golden);text-decoration:underline;' href='".BASE_URL."shop'>Shop now <i class='bi bi-arrow-right-short'></i></a>
  </h4>";
}
ob_end_flush();
include 'BackendAssets/Components/footer.php';
exit();
?>