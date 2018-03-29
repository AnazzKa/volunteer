<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
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

            $config['allowed_types']        = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $dataInfo = array();
            $dataInfo1 = array();
            $files = $_FILES;
            //Emirates_id
            $cpt = count($_FILES['Emirates_id']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['Emirates_id']['name'] = $files['Emirates_id']['name'][$i];
                $_FILES['Emirates_id']['type'] = $files['Emirates_id']['type'][$i];
                $_FILES['Emirates_id']['tmp_name'] = $files['Emirates_id']['tmp_name'][$i];
                $_FILES['Emirates_id']['error'] = $files['Emirates_id']['error'][$i];
                $_FILES['Emirates_id']['size'] = $files['Emirates_id']['size'][$i];

                $this->upload->initialize($this->set_upload_options());
                if (!$this->upload->do_upload('Emirates_id')) :
                    $error = array('error' => $this->upload->display_errors());
                else :
                    $dataInfo[] = $this->upload->data();
                endif;
            }
            //passport_copy
            $cpt = count($_FILES['passport_copy']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['passport_copy']['name'] = $files['passport_copy']['name'][$i];
                $_FILES['passport_copy']['type'] = $files['passport_copy']['type'][$i];
                $_FILES['passport_copy']['tmp_name'] = $files['passport_copy']['tmp_name'][$i];
                $_FILES['passport_copy']['error'] = $files['passport_copy']['error'][$i];
                $_FILES['passport_copy']['size'] = $files['passport_copy']['size'][$i];

                $this->upload->initialize($this->set_upload_options());
                if (!$this->upload->do_upload('passport_copy')) :
                    $error = array('error' => $this->upload->display_errors());
                else :
                    $dataInfo1[] = $this->upload->data();
                endif;
            }
            $password=$this->input->post('password');
            $encr_password=md5($password);
            if(!empty($dataInfo[0]['file_name']) && !empty($dataInfo1[0]['file_name'])){
            $query = array(
                'time' => date('Y-m-d H:i:s'),
                'firstname' => $this->input->post('F_Name'),
                'lastname' => $this->input->post('L_Name'),
                'birthday' => $this->input->post('Birthday'),
                'gender' => $this->input->post('Gender'),
                'nationality' => $this->input->post('Nationality'),
                'phone' => $this->input->post('Phone'),
                'email' => $this->input->post('email'),
                'superpower' => $this->input->post('superpower'),
                'password' => $encr_password,
                'emirates_id' => $dataInfo[0]['file_name'],
                'passport_copy' => $dataInfo1[0]['file_name'],
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
        }else{
             $data['msg'] = 'Only Image Format';
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
            $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not=0 ";
        else
        {
            $str = $_REQUEST['id'];
        $str2 = substr($str, 10);
        $id = substr($str2, 0, -10);
            $query = "SELECT * FROM `al_volunteer` WHERE `id`!='' and seleted_or_not='" .$id. "'";
        }

        $data['volunteer'] = $this->users_model->get_volunteer($query);
        $this->load->view('volunteer_print', $data);
    }

    public function previlage() {
        $data['msg'] = '';
        $data['title'] = 'Volunteer';
        $str = $_REQUEST['id'];
        $str2 = substr($str, 10);
        $id = substr($str2, 0, -10);
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
    public function delete()
    {
        
        $str = $_POST['user_id'];
        $str2 = substr($str, 10);
        $id = substr($str2, 0, -10);
        $this->users_model->delete_users($id);
    }
}
