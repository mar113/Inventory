$(document).ready(function(){
    var DOMAIN = "http://localhost/inventory/public_html";

    addnewItem();
    $("#add").click(function(){
        addnewItem();
    })

    function addnewItem()
    {
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method: "POST",
            data:{getNewItem:1},
            success:function(response){
                //console.log(response);
                $("#invoice_item").append(response);

                var n = 0;

                $(".number").each(function(){
                    $(this).html(++n);
                })
            }
        })
    }

    $("#remove").click(function(){
        $("#invoice_item").children("tr:last").remove();
        calcule(0);
    })

    $("#invoice_item").delegate(".pid","change",function(){
        var pid = $(this).val();
        var tr =$(this).parent().parent();

        $(".overlay").show();
        $.ajax({
            url:DOMAIN+"/includes/process",
            method: "POST",
            dataType: "json",
            data:{getPriceAndQty : 1 , id: pid},

            success : function(response)
            {
                tr.find(".tqty").val(response['product_stock']);
                tr.find(".pro_name").val(response['product_name']);
                tr.find(".qty").val(1);
                tr.find(".price").val(response['product_price']);
                tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
                calcule(0)
            }
        })
        
    })
    $("#invoice_item").delegate(".qty","keyup",function(){
        var qty = $(this);
        var tr =$(this).parent().parent();

        if(isNaN(qty.val()))
        {
            alert("Please enter a valid quantity number ");
            qty.val(1);
        }
        else{
            
            if(qty.val() - 0> tr.find(".tqty").val() - 0)
            {
                alert("Sorry! we don't have this quantity");
                qty.val(1);
            }
            else{
                tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
                calcule(0);

            }
        }
    })

    function calcule(dis) {
        var total_ht = 0;
        var net = 0;
        var discount = dis;
        $(".amt").each(function(){
            total_ht = total_ht + ($(this).html() * 1);
        })
        $("#total_ht").val(total_ht);
       var tva = 0.6;
       $("#tva").val(tva);
        net = tva + total_ht;
        net = net - discount;
        $("#remise").val(dis);
        $("#ttc").val(net);
        
    }

    $("#remise").keyup(function () {
        var discount = $(this).val();
        calcule(discount);
    })

    $("#order_form").click(function() {
        var invoice = $("#get_order").serialize();
        if($("#cust_name").val() == "")
        {
            $("#cust_name").addClass("border-danger");
            $("#n_error").html("<span class='text-danger'> Please enter customer name ! <i class='fa fa-times'></i></span>"); 
        }
        else if(confirm("Do u want save order and print invoice?")) {
            $("#cust_name").removeClass("border-danger");
            $("#n_error").html(""); 

        $.ajax({
            url:DOMAIN+"/includes/process.php",
            method: "POST",
            data: $("#get_order").serialize(), /*{
                Od : $("#order_date").val(),
                Cn : $("#cust_name").val(),
                Th : $("#total_ht").val(),
                Tva :$("#tva").val(),
                red : $("#remise").val(),
                ttc : $("#ttc").val(),

            },*/
            success : function(response) {
                //alert(response);
                if(response < 0 )
                {
                    $("#succ").addClass("alert-danger").html("<span>Something went wrong <i class='fa fa-times'></i></span>");
                }
                else {
                    window.open(DOMAIN+"/includes/invoice_bill.php?invoice_no="+response+"&"+invoice, '_blank');
                    $("#get_order").trigger('reset');
                    /*$("#cust_name").val(),
                    $("#total_ht").val(),
                    $("#tva").val(),
                    $("#remise").val(),
                    $("#ttc").val(),*/
                }
            }
        })
    }
    })
});