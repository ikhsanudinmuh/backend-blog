<div class="col-md-10">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Edit Publication</h5>
    <div class="card-body">
      <form action="" method="POST">
      <input type="hidden" name="id" value="<?= $publication['id'] ?>">
        <div class="form-group">
          <label for="year">Year: </label>
          <input type="text" name="year" class="form-control" value="<?= $publication['year'] ?>">
          <small class="form-text text-danger">
            <?= form_error('year'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="title">Title:</label>
          <textarea name="title" class="form-control" rows="3"><?= $publication['title'] ?></textarea>
          <small class="form-text text-danger">
            <?= form_error('title'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="title">Journal:</label>
          <input type="text" name="journal" class="form-control" value="<?= $publication['journal'] ?>">
          <small class="form-text text-danger">
            <?= form_error('journal'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="title">Link:</label>
          <input type="text" name="link" class="form-control" value="<?= $publication['link'] ?>">
          <small class="form-text text-danger">
            <?= form_error('link'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Edit</button>
      </form>
    </div>
  </div>
</div>



