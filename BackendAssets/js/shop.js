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
    
    get_all_products=($filter,$value,$category_id)=>{
        
        $.ajax({
            type: "POST",
            url: $base_url+"BackendAssets/mysqlcode/shop.php",
            data: {action:"fetch_all_products",filter:$filter,value:$value,category_id:$category_id},
            dataType: "json",
            success: function (response) {
                if(response.status === true)
                {
                    // $(".loader").remove();
                    $(".product-container .row").html(response.data);
                    $(".filter-container-show").on("mouseleave",()=>{
                        const filter_container=document.getElementsByClassName("filter-container");
                        setTimeout(() => {
                            if(filter_container[0].classList.contains("filter-container-show"))
                            {
                                filter_container[0].classList.remove("filter-container-show");
                            }
                        },2000);
                    });
                }
            }
        });
    }
    
    $(".cate-heading").click(function (e) { 
        e.preventDefault();
        // $(".product-container").html("<div class='loader'></div>");
        if($(e.target).attr('category-slug'))
        {
            $value=$(e.target).attr('category-slug');
            $category_id=$(e.target).attr('category-id');
            $filter='category';
        }
        if($(e.target).attr('subcategory-slug'))
            {
                $value=$(e.target).attr('subcategory-slug');
                $filter='subcategory';
                $category_id="";
        }
        get_all_products($filter,$value,$category_id);
        pegination_div_show_hide();
    });

// show hide product pegination according to the product count start from here

    const pegination_div_show_hide = () => {
        
        $count_of_productCard=$(".product-container .productCard").length;
        console.log($count_of_productCard)
    
        if($count_of_productCard <= 16)
        {
            $(".pegination-div").css("display","none");
        }
        else
        {
            $(".pegination-div").css("display","block");
        }

    }

    // $all_data=$(".productCard").length;
    // $product_div=$(".productCard");
    // $data_per_page=10;
    // $page_number=1;
    // $pegination_show=Math.ceil($all_data/$data_per_page);
    // const display_record = () =>{
    //     $start_index=($page_number - 1) * $data_per_page;
    //     $end_index=$start_index + ($data_per_page - 1);
    //     for($i=$start_index;$i<=$end_index;$i++)
    //     {
    //         console.log($product_div[$i]);
    //     }
    // }
    // display_record();

    // end here

});