<style type="text/css">
.navbar {
  background-color: #337ab7;             
}
.navbar-header {   
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

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="color: #fff;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">            
            <i class="fa fa-user fa-fw"></i> <?= $user['nama']; ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="<?= base_url('profile') ?>"><i class="fa fa-user fa-fw"></i> Profile Saya</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?= base_url('auth/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
          </ul>
        </li>        
      </ul>