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
            <h3 style="color: #fff;">Sign up from here</h3>
            <form action="BackendAssets/mysqlcode/signup.php" method="post">
              <div>
                <input type="text" name="fname" placeholder="First name here" required>
              </div>
              <div>
                <input type="text" name="lname" placeholder="Last name here" required>
              </div>
              <div>
                <input type="email" name="email" placeholder="Email address here" pattern="[a-zA-Z0-9._%+-]+@gmail\.com" required>
              </div>
              <div>
                <input type="password" name="password" id="signup_password_field" placeholder="Password here" required>
                <i class="bi bi-eye" id="signup_password_field_icon"></i>
              </div>
              <button type="submit" name="user_submit">Sign up</button>
              <div style="color:#dcdcdc;">
              <?php
              if(isset($_GET['verify']))
              {
                echo $_GET['verify'];
              }
              ?>
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

  <?php
  include("BackendAssets/Components/footer.php");
  ?>