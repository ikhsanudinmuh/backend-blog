<div class="col-md-10">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Input Course</h5>
    <div class="card-body">
      <form action="" method="POST">
        <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
        <div class="form-group">
          <label for="code">Code: </label>
          <input type="text" name="code" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('code'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="name">Course Name:</label>
          <input type="text" name="name" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('name'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="year">Year:</label>
          <input type="text" name="year" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('year'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Input</button>
      </form>
    </div>
  </div>
</div>



