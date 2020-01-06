<?php
include_once("./database/constants.php");
if(isset($_SESSION['userid']))
{
  header("location:".DOMAIN."/Dashboard.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <script type="text/javascript" src="./Assets/js/main.js"></script>
</head>
<body>
<div class="overlay"><div class="loader"></div></div>
<div style="height:50px"></div>
<div class="container">
<?php
    if(isset($_GET['msg']) && !empty($_GET['msg']))
    {
   ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_GET['msg'];?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   <?php   
    }
?>
<div class="card mx-auto" style="width: 18rem;">
  
  <div class="card-body">
    <form id="login_form" onsubmit="return false" autocomplete="off">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" name="logmail" id="logmail" placeholder="Enter email">
        <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="logpass" id="logpass" placeholder="Password">
        <small id="p_error" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </br>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in">&nbsp</i>Login</button>
    </form>
  </div>

</div>
</div>
</body>
</html>

