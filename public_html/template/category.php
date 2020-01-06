<!-- Modal -->
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new category/sub category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_category" onsubmit="return false" autocomplete="off">
            <div class="form-group">
              <label>Category name</label>
              <input type="text" class="form-control" name="category name" id="category_name" placeholder="Enter category/sub category">
              <small id="c_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" id="parent_cat" name="parent_cat">
              </select>
            </div>
            <div class="form-group" id="sub" hidden>
              <label>Sub category</label>
              <select class="form-control" id="sub_cat" name="sub_cat">
              </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle">&nbsp</i>Add category</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
    </form>
      </div>
    </div>
  </div>
</div>