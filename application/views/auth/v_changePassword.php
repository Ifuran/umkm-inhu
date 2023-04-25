<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-lg-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">                       
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">                
                            <h1 class="h4 text-gray-900"><i class="fas fa-door-closed"></i> Ubah Password Anda</h1><h5 class="mb-4"><?= $this->session->userdata('reset_email') ?></h5>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form method="post" action="<?= base_url('auth/changePassword') ?>"  class="user">
                         <div class="form-group">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                           <input type="password" class="form-control"
                           id="password1" name="password1" placeholder="Masukan password baru...">
                       </div>
                       <div class="form-group">
                           <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                           <input type="password" class="form-control"
                           id="password2" name="password2" placeholder="Ulangi password baru...">
                       </div>                                                            
                       <button type="submit" class="btn btn-primary btn-user btn-block">Ubah Password</button>
                   </form>                   
            </div>
        </div>
    </div>
</div>
</div>

</div>

</div>

</div>