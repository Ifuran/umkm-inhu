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
              <i class="fa fa-sign-in fa-fw"></i> <?= $title ?></h1>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  Form Reset Password
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="text-center">                
                        <h3 class="h4 text-gray-900"><i class="fa fa-key fa-fw"></i> Ubah Password Anda</h3><h5 class="mb-4"><?= $this->session->userdata('reset_email') ?></h5>
                    </div>
                    <?= $this->session->flashdata('message'); ?>  
                    <form method="post" action="<?= base_url('auth/changePassword') ?>"  class="user">
                         <div class="form-group">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                           <input type="password" class="form-control"
                           id="password1" name="password1" placeholder="Masukan password baru...">
                       </div>
                       <div class="form-group">
                           <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                           <input type="password" class="form-control"
                           id="password2" name="password2" placeholder="Ulangi password baru...">
                       </div>                                                            
                       <button type="submit" class="btn btn-primary btn-user btn-block">Ubah Password</button>
                   </form> 
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
    <!-- /#page-wrapper -->

  </div>
  <!-- /#wrapper -->

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