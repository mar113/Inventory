<?php
include_once("database/constants.php");
if(!isset($_SESSION['userid']))
{
    header("location:".DOMAIN."/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gstock</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="./Assets/js/order.js"></script>
</head>
<body>
<?php include_once("template/header.php"); ?>
</br></br>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
        <div class="card" style="box-shadow:0 0 25px 0 lightgrey">
  <div class="card-header">
    <h4>New Orders</h4>
  </div>
  <div class="alert" role="alert" id="succ"></div>
  <div class="card-body">
    <form id="get_order" onsubmit="return false">
        <div class="form-group row">
            <label for="order-date" class="col-sm-3" align="right">Order date:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="order_date" name="order_date" value="<?php echo date("Y-m-d")?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="customer-name" class="col-sm-3" align="right">Customer name:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="cust_name" name="cust_name" placeholder="Customer name" required>
                <small id="n_error" class="form-text text-muted"></small>
            </div>
        </div>
    <div class="card" style="box-shadow:0 0 15px 0 lightgrey">
    <div class="card-body">
    <h3>Make order list</h3>
    <table align="center" style="width:800px;">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">Item name</th>
            <th style="text-align:center;">Totale Quantity</th>
            <th style="text-align:center;">Quantity</th>
            <th style="text-align:center;">Price(DT)</th>
            <th style="text-align:center;">Total(DT)</th>
        </tr>
    </thead>
    <tbody id="invoice_item">
   <!-- <tr>
            <td><b id="number">1</b></td>
            <td>
                <select name="pname[]" class="form-control form-control-sm">
                    <option>Washing Machine</option>
                <select>
            </td>
            <td><input name="qty[]" type="text" class="form-control form-control-sm" readonly></td>
            <td><input name="price[]" type="text" class="form-control form-control-sm"></td>
            <td><input name="total[]" type="text" class="form-control form-control-sm" readonly></td>
            <td>DT.10</td>
        </tr>-->
    </tbody>
    </table>
        <center style="padding: 10px;">
        <button id="add" style="width:150px" class="btn btn-success"><i class="fa fa-plus-circle">&nbsp;</i>Add</button>
        <button id="remove" style="width:150px" class="btn btn-danger"><i class="fa fa-times">&nbsp;</i>Remove</button>
        </center>
    </div>
    </div>
    <br/>
    <div class="form-group row">
            <label for="order-date" class="col-sm-3" align="right">Total HT:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="total_ht" name="total_ht" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="customer-name" class="col-sm-3" align="right">T.F:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="tva" name="tva" placeholder="timbre fiscal" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="customer-name" class="col-sm-3" align="right">Remise:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm"  id="remise" name="remise" placeholder="remise" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="customer-name" class="col-sm-3" align="right">Total TTC:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="ttc" name="ttc" readonly>
            </div>
        </div>
        <center>
        <input type="submit" name="order_form" id="order_form" style="width:150px" class="btn btn-info" value="order">
        <input type="submit" name="print_invoice" id="print_invoice" style="width:150px" class="btn btn-success d-none" value="order">
    </form>

  </div>
</div>
        </div>
    </div>
</div>

</body>
</html>