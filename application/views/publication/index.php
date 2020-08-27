<?php if ($this->session->flashdata('success')) {?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } else if ($this->session->flashdata('failed')) {?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('failed') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<h4>Publication :</h4>

<?php if ($this->session->userdata('status') == 'login') { ?>
  <a class="btn btn-dark mt-2" href="<?= base_url() ?>publication/input" role="button">Input</a>
<?php } ?>

<?php if ($publication['status'] == false) { ?>
  <h4 class="mt-3 text-center"><?= $publication['message'] ?></h4>
<?php } else { ?>
  <div class="mt-4">
    <table id="publication-table" class="table table-striped table-bordered" style="width:100%">
      <thead class="bg-orange">
          <tr>
              <th>Year</th>
              <th>Title</th>
              <th>Venue/Journal</th>
              <th>Access</th>
              <?php if ($this->session->userdata('status') == 'login') { ?>
                <th>Action</th>
              <?php } ?>
          </tr>
      </thead>
      <tbody>
      <?php foreach ($publication['data'] as $p) { ?>
        <tr>
          <td><?= $p['year'] ?></td>
          <td><?= $p['title'] ?></td>
          <td><?= $p['journal'] ?></td>
          <td><a class="text-decoration-none" href="<?= $p['link'] ?>">LINK</a></td>
          <?php if ($this->session->userdata('status') == 'login') { ?>
            <td>
              <a href="<?= base_url() ?>publication/edit/<?= $p['id'] ?>" class="badge badge-warning"><i class="fas fa-edit" style="color:white"></i></a>
              <a href="<?= base_url() ?>publication/delete/<?= $p['id'] ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt"></i></a>
            </td>
          <?php } ?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php } ?>
