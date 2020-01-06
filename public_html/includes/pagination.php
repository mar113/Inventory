<?php

function pagination($cnx,$table,$pno,$n)
{
    $query = $cnx->query("SELECT COUNT(*) as rows FROM ".$table);
    $row = mysqli_fetch_assoc($query);
    $pageno = $pno;
    $numberofRecordsperpage = $n;
    $last = ceil($row["rows"]/$numberofRecordsperpage);

    $pagination = "";

    if($last != 1)
    {
        if($pageno > 1)
        {
           $prec = "";
           $prec = $pageno - 1;
           $pagination .= "<a href='pagination.php?pageno=".$prec."'> Previous </a>"; 
        }
        for($i=$pageno - 5; $i < $pageno; $i++)
        {
           if($i > 0)
           {
            $pagination .="<a href= 'pagination.php?pageno=" .$i. "'>".$i."</a>";
           }
        }
        for($i;$i<=$last;$i++)
        {
            $pagination .= "<a href='pagination.php?pageno=".$i."'>".$i."</a>";
        }
        $pagination .="<a href='pagination.php?pageno=".$pageno."'>$pageno</a>";
        for($i=$pageno+1;$i <= $last;$i++)
        {
            $pagination .="<a href='pagination.php?pageno=".$i."'>".$i."</a>";
            if($i > $pageno+4)
            {
            break;
            }
        }
        if($last > $pageno)
        {
            $next = $pageno+1;
            $pagination .="<a href='pagination.php?pageno=" .$next."'>Next</a>";
        }

    }
    $limit = "LIMIT".($pageno - 1)*$numberofRecordsperpage.','.$numberofRecordsperpage; 
    return ["pagination"=>$pagination,"limit"=>$limit];
}



?>