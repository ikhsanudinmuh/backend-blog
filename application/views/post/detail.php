<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } else if ($this->session->flashdata('failed')) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('failed') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<hr>
<h2 class="text-center"><?= $post['title'] ?></h2>
<hr>
<div class="text-center">
    <?php if ($post['img'] != null) { ?>
        <img class="post-thumbnail" src="<?= base_url() ?>assets/img/<?= $post['img'] ?>" alt="">
    <?php } ?>
    <div class="mt-3">
        <span class="badge bg-orange text-white" style="font-weight: 600;">
            Published by <u><?= $post['full_name'] ?></u> on <?= $post['date'] ?>
        </span>
        <?php if ($post['cat_name'] == null) { ?>
            <a href="<?= base_url() ?>post/category/Uncategorized" class="badge badge-dark">Uncategorized</a>
        <?php } else { ?>
            <a href="<?= base_url() ?>post/category/<?= $post['cat_name'] ?>" class="badge badge-dark"><?= $post['cat_name'] ?></a>
        <?php } ?>
    </div>
</div>
<hr>
<div class="post-content" id="post-content">
    <?php
    $content = explode("\n", $post['content']);
    foreach ($content as $c) {
        echo '<p>' . $c . '</p>';
    }
    ?>
</div>
<hr>
<?php if ($post['status'] == 'active') { ?>
    <?php if ($previous['status'] == true) { ?>
        <a class="btn btn-outline-dark float-left" href="<?= base_url() ?>post/detail/<?= $previous['data'][0]['slug'] ?>" role="button"><i class="fas fa-caret-left"></i> Previous Post</a>
    <?php } ?>
    <?php if ($next['status'] == true) { ?>
        <a class="btn btn-outline-dark float-right" href="<?= base_url() ?>post/detail/<?= $next['data'][0]['slug'] ?>" role="button">Next Post <i class="fas fa-caret-right"></i></a>
    <?php } ?>
<?php } ?>
<br>
<br>
<hr>