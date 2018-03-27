<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->another = $this->load->database('another_db', TRUE);
    }

    public function get_all($id, $tme) {
//        $this->db->from('contacts');
//        $this->db->order_by("name", "desc");
        $this->another->from('wp_cf7dbplugin_submits');
        $this->another->where('form_name', 'Contact Us');
        if ($id == 0) {
            $this->another->where('field_order', 0);
            $this->another->order_by('submit_time', "Asc");
        } else {
            $this->another->where('submit_time', $tme);
            $this->another->order_by('field_order', "Asc");
        }

        $query = $this->another->get();
        return $query->result();
    }

}
