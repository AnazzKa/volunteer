<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acyanotic_heart_disease_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->another = $this->load->database('another_db', TRUE);
    }
    public function get_all($id, $tme) {
        $this->another->from('wp_cf7dbplugin_submits');
        $this->another->where('form_name', "Al Jalila Children's Acyanotic Heart Disease Seminar");
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