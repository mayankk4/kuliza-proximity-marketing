<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Owners extends CI_Model{

    // select
    // where
    // get table_name

    private $table_name         = 'owners';

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /////////////////////////////////// B A S I C    C R U D ////////////////////////////////////////

    // Send the data as
    //   $data = array(
    //       'id' => $id, //optional
    //       'name' => $facebook_id,
    //       'created' => $expires,
    //   );
    // TODO : expires needs to be set properly
    function create_owner($data){
        if($this->db->insert($this->table_name,$data)){
            $id = $this->db->insert_id();
            return array('id'=>$id);
        }
    }

    // Send the data as
    //   $data = array(
    //       'id' => $id, //optional
    //       'name' => $facebook_id,
    //       'created' => $expires,
    //   );
    // $query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
    // multiple result              // if ($query->num_rows() > 0) return $query->result()
    // single   result (limit = 1)  // if ($query->num_rows() == 1) return $query->row();
    function get_owner($data=NULL, $limit=NULL, $offset=NULL){
        $query = $this->db->get_where($this->table_name, $data, $limit, $offset);
        $return = array();
        if($query->num_rows() == 0){ // no result
        }else{ // multiple rows
            $return = $query->result_array();
        }
        return $return;
    }


    // Send the data as
    //   $data = array(
    //       'id' => $id, //optional
    //       'name' => $facebook_id,
    //       'created' => $expires,
    //   );
    // @return updated user's id
    //$this->db->update('mytable', $data, array('id' => $id));
    function update_owner($conditions, $new_data){
        return $this->db->update($this->table_name, $new_data, $conditions);
    }

    // Send the data as
    //   $data = array(
    //       'id' => $id, //optional
    //       'name' => $facebook_id,
    //       'created' => $expires,
    //   );
    function delete_owner($data){
        return $this->db->delete($this->table_name, $data); 
    }


    // Send the data as
    //   $data = array(
    //       'id' => $id, //optional
    //       'name' => $facebook_id,
    //       'created' => $expires,
    //   );
    function check_owner_exists($data){
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


/* End of file owners.php */
/* Location: ./application/models/owners.php */