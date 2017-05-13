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
        $this->admin_base_url = base_url() . 'moderator';
        //$allowed_urls = array('index', 'forgotpassword','dashboard','dubslist','update');
		$allowed_methodes = array('index', 'forgotpassword');
        if (!in_array($this->router->fetch_method(), $allowed_methodes) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
        if($this->session->userdata['user_type'] <= 1){
            $this->admin_base_url = base_url() . 'Admin';
            redirect($this->admin_base_url . '/users/dashboard');
        }elseif($this->session->userdata['user_type'] == 4){
            redirect(base_url() . 'content/index');
        }
        $this->view_dir = 'moderator/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('moderator_main.php');
    }
	public function index() {
        $data = array('email' => $this->input->post('email'), 'password' => md5($this->input->post('password')));
        if (isset($_POST['submit'])) {
            $this->load->library('form_validation');
            //set rules here
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            // set messages
            $this->form_validation->set_message('required', '%s should not be empty');
            $this->form_validation->set_message('valid_email', '%s should be an valid email');
            if ($this->form_validation->run() == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('email' => $this->input->post('email'), 'password' => md5($this->input->post('password')));
                $this->common_model->initialise('users');
                $result = $this->common_model->get_record_single($data, '*');
                 if (!empty($result)) {
                    $this->common_model->initialise('user_types');
                    $result_s = $this->common_model->get_record_single(array('user_id' => $result->id, 'user_type' => 3), '*');
                    if (!empty($result_s)) {
                        $this->session->set_userdata('user_id', $result->id);
                        $this->session->set_userdata('moderator_name', $result->name);
                        $this->session->set_userdata('moderator_msisdn', $result->msisdn);
                        $this->session->set_userdata('moderator_email', $result->email);
                        $this->session->set_userdata('user_type', $result_s->user_type);
                        $this->session->set_userdata('app_language', $result->app_language);
                        $this->session->set_userdata('moderator_profile_picture', $result->profile_picture);
                       redirect($this->admin_base_url . '/users/dashboard');
                    } else {
                        $this->setFlashmessage('error', 'Not able to login');
                        redirect($this->admin_base_url, 'refresh');
                    }
                } else {
                    $this->setFlashmessage('error', 'Invalid Username or Password');
                    redirect($this->admin_base_url, 'refresh');
                }
            }
        }
		$this->layout->setLayout('moderator_login.php');
        $data['admin_url'] = $this->admin_base_url;
        $this->layout->view($this->view_dir, $data);
    }
    public function forgotpassword() {
        date_default_timezone_set('America/Los_Angeles');
        $data = array();
        if (isset($_POST['submit'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_message('required', '%s should not be empty');
            if ($this->form_validation->run() == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $this->common_model->initialise('users');
                $user_record = $this->common_model->get_record_single(array('email' => $_POST['email']), '*');
                if (!empty($user_record)) {
                    $this->common_model->initialise('hashurl');
                    $code = hash('sha512', hash('md5', $_POST['email']) . hash('md5', date('ymdHis')));
                    $this->common_model->array = array('user_id' => $user_record->id, 'hashcode' => $code,'type' =>1);
                    $this->common_model->insert_entry();
                    $this->load->model('communication_model');
                    if($this->communication_model->send_recover_code(array('email' => $_POST['email'], 'message' => $code, 'name' => $user_record->name, 'path' => 'moderator'))){
                        $this->setFlashmessage('success', 'Successfully sent forgot password link to your mail');
                    }
                } else {
                    $this->setFlashmessage('error', 'Not registered with us');
                }
                redirect(base_url().'moderator/users/forgotpassword');
            } 
        }
        $this->layout->setLayout('moderator_login.php');
        $this->layout->view($this->view_dir, $data);
    }
    public function changepassword() {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('opassword', 'Old Password', 'required|trim|xss_clean|callback_change');
        $this->form_validation->set_rules('npassword', 'New Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[npassword]');
        $this->form_validation->set_message('required', '%s should not be empty');
        if ($this->form_validation->run() == FALSE) { 
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        } else {
            if (!empty($_POST)) {
                $aid = $this->session->userdata('user_id');
                $this->common_model->initialise('users');
                $user_record = $this->common_model->get_record_single(array('id' => $aid), '*');
                if (!empty($user_record)) { 
                    $db_password = $user_record->password;
                    $db_id = $user_record->id;
                    $opassword=md5($this->input->post('opassword'));
                    //if (($this->input->post('opassword', $db_password) == $db_password) && ($this->input->post('npassword') != '') && ($this->input->post('cpassword') != '')) {
                       if(($opassword == $db_password) && ($this->input->post('npassword') != '') && ($this->input->post('cpassword') != '')) { 
			$fixed_pw = md5($this->input->post('npassword'));
                        $data = array('password' => $fixed_pw);
                        $this->common_model->initialise('users');
                        $this->common_model->array = $data;
                        $where = array('id' => $db_id);
                        $result_update = $this->common_model->update($where);
                        if($result_update == 0){
                            $this->setFlashmessage('success', 'Password Changed Successfully');
                        }else{
                            $this->setFlashmessage('error', 'Please Try again');
                        }
                    }else{
                        $this->setFlashmessage('error', 'Invalid Old-password produced');
                    }
                } else {
                    $this->setFlashmessage('error', 'Error occured');
                }
                redirect(base_url() . "moderator/users/changepassword");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function logout() {
         $this->session->unset_userdata('user_id');
         $this->session->unset_userdata('moderator_name');
         $this->session->unset_userdata('moderator_msisdn');
         $this->session->unset_userdata('moderator_email');
         $this->session->unset_userdata('user_type');
         $this->session->unset_userdata('app_language');
         $this->session->unset_userdata('moderator_profile_picture');
         redirect(base_url() . "moderator");
}
    public function dashboard() {
		$data = array();
        $this->common_model->initialise('userdubs');
        $select = 'COUNT(*) as count';
        //$data['Activedubs'] = $this->common_model->get_record_single(array('dub_status' => 1), $select);
        //$data['dubs']=$this->common_model->get_record_single(array('dub_status' => 0), $select);
		
		$data['records'] = $this->common_model->get_record_single(array('record_type' => 2, 'isdub_moderate' => 0), $select);
		$data['userdubs'] = $this->common_model->get_record_single(array('record_type' => 1, 'isdub_moderate' => 0), $select);
		$data['moderateactive'] = $this->common_model->get_record_single(array('dub_status' => 1, 'isdub_moderate' => 1), $select);
		$data['moderateinactive'] = $this->common_model->get_record_single(array('dub_status' => 0, 'isdub_moderate' => 1), $select);
		$data['moderaterejected'] = $this->common_model->get_record_single(array('dub_status' => 2, 'isdub_moderate' => 1), $select);
		$this->layout->view($this->view_dir, $data);
    }
	public function records() {
		$this->layout->view($this->view_dir);
	  }
	public function dubbedusers(){
		  $this->layout->view($this->view_dir);
	  }
    public function dubslist() {
        $data = array();
        /*$this->common_model->initialise('userdubs');
        $data['dubbedusers'] = $this->common_model->get_records(0, '*','');*/
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = array('users as U');
        $this->common_model->join_on = array('U.id = D.user_id');
		$where = array('D.record_type' => 1);
        $data['dubbedusers'] = $this->common_model->get_records(0, 'D.*, U.name', $where);
        $this->layout->view($this->view_dir, $data);
    }
	public function recordslist() {
        $data = array();
        /*$this->common_model->initialise('userdubs');
        $data['dubbedusers'] = $this->common_model->get_records(0, '*','');*/
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = array('users as U');
        $this->common_model->join_on = array('U.id = D.user_id');
		$where = array('D.record_type' => 2);
        $data['dubbedusers'] = $this->common_model->get_records(0, 'D.*, U.name', $where);
        $this->layout->view($this->view_dir, $data);
    }
	public function deleteddubs(){
		$data = array();
		$this->layout->view($this->view_dir, $data);
		}
                
        public function deletedrecords(){
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
        $result_update = $this->common_model->update($where);
        if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
		redirect(base_url() . "moderator/users/dubbedusers");
		}
    }
	public function updaterecstatus($id, $status) {
		if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $where = array('dub_id' => $id);
        $this->common_model->initialise('userdubs');
        $this->common_model->array = array('dub_status' => $statusn);
        $result_update = $this->common_model->update($where);
        if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "moderator/users/records");
            }
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
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
           	if($result_update == 0){
			$this->setFlashmessage('success', 'Updated Successfully');
			redirect(base_url() . "moderator/users/records");
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
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "moderator/users/deletedrecords");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "moderator/users/dubdelrecupdate");
        }
        }
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
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "moderator/users/deleteddubs");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "moderator/users/dubdelupdate");
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
                $this->common_model->array = array('isdub_moderate' => 1, 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
                $where = array('dub_id' => $id);
                $result_update = $this->common_model->update($where);
                $this->setFlashmessage('success', 'Record Moved Successfully');
                redirect(base_url() . "moderator/users/records");
            }else{
                $this->setFlashmessage('error', 'Please Try again');  
                redirect(base_url() . "moderator/users/moverecord");
        }
        }
        }
        $this->layout->view($this->view_dir, $data);
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
                $this->common_model->array = array('isdub_moderate' => 1, 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
                $where = array('dub_id' => $id);
				$result_update = $this->common_model->update($where);
                $this->setFlashmessage('success', 'User Dubs Moved Successfully');
                redirect(base_url() . "moderator/users/dubbedusers");
            }else{
                $this->setFlashmessage('error', 'Please Try again');  
                redirect(base_url() . "moderator/users/movedubs");
        }
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
                $this->common_model->array = array('isdub_moderate' => 1, 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
                $where = array('dub_id' => $id);
                $result_update = $this->common_model->update($where);
                $this->setFlashmessage('success', 'Moved Successfully');
                redirect(base_url() . "moderator/users/deleteddubs");
            }else{
                $this->setFlashmessage('error', 'Please Try again');  
                redirect(base_url() . "moderator/users/movedeldub");
        }
        }
        }
        $this->layout->view($this->view_dir, $data);
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
            $this->common_model->array = array('isdub_moderate' => $_POST['isdub_moderate'], 'moderatedby' => $this->session->userdata('user_id'), 'moderatedon' => date('Y-m-d H:i:s'));
            $where = array('dub_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['userdubs'] = $this->common_model->get_record_single(array('dub_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "moderator/users/dubbedusers");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function profile() {
        $data = array();
        $input_fields = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->form_validation->set_message('valid_email', '%s should be an valid email');
        $this->common_model->initialise('users');
        $where = array('id' => $this->session->userdata['user_id']);
        $data['users'] = $this->common_model->get_record_single($where, '*');
        if (!empty($_POST)) {
            if ($this->form_validation->run('adminprofile') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                if (is_uploaded_file($_FILES['filen']['tmp_name'])) {
                    $target_file_img = basename($_FILES['filen']["name"]);
                    $imageFileType = pathinfo($target_file_img, PATHINFO_EXTENSION);

                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                        $target_dir = FCPATH . "appimages/";
                        $file_f = $_FILES["filen"]["name"];
                        move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dir . '/' . $file_f);
                        $this->s3upload($target_dir.'/'.$file_f, "userimages");
                        $input_fields['profile_picture'] = $_FILES["filen"]["name"];
                    } else {
                        $this->setFlashmessage('error', 'Please Upload Image files only');
                    }
                }//image
            $input_fields['name'] = $this->input->post('name');
            unset($data['submit']);
            $this->common_model->initialise('users');
            $this->common_model->array = $input_fields;
            $result_update = $this->common_model->update($where);
            $data['users'] = $this->common_model->get_record_single($where, '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Profile Updated Successfully');
            }else{
                $this->setFlashmessage('error', 'Please Try again');
            }
            }
            redirect(base_url() . "moderator/users/profile");
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function getData() { 
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate','D.thumb_filename','D.dubclip_filename','D.datecreated');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
		//$_POST['sSearch_0']='10/01/2015';
		//$_POST['sSearch_1']='10/02/2015';
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
        $where = "D.language_id = ".$this->session->userdata('app_language')." AND D.dub_status != '2' AND D.record_type = '1' AND D.isdub_moderate = '0'".$daterange;
        $data = $this->common_model->getTable($aColumns, $where,'dub_id');
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
				$row[1] =$aRow['name'];
				$row[2] =$aRow['dubclip_title'];
				$path = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['thumb_filename'];
                $row[3] = "<img src='$path' width='50' height='auto' class='test'>";
				
				$apath = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['dubclip_filename'];
				$row[4]  = "<video width='50' height='auto' class='test' poster='{$path}' controls><source src='$apath' type='video/mp4'></video>";
				
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[5] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[5] = '';
                }
				$row[6] = $aRow['datecreated'];
                $row[0] = $i;
                $i = $i + 1;
                $status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = '<i class="icongreen icon-ok" title="Active"></i>';
					$link = '<a href="' . base_url() . 'moderator/users/updatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><i class="iconred icon-remove" title="Inactive"></i></a>&nbsp;';
                //} else if ($status == 0 || $status == '' || $status == "NULL") {
				} else  {
                    $statusn = '<i class="iconred icon-remove" title="Inactive"></i>';
					$link = '<a href="' . base_url() . 'moderator/users/updatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><i class="icongreen icon-ok" title="Active"></i></a>&nbsp;';
                }
                $row[7] = $statusn;
                
                //$row[] = '<a href="' . base_url() . 'moderator/users/updatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;'
                   $row[] = $link.'<a href="' . base_url() . 'moderator/users/update/' . $aRow['dub_id'] . '"><i class="iconred icon-pencil" title="Edit"></i></a>&nbsp;&nbsp;'
                        . '<a href="' . base_url() . 'moderator/users/rejectdub/' . $aRow['dub_id'] . '"><i class="iconred icon-thumbs-down" title="Reject"></i></a>';
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
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate','D.thumb_filename','D.dubclip_filename','D.clip_length','D.datecreated');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
        $where = "D.language_id = ".$this->session->userdata('app_language')." AND D.dub_status != '2' AND D.record_type = '2' AND D.isdub_moderate = '0'".$daterange;
        //$where = "D.dub_status != '2' AND D.record_type = '2' AND D.isdub_moderate = '0'".$daterange;
	    $data = $this->common_model->getTable($aColumns, $where,'dub_id');
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
				//$path = "http://sprintmedia.s3.amazonaws.com/dubs/" . $aRow['thumb_filename'];
               // $row[3] = "<img src='$path' width='50' height='auto' class='test'>";
                $row[3]='<div class="tric test"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'"  width="50" height="auto"><div class="redo"><b>'.$aRow['clip_length'].' S'.'</b></div></div>'; 
				 
				//$apath = "http://sprintmedia.s3.amazonaws.com/dubs/" . $aRow['dubclip_filename'];
				//$row[4]  = "<audio width='50' height='auto' controls><source src='$apath'></audio>";
                                $row[4] = '<i class="iconred fa fa-play-circle-o play-content" title="Play"  data-media="'.$aRow['dubclip_filename'].'"></i>';
				
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[5] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[5] = '';
                }
                $row[0] = $i;
                $i = $i + 1;
				$row[6] = $aRow['datecreated'];
                $status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = '<i class="icongreen icon-ok" title="Active"></i>';
					$link = '<a href="' . base_url() . 'moderator/users/updaterecstatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><i class="iconred icon-remove" title="Inactive"></i></a>&nbsp;';
                //} else if ($status == 0 || $status == '' || $status == "NULL") {
				} else {
                    $statusn = '<i class="iconred icon-remove" title="Inactive"></i>';
					$link = '<a href="' . base_url() . 'moderator/users/updaterecstatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><i class="icongreen icon-ok" title="Active"></i></a>&nbsp;';
                }
                $row[7] = $statusn;

                //$row[8] = '<a href="' . base_url() . 'moderator/users/updaterecstatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;'
                   $row[8] = $link.'<a href="' . base_url() . 'moderator/users/recordupdate/' . $aRow['dub_id'] . '"><i class="iconred icon-pencil" title="Edit"></i></a>'
                        . '<a href="' . base_url() . 'moderator/users/moverecord/' . $aRow['dub_id'] . '"><i class="iconred icon-move" title="Move"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;'. '<a href="' . base_url() . 'moderator/users/rejectrecord/' . $aRow['dub_id'] . '"><i class="iconred icon-thumbs-down" title="Reject"></i></a>';
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
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate','D.thumb_filename','D.dubclip_filename','D.datecreated');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
       	$where = "D.language_id = ".$this->session->userdata('app_language')." AND D.dub_status = '2' AND D.record_type = '1'  AND D.isdub_moderate = '0'".$daterange;
        $data = $this->common_model->getTable($aColumns, $where,'dub_id');
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
				$path = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['thumb_filename'];
                $row[3] = "<img src='$path' width='50' height='auto' class='test'>";
				
				$apath = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['dubclip_filename'];
				$row[4]  = "<video width='50' height='auto' class='test' poster='{$path}' controls><source src='$apath' type='video/mp4'></video>";
				
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[5] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[5] = '';
                }
				$row[6] = $aRow['datecreated'];
                $row[0] = $i;
                $i = $i + 1;
               
               	$row[7] = '<a href="' . base_url() . 'moderator/users/dubdelupdate/' . $aRow['dub_id'] . '"><i class="iconred icon-pencil" title="Edit"></i></a>&nbsp;&nbsp;';
//                        . '<a href="' . base_url() . 'moderator/users/movedeldub/' . $aRow['dub_id'] . '"><button class="btn" title="move" style="border:1px solid #cccccc;">Move</button></a>';
                $output['aaData'][] = $row;
        }
    } 
        if(!empty($_POST['sSearch_1'])){
			$output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
    private function s3upload($filepath, $type)
    {

        $this->load->library('s3');
        $file1 = $this->s3->inputFile($filepath);
        $fil1 = explode('/', $file1['file']);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        $ff = explode('.', $fp1);
        return $jpg = $this->s3->putObject($file1, 'sprintmediasg', "$type/$fp1");
    }
    
    public function getNData() { //echo "hello";
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate','D.thumb_filename','D.dubclip_filename','D.clip_length','D.datecreated');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
           $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
        $where = "D.language_id = ".$this->session->userdata('app_language')." AND D.dub_status = '2' AND D.record_type = '2' AND D.isdub_moderate = '0'".$daterange;
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
                //$path = "http://sprintmedia.s3.amazonaws.com/dubs/" . $aRow['thumb_filename'];
                //$row[3] = "<img src='$path' width='50' height='auto' class='test'>";
		$row[3]='<div class="tric test"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'"  width="50" height="auto"><div class="redo"><b>'.$aRow['clip_length'].' S'.'</b></div></div>'; 		
				//$apath = "http://sprintmedia.s3.amazonaws.com/dubs/" . $aRow['dubclip_filename'];
				//$row[4]  = "<audio width='50' height='auto'  controls><source src='$apath' ></audio>";
				$row[4] = '<i class="iconred fa fa-play-circle-o play-content" title="Play"  data-media="'.$aRow['dubclip_filename'].'"></i>';
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[5] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[5] = '';
                }
				$row[6] = $aRow['datecreated'];
                $row[0] = $i;
                $i = $i + 1;
               
               	$row[7] = '<a href="' . base_url() . 'moderator/users/dubdelrecupdate/' . $aRow['dub_id'] . '"><i class="iconred icon-pencil" title="Edit"></i></a>&nbsp;&nbsp;';
//                        . '<a href="' . base_url() . 'moderator/users/movedelrecord/' . $aRow['dub_id'] . '"><button class="btn" title="move" style="border:1px solid #cccccc;">Move</button></a>';
                $output['aaData'][] = $row;
        }
    } 
        if(!empty($_POST['sSearch'])){
			$output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }

    public function ugc(){
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }
	public function ugcupdatestatus($id, $status) {
        
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $where = array('dub_id' => $id);
        $this->common_model->initialise('userdubs');
        $this->common_model->array = array('dub_status' => $statusn);
        $result_update = $this->common_model->update($where);
		if($result_update == 0){
            $this->setFlashmessage('success', 'Updated Successfully');
            redirect(base_url() . "moderator/users/ugc");
            }
    }
	

    public function getUData(){
        $aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate','D.thumb_filename','D.dubclip_filename','D.datecreated');
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $daterange = "";
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
            $daterange = " AND (DATE_FORMAT(D.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' AND '".$_POST['sSearch_1']."')";
        }
        $where = "D.dub_status != '2' AND D.record_type = '1' AND D.isdub_moderate = '1' AND D.moderatedby = ".$this->session->userdata('app_language').$daterange;
        //$where = "D.dub_status != '2' AND D.record_type = '1' AND D.isdub_moderate = '1'".$daterange;
		$data = $this->common_model->getTable($aColumns, $where,'dub_id');
        $output = $data['output'];
        //print_r($output); exit;
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['record_type'] == 1 && $aRow['isdub_moderate'] == 1) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                unset($aColumns[6]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'D.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];

                }
				$path = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['thumb_filename'];
                $row[3] = "<img src='$path' width='50' height='auto' class='test'>";
				
				$apath = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['dubclip_filename'];
				$row[4]  = "<video width='50' height='auto' class='test' poster='{$path}' controls><source src='$apath' type='video/mp4'></video>";
				
                if(!empty($aRow['moderatedby'])){
                    $this->common_model->initialise('users');
                    $row[5] = $this->common_model->get_record_single(array('id' => $aRow['moderatedby']), 'name')->name;
                }else{
                    $row[5] = '';
                }
                $row[0] = $i;
                $i = $i + 1;
				$row[6] =  $aRow['datecreated'];
                $status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = '<i class="icongreen icon-ok" title="Active"></i>';
					$link = '<a href="' . base_url() . 'moderator/users/ugcupdatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><i class="iconred icon-remove" title="Inactive"></i></a>&nbsp;';
                    //} else if ($status == 0 || $status == '' || $status == "NULL") {
                } else {
                   	$statusn = '<i class="iconred icon-remove" title="Inactive"></i>';
					$link = '<a href="' . base_url() . 'moderator/users/ugcupdatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><i class="icongreen icon-ok" title="Active"></i></a>&nbsp;';
                }
                $row[7] = $statusn;
				 //$row[] = '<a href="' . base_url() . 'moderator/users/ugcupdatestatus/' . $aRow['dub_id'] . '/' . $aRow['dub_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;';
                $row[] = $link;
				$output['aaData'][] = $row;
            }
        }
        if(!empty($_POST['sSearch'])){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);

    }
    
     public function rejectdub($id){
        $where = array('dub_id' => $id);
        $this->common_model->initialise('userdubs');
        $this->common_model->array = array('dub_status' => 2);
        $result_update=$this->common_model->update($where);
        if($result_update == 0){
            $this->setFlashmessage('success', 'Rejected  Successfully');
            redirect(base_url() . "moderator/users/dubbedusers");
            }
    }
    public function rejectrecord($id){
        $where = array('dub_id' => $id);
        $this->common_model->initialise('userdubs');
        $this->common_model->array = array('dub_status' => 2);
        $result_update=$this->common_model->update($where);
        if($result_update == 0){
            $this->setFlashmessage('success', 'Rejected  Successfully');
            redirect(base_url() . "moderator/users/records");
            }
    }

}//class
