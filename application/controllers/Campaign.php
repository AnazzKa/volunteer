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
        $this->load->model('edm_model');
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
        $data['campaign'] = $this->campaign_model->get_all(); 
        $this->load->view('campaign', $data);
    }
    public function add_campaign()
    {
        $data['msg'] = '';
        $data['s_type'] = '';
        $data['s_category'] = '';
        $data['s_edm_category']='';
        $data['title'] = 'Campaign';
        $data['campaign'] = $this->campaign_model->get_all(); 
        $data['category'] = $this->edm_model->get_category(); 
        $this->load->view('add_campaign', $data);
    }
    public function next_add_capmaign()
    {
       $data['msg'] = '';
       $data['title'] = 'Campaign';
       $type='';
       $category='';
       $query='';
       if(isset($_POST['next']))
       {
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' ORDER BY `time` ASC";
        $type=$_POST['type'];
        $category=$_POST['category'];
        $campaign_name=$_POST['campaign_name'];
        $decription=$_POST['decription'];
        date_default_timezone_set('Asia/Dubai'); // CDT
        $current_date = date('Y/m/d H:i:s');
        $arr =array(
            'time' => $current_date,
            'campaign_name' => $campaign_name,                    
            'description' => $decription,                    
            'type' => $type,                    
            'category_id' => $category,
        );
        $data['last_id'] = $this->campaign_model->add($arr);
    }
    if(($category=='Volunteer' && $type=="General" ))
        $data['volunteer'] = $this->users_model->get_volunteer($query);
    else
        $data['volunteer']="";

    if($category=='Contact' && $type=="General")
        $data['contacts'] = $this->contact_model->get_all(0, 0);
    else
        $data['contacts']="";

    if($category=='Appointment' && $type=="General")
        $data['appointment'] = $this->appointment_model->get_all(0, 0); 
    else
        $data['appointment']="";

    if($category=='SeminarRegistrationEnglish' && $type=="General" )
        $data['seminar_registration'] = $this->seminar_registration_model->get_all(0, 0);
    else
        $data['seminar_registration']="";

    if($category=='EpilepsyMasterclass' && $type=="General" )
        $data['epilepsy_masterclass'] = $this->epilepsy_masterclass_model->get_all(0, 0);   
    else
        $data['epilepsy_masterclass']="";

    if($category=='AcyanoticHeartDisease' && $type=="General" )
        $data['acyanotic_heart_disease'] = $this->acyanotic_heart_disease_model->get_all(0, 0); 
    else
        $data['acyanotic_heart_disease']="";

    if($type=="edmlist" && $category=="")
        $data['edmlist']=$this->edm_model->get_all(0);
    else
        $data['edmlist']="";

$data['sub_category']="";
$data['sub_category_new']="";

    if($category!='Volunteer' && $category!='Contact'&& $category!='Appointment'&& $category!='SeminarRegistrationEnglish'&& $category!='EpilepsyMasterclass'&& $category!='AcyanoticHeartDisease'  && $type=="edmlist"){
        if($_POST['category']!=64){
        $data['s_edm_category']=$_POST['type'];
        $data['edmlist']=$this->edm_model->get_all($_POST['category']);
         }else{
            $sub_category=$_POST['sub_category'];
            if($sub_category==1)
                $data['sub_category']=$this->edm_model->get_all_residency_registrartion(0);
            elseif ($sub_category==2)
                $data['sub_category_new']=$this->edm_model->get_all_residency_registrartion(2);
            elseif ($sub_category==3)
                $data['sub_category_new']=$this->edm_model->get_all_residency_registrartion(1);

     }
    }
    $this->load->view('next_add_campaign', $data);
}
public function campaign_mail_send()
{
   $tem = $_POST['Templates'];

   if(!empty($tem))
   {
    $Templates=$tem;
    $subject = $_POST['subject'];
    $messsage = $_POST['messageinput'];
}
else
{
    $Templates='normal';
    $subject = $_POST['subject'];
    $messsage = $_POST['messageinput'];
}
    //echo $_POST['emails'];
$arr= explode(",",$_POST['emails']);
    //echo count($arr);
$emails=array();
foreach ($arr as $s) {
    if(!empty($s)){
       $emails[]= array( "email" => "$s");
    //    $qry[]=array(
    //     'email'=>$s,
    //     'campaign_id'=>$_POST['last_id']
    // );
   }
}


     //     echo "<pre>";print_r($emails);
     // echo "<pre>";print_r($arr);

$this->load->config('mandrill');
$this->load->library('mandrill');
$mandrill_ready = NULL;
try {
    $this->mandrill->init($this->config->item('mandrill_api_key'));
    $mandrill_ready = TRUE;
} catch (Mandrill_Exception $e) {
    $mandrill_ready = FALSE;
}

if ($mandrill_ready) {
    $temlate_name=$Templates; 
    $template_content=array(
        array('name' =>'sub' ,'content'=>$subject),
        array('name' =>'body' ,'content'=>$messsage)
    );
    $email = array(
                    'html' => '<p>Example HTML content</p>', //Consider using a view file
                    'text' => 'This is my plaintext message',
                    'subject' => $subject,
                    'from_email' => 'noreply@media.ajch.ae',
                    'from_name' => "Al Jalila Children's Paediatric Residency Programme",
                    'to' => $emails //Check documentation for more details on this one
                        //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
                );
//      echo $temlate_name;
//      echo "<pre>";
//      print_r($template_content);
//      print_r($email);
// exit; 
    $result = $this->mandrill->messages_send_template($temlate_name,$template_content,$email);
    // print_r($result);
    // exit; 
}
foreach ($result as $arr) {

    $qry[]=array(
        'email'=>$arr['email'],
        'status'=>$arr['status'],
        'eamil_id'=>$arr['_id'],
        'campaign_id'=>$_POST['last_id']
    );
}
$this->campaign_model->add_mail_details($qry);
$msg="Mail Send Sucessfully";
$this->session->set_flashdata('messsage', $msg);
 redirect('campaign');

}

public function view_campaign_details()
{
    $data['msg'] = '';
    $data['title'] = 'Campaign';
    $str = $_REQUEST['camp'];
    $id = my_simple_crypt($str, 'd');
    $data['campaign'] = $this->campaign_model->get_single($id);
    $data['mails'] = $this->campaign_model->get_mails($id);
    $data['delivary_cnt']=$this->campaign_model->get_count($id,'sent');
    $data['rejected_cnt']=$this->campaign_model->get_count($id,'rejected');
    $data['bounced_cnt']=$this->campaign_model->get_count($id,'bounced');
    $data['soft_bounced_cnt']=$this->campaign_model->get_count($id,'soft-bounc');
    $data['queued_cnt']=$this->campaign_model->get_count($id,'queued');
    $data['open_cnt']=$this->campaign_model->get_direct_query("SELECT count(*) as 'cnt' FROM `al_campaign_mails` WHERE `campaign_id`=".$id." and `open_cnt`!=0");
    $data['click_cnt']=$this->campaign_model->get_direct_query("SELECT count(*) as 'cnt' FROM `al_campaign_mails` WHERE `campaign_id`=".$id." and `click_cnt`!=0");

    $this->load->view('view_campaign_details', $data);
}
function get_email_open_count()
{
    $id=$_POST['email'];
    //$id='624dc5bc777240bcba8be10712b1ed8c';
    $this->load->config('mandrill');
    $this->load->library('mandrill');
    $mandrill_ready = NULL;
    try {
        $this->mandrill->init($this->config->item('mandrill_api_key'));
        $mandrill_ready = TRUE;
    } catch (Mandrill_Exception $e) {
        $mandrill_ready = FALSE;
    }
    if ($mandrill_ready) {        
        $arr=$this->mandrill->info($id);
        $qry=array(
        'status'=>$arr['state'],
        'open_cnt'=>$arr['opens'],
        'click_cnt'=>$arr['clicks'],
        'modify_date'=>date('Y-m-d h:m:s')
    );
        $this->campaign_model->update_mailing_details($qry,$id); 
    }
    echo json_encode($arr);  
}
public function campaign_emails_data()
{
     //$id=$_POST['campaign'];
    $id='aDdWTnJvRndXQWZXaEltTXBWQmlUZz09';
    $ids = my_simple_crypt($id, 'd');
    $data['mails'] = $this->campaign_model->get_mails($ids);
    $this->load->config('mandrill');
    $this->load->library('mandrill');
    $mandrill_ready = NULL;
    try {
        $this->mandrill->init($this->config->item('mandrill_api_key'));
        $mandrill_ready = TRUE;
    } catch (Mandrill_Exception $e) {
        $mandrill_ready = FALSE;
    }
    $val = array();
    foreach ($data['mails'] as $key) {
        if ($mandrill_ready) {     
        $arr=$this->mandrill->info($key->eamil_id);
        $qry=array(
        'status'=>$arr['state'],
        'open_cnt'=>$arr['opens'],
        'click_cnt'=>$arr['clicks'],
        'modify_date'=>date('Y-m-d h:m:s')
    );
        if($arr['opens_detail']){
        foreach ($arr['opens_detail'] as $keys) {
            if($keys['ts'])
                $ts=$keys['ts'];
            else
                $ts='';
            if($keys['ip'])
                $ip=$keys['ip'];
            else
                $ip='';
            if($keys['location'])
                $location=$keys['location'];
            else
                $location='';
            if($keys['ua'])
                $ua=$keys['ua'];
            else
                $ua='';
        array_push($val,array(
            'ts' => $ts,
            'ip' => $ip,
            'location' => $location,
            'ua' => $ua,
            'email_id' => $key->eamil_id,
            'modify_date' => date('Y-m-d h:m:s'),
            'click_open' =>1
        )
         );
    }
}
if($arr['clicks_detail']){
        foreach ($arr['clicks_detail'] as $keye) {
            if($keye['ts'])
                $ts=$keye['ts'];
            else
                $ts='';
            if($keye['url'])
                $url=$keye['url'];
            else
                $url='';
            if($keye['ip'])
                $ip=$keye['ip'];
            else
                $ip='';
            if($keye['location'])
                $location=$keye['location'];
            else
                $location='';
            if($keye['ua'])
                $ua=$keye['ua'];
            else
                $ua='';if($keye['ua'])
                $ua=$keye['ua'];
            else
                $ua='';
        array_push($val,array(
            'ts' => $ts,
            'url' => $url,
            'ip' => $ip,
            'location' => $location,
            'ua' => $ua,
            'email_id' => $eamil_id,
            'modify_date' => date('Y-m-d h:m:s'),
            'click_open' =>2
        )
         );
    }
}
        //$this->campaign_model->update_mailing_details($qry,$key->eamil_id);
    }

    
    }
       echo "<pre>";
        print_r($val);     
}
function get_return_mail()
{
    echo "apro";
}
}