<?php
include_once("../database/constants.php");
include_once("DBoperation.php");
include_once("user.php");
include_once("manage.php");

if(isset($_POST['userName']) && isset($_POST['Email']))
{
    $user = new User();

    $result = $user->CreateUserAccount($_POST['userName'],$_POST['Email'],$_POST['password'],$_POST['userType']);

    echo $result;
    exit();
}
if(isset($_POST['EmailLog']) && isset($_POST['passwordLog']))
{
    $user = new User();

    $result = $user->userLogin($_POST['EmailLog'],$_POST['passwordLog']);

    echo $result;
    exit();
}

if(isset($_POST["getCategory"]))
{
    $opr = new DBOperation();

    $rows = $opr->getAllRecord("categories");
    foreach($rows as $row)
    {
        echo "<option value ='".$row["cid"]."'>".$row["category_name"]."</option>";
    }
    exit();
}
//add catégory
if(isset($_POST['category_name']) && isset($_POST['parent_cat']))
{
    $opr = new DBOperation();
    $result = "";
    if($_POST['parent_cat'] == 0)
    {
    $result = $opr->addCategories($_POST['parent_cat'],$_POST['category_name']);
    }
    else
    {
    $result = $opr->addSubCategory($_POST['category_name'],$_POST['parent_cat']);
    }
    echo $result;

    exit();
}
//add brand
if(isset($_POST['brand_name']))
{
    $opr = new DBOperation();
    $result = $opr->addBrand($_POST['brand_name']);
    echo $result;

    exit();
}

if(isset($_POST["getBrand"]))
{
    $opr = new DBOperation();

    $rows = $opr->getAllRecord("brand");
    foreach($rows as $row)
    {
        echo "<option value ='".$row["bid"]."'>".$row["brand_name"]."</option>";
    }
    exit();
}
// Add product
if(isset($_POST["Dte"]) && isset($_POST["P_Name"]))
{
    $opr = new DBOperation();

   $result = $opr->addProduct($_POST['Cid'],
                              $_POST['Bid'],
                              $_POST['Scid'],
                              $_POST['P_Name'],
                              $_POST['price'],
                              $_POST['qty'],
                              $_POST['Dte']);

    echo $result;
    exit();
}

//fetch subcategory

if(isset($_POST['CAT']) && ($_POST['CAT'] != 0))
{

    $opr = new DBOperation();
    $rows = $opr->subCategory($_POST['CAT']);
        foreach($rows as $row)
        {
            echo "<option value = '".$row["scid"]."'>".$row["scname"]."</option>";
        }
    
    
    exit();
}

//manage category

if(isset($_POST['manageCategory']))
{
    $mng = new Manage();
    $result = $mng->manageRecordWithPagination("categories",$_POST['pageNm']);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0)
    { $n = (($_POST['pageNm'] - 1 )* 2)+1;
        foreach($rows as $row)
        {
            ?>
            <tr style="text-align:center">
            <th scope="row"><?php echo $n; ?></th>
            <td><?php echo $row["category"]; ?></td>
            <td><?php echo $row["sub_category"]; ?></td>
            <td><span class="badge badge-success">Active</span></td>
            <td><a href="#" eid="<?php echo $row["cid"];?>"class="btn btn-warning btn-sm edit_cat" data-toggle="modal" data-target="#update_category"><i class="fa fa-edit">&nbsp</i>Edit</a>
                <a href="#" did="<?php echo $row["cid"];?>"class="btn btn-danger btn-sm del_cat"><i class="fa fa-trash">&nbsp</i>Delete</a>
                <a href="#"  class="btn btn-info btn-sm "><i class="fa fa-info">&nbsp</i>info</a>
            </td>
            </tr>
            <?php

            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination;?></td></tr>
        <?php
        
    }
    exit();
}
//delete category
if(isset($_POST['delete_cat']))
{
    $mng = new Manage();
    $result = $mng->DeleteRecord("categories","cid",$_POST['id']);
    echo $result;

    exit();
}

//update category

if(isset($_POST["updateCategory"]))
{
    $m = new Manage();

    $result = $m->getSingleRecord("categories","cid",$_POST["id"]);
    echo json_encode($result);
    exit();

}

//update record

if(isset($_POST['cName']))
{
    $id = $_POST['cIdf'];
    $name = $_POST['cName'];
    $parent = $_POST["uCat"];

    $mng = new Manage();
    $result = $mng->update_record("categories",["parent_cat"=>$parent,"category_name"=>$name,"status"=>1],["cid"=>$id]);

    echo $result;

    exit();

}
//------------------- Brands ----------------------

//manage category

if(isset($_POST['manageBrand']))
{
    $mng = new Manage();
    $result = $mng->manageRecordWithPagination("brand",$_POST['pageNm']);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0)
    { $n = (($_POST['pageNm'] - 1 )* 2)+1;
        foreach($rows as $row)
        {
            ?>
            <tr style="text-align:center">
            <th scope="row"><?php echo $n; ?></th>
            <td><?php echo $row["brand_name"]; ?></td>
            <td><span class="badge badge-success">Active</span></td>
            <td><a href="#" eid="<?php echo $row["bid"];?>"class="btn btn-warning btn-sm edit_brand" data-toggle="modal" data-target="#update_brands"><i class="fa fa-edit">&nbsp</i>Edit</a>
                <a href="#" did="<?php echo $row["bid"];?>"class="btn btn-danger btn-sm del_brand"><i class="fa fa-trash">&nbsp</i>Delete</a>
                <a href="#"  class="btn btn-info btn-sm "><i class="fa fa-info">&nbsp</i>info</a>
            </td>
            </tr>
            <?php

            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination;?></td></tr>
        <?php
        
    }
    exit();
}

//delete brand
if(isset($_POST['delete_brand']))
{
    $mng = new Manage();
    $result = $mng->DeleteRecord("brand","bid",$_POST['id']);
    echo $result;

    exit();
}


//get brand records

if(isset($_POST["updateBrand"]))
{
    $m = new Manage();

    $result = $m->getSingleRecord("brand","bid",$_POST["id"]);
    echo json_encode($result);
    exit();

}
//update record

if(isset($_POST['brand_N']))
{
    $id = $_POST['brand_id'];
    $name = $_POST['brand_N'];

    $mng = new Manage();
    $result = $mng->update_record("brand",["brand_name"=>$name,"status"=>1],["bid"=>$id]);

    echo $result;

    exit();

}

//------------------- Products -----------------------

//manage products

if(isset($_POST['manageProd']))
{
    $mng = new Manage();
    $result = $mng->manageRecordWithPagination("products",$_POST['pageNm']);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0)
    { $n = (($_POST['pageNm'] - 1 )* 2)+1;
        foreach($rows as $row)
        {
            ?>
            <tr style="text-align:center">
            <th scope="row"><?php echo $n; ?></th>
            <td><?php echo $row["add_date"]; ?></td>
            <td><?php echo $row["product_name"]; ?></td>
            <td><?php echo $row["category_name"]; ?></td>
            <td><?php echo $row["scname"]; ?></td>
            <td><?php echo $row["brand_name"]; ?></td>
            <td><?php echo $row["product_stock"]; ?></td>
            <td><?php echo $row["product_price"]; ?></td>
            <td><span class="badge badge-success">Active</span></td>
            <td><a href="#" eid="<?php echo $row["pid"];?>"class="btn btn-warning btn-sm edit_prod" data-toggle="modal" data-target="#update_products"><i class="fa fa-edit">&nbsp</i>Edit</a>
                <a href="#" did="<?php echo $row["pid"];?>"class="btn btn-danger btn-sm del_prod"><i class="fa fa-trash">&nbsp</i>Delete</a>
                <a href="#"  class="btn btn-info btn-sm "><i class="fa fa-info">&nbsp</i>info</a>
            </td>
            </tr>
            <?php

            $n++;
        }
        ?>
        <tr><td colspan="10"><?php echo $pagination;?></td></tr>
        <?php
        
    }
    exit();
}

//delete brand
if(isset($_POST['delete_product']))
{
    $mng = new Manage();
    $result = $mng->DeleteRecord("products","pid",$_POST['id']);
    echo $result;

    exit();
}

//get products records

if(isset($_POST["updateProducts"]))
{
    $m = new Manage();

    $result = $m->getSingleRecord("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();

}

// update products

if(isset($_POST['pName']))
{
    
    $mng = new Manage();
    $id = $_POST['pIdf'];
    $name = $_POST['pName'];
    $cat = $_POST['CatProd'];
    $brand = $_POST['bName'];
    $scname = $_POST['pscName'];
    $pqty = $_POST['stck'];
    $price_p = $_POST['price'];
    $date_p = $_POST['date'];

    
    $result = $mng->update_record("products",["cid"=>$cat,"bid"=>$brand,"scid"=>$scname,"product_name"=>$name,"product_price"=>$price_p,"product_stock"=>$pqty,"add_date"=>$date_p,"p_status"=>1],["pid"=>$id]);
    echo $result;

    exit();

}
//---------- order ------------

if(isset($_POST['getNewItem']))
{
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("products");
?>
<tr>
    <td><b class="number">1</b></td>
    <td>
        <select name="pname[]" class="form-control form-control-sm pid">
        <option value="">-Choose product-</option> 
        
            <?php 
        
            foreach ($rows as $row) {
                ?>
                <option value="<?php echo $row['pid']; ?>"><?php echo $row['product_name']; ?></option> 
                <?php
            }  ?>
        <select>
    </td>
    <td><input name="tqty[]" type="text" class="form-control form-control-sm tqty" readonly></td>
    <td><input name="qty[]" type="text" class="form-control form-control-sm qty"></td>
    <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></td>
    <td><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></td>
    <td><span class="amt"></span></td>
</tr>

<?php

exit();
}

//get price and quantity

if(isset($_POST['getPriceAndQty']))
{
    $mng = new Manage();
   $result = $mng->getSingleRecord("products","pid",$_POST['id']);

   echo json_encode($result);

   exit();

}

//--------order process -------

if(isset($_POST['cust_name']) && isset($_POST['order_date']))
{
    $order_date = $_POST['order_date'];
    $cust_name = $_POST['cust_name'];

    //getting data form array;

    /*$ar_tqty = $_POST['tqty'];
    $ar_qty = $_POST['qty'];
    $ar_price = $_POST['price'];
    $ar_pname =$_POST['pro_name'];
    $total_ht =$_POST['Th'];
    $tva = $_POST['Tva'];
    $remise = $_POST['red'];
    $ttc = $_POST['ttc'];*/

    $mng = new Manage();

    $result = $mng->storingInvoice($_POST['order_date'],$_POST['cust_name'],$_POST['qty'],$_POST['tqty'],$_POST['price'],$_POST['pro_name'],$_POST['total_ht'],$_POST['tva'],$_POST['remise'],$_POST['ttc']);
    echo $result;
exit();
}


// get user records

if(isset($_POST["updateuser"]))
{
    $m = new Manage();

    $result = $m->getSingleRecord("user","id",$_POST["id"]);
    echo json_encode($result);
    exit();

}


// get clients record

if(isset($_POST['getClient']))
{
    $mng = new Manage();
    $result = $mng->manageRecordWithPagination("invoice",$_POST['pageNb']);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0)
    { $n = (($_POST['pageNb'] - 1 )* 2)+1;
        foreach($rows as $row)
        {
            ?>
            <tr style="text-align:center">
            <th scope="row"><?php echo $n; ?></th>
            <td><?php echo $row["cust_name"]; ?></td>
            <td><?php echo $row["order_date"]; ?></td>
            <td><?php echo $row["ttc"]; ?></td>
            <td><a href="./PDF_INVOICE/PDF_INVOICE_<?php echo $row['invoice_no'];?>.PDF" target="_blank">PDF</a></td>
            </tr>
            <?php

            $n++;
        }
        ?>
        <tr><td colspan="10"><?php echo $pagination;?></td></tr>
        <?php
        
    }
    exit();
}
// get clients record

if(isset($_POST['getSupplier']))
{
    $mng = new Manage();
    $result = $mng->manageRecordWithPagination("fournisseur",$_POST['pageNb']);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0)
    { $n = (($_POST['pageNb'] - 1 )* 2)+1;
        foreach($rows as $row)
        {
            ?>
            <tr style="text-align:center">
            <th scope="row"><?php echo $n; ?></th>
            <td><?php echo $row["nom"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["tel"]; ?></td>
            <td><a href="./uploads/<?php echo $row['filename'];?>" target="_blank">Document</a></td>
            </tr>
            <?php

            $n++;
        }
        ?>
        <tr><td colspan="10"><?php echo $pagination;?></td></tr>
        <?php
        
    }
    exit();

}



