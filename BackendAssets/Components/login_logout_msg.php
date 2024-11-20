<?php

if (isset($_SESSION['user'])) {
    unset($_SESSION['logout_toast']);
    if(!isset($_SESSION['login_toast']))
    {
?>
    <div class="toast position-fixed top-0 end-0 p-3 bg-transparent border-0 shadow-none" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-light">
            <strong class="me-auto "><?=$_SESSION['user'] ?> you have successfully logged in</strong>
            <small>1 sec ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
<?php
$_SESSION['login_toast']=true;
    }
} 
else 
{
    unset($_SESSION['login_toast']);
    if(!isset($_SESSION['logout_toast']))
    {
?>
    <div class="toast position-fixed top-0 end-0 p-3 bg-transparent border-0 shadow-none" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-light">
            <strong class="me-auto">You are currently not logged in</strong>
            <small>1 sec ago</small>
            <button type="button" class="btn-close mx-2 bg-transparent" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
<?php
$_SESSION['logout_toast']=true;
    }
}

?>