<?php
include("BackendAssets/Components/header.php");

?>
<link rel="stylesheet" href="BackendAssets/css/signup.css">
<div class="main-of-signup signup_bg_image">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 p-0 ">
        <div class="text-center small_signup_div">
          <?php
          if (isset($_GET['msg'])) {
            echo "<div class='alert alert-danger' role='alert'>
                      " . $_GET['msg'] . "
                    </div>";
          }
          ?>
          <h3 style="color: #fff;">Change password from here</h3>
          <form action="BackendAssets/mysqlcode/forgotPassword.php" method="post">
            <div>
              <input type="email" name="password_change_email" class="password_change_email" oninput="checkemail(this)" placeholder="Email address here" pattern="[a-zA-Z0-9._%+-]+@gmail\.com" required>
              <span class="email_check_msg"></span>
            </div>
            <div style="position:relative;">
              <input type="password"  name="password_change_password" disabled class="password_change_password" placeholder="Password here" required>
              <span><i class="fa fa-eye" onclick="show_password()" style="color:#b06d09;position:absolute;top:30%;right:2%;cursor:pointer;"></i></span>
            </div>
            <button type="submit" name="change_password">Change password</button>
          </form>
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>
</div>


<script>
  const checkemail = (e) => {
    
    fetch('BackendAssets/mysqlcode/forgotPassword.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({ email: e.value }),
})
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    let email_check_msg=document.getElementsByClassName("email_check_msg");
    email_check_msg[0].innerHTML=data.msg;
    if(data.msg === "Email matched"){
      email_check_msg[0].setAttribute("style","color:green;background-color:#fff;padding:3px 10px;border-radius:10px;font-weight:800;font-family:fangsong;");
      let password_change_password=document.getElementsByClassName("password_change_password");
      password_change_password[0].removeAttribute("disabled");
    }
    else
    {
      email_check_msg[0].setAttribute("style","color:red;background-color:#fff;padding:3px 10px;border-radius:10px;font-weight:800;font-family:fangsong;");
    }
  })
  .catch(error => {
    console.error('There was a problem with your fetch operation:', error);
  });

}


const show_password=()=>{
  
  let password_change_password=document.getElementsByClassName("password_change_password");
  if(password_change_password[0].type == "text")
  {
    password_change_password[0].type='password';
  }
  else
  {
    password_change_password[0].type='text';
  }
}



</script>

<?php
include("BackendAssets/Components/footer.php");
?>