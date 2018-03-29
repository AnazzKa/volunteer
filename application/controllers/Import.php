<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Import extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('users_model');
        $this->load->model('import_model');
        $this->load->model('privilege_model');
    }
    public function index() {
        $data['title'] = "Dashboard";
        $data['msg'] = '';
        if (isset($_POST['import'])) {
            $db_o = $_POST['db_o'];
            $db_t = $_POST['db_t'];
            $pri = "id";
            $result = $this->import_model->import_data_base($db_o, $db_t, $pri);
            if (!$result) {
                $data['msg'] = 'Import Sucessfully Done';
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        $this->load->view('import_db', $data);
    }
    public function import_table() {
        $db_o = 'wp_volunteer';
        $db_t = 'al_volunteer';
        $pri = "id";
        $result = $this->import_model->import_data_base($db_o, $db_t, $pri);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
