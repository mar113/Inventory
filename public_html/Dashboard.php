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
    <title>Gstock:Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/css/Chart.min.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="./Assets/js/main.js"></script>
    <script type="text/javascript" src="./Assets/js/Chart.min.js"></script>
</head>
<body>
<?php include_once("template/header.php"); ?>
</br></br>
<div class="container">
<div class="row">
    <div class="col-md-4">
        <div class="card mx-auto" style="width: 20rem;box-shadow:0 0 15px 0 lightgrey;height:100%">
        <div class="card-body">
        <h5 class="card-title"><i class="fa fa-user">&nbsp</i>Profile</h5>
    
        <p class="card-title"><strong> user: </strong><?php echo $_SESSION['username'];?> </p>
        <p class="card-title"><strong> Type :</strong> <?php echo $_SESSION['type'];?></p>
        <p class="card-title"><strong>last login :</strong> <?php echo $_SESSION['last_login'];?> </p>

        <?php
    if($_SESSION['type'] == 'Manager')
    {
        ?>
    
        <a href="#" class="btn btn-info edit_user" eid=<?php echo $_SESSION['userid']?> data-toggle="modal" data-target="#profile"><i class="fa fa-edit">&nbsp</i>Edit</a>
    
        
        <a href="register.php" class="btn btn-success" ><i class="fa fa-user-plus">&nbsp</i>User</a>
        <?php
    }
        ?>
        </div>
        </div>
    </div>
    <div class="col-md-8">
        <div style="width:100%; height:100%;box-shadow:0 0 15px 0 lightgrey;opacity:0.6">
        <canvas id="myChart"  height="100%"></canvas>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
        </div>
    </div>
</div>
</div>
<p></p>
<p></p>

<?php
if($_SESSION['type'] == "Manager")
{
?>
<div class="container">
<div class="row">
    <div class="col-md-4">
    <div class="card mx-auto" style="width: 20rem;box-shadow:0 0 15px 0 lightgrey">
    <div class="card-body" >
    <h5 class="card-title">Categories</h5>

    <p class="card-text">Manage your categories</p>
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#category"><i class="fa fa-plus">&nbsp</i>Add</a>
    <a href="manage_category.php" class="btn btn-warning"><i class="fa fa-cogs">&nbsp</i>Manage</a>
  </div>
</div>
    </div>
    <div class="col-md-4">
    <div class="card" style="width: 20rem;box-shadow:0 0 15px 0 lightgrey">
    <div class="card-body" style="width: 20rem;">
    <h5 class="card-title">Brands</h5>

    <p class="card-text">Manage your brands</p>
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#brands"><i class="fa fa-plus">&nbsp</i>Add</a>
    <a href="manage_brand.php" class="btn btn-warning"><i class="fa fa-cogs">&nbsp</i>Manage</a>
  </div>
</div>
    </div>
    <div class="col-md-4">
    <div class="card" style="box-shadow:0 0 15px 0 lightgrey">
    <div class="card-body" style="width: 20rem;">
    <h5 class="card-title">Products</h5>

    <p class="card-text">Manage your products</p>
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#products"><i class="fa fa-plus">&nbsp</i>Add</a>
    <a href="manage_products.php" class="btn btn-warning"><i class="fa fa-cogs">&nbsp</i>Manage</a>
  </div>
</div>
    </div>
</div>
</div>
<?php } ?>
<?php
include_once("./template/category.php");
?>
<?php
include_once("./template/brands.php");
?>
<?php
include_once("./template/products.php");
?>
<?php
include_once("./template/user_profile.php");
?>


</body>
</html>