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
              Form Ubah Data Diri
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <?= $this->session->flashdata('message'); ?> 
              <?= form_open_multipart('profile/edit') ?>      
              <div class="form-group">                             
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                <label for="nama" class="col-sm-12">Nama</label>            
                <input type="text" class="form-control col" id="nama" name="nama"
                placeholder="Nama lengkap" value="<?= $profile->user ?>">
              </div>
              <div class="form-group">
                <?= form_error('nik', '<small class="text-danger">', '</small>') ?>
                <label for="nik" class="col-sm-12">NIK</label>            
                <input type="text" class="form-control col" id="nik" name="nik"
                placeholder="NIK" value="<?= $profile->nik ?>" readonly>            
              </div>
              <div class="form-group">
                <?= form_error('no_kk', '<small class="text-danger">', '</small>') ?>
                <label for="no_kk" class="col-sm-12">No.KK</label>                        
                <input type="text" class="form-control col" id="no_kk" name="no_kk" value="<?= $profile->no_kk ?>" readonly>            
              </div>
              <div class="form-group">
                <?= form_error('no_telp', '<small class="text-danger">', '</small>') ?>
                <label for="no_telp" class="col-sm-12">No.Telp</label>                        
                <input type="text" class="form-control col" id="no_telp" name="no_telp" value="<?= $profile->no_telp ?>">            
              </div>                  
              <div class="form-group">
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                <label for="email" class="col-sm-12">Email</label>                        
                <input type="text" class="form-control col" id="email" name="email" readonly="" value="<?= $profile->email ?>">            
              </div>        
              <div class="form-group">
                <?= form_error('tempat_lahir', '<small class="text-danger">', '</small>') ?>
                <label for="tempat_lahir" class="col-sm-12">Tempat lahir</label>
                <input type="text" class="form-control col" id="tempat_lahir" name="tempat_lahir"
                value="<?= $profile->tempat_lahir ?>">            
              </div>
              <div class="form-group">
                <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>') ?>
                <label for="tgl_lahir" class="col-sm-12">Tanggal lahir</label>            
                <input type="date" class="form-control col" name="tgl_lahir" id="tgl_lahir" placeholder="Pilih tanggal lahir" value="<?= $profile->tgl_lahir ?>">            
              </div>
              <div class="form-group">
                <?= form_error('jk', '<small class="text-danger">', '</small>') ?>
                <label for="jk" class="col-sm-12">Jenis kelamin</label>      
                <select name="jk" class="form-control col">
                  <option value="Laki-laki" <?php if($profile->jk == 'Laki-Laki'){ echo 'selected'; } ?>>Laki-Laki</option>
                  <option value="Perempuan" <?php if($profile->jk == 'Perempuan'){ echo 'selected'; } ?>>Perempuan</option>
                </select> 
              </div>
              <div class="form-group">
                <?= form_error('asal_kec', '<small class="text-danger">', '</small>') ?>
                <label for="asal_kec" class="col-sm-12">Kecamatan</label>
                <select class="form-control col" name="asal_kec" id="asal_kec">
                  <option value="<?= $profile->asal_kec ?>"><?= $profile->kecamatan ?></option>
                  <?php foreach ($kecamatan as $key => $value) { ?>              
                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <?= form_error('asal_desa', '<small class="text-danger">', '</small>') ?>
                <label for="asal_desa" class="col-sm-12">Alamat lengkap</label>            
                <input type="text" class="form-control col" id="asal_desa" name="asal_desa"
                value="<?= $profile->asal_desa ?>">            
              </div>
              <div class="form-group">
                <?= form_error('foto', '<small class="text-danger">', '</small>') ?>            
                <label for="foto" class="col-sm-12">Foto</label>             
                <img src="<?= base_url('template/img/profile/') .$profile->foto ?>" class="img-thumbnail col-sm-3">
                <input type="file" class="form-control col ml-3" name="foto" id="foto">            
              </div>         
              <div class="modal-footer">
                <a href="<?= base_url('profile') ?>" class="btn btn-secondary">Batal</a>      
                <button type="submit" class="btn btn-primary">Ubah</button>      
              </div>
            </form> 
          </div>
        </div>
      </div>         