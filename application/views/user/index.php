<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

   <div class="card border-left-primary shadow h-100 py-2" style="max-width:540px;">
      <div class="row no-gutters">
         <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
         </div>
         <div class="col-md-8">
            <div class="card-body">
               <h5 class="card-title"><?= $user['name']; ?></h5>
               <p class="card-text">
                  <?= $user['email']; ?>
               </p>
               <p class="card-text"> <small class="text-muted"> Member since
                     <?= date('d,F,Y', $user['date_created']); ?></small>
               </p>
            </div>
         </div>
      </div>

   </div>

   <!-- ?ek  -->
   <div class="col-xl-3 col-md-6 mt-3">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
               </div>
               <div class="">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- ?ek  -->


</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->