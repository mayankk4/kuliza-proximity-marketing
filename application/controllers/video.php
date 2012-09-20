<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array(
			'title' => 'Tagit | Product Videos Home',
			'heading' => 'Product Video',
		);
		$this->load->view('video/index', $data);
	}

	public function view($id)
	{

		$data = array(
			'title' => 'Tagit | Product Video',
			'heading' => 'Product Video',
		);

		if($id=="MQ=="){
			$this->load->view('video/movie', $data);
		}elseif($id=="Mg=="){
			$this->load->view('video/dell', $data);			
		}
	}


}

/* End of file video.php */
/* Location: ./application/controllers/video.php */