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
    <div class="info-detail text-center" style="background: #394867; color: #fff; padding: 50px;">    
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <h4 class="text-bold">Dinas Koperasi Usaha Kecil dan Menengah Kabupaten Indragiri Hulu</h4>
          <img src="<?= base_url('template/img/koperasi-inhu.png') ?>" style="width: 25%;object-fit: cover;border-radius: 20%;">              
          <p>Alamat: JC3P+RR3, Pematang Reba, Kec. Rengat Bar., Kabupaten Indragiri Hulu, Riau 29351</p>
          <p>Beroperasi dari hari Senin-Jumat Pukul 08.00 sampai 16.00</p>
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
  var marker;    

  var icon = {    
    1: {
      url: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    2: {
      url: "http://maps.google.com/mapfiles/ms/icons/tree.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    3: {
      url: "http://maps.google.com/mapfiles/ms/icons/orange-dot.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    4: {
      url: "http://maps.google.com/mapfiles/ms/icons/mechanic.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    5: {
      url: "http://maps.google.com/mapfiles/ms/icons/cabs.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    6: {
      url: "http://maps.google.com/mapfiles/ms/icons/ltblue-dot.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    7: {
      url: "http://maps.google.com/mapfiles/ms/icons/brown-dot.png",
      scaledSize: new google.maps.Size(30, 30),
    },
    8: {
      url: "http://maps.google.com/mapfiles/ms/icons/homegardenbusiness.png",
      scaledSize: new google.maps.Size(25, 25),
    },
    9: {
      url: "http://maps.google.com/mapfiles/ms/icons/dollar.png",
      scaledSize: new google.maps.Size(30, 30),      
    },
  };

  <?php foreach ($umkm as $key => $value) { ?>
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?= $value->umkm_lat ?>, <?= $value->umkm_lon ?>),
      map: map,
      icon: icon[<?= $value->id_sektor ?>],      
      animation: google.maps.Animation.DROP
    }); 

    google.maps.event.addListener(marker, 'click', (function(marker) {
      return function() {
        infowindow.setContent(
          "<img src='<?= base_url('template/img/umkm/'.$value->gambar) ?>' width='250px' height='120px'>" +
          "<h4>USAHA <?= $value->user ?></h4>" +
          "<h5>Alamat : <?= $value->umkm_desa ?></h5>" +
          "<h5>Kecamatan : <?= $value->kecamatan ?></h5>" +
          "<h5>Sektor : <?= $value->sektor ?></h5>" +
          "<a href='<?= base_url('home/detail/'.$value->id_umkm) ?>'style='border:1px solid grey;margin-right:2px;' class='btn btn-default m-2'>Detail</a>" +              
          "<a href='<?= base_url('map/rute/'.$value->id_umkm) ?>' class='btn btn-primary'>Rute</a>"
          );
        infowindow.open(map, marker);
      }
    })(marker));           
  <?php } ?>


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
</script> 