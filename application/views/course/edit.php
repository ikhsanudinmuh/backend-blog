<div class="col-md-10">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Edit Course</h5>
    <div class="card-body">
      <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $course['id'] ?>">
        <div class="form-group">
          <label for="code">Code: </label>
          <input type="text" name="code" class="form-control" value="<?= $course['code'] ?>">
          <small class="form-text text-danger">
            <?= form_error('code'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="name">Course Name:</label>
          <input type="text" name="name" class="form-control" value="<?= $course['name'] ?>">
          <small class="form-text text-danger">
            <?= form_error('name'); ?>
          </small>
        </div>
        <div class="form-group">
          <label for="year">Year:</label>
          <input type="text" name="year" class="form-control" value="<?= $course['year'] ?>">
          <small class="form-text text-danger">
            <?= form_error('year'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Edit</button>
      </form>
    </div>
  </div>
</div>



