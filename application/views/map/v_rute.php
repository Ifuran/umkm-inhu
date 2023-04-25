<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-map fa-fw"></i> <?= $title.$usaha->nama ?></h1>
        </div>
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-2 text-right" style="margin-top: 5px;">
                  <b><i class="fa fa-map-marker"></i> Titik Awal</b>
                </div>
                <div class="col-lg-3 ">
                  <input type="text" class="form-control form-control-sm" id="start" placeholder="Masukan titik">
                </div>
                <div class="col-lg-3" style="visibility: hidden;">
                  <select class="form-control" id="end">            
                    <option value="<?= $usaha->umkm_lat ?>, <?= $usaha->umkm_lon ?>">            
                      <?= $usaha->nama ?>
                    </option>            
                  </select>
                </div>               
              </div>                          
            </div>            
            <!-- /.panel-heading -->
            <div class="panel-body">             
              <div id="map" style="height: 600px"></div>
            </div>
          </div>
        </div>
        <script type="text/javascript">              
          var directionsService = new google.maps.DirectionsService();
          var directionsRenderer = new google.maps.DirectionsRenderer();
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng( -0.36980634220026604, 102.28501200000001),        
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });    

          directionsRenderer.setMap(map);

          const onChangeHandler = function () {
            calculateAndDisplayRoute(directionsService, directionsRenderer);
          };

          document.getElementById("start").addEventListener("change", onChangeHandler);
          document.getElementById("end").addEventListener("change", onChangeHandler);

          function calculateAndDisplayRoute(directionsService, directionsRenderer) {
            directionsService
            .route({
              origin: {
                query: document.getElementById("start").value,
              },
              destination: {
                query: document.getElementById("end").value,
              },
              travelMode: google.maps.TravelMode.DRIVING,
            })
            .then((response) => {
              directionsRenderer.setDirections(response);
            })
            .catch((e) => window.alert("Directions request failed due to " + status));
          }

        </script>
