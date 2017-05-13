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
 * Description of cms
 *
 * @author xxxxxxxxxxxxx
 */
class Cms extends My_Controller {

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
        //$this->common_model->initialise('cms');
        $this->common_model->initialise('cms as C');
        $this->common_model->join_tables = "languages as L";
        $this->common_model->join_on = "C.language_id = L.lang_id";
        $data['cms'] = $this->common_model->get_records(0, '*',array('cms_type' => 1));
        $this->layout->view($this->view_dir, $data);
    }
	
	public function edit($id) {
        $data = array();
        $this->common_model->initialise('cms');
        $data['cms'] = $this->common_model->get_record_single(array('page_id' => $id), '*');
        //update query
        if (!empty($_POST)) {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('cms');
            $this->common_model->array = $data;
            $where = array('page_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['cms'] = $this->common_model->get_record_single(array('page_id' => $id), '*');
           if($result_update == 0){
            $this->setFlashmessage('success', 'Aboutus Content Updated Successfully');
            redirect(base_url() . "Admin/cms");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/cms/edit");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
	public function terms() {
        $data = array();
        //$this->common_model->initialise('cms');
        $this->common_model->initialise('cms as C');
        $this->common_model->join_tables = "languages as L";
        $this->common_model->join_on = "C.language_id = L.lang_id";
        $data['cms_terms'] = $this->common_model->get_records(0, '*',array('cms_type' => 2));
        $this->layout->view($this->view_dir, $data);
    }
	
	public function termsedit($id) {
		//echo 'testing'; exit;
        $data = array();
        $this->common_model->initialise('cms');
        $data['cms_terms'] = $this->common_model->get_record_single(array('page_id' => $id), '*');
        //update query
        if (!empty($_POST)) {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('cms');
            $this->common_model->array = $data;
            $where = array('page_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['cms_terms'] = $this->common_model->get_record_single(array('page_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Terms & Conditions Content Updated Successfully');
            redirect(base_url() . "Admin/cms/terms");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/cms/termsedit");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
    
}
