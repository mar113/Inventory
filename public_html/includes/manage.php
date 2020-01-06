<?php

class Manage
{
    private $cnx;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->cnx = $db->connect();

    }
    public function manageRecordWithPagination($table,$pno)
    {   $a = $this->pagination($this->cnx,$table,$pno,10);
        if($table == "categories")
        {
            $sql = "SELECT c.cid,c.category_name as category, s.scname as sub_category, s.status FROM categories c,sub_category s WHERE c.cid = s.cid ORDER BY c.category_name ".$a["limit"];
        }
        elseif ($table == "products") {
          $sql =  "SELECT p.pid, p.product_name,c.category_name,b.brand_name,s.scname,p.product_price,p.product_stock,p.add_date,p.p_status FROM products p,categories c,sub_category s,brand b WHERE p.cid = c.cid AND p.scid = s.scid AND p.bid = b.bid ".$a["limit"];
        }
        else{
            $sql = "SELECT * FROM ".$table." ".$a["limit"];
            }
       $result = $this->cnx->query($sql) or die($this->cnx->error);
       $rows = array();
       if($result->num_rows > 0) 
       {
           while($row = $result->fetch_assoc()){
            $rows[] = $row;
           }           
       }
       return ["rows"=>$rows,"pagination"=>$a["pagination"]];
    }

   private function pagination($cnx,$table,$pno,$n)
{
    $query = $cnx->query("SELECT COUNT(*) as rows FROM ".$table);
    $row = mysqli_fetch_assoc($query);
    $pageno = $pno;
    $numberofRecordsperpage = $n;
    $last = ceil($row["rows"]/$numberofRecordsperpage);

    $pagination = "<ul class='pagination'>";

    if($last != 1)
    {
        if($pageno > 1)
        {
           $prec = "";
           $prec = $pageno - 1;
           $pagination .= "<li class='page-item'><a class='page-link' pn='".$prec."'href='#'> Previous </a></li>"; 
        }
        for($i=$pageno - 5; $i < $pageno; $i++)
        {
           if($i > 0)
           {
            $pagination .="<li class='page-item'><a class='page-link' pn='" .$i. "' href='#' >".$i."</a><li>";
           }
        }
        /*for($i;$i<=$last;$i++)
        {
            $pagination .= "<a href='pagination.php?pageno=".$i."'>".$i."</a>";
        }*/
        $pagination .="<li class='page-item'><a class='page-link' pn='".$pageno."' href='#'>$pageno</a><li>";
        for($i=$pageno+1;$i <= $last;$i++)
        {
            $pagination .="<li class='page-item'><a class='page-link' pn='".$i."'href='#'>".$i."</a><li>";
            if($i > $pageno+4)
            {
            break;
            }
        }
        if($last > $pageno)
        {
            $next = $pageno+1;
            $pagination .="<li class='page-item'><a class='page-link' pn='" .$next."' href='#'>Next</a><li></ul>";
        }

    }
    $limit = "LIMIT ".($pageno - 1) * $numberofRecordsperpage.','.$numberofRecordsperpage; 
    return ["pagination"=>$pagination,"limit"=>$limit];
}

public function DeleteRecord($table,$pk,$id)
{
    if($table == "categories")
    {
    $pre_stmt = $this->cnx->prepare("SELECT ".$id." FROM categories c, sub_category s WHERE s.cid = ?");
    $pre_stmt->bind_param("i",$id);
    $pre_stmt->execute();
    $result = $pre_stmt->get_result() or die($this->cnx->error);

    if($result->num_rows > 0)
    {
        $pre_stmt = $this->cnx->prepare("DELETE FROM ".$table." WHERE ".$pk." = ? " );
        $pre_stmt->bind_param("i",$id);
        $result=$pre_stmt->execute() or die($this->cnx->error);

        if($result)
        {
            return "CATEGORY AND IT'S SUB CATEGORY HAS BEEN DELETED";
        }
        else{
            return "no";
        }
    }
 
    }
    else{
        $pre_stmt = $this->cnx->prepare("DELETE FROM ".$table." WHERE ".$pk." = ? " );
        $pre_stmt->bind_param("i",$id);
        $result=$pre_stmt->execute() or die($this->cnx->error);
        if($result)
        {
            return "Deleted";
        }

    }
}

public function getSingleRecord($table,$pk,$id)
{
    $pre_stmt = $this->cnx->prepare("SELECT * FROM ".$table." WHERE " .$pk. " = ? ");
    $pre_stmt->bind_param("i",$id);
    $pre_stmt->execute() or die($this->cnx->error);
    $result = $pre_stmt->get_result();
    $row="";
    if($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
    }
    return $row;
}

function update_record($table_name, $form_data, $where_clause)
{
    // check for optional where clause
    $SQL = '';
    $condition="";

    foreach ($where_clause as $column => $value) {
        $condition .= $column . " = ". $value . " AND ";
       // var_dump($condition);
    }
    $condition=substr($condition,0,-5);
    // var_dump($condition);
    // start the actual SQL statement
    $sql = "UPDATE `" .$table_name. "` SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "" .$column. " = '" .$value. "' ";
    }
    //var_dump($sets);
    $sql .= implode(', ', $sets);
//var_dump($sql);
    // append the where statement
    $sql .= "WHERE ".$condition;
//var_dump($sql);
    // run and return the query result
    if(mysqli_query($this->cnx,$sql))
    {
        return "UPDATED";
    }
}

// storing invoice

public function storingInvoice($order_date,$cust_name,$ar_qty,$ar_tqty,$ar_price,$ar_pro_name,$total_ht,$tva,$remise,$total_ttc)
{
    $pre_stmt = $this->cnx->prepare("INSERT INTO `invoice`(`cust_name`, `order_date`, `total_ht`, `tva`, `remise`, `ttc`) VALUES (?,?,?,?,?,?)");
    $pre_stmt->bind_param("ssdddd",$cust_name,$order_date,$total_ht,$tva,$remise,$total_ttc);
    $pre_stmt->execute() or die($this->cnx->error);
    $invoice_no = $pre_stmt->insert_id;
    /*$result = $pre_stmt->get_result();
    $stmt ="SELECT MAX(`invoice_no`) FROM `invoice`";
    $result = $this->cnx->query($stmt);*/
    //$invoice_no = mysqli_fetch_array($result);
    
   // var_dump($invoice_no);
  //$ar_price = array();
  //var_dump($ar_price);
   if($invoice_no != null)
    {

        for($i=0; $i <  count((array)$ar_price) ; $i++)
        {

            $rem_qty = $ar_tqty[$i] - $ar_qty[$i];
            if($rem_qty < 0)
            {
                return "unable to proceed order !";
            }
            else
            {
                $sql = " UPDATE products SET  product_stock  = '$rem_qty' WHERE product_name = '" .$ar_pro_name[$i]. "'" ; 
                $this->cnx->query($sql);
            }
            
            $insert_prod = $this->cnx->prepare("INSERT INTO `invoice_detail`(`invoice_num`, `product_name`, `product_price`, `quantity`) VALUES (?,?,?,?)");
            $insert_prod->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
            $insert_prod->execute() or die($this->cnx->error);

        }

        return $invoice_no;
    }

        
    
}
}
//$mng = new Manage();
/*echo "<pre>";
print_r($mng->storingInvoice("2019-11-12","marwen",2,5,10,"p3",10,1,0,13));*/
//print_r($mng->DeleteRecord("brand","bid",5));
//$mng->update_record("brand",["brand_name"=>"sunsilek12","status"=>1],["bid"=>6]);
//echo $mng->update_record("products",["cid"=>46,"bid"=>11,"scid"=>53,"product_name"=>"p12","product_price"=>20,"product_stock"=>3000,"add_date"=>"2019-12-15","p_status"=>1],["pid"=>41]);
?>