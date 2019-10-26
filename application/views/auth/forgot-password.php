<div class="container">

   <!-- Outer Row -->
   <div class="row">

      <!-- input login -->
      <div class="col-lg-6 text-center">
         <img src="<?= base_url('assets/img/pic/wp3.png'); ?>" class="img-fluid">
         <br>
         <a class="btn btn-sm btn-outline-light mt-3" href="<?= base_url('about'); ?>">Yuk kenalan dengan Launa Cendikia</a>
      </div>

      <div class="col-lg-6">

         <div class="card o-hidden border-0 shadow-lg my-5 " style="background:#041D2E">
            <div class="card-body p-0">
               <!-- Nested Row within Card Body -->
               <div class="row">
                  <div class="col-lg">
                     <div class="p-5">
                        <div class="text-center">
                           <h1 class="h4 text-white mb-4" style="">Kamu lupa password?</h1>
                        </div>

                        <!-- flasdata -->
                        <?= $this->session->flashdata('message'); ?>

                        <form class="user" method="post" action="<?= base_url('auth/forgotpassword'); ?>">
                           <div class="form-group">
                              <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
                              <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                           </div>
                           <button type="submit" class="btn btn-primary btn-user btn-block">
                              Reset password
                           </button>
                        </form>
                        <hr>
                        <div class="text-center">
                           <a class="small text-white" href="<?= base_url('auth'); ?>">Back to login</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <!-- end iput login -->
   </div>
   <div class="row py-3">
      <div class="col-lg text-center">
         <small>
            <p class="">Selamat datang di portal aplikasi Launa Cendikia V.1.0 <br>Copyright &copy; Launa Cendikia 2019 </p>
         </small>
      </div>
   </div>

</div>