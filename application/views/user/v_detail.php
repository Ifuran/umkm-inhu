<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-user fa-fw"></i> <?= $title ?></h1>
        </div>
        <div class="container-fluid">          
          <!-- DataTales Example -->
          <div class="card shadow mb-4 col-lg-10">      
            <div class="card-body"> 
              <div class="row">
                <div class="col-lg-4">
                  <img src="<?= base_url('template/img/profile/').$profile->foto ?>" width="100%" style="height: 250px; object-fit: cover;" class="img-thumbnail">
                </div>    
                <div class="table-responsive col-lg">        
                  <table class="table table-hover">  
                    <thead>
                      <tr class="info">
                        <th colspan="2" style="text-align: center;">Data Pengguna</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Nama</th>
                        <td><?= $profile->user ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">NIK</th>
                        <td><?= $profile->nik ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">No.KK</th>      
                        <td><?= $profile->no_kk ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">No.Telp</th>
                        <td><?= $profile->no_telp ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Email</th>
                        <td><?= $profile->email ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Tempat Lahir</th>      
                        <td><?= $profile->tempat_lahir ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Tanggal Lahir</th>
                        <td><?= date('d F Y', strtotime($profile->tgl_lahir)); ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Jenis Kelamin</th>
                        <td><?= $profile->jk ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Kecamatan</th>      
                        <td><?= $profile->kecamatan ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Alamat</th>      
                        <td><?= $profile->asal_desa ?></td>      
                      </tr>
                      <tr>
                        <th scope="row">Terdaftar</th>      
                        <td><?= date('d F Y', $profile->tgl_dibuat) ?></td>      
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>    
            </div>
          </div>
        </div>