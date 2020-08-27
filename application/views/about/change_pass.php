<div class="col-md-11">
<?php if ($this->session->flashdata('failed')) {?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('failed') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
  <div class="card">
    <h5 class="card-header bg-orange text-white">Change Password</h5>
    <div class="card-body">
      <form action="" method="POST">
      <input type="hidden" name="username" value="<?= $profile['username'] ?>">
        <div class="form-group">
          <label>Old Password: </label>
          <input type="password" name="oldpass" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('oldpass'); ?>
          </small>
        </div>
        <div class="form-group">
          <label>New Password:</label>
          <input type="password" name="newpass" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('newpass'); ?>
          </small>
        </div>
        <div class="form-group">
          <label>New Password(Confirmation):</label>
          <input type="password" name="newpassc" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('newpassc'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Change</button>
      </form>
    </div>
  </div>
</div>



