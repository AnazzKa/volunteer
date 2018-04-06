<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Edm extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
         $this->load->helper('encription');
        $this->load->model('acyanotic_heart_disease_model');
        $this->load->model('privilege_model');
        $this->load->model('users_model');
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
    public function index() {
        $data['msg'] = '';
        $data['title'] = 'Edm';
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' ORDER BY `time` ASC";
        $data['acyanotic_heart_disease'] = $this->acyanotic_heart_disease_model->get_all(0, 0);
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['nationality'] = $this->users_model->get_nationality();  
        $data['contacts'] = $this->contact_model->get_all(0, 0);
         $data['appointment'] = $this->appointment_model->get_all(0, 0); 
         $data['seminar_registration'] = $this->seminar_registration_model->get_all(0, 0);
         $data['epilepsy_masterclass'] = $this->epilepsy_masterclass_model->get_all(0, 0);            
        $this->load->view('edm', $data);
    }
}