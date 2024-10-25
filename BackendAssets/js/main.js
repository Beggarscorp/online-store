document.addEventListener("DOMContentLoaded",()=>{

    const sidebar=document.getElementsByClassName("sidebar");
    const cart_icon=document.getElementById("cart_icon");
    const sidebar_blank_area=document.getElementsByClassName("sidebar_blank_area");
    cart_icon.addEventListener("click",()=>{
        sidebar[0].classList.toggle("sidebar_show");
        if(sidebar[0].classList.contains("sidebar_show"))
        {
            document.body.style.overflow = 'hidden';
        }
        else
        {
            document.body.style.overflow = 'inherit';
        }
    })
    sidebar_blank_area[0].addEventListener("click",()=>{
        sidebar[0].classList.remove("sidebar_show");
        document.body.style.overflow = 'inherit';
    })

    let c=0;
    window.addEventListener("scroll",()=>{
        let header=document.getElementsByTagName("header");
        let header_second=document.getElementsByClassName("header_second");
        let second_header_a=document.querySelectorAll(".header_second ul a");
        for(a=0;a<second_header_a.length;a++)
        {
            second_header_a[a].style.color="#fff";
        }
        
        if(window.scrollY > 200)    
        {
            header[0].classList.add("header_show");
            header_second[0].classList.add("second_header_change");
        }
        else if(window.scrollY < 200)
        {
            header[0].classList.remove("header_show");
            header_second[0].classList.remove("second_header_change");
            for(a=0;a<second_header_a.length;a++)
                {
                    second_header_a[a].style.color="#000";
                }

        }   
    })

});

$(document).ready(()=>{

    $base_url='http://localhost/online-store/';

    // increase cart product quantity 

    $('.plus_icon').on("click",(e)=>{

        $cart_product_id=e.currentTarget.attributes.cart_product_id.value;
        
        $.ajax({
            url:$base_url+"/BackendAssets/mysqlcode/addtocart.php",
            type:'POST',
            data:{product_id:$cart_product_id},
            datatype:'json',
            success:(response)=>{
                if(response.status === 'success')
                {
                    $(e.currentTarget).next().text(response.quantity);
                    count_product_price(e.currentTarget,'next');
                }
            },
            error:(error)=>
            {
                alert(error);
            }
        })
    })

    // end here


    // decrease cart product quantity

    $('.minus_icon').on("click",(e)=>{

        $cart_product_id=e.currentTarget.attributes.cart_product_id.value;

        $.ajax({
            url:$base_url+"/BackendAssets/mysqlcode/removecart.php",
            type:'POST',
            data:{product_id:$cart_product_id},
            datatype:'json',
            success:(response)=>{
                if(response.status === 'success')
                {
                    if(response.quantity === 0)
                    {
                        $(e.currentTarget).parent().parent().parent().css({"display":"none"});
                    }
                    else
                    {
                        $(e.currentTarget).prev().text(response.quantity);
                        count_product_price(e.currentTarget,'prev');
                    }
                }
            },
            error:(error)=>
            {
                alert(error);
            }
        })

    })

    // end here

    // add-to-cart product from add-to-cart button

    $(".add-to-cart-btn").on("click",(e)=>{
        
        $cart_product_id=$(e.currentTarget).attr("product_cart_id");
    
        $.ajax({
            url:$base_url+"BackendAssets/mysqlcode/addtocart.php",
            type:'POST',
            data:{add_to_cart_product_id:$cart_product_id},
            datatype:'json',
            success:(response)=>{
                if(response.status === 'success')
                {
                    alert("Product Added to cart");
                }
            },
            error:(error)=>{
                console.log(error);
            }
        })
    })

    // end here
    
    // this function for count product price from his quantity change

    count_product_price=(ele,from)=>{
        if(from === 'prev')
        {
            let value=($(ele).prev().text())*($(ele).next().attr('price'));
            $(ele).next().children().text(value);
        }
        else
        {
            let value=($(ele).next().text())*($(ele).next().next().next().attr('price'));
            $(ele).next().next().next().children().text(value);
        }
    }

    // end here
    
})
    
