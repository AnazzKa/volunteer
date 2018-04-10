<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Seminar_registration extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('seminar_registration_model');
        $this->load->model('privilege_model');
        $this->load->model('users_model');
        $this->check_isvalidated();
    }
    private function check_isvalidated() {
        if (!$this->session->userdata('validated')) {
            header('Location:Login');
        }
    }
    public function index() {
        $data['msg'] = '';
        $data['title'] = 'Seminar Registration';
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
        $empInfo = $this->seminar_registration_model->get_all(0, 0); 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Slno');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Full Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Organization');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Designation');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Phone');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Email');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Message');       
        // set Row
        $rowCount = 2;$cnt = 0;
        foreach ($empInfo as $element1) {
           $cnt++;
            $tme = $element1->submit_time;
            $da['appointment_ne'] = $this->seminar_registration_model->get_all(1, $tme);
            $date = date('r', $tme);

foreach ($da['appointment_ne'] as $element) {
            if ($element->field_order == 0) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $cnt);
        } 
        if ($element->field_order == 0) {
             $ne = new DateTime($date);              
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $ne->format('d-m-Y'));
}
        if ($element->field_name == 'fullname') {
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'organization') {
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'designation') {
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'phonenumber') {
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'emailaddress') {
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->field_value);
        }
        if ($element->field_name == 'appointmentmessage') {
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->field_value);
        }
    }
            $rowCount++;
        }

        //Godaddy Server
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Seminar Registration.xls"');
        $object_writer->save('php://output');

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        // $objWriter->save('uploads'.$fileName);
        //download file
        // header("Content-Type: application/vnd.ms-excel");
        // redirect('uploads'.$fileName);   
}

        $data['seminar_registration'] = $this->seminar_registration_model->get_all(0, 0);
        $this->load->view('seminar_registration', $data);
    }
}
