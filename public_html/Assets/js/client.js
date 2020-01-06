$(document).ready(function () {
    var DOMAIN = "http://localhost/inventory/public_html";
    getAllClient(1);
    function getAllClient(pn){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data:{
                getClient:1,
                pageNb: pn,
                
            },
            success:function(response)
            {
               // alert(response);
                $("#Client").html(response);
                
                
            }
        })
        

}   
    
})