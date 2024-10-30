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

    $base_url='http://localhost:3000/';

    // increase cart product quantity 

    $('.cart_products').on("click",".plus_icon",(e)=>{

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

    $('.cart_products').on("click",".minus_icon",(e)=>{
        
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
                    Swal.fire({
                        title:"Product added to cart",
                        icon:"success"
                    });
                    set_product_on_cart();
                }
            },
            error:(error)=>{
                console.log(error);
            }
        })
    })

    // end here
    
    // this function for count product price from his quantity change

    // const count_product_price=(ele,from)=>{
    //     if(from === 'prev')
    //     {
    //         $(ele).next().text("");
    //         let value=($(ele).prev().text())*($(ele).next().attr('price'));
    //         $(ele).next().append("<span><i class='bi bi-currency-rupee'></i>"+value+"<span/>");
    //     }
    //     else
    //     {
    //         $(ele).next().next().next().text("");
    //         let value=($(ele).next().text())*($(ele).next().next().next().attr('price'));
    //         $(ele).next().next().next().append("<span><i class='bi bi-currency-rupee'></i>"+value+"<span/>");
    //     }
    // }

    // end here
    
    // set product of cart sidebar

    const set_product_on_cart=()=>{

        $.ajax({
            url:$base_url+"BackendAssets/mysqlcode/addtocart.php",
            method:'POST',
            datatype:'json',
            data:{fetch_data_form_cart:true},
            success:(response)=>{
                if(response.status === 'success' && response.product_data != "")
                {
                    $product_carts_html='';
                    for($i=0;$i<response.product_data.length;$i++)
                        {
                            $product_carts_html+=`
                            <div class='product_cart'>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <img src='`+$base_url+`BackendAssets/assets/images/productImages/${response.product_data[$i].productimage}' alt='${response.product_data[$i].productimage}' class='img-thumbnail'>
                                    </div>
                                    <div class='col-sm-9'>
                                        <h6>${response.product_data[$i].productname}</h6>
                                        <h6><i class='bi bi-currency-rupee'></i> ${response.product_data[$i].price}</h6>
                                        <button class='plus_icon' cart_product_id='${response.product_data[$i].id}'><i class='bi bi-plus-lg'></i></button>
                                        <span id='quantity-${response.product_data[$i].id}'>${response.product_data[$i][0]}</span>
                                        <button class='minus_icon' cart_product_id='${response.product_data[$i].id}'><i class='bi bi-dash-lg'></i></button>
                                        <div class='price' id='price-${response.product_data[$i].id}' price='${response.product_data[$i].price}' quantity='${response.product_data[$i][0]}'>
                                            <h6><i class='bi bi-currency-rupee'></i> ${response.product_data[$i].price*response.product_data[$i][0]}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }

                        $(".cart_products").html($product_carts_html);

                        calculate_grand_total_price();

                        $(".cart_count").text(response.product_data.length != "" ? response.product_data.length : "" );
                        
                    }
                    else
                    {
                        $(".cart_products").html("<h5>No Products in Cart</h5>");

                    }
            }
        })

    }

    set_product_on_cart();

    // end here

    calculate_grand_total_price=()=>{

        let price_element=document.querySelectorAll(".price");
        let total_price_element=document.getElementsByClassName("total_price");
        if(price_element)
        {
            let all_prices=[];
            price_element.forEach((e)=>{
                all_prices.push(e.getAttribute("price")*e.getAttribute("quantity"));
            })
            const total_prices = all_prices.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
            total_price_element[0].innerHTML="<i class='bi bi-currency-rupee'></i>"+total_prices;
        }
    }

    
    
})
