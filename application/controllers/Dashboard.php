<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('users_model');
        $this->load->model('dashboard_model');
        $this->load->model('privilege_model');
        $this->check_isvalidated();
    }
    public function index() {
        $data['title'] = "Dashboard";
        $data['msg'] = '';
        $reg_volunteer = "SELECT COUNT(*) as 'count' FROM `al_volunteer`";
        $app_volunteer = "SELECT COUNT(*) as 'count' FROM `al_volunteer` where seleted_or_not=1";
        $active_volunteer = "SELECT COUNT(*) as 'count' FROM `al_volunteer` where seleted_or_not=2";
        $pending_veri = "SELECT COUNT(*) as 'count' FROM `al_appointment`";
        $data['reg_volunteer'] = $this->users_model->get_count($reg_volunteer);
        $data['app_volunteer'] = $this->users_model->get_count($app_volunteer);
        $data['active_volunteer'] = $this->users_model->get_count($active_volunteer);
        $data['appointment_count'] = $this->users_model->get_count($pending_veri);
        $noti = "SELECT * FROM `al_notification` ORDER BY `noti_id` DESC LIMIT 0,1";
        $data['noti'] = $this->users_model->get_count($noti);
        if(isset($_POST['year'])){            
            $year=$data['year']=$_POST['year'];
        }else{
            $data['year']='2018';
            $year=$data['year']=2018;
        }
        $data['reg_bar'] = $this->bar_registerd(2018);
        $data['reg_bar_1'] = $this->bar_registerd(2017);
        $data['app_bar'] = $this->bar_approved(2018);
        $data['app_bar_1'] = $this->bar_approved(2017);
        $data['act_bar'] = $this->bar_active(2018);
        $data['act_bar_1'] = $this->bar_active(2017);
        $data['pen_bar'] = $this->bar_pending(2018);
        $data['pen_bar_1'] = $this->bar_pending(2017);
        $this->load->view('dashboard', $data);
    }
    public function get_chart()
    {
        if(isset($_POST['year']))
        {
            $year=$_POST['year'];
        }else{
            $year=2007;
        }
       $data['reg_bar'] = $this->bar_registerd($year);
        
    }
    public function bar_registerd($y) {
        $r = "";
        for ($i = 1; $i <= 12; $i++) {
            $registerd[] = $this->dashboard_model->get_count_registerd($y, $i);
        }
        foreach ($registerd as $va) {
            $r .= $va[0]->reg . ",";
        }
        $r = rtrim($r, ", ");
        return $r;
    }
    public function bar_approved($y) {
        $r = "";
        for ($i = 1; $i <= 12; $i++) {
            $registerd[] = $this->dashboard_model->get_count_approved($y, $i);
        }
        foreach ($registerd as $va) {
            $r .= $va[0]->reg . ",";
        }
        $r = rtrim($r, ", ");
        return $r;
    }
    public function bar_active($y) {
        $r = "";
        for ($i = 1; $i <= 12; $i++) {
            $registerd[] = $this->dashboard_model->get_count_active($y, $i);
        }
        foreach ($registerd as $va) {
            $r .= $va[0]->reg . ",";
        }
        $r = rtrim($r, ", ");
        return $r;
    }
    public function bar_pending($y) {
        $r = "";
        for ($i = 1; $i <= 12; $i++) {
            $registerd[] = $this->dashboard_model->get_count_approved($y, $i);
        }
        foreach ($registerd as $va) {
            $r .= $va[0]->reg . ",";
        }
        $r = rtrim($r, ", ");
        return $r;
    }
    private function check_isvalidated() {       
       $this->session->userdata('validated');
        if ($this->session->userdata('validated') == '') {
            header('Location:Login');
        }
    }
}
