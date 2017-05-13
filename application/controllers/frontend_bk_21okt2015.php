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
 * Description of frontend
 *
 * @author Kesav
 */
class Frontend extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct() {
        //echo $this->session->userdata['user_type']; exit;
        //$allowed_methodes = array('index', 'changepassword', 'content','createjob','changepassword','terms');
		$allowed_methodes = array('index', 'forgotpassword', 'forgot_changepassword','logout','changepassword','profile');
        parent::__construct();

        if (!in_array($this->router->fetch_method(), $allowed_methodes) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }

            if (!in_array($this->router->fetch_method(), $allowed_methodes) && isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] <= 1) {
                $this->admin_base_url = base_url() . 'Admin';
                redirect($this->admin_base_url . '/users/dashboard');
            } elseif (!in_array($this->router->fetch_method(), $allowed_methodes) && !empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 3) {
                $this->admin_base_url = base_url() . 'moderator';
                redirect($this->admin_base_url . '/users/dashboard');
            } elseif (!in_array($this->router->fetch_method(), $allowed_methodes) && !empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 4) {
                redirect(base_url() . 'content/index');
            }
            $not_allow = true;
            if ($this->router->fetch_method() == 'changepassword' || $this->router->fetch_method() == 'profile' || $this->router->fetch_method() == 'logout') {
                $not_allow = false;
            }
            if (isset($this->session->userdata['user_type']) && $not_allow) {
                if ($this->session->userdata['user_type'] <= 1) {
                    $this->admin_base_url = base_url() . 'Admin';
                    redirect($this->admin_base_url . '/users/dashboard');
                } elseif ($this->session->userdata['user_type'] == 3) {
                    $this->admin_base_url = base_url() . 'moderator';
                    redirect($this->admin_base_url . '/users/dashboard');
                } elseif ($this->session->userdata['user_type'] == 4) {
                    redirect(base_url() . 'content/index');
                }
            }


        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('main.php');
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
                    $result_s = $this->common_model->get_record_single(array('user_id' => $result->id), '*');
                    if (!empty($result_s)) {
                        $this->session->set_userdata('user_id', $result->id);
                        $this->session->set_userdata('name', $result->name);
                        $this->session->set_userdata('msisdn', $result->msisdn);
                        $this->session->set_userdata('email', $result->email);
                        $this->session->set_userdata('user_type', $result_s->user_type);
                        $this->session->set_userdata('profile_picture', $result->profile_picture);
                        $this->session->set_userdata('app_language', $result->app_language);
                        if($result_s->user_type <= 1){
                            $this->admin_base_url = base_url() . 'Admin';
                            redirect($this->admin_base_url . '/users/dashboard');
                        }elseif($result_s->user_type == 3){
                            $this->admin_base_url = base_url() . 'moderator';
                            redirect($this->admin_base_url . '/users/dashboard');
                        }else{
                            redirect(base_url() . 'content/index');
                        }

                    } else {
                        $this->setFlashmessage('error', 'Not able to login');
                        redirect(base_url());
                    }
                } else {
                    $this->setFlashmessage('error', 'Invalid Username or Password');
                    redirect(base_url());
                }
            }
        }
        $this->layout->setLayout('contentowner_login');
        $this->layout->view($this->view_dir, $data);
    }
	public function changepassword() {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('opassword', 'Old Password', 'required|trim|xss_clean|callback_change');
        $this->form_validation->set_rules('npassword', 'New Password', 'required|trim|regex_match[/^(?=.*?\pL)(?=.*?\pN)(?=.*[!@#$%^&*])/]|trim|min_length[5]|max_length[32]');
        //$this->form_validation->set_rules('npassword', 'New Password', 'required|trim');
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
                redirect(base_url() . "frontend/changepassword");
            }
        }
        $this->layout->setLayout('content_main.php');
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
                    if($this->communication_model->send_recover_code(array('email' => $_POST['email'], 'message' => $code, 'name' => $user_record->name, 'path' => 'frontend'))){
                        $this->setFlashmessage('success', 'Successfully sent forgot password link to your mail');
                    }
                } else {
                    $this->setFlashmessage('error', 'Not registered with us');
                }
                redirect(base_url().'frontend/forgotpassword');
            } 
        }
        $this->layout->setLayout('contentowner_login.php');
        $this->layout->view($this->view_dir, $data);
    }
	public function forgot_changepassword($id, $path) {
        $data = array();
        $data['hashcode'] = $id;
        $data['path'] = $path;
        $this->load->library('form_validation');
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('forgottochange') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $this->common_model->initialise('hashurl');
                $data_array = $this->common_model->get_record_single(array('hashcode' => $id), '*');
                if (empty($data_array)) {
                show_404();
                } else if ($data_array->status == 1) {
                    $this->setFlashmessage('error', 'Already used this link');
                } else {
                    $this->common_model->initialise('users');
                    $this->common_model->array = array('password' => md5($_POST['password']));
                if (!$this->common_model->update(array('id' => $data_array->user_id))) {
                    $this->setFlashmessage('success', 'Password Changed Successfully');
                    $this->common_model->initialise('hashurl');
                    $this->common_model->array = array('status' => 1);
                    $this->common_model->update(array('hashcode' => $id));
                }
                }
                redirect(base_url().'frontend/forgot_changepassword/'.$id.'/'.$path);
            }
            
        }
        $this->layout->setLayout('contentowner_login');
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
                        if(move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dir . '/' . $file_f)){
                            $this->s3upload($target_dir.'/'.$file_f, "userimages");
                            $input_fields['profile_picture'] = $_FILES["filen"]["name"];
                        }else{
                            echo 'ada'; exit;
                            $this->setFlashmessage('error', 'Failed upload try again');
                        }

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
           redirect(base_url() . "frontend/profile");
		   }
		$this->layout->setLayout('content_main.php');
        $this->layout->view($this->view_dir, $data);
    }
	public function terms(){
        $data = array();
        $this->common_model->initialise('cms');
        $data['data'] = $this->common_model->get_record_single(array('page_id' => 2), '*');
        $this->layout->setLayout('password');
        $this->layout->view($this->view_dir, $data);
    }
   public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('msisdn');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('profile_picture');
        $this->session->sess_destroy();
        redirect($this->admin_base_url);
        }
	private function s3upload($filepath, $type)
    {

        $this->load->library('s3');
        $file1 = $this->s3->inputFile($filepath);
        $fil1 = explode('/', $file1['file']);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        $ff = explode('.', $fp1);
        return $this->s3->putObject($file1, 'sprintmedia', "$type/$fp1");
    }

}