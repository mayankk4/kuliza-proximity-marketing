<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{

		$data = array(
			'title' => 'Tagit | Product Video',
			'heading' => 'Product Video',
		);

		$this->load->view('video/index', $data);
	}


}

/* End of file video.php */
/* Location: ./application/controllers/video.php */