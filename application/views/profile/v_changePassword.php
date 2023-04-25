<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-pencil fa-fw"></i> <?= $title ?></h1>
        </div>        
        <div class="col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Form Ubah Password
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <?= $this->session->flashdata('message'); ?> 
              <form method="post" action="<?= base_url('profile/changePassword') ?>">
                <div class="form-group">                                   
                  <label for="current_password">Password saat ini</label>
                  <?= form_error('current_password', '<small class="text-danger">', '</small>') ?> 
                  <input type="password" class="form-control col" id="current_password" name="current_password" placeholder="Masukan saat ini">                  
                </div>
                <div class="form-group">                             
                  <label for="password1">Password baru</label>
                  <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                  <input type="password" class="form-control col" id="password1" name="password1" placeholder="Masukan password baru">                  
                </div>
                <div class="form-group">                                
                  <label for="password2">Ulangi password</label>
                  <?= form_error('password2', '<small class="text-danger">', '</small>') ?>
                  <input type="password" class="form-control col" id="password2" name="password2" placeholder="Ulangi password baru">                  
                </div>              
                <div class="modal-footer">
                  <a href="<?= base_url('profile') ?>" class="btn btn-secondary">Batal</a>      
                  <button type="submit" class="btn btn-primary">Ubah</button>      
                </div>
              </form>
            </div>
          </div>
        </div>