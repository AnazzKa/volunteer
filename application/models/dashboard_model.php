<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_count_registerd($y,$m) {
        $qry = "SELECT COUNT(*) as 'reg' FROM `al_volunteer` WHERE `time` BETWEEN '$y-$m-01' AND '$y-$m-31'";
        $query = $this->db->query($qry);
        return $query->result();
    }
    public function get_count_approved($y,$m) {
        $qry = "SELECT COUNT(*) as 'reg' FROM `al_volunteer` WHERE `seleted_or_not`=1 and(`time` BETWEEN '$y-$m-01' AND '$y-$m-31')";
        $query = $this->db->query($qry);
        return $query->result();
    }
    public function get_count_active($y,$m) {
        $qry = "SELECT COUNT(*) as 'reg' FROM `al_volunteer` WHERE `seleted_or_not`=2 and(`time` BETWEEN '$y-$m-01' AND '$y-$m-31')";
        $query = $this->db->query($qry);
        return $query->result();
    }
    public function get_count_pending($y,$m) {
        $qry = "SELECT COUNT(*) as 'reg' FROM `al_volunteer` WHERE `seleted_or_not`=3 and(`time` BETWEEN '$y-$m-01' AND '$y-$m-31')";
        $query = $this->db->query($qry);
        return $query->result();
    }

}
