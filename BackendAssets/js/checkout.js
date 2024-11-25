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
                    }
                }
            }
        });
    })

    const calculate_ptc_product_grand_total_price=()=>{
        $tt=$(".proceed_to_checkout_container #price").text();
        $("#ptc_second_total_price").html("<i class='bi bi-currency-rupee'></i>"+$tt);
        $("#ptc_total_price_input").val($tt);
    }
    calculate_ptc_product_grand_total_price();

    $("#place_order").on("click",(e)=>{
        e.preventDefault();
        $place_order_form=$("#place_order_form")[0];
        if($place_order_form.checkValidity())
        {
            $("#place_order_form").submit();
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