<!-- Modal -->
<script src="./Assets/js/manage.js"></script>
<div class="modal fade" id="update_products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="product_update">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Date</label>
            <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d");?>" readonly/>
          </div>
          <div class="form-group col-md-6">
            <label>Product name</label>
            <input type="hidden" name="pid" id="pid" value="">
            <input type="text" class="form-control" name="update_product" id="update_product" placeholder="Product name" required>
          </div>
        </div>
        <div class="form-group">
          <label >Category</label>
          <select class="form-control" id="update_catp" name="update_catp" required>
          </select>
        </div>
        <div class="form-group">
          <label >Sub-category</label>
          <select class="form-control" id="update_sc" name="update_sc">
          </select>
        </div>
        <div class="form-group">
          <label >Brand</label>
          <select class="form-control" id="update_brandp" name="update_brandp" required>
          </select>
        </div>
          <div class="form-group">
            <label>Product price</label>
            <input type="text" class="form-control" id="update_price"  name="update_price"required>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" class="form-control" id="update_quantity" name="update_quantity" required>
          </div>
  <button type="submit" class="btn btn-success"><i class="fa fa-refresh">&nbsp</i>update product</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
</form>
      </div>
    </div>
  </div>
</div>