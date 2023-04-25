<!-- Page Content -->
<div id="page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-user fa-fw"></i> <?= $title ?></h1>
        </div>
        <!-- Begin Page Content -->
        <div class="container">          
          <div class="col-sm-6 pl-0">
            <?= $this->session->flashdata('message'); ?>
          </div>
          <div class="card" style="max-width: 540px;">    
            <div class="row">
              <div class="col-lg-12">
                <img src="<?= base_url('template/img/profile/').$user['foto'] ?>" width="30%" style="height: 190px; object-fit: cover;" class="img-thumbnail">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h3 class="card-title"><strong><?= $user['nama'];?></strong></h3>
                  <p class="card-text"><?= $user['email'];?></p>
                  <p class="card-text">
                    <small class="text-muted">Terdaftar saat <?= date('d F Y', $user['tgl_dibuat']); ?>
                  </small></p>
                  <a href="<?= base_url('profile/edit') ?>" class="btn btn-sm btn-default text-end"><i class="fa fa-user fa-fw"></i> Edit Profil</a>
                  <a href="<?= base_url('profile/changePassword') ?>" class="btn btn-sm btn-default flex-end"><i class="fa fa-pencil fa-fw"></i></i> Ubah Password</a>
                </div>

              </div>
            </div>
          </div>
          <div style="margin-top: 15px;">
            <?php if ($this->session->userdata('role_id') == 3) { ?>
              <a href="#" class="btn btn-primary btn-sm mb-3" ><i class="fa fa-clipboard"></i> Daftar Usaha</a>
            <?php } ?>  
            <?php if ($this->session->userdata('role_id') == 2) { ?>
              <a href="#" class="btn btn-primary btn-sm mb-3" ><i class="fa fa-clipboard"></i> Daftar Pelaku Usaha</a>
            <?php } ?>
          </div>            
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

