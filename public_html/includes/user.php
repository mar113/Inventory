<?php

/**
 * user class for account creation
 */
class User
{
    private $cnx;
   function __construct() 
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->cnx = $db->connect();
    }

    //user already registred

private function emailExists($email)
{
    $pre_stmt = $this->cnx->prepare("SELECT id FROM user WHERE email = ?");
    $pre_stmt->bind_param("s",$email);
    $pre_stmt->execute() or die($this->cnx->error);
    $result = $pre_stmt->get_result();

    if($result->num_rows > 0)
    {
        return 1;
    }
    else{
        return 0 ;
    }
}

public function CreateUserAccount($username,$email,$password,$usertype)
{
    if($this->emailExists($email))
    {
        return "EMAIL_ALREADY_EXIST";
    }
    else{
    $pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
    $date = Date("Y-m-d");
    $note = "";
    $pre_stmt = $this->cnx->prepare("INSERT INTO `user`( `username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)");
    $pre_stmt ->bind_param("sssssss",$username,$email,$pass_hash,$usertype,$date,$date,$note);
    $result = $pre_stmt->execute() or die($this->cnx->error);

    if($result)
    {
        return $this->cnx->insert_id;
    }
    else
    {
        return "SOMETHING_WENT_WRONG";
    }
    }
}
public function userLogin($email,$password)
{
    $pre_stmt = $this->cnx->prepare("SELECT `id`, `username`, `email`, `password`,`usertype`, `last_login` FROM `user` WHERE email=?");
    $pre_stmt->bind_param("s",$email);
    $pre_stmt->execute() or die($this->cnx->error);
    $result = $pre_stmt->get_result();

    if($result->num_rows < 1 )
    {
        return "NOT_REGISTRED";
    }

    else
    {
        $row = $result->fetch_assoc();
        if(password_verify($password,$row["password"]))
        {
            $_SESSION["userid"] = $row['id'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["type"]= $row['usertype'];
            $_SESSION["last_login"] = $row['last_login'];
            $last_login = date("Y-m-d h:m:s");
            $pre_stmt = $this->cnx->prepare("UPDATE user SET last_login = ? where email = ? "); 
            

            $pre_stmt->bind_param("ss",$last_login,$email);
            $result = $pre_stmt->execute() or die($this->cnx->error);

            if($result)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return "PASSWORD_NOT_MATCH";
        }

    }
    
}
}
/*$user = new User();
echo $user->CreateUserAccount("mm1","m18@gmail.com","123546","seller");
echo $user->userLogin("mm1@gmail.com","123546");
echo $_SESSION["username"];*/
?>