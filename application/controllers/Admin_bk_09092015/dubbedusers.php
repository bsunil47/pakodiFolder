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
 * Description of dubbed users
 *
 * @author xxxxxxxxxxxxx
 */
class Dubbedusers extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('forgotpassword');
        if (!in_array($this->router->fetch_method(), $allowed_urls)) {
            if (!$this->_is_logged_in()) {
                redirect(base_url() . "Admin");
            }
        }
        $this->view_dir = 'admin/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('admin_main.php');
    }

    public function index() {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }
	 public function updatestatus($id, $status) {
        
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $where = array('dub_id' => $id);
        $this->common_model->initialise('userdubs');
        $this->common_model->array = array('dub_status' => $statusn);
        $this->common_model->update($where);
        redirect(base_url() . "Admin/dubbedusers");
    }
    public function update($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
        //update query
        if (!empty($_POST)) {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('userdubs');
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            //$this->session->set_flashdata('getmsg', 'User Dubs Updated Successfully');
            if($result_update == 0){
            $this->setFlashmessage('success', 'User Dubs Updated Successfully');
            redirect(base_url() . "Admin/dubbedusers");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/dubbedusers/update");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    //records
    public function records() {
        $data = array();
        /*$this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = array('users as U');
        $this->common_model->join_on = array('U.id = D.user_id');
        $where = array('record_type' => 2);
        $data['dubbedusers'] = $this->common_model->get_records(0, 'D.*, U.name', $where);*/
        $this->layout->view($this->view_dir, $data);
    }
    public function recordupdate($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
        //update query
        if (!empty($_POST)) {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('userdubs');
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Record Updated Successfully');
            redirect(base_url() . "Admin/dubbedusers/records");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/dubbedusers/recordupdate");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function updaterecordstatus($id, $status) {
        
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $where = array('dub_id' => $id);
        $this->common_model->initialise('userdubs');
        $this->common_model->array = array('dub_status' => $statusn);
        $this->common_model->update($where);
        redirect(base_url() . "Admin/dubbedusers/records");
    }
	
	public function movedubs($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //category
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_records(0, '*', array('status' => 1), $col = 'cat_id', $order = 'asc', $groupby = 'cat_id');
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
       
        if (!empty($_POST)) { 
			if ($this->form_validation->run('movedubs') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
            $unique_code = substr($_POST['dubclip_title'],0,3).date('y').rand(111111,999999);
            $data['userdubs']->user_id;
            unset($data['submit']);
            $this->common_model->initialise('master_content');
            $this->common_model->array = array('content_type' => $_POST['content_type'], 'unique_code' => $unique_code, 'category_id' => $_POST['category_id'], 'parental_advisory' => $_POST['parental_advisory'], 'language_id' => $_POST['language_id'], 'thumb_filename' => $data['userdubs']->thumb_filename, 'contentclip_filename' => $data['userdubs']->dubclip_filename, 'clip_length' => $_POST['clip_length'], 'vuser_id' => $data['userdubs']->user_id, 'vuser_name' => $data['user']->name, 'vuser_type' => '2', 'contentowner_id' => $data['userdubs']->user_id);
            $master_content_id = $this->common_model->insert_entry();
            
            $this->common_model->initialise('content');
            $this->common_model->array = array('content_type' => $_POST['content_type'], 'master_content_id' => $master_content_id, 'contentowner_id' => $data['userdubs']->user_id, 'unique_code' => $unique_code, 'title' => $_POST['dubclip_title'], 'short_desc' => $_POST['short_desc'], 'category_id' => $_POST['category_id'], 'parental_advisory' => $_POST['parental_advisory'], 'language_id' => $_POST['language_id'], 'contentclip_filename' => $data['userdubs']->dubclip_filename, 'thumb_filename' => $data['userdubs']->thumb_filename, 'movie_name' => $_POST['movie_name'], 'main_artist' => $_POST['main_artist'], 'clip_length' => $_POST['clip_length']);

            if($this->common_model->insert_entry()){
                $this->common_model->initialise('userdubs');
                $this->common_model->array = array('isdub_moderate' => 1, 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
                $where = array('dub_id' => $id);
				$result_update = $this->common_model->update($where);
                $this->setFlashmessage('success', 'User Dubs Moved Successfully');
                redirect(base_url() . "Admin/dubbedusers");
            }else{
                $this->setFlashmessage('error', 'Please Try again');  
                redirect(base_url() . "Admin/dubbedusers/movedubs");
        }
        }
		}
        $this->layout->view($this->view_dir, $data);
    }
	
	public function moverecord($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //category
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_records(0, '*', array('status' => 1), $col = 'cat_id', $order = 'asc', $groupby = 'cat_id');
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
       
        if (!empty($_POST)) { 
            if ($this->form_validation->run('movedubs') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
            $unique_code = substr($_POST['dubclip_title'],0,3).date('y').rand(111111,999999);
            $data['userdubs']->user_id;
            unset($data['submit']);
            $this->common_model->initialise('master_content');
            $this->common_model->array = array('content_type' => $_POST['content_type'], 'unique_code' => $unique_code, 'category_id' => $_POST['category_id'], 'parental_advisory' => $_POST['parental_advisory'], 'language_id' => $_POST['language_id'], 'thumb_filename' => $data['userdubs']->thumb_filename, 'contentclip_filename' => $data['userdubs']->dubclip_filename, 'clip_length' => $_POST['clip_length'], 'vuser_id' => $data['userdubs']->user_id, 'vuser_name' => $data['user']->name, 'vuser_type' => '2', 'contentowner_id' => $data['userdubs']->user_id);
            $master_content_id = $this->common_model->insert_entry();
            
            $this->common_model->initialise('content');
            $this->common_model->array = array('content_type' => $_POST['content_type'], 'master_content_id' => $master_content_id, 'contentowner_id' => $data['userdubs']->user_id, 'unique_code' => $unique_code, 'title' => $_POST['dubclip_title'], 'short_desc' => $_POST['short_desc'], 'category_id' => $_POST['category_id'], 'parental_advisory' => $_POST['parental_advisory'], 'language_id' => $_POST['language_id'], 'contentclip_filename' => $data['userdubs']->dubclip_filename, 'thumb_filename' => $data['userdubs']->thumb_filename, 'movie_name' => $_POST['movie_name'], 'main_artist' => $_POST['main_artist'], 'clip_length' => $_POST['clip_length']);

            if($this->common_model->insert_entry()){
                $this->common_model->initialise('userdubs');
                $this->common_model->array = array('isdub_moderate' => 1, 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
                $where = array('dub_id' => $id);
                $result_update = $this->common_model->update($where);
                $this->setFlashmessage('success', 'Record Moved Successfully');
                redirect(base_url() . "Admin/dubbedusers/records");
            }else{
                $this->setFlashmessage('error', 'Please Try again');  
                redirect(base_url() . "Admin/dubbedusers/moverecord");
        }
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function deletedrecords(){
		$data = array();
		$this->layout->view($this->view_dir, $data);
		}
    public function deleteddubs(){
		$data = array();
		$this->layout->view($this->view_dir, $data);
		}
	
    public function dubdelupdate($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
        //update query
        if (!empty($_POST)) { 
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('userdubs');
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "Admin/dubbedusers/deleteddubs");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/dubbedusers/dubdelupdate");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function dubdelrecupdate($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
        //update query
        if (!empty($_POST)) { 
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('userdubs');
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "Admin/dubbedusers/deletedrecords");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/dubbedusers/dubdelrecupdate");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    
    public function movedeldub($id) {
		$data = array();
		$this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('userdubs');
        $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
        //List of Languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //category
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_records(0, '*', array('status' => 1), $col = 'cat_id', $order = 'asc', $groupby = 'cat_id');
        //Dubbed Username or AppuserName
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $data['userdubs']->user_id), 'name,msisdn');
       
        if (!empty($_POST)) { 
            if ($this->form_validation->run('movedubs') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
            $unique_code = substr($_POST['dubclip_title'],0,3).date('y').rand(111111,999999);
            $data['userdubs']->user_id;
            unset($data['submit']);
            $this->common_model->initialise('master_content');
            $this->common_model->array = array('content_type' => $_POST['content_type'], 'unique_code' => $unique_code, 'category_id' => $_POST['category_id'], 'parental_advisory' => $_POST['parental_advisory'], 'language_id' => $_POST['language_id'], 'thumb_filename' => $data['userdubs']->thumb_filename, 'contentclip_filename' => $data['userdubs']->dubclip_filename, 'clip_length' => $_POST['clip_length'], 'vuser_id' => $data['userdubs']->user_id, 'vuser_name' => $data['user']->name, 'vuser_type' => '2', 'contentowner_id' => $data['userdubs']->user_id);
            $master_content_id = $this->common_model->insert_entry();
            
            $this->common_model->initialise('content');
            $this->common_model->array = array('content_type' => $_POST['content_type'], 'master_content_id' => $master_content_id, 'contentowner_id' => $data['userdubs']->user_id, 'unique_code' => $unique_code, 'title' => $_POST['dubclip_title'], 'short_desc' => $_POST['short_desc'], 'category_id' => $_POST['category_id'], 'parental_advisory' => $_POST['parental_advisory'], 'language_id' => $_POST['language_id'], 'contentclip_filename' => $data['userdubs']->dubclip_filename, 'thumb_filename' => $data['userdubs']->thumb_filename, 'movie_name' => $_POST['movie_name'], 'main_artist' => $_POST['main_artist'], 'clip_length' => $_POST['clip_length']);

            if($this->common_model->insert_entry()){
                $this->common_model->initialise('userdubs');
                $this->common_model->array = array('isdub_moderate' => 1, 'moderatedby' => $this->session->userdata('id'), 'moderatedon' => date('Y-m-d H:i:s'));
                $where = array('dub_id' => $id);
                $result_update = $this->common_model->update($where);
                $this->setFlashmessage('success', 'Moved Successfully');
                redirect(base_url() . "Admin/dubbedusers/deleteddubs");
            }else{
                $this->setFlashmessage('error', 'Please Try again');  
                redirect(base_url() . "Admin/dubbedusers/movedeldub");
        }
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
	
	public function getData() { 
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
       	$where = "D.dub_status != '2' AND D.record_type = '1' AND D.isdub_moderate = '0'".$daterange;
        $data = $this->common_model->getTable($aColumns, $where, 'dub_id');
        $output = $data['output'];
        //print_r($output); exit;
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['record_type'] == 1 && $aRow['isdub_moderate'] == 0) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                unset($aColumns[6]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'D.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];
                   
                }
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[3] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[3] = '';
                }
                $row[0] = $i;
                $i = $i + 1;
                $status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                //} else if ($status == 0 || $status == '' || $status == "NULL") {
				} else  {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                }
                $row[4] = $statusn;
                //$row[] = '<a href="' . base_url() . 'Admin/users/update/' . $aRow['id'] . '"><button class="btn" title="Edit" style="border:1px solid #cccccc;">Edit</button></a>&nbsp;<a href="' . base_url() . 'Admin/users/userstatus/' . $aRow['id'] . '/' . $aRow['status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>';
                $row[] = '<a href="' . base_url() . 'Admin/dubbedusers/updatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;'
                        . '<a href="' . base_url() . 'Admin/dubbedusers/update/' . $aRow['dub_id'] . '"><button class="btn" title="update" style="border:1px solid #cccccc;">Update</button></a>&nbsp;&nbsp;';
//                        . '<a href="' . base_url() . 'Admin/dubbedusers/movedubs/' . $aRow['dub_id'] . '"><button class="btn" title="move" style="border:1px solid #cccccc;">Move</button></a>';
                $output['aaData'][] = $row;
        }
    }  
        if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
    
	
	public function getRData() { 
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
        $where = "D.dub_status != '2' AND D.record_type = '2' AND D.isdub_moderate = '0'".$daterange;
        $data = $this->common_model->getTable($aColumns, $where, 'dub_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['record_type'] == 2 && $aRow['isdub_moderate'] == 0) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                unset($aColumns[6]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'D.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];
                   
                }
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[3] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[3] = '';
                }
                $row[0] = $i;
                $i = $i + 1;
                $status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                //} else if ($status == 0 || $status == '' || $status == "NULL") {
				} else {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                }
                $row[4] = $statusn;

                $row[] = '<a href="' . base_url() . 'Admin/dubbedusers/updaterecordstatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;'
                        . '<a href="' . base_url() . 'Admin/dubbedusers/recordupdate/' . $aRow['dub_id'] . '"><button class="btn" title="update" style="border:1px solid #cccccc;">Update</button></a>&nbsp;&nbsp;'
                        . '<a href="' . base_url() . 'Admin/dubbedusers/moverecord/' . $aRow['dub_id'] . '"><button class="btn" title="move" style="border:1px solid #cccccc;">Move</button></a>';
                $output['aaData'][] = $row;
        }
    }
        if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
	
	public function getMData() { //echo "hello";
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
       	$where = "D.dub_status = '2' AND D.isdub_moderate = '0'".$daterange;
        $data = $this->common_model->getTable($aColumns, $where, 'dub_id');
        $output = $data['output'];
        //print_r($output); exit;
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['record_type'] == 1 && $aRow['isdub_moderate'] == 0) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                unset($aColumns[6]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'D.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];
                   
                }
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[3] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[3] = '';
                }
                $row[0] = $i;
                $i = $i + 1;
                /*$status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                //} else if ($status == 0 || $status == '' || $status == "NULL") {
				} else  {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                }
                $row[4] = $statusn;*/
                //$row[] = '<a href="' . base_url() . 'Admin/users/update/' . $aRow['id'] . '"><button class="btn" title="Edit" style="border:1px solid #cccccc;">Edit</button></a>&nbsp;<a href="' . base_url() . 'Admin/users/userstatus/' . $aRow['id'] . '/' . $aRow['status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>';
                //'<a href="' . base_url() . 'Admin/dubbedusers/updatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;'
                //. 
						$row[4] = '<a href="' . base_url() . 'Admin/dubbedusers/dubdelupdate/' . $aRow['dub_id'] . '"><button class="btn" title="update" style="border:1px solid #cccccc;">Update</button></a>&nbsp;&nbsp;';
//                        . '<a href="' . base_url() . 'Admin/dubbedusers/movedeldub/' . $aRow['dub_id'] . '"><button class="btn" title="move" style="border:1px solid #cccccc;">Move</button></a>';
                $output['aaData'][] = $row;
        }
    } 
        if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
    
    public function getNData() { //echo "hello";
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
       	$where = "D.dub_status = '2' AND D.record_type = '2' AND D.isdub_moderate = '0'".$daterange;
        $data = $this->common_model->getTable($aColumns, $where,'dub_id');
        $output = $data['output'];
        //print_r($output); exit;
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['record_type'] == 2 && $aRow['isdub_moderate'] == 0) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                unset($aColumns[6]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'D.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];
                   
                }
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[3] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[3] = '';
                }
                $row[0] = $i;
                $i = $i + 1;
                $row[4] = '<a href="' . base_url() . 'Admin/dubbedusers/dubdelrecupdate/' . $aRow['dub_id'] . '"><button class="btn" title="update" style="border:1px solid #cccccc;">Update</button></a>&nbsp;&nbsp;';
//                        . '<a href="' . base_url() . 'Admin/dubbedusers/movedeldub/' . $aRow['dub_id'] . '"><button class="btn" title="move" style="border:1px solid #cccccc;">Move</button></a>';
                $output['aaData'][] = $row;
        }
    } 
        if(!empty($_POST['sSearch'])){
			$output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
    
}//class
