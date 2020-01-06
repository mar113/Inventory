
$(document).ready(function(){
    var DOMAIN = "http://localhost/inventory/public_html";
    $("#register").on("submit",function(){

        var status=false;
        var name = $("#username");
        var email= $("#email");
        var pass1 = $("#password1");
        var pass2 = $("#password2");
        var type  = $("#usertype :selected");

       // var n_patt = new RegExp(/^[A-Za-z]+$/);
        
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-])*@[a-z0-9_-]+(\.[a-z0-9_-])*(\.[a-z]{2,4})$/);

        if(name.val() == "" || name.val().length < 5)
        {
            name.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>you must type a significant username <i class='fa fa-times'></i></span>");
            status=false;
        }
         else{

            name.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
         } 

         if(!e_patt.test(email.val()))
         {
             email.addClass("border-danger");
             $("#e_error").html("<span class='text-danger'>email incorrect,please verify <i class='fa fa-times'></i></span>");
             status = false;
         }
          else{
 
             email.removeClass("border-danger");
             $("#e_error").html("");
             status = true;
          }
        
          if(pass1.val() == "" || pass1.val().length < 6)
          {
              pass1.addClass("border-danger");
              $("#p1_error").html("<span class='text-danger'>password invalid <i class='fa fa-times'></i></span>");
              status = false;
          }
           else{
  
              pass1.removeClass("border-danger");
              $("#p1_error").html("");
              status = true;
           }

           if(pass2.val() == "" || pass2.val().length < 6)
           {
               pass2.addClass("border-danger");
               $("#p2_error").html("<span class='text-danger'>password invalid <i class='fa fa-times'></i></span>");
               status = false;
           }
            else{
   
               pass2.removeClass("border-danger");
               $("#p2_error").html("");
               status = true;
            }

            if(type.val() == "")
            {
                type.addClass("border-danger");
                $("#t_error").html("<span class='text-danger'>please select a type <i class='fa fa-times'></i></span>");
                status = false;
            }
             else{
    
                type.removeClass("border-danger");
                $("#t_error").html("");
                status = true;
             }

 
             if((pass1.val() == pass2.val()) && status == true)
             {
                $(".overlay").show();
                $.ajax({
                    url: DOMAIN+"/includes/process.php",
                    type: 'POST',
                    data: {
                        userName: name.val(),
                        Email: email.val(),
                        password: pass1.val(),
                        userType: type.text(), 
                    },
                    success : function(response){
                        
                        if( response == "EMAIL_ALREADY_EXIST")
                        {
                            $(".overlay").hide();
                            alert("existant mail, try again");
                        }
                        else if(response == "SOMETHING_WENT_WRONG")
                        {
                            $(".overlay").hide();
                            alert("Something went wrong");
                        }
    
                        else
                        {
                            $(".overlay").hide();
                            window.location.href = encodeURI(DOMAIN+"/logout.php?msg=New user has been added successfully, please login again to continue");
                        }
                    }
                }) 
             }
              else{
     
                 pass2.addClass("border-danger");
                 $("#p2_error").html("<span class='text-danger'>password is not matched <i class='fa fa-times'></i></span>");
                 status = true;
              }
    })

    //login js part

    $("#login_form").on("submit",function(){
        
        var mail = $("#logmail");
        var pass = $("#logpass");
        var status = false;
        if(mail.val() == "")
        {
            mail.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>wrong email, try again <i class='fa fa-times'></i></span>");
            status = false;
        }
        else{
            mail.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if(pass.val() == "")
        {
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>wrong password, try again <i class='fa fa-times'></i></span>");

            status = false;
        }
        else{
            pass.removeClass("border-danger");
            $("#p_error").html("");
            status = true;
        }

        if(status)
        {
            $(".overlay").show();
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                type: 'POST',
                data: {
                    EmailLog: mail.val(),
                    passwordLog: pass.val(),
                },
                success : function(response){
                    
                    if( response == "NOT_REGISTRED")
                    {
                        $(".overlay").hide();
                        mail.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>wrong email, try again <i class='fa fa-times'></i></span>");
                    }
                    else if(response == "PASSWORD_NOT_MATCH")
                    {
                        $(".overlay").hide();
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>wrong password, try again <i class='fa fa-times'></i></span>");
                    }

                    else
                    {
                        $(".overlay").hide();
                        window.location.href = encodeURI(DOMAIN+"/Dashboard.php");
                    }
                }
            }) 
        }
    })


    //fetching category
fetching_category();
    function fetching_category(){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: 'POST',
            data: {
                getCategory: 1,
            },
            success : function(response){

                var root = "<option value='0'>--root--</option>";
                var choose = "<option value=''>--Choose category--</option>";
               $("#parent_cat").html(root+response);
               $("#select_cat").html(choose+response);
            }


        })
    }
    fetching_brands();
    function fetching_brands(){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: 'POST',
            data: {
                getBrand: 1,
            },
            success : function(response){
                var choose = "<option value=''>--Choose Brand--</option>";
               $("#select_brand").html(choose+response);
            }


        })
    }

    //fetching sub-category
    fetching_sub_category();
    function fetching_sub_category(){
        $("#parent_cat").change(function(){
            var categorie = $(this).children("option:selected");
            $.ajax({
                url:DOMAIN+"/includes/process.php",
                method: 'POST',
                data : {
                    CAT : categorie.val(),
                },
                success: function(response){
                    var root = "<option value='0'>--root--</option>";
                    var choose = "<option value='0'>--choose--</option>";
                    $("#sub_cat").html(root+response);
                    $("#sub").fadeIn("slow").removeAttr("hidden");
                    $("#select_sc").html(choose+response);
                    $("#select_sc").fadeIn("slow").removeAttr("hidden");
                }
            })
            
        })
 

    }

    //fetching subcat for product part

    fetching_psub_category();
    function fetching_psub_category(){
        $("#select_cat").change(function(){
            var categorie = $(this).children("option:selected");
            $.ajax({
                url:DOMAIN+"/includes/process.php",
                method: 'POST',
                data : {
                    CAT : categorie.val(),
                },
                success: function(response){
                    var choose = "<option value='0'>--choose--</option>";
                    $("#select_sc").html(choose+response);
                    $("#scp").fadeIn("slow").removeAttr("hidden");
                }
            })
            
        })
 

    }


    //Add category && sub category

    $("#form_category").on("submit",function(){
        var catname = $("#category_name");
        if($("#category_name").val() == "")
        {
            catname.addClass("border-danger");
            $("#c_error").html("<span class='text-danger'> Please enter a category name <i class='fa fa-times'></i></span>");
        }
        else{
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#form_category").serialize(),
                success : function(response)
                {
                    if(response == "CATEGORY_ADDED")
                    {
                    catname.removeClass("border-danger");
                    $("#c_error").html("<span class='text-success'> New category has been added sucessfully <i class='fa fa-check'></i></span>");
                    $("#category_name").val("");
                    fetching_category();
                    }
                    else if(response == "NEW_SUB_ADDED")
                    {
                        catname.removeClass("border-danger");
                        $("#c_error").html("<span class='text-success'> New sub-category has been added sucessfully <i class='fa fa-check'></i></span>");
                        $("#category_name").val("");
                        
                        fetching_sub_category();
                        
                    }
                    else{
                        alert(response);
                    }
                    
                    
                }
            })
        }
    })

        //Add brands

    $("#brand_form").on("submit",function(){
            if($("#brand_name").val() == "")
            {
                $("brand_name").addClass("border-danger");
                $("#b_error").html("<span class='text-danger'> Please enter a brand name<i class='fa fa-times'></i></span>");
            }
            else{
                $.ajax({
                    url : DOMAIN+"/includes/process.php",
                    method : "POST",
                    data : $("#brand_form").serialize(),
                    success : function(response)
                    {
                        
                        if(response == "BRAND_ADDED")
                        {
                        $("#brand_name").removeClass("border-danger");
                        $("#b_error").html("<span class='text-success'> New brand has been added sucessfully <i class='fa fa-check'></i></span>");
                        $("#brand_name").val("");
                        fetching_brands();
                        }
                        else
                        {
                            alert(response);
                        }
                    }
                })
            }
        })

// Add product
$("#product_form").on("submit",function(){
    if($("#product_name").val() == "")
    {
        $("#product_name").addClass("border-danger");
        $("#pn_error").html("<span class='text-danger'> Please enter a product name<i class='fa fa-times'></i></span>");
        
    }
    else{
        $("#product_name").removeClass("border-danger");
        $("#pn_error").html("");
    }
     if($("#select_cat").val() == "")
    {
        $("#select_cat").addClass("border-danger");
        $("#c_error").html("<span class='text-danger'> Please enter a category <i class='fa fa-times'></i></span>");
    }
    else {
        $("#select_cat").removeClass("border-danger");
        $("#c_error").html("");
    }
     if($("#select_sc").val() == "")
    {
        $("#select_sc").addClass("border-danger");
        $("#sc_error").html("<span class='text-danger'> Please select sub category <i class='fa fa-times'></i></span>");
    }
    else
    {
        $("#select_sc").removeClass("border-danger");
        $("#sc_error").html("");
    }
     if($("#select_brand").val() == "")
    {
        $("#select_brand").addClass("border-danger");
        $("#b_error").html("<span class='text-danger'> Please enter a price <i class='fa fa-times'></i></span>");
    }
    else{
        $("#select_brand").removeClass("border-danger");
        $("#b_error").html("");
    }
    if($("#product_price").val() == "")
    {
        $("#product_price").addClass("border-danger");
        $("#pr_error").html("<span class='text-danger'> Please enter a price <i class='fa fa-times'></i></span>");
    }
    else{
        $("#product_price").removeClass("border-danger");
        $("#pr_error").html("");
    }
    if($("#quantity").val() == "")
    {
        $("#quantity").addClass("border-danger");
        $("#q_error").html("<span class='text-danger'> Please enter a quantity <i class='fa fa-times'></i></span>");
    }
    else
    {
        $("#quantity").removeClass("border-danger");
        $("#q_error").html("");
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data: {
                    Cid:$("#select_cat").val(),
                    Bid:$("#select_brand").val(),
                    Scid:$("#select_sc").val(),
                    P_Name : $("#product_name").val(),
                    price: $("#product_price").val(),
                    qty: $("#quantity").val(),
                    Dte: $("#added_date").val(),

                },
                success: function(response)
                {
                    if(response == "NEW_PRODUCT_ADDED")
                    {
                        $("#succ").addClass("alert-success").html("<span>product added successfully <i class='fa fa-check'></i></span>");
                        $("#select_cat").val("");
                        $("#select_brand").val("");
                        $("#select_sc").val("");
                        $("#product_name").val("");
                        $("#product_price").val("");
                        $("#quantity").val("");
                        
                    }
                    else{
                        $("#succ").addClass("alert-danger").html("<span>Something went wrong, try again <i class='fa fa-times'></i></span>");

                    }
                }
            })
        }
})


})