<div class="card">
    <h5 class="card-header bg-orange text-white">Leave a Comment</h5>
    <div class="card-body">
        <form action="" method="POST">
            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" class="form-control">
                <small class="form-text text-danger">
                    <?= form_error('name'); ?>
                </small>
            </div>
            <div class="form-group">
                <label>Comment:</label>
                <textarea name="content" class="form-control" id="" rows="5"></textarea>
                <small class="form-text text-danger">
                    <?= form_error('content'); ?>
                </small>
            </div>
            <button type="submit" class="btn btn-dark float-right">Post a Comment</button>
        </form>
    </div>
</div>
</div>