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
 * @author xxxxxxxxxxxxx
 */
class Languages extends My_Controller {

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
        $this->common_model->initialise('languages');
        //$data['categories'] = $this->common_model->get_records(0, '*', array('status' => 1));
        $data['language'] = $this->common_model->get_records(0, '*', 0);
        $this->layout->view($this->view_dir, $data);
    }
    
   public function add() {
       $this->layout->setLayout('blank.php');
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');

        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('languages') == FALSE) {

                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('language' => $this->input->post('language'));
                $this->common_model->initialise('languages');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                $id = $this->db->insert_id();
                $data_usertype = array('lang_id' => $this->db->insert_id());
                redirect(base_url() . "Admin/languages");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function update($id) {
        $this->layout->setLayout('blank.php');
        //echo "ssss";
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_record_single(array('lang_id' => $id), '*');
        //update query
        if (!empty($_POST)) {
            if ($this->form_validation->run('languages') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('languages');
            $this->common_model->array = $data;
            $where = array('lang_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['language'] = $this->common_model->get_record_single(array('lang_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Language updated successfully');
            echo json_encode(['code' => 200,'url' => base_url() . "Admin/languages"]);exit;
           // redirect(base_url() . "Admin/languages");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/languages/update");
            }
        }
        }
        $this->layout->view($this->view_dir, $data);
    }
      public function languagestatus($id, $status) {
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = $statusn;
        $this->common_model->initialise('languages');
        $this->common_model->status = $data;
        $where = array('lang_id' => $id);
        $this->common_model->set_status($where);
        redirect(base_url() . "Admin/languages");
    }
    public function getData() {
        $aColumns = array('lang_id', 'language',  'datecreated');
        $this->common_model->initialise('languages');
        //$where = array('status' => 1);
        $where = 0;
        
        $data = $this->common_model->getTable($aColumns, $where);
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                //$col = trim($col, 'OFR.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;

            $row[] = '<span class="open-div" data-url="' . base_url() . 'Admin/languages/update/' . $aRow['lang_id'] . '" title="Edit"><i class="iconred icon-pencil" title="Edit"></i></span>';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
}