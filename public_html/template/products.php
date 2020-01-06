<!-- Modal -->
<div class="modal fade" id="products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert" role="alert" id="succ"></div>
      <div class="modal-body">
      <form id="product_form" onsubmit="return false" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Date</label>
            <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d");?>" readonly/>
          </div>
          <div class="form-group col-md-6">
            <label>Product name</label>
            <input type="text" class="form-control" name="product name" id="product_name" placeholder="Product name">
            <small id="pn_error" class="form-text text-muted"></small>
          </div>
        </div>
        <div class="form-group">
          <label >Category</label>
          <select class="form-control" id="select_cat" name="select_cat">
          </select>
          <small id="c_error" class="form-text text-muted"></small>
        </div>
        <div class="form-group" id="scp" hidden>
          <label >Sub-category</label>
          <select class="form-control" id="select_sc" name="select_sc">
          </select>
          <small id="sc_error" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label >Brand</label>
          <select class="form-control" id="select_brand" name="select_brand">
          </select>
          <small id="b_error" class="form-text text-muted"></small>
        </div>
          <div class="form-group">
            <label>Product price</label>
            <input type="text" class="form-control" id="product_price">
            <small id="pr_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" class="form-control" id="quantity">
            <small id="q_error" class="form-text text-muted"></small>
          </div>
  <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle">&nbsp</i>Add product</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-refresh">&nbsp</i>Cancel</button>
</form>
      </div>
    </div>
  </div>
</div>