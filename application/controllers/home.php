<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{	


		$this->load->helper('log4php');
		// log_error('hogehoge');
		// log_info('hogehoge');
		// log_debug('hogehoge');

		$data = array(
			'title' => 'Proximity-Marketing | Home',
			'heading' => 'Proximity-Marketing | Home'
		);
		$this->load->view('home/index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */