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
                        Form Ubah Data UMKM
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?= $this->session->flashdata('message'); ?> 
                        <?= form_open_multipart('profile/editUsaha/'.$usaha->id_umkm) ?>
                        <div class="form-group">
                            <?= form_error('id_kec', '<small class="text-danger">', '</small>') ?>
                            <label for="id_kec" class="col-sm-12">Kecamatan</label>
                            <select class="form-control col" name="id_kec" id="id_kec">
                                <option value="<?= $usaha->id_kec ?>"><?= $usaha->kecamatan ?></option>
                                <?php foreach ($kecamatan as $key => $value) { ?>              
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <?= form_error('umkm_desa', '<small class="text-danger">', '</small>') ?>
                            <label for="umkm_desa" class="col-sm-12">Alamat Usaha</label>
                            <input type="text" class="form-control col" id="umkm_desa" name="umkm_desa" value="<?= $usaha->umkm_desa ?>">        
                        </div>
                        <div class="form-group">
                            <?= form_error('id_sektor', '<small class="text-danger">', '</small>') ?>
                            <label for="id_sektor" class="col-sm-12">Sektor Usaha</label>
                            <select readonly class="form-control col" name="id_sektor" id="id_sektor">
                                <option value="<?= $usaha->id_sektor ?>"><?= $usaha->sektor ?></option>                                
                            </select>    
                        </div>
                        <div class="form-group">
                            <?= form_error('bidang', '<small class="text-danger">', '</small>') ?>
                            <label for="bidang" class="col-sm-12">Bidang Usaha</label>
                            <input type="text" class="form-control col" id="bidang" name="bidang" value="<?= $usaha->bidang ?>" readonly>  
                        </div>      
                        <div class="form-group">      
                            <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>

                            <label for="no_hp" class="col-sm-12">No.Telp</label>
                            <input type="text" class="form-control col" id="no_hp" name="no_hp" value="<?= $usaha->no_hp ?>">
                        </div>
                        <div class="form-group">            

                            <label for="umkm_lat" class="col-sm-12">Latitude</label>
                            <input type="text" class="form-control col" id="umkm_lat" name="umkm_lat" placeholder="Latitude" value="<?= $usaha->umkm_lat ?>" readonly>
                        </div> 
                        <div class="form-group">
                            <?= form_error('umkm_lon', '<small class="text-danger">', '</small>') ?>  
                            <label for="umkm_lon" class="col-sm-12">Longitude</label>
                            <input type="text" class="form-control col" id="umkm_lon" name="umkm_lon" placeholder="Latitude" value="<?= $usaha->umkm_lon ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Geser marker untuk menentukan lokasi</label>
                            <div id="map" style="height: 300px"></div> 
                        </div>
                        <div class="form-group">
                            <?= form_error('gambar', '<small class="text-danger">', '</small>') ?>              
                            <label for="gambar" class="col-sm-12">Gambar</label>              
                            <img src="<?= base_url('template/img/umkm/') .$usaha->gambar ?>" class="img-thumbnail col-sm-3">
                            <input type="file" class="form-control col ml-3" name="gambar" id="gambar" value="">  
                        </div>                      
                        <div class="modal-footer">
                            <a href="<?= base_url('umkm') ?>" class="btn btn-secondary">Batal</a>      
                            <button type="submit" class="btn btn-primary">Ubah</button>      
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript"> 

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
                position: { lat:  <?= $usaha->umkm_lat ?>, lng: <?= $usaha->umkm_lon ?> },
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

    </script>