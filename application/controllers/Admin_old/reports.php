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
 * Description of reports
 *
 * @author xxxxxxxxxxxxx
 */
class Reports extends My_Controller {

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
        $this->common_model->initialise('reports as R');
        $this->common_model->join_tables = "users as U";
        $this->common_model->join_on = "U.id = R.user_id";
        $data['reports'] = $this->common_model->get_records(0, '*','','report_id');
        $this->layout->view($this->view_dir, $data);
    }
	 public function sendmail($id)
	{ 
            $data = array();
            $this->load->model('communication_model');
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', '%s should not be empty');
            $this->common_model->initialise('reports');
            $data['report'] = $this->common_model->get_record_single(array('report_id' => $id), '*');
            $this->common_model->initialise('users');
            $data['user'] = $this->common_model->get_record_single(array('id' => $data['report']->user_id), 'email,name');
            
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('sendmail') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $this->communication_model->send_mail($data['user']->email);
                $this->setFlashmessage('success','Mail sent Successfully');
                redirect(base_url() . "Admin/reports");
            }
        }
        $this->layout->view($this->view_dir, $data);
	}
}//class
