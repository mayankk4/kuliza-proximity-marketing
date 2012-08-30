<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('products', 'PRODUCTS');
		$this->load->model('owners', 'OWNERS');

	}
	public function view($id_encoded)
	{	

		$id = base64_decode($id_encoded);

		$data = array(
			'title' => 'Tagit | Product details',
			'heading' => 'Product Details',
			'id' => $id
		);

		$this->load->view('product/view', $data);
	}


	public function get_product_details($id){
		$data = $this->PRODUCTS->get_product(array('id'=>$id));
		echo json_encode($data);
	}

	public function get_owner_details($id){
		$data = $this->OWNERS->get_owner(array('id'=>$id));
		echo json_encode($data);
	}

}

/* End of file register.php */
/* Location: ./application/controllers/register.php */