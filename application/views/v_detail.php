<body>
  <nav class="navbar navbar-fixed-top container-fluid" role="navigation" style="background: #394867;">
    <div class="navbar-header">
      <div style="color: #fff;" class="navbar-brand" href="<?= base_url() ?>">Sistem Informasi Geografis Persebaran UMKM Kabupaten Indragiri Hulu</div>      
    </div>                 
    <ul class="navbar-right navbar-top-links">
      <li class="nav-item"><a href="<?= base_url('auth/registration') ?>" style="color: #fff;" class="btn">Daftar</a></li>      
      <li class="nav-item"><a href="<?= base_url('auth') ?>" style="color: #fff;" class="btn">Masuk</a></li>
    </ul>
  </nav>
  <div class="container-fluid" style="background: #9BA4B5; padding-bottom: 50px;">
    <div class="container" style="background: #fff; border: 2px solid #000; margin-top: 80px; margin-bottom: 25px;">
      <!-- Page Content -->      
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> 
            <i class="fa fa-user fa-fw"></i> <?= $title ?>
          </h1>
        </div>
        <div class="container-fluid">          
          <!-- DataTales Example -->
          <div class="card shadow mb-4 col-lg-10">      
            <div class="card-body">      
              <div class="row">
                <div class="col-lg-5">
                  <img src="<?= base_url('template/img/umkm/').$profile->gambar ?>" width="100%">
                </div>
                <div class="table-responsive col-lg-7">          
                  <table class="table table-hover">  
                    <thead>
                      <tr class="info">
                        <th colspan="2" style="text-align: center;">Data Usaha</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Nama</th>
                        <td><?= $profile->user ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Alamat</th>
                        <td><?= $profile->umkm_desa ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Kecamatan</th>      
                        <td><?= $profile->kecamatan ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Latitude</th>
                        <td><?= $profile->umkm_lat ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Longitude</th>
                        <td><?= $profile->umkm_lon ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Bidang Usaha</th>      
                        <td><?= $profile->bidang ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Sektor Usaha</th>
                        <td><?= $profile->sektor ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Kontak Usaha</th>
                        <td><?= $profile->no_hp ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Terdaftar</th>
                        <td><?= date('d F Y', $profile->tgl_umkm)?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Telusuri Lokasi</th>
                        <td>
                          <a href="<?= base_url('map/rute/'.$profile->id) ?>" class="btn btn-primary px-5 py-2"><i class="fas fa-fw fa-map-marked-alt"></i> Lihat Rute</a>
                        </td>              
                      </tr>
                    </tbody>
                  </table>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>    
  <footer class="sticky-footer" style="background: #212A3E; color: #fff; padding: 25px;">
    <div class="container">
      <div class="copyright text-center">
        <span>Copyright &copy; UMKM INHU <?= date('Y'); ?></span>
      </div>
    </div>
  </footer>  