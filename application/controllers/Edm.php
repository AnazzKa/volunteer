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
        $this->load->model('edm_model');
        $this->load->model('contact_model');
        $this->load->model('campaign_model');
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
        $data['s_type'] = '';
        $data['s_category'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        $data['s_edm_category']='';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' ORDER BY `time` ASC";
        $type="";
        $category="";
        $edm_category="";
        if (isset($_POST['type'])) {
            $data['s_type'] =$type=$_POST['type'];
            $data['s_category']= $category=$_POST['category'];
           //$data['s_edm_category']=$edm_category= $_POST['edm_category'];
        }
        if(($type=='Volunteer' || $type=="") && ($category=="General" || $category=="")  )
            $data['volunteer'] = $this->users_model->get_volunteer($query);
        else
            $data['volunteer']="";

        if(($type=='Contact' || $type=="") && ($category=="General" || $category=="") )
            $data['contacts'] = $this->contact_model->get_all(0, 0);
        else
            $data['contacts']="";

        if(($type=='Appointment' || $type=="") && ($category=="General" || $category=="")  )
            $data['appointment'] = $this->appointment_model->get_all(0, 0); 
        else
            $data['appointment']="";

        if(($type=='SeminarRegistrationEnglish' || $type=="") && ($category=="General" || $category=="") )
            $data['seminar_registration'] = $this->seminar_registration_model->get_all(0, 0);
        else
            $data['seminar_registration']="";

        if(($type=='EpilepsyMasterclass' || $type=="") && ($category=="General" || $category=="")  )
            $data['epilepsy_masterclass'] = $this->epilepsy_masterclass_model->get_all(0, 0);   
        else
            $data['epilepsy_masterclass']="";

        if(($type=='AcyanoticHeartDisease' || $type=="") && ($category=="General" || $category=="") )
            $data['acyanotic_heart_disease'] = $this->acyanotic_heart_disease_model->get_all(0, 0); 
        else
            $data['acyanotic_heart_disease']="";
        if($category=="edmlist" || $type=="")
            $data['edmlist']=$this->edm_model->get_all(0);
        else
            $data['edmlist']="";

        if($type!='Volunteer' && $type!='Contact'&& $type!='Appointment'&& $type!='SeminarRegistrationEnglish'&& $type!='EpilepsyMasterclass'&& $type!='AcyanoticHeartDisease'  && $category=="edmlist"){
            $data['s_edm_category']=$_POST['type'];
            $data['edmlist']=$this->edm_model->get_all($_POST['type']);
        }
        $data['category'] = $this->edm_model->get_category();           
        $data['nationality'] = $this->users_model->get_nationality();
        $data['campaign_cnt'] = $this->campaign_model->get_all();
        $this->load->view('edm_new', $data);
    }
    public function edm_dashboard()
    {
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
        $data['rejected']=$this->users_model->get_volunteer("SELECT COUNT(*) AS 'cnt' FROM `al_campaign_mails` WHERE `email`!='' AND `status`='rejected'");
        $data['delivered']=$this->users_model->get_volunteer("SELECT COUNT(*) AS 'cnt' FROM `al_campaign_mails` WHERE `email`!='' AND `status`='sent'");
        $this->load->view('edm_dashboard', $data);
    }
    public function edm_add_contact()
    {
        $data['msg'] = '';
        $data['title'] = 'EDM Contact';
        if(isset($_POST['save'])){

            $cpt = count($_POST['F_Name']);
            for ($i = 0; $i < $cpt; $i++) {
                $arr[] =array(
                    'entry_time' => date('Y-m-d H:i:s'),
                    'full_name' => $this->input->post('F_Name')[$i],                    
                    'gender' => $this->input->post('edm_gender')[$i],                    
                    'Nationality' => $this->input->post('Nationality')[$i],                    
                    'phone' => $this->input->post('phone')[$i],
                    'email' => $this->input->post('email')[$i],
                    'category_id' => $this->input->post('category_name')
                );
            }
            
            $result = $this->edm_model->add($arr);
            if (!$result) {
                $data['msg'] = 'Data Saved Sucessfully';
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        $data['category'] = $this->edm_model->get_category();
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('edm_add_contact_new', $data);
    }
    public function edm_mail_send()
    {   //echo $_POST['emails'];
    $arr= explode(",",$_POST['emails']);
         //echo count($arr);
    $emails=array();
    foreach ($arr as $s) {
     $emails[]= array( "email" => "$s");
 }
        // echo "<pre>";print_r($emails);
         // echo "<pre>";print_r($arr);
 $subject = $_POST['subject'];
 $messsage = $_POST['messageinput'];
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
    $temlate_name='firsttemplate';
    $template_content=array(
        array('name' =>'sub' ,'content'=>$subject),
        array('name' =>'msg' ,'content'=>$messsage)
    );
    $email = array(
                    'html' => '<p>Example HTML content</p>', //Consider using a view file
                    'text' => 'This is my plaintext message',
                    'subject' => $subject,
                    'from_email' => 'mail@media.ajch.ae',
                    'from_name' => 'Contact Form',
                    'to' => $emails //Check documentation for more details on this one
                        //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
                );
    //$result = $this->mandrill->messages_send_template($temlate_name,$template_content,$email);
}
//echo "<pre>";print_r($result);
$msg="Mail Send Sucessfully";
$this->session->set_flashdata('messsage', $msg);
redirect($_SERVER['HTTP_REFERER']);   
}

public function edm_add_category()
{
    $cat=$_POST['cat'];
    $des=$_POST['des'];
    $query = array(
        'category_name' => $cat,
        'description' => $des
    );
    $result = $this->edm_model->add_category($query);


    $variable = $this->edm_model->get_category();   
    $res="<option value=''>Category</option>";    
    foreach ($variable as $value) {
       $res.="<option value='".$value->category_id."'>".$value->category_name."</option>";
   }
   echo $res;

}
public function get_category_options()
{
    $res="<option value=''>Category</option>"; 
    if($_POST['id']=='edmlist' || $_POST['id']=='')
    {
      $variable = $this->edm_model->get_category();   
      foreach ($variable as $value) {
       $res.="<option value='".$value->category_id."'>".$value->category_name."</option>";
   }

}
if($_POST['id']=='General' || $_POST['id']=='')
{
    $res.="<option value='Volunteer'>Volunteer</option><option  value='Contact'>Contact</option><option  value='Appointment'>Appointment</option><option  value='SeminarRegistrationEnglish'>Seminar Registration English</option><option  value='EpilepsyMasterclass'>Epilepsy Masterclass</option><option  value='AcyanoticHeartDisease'>Acyanotic Heart Disease</option>";
}
echo $res;
}

public function get_all_edm_data()
{
    $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' ORDER BY `time` ASC ";
    $category=$_POST['cat'];
    $type=$_POST['type'];
    // $category='General';
    // $type='Contact'; 
    $full_arr= array();
    $cnt = 0;
    if(($type=='Volunteer' || $type=="") && ($category=="General" || $category=="")  ){
        $volunteer = $this->users_model->get_volunteer($query);
        foreach ($volunteer as $key) {
            $cnt++;
            // $arr1[]=array(
            array_push($full_arr,array(
                $cnt,
                $key->firstname,
                $key->gender,
                $key->nationality,
                $key->phone,
                $key->email
            )
        );
        }
    }
    else{
        //$arr1[]=array();
    }

    if(($type=='Contact' || $type=="") && ($category=="General" || $category=="") )
    {

        $contacts = $this->contact_model->get_all(0, 0);
        foreach ($contacts as $key) {
         $cnt++;
         $tme = $key->submit_time;
         $contacts_ne = $this->contact_model->get_all(1, $tme);
          //echo "<pre>";print_r($contacts);

         foreach ($contacts_ne as $row) {
            if ($row->field_name == 'contact_first_name')
                $full_name=$row->field_value;

            $gender='';
            $Nationality='';

            if ($row->field_name == 'contact_us_mobile')
                $phone=$row->field_value;

            if ($row->field_name == 'contact_us_email')
                $email=$row->field_value;
        }


        // $arr3[]=array(
        array_push($full_arr,array(
            $cnt, 
            $full_name,
            $gender,
            $Nationality,
            $phone,
            $email
        )
    ); 
    }

}
else{
 // $arr3[]=array();
}

if(($type=='Appointment' || $type=="") && ($category=="General" || $category=="")  ){
    $appointment = $this->appointment_model->get_all(0, 0); 

    foreach ($appointment as $key) {
     $cnt++;
     $tme = $key->submit_time;
     $appointment_ne = $this->appointment_model->get_all(1, $tme);
     foreach ($appointment_ne as $row) {
        if ($row->field_name == 'firstname')
            $full_name=$row->field_value;

        $gender='';
        $Nationality='';

        if ($row->field_name == 'phonenumber')
            $phone=$row->field_value;

        if ($row->field_name == 'contact_emailaddress')
            $email=$row->field_value;
    }


    // $arr4[]=array(
    array_push($full_arr,array(
        $cnt, 
        $full_name,
        $gender,
        $Nationality,
        $phone,
        $email
    )
); 
}
}
else{
    // $arr4[]=array();
}

if(($type=='SeminarRegistrationEnglish' || $type=="") && ($category=="General" || $category=="") ){
    $seminar_registration= $this->seminar_registration_model->get_all(0, 0);
    foreach ($seminar_registration as $key) {
     $cnt++;
     $tme = $key->submit_time;
     $seminar_registration_ne = $this->seminar_registration_model->get_all(1, $tme);
     foreach ($seminar_registration_ne as $row) {
        if ($row->field_name == 'fullname')
            $full_name=$row->field_value;

        $gender='';
        $Nationality='';

        if ($row->field_name == 'phonenumber')
            $phone=$row->field_value;

        if ($row->field_name == 'emailaddress')
            $email=$row->field_value;
    }


    // $arr5[]=array(
    array_push($full_arr,array(
        $cnt, 
        $full_name,
        $gender,
        $Nationality,
        $phone,
        $email
    )
); 
}
}
else{
   // $arr5[]=array();
}

if(($type=='EpilepsyMasterclass' || $type=="") && ($category=="General" || $category=="")  ){
    $epilepsy_masterclass = $this->epilepsy_masterclass_model->get_all(0, 0); 
    foreach ($epilepsy_masterclass as $key) {
     $cnt++;
     $tme = $key->submit_time;
     $epilepsy_masterclass_ne = $this->epilepsy_masterclass_model->get_all(1, $tme);
     foreach ($epilepsy_masterclass_ne as $row) {
        if ($row->field_name == 'fullname')
            $full_name=$row->field_value;

        $gender='';
        $Nationality='';

        if ($row->field_name == 'phonenumber')
            $phone=$row->field_value;

        if ($row->field_name == 'emailaddress')
            $email=$row->field_value;
    }


    // $arr6[]=array(
    array_push($full_arr,array(
        $cnt, 
        $full_name,
        $gender,
        $Nationality,
        $phone,
        $email
    )
); 
}  
}
else{
   // $arr6[]=array();
}

if(($type=='AcyanoticHeartDisease' || $type=="") && ($category=="General" || $category=="") ){
    $acyanotic_heart_disease = $this->acyanotic_heart_disease_model->get_all(0, 0); 
    foreach ($acyanotic_heart_disease as $key) {
     $cnt++;
     $tme = $key->submit_time;
     $acyanotic_heart_disease_ne = $this->acyanotic_heart_disease_model->get_all(1, $tme);
     foreach ($acyanotic_heart_disease_ne as $row) {
        if ($row->field_name == 'fullname')
            $full_name=$row->field_value;

        $gender='';
        $Nationality='';

        if ($row->field_name == 'phonenumber')
            $phone=$row->field_value;

        if ($row->field_name == 'emailaddress')
            $email=$row->field_value;
    }


    // $arr7[]=array(
    array_push($full_arr,array(
        $cnt, 
        $full_name,
        $gender,
        $Nationality,
        $phone,
        $email
    )
); 
}
}
else{
    // $arr7[]=array();
}

// if($category=="edmlist" || $type==""){
//     $edmlist=$this->edm_model->get_all(0);

//     foreach ($edmlist as $key) {
//        $cnt++;
//  // $arr2[]=array(
//        array_push($full_arr,array(
//         $cnt, 
//         $key->full_name,
//         $key->gender,
//         $key->Nationality,
//         $key->phone,
//         $key->email
//     )
//    ); 
//    }
// }
// else{
//  // $arr2[]=array();
// }

if($type!='Volunteer' && $type!='Contact'&& $type!='Appointment'&& $type!='SeminarRegistrationEnglish'&& $type!='EpilepsyMasterclass'&& $type!='AcyanoticHeartDisease'  && $category=="edmlist"){
    if($_POST['type']!=0)
        $edmlist=$this->edm_model->get_all($_POST['type']);
    else
        $edmlist=$this->edm_model->get_all(0);

    foreach ($edmlist as $key) {
     $cnt++;
     // $arr2[]=array(
     array_push($full_arr,array(
        $cnt, 
        $key->full_name,
        $key->gender,
        $key->Nationality,
        $key->phone,
        $key->email
    )
 ); 
 }
}
echo json_encode($full_arr);
}
public function import_excel_edm_contact()
{
   //error_reporting(E_ALL);
 //ini_set('display_errors', TRUE);
 //ini_set('display_startup_errors', TRUE);

    $category=$_POST['export_category_name'];
    $query = array(
        'category_name' => $category,
        'description' => ''
    );
    $result = $this->edm_model->add_category($query);
    $this->load->library('excel');
    //Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)    
    $configUpload['upload_path'] = FCPATH.'uploads/excel/';
    $configUpload['allowed_types'] = '*';
    $configUpload['max_size'] = '5000';
    $this->load->library('upload', $configUpload);
    $this->upload->do_upload('export_excel_file');  
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
         $extension=$upload_data['file_ext'];    // uploded file extension
         PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
         $inputFileType = PHPExcel_IOFactory::identify(FCPATH.'uploads/excel/'.$file_name);
         $objReader =PHPExcel_IOFactory::createReader($inputFileType); 
          //Set to read only
         $objReader->setReadDataOnly(true);          
         //Load excel file
         $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);      
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
         for($i=2;$i<=$totalrows;$i++)
         {
             $FirstName= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();           
             $Email= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
             $Mobile= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
             $data_user[]=array('entry_time' => date('Y-m-d H:i:s'),'full_name'=>$FirstName ,'email'=>$Email ,'phone'=>$Mobile , 'category_id'=>$result);
          }
              $result = $this->edm_model->add($data_user);
             //unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .       
             redirect($base_url. "edm_add_contact");
      }
  }
