$(document).ready(function(){
    var DOMAIN = "http://localhost/inventory/public_html";

//Manage category
manageCategory(1);
function manageCategory(pn){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                manageCategory:1,
                pageNm: pn,
            },
            success:function(response)
            {
               // alert(response);
                $("#Cat").html(response);
                
                
            }
        })

}
$("body").delegate(".page-link","click",function(){
    var pn = $(this).attr("pn");
    manageCategory(pn);
})

$("body").delegate(".del_cat","click",function(){
    var did = $(this).attr("did");
    if(confirm("Are you sure you want to delete this category?"))
    {
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                delete_cat:1,
                id: did,
                
            },
            success:function(response)
            {
                if(response =="CATEGORY AND IT'S SUB CATEGORY HAS BEEN DELETED")
                {
               $("#succ").addClass("alert-success").html("<span> Category deleted successfully..!</span>");
               manageCategory(1);
                }

                else{
                    $("#succ").removeClass("alert-danger").html("");
                    alert("Something went wrong !");
                }
                
                
            }
        })
    }
    else
    {
        alert("No");
    }
})
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
           $("#update_cat").html(root+response);
           $("#update_catp").html(root+response);
        }


    })
}

//update category

$("body").delegate(".edit_cat","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "POST",
        dataType : "json",
        data : { updateCategory: 1, id: eid},

        success:function(response)
        {
           // console.log(response);
            $("#cid").val(response["cid"]);
            $("#up_cat_name").val(response["category_name"]);
            $("#update_cat").val(response["parent_cat"]);
        }
    })
})
$("#update_form").on("submit", function(){
    if($("#up_cat_name").val() == "")
    {
        $("up_cat_name").addClass("border-danger");
        $("#c_error").html("<span class='text-danger'> Please enter category name <i class='fa fa-times'></i></span>");

    }
    else
    {
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method : "POST",
            data : {

                cIdf: $("#cid").val(),
                cName: $("#up_cat_name").val(),
                uCat: $("#update_cat").val(),

            },
            success: function(response)
            {
                window.location.href="";
            }
        })
    }
})
// ---------------------- Brands ----------------------

manageBrand(1);
function manageBrand(pn){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                manageBrand:1,
                pageNm: pn,
            },
            success:function(response)
            {
                //alert(response);
                $("#brands").html(response);
                
                
            }
        })

}

$("body").delegate(".page-link","click",function(){
    var pn = $(this).attr("pn");
    manageBrand(pn);
})

$("body").delegate(".del_brand","click",function(){
    var did = $(this).attr("did");
    if(confirm("Are you sure you want to delete this brand?"))
    {
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                delete_brand: 1,
                id: did,
                
            },
            success:function(response)
            {
                if(response == "Deleted")
                {
                    
               $("#succ").addClass("alert-success").html("<span> Brand deleted successfully..!</span>");
               manageBrand(1);
                }
               // alert(response);
                
            }
        })
    }
    else
    {
        alert("No");
    }
})

//update brand

$("body").delegate(".edit_brand","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "POST",
        dataType : "json",
        data : { updateBrand: 1, id: eid},

        success:function(response)
        {
           // console.log(response);
            $("#bid").val(response["bid"]);
            $("#up_brand_name").val(response["brand_name"]);
        }
    })
})

$("#update_brand").on("submit", function(){
    if($("#up_brand_name").val() == "")
    {
        $("#up_brand_name").addClass("border-danger");
        $("#b_error").html("<span class='text-danger'> Please enter category name <i class='fa fa-times'></i></span>");

    }
    else
    {
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method : "POST",
            data : {
                brand_id : $("#bid").val(),
                brand_N : $("#up_brand_name").val(),
            },
            success: function(response)
            {
              
                window.location.href="";
                
            }
        })
    }
})


//--------------------- Manage products ------------------

manageProducts(1);
function manageProducts(pn){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                manageProd:1,
                pageNm: pn,
            },
            success:function(response)
            {
                //console.log(response);
                $("#products").html(response);
                
                
            }
        })

    
}

$("body").delegate(".page-link","click",function(){
    var pn = $(this).attr("pn");
    manageProducts(pn);
})

$("body").delegate(".del_prod","click",function(){
    var did = $(this).attr("did");
    if(confirm("Are you sure you want to delete this product?"))
    {
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                delete_product: 1,
                id: did,
                
            },
            success:function(response)
            {
                if(response =="Deleted")
                {
                    
               $("#succ").addClass("alert-success").html("<span> Product deleted successfully..!</span>");
               manageProducts(1);
                }
                
            }
        })
    }
    else
    {
        alert("No");
    }
})
//update prod

$("body").delegate(".edit_prod","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "POST",
        dataType : "json",
        data : { updateProducts: 1, id: eid},

        success:function(response)
        {
            
           //console.log(response);
            $("#pid").val(response["pid"]);
            $("#update_product").val(response["product_name"]);
            //fetching_category();
            $("#update_catp").val(response["cid"]);
            $("#update_sc").val(response["scid"]);
            //fetching_brands();
            $("#update_brandp").val(response["bid"]);
            $("#update_price").val(response["product_price"]);
            $("#update_quantity").val(response["product_stock"]);
        }
    })
})
$("#product_update").on("submit", function(){
    if($("#update_product").val() == "")
    {
        $("update_product").addClass("border-danger");
        $("#b_error").html("<span class='text-danger'> Please enter category name <i class='fa fa-times'></i></span>");

    }
    else
    {
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method : "POST",
            data : {
                pIdf: $("#pid").val(),
                date: $("#added_date").val(),
                pName: $("#update_product").val(),
                CatProd: $("#update_catp").val(),
                pscName: $("#update_sc").val(),
                bName: $("#update_brandp").val(),
                price: $("#update_price").val(),
                stck: $("#update_quantity").val(),

            },
            success: function(response)
            {
                //alert(response);
                if(response == "UPDATED")
                {
                    
                    
             
               $("#succ").addClass("alert-success").html("<span> row updated successfully..!</span>");
                    
               manageProducts(1);

               
                }
                

            }
        })
    }
})
fetching_brands();
function fetching_brands(){
    $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: 'POST',
        data: {
            getBrand: 1,
        },
        success : function(response){
            var root = "<option value=''>--root--</option>";
           $("#update_brandp").html(root+response);
        }


    })
}

fetching_psub_category();
function fetching_psub_category(){
    $("#update_catp").change(function(){
        var categorie = $(this).children("option:selected");
        $.ajax({
            url:DOMAIN+"/includes/process.php",
            method: 'POST',
            data : {
                CAT : categorie.val(),
            },
            success: function(response){
                var choose = "<option value='0'>--choose--</option>";
                $("#update_sc").html(choose+response);
                $("#scp").fadeIn("slow").removeAttr("hidden");
            }
        })
        
    })


}
// update user


$("body").delegate(".edit_user","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "POST",
        dataType : "json",
        data : { updateuser: 1, id: eid},

        success:function(response)
        {
            
           //console.log(response);
            $("#uid").val(response["id"]);
            $("#user_name").val(response["username"]);
            //fetching_category();
            $("#user_mail").val(response["email"]);

        }
    })
})
})