<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-map fa-fw"></i> <?= $title ?></h1>
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
                    <li><a class="dropdown-item" href="<?= base_url('map')?>">Semua Kecamatan</a></li>
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
            fillOpcaity: 0.1,        
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
                  "<h5>Kecamatan : <?= $value->kecamatan ?></h5>" +
                  "<h5>Sektor : <?= $value->sektor ?></h5>" +
                  "<a href='<?= base_url('umkm/detail/'.$value->id_umkm) ?>'style='border:1px solid grey;margin-right:2px;' class='btn btn-default m-2'>Detail</a>" +              
                  "<a href='<?= base_url('map/rute/'.$value->id_umkm) ?>' class='btn btn-primary'>Rute</a>"
                  );
                infowindow.open(map, marker);
              }
            })(marker, i));           
          <?php } ?>                         
      </script>        