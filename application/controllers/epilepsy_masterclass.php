<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Epilepsy_masterclass extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('epilepsy_masterclass_model');
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
        $data['title'] = 'Epilepsy Masterclass Registration';
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        $data['epilepsy_masterclass'] = $this->epilepsy_masterclass_model->get_all(0, 0);
        
        $this->load->view('epilepsy_masterclass', $data);
    }
}