<?php

class DBOperation
{
    private $cnx;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->cnx = $db->connect();

    }

    public function addCategories($parent,$cat)
    {
        $pre_stmt = $this->cnx->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
        $status = 1;
        $pre_stmt->bind_param("isi",$parent,$cat,$status);
        $result = $pre_stmt->execute() or die($this->cnx->error);

        if($result)
        {
            return "CATEGORY_ADDED";
        }
        else
        {
            return 0;
        }

    }

    public function getAllRecord($table)
    {
        $pre_stmt = $this->cnx->prepare("SELECT * FROM ".$table);
        $pre_stmt->execute() or die($this->cnx->error);
        $result = $pre_stmt->get_result();

        $rows = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }
            return $rows;
        }
        return "NO_DATA";
    }

    //brand

    public function addBrand($brand_name)
    {
        $pre_stmt = $this->cnx->prepare("INSERT INTO `brand`(`brand_name`, `status`) VALUES (?,?)");
        $status = 1;
        $pre_stmt->bind_param("si",$brand_name,$status);
        $result = $pre_stmt->execute() or die($this->cnx->error);

        if($result)
        {
            return "BRAND_ADDED";
        }
        else
        {
            return 0;
        }

    }
    public function addProduct($cid,$bid,$sc,$p_name,$price,$stock,$date)
    {
        $pre_stmt = $this->cnx->prepare("INSERT INTO `products`( `cid`, `bid`,`scid`,`product_name`, `product_price`, `product_stock`, `add_date`, `p_status`) VALUES (?,?,?,?,?,?,?,?)");
        $status=1;
        $pre_stmt->bind_param("iiisdisi",$cid,$bid,$sc,$p_name,$price,$stock,$date,$status);
        $result = $pre_stmt->execute() or die($this->cnx->error);

        if($result)
        {
           return "NEW_PRODUCT_ADDED";
        }
        else{
            return 0;
        }
    }
//get all subcategory based on category id
    public function subCategory($cid)
    {
        $pre_stmt = $this->cnx->prepare("SELECT * FROM sub_category  WHERE cid = ".$cid);
        $result = $pre_stmt->execute() or die($this->cnx->error);
        $result = $pre_stmt->get_result();

        $rows = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }
            return $rows;
        }
        return "NO_DATA";
    }

    public function addSubCategory($name,$cid)
    {
        $pre_stmt = $this->cnx->prepare("INSERT INTO `sub_category`( `cid`, `scname`, `status`) VALUES (?,?,?)");
        $status = 1;
        $pre_stmt->bind_param("isi",$cid,$name,$status);
        $result = $pre_stmt->execute() or die($this->cnx->error);

        if($result)
        {
            return "NEW_SUB_ADDED";
        }
        else
        {
            return 0;
        }
    }

    //add file


/*private function isValid($file)
{

// File upload path
$targetDir = "../images/";
$fileName = basename($file["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes))
    {

                return 1;
            }
            else
            {
                return 0;
            }

    
}


public function AddSupplier($name,$mail,$phone,$file)
{
if(isValid($file))
{
$pre_stmt = $this->cnx->prepare("INSERT INTO `fournisseur`(`nom`, `email`, `tel`, `filename`, `uploaded_on`) VALUES (?,?,?,?,?)");
$time= now();
$pre_stmt->bind_param("ssiss",$name,$mail,$phone,$file,$time);
$result = $pre_stmt->execute() or die($this->cnx->error);
    
    if($result)
    {
        return "NEW SUPPLIER";
    }
    else
    {
        return "Something went wrong";
    }
}
}
*/


}


/*$opr = new DBOperation();

echo $opr->AddSupplier("xxxxx","xx@xx.com",22222222,"file");*/
