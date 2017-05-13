<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appversion
 *
 * @author xxxxxxxxxxxxx
 */
class Randomusers extends My_Controller
{

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('forgotpassword');
        if (!in_array($this->router->fetch_method(), $allowed_urls) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
        if($this->session->userdata['user_type'] === 3){
            $this->admin_base_url = base_url() . 'moderator';
            redirect($this->admin_base_url . '/users/dashboard');
        }elseif($this->session->userdata['user_type'] == 4){
            redirect(base_url() . 'content/index');
        }
        $this->view_dir = 'admin/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('admin_main.php');
    }

    public function index()
    {
        $data = array();
//        $this->common_model->initialise('content_random_users as C');
//        $this->common_model->join_tables = 'languages as L';
//        $this->common_model->join_on = "C.language_id = L.lang_id";
//        $order = 'C.datecreated';
//        $data['rusers'] = $this->common_model->get_records(0, 'C.id,C.name,C.language_id,C.email,C.mobile,C.status,L.language', 0,$order);
        $this->layout->view($this->view_dir, $data);
    }


    public function add()
    {
        $this->layout->setLayout('blank.php');
        $data = array();
        //$msc = microtime(true);
        $uniqid = date('dmYHis');
        //$data['error'] = "Required data not provided";
        if (isset($_POST['submit']) && is_uploaded_file($_FILES['excel_file']['tmp_name']) && ($_FILES['excel_file']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $_FILES['excel_file']['type'] == 'application/vnd.ms-excel' || $_FILES['excel_file']['type'] == 'text/csv')) {
            $basic_array = array();
            $data['error'] = "Problem with file upload";
            if (move_uploaded_file($_FILES['excel_file']['tmp_name'], 'uploads/' . $uniqid . '_' . $_FILES['excel_file']['name'])) {
                $this->load->library('excel');
                $inputFileType = PHPExcel_IOFactory::identify(FCPATH . 'uploads/' . $uniqid . '_' . $_FILES['excel_file']['name']);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                /**  Load $inputFileName to a PHPExcel Object  * */
                $objPHPExcel = $objReader->load(FCPATH . 'uploads/' . $uniqid . '_' . $_FILES['excel_file']['name']);
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                $highestColumn = $objWorksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $row_data['name'] = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $row_data['email'] = $email = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $row_data['mobile'] = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $row_data['language_id'] = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $email);
                    if (empty($row_data['language_id']) && empty($email) && empty($row_data['mobile'])) {
                        break;
                    }
                    if (!empty($row_data['name']) && !empty($row_data['language_id']) && !empty($email) && !empty($row_data['mobile'])) {
                        //$emailval = explode("@", $email);
                        //$row_data['name'] = $emailval[0];
                        $this->common_model->initialise('content_random_users');
                        $this->common_model->array = $row_data;
                        $idval = $this->common_model->insert_entry();
                        $data['error'] = "";
                    } else {
                        $data['error'] = "Problem with data in a row $row. Please check data";
                        $dnfile = $uniqid . '_' . $_FILES['excel_file']['name'];
                        unlink("uploads/$dnfile");
                        break;
                    }
                }
                if (empty($data['error'])) {
                    $dnfile = $uniqid . '_' . $_FILES['excel_file']['name'];
                    unlink("uploads/$dnfile");
                    $this->setFlashmessage('success', 'File Uploads Successfully');
                    redirect(base_url() . "Admin/randomusers", 'refresh');
                }


            }
        }//submit

        $this->layout->view($this->view_dir, $data);
    }

    public function add1()
    {
        $data = array();
        //$msc = microtime(true);
        $uniqid = date('dmYHis');
        $data['error'] = "Required data not provided";
        if (isset($_POST['submit']) && is_uploaded_file($_FILES['excel_file']['tmp_name']) && ($_FILES['excel_file']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $_FILES['excel_file']['type'] == 'application/vnd.ms-excel' || $_FILES['excel_file']['type'] == 'text/csv')) {
            $basic_array = array();
            $data['error'] = "Problem with file upload";
            if (move_uploaded_file($_FILES['excel_file']['tmp_name'], 'uploads/' . $uniqid . '_' . $_FILES['excel_file']['name'])) {
                $this->load->library('excel');
                $inputFileType = PHPExcel_IOFactory::identify(FCPATH . 'uploads/' . $uniqid . '_' . $_FILES['excel_file']['name']);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                /**  Load $inputFileName to a PHPExcel Object  * */
                $objPHPExcel = $objReader->load(FCPATH . 'uploads/' . $uniqid . '_' . $_FILES['excel_file']['name']);
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                $highestColumn = $objWorksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                for ($row = 2; $row < $highestRow; ++$row) {
                    $row_data['name'] = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $row_data['email'] = $email = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $row_data['mobile'] = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $row_data['language_id'] = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $email);
                    if (!empty($row_data['language_id']) && !empty($email) && !empty($row_data['mobile']) && $okay) {
                        //$emailval = explode("@", $email);
                        //$row_data['name'] = $emailval[0];
                        $this->common_model->initialise('content_random_users');
                        $this->common_model->array = $row_data;
                        $idval = $this->common_model->insert_entry();
                        if (!empty($idval)) {
                            $dnfile = $uniqid . '_' . $_FILES['excel_file']['name'];
                            unlink("uploads/$dnfile");
                            $this->setFlashmessage('Error', 'File Uploads Successfully');
                            redirect(base_url() . "Admin/randomusers", 'refresh');
                        }
                    } else {
                        $data['error'] = "Problem with data in a row $row. Please check data";
                        break;
                    }
                }
            }
        }//submit

        $this->layout->view($this->view_dir, $data);
    }


    private function getlanguage($language)
    {
        $this->common_model->initialise('languages');
        $where = array('language' => $language);
        $resultlang = $this->common_model->get_record_single($where, 'lang_id');
        return $resultlang->lang_id;
    }

    public function randomstatus($id, $status)
    {
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = $statusn;
        $this->common_model->initialise('content_random_users');
        $this->common_model->status = $data;
        $where = array('id' => $id);
        $this->common_model->set_status($where);
        redirect(base_url() . "Admin/randomusers");
    }
public function getData() {
		$aColumns = array('C.id', 'C.name','L.language','C.email','C.mobile','C.status','C.language_id');
		$this->common_model->initialise('content_random_users as C');
        $this->common_model->join_tables = array('languages as L');
        $this->common_model->join_on = array('C.language_id = L.lang_id');
		        
        $data = $this->common_model->getTable($aColumns, $where=0, $col = 'C.id');
		$output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'C.');
				$col = trim($col, 'L.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
			
			 $status = $aRow['status'];
                if ($status == 1) {
                    $statusn = '<i class="icongreen icon-ok" title="Active"></i>';
					$link='<a href="' . base_url() . 'Admin/randomusers/randomstatus/'. $aRow['id'] . '/' . $aRow['status'] . '"><i class="iconred icon-remove" title="Status"></i></a>';
               } else if ($status == 0 || $status == '' || $status == "NULL") {
                    $statusn = '<i class="iconred icon-remove" title="Inactive"></i>';
					$link=$link='<a href="' . base_url() . 'Admin/randomusers/randomstatus/'. $aRow['id'] . '/' . $aRow['status'] . '"><i class="icongreen icon-ok" title="Status"></i></a>';
                }

                $row[5] = $statusn;

            $row[6] = $link;
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }


}
