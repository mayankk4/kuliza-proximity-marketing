<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('tank_auth');

		$this->load->model('owners', 'OWNERS');
		$this->load->model('products', 'PRODUCTS');

	}


	public function index(){

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else{

			$data = array(
				'title' => 'Tagit | Admin',
				'heading' => 'Admin Panel',
				'user_id'	=> $this->tank_auth->get_user_id(),
				'username'	=> $this->tank_auth->get_username()
			);

			$this->load->view('admin/index', $data);
		}
	} // end function index


	public function listall(){

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else{

			$data = array(
				'title' => 'Tagit | Admin',
				'heading' => 'Admin Panel | List',
				'user_id'	=> $this->tank_auth->get_user_id(),
				'username'	=> $this->tank_auth->get_username()
			);

			$this->load->view('admin/listall', $data);
		}
	}


	public function insert(){
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else{

			$data = array(
				'title' => 'Tagit | Admin',
				'heading' => 'Admin Panel | Create',
				'user_id'	=> $this->tank_auth->get_user_id(),
				'username'	=> $this->tank_auth->get_username()
			);

			$this->load->view('admin/insert', $data);
		}
	}


	public function edit_product($id){
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else{

			$data = array(
				'title' => 'Tagit | Admin',
				'heading' => 'Admin Panel | Edit',
				'user_id'	=> $this->tank_auth->get_user_id(),
				'username'	=> $this->tank_auth->get_username(),
				'current_id' => $id
			);

			$this->load->view('admin/edit_product', $data);
		}
	}

	public function edit_owner($id){
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else{

			$data = array(
				'title' => 'Tagit | Admin',
				'heading' => 'Admin Panel | Edit',
				'user_id'	=> $this->tank_auth->get_user_id(),
				'username'	=> $this->tank_auth->get_username(),
				'current_id' => $id
			);

			$this->load->view('admin/edit_owner', $data);
		}
	}


	////////////////////////////// A J A X   S E R V I C E S ///////////////////////////////////


	public function create_product(){
		$data = array(
			'owner_id' => $_POST['owner_id'],
			'name' => $_POST['name'],
			'product_id' => $_POST['product_id'],
			'url' => $_POST['url'],
			'image_url' => $_POST['image_url'],
			'description' => $_POST['description'],
			'category' => $_POST['category'],
			'objectType' => $_POST['objectType'],
			);

		if($this->PRODUCTS->create_product($data)){
			echo json_encode(TRUE);
		}else{
			echo json_encode(FALSE);
		}
	}

	public function create_owner(){
		$data = array(
			'name' => $_POST['name']
			);

		if($this->OWNERS->create_owner($data)){
			echo json_encode(TRUE);
		}else{
			echo json_encode(FALSE);
		}
	}



	public function get_all_owners_products(){

		$owners = $this->OWNERS->get_owner(array('is_deleted'=>0));
		$products = $this->PRODUCTS->get_product(array('is_deleted'=>0));

		$data['owners'] = $owners;
		$data['products'] = $products;
		echo json_encode($data);
	}


	public function update_product(){
		$conditions = array(
			'id' => $_POST['id']
		);
		$new_data = array(
			'owner_id' => $_POST['owner_id'],
			'product_id' => $_POST['product_id'],
			'category' => $_POST['category'],
			'objectType' => $_POST['objectType'],
			'name' => $_POST['name'],
			'url' => $_POST['url'],
			'image_url' => $_POST['image_url'],
			'description' => $_POST['description'],
		);
		echo json_encode($this->PRODUCTS->update_product($conditions, $new_data));
	}

	public function update_owner(){
		$conditions = array(
			'id' => $_POST['id']
		);
		$new_data = array(
			'name' => $_POST['name'],
		);
		echo json_encode($this->OWNERS->update_owner($conditions, $new_data));
	}



	public function delete_product(){
		$conditions = array(
			'id' => $_POST['id']
		);
		$new_data = array(
			'is_deleted' => TRUE,
		);
		echo json_encode($this->PRODUCTS->update_product($conditions,$new_data));
	}

	// public function delete_owner(){
	// 	$conditions = array(
	// 		'id' => $_POST['id']
	// 	);
	// 	$new_data = array(
	// 		'is_deleted' => TRUE,
	// 	);
	// 	echo json_encode($this->OWNERS->update_owner($data));
	// }


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */