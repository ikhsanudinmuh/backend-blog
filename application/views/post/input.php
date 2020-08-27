<?php if (isset($error)) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Error Upload: <?= $error ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<div class="card">
  <h5 class="card-header bg-orange text-white">Create Post</h5>
  <div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>post/create">
      <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
      <div class="form-group">
        <label>Title: </label>
        <input type="text" name="title" class="form-control">
        <small class="form-text text-danger">
          <?= form_error('title'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Image Thumbnail: </label>
        <p class="text-muted">max size: 10 MB, max resolution: 1920x1080, format: JPG, JPEG, PNG</p>
        <input type="file" class="form-control-file" name="thumbnail" id="thumbnail-input">
        <img id="thumbnail-preview" src="" class="post-thumbnail mt-4" />
      </div>
      <div class="form-group">
        <label>Content:</label>
        <textarea name="content" class="form-control" id="" rows="20"></textarea>
        <small class="form-text text-danger">
          <?= form_error('content'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Category:</label>
        <select name="category" class="form-control" id="">
          <?php foreach ($category['data'] as $c) { ?>
            <option value="<?= $c['id'] ?>"><?= $c['cat_name'] ?></option>
          <?php } ?>
          <option value="" selected>Uncategorized</option>
        </select>
      </div>
      <button type="submit" class="btn btn-dark float-right">Create</button>
    </form>
  </div>
</div>