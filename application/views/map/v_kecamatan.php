<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-map fa-fw"></i> <?= $title.$kec_current->nama ?></h1>
        </div>
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">              
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="fa fa-filter fa-fw"></i> Kecamatan
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a class="dropdown-item" href="<?= base_url('map')?>">Semua Kecamatan</a>
                  <?php foreach ($kecamatan as $key => $value) { ?>              
                    <li><a class="dropdown-item" href="<?= base_url('map/kecamatan/').$value->id ?>"><?= $value->nama ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>            
            <!-- /.panel-heading -->
            <div class="panel-body">             
              <div id="map" style="height: 600px"></div>
            </div>
          </div>
        </div>
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
                  "<h4>Usaha <?= $value->user ?></h4>" +
                  "<h5>Alamat : <?= $value->umkm_desa ?></h5>" +
                  "<h5>Sektor : <?= $value->sektor ?></h5>" +
                  "<a href='<?= base_url('umkm/detail/'.$value->id_umkm) ?>'style='border:1px solid grey;margin-right:2px;' class='btn btn-default m-2'>Detail</a>" +              
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