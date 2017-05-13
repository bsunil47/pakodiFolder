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
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
       if(isset($_POST['submit'])) {//print_r($_POST);exit;
            if ($this->form_validation->run('addalert') == FALSE) { 
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else {
                $data=array('alert_id'=>  strtotime(date('Y-m-d H:i:s')),'device_type' => $this->input->post('dtype'),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'user_id' => $this->session->userdata['user_id']);
                $this->common_model->initialise('alerts');
                $this->common_model->array = $data;
                $id=$this->common_model->insert_entry();

              // $id = $this->db->insert_id();
                 if($id!=NULL){
                    //echo $this->input->post('dtype');
                     unset($data['alert_id']);
                   // $this->send_not($this->input->post('dtype'),$this->input->post('msg'),$this->input->post('masterid'),$this->input->post('contentid'));
                     $this->send_not($data);
//exit;
                    $this->setFlashmessage('success', 'Alert added successfully');
                    redirect(base_url() . "Admin/alerts");
                }else{
                    $this->setFlashmessage('error', 'Please Try again');
                    //redirect(base_url() . "Admin/alerts/add");
                }
       }
       }
        $this->layout->view($this->view_dir, $data);
    }

//    private function send_not($type,$message,$master_content_id,$content_id){
//        $this->common_model->initialise('pushnotifications');
//        $custom_message=array('master_content_id' =>$master_content_id,'content_id' => $content_id);
//        if(!empty($type)){
//            $where = array('device_type' => $type);
//        }else{
//            $where = array('device_type <>' => 0);
//        }
//        $result=$this->common_model->get_records(100, '*', $where,'datecreated','DESC','device_token');
//
//        foreach($result as $key=> $values){
//            echo $values->device_type; echo '</br>';
//            $this->send_push_notification($values->device_token,$message,$values->device_type,$custom_message);
//        }
//        return true;
//
//    }
    
    private function send_not($data){
        $this->common_model->initialise('pushnotifications as P');
        $this->common_model->join_tables=array('users as U');
        $this->common_model->join_on=array('P.user_id = U.id');
        if(!empty($data->device_type)){
            $where = array('P.device_type' => $data->device_type,'app_language'=>$data->language_id);
        }else{
           $where = array('device_type <>' => 0,'app_language'=>$data->language_id);
        }
        $result=$this->common_model->get_records(100, '*', $where,'P.datecreated','DESC','P.device_token');
        foreach($result as $key=> $values){
            echo $values->device_type; echo '</br>';
            $custom_message=array('master_content_id'=>$data->master_content_id,'content_id'=>$data->content_id);
            $this->send_push_notification($values->device_token,$data->message,$values->device_type,$custom_message);
        }
        return true;
    }
    
    public function deletealert($id){
        $this->common_model->initialise('alerts');
        $this->common_model->array=array('alert_id' => $id);
        $id=$this->common_model->delete_record();
       if($id==TRUE){
               $this->setFlashmessage('success', 'Alert Deleted  successfully');
                redirect(base_url() . "Admin/alerts/");
                }else{
                $this->setFlashmessage('error', 'Please Try again');    
                redirect(base_url() . "Admin/alerts");
                }
    }
    public function getData() { //echo "I am in getdata method";exit;

        $device_type = "";
        
        if(!empty($_POST['sSearch_0'])){
            if($_POST['sSearch_0']==2){
                 $device_type = "";
            }else{
            $device_type = "A.device_type = '".$_POST['sSearch_0']."'";}
        }
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
                $row[] = '<a href="' . base_url() . 'Admin/alerts/deletealert/' . $aRow['alert_id'] .'"><button class="btn pakodi" title="delete" style="border:1px solid #cccccc;">Delete</button>';
                $output['aaData'][] = $row;
           
        }
        // echo $output;exit;
        echo json_encode($output);
    }
    
    public function autocomplete()
    {//print_r($_POST['term']);exit;
        $data=array();
        $this->common_model->initialise('content');
        $get=$this->common_model->get_records(0, 'master_content_id,content_id,title,unique_code,main_artist', "language_id = '".$_POST['lan']."' and (title like '%".$_POST['term']."%' or unique_code like '%".$_POST['term']."%' or main_artist like '%".$_POST['term']."%') ", '', 'desc', '');
        $data=$get;
        echo json_encode($data);
    }
    
    public function birthdayalerts()
    {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }
    public function addbirthdayalert()
    {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
       if(isset($_POST['submit'])) {//print_r($_POST);exit;
            if ($this->form_validation->run('addbalert') == FALSE) { 
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           }else {
                $data=array('id'=>  strtotime(date('Y-m-d H:i:s')),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'default_master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'));
                $this->common_model->initialise('birthday_wishes');
                $this->common_model->array = $data;
                $id=$this->common_model->insert_entry();
             //  $id = $this->db->insert_id();
                if($id!=NULL){
                   // echo $this->input->post('dtype');
                   // $this->send_not($this->input->post('dtype'),$this->input->post('msg'));
                    //exit;
                    $this->setFlashmessage('success', 'Alert added successfully');
                    redirect(base_url() . "Admin/alerts/birthdayalerts");
                }else{
                    $this->setFlashmessage('error', 'Please Try again');
                    //redirect(base_url() . "Admin/alerts/add");
                }
       }
       }
        $this->layout->view($this->view_dir, $data);
    }
    
    public function getBData()
    {
        
        $aColumns = array('id','message','M.contentclip_filename','B.datecreated');
        $this->common_model->initialise('birthday_wishes B');
        $this->common_model->join_tables = 'master_content as M';
        $this->common_model->join_on = "B.default_master_content_id = M.master_content_id";
        $where =  '';
        $data = $this->common_model->getTable($aColumns, $where, $col = 'B.datecreated', $order = 'desc');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
               $row = array();
                foreach ($aColumns as $col) {
                   $col = trim($col, 'M.');
                    $col = trim($col, 'B.');
                   $row[] = $aRow[$col];
                }
                $row[0] = $i;
                $i = $i + 1;
                $row[2]="<audio src='http://sprintmedia.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."'  controls ></audio>";
                $row[] = '<a href="' . base_url() . 'Admin/alerts/deletebalert/' . $aRow['id'] .'"><button class="btn pakodi" title="delete" style="border:1px solid #cccccc;">Delete</button>';
                $output['aaData'][] = $row;
           
        }
        // echo $output;exit;
        echo json_encode($output);
    }
     public function bautocomplete()
    {//print_r($_POST['term']);exit;
        $data=array();
        $this->common_model->initialise('content as C');
        $this->common_model->join_tables = 'languages as L';
        $this->common_model->join_on = "C.language_id = L.lang_id";
        $get=$this->common_model->get_records(0, 'master_content_id,content_id,title,unique_code,main_artist,L.language', "C.language_id = '".$_POST['lan']."' and (C.title like '%".$_POST['term']."%' or C.unique_code like '%".$_POST['term']."%' ) ", '', 'desc', '');
        $data=$get;
        echo json_encode($data);
    }
     public function deletebalert($id){
        $this->common_model->initialise('birthday_wishes');
        $this->common_model->array=array('id' => $id);
        $id=$this->common_model->delete_record();
       if($id==TRUE){
               $this->setFlashmessage('success', 'Alert Deleted  successfully');
                redirect(base_url() . "Admin/alerts/birthdayalerts");
                }else{
                $this->setFlashmessage('error', 'Please Try again');    
                redirect(base_url() . "Admin/alerts/birthdayalerts");
                }
    }

    public function testnotifications()
    {
        $data = array();
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        if(isset($_POST['submit'])) {//print_r($_POST);exit;
           // if(!empty($this->input->post('masterid')) && !empty($this->input->post('contentid'))){
                //$custom_message=array("master_content_id"=>$this->input->post('masterid'),"content_id" => $this->input->post('contentid'));
          //  }else{
                $custom_message='';
          ///  }
            $masterid = $this->input->post('masterid');
            $contetid = $this->input->post('contentid');
            if(!empty($masterid) && !empty($contetid)){
                $custom_message = array('master_content_id' => $masterid,'content_id' => $contetid);
            }else{
                $custom_message = '';
            }
            $device_token = $this->input->post('device_token');
            $message = $this->input->post('message');
            $device_type = $this->input->post('device_type');
            $this->send_push_notification($device_token,$message,$device_type,$custom_message);
            $this->setFlashmessage('success', 'Alert added successfully');
            redirect(base_url() . "Admin/alerts");
        }else{
            $this->setFlashmessage('error', 'Please Try again');
            //redirect(base_url() . "Admin/alerts/add");
        }


        $this->layout->view($this->view_dir, $data);
    }

}

