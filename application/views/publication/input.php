<div class="col-md-10">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Input Publication</h5>
    <div class="card-body">
      <form action="" method="POST">
        <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
        <div class="form-group">
          <label for="year">Year: </label>
          <input type="text" name="year" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('year'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="title">Title:</label>
          <textarea name="title" class="form-control" rows="3"></textarea>
          <small class="form-text text-danger">
            <?= form_error('title'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="title">Journal:</label>
          <input type="text" name="journal" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('journal'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="title">Link:</label>
          <input type="text" name="link" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('link'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Input</button>
      </form>
    </div>
  </div>
</div>



