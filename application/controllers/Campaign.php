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
        date_default_timezone_set('America/Chicago'); // CDT
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

    if($category!='Volunteer' && $category!='Contact'&& $category!='Appointment'&& $category!='SeminarRegistrationEnglish'&& $category!='EpilepsyMasterclass'&& $category!='AcyanoticHeartDisease'  && $type=="edmlist"){
        $data['s_edm_category']=$_POST['type'];
        $data['edmlist']=$this->edm_model->get_all($_POST['category']);
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
    $messsage = "";
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


         //echo "<pre>";print_r($emails);
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
        array('name' =>'msg' ,'content'=>$messsage)
    );
    $email = array(
                    'html' => '<p>Example HTML content</p>', //Consider using a view file
                    'text' => 'This is my plaintext message',
                    'subject' => $subject,
                    'from_email' => 'mail@media.ajch.ae',
                    'from_name' => 'aljalilachildrens',
                    'to' => $emails //Check documentation for more details on this one
                        //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
                );
    $result = $this->mandrill->messages_send_template($temlate_name,$template_content,$email);
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
    $data['sent_cnt']=$this->campaign_model->get_count($id,'sent');
    $data['rej_cnt']=$this->campaign_model->get_count($id,'rejected');
    
    $this->load->view('view_campaign_details', $data);
}
function get_email_open_count()
{
    $id=$_POST['email'];
    // $id='a8460391fc704b82bc0505d53851271a';
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
    }
    echo json_encode($arr);  
}
function get_return_mail()
{
    echo "apro";
}
}