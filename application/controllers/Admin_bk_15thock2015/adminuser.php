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
 * Description of moderators
 *
 * @author ********
 */
class Adminuser extends My_Controller {

    private $view_dir;
    private $admin_base_url;

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
    public function index() { //App moderators
        $data = array();
       /* $this->common_model->initialise('user_types');
        $result_id = $this->common_model->get_records(0, '*', array('user_type' => 1));
        foreach ($result_id as $row) {
            $uid = $row->user_id;
            $this->common_model->initialise('users');
            $select = "name, msisdn, email,status";
            $data['users'][] = $this->common_model->get_record_single(array('id' => $row->user_id), $select);
        }  */
        $this->layout->view($this->view_dir, $data);
    }
    public function add() {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->form_validation->set_message('valid_email', '%s should be an valid email');
        $this->form_validation->set_message('is_unique', 'Already registered with this %s');
		$this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('addadminuser') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'msisdn' => $this->input->post('msisdn'), 'password' => md5($this->input->post('password')));
                $this->common_model->initialise('users');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                $id = $this->db->insert_id();
                $data_usertype = array('user_id' => $this->db->insert_id(), 'user_type' => 1);
                $this->common_model->initialise('user_types');
                $this->common_model->array = $data_usertype;
                $this->common_model->insert_entry();
                $this->load->model('communication_model');
                $result = $this->communication_model->send_adminuser(array('name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'password' => $this->input->post('password')));
		        if($result){
                $this->setFlashmessage('success', 'Admin User added successfully');
                redirect(base_url() . "Admin/adminuser");
                }else{
                $this->setFlashmessage('error', 'Please Try again');    
                redirect(base_url() . "Admin/adminuser/add");
                }
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function update($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->form_validation->set_message('valid_email', '%s should be an valid email');
        $this->form_validation->set_message('is_unique', 'Already registered with this %s');
		$this->common_model->initialise('users');
        $data['users'] = $this->common_model->get_record_single(array('id' => $id), '*');
		$this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //update query
        if (!empty($_POST)) {
            if ($this->form_validation->run('updateadminuser') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {            
            $data = array('name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'msisdn' => $this->input->post('msisdn'),'password' => md5($this->input->post('password')));
            $this->common_model->initialise('users');
            $this->common_model->array = $data;
            $where = array('id' => $id);
            $result_update = $this->common_model->update($where);
            $data['users'] = $this->common_model->get_record_single(array('id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Admin User Updated Successfully');
            redirect(base_url() . "Admin/adminuser");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/adminuser/update");
            }
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function userstatus($id, $status) {
        //$data = array();
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = $statusn;
        $this->common_model->initialise('users');
        $this->common_model->status = $data;
        $where = array('id' => $id);
        $this->common_model->set_status($where);
        redirect(base_url() . "Admin/adminuser");
    }
    public function getData() {
        
        $aColumns = array('id', 'name', 'msisdn', 'email', 'U.status', 'T.user_type');
        $this->common_model->initialise('users as U');
        $this->common_model->join_tables = array('user_types as T');
        $this->common_model->join_on = array('U.id = T.user_id');
        $where = array('T.user_type' => 1);
        
        $data = $this->common_model->getTable($aColumns, $where, 'id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
                if ($aRow['user_type'] == 1) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                foreach ($aColumns as $col) {

                    $col = trim($col, 'U.');

                    $row[] = $aRow[$col];
                }
                $row[0] = $i;
                $i = $i + 1;
                $status = $aRow['status'];
                if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                } else if ($status == 0 || $status == '' || $status == "NULL") {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                }

                $row[4] = $statusn;

                $row[] = '<a href="' . base_url() . 'Admin/adminuser/userstatus/' . $aRow['id'] . '/' . $aRow['status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;'
                . '<a href="' . base_url() . 'Admin/adminuser/update/' . $aRow['id'] . '"><button class="btn" title="Edit" style="border:1px solid #cccccc;">Edit</button></a>';
                $output['aaData'][] = $row;
                
            }
        }
       //$output['iTotalRecords'] = $count;
        //$output['iTotalDisplayRecords'] = $count;
		if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
    
}//class