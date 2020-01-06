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
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="./Assets/js/client.js"></script>
</head>
<body>
<?php include_once("template/header.php"); ?>
</br></br>
<div class="container">
<div class="alert" role="alert" id="succ">
</div>
<br/><br/>
<table class="table table-hover table-bordered">
  <thead>
    <tr style ="text-align:center">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Date d'achat</th>
      <th scope="col">Montant</th>
      <th scope="col">Facture</th>
    </tr>
  </thead>
        <tbody id="Client">


        </tbody>
</table>
</div>
</body>
</html>