<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Campaign extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('encription');
        $this->load->model('acyanotic_heart_disease_model');
        $this->load->model('privilege_model');
        $this->load->model('users_model');
        $this->load->model('campaign_model');
        $this->load->model('contact_model');
        $this->load->model('appointment_model');
        $this->load->model('seminar_registration_model');
        $this->load->model('epilepsy_masterclass_model');
        $this->check_isvalidated();
    }
    private function check_isvalidated() {
        if (!$this->session->userdata('validated')) {
            header('Location:Login');
        }
    }
public function index(){
    $data['msg'] = '';
        $data['title'] = 'Campaign';
         $data['campaign'] = ""; //$this->campaign_model->get_category(); 
     $this->load->view('campaign', $data);
}

}