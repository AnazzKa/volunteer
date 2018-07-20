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
        $this->load->model('contact_model');
        $this->load->model('appointment_model');
        $this->load->model('seminar_registration_model');
        $this->load->model('epilepsy_masterclass_model');
        $this->load->model('acyanotic_heart_disease_model');
        $this->load->model('edm_model');
        $this->load->model('campaign_model');
        $this->check_isvalidated();
    }
    public function index() {
        $data['title'] = "Dashboard";
        $data['msg'] = '';
$module_id=38;
$user_id=$this->session->userdata('userid');
$dash="SELECT * FROM al_permission p INNER JOIN al_module m ON m.module_id=p.module_id WHERE m.parent_module_id='$module_id' AND p.user_id='$user_id' AND m.sort_order!=1 AND m.sort_order!=2 ORDER BY m.sort_order ASC ";
$dashboard=$this->users_model->get_count($dash);
if($dashboard[0]->module_head=='Volunteer Dashboard'){

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
else if($dashboard[0]->module_head=='EDM Dashboard'){

$data['msg'] = '';
        $data['title'] = 'Edm Dashboard';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' ORDER BY `time` ASC";
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['contacts'] = $this->contact_model->get_all(0, 0);
        $data['appointment'] = $this->appointment_model->get_all(0, 0); 
        $data['seminar_registration'] = $this->seminar_registration_model->get_all(0, 0);
        $data['epilepsy_masterclass'] = $this->epilepsy_masterclass_model->get_all(0, 0); 
        $data['acyanotic_heart_disease'] = $this->acyanotic_heart_disease_model->get_all(0, 0);
        $data['edmlist']=$this->edm_model->get_all(0);
        $data['campaign_cnt'] = $this->campaign_model->get_all();
        $data['total_mail']=$this->users_model->get_volunteer("SELECT COUNT(*) AS 'cnt' FROM `al_campaign_mails` WHERE `eamil_id`!=''");
        $data['rejected']=$this->users_model->get_volunteer("SELECT COUNT(*) AS 'cnt' FROM `al_campaign_mails` WHERE `email`!='' AND `status`!='sent'");
        $data['delivered']=$this->users_model->get_volunteer("SELECT COUNT(*) AS 'cnt' FROM `al_campaign_mails` WHERE `email`!='' AND `status`='sent'");
        $this->load->view('edm_dashboard', $data);

}
else if($dashboard[0]->module_head==''){
$this->load->view('plain_dashboard', $data);
}





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
