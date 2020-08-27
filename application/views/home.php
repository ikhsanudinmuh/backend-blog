<?php if ($this->session->userdata('status') == 'login') { ?>
  <a class="btn btn-dark mb-4" href="<?= base_url() ?>post/create" role="button">Create Post</a>
<?php } ?>

<?php if ($post['status'] == false) { ?>
  <h4 class="text-center"><?= $post['message'] ?></h4>
<?php } else { ?>
  <?php foreach ($post['data'] as $p) { ?>
    <div class="card mb-3">
      <?php if ($p['img'] != null) { ?>
        <img src="<?= base_url() ?>assets/img/<?= $p['img'] ?>" class="post-thumbnail">
      <?php } ?>
      <div class="card-body">
        <h5 class="card-title"><?= $p['title'] ?></h5>
        <p class="ellipsis"><?= $p['content'] ?></p>
        <p class="card-text">
          <small class="text-muted">
            <?php $p['cat_name'] == null ? $category = 'Uncategorized' : $category = $p['cat_name'] ?>
            <?= $p['date'] ?> | <?= $category ?>
          </small>
        </p>
      </div>
      <div class="card-footer text-muted text-center">
        <a href="<?= base_url() ?>post/detail/<?= $p['slug'] ?>" class="text-decoration-none" style="color:black">Read More</a>
      </div>
    </div>
  <?php } ?>
<?php } ?>