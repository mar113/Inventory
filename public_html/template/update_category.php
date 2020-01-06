
<!-- Modal -->
<div class="modal fade" id="update_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="update_form" onsubmit="return false" autocomplete="off">
            <div class="form-group">
              <label>Category name</label>
              <input type="hidden" name="cid" id="cid" value="">
              <input type="text" class="form-control" name="update_category" id="up_cat_name" placeholder="Enter category/sub category">
              <small id="c_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" id="update_cat" name="update_cat">
              </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-refresh">&nbsp</i>update category</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
    </form>
      </div>
    </div>
  </div>
</div>