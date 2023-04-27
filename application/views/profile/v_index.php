<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-table fa-fw"></i> <?= $title ?></h1>
        </div>
        <div class="container-fluid">          
          <div class="col-sm-6 pl-0">
            <?= $this->session->flashdata('message'); ?>
          </div>
          <div class="row" style="max-width: 500px;">                
            <div class="col-lg-6">
              <img src="<?= base_url('template/img/profile/').$user['foto'] ?>" style="height: 200px; width: 100%; object-fit: cover;" class="img-thumbnail">
            </div>
            <div class="col-lg-6 col-md-8">              
              <h3 class="card-title"><strong><?= $user['nama'];?></strong></h3>
              <p class="card-text"><?= $user['email'];?></p>
              <p class="card-text">
                <small class="text-muted">Terdaftar saat <?= date('d F Y', $user['tgl_dibuat']); ?>
              </small></p>
              <a href="<?= base_url('user/detail/'.$user['id']) ?>" class="btn btn-sm btn-default text-end"><i class="fa fa-user fa-fw"></i> Lihat Profil</a>
              <a href="<?= base_url('profile/edit') ?>" class="btn btn-sm btn-default text-end"><i class="fa fa-pencil fa-fw"></i> Edit Profil</a>
              <a href="<?= base_url('profile/changePassword') ?>" class="btn btn-sm btn-default flex-end"><i class="fa fa-key fa-fw"></i></i> Ubah Password</a>
            </div>
          </div>
          <div style="margin-top: 35px;">
            <?php if ($this->session->userdata('role_id') == 2) { ?>
              <a href="<?= base_url('umkm/registration') ?>" class="btn btn-primary btn-sm mb-3" ><i class="fa fa-clipboard"></i> Daftar Pelaku Usaha</a>
            <?php } ?>  
          </div>
        </div>
        <!-- menampilkan usaha pengguna -->
        <?php if ($this->session->userdata('role_id') == 3) { ?>
          <div class="col-lg-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                Usaha Saya
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">                             
                <a href="<?= base_url('umkm/registration') ?>" class="btn btn-primary btn-sm mb-3" ><i class="fa fa-clipboard"></i> Daftarkan Usaha Anda</a>                      
                <div><br></div>               
                <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>     

                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th scope="col">NO</th>        
                        <th scope="col">Gambar</th>
                        <th scope="col">Sektor</th>                                
                        <th scope="col">Aksi</th> 
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      <?php foreach ($umkm as $key => $value) { ?>                   
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><img width="150px" height="70px" src="<?= base_url('template/img/umkm/' . $value->gambar) ?>"></td>
                        <td><?= $value->sektor ?></td>                                           
                        <td>
                          <a href="<?= base_url('umkm/detail/').$value->id_umkm ?>" class="btn btn-primary btn-sm">Detail</a>
                          <a href="<?= base_url('profile/editUsaha/').$value->id_umkm ?>" class="btn btn-warning btn-sm">Edit</a>
                        </tr>
                        <?php $i++; ?>
                        <?php } ?>                                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>      

        