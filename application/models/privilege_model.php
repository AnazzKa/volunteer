<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Privilege_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    public function get_result($qry)
    {
        $query = $this->db->query($qry);
        return $query->result();
    }
    public function get_parent_modules()
    {
        $query = $this->db->get_where('al_module', array('parent_module_id' => 0));
        return $query->result();
    }
    public function insert_modules($qry)
    {
        $this->db->insert('al_module', $qry);
    }
    public function get_module($id)
    {
        if($id!=0)
        $query = $this->db->get_where('al_module', array('module_id' => $id));
        else
            $query = $this->db->get('al_module');
        return $query->result();
    }
}
