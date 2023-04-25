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
                            <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-door-closed"></i> Lupa Password?</h1>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form method="post" action="<?= base_url('auth/forgotPassword') ?>"  class="user">
                           <div class="form-group">
                             <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                             <input type="text" class="form-control"
                             id="email" name="email" value="<?= set_value('email'); ?>" 
                             placeholder="Masukan Email...">
                         </div>                                                            
                         <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                     </form>
                     <hr>                    
                    <div class="text-center">
                        <a class="small" href="<?= base_url('auth'); ?>">Halaman Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</div>

</div>