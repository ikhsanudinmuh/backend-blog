    </div>

    <div class="col-md-3">

      <h5 class="text-center">Recent Post</h5>
      <div class="list-group-flush" id="recent-post">

      </div>

      <br><br>

      <h5 class="text-center">Admin</h5>
      <div class="list-group-flush">
        <?php if ($this->session->userdata('status') != 'login') { ?>
          <a style="font-size:small" href="<?= base_url('login') ?>" class="list-group-item list-group-item-action">Login</a>
        <?php } else { ?>
          <a style="font-size:small" href="<?= base_url() ?>post" class="list-group-item list-group-item-action">Manage Post</a>
          <a style="font-size:small" href="<?= base_url() ?>category" class="list-group-item list-group-item-action">Manage Category</a>
          <a style="font-size:small" href="<?= base_url('login/logout') ?>" class="list-group-item list-group-item-action">Logout</a>
        <?php } ?>
      </div>


    </div>

    </div>

    </div>

    <script>
      loadPost();

      loadDataTable();

      $('#img-input').change(function() {
        readURL(this, '#profile-preview');
      });

      $('#thumbnail-input').change(function() {
        readURL(this, '#thumbnail-preview');
      });
    </script>
    </body>

    </html>