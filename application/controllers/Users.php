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
        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $data['nationality'] = $this->users_model->get_nationality();
        $this->load->view('volunteer_view', $data);
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
            $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not='" . $id . "'";
        // create file name
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        $empInfo = $this->users_model->get_volunteer($query); 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Slno');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date Of Birth');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Nationality');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Phone');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Email');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Super Power');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'About jalila');       
        // set Row
        $rowCount = 2;$cnt = 0;
        foreach ($empInfo as $element) {
            $cnt++;
            $dat = $element->time;
            $arr = explode("-", $dat);
            $aarr = explode(" ", $arr[2]);
            $date= $aarr[0] . "-" . $arr[1] . "-" . $arr[0];
            $name=$element->firstname." ".$element->middlename." ".$element->lastname;
 $dat1 = $element->birthday;
$arr1=explode("-", $dat1);;
$dob=$arr1[2] . "-" . $arr1[1] . "-" . $arr1[0];
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $cnt);            
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $date);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $dob);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->gender);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->nationality);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->superpower);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->about_jalila);
    
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
}
