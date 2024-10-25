
<link rel="stylesheet" href="../BackendAssets/css/pop.css">
<div class="popup_main_box">
    <div class="popup_inner_box">
        <i class="bi bi-x-square-fill"></i>
        <h3></h3>
    </div>
</div>
<script>
    const popup_main_box = document.getElementsByClassName("popup_main_box");
    const popup_inner_box = document.getElementsByClassName("popup_inner_box");
    const cross_icon = document.querySelector(".popup_inner_box i");
    const msgh3 = document.querySelector(".popup_inner_box h3");


    window.popupshow = (msg) => {
        popup_main_box['0'].style.transform = "translateY(0)";
        msgh3.innerText = msg;
    }

    cross_icon.addEventListener("click", () => {
        popup_main_box['0'].style.transform = "translateY(-200%)";
    })
    popup_main_box[0].addEventListener("click", () => {
        popup_main_box['0'].style.transform = "translateY(-200%)";
    })
</script>
<?php
function popupshow($msg)
{
    ?>
    <script>
        popupshow("<?=$msg?>");
    </script>
    <?php
}
?>