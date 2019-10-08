<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
   public function index()
   {
      $data['judul'] = 'Menu Management';
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $data['menu'] = $this->db->get('user_menu')->result_array();

      $this->form_validation->set_rules('menu', 'Menu', 'required');

      if ($this->form_validation->run() == false) {
         $this->load->view('templates/menu_header', $data);
         $this->load->view('templates/menu_sidebar', $data);
         $this->load->view('templates/menu_topbar', $data);
         $this->load->view('menu/index', $data);
         $this->load->view('templates/menu_footer');
      } else {
         $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu Added! </div>');
         redirect('menu');
      }
   }

   public function submenu()
   {
      $data['judul'] = 'Submenu Management';
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $data['menu'] = $this->db->get('user_menu')->result_array();

      $this->load->model('Menu_model', 'menu');

      $data['subMenu'] = $this->menu->getSubMenu();
      $data['menu'] = $this->db->get('user_menu')->result_array();

      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('menu_id', 'Menu', 'required');
      $this->form_validation->set_rules('url', 'URL', 'required');
      $this->form_validation->set_rules('icon', 'Icon', 'required');


      if ($this->form_validation->run() == false) {
         $this->load->view('templates/menu_header', $data);
         $this->load->view('templates/menu_sidebar', $data);
         $this->load->view('templates/menu_topbar', $data);
         $this->load->view('menu/submenu', $data);
         $this->load->view('templates/menu_footer');
      } else {
         $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
         ];
         $this->db->insert('user_sub_menu', $data);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu Added! </div>');
         redirect('menu/submenu');
      }
   }
}
