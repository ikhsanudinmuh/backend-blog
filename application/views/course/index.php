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

<h4>Course :</h4>

<?php if ($this->session->userdata('status') == 'login') { ?>
  <a class="btn btn-dark mt-2" href="<?= base_url() ?>course/input" role="button">Input</a>
<?php } ?>

<?php if ($course['status'] == false) { ?>
  <h4 class="mt-3 text-center"><?= $course['message'] ?></h4>
<?php } else { ?>
  <div class="mt-4">
    <table id="course-table" class="table table-striped table-bordered" style="width:100%">
      <thead class="bg-orange">
        <tr>
          <th>#</th>
          <th>Code</th>
          <th>Name</th>
          <th>Year</th>
          <?php if ($this->session->userdata('status') == 'login') { ?>
            <th>Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($course['data'] as $c) { ?>
          <tr>
            <td><?= $i;
                $i++; ?></td>
            <td><?= $c['code'] ?></td>
            <td><?= $c['name'] ?></td>
            <td><?= $c['year'] ?></td>
            <?php if ($this->session->userdata('status') == 'login') { ?>
              <td>
                <a href="<?= base_url() ?>course/edit/<?= $c['id'] ?>" class="badge badge-warning"><i class="fas fa-edit" style="color:white"></i></a>
                <a href="<?= base_url() ?>course/delete/<?= $c['id'] ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin ingin menghapus mata kuliah ini?')"><i class="far fa-trash-alt"></i></a>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } ?>