<?php if ($this->session->flashdata('success')) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } else if ($this->session->flashdata('failed')) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('failed') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<h4>Active Post :</h4>

<?php if ($post['status'] == false) { ?>
  <h4 class="mt-3 text-center"><?= $post['message'] ?></h4>
<?php } else { ?>
  <div class="mt-4">
    <table id="publication-table" class="table table-striped table-bordered" style="width:100%">
      <thead class="bg-orange">
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Image Thumbnail</th>
          <th>Category</th>
          <th>Date Created</th>
          <?php if ($this->session->userdata('status') == 'login') { ?>
            <th>Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($post['data'] as $p) { ?>
          <tr>
            <td><?= $i;
                $i++ ?></td>
            <td><?= $p['title'] ?></td>
            <td class="text-center">
              <?php if ($p['img'] == null) { ?>
                No image
              <?php } else { ?>
                <img class="img-table" src="<?= base_url() ?>assets/img/<?= $p['img'] ?>" alt="">
              <?php } ?>
            </td>
            <td>
              <?php if ($p['cat_name'] == null) { ?>
                Uncategorized
              <?php } else { ?>
                <?= $p['cat_name'] ?>
              <?php } ?>
            </td>
            <td><?= $p['date'] ?></td>
            <?php if ($this->session->userdata('status') == 'login') { ?>
              <td>
                <a href="<?= base_url() ?>post/detail/<?= $p['slug'] ?>" class="badge badge-primary"><i class="fas fa-info-circle"></i></a>
                <a href="<?= base_url() ?>post/edit/<?= $p['post_id'] ?>" class="badge badge-warning"><i class="fas fa-edit" style="color:white"></i></a>
                <a href="<?= base_url() ?>post/tempdel/<?= $p['post_id'] ?>" class="badge bg-orange text-white" onclick="return confirm('Apakah anda yakin ingin menghapus postingan ini untuk sementara?')"><i class="far fa-trash-alt"></i></a>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } ?>

<?php if ($this->session->userdata('status') == 'login') { ?>
  <a class="btn btn-dark mt-2" href="<?= base_url() ?>post/recycle_bin" role="button">Recycle Bin</a>
<?php } ?>