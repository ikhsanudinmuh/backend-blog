<div class="post-comment">
    <?php if ($comment['status'] == false) { ?>
        <h4 class="mt-2">Comments: </h4>
    <?php } else { ?>
        <h4 class="mt-2">Comments(<?= count($comment['data']) ?>): </h4>
        <?php foreach ($comment['data'] as $c) { ?>
            <div class="card mb-2">
                <div class="card-body">
                    <p class="card-title">
                        <b><?= $c['name'] ?></b> | <small class="text-muted"><?= $c['date'] ?></small>
                        <?php if ($this->session->userdata('status') == 'login') { ?>
                            <a href="<?= base_url() ?>post/delete_comment/<?= $c['post_id'] ?>/<?= $c['id'] ?>" class="badge badge-danger float-right" onclick="return confirm('Apakah anda yakin ingin menghapus komentar ini?')"><i class="far fa-trash-alt"></i></a>
                        <?php } ?>
                    </p>
                    <p class="card-text"><?= $c['content'] ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>