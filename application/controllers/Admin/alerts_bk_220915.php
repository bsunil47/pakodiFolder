<?php

header("Content-type: text/html; charset=UTF-8");
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
class Alerts extends My_Controller {

    private $view_dir;
    private $admin_base_url;
    

    public function __construct() {

        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('forgotpassword');
        if (!in_array($this->router->fetch_method(), $allowed_urls) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
        if($this->session->userdata['user_type'] == 3){
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
        $this->layout->view($this->view_dir, $data);
    }
    public function add() {
         $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
       if(isset($_POST['submit'])) {//print_r($_POST);exit;
            if ($this->form_validation->run('addalert') == FALSE) { //echo "error";exit;
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else {echo "hi";exit;
                $data=array('alert_id'=>  strtotime(date('Y-m-d H:i:s')),'device_type' => $this->input->post('dtype'),'message' => $this->input->post('msg'),'user_id' => $this->session->userdata['user_id']);
                $this->common_model->initialise('alerts');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                $id = $this->db->insert_id();
                if(!empty($id)){
               $this->setFlashmessage('success', 'Alert added successfully');
                redirect(base_url() . "Admin/alerts/");
                }else{
                $this->setFlashmessage('error', 'Please Try again');    
                redirect(base_url() . "Admin/alerts/add");
                }
       }
       }
        $this->layout->view($this->view_dir, $data);
    }
    public function getData() { //echo "I am in getdata method";exit;

        $device_type = "";
        if(!empty($_POST['sSearch_0'])){
            $device_type = " AND A.device_type =".$_POST['sSearch_0'];
        }
        //print_r($_POST[sSearch_0]); exit;
        //$id='2';
        $aColumns = array('A.alert_id','A.device_type','A.message','A.users','U.name','A.datecreated');
        $this->common_model->initialise('alerts as A');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "A.user_id = U.id";
        $where =  $device_type;

        $data = $this->common_model->getTable($aColumns, $where, $col = 'A.datecreated', $order = 'desc');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
               $row = array();
                foreach ($aColumns as $col) {
                    $col = trim($col, 'A.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];
                }
                $row[0] = $i;
                $i = $i + 1;
                if ($aRow['device_type'] == 2) {
                    $row[1]  = "Both";
                    //$row[4]  = "<audio src='../audio/veer-lovetone167.mp3' controls ></audio>";
                } else if ($aRow['device_type'] == 1) {
                    $row[1]  = "Andriod";
                }else if($aRow['device_type'] == 3){
                     $row[1]  = "IOS";
                }
                $output['aaData'][] = $row;
           
        }
        // echo $output;exit;
        echo json_encode($output);
    }

}

