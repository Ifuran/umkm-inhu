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
    <div id="map" class="container" style="height: 525px; border: 2px solid #000; margin-top: 80px; margin-bottom: 25px;"></div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-1"></div>
      <div class="col-lg-2 col-md-6" >
        <div class="panel" style="background: #212A3E; color: #fff;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-1">
                <i class="fa fa-table fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $jlh_umkm ?></div>
                <div>UMKM</div>
              </div>
            </div>
          </div>              
        </div>
      </div>
      <div class="col-lg-2 col-md-6" >
        <div class="panel" style="background: #212A3E; color: #fff;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-map fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $jlh_users ?></div>
                <div>PENGGUNA</div>
              </div>
            </div>
          </div>     
        </div>
      </div>
      <div class="col-lg-2 col-md-6" >
        <div class="panel" style="background: #212A3E; color: #fff;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-1">
                <i class="fa fa-user fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $jlh_pelaku_usaha ?></div>
                <div>PELAKU USAHA</div>
              </div>
            </div>
          </div>     
        </div>
      </div>
      <div class="col-lg-2 col-md-6" >
        <div class="panel" style="background: #212A3E; color: #fff;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-1">
                <i class="fa fa-map fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $jlh_sektor ?></div>
                <div>SEKTOR USAHA</div>
              </div>
            </div>
          </div>     
        </div>
      </div>
      <div class="col-lg-2 col-md-6" >
        <div class="panel" style="background: #212A3E; color: #fff;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-1">
                <i class="fa fa-user fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $jlh_kecamatan ?></div>
                <div>KECAMATAN</div>
              </div>
            </div>
          </div>     
        </div>
      </div>  
    </div>    
    <!-- /.row -->
  </div>    
  <footer class="sticky-footer" style="background: #212A3E; color: #fff; padding: 25px;">
    <div class="container">
      <div class="copyright text-center">
        <span>Copyright &copy; UMKM INHU <?= date('Y'); ?></span>
      </div>
    </div>
  </footer>
  <script type="text/javascript">              
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
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
    fillColor: 'blue',        
    strokeWeight: 1
  });

  var infowindow = new google.maps.InfoWindow();
  var marker, i;

  <?php foreach ($umkm as $key => $value) { ?>
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?= $value->umkm_lat ?>, <?= $value->umkm_lon ?>),
      map: map,
      animation: google.maps.Animation.DROP
    }); 

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(
          "<img src='<?= base_url('template/img/umkm/'.$value->gambar) ?>' width='250px' height='120px'>" +
          "<h4>Usaha <?= $value->user ?></h4>" +
          "<h5>Alamat : <?= $value->umkm_desa ?></h5>" +
          "<h5>Sektor : <?= $value->sektor ?></h5>" +
          "<a href='<?= base_url('home/detail/'.$value->id_umkm) ?>'style='border:1px solid grey;margin-right:2px;' class='btn btn-default m-2'>Detail</a>" +              
          "<a href='<?= base_url('map/rute/'.$value->id_umkm) ?>' class='btn btn-primary'>Rute</a>"
          );
        infowindow.open(map, marker);
      }
    })(marker, i));           
  <?php } ?>
                      
</script> 