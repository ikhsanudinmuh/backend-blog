<div class="col-md-10">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Edit Category</h5>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Category Name:</label>
          <input type="text" name="name" class="form-control" value="<?= $category['cat_name'] ?>">
          <small class="form-text text-danger">
            <?= form_error('name'); ?>
          </small>
        </div>
        <button type="submit" class="btn btn-dark float-right">Edit</button>
      </form>
    </div>
  </div>
</div>