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
 * Description of users
 *
 * @author ********
 */
class Users extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    public function __construct() {
        parent::__construct();
        $this->admin_base_url = base_url() . 'dubsviewer';
        $allowed_urls = array('index', 'dashboard','dubslist','update','updatestatus');
        if (!in_array($this->router->fetch_method(), $allowed_urls)) {
            if (!$this->_is_logged_in()) {
                redirect(base_url() . "dubsviewer");
            }
        }
        $this->view_dir = 'dubsviewer/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('dubsviewer_main.php');
    }

    public function index() {

        $data = array('name' => $this->input->post('user_id'), 'msisdn' => $this->input->post('password'));

        if (isset($_POST['submit'])) {
            $this->load->library('form_validation');
            //set rules here
            $this->form_validation->set_rules('user_id', 'USER_ID', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            // set messages
            $this->form_validation->set_message('required', '%s should not be empty');
            //$this->form_validation->set_message('valid_email', '%s should be an valid email');
            if ($this->form_validation->run() == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('name' => $this->input->post('user_id'), 'msisdn' => $this->input->post('password'));
                $this->common_model->initialise('users');
                $result = $this->common_model->get_record_single($data, '*');
                 if (!empty($result)) {
                     if($result->id==283){
                    $this->common_model->initialise('user_types');
                    $result_s = $this->common_model->get_record_single(array('user_id' => $result->id, 'user_type ' => 5), '*');
                    if (!empty($result_s)) {
                        $this->session->set_userdata('user_id', $result->id);
                        $this->session->set_userdata('name', $result->name);
                        $this->session->set_userdata('msisdn', $result->msisdn);
                        $this->session->set_userdata('email', $result->email);
                        $this->session->set_userdata('user_type', $result_s->user_type);
                       redirect($this->admin_base_url . '/users/dubslist');
                 } else {
                        $this->setFlashmessage('error', 'Not able to login');
                        redirect($this->admin_base_url, 'refresh');
                    }
                 }} else {
                    $this->setFlashmessage('error', 'Invalid Username or Password');
                    redirect($this->admin_base_url, 'refresh');
                }
            }
        }

        $this->layout->setLayout('dubsviewer_login.php');
        $data['admin_url'] = $this->admin_base_url;
        $this->layout->view($this->view_dir, $data);
    }
   
   
    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect(base_url() . "dubsviewer");
    }
    public function dashboard() {
               // Add user data in session
        $data = array();
        $this->common_model->initialise('userdubs');
        $select = 'COUNT(*) as count';
        $aid= $this->session->userdata['user_id'];
        $data['Activedubs'] = $this->common_model->get_record_single(array('dub_status' => 1,'user_id' =>$aid ), $select);
        $data['dubs']=$this->common_model->get_record_single(array('dub_status' => 0,'user_id' => $this->session->userdata['user_id']), $select);
        $this->layout->view($this->view_dir, $data);
    }
    public function dubslist() {
        $data = array();
        /*$this->common_model->initialise('userdubs');
        $data['dubbedusers'] = $this->common_model->get_records(0, '*','');*/
        $this->common_model->initialise('userdubs as D');
       // $this->common_model->join_tables = array('users as U');
       // $this->common_model->join_on = array('U.id = D.user_id');
        //$aid= $this->session->userdata['user_id'];
	if(!empty($this->session->userdata['user_id'])){
         $aid= $this->session->userdata['user_id'];}else{
             $aid=283;
         }

        $where="user_id = $aid and dub_status = 1";
        $data['dubbedusers'] = $this->common_model->get_records(0, '*', $where);
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
        redirect(base_url() . "dubsviewer/users/dubslist");
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
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('admin_user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            redirect(base_url() . "moderator/users/dubslist");
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function view($id) {
        $data = array();
        $this->common_model->initialise('users');
        $data['user'] = $this->common_model->get_record_single(array('id' => $id), '*');
        $this->common_model->initialise('languages');
        $data['user']->app_language = $this->common_model->get_record_single(array('lang_id' => $data['user']->app_language), 'language')->language ;
        if($data['user']->userprefer_languages){
        $where = "lang_id IN (".$data['user']->userprefer_languages.")";
        $data['user']->userprefer_languages = $this->common_model->get_record_single($where, 'group_concat(language) as languages')->languages;
        }
        $this->layout->view($this->view_dir, $data);
    }
    
    public function getData() {
        $aColumns = array('id', 'name', 'msisdn', 'email', 'U.status', 'T.user_type');
        $this->common_model->initialise('users as U');
        $this->common_model->join_tables = array('user_types as T');
        $this->common_model->join_on = array('U.id = T.user_id');
        $where = array('T.user_type' => 5);
        $data = $this->common_model->getTable($aColumns, $where);
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
                if ($aRow['user_type'] == 5) {
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
                //$row[] = '<a href="' . base_url() . 'Admin/users/update/' . $aRow['id'] . '"><button class="btn" title="Edit" style="border:1px solid #cccccc;">Edit</button></a>&nbsp;<a href="' . base_url() . 'Admin/users/userstatus/' . $aRow['id'] . '/' . $aRow['status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>';
                $row[] = '<a href="' . base_url() . 'Admin/users/userstatus/' . $aRow['id'] . '/' . $aRow['status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;'
                        . '<a href="' . base_url() . 'Admin/users/view/' . $aRow['id'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">View</button></a>';
                $output['aaData'][] = $row;
                
            }
        }
        $output['iTotalRecords'] = $count;
        $output['iTotalDisplayRecords'] = $count;
        echo json_encode($output);
    }
    
    

}//class

