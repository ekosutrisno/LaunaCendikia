<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
   }

   public function index()
   {
      if ($this->session->userdata('email')) {
         redirect('user');
      }

      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');

      if ($this->form_validation->run() == false) {
         $data['judul'] = 'Halaman Login';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/login');
         $this->load->view('templates/auth_footer');
      } else {
         //validasi yang sukses
         $this->_login();
      }
   }


   private function _login()
   {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->db->get_where('user', ['email' => $email])->row_array();
      if ($user) {
         if ($user['is_active'] == 1) {
            //cek password
            if (password_verify($password, $user['password'])) {
               $data = [
                  'email' => $user['email'],
                  'role_id' => $user['role_id']
               ];
               $this->session->set_userdata($data);
               if ($user['role_id'] == 1) {
                  redirect('admin');
               } else {
                  redirect('user');
               }
            } else {
               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong password! </div>');
               redirect('auth');
            }
         } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> This email has not been activated! </div>');
            redirect('auth');
         }
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email is not registered! </div>');
         redirect('auth');
      }
   }

   public function registration()
   {

      if ($this->session->userdata('email')) {
         redirect('user');
      }

      // set required
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
         'is_unique' => 'This email has allready registered!'
      ]);
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
         'matches' => 'Password dont match!',
         'min_length' => 'Password too short'
      ]);

      $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

      if ($this->form_validation->run() == false) {
         $data['judul'] = 'Halaman Registrasi';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/registration');
         $this->load->view('templates/auth_footer');
      } else {
         $email = $this->input->post('email', true);
         $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 0,
            'date_created' => time()
         ];

         $token = base64_encode(random_bytes(32));
         $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' => time()
         ];

         $this->db->insert('user', $data);
         $this->db->insert('user_token', $user_token);

         $this->_sendEmail($token, 'verify');

         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your account has been created. Please Activate your Account</div>');
         redirect('auth');
      }
   }

   private function _sendEmail($token, $type)
   {
      $config = [
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://smtp.googlemail.com',
         'smtp_user' => 'mediapembelajaran.mtk15@gmail.com',
         'smtp_pass' => 'AkuCintaKamu801',
         'smtp_port' => 465,
         'mailtype' => 'html',
         'charset' => 'utf-8',
         // 'newline' => "\r\n"
      ];
      // 465

      // !setting email 
      $this->load->library('email');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");

      $this->email->from('mediapembelajaran.mtk15@gmail.com', 'Launa Cendikia MTSN 2 BDL');
      $this->email->to($this->input->post('email'));

      // type method 
      if ($type == 'verify') {
         $this->email->subject('Confirm Activation Your Account');
         $this->email->message(
            '
            <div style="
            background:#041D2E;
            width:300px;
            height:150px;
            padding:10px;
            border-radius:10px
            ">
           <p style="color:white;font-size:14px"> Halo Sahabat Launa, harap segera melakuakn aktivasi account kamu sebelum 24 jam ya dengan mengklik tombol dibawah ini :</p> <br> <a style=" background:white  ;
           padding: 10px 40px;
           color: #151527;
           text-decoration: none;
           font-size: 18px;
           border-radius: 20px;
           margin-top: 150px;"  href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>
            </div>
            <br>
           -Tim Pengembang Launa Cendikia-
            
            '
         );
      } else if ($type == 'forgot') {
         $this->email->subject('Reset Password');
         $this->email->message(
            '
            <div style="
            background:#041D2E;
            width:300px;
            height:150px;
            padding:10px;
            border-radius:10px
            ">
           <p style="color:white;font-size:14px"> Halo Sahabat Launa, harap segera melakuakn reset password dengan mengklik tombol dibawah ini :</p> <br> <a style=" background:white  ;
           padding: 10px 40px;
           color: #151527;
           text-decoration: none;
           font-size: 18px;
           border-radius: 20px;
           margin-top: 150px;"  href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a>
            </div>
            <br>
           -Tim Pengembang Launa Cendikia-
            
            '
         );
      }

      if ($this->email->send()) {
         return true;
      } else {
         echo $this->email->print_debugger();
         die;
      }
   }

   public function verify()
   {
      $email = $this->input->get('email');
      $token = $this->input->get('token');

      $user = $this->db->get_where('user', ['email' => $email])->row_array();

      if ($user) {

         $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

         if ($user_token) {

            if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
               $this->db->set('is_active', 1);
               $this->db->where('email', $email);
               $this->db->update('user');

               $this->db->delete('user_token', ['email' => $email]);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
               redirect('auth');
            } else {

               $this->db->delete('user', ['email' => $email]);
               $this->db->delete('user_token', ['email' => $email]);

               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed, token expired! </div>');
               redirect('auth');
            }
         } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed, token invalid! </div>');
            redirect('auth');
         }
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed, Wrong email! </div>');
         redirect('auth');
      }
   }


   public function logout()
   {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged! </div>');
      redirect('auth');
   }

   public function blocked()
   {
      $this->load->view('auth/blocked');
   }

   public function forgotPassword()
   {

      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

      if ($this->form_validation->run() == false) {
         $data['judul'] = 'Forgot Password';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/forgot-password');
         $this->load->view('templates/auth_footer');
      } else {
         $email = $this->input->post('email');
         $user =  $this->db->get_Where('user', ['email' => $email, 'is_active' => 1])->row_array();
         if ($user) {
            $token = base64_encode(random_bytes(32));
            $user_token = [
               'email' => $email,
               'token' => $token,
               'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'forgot');

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Check your email, for reset your password!  </div>');
            redirect('auth/forgotpassword');
         } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">email is not registered or activated! </div>');
            redirect('auth/forgotpassword');
         }
      }
   }

   public function resetPassword()
   {
      $email = $this->input->get('email');
      $token = $this->input->get('token');
      $user = $this->db->get_where('user', ['email' => $email])->row_array();

      if ($user) {
         $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

         if ($user_token) {
            $this->session->set_userdata('reset_email', $email);
            $this->changePassword();
         } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed, wrong token! </div>');
            redirect('auth');
         }
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed, wrong email! </div>');
         redirect('auth');
      }
   }


   public function changePassword()
   {

      if (!$this->session->userdata('reset_email')) {
         redirect('auth');
      }

      $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]');

      if ($this->form_validation->run() == false) {
         $data['judul'] = 'Change Password';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/change-password');
         $this->load->view('templates/auth_footer');
      } else {
         $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
         $email = $this->session->userdata('reset_email');

         $this->db->set('password', $password);
         $this->db->where('email', $email);
         $this->db->update('user');
         $this->session->unset_userdata('reset_email');

         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been change, please Login!</div>');
         redirect('auth');
      }
   }
}
