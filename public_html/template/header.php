<?php
include_once("database/constants.php");
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#"><img src="./Assets/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
      <?php 
      if($_SESSION['type'] == "Manager")
        { 
        ?>
        <a class="nav-link" href="Dashboard.php"><i class="fa fa-home">&nbsp</i>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="manage_supplier.php"><i class="fa fa-user">&nbsp</i>fournisseur</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="client.php"><i class="fa fa-users">&nbsp</i>Client</a>
      </li>
      <?php 
        } ;
      ?>
      <li class="nav-item">
        <a class="nav-link" href="new_order.php"><i class="fa fa-shopping-cart">&nbsp</i>Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#" data-toggle="modal" data-target="#logout" ><i class="fa fa-sign-out">&nbsp</i>Logout</a>
      </li>
    </ul>
  </div>
  <?php
include_once("logout_m.php");
?>
</nav>
