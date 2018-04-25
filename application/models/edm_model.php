<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Edm_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
public function add($query) {
        $this->db->insert_batch('al_edm_contact', $query);
    }
    public function get_all($id)
    {if($id==0)
    	$query = $this->db->get('al_edm_contact');
        else
            $query = $this->db->get_where('al_edm_contact',array('category_id' => $id));
        return $query->result();
    }
    public function get_category()
    {
      $query = $this->db->get('al_category');
        return $query->result();  
    }
    public function add_category($query){
        $this->db->insert('al_category', $query);
        return $this->db->insert_id();
    }
}