<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campaign_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    public function get_all()
    {
    	$query = $this->db->get('al_campaign');
        return $query->result();
    }
    public function add($query) {
        $this->db->insert('al_campaign', $query);
        return $this->db->insert_id();
    }
    public function add_mail_details($qry)
    {
        $this->db->insert_batch('al_campaign_mails', $qry);
    }
    public function get_single($id)
    {
        $query = $this->db->get_where('al_campaign', array('campaignid' => $id ));
        return $query->result();
    }
    public function get_mails($id)
    {
        $query = $this->db->get_where('al_campaign_mails',array('campaign_id' => $id ));
        return $query->result();
    }
}