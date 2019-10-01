<?php
class Anggota extends CI_Controller
{
   public function index()
   {
      $data['judul'] = 'Halaman Anggota';
      $this->load->view('templates/header', $data);
      $this->load->view('anggota/index');
      $this->load->view('templates/footer');
   }
}
