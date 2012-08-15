<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Model{

    // select
    // where
    // get table_name

    private $table_name         = 'products';

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /////////////////////////////////// B A S I C    C R U D ////////////////////////////////////////

    // Send the data as
    //   $data = array(
    //       'id' => $facebook_id,
    //       'owner_id' => $facebook_id,
    //       'product_id' => $facebook_id,
    //       'name' => $facebook_id,
    //       'url' => $fb_access_token,
    //       'image_url' => $expires,
    //       'description' => $expires,
    //       'is_deleted' => $expires,
    //       'created' => $expires,
    //   );
    // TODO : expires needs to be set properly
    function create_product($data){
        if($this->db->insert($this->table_name,$data)){
            $id = $this->db->insert_id();
            return array('id'=>$id);
        }
    }

    // $query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
    // multiple result              // if ($query->num_rows() > 0) return $query->result()
    // single   result (limit = 1)  // if ($query->num_rows() == 1) return $query->row();
    function get_product($data=NULL, $limit=NULL, $offset=NULL){
        $query = $this->db->get_where($this->table_name, $data, $limit, $offset);
        $return = array();
        if($query->num_rows() == 0){ // no result
            // do nothing
        }else{ // multiple rows
            $return = $query->result_array();
        }
        return $return;
    }


    // @return updated user's id
    //$this->db->update('mytable', $data, array('id' => $id));
    function update_product($conditions, $new_data){
        return $this->db->update($this->table_name, $new_data, $conditions);
    }

    function delete_product($data){
        return $this->db->delete($this->table_name, $data); 
    }

    function check_product_exists($data){
        $query = $this->db->get_where($this->table_name, $data);
        if($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }        
    }


    //////////////////////////////////// T e s t   S u i t e ////////////////////////////////////

    // must return true
    function test_model(){
        return TRUE;
    }

}


/* End of file products.php */
/* Location: ./application/models/products.php */