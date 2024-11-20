    document.addEventListener("DOMContentLoaded", () => {

        const pegilist = document.querySelectorAll(".pegination-div ul li");
        for (const i of pegilist) {
            i.addEventListener("click", (e) => {
                window.location.href = "?page=" + e.target.innerText;
            })
        }
        //     const productcard=document.getElementsByClassName("productCard");
        //     let productele=[];
        //     for (const e of productcard) {
        //         productele.push(e);
        //     }
        //     let timePeriod=0;
        //     let st=setInterval(()=>{
        //         if(timePeriod <= productele.length)
        //     {
        //         putanimationinproductcard();
        //     }
        //     else
        //     {
        //         clearInterval(st);
        //     }
        // },300);
        //     const putanimationinproductcard=()=>{
        //         productele[timePeriod].classList.add("productCard-animation");
        //         timePeriod++;
        //         console.log("Hello world");
        //     }
        
        // filter show hide for mobile device start from here
        
        const filter_main_head=document.getElementsByClassName("filter-main-head");
        const filter_container=document.getElementsByClassName("filter-container");
        filter_main_head[0].addEventListener("click",()=>{
            filter_container[0].classList.toggle("filter-container-show");
        })
        
        // end here
    
    // video pop up close video code start from here
    
    const close_video=(e)=>{
        let video_tag=document.getElementById("our_product_show_video");
        video_tag.pause();
    }
    
    // end here
});


$(document).ready(function () {
    
    get_all_products=($filter,$value)=>{
        
        $.ajax({
            type: "POST",
            url: $base_url+"BackendAssets/mysqlcode/shop.php",
            data: {action:"fetch_all_products",filter:$filter,value:$value},
            dataType: "json",
            success: function (response) {
                if(response.status === true)
                {
                    // $(".loader").remove();
                    $(".product-container .row").html(response.data);
                }
            }
        });
    }
    
    $(".cate-heading").click(function (e) { 
        e.preventDefault();
        // $(".product-container").html("<div class='loader'></div>");
        $value=$(e.target).text().toLowerCase();
        $filter='category';
        get_all_products($filter,$value);
    });
    // get_all_products();

});