<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('encription');
        $this->load->model('users_model');
        $this->load->model('privilege_model');
        $this->check_isvalidated();
    }
    private function check_isvalidated() {
        if (!$this->session->userdata('validated')) {
            header('Location:Login');
        }
    }
    public function index() {
        $data['msg'] = '';
        $data['title'] = 'Users';
        if (isset($_POST['save'])) {
           
            $password = $this->input->post('password');
            $encr_password = md5($password);            
                $query = array(
                    'time' => date('Y-m-d H:i:s'),
                    'firstname' => $this->input->post('F_Name'),                    
                    'email' => $this->input->post('email'),                    
                    'password' => $encr_password,                    
                    'designation_id' => 0,
                    'activated' => 1,
                    'creatd_user_id' => $this->session->userdata('userid')
                );
                $result = $this->users_model->add($query);
                if (!$result) {
                    $data['msg'] = 'Data Saved Sucessfully';
                } else {
                    $data['msg'] = 'Insertion Error';
                }
            } 
        
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('user_add', $data);
    }
    private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|PNG';
        $config['max_size'] = '45058';
        $config['overwrite'] = FALSE;
        return $config;
    }
    public function view() {

        $data['msg'] = '';
        $data['title'] = 'Users';
        $data['users'] = $this->users_model->get_users();
        $this->load->view('user_view', $data);
    }
    public function volunteer_view() {

        $data['msg'] = '';
        $data['status'] = 0;
        $data['title'] = 'Volunteer';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!=''";
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        if (isset($_POST)) {
            $data['s_gender'] = $gender = $this->input->post('gender');
            $data['s_nationality'] = $nationality = $this->input->post('nationality');
            $data['s_superpower'] = $super_power = $this->input->post('super_power');
            $data['s_name_phone'] = $name_phone = $this->input->post('name_phone');
            $data['s_sort'] = $sort = $this->input->post('sort');
            $data['f_date'] = $f_date = $this->input->post('f_date');
            $data['t_date'] = $t_date = $this->input->post('t_date');
            if ($gender != "") {
                $query .= " and gender='" . $gender . "'";
            }
            if ($nationality != "") {
                $query .= " and nationality='" . $nationality . "'";
            }
            if ($super_power != "") {
                $query .= " and superpower='" . $super_power . "'";
            }
            if ($name_phone != "") {
                $query .= " and (firstname LIKE '%" . $name_phone . "%' or phone LIKE '%" . $name_phone . "%')";
            }

            if ($f_date != "" && $t_date == "")
                $query .= " and `time`='$f_date'";
            if ($f_date != "" && $t_date != "")
                $query .= " and (`time` BETWEEN  '$f_date' and '$t_date') ";
            if ($sort != '') {
                $query .= " ORDER BY `time` $sort";
                if ($sort == 'ASC')
                    $data['s_sort'] = 'DESC';
                else
                    $data['s_sort'] = 'ASC';
            }
        }
        $data['status']=0;
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('volunteer_view_new', $data);
    }
    public function selected_volunteers() {

        $data['msg'] = '';
        $data['status'] = 1;
        $data['title'] = 'Volunteer';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not=1 ";
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        if (isset($_POST)) {
            $data['s_gender'] = $gender = $this->input->post('gender');
            $data['s_nationality'] = $nationality = $this->input->post('nationality');
            $data['s_superpower'] = $super_power = $this->input->post('super_power');
            $data['s_name_phone'] = $name_phone = $this->input->post('name_phone');
            $data['s_sort'] = $sort = $this->input->post('sort');
            $data['f_date'] = $f_date = $this->input->post('f_date');
            $data['t_date'] = $t_date = $this->input->post('t_date');
            if ($gender != "") {
                $query .= " and gender='" . $gender . "'";
            }
            if ($nationality != "") {
                $query .= " and nationality='" . $nationality . "'";
            }
            if ($super_power != "") {
                $query .= " and superpower='" . $super_power . "'";
            }
            if ($name_phone != "") {
                $query .= " and (firstname LIKE '%" . $name_phone . "%' or phone LIKE '%" . $name_phone . "%')";
            }
            if ($f_date != "" && $t_date == "")
                $query .= " and `time`='$f_date'";
            if ($f_date != "" && $t_date != "")
                $query .= " and (`time` BETWEEN  '$f_date' and '$t_date') ";
            if ($sort != '') {
                $query .= " ORDER BY `time` $sort";
                if ($sort == 'ASC')
                    $data['s_sort'] = 'DESC';
                else
                    $data['s_sort'] = 'ASC';
            }
        }
        $data['status']=1;
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('volunteer_view', $data);
    }
    public function clearance_volunteers() {
        $data['msg'] = '';
        $data['status'] = 2;
        $data['title'] = 'Volunteer';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not=2 ";
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        if (isset($_POST)) {
            $data['s_gender'] = $gender = $this->input->post('gender');
            $data['s_nationality'] = $nationality = $this->input->post('nationality');
            $data['s_superpower'] = $super_power = $this->input->post('super_power');
            $data['s_name_phone'] = $name_phone = $this->input->post('name_phone');
            $data['s_sort'] = $sort = $this->input->post('sort');
            $data['f_date'] = $f_date = $this->input->post('f_date');
            $data['t_date'] = $t_date = $this->input->post('t_date');
            if ($gender != "") {
                $query .= " and gender='" . $gender . "'";
            }
            if ($nationality != "") {
                $query .= " and nationality='" . $nationality . "'";
            }
            if ($super_power != "") {
                $query .= " and superpower='" . $super_power . "'";
            }
            if ($name_phone != "") {
                $query .= " and (firstname LIKE '%" . $name_phone . "%' or phone LIKE '%" . $name_phone . "%')";
            }
            if ($f_date != "" && $t_date == "")
                $query .= " and `time`='$f_date'";
            if ($f_date != "" && $t_date != "")
                $query .= " and (`time` BETWEEN  '$f_date' and '$t_date') ";
            if ($sort != '') {
                $query .= " ORDER BY `time` $sort";
                if ($sort == 'ASC')
                    $data['s_sort'] = 'DESC';
                else
                    $data['s_sort'] = 'ASC';
            }
        }
        $data['status']=2;
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('volunteer_view', $data);
    }
    public function inactive_volunteers() {

        $data['msg'] = '';
        $data['status'] = 3;
        $data['title'] = 'Volunteer';
        $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not=3 ";
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
        if (isset($_POST)) {
            $data['s_gender'] = $gender = $this->input->post('gender');
            $data['s_nationality'] = $nationality = $this->input->post('nationality');
            $data['s_superpower'] = $super_power = $this->input->post('super_power');
            $data['s_name_phone'] = $name_phone = $this->input->post('name_phone');
            $data['s_sort'] = $sort = $this->input->post('sort');
            $data['f_date'] = $f_date = $this->input->post('f_date');
            $data['t_date'] = $t_date = $this->input->post('t_date');
            if ($gender != "") {
                $query .= " and gender='" . $gender . "'";
            }
            if ($nationality != "") {
                $query .= " and nationality='" . $nationality . "'";
            }
            if ($super_power != "") {
                $query .= " and superpower='" . $super_power . "'";
            }
            if ($name_phone != "") {
                $query .= " and (firstname LIKE '%" . $name_phone . "%' or phone LIKE '%" . $name_phone . "%')";
            }
            if ($f_date != "" && $t_date == "")
                $query .= " and `time`='$f_date'";
            if ($f_date != "" && $t_date != "")
                $query .= " and (`time` BETWEEN  '$f_date' and '$t_date') ";
            if ($sort != '') {
                $query .= " ORDER BY `time` $sort";
                if ($sort == 'ASC')
                    $data['s_sort'] = 'DESC';
                else
                    $data['s_sort'] = 'ASC';
            }
        }
        $data['status']=3;
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('volunteer_view', $data);
    }
    public function volunteer_print() {
        if (!isset($_GET['id']))
        //$query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not=0 ";
            $query;
        else {
            $str = $_REQUEST['id'];
            $id = my_simple_crypt($str, 'd');
            $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not='" . $id . "'";
        }
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $this->load->view('volunteer_print', $data);
    }
    public function previlage() {
        $data['msg'] = '';
        $data['title'] = 'Volunteer';
        $str = $_REQUEST['id'];
        $id = my_simple_crypt($str, 'd');
        $data['user_id'] = $id;
        if (isset($_POST['submit'])) {
            $cpt = count($_POST['chk']);
            for ($i = 0; $i < $cpt; $i++) {
                $arr[] = array(
                    'user_id' => $_POST['userid'],
                    'module_id' => $_POST['chk'][$i]
                );
            }
            $result = $this->users_model->insert_privilage($arr, $_POST['userid']);
            if (!$result) {
                $data['msg'] = 'Privilage Modification Sucessfully Done';
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        $this->load->view('previlage', $data);
    }
    public function menus() {
        $data['msg'] = '';
        $data['title'] = 'Module Creation';
        if (isset($_POST['save'])) {
            $query = array(
                'module_name' => $_POST['module_name'],
                'parent_module_id' => $_POST['parent_module'],
                'sort_order' => $_POST['sort_order'],
                'module_head' => $_POST['module_head'],
                'module_link' => $_POST['module_link'],
                'module_icone' => $_POST['icone']
            );
            $result = $this->privilege_model->insert_modules($query);
            if (!$result) {
                $data['msg'] = 'Module added';
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        $data['modules'] = $this->privilege_model->get_module(0);
        $data['parent_module'] = $this->privilege_model->get_parent_modules();
        $this->load->view('module_creation', $data);
    }
    public function notifications() {
        $data['msg'] = '';
        $data['title'] = 'Notification';
        if (isset($_POST['save'])) {
            $query = array(
                'date' => $_POST['date'],
                'title' => $_POST['title'],
                'decription' => $_POST['description']
            );
            $result = $this->users_model->insert_notification($query);
            if (!$result) {
                $data['msg'] = 'Notification added';
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        $noti_count = "SELECT COUNT(*) as 'count' FROM `al_notification`";
        $data['noti_count'] = $this->users_model->get_count($noti_count);
        $data['notification'] = $this->users_model->get_notification();
        $this->load->view('notification', $data);
    }
    public function delete() {

        $str = $_REQUEST['id'];
        $id = my_simple_crypt($str, 'd');
        $this->users_model->delete_users($id);
    }
    public function volunteer_exsl()
    {
            $str = $_REQUEST['id'];
            $id = my_simple_crypt($str, 'd');
            if($id!=0)
            $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not='" . $id . "'";
        else
            $query = "SELECT * FROM `al_volunteer` WHERE `id`!=''";
        // create file name
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        $empInfo = $this->users_model->get_volunteer($query); 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Slno');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Middle Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Date Of Birth');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Nationality');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Phone');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Email');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Super Power');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'About jalila');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Emirates ID');       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Passport Copy');       
        // set Row
        $rowCount = 2;$cnt = 0;
        foreach ($empInfo as $element) {
            $cnt++;
            $dat1 = $element->birthday;
            if($dat1!='')
            $dob = date("d-M-Y",$dat1);
        else
            $dob='';
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $cnt);            
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->firstname);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->middlename);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->lastname);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $dob);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->gender);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->nationality);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->superpower);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element->about_jalila);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element->emirates_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element->passport_copy);
    
            $rowCount++;
        }

        //Godaddy Server
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Volunteer.xls"');
        $object_writer->save('php://output');

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        // $objWriter->save('uploads'.$fileName);
        //download file
        // header("Content-Type: application/vnd.ms-excel");
        // redirect('uploads'.$fileName); 
    }
    public function get_all_volunteer()
    {
       
    $status=$_POST['status'];
    if($status==0)
         $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' ";
     else
$query.=" and seleted_or_not=$status ";

    if(isset($_POST['t_date']))
    $t_date=$_POST['t_date'];
else
    $t_date='';
    if(isset($_POST['f_date']))
    $f_date=$_POST['f_date'];
else
$f_date='';
            if ($f_date != "" && $t_date == "")
                $query .= " and `time`='$f_date'";
            if ($f_date == "" && $t_date != "")
                $query .= " and `time`='$t_date'";
            if ($f_date != "" && $t_date != "")
                $query .= " and (`time` BETWEEN  '$f_date' and '$t_date') ";

$query.="ORDER BY `time` ASC ";
    $full_arr= array();
    $cnt = 0;
    // if(($type=='Volunteer' || $type=="") && ($category=="General" || $category=="")  ){
        $volunteer = $this->users_model->get_volunteer($query);
        foreach ($volunteer as $key) {
            $cnt++;
            // $arr1[]=array(
            $dat = $key->time;
            $arr = explode("-", $dat);
            $aarr = explode(" ", $arr[2]);
           if($key->seleted_or_not==0){
                                                                    $sts="Registered";     
                                                                $st_lbl="label label-default";
                                                                 }
                                                                if($key->seleted_or_not==1){
                                                                     $sts="Approved";
                                                                     $st_lbl="label label-warning";
                                                                  }
                                                                 if($key->seleted_or_not==2){
                                                                     $sts="Active";
                                                                     $st_lbl="label label-primary";
                                                                  }
                                                                 if($key->seleted_or_not==3){
                                                                     $sts="In Active";
                                                                     $st_lbl="label label-success";
                                                                  }
                                                                 if($key->seleted_or_not==4){
                                                                     $sts="Canceled  ";
                                                                     $st_lbl="label label-danger";
                                                                  }
                                                                 if($key->seleted_or_not==5){
                                                                     $sts="Pending";
                                                                     $st_lbl="label label-default pen";
                                                                  }  
$label="<span class='";
$label.=$st_lbl;
$label.="'>";
$label.=$sts;
$label.="</span>";
$action="<a href='profile?id=";
$action.= my_simple_crypt($key->id,'e');
$action.="'><i class='fa fa-address-book fa-2x'></i></a>";



            array_push($full_arr,array(
                $cnt,
                $aarr[0] . "-" . $arr[1] . "-" . $arr[0],
                $key->firstname,
                $key->gender,
                $key->nationality,
                $key->phone,
                $key->email,
                $label,
                $key->superpower,
                $action
            )
        );
        }
    // }
    // else{
        //$arr1[]=array();
    // }
        echo json_encode($full_arr);
    }
}
