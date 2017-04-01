<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyPagination
{
	protected $ci;

	public function __construct()
	{
        $this->ci = & get_instance();
        $this->ci->load->library('pagination');
	}

	function pagination($url, $total_rows, $uri_segment)
	{
		$config = array();
	    $config["base_url"]    = site_url() .'/'.$url;
	    $config["total_rows"]  = $total_rows;
	    $config["per_page"]    = 10;
	    $config["uri_segment"] = $uri_segment;
	    $config['reuse_query_string'] = true;
	    //config for bootstrap pagination class integration
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    // $config['first_link'] = true;
	    // $config['last_link']  = true;
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_link']     = '&laquo';
	    $config['prev_tag_open'] = '<li class="prev">';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = '&raquo';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';

	    $this->ci->pagination->initialize($config);

	    $page = ( $this->ci->uri->segment($uri_segment)) ?  $this->ci->uri->segment($uri_segment) : 0;
	    $pagination = array('per_page' => $config["per_page"],
	    					'page' => $page,
	    					'link' =>  $this->ci->pagination->create_links()
	    					);
	    return $pagination;
	}


}

/* End of file Extra.php */
/* Location: ./application/libraries/Extra.php */
