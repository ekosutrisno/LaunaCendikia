<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/fontawesome/css/all.css"> -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/style.css">

   <title><?= $judul; ?></title>
   <!-- <style>
      body {
         background: url(assets/img/bg2.jpg);
         background-size: cover;
         background-repeat: no-repeat;
         background-position: center;
         background-attachment: fixed;
      }
   </style> -->
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container  mb-0">
         <a class="navbar-brand" href="">
            <h1>Launa <span class="" style="color:aquamarine;font-weight:lighter">Cendikia</span></h1>
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
               <a class="nav-item nav-link" href="<?= base_url(); ?>">Home <span class="sr-only">(current)</span></a>
               <a class="nav-item nav-link" href="<?= base_url(); ?>Anggota">Anggota</a>
               <a class="nav-item nav-link" href="<?= base_url(); ?>About">About</a>
            </div>
         </div>
      </div>
   </nav>
   <div class="container">