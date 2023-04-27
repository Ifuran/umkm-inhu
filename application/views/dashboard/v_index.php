<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-dashboard fa-fw"></i> <?= $title ?></h1>
        </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between">
            <a href="#" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fa fa-download fa-fw"></i> Cetak Laporan</a>  
          </div>
          <div><br></div>
          <!-- /.row -->
          <div class="row">
            <div class="col-lg-3 col-md-6" >
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-1">
                      <i class="fa fa-table fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class="huge"><?= $umkm ?></div>
                      <div>UMKM</div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
            <div class="col-lg-3 col-md-6" >
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-3">
                      <i class="fa fa-map fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class="huge"><?= $users ?></div>
                      <div>PENGGUNA</div>
                    </div>
                  </div>
                </div>     
              </div>
            </div>
            <div class="col-lg-3 col-md-6" >
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-1">
                      <i class="fa fa-user fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class="huge"><?= $pelaku_usaha ?></div>
                      <div>PELAKU USAHA</div>
                    </div>
                  </div>
                </div>     
              </div>
            </div>
            <div class="col-lg-3 col-md-6" >
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-1">
                      <i class="fa fa-map fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class="huge"><?= $sektor ?></div>
                      <div>SEKTOR USAHA</div>
                    </div>
                  </div>
                </div>     
              </div>
            </div>
            <div class="col-lg-3 col-md-6" >
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-1">
                      <i class="fa fa-user fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class="huge"><?= $kecamatan ?></div>
                      <div>KECAMATAN</div>
                    </div>
                  </div>
                </div>     
              </div>
            </div>  
          </div>
          <!-- /.row -->
          <?php if ($this->session->userdata('role_id') == 1) { ?>  
            <div class="row">
              <div class="col-lg-6">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    UMKM Berdasarkan Sektor
                  </div>                
                  <div class="panel-body">
                    <canvas id="myChart"></canvas>                                       
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    UMKM Berdasarkan Kecamatan
                  </div>                
                  <div class="panel-body">
                    <canvas id="myChart2"></canvas>                                       
                  </div>
                </div>
              </div>
            </div>            
          <?php } ?>         
          <!-- ChartJS -->
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <?php
          //Inisialisasi nilai variabel awal
          $nama_sektor= "";
          $jumlah_sektor=null;
          foreach ($sektor_umkm as $item)
          {
            $jur_sektor=$item->nama_sektor;
            $nama_sektor .= "'$jur_sektor'". ", ";
            $jum_sektor=$item->total;
            $jumlah_sektor .= "$jum_sektor". ", ";
          }

          //Inisialisasi nilai variabel awal
          $nama_kecamatan= "";
          $jumlah_kecamatan=null;
          foreach ($kecamatan_umkm as $item)
          {
            $jur_kecamatan=$item->nama_kecamatan;
            $nama_kecamatan .= "'$jur_kecamatan'". ", ";
            $jum_kecamatan=$item->total;
            $jumlah_kecamatan .= "$jum_kecamatan". ", ";
          }
          ?>
          <script>
          //deklarasi chartjs untuk membuat grafik 2d di id mychart 
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
            //chart akan ditampilkan sebagai bar chart
            type: 'bar',
            data: {
              //membuat label chart
              labels: [<?= $nama_sektor ?>],
              datasets: [{
                label: 'Jumlah UMKM',
                  //isi chart
                  data: [<?= $jumlah_sektor ?>],                        
                }]
              },
              options: {      
              }
            });
          var ctx = document.getElementById('myChart2').getContext('2d');
          var myChart = new Chart(ctx, {
            //chart akan ditampilkan sebagai bar chart
            type: 'bar',
            data: {
              //membuat label chart
              labels: [<?= $nama_kecamatan ?>],
              datasets: [{
                label: 'Jumlah UMKM',
                  //isi chart
                  data: [<?= $jumlah_kecamatan ?>],                        
                }]
              },
              options: {      
              }
            });
          </script> 
