<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

   public function index()
   {

      $data['judul'] = 'My Profile';
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

      $this->load->view('templates/menu_header', $data);
      $this->load->view('templates/menu_sidebar', $data);
      $this->load->view('templates/menu_topbar', $data);
      $this->load->view('user/index', $data);
      $this->load->view('templates/menu_footer');
   }
}
