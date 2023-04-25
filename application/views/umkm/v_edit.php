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
                        <?= form_open_multipart('umkm/edit/'.$profile->id_umkm) ?>
                        <div class="form-group">                             
                            <?= form_error('id_pengguna', '<small class="text-danger">', '</small>') ?>
                            <label for="id_pengguna" class="col-sm-12">Nama</label>
                            <select class="form-control col" name="id_pengguna" id="id_pengguna">
                                <option value="<?= $profile->id_pengguna ?>"><?= $profile->user ?></option>
                                <?php foreach ($users as $key => $value) { ?>              
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>                    
                        </div>
                        <div class="form-group">
                            <?= form_error('id_kec', '<small class="text-danger">', '</small>') ?>
                            <label for="id_kec" class="col-sm-12">Kecamatan</label>
                            <select class="form-control col" name="id_kec" id="id_kec">
                                <option value="<?= $profile->id_kec ?>"><?= $profile->kecamatan ?></option>
                                <?php foreach ($kecamatan as $key => $value) { ?>              
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <?= form_error('umkm_desa', '<small class="text-danger">', '</small>') ?>
                            <label for="umkm_desa" class="col-sm-12">Alamat Usaha</label>
                            <input type="text" class="form-control col" id="umkm_desa" name="umkm_desa" value="<?= $profile->umkm_desa ?>">        
                        </div>
                        <div class="form-group">
                            <?= form_error('id_sektor', '<small class="text-danger">', '</small>') ?>
                            <label for="id_sektor" class="col-sm-12">Sektor Usaha</label>
                            <select class="form-control col" name="id_sektor" id="id_sektor">
                                <option value="<?= $profile->id_sektor ?>"><?= $profile->sektor ?></option>
                                <?php foreach ($sektor as $key => $value) { ?>              
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>    
                        </div>
                        <div class="form-group">
                            <?= form_error('bidang', '<small class="text-danger">', '</small>') ?>
                            <label for="bidang" class="col-sm-12">Bidang Usaha</label>
                            <input type="text" class="form-control col" id="bidang" name="bidang" value="<?= $profile->bidang ?>">  
                        </div>      
                        <div class="form-group">      
                            <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>

                            <label for="no_hp" class="col-sm-12">No.Telp</label>
                            <input type="text" class="form-control col" id="no_hp" name="no_hp" value="<?= $profile->no_hp ?>">
                        </div>
                        <div class="form-group">            

                            <label for="umkm_lat" class="col-sm-12">Latitude</label>
                            <input type="text" class="form-control col" id="umkm_lat" name="umkm_lat" placeholder="Latitude" value="<?= $profile->umkm_lon ?>">
                        </div> 
                        <div class="form-group">
                            <?= form_error('umkm_lon', '<small class="text-danger">', '</small>') ?>  
                            <label for="umkm_lon" class="col-sm-12">Longitude</label>
                            <input type="text" class="form-control col" id="umkm_lon" name="umkm_lon" placeholder="Latitude" value="<?= $profile->umkm_lon ?>">
                        </div>
                        <div class="form-group">
                            <?= form_error('gambar', '<small class="text-danger">', '</small>') ?>              
                            <label for="gambar" class="col-sm-12">Gambar</label>              
                            <img src="<?= base_url('template/img/umkm/') .$profile->gambar ?>" class="img-thumbnail col-sm-3">
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