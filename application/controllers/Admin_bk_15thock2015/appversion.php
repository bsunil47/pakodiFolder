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
class Appversion extends My_Controller {

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
        $this->common_model->initialise('app_version');
        $data['appversion'] = $this->common_model->get_records(0, '*', 0,'id');
        $this->layout->view($this->view_dir, $data);
    }
	
	public function add() {
        $data = array();
	    $this->load->library('form_validation');
        $this->form_validation->set_rules('ostype', 'OS Type', 'required');
        $this->form_validation->set_rules('appversion', 'App Version', 'required');
        
        // set messages
        $this->form_validation->set_message('required', '%s should not be empty');
        
        if (isset($_POST['submit'])) {
           

           if ($this->form_validation->run() == FALSE) {

             $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('os_type' => $this->input->post('ostype'),'app_version' => $this->input->post('appversion'),'status' => 1,'datecreated' => date("Y-m-d"));
				
                $this->common_model->initialise('app_version');
                $this->common_model->array = $data;
                $type=$data['os_type'];
                $idval=$this->common_model->insert_entry();
                if($idval){
                  $this->common_model->initialise('app_version');
                  $this->common_model->array = array('status' => 0);
                   $where = "os_type ='".$type."' AND id NOT IN ($idval)";
                  //$where = "os_type ='".$type."' AND id!='".$idval."'";
                  $update = $this->common_model->update($where);
                  $this->setFlashmessage('success', 'App Version added successfully');
                  redirect(base_url() . "Admin/appversion");
                }else{
                  $this->setFlashmessage('error', 'Please Try again');    
                  redirect(base_url() . "Admin/appversion/add");
                }
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
	
	public function update($id) {
        $data = array();
		     $this->load->library('form_validation');
             $this->form_validation->set_rules('os_type', 'OS Type', 'required');
             $this->form_validation->set_rules('app_version', 'App version', 'required');
        // set messages
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('app_version');
        $data['appversion'] = $this->common_model->get_record_single(array('id' => $id), '*');
  
//update query
        if (!empty($_POST)) {
			 

        if ($this->form_validation->run() == FALSE) {
         

            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        } else {
            $data = $_POST;
           // print_r($data);
            $data['status']=1;
            $data['datecreated']=date('Y-m-d');
            unset($data['submit']);
            $this->common_model->initialise('app_version');
            $this->common_model->array = $data;
          
            $where = array('id' => $id);
            $result_update = $this->common_model->update($where);
            $data['appversion'] = $this->common_model->get_record_single(array('id' => $id), '*');
            
            if($result_update==0){
                
               $type=$data['os_type'];
              $this->common_model->initialise('app_version');
              $this->common_model->array = array('status' => 0);
              $where = "os_type ='".$type."' AND id NOT IN ($id)";
              $update = $this->common_model->update($where);  
            }
            
            $this->session->set_flashdata('getmsg', 'App Version updated successfully');
            redirect(base_url() . "Admin/appversion");
          }
		}
        $this->layout->view($this->view_dir, $data);
    }
	
}
