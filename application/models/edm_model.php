<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Edm_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->residency = $this->load->database('residency_db', TRUE);
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
    public function add_new_email($query)
    {
       $this->db->insert('al_new_email', $query);
        return $this->db->insert_id();
    }
    public function get_all_residency_registrartion($id)
    {
        if($id==0)
        $query = $this->residency->get('al_login');
    elseif ($id==1)
    $query = $this->residency->get_where('al_registration',array('status' => 1)); 
    elseif ($id==2)
    $query = $this->residency->query("SELECT * FROM `al_registration` WHERE `status`!=1");
        return $query->result(); 
    }
}