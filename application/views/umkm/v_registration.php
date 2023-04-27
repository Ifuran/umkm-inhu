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
                            Form Pendaftaran UMKM
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?= $this->session->flashdata('message'); ?>
                            <form class="user" method="post" action="<?= base_url('umkm/registration') ?>" enctype="multipart/form-data">                                
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
                                                   
      </script>