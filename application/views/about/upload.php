<?php if (isset($error)) { ?>
    Error upload: <?= $error ?>
<?php } ?>
<div class="card">
  <h5 class="card-header bg-orange text-white">Choose Image</h5>
  <div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>about/edit">
    <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
    <div class="form-group">
        <p class="text-muted">max: 1024x1024, JPG or PNG</p>
        <input type="file" class="form-control-file" name="img" id="img-input">
        <img id="img-preview" src="" class="img-preview mt-4"/>
    </div>
    <button type="submit" class="btn btn-dark">Upload</button>
    </form>
  </div>
</div>