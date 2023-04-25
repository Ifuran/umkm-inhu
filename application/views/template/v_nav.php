                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                  <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      <li class="sidebar-search">
                        <div class="input-group custom-search-form">

                        </div>
                        <!-- /input-group -->
                      </li>
                      <li>
                        <a href="<?= base_url('dashboard') ?>" style="padding-top: 20px ;padding-bottom: 20px ;"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                      </li> 
                      <?php if ($this->session->userdata('role_id') == 1) { ?>     
                      <li>
                        <a href="<?= base_url('user') ?>" style="padding-top: 20px ;padding-bottom: 20px ;"><i class="fa fa-user fa-fw"></i> Pengguna</a>
                      </li>  
                      <li>
                        <a href="<?= base_url('umkm/sektor') ?>" style="padding-top: 20px ;padding-bottom: 20px ;"><i class="fa fa-list fa-fw"></i> Kategori Sektor</a>
                      </li>  
                      <?php } ?>    
                      <li>
                        <a href="<?= base_url('map') ?>" style="padding-top: 20px ;padding-bottom: 20px ;"><i class="fa fa-map fa-fw"></i> Peta</a>
                      </li>                    
                      <li>
                        <a href="<?= base_url('umkm') ?>" style="padding-top: 20px ;padding-bottom: 20px ;"><i class="fa fa-table fa-fw"></i> UMKM</a>
                      </li>                            
                      <li>
                        <a href="<?= base_url('auth/logout') ?>" style="padding-top: 20px ;padding-bottom: 20px ;"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
                      </li>                      

                    </ul>
                  </div>
                  <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
              </nav>              