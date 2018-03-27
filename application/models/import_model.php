<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends CI_Model {

    private $another;

    function __construct() {
        parent::__construct();
        $this->another = $this->load->database('another_db', TRUE);
    }

    public function import_data_base($db_o,$db_t,$pri) {
        $query = $this->another->get($db_o);
        foreach ($query->result() as $row) {
            $id = $row->id;
            $ch = $this->db->get_where($db_t, array($pri => $id));
            $count = $ch->num_rows();
            if ($count === 0) {
                $this->db->insert($db_t, $row);
            } else {
                $this->db->where($pri, $id);
                $this->db->update($db_t, $row);
            }
        }        
    }

}
