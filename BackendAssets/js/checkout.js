$(document).ready(function () {

    $base_url=$(".base_url_define").attr("base_url");

    $(".plus_icon").on("click",()=>{
        
        $.ajax({
            type: "POST",
            url: $base_url+"BackendAssets/mysqlcode/proceed_to_checkout.php",
            data: {'increase_quantity':true},
            dataType: "json",
            success: function (response) {
                if(response.status === 'success')
                {
                    $(".proceed_to_checkout_container #quantity").text(response.data[0]);
                    $price=response.data[0]*response.data['price'];
                    $(".ptc_price").html(`<i class='bi bi-currency-rupee'></i>`+$price);
                    $("#ptc_second_total_price").html(`<i class='bi bi-currency-rupee'></i>`+$price);
                    getting_grand_total_price_for_payment_gateway();
                }
            }
        });
    })


    $(".minus_icon").on("click",()=>{
        
        $.ajax({
            type: "POST",
            url: $base_url+"BackendAssets/mysqlcode/proceed_to_checkout.php",
            data: {'decrease_quantity':true},
            dataType: "json",
            success: function (response) {
                if(response.status === 'success')
                {
                    if(response.data[0] === 0)
                    {
                        $(".proceed_to_checkout_container").children().css({'display':'none'});
                        $(".proceed_to_checkout_container").html("<h3>No Product available now</h3>");
                        $("#ptc_second_total_price").html(`<i class='bi bi-currency-rupee'></i>`+0);
                    }
                    else
                    {
                        $price=response.data[0]*response.data['price'];
                        $(".ptc_price").html(`<i class='bi bi-currency-rupee'></i>`+$price);
                        $("#ptc_second_total_price").html(`<i class='bi bi-currency-rupee'></i>`+$price);
                        $(".proceed_to_checkout_container #quantity").text(response.data[0]);
                        getting_grand_total_price_for_payment_gateway();
                    }
                }
            }
        });
    })

    const calculate_ptc_product_grand_total_price=()=>{
        $tt=$(".proceed_to_checkout_container .price").attr("price")*$(".proceed_to_checkout_container .price").attr("quantity");
        $("#ptc_second_total_price").html("<i class='bi bi-currency-rupee'></i>"+$tt);
        $("#ptc_total_price_input").val($tt);
    }
    calculate_ptc_product_grand_total_price();


    function getting_grand_total_price_for_payment_gateway () {

        if($("#ptc_total_price_input").val() != undefined && $("#ptc_total_price_input").val() != "")
        {
            return $("#ptc_total_price_input").val();
        }
        if($("#total_price_input").val() != undefined && $("#total_price_input").val() != "")
        {
            return $("#total_price_input").val();
        }
    }
    
    // getting_grand_total_price_for_payment_gateway();
    
    
    $("#place_order").on("click",(e)=>{
        e.preventDefault();
        $total_pr=parseInt(getting_grand_total_price_for_payment_gateway());
        
            $place_order_form=$("#place_order_form")[0];
            if($place_order_form.checkValidity() && $total_pr != "")
                {
                    
                    
                $username = $("#username").val();
                $useremail = $("#useremail").val();
                $usernumber = "+91" + $("#usernumber").val();
                $useraddress = $("#useraddress").val();
                $grand_total_price_amount = Math.round(parseFloat($total_pr) * 100);



                    fetch($base_url+'BackendAssets/Components/get_order_id.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                amount: $grand_total_price_amount
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.order_id) {
                                var options = {
                                    "key": "rzp_live_OyvHUvi3gQtHGd", // Enter the Key ID generated from the Dashboard
                                    "amount": $grand_total_price_amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                    "currency": "INR",
                                    "name": "Beggars Corporation", //your business name
                                    "description": "Test Transaction",
                                    "image": "https://beggarscorporation.com/images/main/header-logo3.png",
                                    "order_id": data.order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                                    "callback_url": "https://beggarscorporation.com/order.php",
                                    "handler": function(response) {
                                        if (response.razorpay_payment_id && response.razorpay_order_id && response.razorpay_signature) {
                                            $("razorpay_payment_id").val(response.razorpay_payment_id);
                                            $("razorpay_order_id").val(response.razorpay_order_id);
                                            $("razorpay_signature").val(response.razorpay_signature);
                                            $("#place_order_form").submit();
                                        } else {
                                            Swal.fire({
                                                title: "Not get response",
                                                icon: "warning"
                                            });
                                        }
                                    },
                                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                                        "name": $username, //your customer's name
                                        "email": $useremail,
                                        "contact": $usernumber.toString() //Provide the customer's phone number for better conversion rates 
                                    },
                                    "notes": {
                                        "address": $useraddress
                                    },
                                    "theme": {
                                        "color": "#b7730d"
                                    }
                                };

                                var rzp1 = new Razorpay(options);
                                rzp1.on('payment.failed', function(response) {
                                    alert(response.error.reason);
                                });
                                rzp1.open();
                            } else {
                                console.error("Order creation failed:", data.error);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });

                }
                else
                {
                    Swal.fire({
                        title:"All fields are required",
                        icon:"warning"
                    })
                }

        })


        
    });
