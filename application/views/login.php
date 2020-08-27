<div class="col-md-6">
  <div class="card">
    <h5 class="card-header bg-orange text-white">Admin Login</h5>
    <div class="card-body">
      <form action="<?= base_url('login/login') ?>" method="POST">
        <div class="form-group">
          <label for="username">Username: </label>
          <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-dark float-right">Submit</button>
      </form>
    </div>
  </div>
</div>



