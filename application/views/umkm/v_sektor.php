<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> 
          <i class="fa fa-list fa-fw"></i> <?= $title ?></h1>
        </div>
        <div class="col-lg-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Data Sektor UMKM
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body"> 

              <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data</a>
              <div><br></div>               
              <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
              <?= $this->session->flashdata('message'); ?>     

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
                      <th scope="col">Sektor</th>
                      <th scope="col">UMKM</th>        
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    <?php foreach ($sektor as $key => $value) { ?>

                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $value->nama ?></td>          
                        <td><?= $value->jumlah_umkm ?></td>          
                        <td>            
                          <a href="<?= base_url('umkm/deleteSektor/'.$value->id); ?>" class="btn btn-danger btn-sm" onclick=" return confirm('Kamu yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
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
                <form class="user" method="post" action="<?= base_url('umkm/sektor') ?>">
                  <div class="form-group">          
                    <input type="text" class="form-control" id="nama" name="nama"
                    placeholder="Nama Sektor..">
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>      
                  </div>
                </form>                              
              </div>   
            </div>
          </div>
        </div>
<!-- End of Main Content -->