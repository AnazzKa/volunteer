<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('contact_model');
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
        $data['title'] = 'Contact';
        $data['s_gender'] = '';
        $data['s_nationality'] = '';
        $data['s_superpower'] = '';
        $data['s_name_phone'] = '';
        $data['s_sort'] = 'ASC';
        $data['f_date'] = '';
        $data['t_date'] = '';
if(isset($_POST['export']))
{

     // create file name
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        $empInfo = $this->contact_model->get_all(0, 0); 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Slno');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Email');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Message');       
        // set Row
        $rowCount = 2;$cnt = 0;
        foreach ($empInfo as $element1) {
           $cnt++;
                                                            $tme = $element1->submit_time;
                                                            $da['contacts_ne'] = $this->contact_model->get_all(1, $tme);

                                                            $date = date('r', $tme);

foreach ($da['contacts_ne'] as $element) {


            if ($element->field_order == 0) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $cnt);
        } 
        if ($element->field_order == 0) {
             $ne = new DateTime($date);              
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $ne->format('d-m-Y'));
}
        if ($element->field_name == 'contact_first_name') {
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'contact_last_name') {
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'contact_us_mobile') {
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'contact_us_email') {
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'contact_us_message') {
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->field_value);
        }
    }
            $rowCount++;
        }

        //Godaddy Server
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Contact.xls"');
        $object_writer->save('php://output');

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        // $objWriter->save('uploads'.$fileName);
        //download file
        // header("Content-Type: application/vnd.ms-excel");
        // redirect('uploads'.$fileName);   
}

        $data['contacts'] = $this->contact_model->get_all(0, 0);
        $this->load->view('contact_list_new', $data);
    }

    public function contact_single_view() {
        $data['msg'] = '';
        $data['title'] = 'Contact';
        if (isset($_REQUEST['id'])) {
            $str = $_REQUEST['id'];
            $tme = my_simple_crypt($str, 'd');
            $data['contacts'] = $this->contact_model->get_all(1, $tme);
        }
        $this->load->view('contact_single_view', $data);
    }

    public function contact_mail() {
        if (isset($_POST['send'])) {
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $messsage = $_POST['messsage'];
            $this->load->config('mandrill');
            $this->load->library('mandrill');
            $mandrill_ready = NULL;
            try {
                $this->mandrill->init($this->config->item('mandrill_api_key'));
                $mandrill_ready = TRUE;
            } catch (Mandrill_Exception $e) {
                $mandrill_ready = FALSE;
            }
            $templ = "";
            if ($mandrill_ready) {
                //Send us some email!
                $email = array(
                    'html' => $templ, //Consider using a view file
                    'text' => 'This is my plaintext message',
                    'subject' => $subject,
                    'from_email' => 'mail@media.ajch.ae',
                    'from_name' => 'Contact Form',
                    'to' => array(array('email' => $email)) //Check documentation for more details on this one
                        //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
                );
                $result = $this->mandrill->messages_send($email);
            }
            $data['msg'] = '';
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
