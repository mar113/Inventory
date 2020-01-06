$(document).ready(function () {
    var DOMAIN = "http://localhost/inventory/public_html";
//Add supplier

$("#supplier_form").on("submit", function () {

    if($("#sup_name").val() == "")
    {
        $("#sup_name").addClass("border-danger");
        $("#c_error").html("<span class='text-danger'> Please enter a category name <i class='fa fa-times'></i></span>"); 
    }
    else
    {
        $("#sup_name").removeClass("border-danger");
        $("#c_error").html("");
        $.ajax({
            url: DOMAIN+"/includes/supplier.php",
            method : "POST",
            data : new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            success : function(response)
            {
                $("#sup_name").val("");
                $("#sup_mail").val("");
                $("#sup_phone").val("");
                $("#fichier").val("");
                getAllsupplier(1);
            }
        })
    }
    
})
getAllsupplier(1);
function getAllsupplier(pn){
    $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "POST",
        data:{
            getSupplier:1,
            pageNb: pn,
            
        },
        success:function(response)
        {
           // alert(response);
            $("#Supplier").html(response);
            
            
        }
    })
    

}   
})