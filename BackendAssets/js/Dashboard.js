$(document).ready(function () { 
    let edit_=$(".edit");
    edit_.each(e =>{
        $(edit_[e]).on("click",()=>{
            console.log();
            let input_Ele=$(edit_[e]).siblings(".block").children()[0];
            $(input_Ele).removeAttr("disabled");
            $(input_Ele).css("cursor","auto");
            
        })
    })


    let forms=$('.singleupdateform');
    forms.each(form => {

        $(forms[form]).on("submit",(e)=>{
            e.preventDefault();
            let form=e.target;
            let form_Data=new FormData(form);
            let form_key_value={};
            form_Data.forEach((value,key)=>{
                form_key_value['key']=key;
                form_key_value[key]=value;
                form_key_value['value']=value;
            })
                $.ajax({
                    type: "POST",
                    url: $base_url+"BackendAssets/mysqlcode/dashboard.php",
                    data: {action:'formupdate',form_data:form_key_value},
                    dataType: "json",
                    success: function (response) {
                        if(response.status === true)
                        {
                            Swal.fire({
                                title:'Your '+response.key+' updated',
                                icon:'success'
                            })
                            
                        }
                    }
                });
        })
    });

    $("#address_change_select_field").on("change",()=>{
        $("#address_change_form")[0].submit();
    })


    let first_opiton_element=$("#address_change_select_field option")[0];

    let dash_navigation_li=$(".navigation ul li");
    
    const removeClassFromdiv=()=>{
        let element_container=$(".element_container");
        element_container.each((e)=>{
            if($(element_container[e]).hasClass("dash_content_show"))
            {
                $(element_container[e]).removeClass("dash_content_show");
            }
            if($(dash_navigation_li[e]).hasClass("navigation_link_click"))
            {
                $(dash_navigation_li[e]).removeClass("navigation_link_click");
            }
        })
    }

    
    $(".profile").addClass("dash_content_show");
    $("#profile").addClass("navigation_link_click");
    dash_navigation_li.each((e)=>{
        $(dash_navigation_li[e]).on("click",(j)=>{
            let id=j.currentTarget.id;
            removeClassFromdiv();
            $("."+id).addClass("dash_content_show");
            $("#"+id).addClass("navigation_link_click");
        })
    })

    // dashboard navigation show hide code

    $screen_width=window.screen.width;
    if($screen_width < 768 )
    {
        $(".dashboar_menu_icon").on("click",()=>{
            $(".navigation").toggleClass("navigation_show");
        })
    }

    // end here
    
     // set the upadate table value

    function set_table_name () {

        let get_table_value=$($("#address_change_select_field")[0]).val();
        let length_of_table_input_field=$($(".table_name")).length;
        for($o=0;$o<length_of_table_input_field;$o++)
        {
            $($(".table_name")[$o]).val(get_table_value);
        }

    }

    set_table_name();

    // end here

    $(".img").on("click",(e)=>{
        $("#imagefileInput").trigger("click")
    })

    $("#imagefileInput").on("change",(e)=>{
        let file=e.target.files[0];
        console.log(e.target.files)
        let formdata=new FormData();
        formdata.append("file",file);
        formdata.append("action","profile_image_update");
        $.ajax({
            type: "POST",
            url: $base_url+"BackendAssets/mysqlcode/dashboard.php",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status)
                {
                    $(".img").attr("src",$base_url+"BackendAssets/assets/images/userimages/"+response.imageName);
                    Swal.fire({
                        title:"Profile image updated",
                        icon:"success"
                    })
                }
            }
        });
    })

});