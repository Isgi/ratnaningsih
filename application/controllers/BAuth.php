<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BAuth extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view('b_login');
  }

  public function actLogin()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $getUser = $this->modelsik->getUser(array('username' => $username, 'password' => md5($password) ));
    if ($getUser->num_rows() == 1) {
            $data_user = $getUser->row_array();
            $sess_data['logged_in'] = TRUE;
            $sess_data['username'] = $data_user['username'];
            $sess_data['jabatan'] = $data_user['jabatan'];
            $sess_data['nama'] = $data_user['nama'];
            $sess_data['id_yayasan'] = $data_user['id_yayasan'];
            $sess_data['nama_yayasan'] = $data_user['nama_yayasan'];
            $this->session->set_userdata($sess_data);
            redirect(bdashboard);
    }
    else {
        $this->session->set_flashdata('notif','Username or Password is Incorrect');
        redirect('bauth','refresh');
        return FALSE;
    }
  }
  public function actLogout()
  {
      $this->session->unset_userdata('username');
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('jabatan');
      $this->session->unset_userdata('nama');
      $this->session->set_flashdata('notif','THANK YOU FOR LOGIN IN THIS APP');
      redirect('bauth');
  }


}
