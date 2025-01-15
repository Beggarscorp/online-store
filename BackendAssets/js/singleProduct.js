document.addEventListener("DOMContentLoaded",()=>{
   
    const imagediv = document.getElementsByClassName("productImg");
        imagediv[0].addEventListener("mousemove", (e) => {
            imagediv[0].style.setProperty('--opacity', '1');
            imagediv[0].style.cursor = "zoom-in";
            let pointer = {
                x: (e.offsetX * 100) / imagediv[0].offsetWidth,
                y: (e.offsetY * 100) / imagediv[0].offsetHeight
            }
            imagediv[0].style.setProperty('--zoom-x', pointer.x + '%');
            imagediv[0].style.setProperty('--zoom-y', pointer.y + '%');
        })
        imagediv[0].addEventListener("mouseout", () => {
            imagediv[0].style.setProperty('--opacity', '0');
        })
    
        // set product image on main image element
        
        let galleryImage=document.querySelectorAll(".singleproductmian .multipleImg img");
            let productImg = document.getElementsByClassName("productImg");
            let productImgEle = document.querySelector(".productImg img");
        galleryImage.forEach((g)=>{
            g.addEventListener("click",(e)=>{
                productImg[0].setAttribute("style", "--imageurl:url(" + e.currentTarget.getAttribute('src') + ")");
                productImgEle.setAttribute("src",e.currentTarget.getAttribute('src'));
            })
        })

        // end here
    

});

    // jquery start form here
    
    $(document).ready(function () {

    $base_url=$(".base_url_define").attr("base_url");

        $(".detail_page_content").on("click",".proceed_to_checkout",(e) => {
        // $(".proceed_to_checkout").click(function (e) { 
        
            e.preventDefault();
            $product_cart_id=$(e.currentTarget).attr("product_cart_id");
            $.ajax({
                type: "post",
                url: $base_url+"BackendAssets/mysqlcode/proceed_to_checkout.php",
                data: {product_id:$product_cart_id},
                dataType: "json",
                success: function (response) {
                    if(response.status === 'success')
                    {
                        // console.log(response.data);
                        window.location.href=$base_url+"checkout/product/"+response.data;
                    }
                }
            });
            
        });


        // increase cart product quantity 

    $(".detail_page_content").on("click",".plus_icon",(e)=>{
    // $('.plus_icon').on("click",(e)=>{

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
                    set_product_on_cart();
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

    $(".detail_page_content").on("click",".minus_icon",(e)=>{
    // $('.minus_icon').on("click",(e)=>{
        
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
                        // $(e.currentTarget).parent().parent().parent().css({"display":"none"});
                        $(".cart_count").text(parseInt($(".cart_count").text())-1);
                    }
                    else
                    {
                        $(e.currentTarget).prev().text(response.quantity);
                        set_product_on_cart();
                    }
                }
            },
            error:(error)=>
            {
                console.log(error);
            }
        })

    })

    // end here


    });


    // end here