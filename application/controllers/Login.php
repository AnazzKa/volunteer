<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');                
    }
    public function index() {
        $data['msg'] = '';
        $this->load->view('login', $data);
    }
    public function process() {
        $this->load->model('login_model');
        $result = $this->login_model->validate();
        if (!$result) {
            $data['msg'] = '<font color=red>Invalid username and/or password.</font><br />';
            $this->load->view('login', $data);
        } else {
            if ($this->session->userdata('user_cat') == 1)
                header('Location:dashboard');
            if ($this->session->userdata('user_cat') == 0)
                header('Location:dashboard');
        }
    }
    public function do_logout() {
        $this->session->unset_userdata('userid');        
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('volunteer_id');
        $this->session->unset_userdata('user_cat');
        $this->session->unset_userdata('validated');
        $this->session->sess_destroy();
        $this->session->userdata('validated');
        redirect('Login', 'refresh');
    }
}
