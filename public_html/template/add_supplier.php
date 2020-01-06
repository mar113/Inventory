
<!-- Modal -->

<div class="modal fade" id="supp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="supplier_form" onsubmit="return false" autocomplete="off">
            <div class="form-group">
              <label>Name:</label>
             <!-- <input type="hidden" name="cid" id="cid" value="">-->
              <input type="text" class="form-control" name="sup_name" id="sup_name" placeholder="Enter supplier name">
              <small id="c_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input type="email" class="form-control" name="sup_mail" id="sup_mail" placeholder="Enter supplier email">
              <small id="e_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Phone:</label>
              <input type="text" class="form-control" name="sup_phone" id="sup_phone" placeholder="Enter supplier phone number">
              <small id="p_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>File:</label>
              <input type="file" class="form-control" name="fichier" id="fichier">
              <small id="f_error" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-plus">&nbsp</i>Add</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
    </form>
      </div>
    </div>
  </div>
</div>