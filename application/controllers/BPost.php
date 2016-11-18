<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BPost extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form'));
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('bauth');

    // $this->load->library('extra');
  }

  function index()
  {
    // $url = 'bpost/index';
		// $total_rows = $this->modelyac->getpost(10,1)->num_rows();
		// $uri_segment = 3;
		// $pagination = $this->extra->pagination($url, $total_rows, $uri_segment);

    $data_content = $this->modelyac->getpost()->result();
    $data_page    = array(
      'title'     => 'Post',
      'side_bar'  => $this->modelyac->getmenu()->result(),
      'content'   => $this->parser->parse('back/b_post', array('url_root' => 'bpost','data_content'=>$data_content),true)
    );
    $this->parser->parse('back/b_main', $data_page);
  }
  public function add()
  {
    $data_content = array('data_content'=> array('id' => '', 'judul' => '','isi' => '','gambar' => 'empty'));
    $data_page    = array(
      'title'     => 'Post > New Post',
      'side_bar'  => $this->modelyac->getmenu()->result(),
      'content'   => $this->parser->parse('back/b_post_new', array('url' => 'bpost/actadd','data_content' => $data_content),true)
    );
    $this->parser->parse('back/b_main', $data_page);
  }
  public function actAdd()
  {
    $title = $this->input->post('title');
    $content = $this->input->post('content');
    $imageHeader = 'no_image.jpg';

    $config['upload_path'] = './assets/img/upload/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']  = '10000';
    $config['max_width']  = '';
    $config['max_height']  = '';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('userfile'))
    {
      $imageHeader = $this->upload->data()['file_name'];
    }

    $data = array(
      'judul' => $title,
      'gambar' => $imageHeader,
      'isi' => $content,
      'user' => $this->session->userdata('id'),
      'waktu'=> gmdate("Y-m-d H:i:s", time()+60*60*7)
    );
    $this->modelyac->insertpost($data);
    redirect('bpost');
  }

  public function edit($id)
  {
    $data_content = $this->modelyac->getpostby(array('id' => $id ))->result_array();
    $data_page    = array(
      'title'     => 'Post > Edit',
      'side_bar'  => $this->modelyac->getmenu()->result(),
      'content'   => $this->parser->parse('back/b_post_new', array('url' => 'bpost/actedit' ,'data_content' => $data_content),true)
    );
    $this->parser->parse('back/b_main', $data_page);
  }

  public function actEdit()
  {
    $id = $this->input->post('id');
    $title = $this->input->post('title');
    $content = $this->input->post('content');
    $imageHeader = '';

    $config['upload_path'] = './assets/img/upload/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']  = '10000';
    $config['max_width']  = '';
    $config['max_height']  = '';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('userfile')){
      $imageHeader = $this->upload->data()['file_name'];
    }

    $data = array(
      'id' => $id,
      'judul' => $title,
      'gambar' => $imageHeader,
      'isi' => $content,
      'user' => $this->session->userdata('id'),
      'waktu'=> gmdate("Y-m-d H:i:s", time()+60*60*7)
    );

    $this->modelyac->updatepost($data);
    redirect('bpost');
  }

  public function actDelete($id)
  {
    $data = array(
      'id' => $id,
      'status' => 'invisible'
    );
    $this->modelyac->updatepost($data);
    redirect('bpost');
  }

}
