<?php
include_once("./database/constants.php");
if(isset($_SESSION['userid']))
{
    session_destroy();  

}
$msg=$_GET["msg"];
header("location:".DOMAIN."/index.php?msg=".$msg);
?>