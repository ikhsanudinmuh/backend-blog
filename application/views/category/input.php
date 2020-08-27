<div class="col-md-10">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Input Category</h5>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Category Name:</label>
          <input type="text" name="name" class="form-control">
          <small class="form-text text-danger">
            <?= form_error('name'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Input</button>
      </form>
    </div>
  </div>
</div>



