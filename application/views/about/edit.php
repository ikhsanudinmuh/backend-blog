<?php if (isset($error)) {?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Error Upload: <?= $error ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<div class="col-md-11">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Edit Profile</h5>
    <div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>about/edit">
      <input type="hidden" name="username" value="<?= $profile['username'] ?>">
      <div class="form-group">
        <label>Full Name: </label>
        <input type="text" name="name" class="form-control" value="<?= $profile['full_name'] ?>">
        <small class="form-text text-danger">
          <?= form_error('name'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Photo Profile: </label>
        <p class="text-muted">max size: 10 MB, max resolution: 1024x1024, format: JPG, JPEG, PNG</p>
        <input type="file" class="form-control-file" name="img" id="img-input">
        <img id="profile-preview" src="<?= base_url()?>assets/img/<?= $profile['img'] ?>" class="profile-preview mt-4"/>
      </div>
      <div class="form-group">
        <label>About:</label>
        <textarea name="about" class="form-control" rows="10"><?= $profile['about'] ?></textarea>
        <small class="form-text text-danger">
          <?= form_error('about'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="<?= $profile['email'] ?>">
        <small class="form-text text-danger">
          <?= form_error('email'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Telephone:</label>
        <input type="text" name="telephone" class="form-control" value="<?= $profile['telephone'] ?>">
        <small class="form-text text-danger">
          <?= form_error('telephone'); ?>
        </small>
      </div>
      <button type="submit" class="btn btn-dark float-right">Edit</button>
    </form>
    </div>
  </div>
</div>



