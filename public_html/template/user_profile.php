<!-- Modal -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="user_update">
          <div class="form-group">
            <label>New user Name</label>
            <input type="hidden" name="uid" id="uid" value="">
            <input type="text" class="form-control" id="user_name"  name="user_name"required>
          </div>
          <div class="form-group">
            <label>New user Email</label>
            <input type="text" class="form-control" id="user_mail"  name="user_mail"required>
          </div>
          <div class="form-group">
            <label>New user Password</label>
            <input type="password" class="form-control" id="user_pwd" name="user_pwd" placeholder ="type your new password" required>
          </div>
          <div class="form-group">
            <label>Confirm user Password</label>
            <input type="password" class="form-control" id="user_pwd1" name="user_pwd1" placeholder ="Confirm your new password" required>
          </div>
  <button type="submit" class="btn btn-success"><i class="fa fa-refresh">&nbsp</i>update user</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-undo">&nbsp</i>Cancel</button>
</form>
      </div>
    </div>
  </div>
</div>