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

		try{
			$id = base64_decode($id_encoded);
		}catch(Exception $e){
			redirect('/404');
		}

		$data = array(
			'title' => 'Tagit | Product details',
			'heading' => 'Product Details',
			'id' => $id
		);

		$this->load->view('product/view', $data);
	}


	//////////////////// a j a x    h e l p e r s //////////////////////

	public function get_product_details($id){

		try{
			$data = $this->PRODUCTS->get_product(array('id'=>$id));
			echo json_encode($data);
		}catch(Exception $e){
			redirect('/404');
		}
		
	}

	public function get_owner_details($id){
		$data = $this->OWNERS->get_owner(array('id'=>$id));
		echo json_encode($data);
	}

}

/* End of file register.php */
/* Location: ./application/controllers/register.php */