
<!-- Modal -->
<div class="modal fade" id="update_brands" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="update_brand" onsubmit="return false" autocomplete="off">
            <div class="form-group">
              <label>Brand name</label>
              <input type="hidden" name="bid" id="bid" value="">
              <input type="text" class="form-control" name="up_brand_name" id="up_brand_name" placeholder="Enter brand">
              <small id="b_error" class="form-text text-muted"></small>
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-refresh">&nbsp</i>update brand</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
    </form>
      </div>
    </div>
  </div>
</div>