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
    <title>Inventory management systeme</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <script type="text/javascript" src="./Assets/js/main.js"></script>
</head>
<body>
<?php include_once("./template/header.php"); ?>
<br/>
<div class="overlay"><div class="loader"></div></div>
<div class="container">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-header"> Register </div>
            <div class="card-body">
                <form id="register" onSubmit= "return false" autocomplete ="off">
                    <div class="form-group">
                    <label for="username">Full name</label>
                    <input type="text" class="form-control" id="username"  placeholder="Enter username">
                    <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email"  placeholder="Enter email">
                    <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="password1"  placeholder="Enter password">
                    <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                    <label for="confirm">confirm password</label>
                    <input type="password" class="form-control" id="password2"  placeholder="confirm password">
                    <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="usertype"> User type</label>
                        <select name="usertype" class="form-control" id="usertype">
                        <option value="">choose your type</option>
                        <option value="1">manager</option>
                        <option value="0">seller</option>
                        </select>
                        <small id="t_error" class="form-text text-muted"></small>
                    </div>
                <button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register</button>
                </form>
            </div>
        </div>
</div>
</body>
</html>

