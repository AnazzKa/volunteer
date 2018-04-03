<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Profile extends CI_Controller {
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
        $data['title'] = 'Profile';
        $str =$_REQUEST['id']; 
      
        if(strlen($str)==32)
        $id = my_simple_crypt($str, 'd');       
    else
        $id=0;
        if (isset($_POST['status'])) {
            $volunteer_id = $_POST['volunteer_id'];
            $status = $_POST['status'];
            $query = array(
                'seleted_or_not' => $status
            );

            $result = $this->users_model->update_profile($query, $volunteer_id);
            if (!$result) {
                
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        if (isset($_POST['rem_btn'])) {
            $volunteer_id = $_POST['volunteer_id'];
            $reminder = $_POST['reminder'];

            $query = array(
                'volunteer_id' => $volunteer_id,
                'user_id' => $this->session->userdata('userid'),
                'decription' => $reminder,
                'date' => date('Y-m-d')
            );

            $result = $this->users_model->insert_comments($query);
            if (!$result) {
                
            } else {
                $data['msg'] = 'Insertion Error';
            }
        }
        $data['comments'] = $this->users_model->get_comments($id);
        $this->users_model->update_star_rating($id);
        $data['volunteer'] = $this->users_model->get_single_user($id);
        $this->load->view('profile', $data);
    }
    public function profile_print() {
        $data['title'] = 'Profile';
        $str = $_REQUEST['id']; 
        $id = my_simple_crypt($str,'d');
        $data['volunteer'] = $this->users_model->get_single_user($id);
        $this->load->view('profile_print', $data);
    }
    public function reminder() {
        if (isset($_POST['volun']) && isset($_POST['reminder'])) {
            $volunteer_id = $_POST['volun'];
            $reminder = $_POST['reminder'];                    
            $str= $_POST['pro'];
            $pro =my_simple_crypt($str,'d');            
            $query = array(
                'volunteer_id' => $volunteer_id,
                'user_id' => $this->session->userdata('userid'),
                'decription' => $reminder,
                'date' => date('Y-m-d')
            );

            $result = $this->users_model->insert_comments($query);
            $data['comments'] = $this->users_model->get_comments($pro);            
            $arr = "";
            foreach ($data['comments'] as $row) {
                $user_id = $row->user_id;
                $d['usr'] = $this->users_model->get_single_users($user_id);


                $arr .= "<div class='feed-element'<div class='media-body'> <strong>";
                $arr .= $d['usr'][0]->firstname;
                $arr .= "</strong><br><small class='text-muted'>";
                $arr .= $row->date;
                $arr .= "</small><div class='well'>";
                $arr .= $row->decription;
                $arr .= "</div> </div> </div>";
            }
            echo $arr;
        }
    }
}
