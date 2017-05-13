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
 * Description of Settings
 *
 * @author xxxxxxxxxxxxx
 */
class Settings extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('forgotpassword','index','add','edit');
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
        $this->common_model->initialise('settings');
        $data['settings'] = $this->common_model->get_records(0, '*', 0);
        $this->layout->view($this->view_dir, $data);
    }
	
	public function add() {
        $data = array();
	    $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('page_limit', 'Page Limit', 'required');
        $this->form_validation->set_rules('number_of_records', 'Number of Records', 'required');
        // set messages
        $this->form_validation->set_message('required', '%s should not be empty');
        
        if (isset($_POST['submit'])) {
           

           if ($this->form_validation->run() == FALSE) {

             $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('name' => $this->input->post('name'),'page_limit' => $this->input->post('page_limit'),'number_of_records' => $this->input->post('number_of_records'));
				
                $this->common_model->initialise('settings');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                $this->session->set_flashdata('getmsg', 'Settings added successfully');
                redirect(base_url() . "Admin/settings");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
	
	public function update($id) {
        $data = array();
	$this->load->library('form_validation');
        $this->form_validation->set_rules('page_limit', 'Page Limit', 'required');
        $this->form_validation->set_rules('number_of_records', 'Number of Records', 'required');
        // set messages
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('settings');
        $data['settings'] = $this->common_model->get_record_single(array('id' => $id), '*');
        //update query
        if (!empty($_POST)) {
			 

        if ($this->form_validation->run() == FALSE) {

            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        } else {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('settings');
            $this->common_model->array = $data;
            $where = array('id' => $id);
            $result_update = $this->common_model->update($where);
            $data['settings'] = $this->common_model->get_record_single(array('id' => $id), '*');
	    //$this->session->set_flashdata('getmsg', 'Settings updated successfully');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Settings Updated Successfully');
            redirect(base_url() . "Admin/settings");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/settings/update");
            }
          }
		}
        $this->layout->view($this->view_dir, $data);
    }
	
}
