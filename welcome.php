<div class="msg">
<?php
session_start();
      if(isset($_GET['msg']))
      {
        echo "<div class='alert alert-success' role='alert'>
              ".$_GET['msg']."
            </div>";
        }
        echo "Welcome " .$_SESSION['user'];
        ?>
</div>

<?php
    if(isset($_SESSION['user']))
    {
        include("shop.php");
    }
?>