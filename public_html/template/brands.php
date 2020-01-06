
<!-- Modal -->
<div class="modal fade" id="brands" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="brand_form" onsubmit="return false" autocomplete="off">
            <div class="form-group">
              <label>Brand name</label>
              <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter brand name">
              <small id="b_error" class="form-text text-muted"></small>
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle">&nbsp</i>Add brand</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
      </form>
      </div>
    </div>
  </div>
</div>