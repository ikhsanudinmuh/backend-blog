<?php if (isset($error)) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Error Upload: <?= $error ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<div class="card">
  <h5 class="card-header bg-orange text-white">Edit Post</h5>
  <div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>post/edit/<?= $post['post_id'] ?>">
      <div class="form-group">
        <label>Title: </label>
        <input type="text" name="title" class="form-control" value="<?= $post['title'] ?>">
        <small class="form-text text-danger">
          <?= form_error('title'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Image Thumbnail: </label>
        <p class="text-muted">max size: 10 MB, max resolution: 1920x1080, format: JPG, JPEG, PNG</p>
        <input type="file" class="form-control-file" name="thumbnail" id="thumbnail-input">
        <img id="thumbnail-preview" src="<?= base_url() ?>assets/img/<?= $post['img'] ?>" class="post-thumbnail mt-4" />
      </div>
      <div class="form-group">
        <label>Content:</label>
        <textarea name="content" class="form-control" id="" rows="20"><?= $post['content'] ?></textarea>
        <small class="form-text text-danger">
          <?= form_error('content'); ?>
        </small>
      </div>
      <div class="form-group">
        <label>Category:</label>
        <select name="category" class="form-control" id="">
          <?php foreach ($category['data'] as $c) { ?>
            <?php if ($post['cat_id'] == $c['id']) { ?>
              <option value="<?= $c['id'] ?>" selected><?= $c['cat_name'] ?></option>
            <?php } else { ?>
              <option value="<?= $c['id'] ?>"><?= $c['cat_name'] ?></option>
            <?php } ?>
          <?php } ?>
          <?php if ($post['cat_id'] == null) { ?>
            <option value="" selected>Uncategorized</option>
          <?php } else { ?>
            <option value="">Uncategorized</option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-dark float-right">Edit</button>
    </form>
  </div>
</div>