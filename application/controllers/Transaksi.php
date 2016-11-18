
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
        if(!$this->session->userdata('username'))
            redirect('auth');
    }

    public function index()
    {
        $data_page    = array(
        'title'     => 'Transaksi ',
        'button'    => '<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success" name="button"><i class="ti-plus"></i>&nbsp&nbspBaru</button>',
        'side_bar'  => $this->ratnaningsih->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi', array(),true)
        );
        $this->parser->parse('main', $data_page);
    }

}

/* End of file BTransaksi.php */
