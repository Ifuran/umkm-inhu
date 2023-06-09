<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-table fa-fw"></i> <?= $title ?></h1>
        </div>
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Data UMKM
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body"> 
              <?php if ($this->session->userdata('role_id') == 1) { ?>
                <a href="#" onclick="initMap()" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah</a>
                <a href="umkm/verifikasi" class="btn btn-primary btn-sm mb-3"><i class="fa fa-check-square"></i> Verifikasi Pendaftaran</a>
              <?php } ?> 
              <?php if ($this->session->userdata('role_id') != 1) { ?>
                <a href="<?= base_url('umkm/registration') ?>" class="btn btn-primary btn-sm mb-3" ><i class="fa fa-clipboard"></i> Daftarkan Usaha Anda</a>
              <?php } ?>              
              <div><br></div>               
              <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
              <?= $this->session->flashdata('message'); ?>     

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th scope="col">NO</th>        
                      <th scope="col">Gambar</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Kecamatan</th>
                      <th scope="col">Desa</th>
                      <th scope="col">Bidang</th>
                      <th scope="col">Sektor</th>
                      <th scope="col">No HP</th>          
                      <th scope="col">Aksi</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    <?php foreach ($umkm as $key => $value) { ?>

                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><img width="150px" height="70px" src="<?= base_url('template/img/umkm/' . $value->gambar) ?>"></td>
                        <td><?= $value->user ?></td>
                        <td><?= $value->kecamatan ?></td>
                        <td><?= $value->umkm_desa ?></td>
                        <td><?= $value->bidang ?></td>
                        <td><?= $value->sektor ?></td>
                        <td><?= $value->no_hp ?></td>                    
                        <td>
                          <a href="<?= base_url('umkm/detail/'.$value->id_umkm); ?>" class="btn btn-primary btn-sm">Detail</a>
                          <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <a href="<?= base_url('umkm/edit/'.$value->id_umkm); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('umkm/delete/'.$value->id_umkm); ?>" class="btn btn-danger btn-sm" onclick=" return confirm('Kamu yakin ingin menghapus data ini?')">Hapus</a>
                          </td>
                        <?php } ?> 
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
                <form class="user" method="post" action="<?= base_url('umkm') ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Pengguna</label>
                    <?= form_error('id_pengguna', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="id_pengguna" id="id_pengguna">
                      <option value="">---Pilih Pengguna---</option>
                      <?php foreach ($users as $key => $value) { ?>              
                        <option value="<?= $value->id ?>" <?= set_select('id_pengguna', $value->id) ?>><?= $value->nama ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kecamatan</label>
                    <?= form_error('id_kec', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="id_kec" id="id_kec">
                      <option value="">---Pilih Kecamatan---</option>
                      <?php foreach ($kecamatan as $key => $value) { ?>              
                        <option value="<?= $value->id ?>" <?= set_select('id_kec', $value->id) ?>><?= $value->nama ?></option>
                      <?php } ?>
                    </select>          
                  </div>
                  <div class="form-group">
                    <label>Alamat Lengkap Usaha</label>
                    <?= form_error('umkm_desa', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="umkm_desa" name="umkm_desa" placeholder="Alamat usaha.." value="<?= set_value('umkm_desa') ?>">
                  </div>
                  <div class="form-group">
                    <label>Bidang Usaha</label>
                    <?= form_error('bidang', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="bidang" name="bidang"
                    placeholder="Bidang usaha (contoh: Menjual aneka buah)" value="<?= set_value('bidang') ?>">
                  </div>
                  <div class="form-group">
                    <label>Sektor Usaha</label>
                    <?= form_error('id_sektor', '<small class="text-danger pl-3">', '</small>') ?>
                    <select class="form-control" name="id_sektor" id="id_sektor">
                      <option value="">---Pilih Sektor Usaha---</option>
                      <?php foreach ($sektor as $key => $value) { ?>              
                        <option value="<?= $value->id ?>" <?= set_select('id_sektor', $value->id) ?>><?= $value->nama ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>No. Telepon</label>
                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                    placeholder="Masukan No.HP" value="<?= set_value('no_hp') ?>">
                  </div>
                  <div class="form-group">
                    <label>Latitude</label>
                    <?= form_error('umkm_lat', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="umkm_lat" name="umkm_lat"
                    placeholder="Latitude" value="<?= set_value('umkm_lat') ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Longitude</label>
                    <?= form_error('umkm_lon', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="text" class="form-control" id="umkm_lon" name="umkm_lon"
                    placeholder="Longitude" value="<?= set_value('umkm_lon') ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Geser marker untuk menentukan lokasi</label>
                    <div id="map" style="height: 300px"></div>                    
                  </div>
                  <div class="form-group">
                    <label>Gambar Usaha</label>
                    <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>') ?>
                    <input type="file" class="form-control" id="gambar" name="gambar"
                    placeholder="Masukan gambar" value="<?= set_value('gambar') ?>">
                  </div>                      
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>      
                  </div>
                </form>                              
              </div>   
            </div>
          </div>
          <script type="text/javascript"> 
            function initMap() {
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 9,
                center: new google.maps.LatLng( -0.565098, 102.299790),
                mapTypeId: google.maps.MapTypeId.ROADMAP
              });

          // menampilkan geosjon
          <?php foreach ($geojson as $key => $value) { ?>
            map.data.loadGeoJson(
              "<?= base_url('geojson/'.$value->geojson) ?>"
              );
            map.data.loadGeoJson(
              "<?= base_url('geojson/'.$value->geojson) ?>"
              );
          <?php } ?>

          // styling geojson
          map.data.setStyle({
            fillColor: 'green',        
            strokeWeight: 1
          });

          var infowindowKecamatan = new google.maps.InfoWindow();
          var markerKecamatan;
          const imageKecamatan = "https://developers.google.com/maps/documentation/javascript/examples/full/images/info-i_maps.png";

          <?php foreach ($kecamatan as $key => $value) { ?>
            markerKecamatan = new google.maps.Marker({
              position: new google.maps.LatLng(<?= $value->kec_lat ?>, <?= $value->kec_lon ?>),
              map: map,
              icon: imageKecamatan,
              title: "Kecamatan <?= $value->nama ?>",
              animation: google.maps.Animation.DROP
            });

            google.maps.event.addListener(markerKecamatan, 'click', (function(markerKecamatan) {
              return function() {
                infowindowKecamatan.setContent(          
                  "<h4>Kecamatan <?= $value->nama ?></h4>" 
                  );
                infowindowKecamatan.open(map, markerKecamatan);
              }
            })(markerKecamatan));
          <?php } ?>

          var marker = new google.maps.Marker({
            draggable: true,        
            position: { lat:  -0.565098, lng: 102.299790 },
            map: map
          });

          google.maps.event.addListener(marker, 'dragend', function (evt) {
            document.getElementById('umkm_lat').value = evt.latLng.lat().toFixed(3);
            document.getElementById('umkm_lon').value = evt.latLng.lng().toFixed(3);
          });
          google.maps.event.addListener(marker, 'dragstart', function (evt) {
            document.getElementById('umkm_lat').value = 'Sedang memilih lokasi...';
            document.getElementById('umkm_lon').value = 'Sedang memilih lokasi...';

          });           
        }                                               
      </script>
        </div>        
<!-- End of Main Content -->