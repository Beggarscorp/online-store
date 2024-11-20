
const imagediv = document.getElementsByClassName("productImg");
    imagediv[0].addEventListener("mousemove", (e) => {
        imagediv[0].style.setProperty('--display', 'block');
        imagediv[0].style.cursor = "zoom-in";
        let pointer = {
            x: (e.offsetX * 100) / imagediv[0].offsetWidth,
            y: (e.offsetY * 100) / imagediv[0].offsetHeight
        }
        imagediv[0].style.setProperty('--zoom-x', pointer.x + '%');
        imagediv[0].style.setProperty('--zoom-y', pointer.y + '%');
    })
    imagediv[0].addEventListener("mouseout", () => {
        imagediv[0].style.setProperty('--display', 'none');
    })



    const galleryimages = (e) => {
        let productImgImate = document.querySelector(".productImg img");
        let productImg = document.getElementsByClassName("productImg");
        productImgImate.setAttribute("src", e.getAttribute("src"));
        let tt = e.getAttribute("src");
        productImg[0].setAttribute("style", "--imageurl:url(" + tt + ")");
    }

    const quantityTotal = (e) => {

        data = {
            "userid": e.getAttribute("userid"),
            "procductid": e.getAttribute("productid"),
            "productprice": e.getAttribute("productprice"),
            "productQty": e.value
        }
        fetch("BackendAssets/mysqlcode/checkoutcart.php", {
                method: "POST",
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                e.value = data.data.product_qty;
            })
            .catch(error => {
                console.log(error);
            })
    }

    // jquery start form here

    $base_url=$(".base_url_define").attr("base_url");

    $(document).ready(function () {
        $(".proceed_to_checkout").click(function (e) { 
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
                        window.location.href=$base_url+"checkout_2/product/"+response.data;
                    }
                }
            });
            
        });


    });


    // end here