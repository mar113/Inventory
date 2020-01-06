<?php

class Database
{
    private $cnx;
    function connect()
    {
        include_once("constants.php");
        $this->cnx = new Mysqli(HOST,USER,PASS,DB);
        if($this->cnx)
        {
            return $this->cnx;
        }
        else{
            return "DATABASE_CONNECTION_FAIL";
        }
    }
}
 
$db = new Database();
$db->connect();
