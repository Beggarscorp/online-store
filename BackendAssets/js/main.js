document.addEventListener("DOMContentLoaded",()=>{

    var swiper_1 = new Swiper(".myswiper", {
        slidesPerView: 3,
        spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          breakpoints: {
            250: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 40,
            },
            1024: {
              slidesPerView: 4,
              spaceBetween: 20,
            },
        }
      });

    var swiper_2 = new Swiper(".myswiper_2", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          breakpoints: {
            250: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 40,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 50,
            },
        }
      });
      
      var swiper_3 = new Swiper(".myswiper_3", {
        slidesPerView: 3,
        spaceBetween: 10,
        autoplay:true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          breakpoints: {
            250: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 40,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 50,
            },
        }
      });
      
      //   visit_beggars_corporation_video loader js code

      const visit_beggars_corporation_video=document.getElementById("visit-beggars-corporation-video");
      const visit_beggars_corporation_video_loader=document.getElementById("visit-beggars-corporation-video-loader");
      if(visit_beggars_corporation_video && visit_beggars_corporation_video_loader)
      {
          visit_beggars_corporation_video.style.display="none";
          visit_beggars_corporation_video_loader.style.display="block";
          visit_beggars_corporation_video.addEventListener("loadeddata",()=>{
              visit_beggars_corporation_video_loader.style.display="none";
              visit_beggars_corporation_video.style.display="block";
          })
          
      }

    //   end here

    const sidebar=document.getElementsByClassName("sidebar");
    const cart_icon=document.getElementById("cart_icon");
    const cart_icon_mobile=document.getElementById("cart_icon_mobile");
    const sidebar_blank_area=document.getElementsByClassName("sidebar_blank_area");
    
    const sidebar_show_function=()=>{
        
        sidebar[0].classList.toggle("sidebar_show");
        if(sidebar[0].classList.contains("sidebar_show"))
        {
            document.body.style.overflow = 'hidden';
        }
        else
        {
            document.body.style.overflow = 'inherit';
        }
    }

    cart_icon.addEventListener("click",sidebar_show_function);
    cart_icon_mobile.addEventListener("click",sidebar_show_function);

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




    // const slider = document.querySelector('.slider');
    // const prevButton = document.querySelector('.prev');
    // const nextButton = document.querySelector('.next');
    // const sliderItems = document.querySelectorAll('.slider-item');
    // const totalItems = sliderItems.length;
    // let currentIndex = 0;

    // // Function to update the center item style
    // function updateCenterItem() {
    //   sliderItems.forEach((item, index) => {
    //     item.classList.remove('center');  // Remove center class from all
    //     if (index === currentIndex) {
    //       item.classList.add('center'); // Add center class to the current item
    //     }
    //   });
    // }

    // // Function to slide the items based on the currentIndex
    // function slide() {
    //   const itemsVisible = getVisibleItemsCount();
    //   const offset = -currentIndex * (100 / itemsVisible); // Calculate the offset for the visible items
    //   slider.style.transform = `translateX(${offset}%)`; // Apply sliding effect
    // }

    // // Function to get the number of items visible based on screen size
    // function getVisibleItemsCount() {
    //   const width = window.innerWidth;
    //   if (width <= 480) {
    //     return 1; // 1 item on mobile
    //   } else if (width <= 768) {
    //     return 2; // 2 items on tablet
    //   } else {
    //     return 3; // 3 items on desktop
    //   }
    // }

    // // Previous button functionality
    // prevButton.addEventListener('click', () => {
    //   if (currentIndex > 0) {
    //     currentIndex--;
    //   } else {
    //     currentIndex = totalItems - getVisibleItemsCount();  // Loop to the last set of items
    //   }
    //   slide();
    //   updateCenterItem();
    // });

    // // Next button functionality
    // nextButton.addEventListener('click', () => {
    //   if (currentIndex < totalItems - getVisibleItemsCount()) {
    //     currentIndex++;
    //   } else {
    //     currentIndex = 0;  // Loop back to the first set of items
    //   }
    //   slide();
    //   updateCenterItem();
    // });

    // // Initialize the slider and center the first item
    // updateCenterItem();

    // // Recalculate slide position when the window is resized
    // window.addEventListener('resize', () => {
    //   slide();
    //   updateCenterItem();
    // });
    

});

document.addEventListener('DOMContentLoaded', function () {
    let bannerCarousel = document.querySelector('#bannerCarousel');
    
    if(bannerCarousel)
    {
        // Initialize Bootstrap carousel with autoplay and other options
        const carousel = new bootstrap.Carousel(bannerCarousel, {
          interval: 2000,  // Autoplay every 2 seconds
          touch: true,     // Allow touch swipe
          keyboard: true,  // Enable keyboard navigation
          ride: 'carousel' // Ensure the carousel auto starts
        });

    }
  });


$(document).ready(function () {

    // mobile header js code

    $(".menu_icon").on("click",()=>{
        $(".first_line").toggleClass("first_line_show");
        $(".middle_line").toggleClass("middle_line_show");
        $(".last_line").toggleClass("last_line_show");
    })

    $(".mobile_menu_icon").on("click",()=>{
        $(".mobile_sidebar").toggleClass("mobile_sidebar_show");
        $mobile_sidebar=$(".mobile_sidebar");
        if($mobile_sidebar[0].classList.contains("mobile_sidebar_show"))
            {
                document.body.style.overflow = 'hidden';
            }
            else
            {
                document.body.style.overflow = 'inherit';
            }
    })
    
    
    // end here

    $(".category").on("click",()=>{
        $wid=window.screen.width;
        if($wid < 768){
            $(".sub_menu").toggleClass("submenu_show");
        }
    });
    
    // show dashboard div code
    
    $user_icon=$("#user_icon");
    $("#user_icon").on("click",()=>{
        $(".dashboard_show").toggleClass("dashboard_hide");
    })
    $("#user_icon_mobile").on("click",()=>{
        $(".dashboard_show").toggleClass("dashboard_hide");
    })

    $("#hide_dashboard").on("click",()=>{
        $(".dashboard_show").removeClass("dashboard_hide");
    })
    $("#hide_dashboard_mobile").on("click",()=>{
        $(".dashboard_show").removeClass("dashboard_hide");
    })

    // end here


    
    $base_url=$(".base_url_define").attr("base_url");
    

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
                        // $(".cart_count").text(parseInt($(".cart_count").text())-1);
                        $(".cart_count").text(0);
                        set_product_on_cart();
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


        $(document).on("click",".add-to-cart-btn",(e)=>{
        // $("").on("click",(e)=>{
            
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

    function set_product_on_cart () {

        $.ajax({
            url:$base_url+"BackendAssets/mysqlcode/addtocart.php",
            method:'POST',
            datatype:'json',
            data:{fetch_data_form_cart:true},
            success:(response)=>{
                
                if(response.status === 'success' && response.product_data != "")
                {
                    $product_carts_html='';
                    $productQuantity=[];
                    $productPrice=[];
                    for($i=0;$i<response.product_data.length;$i++)
                        {
                            if(parseInt(response.product_data[$i].min_order) > 0 )
                            {
                                $quantity_show=`<div class='fix_quantity_div'>QTY : ${response.product_data[$i].min_order} <span>(min order)</span></div><span class="fix_product_quantity_remove_icon" id="${response.product_data[$i].id}"><i class="bi bi-x-circle"></i></span>
                                <div class='price' id='price-${response.product_data[$i].id}' price='${response.product_data[$i].price}' quantity='${response.product_data[$i][0]}'>
                                    <h6><i class='bi bi-currency-rupee'></i> ${response.product_data[$i].price*response.product_data[$i].min_order}</h6>
                                </div>`;
                                $productQuantity.push(response.product_data[$i].min_order);
                                $productPrice.push(response.product_data[$i].price);
                            }
                            else
                            {
                                $quantity_show=`<div class='quantity_div'>
                                            <button type='button' class='plus_icon' cart_product_id='${response.product_data[$i].id}'><i class='bi bi-plus-lg'></i></button>
                                            <span id='quantity-${response.product_data[$i].id}'>${response.product_data[$i][0]}</span>
                                            <button type='button' class='minus_icon' cart_product_id='${response.product_data[$i].id}'><i class='bi bi-dash-lg'></i></button>
                                            </div>
                                            <div class='price' id='price-${response.product_data[$i].id}' price='${response.product_data[$i].price}' quantity='${response.product_data[$i][0]}'>
                                                <h6><i class='bi bi-currency-rupee'></i> ${response.product_data[$i].price*response.product_data[$i][0]}</h6>
                                            </div>`;
                                            $productQuantity.push(response.product_data[$i][0]);
                                            $productPrice.push(response.product_data[$i].price);
                            }
                            $product_carts_html+=`
                            <div class='product_cart'>
                                <div class='row'>
                                    <div class='col-sm-3 col-4'>
                                        <img src='`+$base_url+`BackendAssets/assets/images/ProductImages/${response.product_data[$i].productimage}' alt='${response.product_data[$i].productimage}' class='img-thumbnail'>
                                    </div>
                                    <div class='col-sm-9 col-8'>
                                        <h6>${response.product_data[$i].productname}</h6>
                                        ${$quantity_show}
                                    </div>
                                </div>
                            </div>
                            `;
                        }

                        $(".cart_products").html($product_carts_html);

                        calculate_grand_total_price($productQuantity,$productPrice);

                        $(".cart_count").text(parseInt(response.product_data.length) != "" && parseInt(response.product_data.length) != null ? response.product_data.length : 0 );
                        
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

    calculate_grand_total_price=(qty,price)=>{
        $totalprice=[];
        if(qty.length === price.length)
        {
            for($e=0;$e<qty.length;$e++)
            {
                $totalprice.push((qty[$e])*(price[$e]));
            }
            $sumtotalPrice = $totalprice.reduce((acc, currentValue) => acc + currentValue, 0);
            $(".total_price").html('<i class="bi bi-currency-rupee"></i>'+$sumtotalPrice);
            $("#ptc_total_price").html('<i class="bi bi-currency-rupee"></i>'+$sumtotalPrice);
            $("#total_price_input").val($sumtotalPrice);
        }
    }
    
    
    $("#select_address").on("change",(e)=>{
        $("#address").html("Address "+$(e.currentTarget).val()+"<i class='bi bi-check2-circle' style='font-size:15px;'>");
    })

    // remove message show parameter form url after 2s 

    setTimeout(() => {

        for($o=0;$o<5;$o++)
        {
            if(window.location.href === $base_url+"checkout/"+$o)
            {
                let currentUrl = new URL($base_url+"checkout/"+$o);
                
                // Split the pathname into parts
                let pathParts = currentUrl.pathname.split('/');
                
                // Remove the last segment (msg-value)
                pathParts.pop();
                
                // Rebuild the pathname without the last segment
                let newPathname = pathParts.join('/');
                
                // Update the URL in the browser without reloading the page
                currentUrl.pathname = newPathname;
                window.history.replaceState({}, '', currentUrl);
    
            }

        }
    }, 2000);

    // end here

    // header filter element show hide js code

    $("#filter_icon").on("click",()=>{
        $(".filter_element").toggleClass("filter_element_show");
    })

    $(".filter_element ").on("change",(e)=>{
        $cate=$(e.currentTarget).val();
        window.location.href=$base_url+"shop/"+$cate;
    })

    // end here
    
    $("#signup_password_field_icon").on("click",()=>{
        $("#signup_password_field").attr("type","text");
    })
    
    
})

$(document).ready(function() {
    // toast showing jquey code

    var toastEl = $('.toast');
    if (toastEl.length > 0) {
        var toast = new bootstrap.Toast(toastEl[0]);
        toast.show();
        setTimeout(() => {
            toast.hide();
        }, 5000);
    }

    // end here


    // make some animation on element show

    let gallery_image=document.querySelectorAll(".gallery_image");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
           
                entry.target.classList.toggle("gallery_image_show",entry.isIntersecting);
                if(entry.isIntersecting) observer.unobserve(entry.target)
        })
        ,
        {
            rootMargin: "100px",
        }
    })

    gallery_image.forEach(image =>{
        observer.observe(image);
    })

    // end here


    $(document).on("click",".fix_product_quantity_remove_icon",(e)=>{
        $id=$(e.currentTarget).attr("id");
        $.ajax({
            type: "POST",
            url: $base_url+"/BackendAssets/mysqlcode/removecart.php",
            data: {action:"fix_quantity_product_remover_from_cart",id:$id},
            dataType: "json",
            success: function (response) {
                if(response.status === true)
                {
                    $(e.currentTarget).parent().parent().css({"display":"none"});
                    if(parseInt($(".cart_count").text()) > 0)
                    {
                        $(".cart_count").text(parseInt(response.cart_count));
                    }    
                }
            }
        });
    })

       // remove messge tag from url

    if(window.location.search)
    {
        const cleanUrl = window.location.pathname;
        setTimeout(() =>{
            window.history.replaceState({}, document.title, cleanUrl);
        },2000);
    }    

    // end here 


});

// document.addEventListener("DOMContentLoaded", () => {
//     const starContainer = document.querySelector(".star-container");

//     // Function to create a star
//     function createStar() {
//         const star = document.createElement("div");
//         star.classList.add("star");

//         // Set a random position and animation delay
//         star.style.left = `${Math.random() * 100}vw`;
//         star.style.top = `${Math.random() * 100}vh`;
//         star.style.animationDelay = `${Math.random() * 2}s`;

//         // Add the star to the container
//         starContainer.appendChild(star);

//         // Remove the star after animation
//         star.addEventListener("animationend", () => {
//             star.remove();
//         });
//     }

//     // Generate multiple stars
//     for (let i = 0; i < 50; i++) {
//         createStar();
//     }
    
// });

