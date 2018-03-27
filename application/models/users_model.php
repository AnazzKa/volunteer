<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_nationality() {
        $query = $this->db->get('nationalities');
        return $query->result();
    }

    public function add($query) {
        $this->db->insert('al_users', $query);
    }

    public function get_users() {
        $query = $this->db->get('al_users');
        return $query->result();
    }

    public function get_volunteer($qry) {
        $query = $this->db->query($qry);
        return $query->result();
    }

    public function get_single_user($id) {
        $query = $this->db->get_where('al_volunteer', array('id' => $id));
        return $query->result();
    }

    public function get_count($qry) {

        $query = $this->db->query($qry);
        return $query->result();
    }

    public function update_profile($query, $id) {
        $this->db->where('id', $id);
        $this->db->update('al_volunteer', $query);
    }

    public function insert_privilage($arr, $id) {
        $this->db->delete('al_permission', array('user_id' => $id));
        $this->db->insert_batch('al_permission', $arr);
    }

    public function update_star_rating($id) {
        
    }

    public function insert_notification($query) {
        $this->db->insert('al_notification', $query);
    }

    public function get_notification() {
        $this->db->from('al_notification');
        $this->db->order_by("noti_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_users($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('al_users');
    }
    public function get_comments($id)
    {
        $this->db->from('al_comments');
        $this->db->where('volunteer_id', $id);
        $this->db->order_by('comments_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_single_users($id)
    {
         $query = $this->db->get_where('al_users', array('user_id' => $id));
        return $query->result();
    }
    public function insert_comments($query)
    {
        $this->db->insert('al_comments', $query);
    }
}
