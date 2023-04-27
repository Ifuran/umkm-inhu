<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <!-- Bootstrap Core CSS -->
  <link href="<?= base_url() ?>template/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="<?= base_url() ?>template/css/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="<?= base_url() ?>template/css/startmin.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="<?= base_url() ?>template/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">         
</head>
<style type="text/css">
.navbar {
  background-color: #337ab7;             
}
.navbar-header {
  margin-left: 50px;  
  color: #fff;  
} 
.nav a:hover {
  background-color: #fff;
}   

</style>
<body>    
  <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <a style="color: #fff;" class="navbar-brand" href="<?= base_url() ?>"><i class="fa fa-globe fa-fw"></i> SIG UMKM INHU</a>
    </div>                
</nav>  
<!-- Page Content -->
<div class="container" style="margin-top: 25px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
            <i class="fa fa-user-plus fa-fw"></i> <?= $title ?></h1>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  Form Pendaftaran
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <?php 
                if ($this->session->flashdata('message')) {
                    echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo $this->session->flashdata('message');
                    echo '</div>';
                }
                ?>  
                <form method="post" action="<?= base_url('auth/registration') ?>">
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
                    <button class="btn btn-block btn-primary btn-sm" type="submit">Buat Akun</button>
                    <div class="text-center">
                        <a href="<?= base_url('auth') ?>" class="btn">Sudah punya akun?</a>
                    </div>
                </form> 
            </div>
        </div>
    </div>    
</div>
</div>
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>template/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url() ?>template/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url() ?>template/js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= base_url() ?>template/js/startmin.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= base_url() ?>template/js/startmin.js"></script>

</body>
</html>