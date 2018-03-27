<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('appointment_model');
        $this->load->model('privilege_model');
        $this->load->model('users_model');
        $this->check_isvalidated();
    }
     private function check_isvalidated() {
        if (!$this->session->userdata('validated')) {
            header('Location:Login');
        }
    }
    public function index() {
        $data['msg'] = '';
        $data['title'] = 'Appointment';
        $data['s_gender']='';
        $data['s_nationality']='';
        $data['s_superpower']='';
        $data['s_name_phone']='';
        $data['s_sort']='ASC';
        $data['f_date']='';
        $data['t_date']='';
        $data['appointment'] = $this->appointment_model->get_all(0,0);
//        echo "<pre>";
//        print_r($data);
//        exit;
//        $this->load->view('appointment_list', $data);
        $this->load->view('appointment_list_new', $data);
    }
}
