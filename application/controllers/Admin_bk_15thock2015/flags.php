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
 * Description of flags
 *
 * @author xxxxxxxxxxxxx
 */
class Flags extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct() {
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

    public function index() {
		$data = array();
//        $this->common_model->initialise('master_content');
//		$where = "content_status !=0";
//        $data['flags'] = $this->common_model->get_records(0, '*', $where);
        $this->layout->view($this->view_dir, $data);
    }
	
	 public function changestatus($id, $status) {
       
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = array('content_status' => $statusn);
		$this->common_model->initialise('master_content');
        $this->common_model->array = $data;
        $where = array('master_content_id' => $id);
        $result_update = $this->common_model->update($where);
		$this->session->set_flashdata('getmsg', 'Status changed Successfully');
       redirect(base_url() . "Admin/flags");
    }
	
	public function othersview($id) {
        $data = array();
		// Get Content Title
		$this->common_model->initialise('content');
        $data['content'] = $this->common_model->get_record_single(array('master_content_id' => $id), '*');
		
        $this->common_model->initialise('master_content as M');
        $this->common_model->join_tables = 'content_flags as C';
        $this->common_model->join_on = "M.master_content_id = C.master_content_id";
		$where = array('C.master_content_id' => $id,'C.flag_type' => 6);
		//$groupby = 'C.master_content_id';
        $data['othersview'] = $this->common_model->get_records(0,'*',$where);
        $this->layout->view($this->view_dir, $data);
    }
	
	 public function othersviewstatus($id, $status) {
       
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = array('content_status' => $statusn);
		$this->common_model->initialise('master_content');
        $this->common_model->array = $data;
        $where = array('master_content_id' => $id);
        $result_update = $this->common_model->update($where);
		$this->session->set_flashdata('getmsg', 'Status changed Successfully');
       redirect(base_url() . "Admin/flags");
    }
	
    public function getData() {
        $aColumns = array('master_content_id', 'flag1_count','flag2_count', 'flag3_count', 'flag4_count', 'flag5_count','flag6_count','content_status');
        $this->common_model->initialise('master_content');
        $where = "content_status !=0";
		$data = $this->common_model->getTable($aColumns, $where,'master_content_id');
        $output = $data['output'];
	    $i = $this->input->get_post('iDisplayStart') + 1;
         foreach ($data['result'] as $aRow) {
               
            $row = array();
            foreach ($aColumns as $col) {
              $row[] = $aRow[$col];
            }
                $row[0] = $i;
                $i = $i + 1;
				$row[1] = $aRow['master_content_id'];
				$row[2] = $aRow['flag1_count'];
				$row[3] = $aRow['flag2_count'];
				$row[4] = $aRow['flag3_count'];
				$row[5] = $aRow['flag4_count'];
				$row[6] = $aRow['flag5_count'];
				$row[7] = $aRow['flag6_count'];
                               
              $row[] = '<a href="' . base_url().'Admin/flags/othersview/' . $aRow['master_content_id'] .'"><button class="btn" title="Others" style="border:1px solid #cccccc;">View</button></a>&nbsp;&nbsp;'
                        . '<a href="' . base_url().'Admin/flags/changestatus/' . $aRow['master_content_id'] . '/' . $aRow['content_status'] . '"><button class="btn" title="disable" style="border:1px solid #cccccc;">Disable</button></a>';
              $output['aaData'][] = $row;
           
        }
        
        echo json_encode($output);
    }
	
}
