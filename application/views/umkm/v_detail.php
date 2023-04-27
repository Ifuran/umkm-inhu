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
                        <th scope="row">Pemilik</th>
                        <td><a href="<?= base_url('user/detail/').$profile->id_pengguna ?>"><?= $profile->user ?></a></td>      
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
                          <a href="<?= base_url('map/rute/'.$profile->id_umkm) ?>" class="btn btn-primary px-5 py-2"><i class="fas fa-fw fa-map-marked-alt"></i> Lihat Rute</a>
                        </td>              
                      </tr>
                    </tbody>
                  </table>
                </div> 
              </div>

            </div>
          </div>
        </div>