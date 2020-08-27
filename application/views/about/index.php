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

<div class="row mt-4">

    <div class="col-md-4">
        <img src="<?= base_url() ?>assets/img/<?= $profile['img'] ?>" alt="..." class="rounded" width="250px" height="250px">
        <?php if ($this->session->userdata('status') == 'login') { ?>
            <hr>
            <div class="d-flex justify-content-center mt-2">
                <a class="btn btn-dark" href="<?= base_url() ?>about/edit" role="button">Edit Profile</a>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a class="btn btn-dark" href="<?= base_url() ?>about/change_pass" role="button">Change Password</a>
            </div>
            <hr>
        <?php } ?>
    </div>
    
    <div class="col-md-8">
        <p class="text-justify">
            <?= $profile['about']?>
        </p>
        <p class="text-justify">
            <h5><b>Profile: </b></h5>
            <b>Full Name: </b><?= $profile['full_name'] ?>
            <br>
            <b>Email: </b><?= $profile['email'] ?>
            <br>
            <b>Telephone: </b> <?= $profile['telephone'] ?>
        </p>
    </div>
    
</div>