<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-user fa-fw"></i> <?= $title ?></h1>
        </div>
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Data Pengguna
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body"> 

              <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data</a>
              <div><br></div> 

              <?= $this->session->flashdata('message'); ?>     

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIK</th>
                      <th scope="col">No.Telp</th>
                      <th scope="col">Email</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Terdaftar</th>
                      <th scope="col">Aksi</th>          
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    <?php foreach ($users as $key => $value) { ?>

                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $value->nama ?></td>
                        <td><?= $value->nik ?></td>
                        <td><?= $value->no_telp ?></td>
                        <td><?= $value->email ?></td>
                        <td><?= $value->asal_desa ?></td>              
                        <td><?= date('d F Y', $value->tgl_dibuat); ?></td>
                        <td>
                          <a href="<?= base_url('user/detail/'.$value->id); ?>" class="btn btn-primary btn-sm">Detail</a>
                          <a href="<?= base_url('user/edit/'.$value->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="<?= base_url('user/delete/'.$value->id); ?>" class="btn btn-danger btn-sm" onclick=" return confirm('Kamu yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Modal-->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">              
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
            </div>     
            <div class="modal-body">              
              <div class="panel-body">                
                <form method="post" action="<?= base_url('user') ?>">
                  <div class="form-group">            
                    <label>Role Pengguna</label>
                    <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="role_id" id="role_id">
                      <option value="">---Pilih Role---</option>
                      <option value="2" <?= set_select('role_id', '2') ?>>Pengguna Biasa</option>
                      <option value="3" <?= set_select('role_id', '3') ?>>Pelaku Usaha</option>
                    </select>
                  </div>
                  <div class="form-group">            
                    <label>Status Akun</label>
                    <?= form_error('is_active', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="is_active" id="is_active">
                      <option value="">---Pilih Status Akun---</option>
                      <option value="1" <?= set_select('is_active', '1') ?>>Sudah Aktivasi</option>
                      <option value="0" <?= set_select('is_active', '0') ?>>Belum Aktivasi</option>
                    </select>
                  </div>
                  <div class="form-group">               
                    <label>Nama Lengkap</label>
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="nama" name="nama"
                    placeholder="Nama lengkap" value="<?= set_value('nama') ?>">
                  </div>
                  <div class="form-group">               
                    <label>NIK</label>
                    <?= form_error('nik', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="nik" name="nik"
                    placeholder="NIK" value="<?= set_value('nik') ?>">
                  </div>
                  <div class="form-group">               
                    <label>No. KK</label>
                    <?= form_error('no_kk', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="no_kk" name="no_kk"
                    placeholder="No KK" value="<?= set_value('no_kk') ?>">
                  </div>                                        
                  <div class="form-group">               
                    <label>No Telepon</label>
                    <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                    placeholder="No.Telp" value="<?= set_value('no_telp') ?>">
                  </div>
                  <div class="form-group">               
                    <label>Email</label>
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email') ?>">
                  </div>                                      
                  <div class="form-group">               
                    <label>Password</label>
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control"
                        id="password1" name="password1" placeholder="Password">
                      </div>                                
                      <div class="col-sm-6">
                        <input type="password" class="form-control"
                        id="password2" name="password2" placeholder="Ulangi Password">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">               
                    <label>Tempat Lahir</label>
                    <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                    placeholder="Tempat lahir.." value="<?= set_value('tempat_lahir') ?>">
                  </div>
                  <div class="form-group">               
                    <label>Tanggal Lahir</label>
                    <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>') ?>    
                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Pilih tanggal lahir" value="<?= set_value('tgl_lahir') ?>">
                  </div>
                  <div class="form-group">               
                    <label>Jenis Kelamin</label>
                    <?= form_error('jk', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="jk">
                      <option value="">---Pilih Jenis Kelamin---</option>
                      <option value="Laki-Laki" <?= set_select('jk', 'Laki-Laki') ?>>Laki-Laki</option>             
                      <option value="Perempuan" <?= set_select('jk', 'Perempuan') ?>>Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">               
                    <label>Alamat Kecamatan</label>
                    <?= form_error('asal_kec', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="asal_kec" id="asal_kec">
                      <option value="">---Pilih Alamat Kecamatan---</option>
                      <?php foreach ($kecamatan as $key => $value) { ?>              
                        <option value="<?= $value->id ?>" <?= set_select('asal_kec', $value->id) ?>><?= $value->nama ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">               
                    <label>Alamat Lengkap</label>
                    <?= form_error('asal_desa', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="asal_desa" name="asal_desa"
                    placeholder="Alamat lengkap.." value="<?= set_value('asal_desa') ?>">
                  </div>
                  <div class="modal-footer">
                    <button class="btn tbn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>      
                  </div>                  
                </form>                 
              </div>   
            </div>
          </div>
        </div>
<!-- End of Main Content -->