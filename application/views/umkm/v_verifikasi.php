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
                            <a href="<?= base_url('umkm/setujuiUsaha/'.$value->id_umkm); ?>" class="btn btn-success btn-sm" onclick=" return confirm('Kamu yakin ingin menyetujui data ini?')">Setuju</a>
                            <a href="<?= base_url('umkm/tolakUsaha/'.$value->id_umkm); ?>" class="btn btn-danger btn-sm" onclick=" return confirm('Kamu yakin ingin menghapus data ini?')">Tolak</a>
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