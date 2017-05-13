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
        $allowed_urls = array('forgotpassword','testnotifications','autocomplete');
     //echo !$this->_is_home_logged_in(); echo !in_array($this->router->fetch_method(), $allowed_urls); exit;
        if (!in_array($this->router->fetch_method(), $allowed_urls) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
        if(!empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 3){
            $this->admin_base_url = base_url() . 'moderator';
            redirect($this->admin_base_url . '/users/dashboard');
        }elseif(!empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 4){
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
                $data=array('alert_id' => strtotime(date('Y-m-d H:i:s')),'device_type' => $this->input->post('dtype'),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'user_id' => $this->session->userdata['user_id'],'push_time' => $this->input->post('push_time'));
                $device_type = $this->input->post('dtype');
                $push_time= $this->input->post('push_time');
                $this->common_model->initialise('alerts');
                $where = "DATE(push_time) = DATE('{$push_time}') AND (device_type = 0 OR device_type = $device_type)";
                $count= $this->common_model->get_records(0, '*', $where);



                // $id = $this->db->insert_id();
                if(count($count) < 2){
                    $this->common_model->array = $data;
                    $id=$this->common_model->insert_entry();
                    //echo $this->input->post('dtype');
                    unset($data['alert_id']);
                    //$this->send_not($this->input->post('dtype'),$this->input->post('msg'),$this->input->post('masterid'),$this->input->post('contentid'));
                    //$this->send_not($data);
//exit;
                    $this->setFlashmessage('success', 'Alert added successfully');
                    redirect(base_url() . "Admin/alerts");
                }elseif(count($count) >= 2){
                    unset($_POST);
                    $this->setFlashmessage('error', 'Already added 2 message for this device type and selected date');
                    redirect(base_url() . "Admin/alerts/add");
                }else{
                    unset($_POST);
                    $this->setFlashmessage('error', 'Please Try again');
                    redirect(base_url() . "Admin/alerts/add");
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
        $this->common_model->initialise('master_content');
        $unique_code=$this->common_model->get_record_single(array('master_content_id' => $data['master_content_id']), '*');
        $this->common_model->initialise('pushnotifications as P');
        $this->common_model->join_tables=array('users as U');
        $this->common_model->join_on=array('P.user_id = U.id');
        if(!empty($data->device_type)){
            $where = array('P.device_type' => $data['device_type'],'app_language'=>$data['language_id'], 'P.updatedon <>' => '0000-00-00 00:00:00');
        }else{
            $where = array('device_type <>' => 0,'app_language'=>$data['language_id'], 'P.updatedon <>' => '0000-00-00 00:00:00');
        }
        $result=$this->common_model->get_records(0, '*', $where,'P.updatedon','DESC','P.device_id');
        $url_to_save = "log/" . date('Y') . '/' . date('m');
        if (!is_dir(FCPATH . $url_to_save)) {
            mkdir(FCPATH . $url_to_save, 0777, true);
            chmod(FCPATH . $url_to_save, 0777);
        }
        $fp = fopen(FCPATH . $url_to_save . "/push_log_file.csv", 'a');
        foreach($result as $key=> $values){
            $values->device_token;
            $custom_message=array('master_content_id'=>$data['master_content_id'],'content_id'=>$data['content_id'],'unique_code' => $unique_code->unique_code );
            $device_token = $values->device_token;
            $message = $data['message'];
            $device_type = $values->device_type;
            $datal=array($values->user_id,$data['message'],date('Y-m-d H:i:s'));
            fputcsv($fp, $datal);
            $this->send_push_notification($device_token,$message,$device_type,$custom_message);
            //$this->send_push_notification($values->device_token,$data['message'],$values->device_type,$custom_message);
        }
        fclose($fp);
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
        $aColumns = array('A.alert_id','A.device_type','A.message','MC.thumb_filename','MC.contentclip_filename','A.users','U.name','A.push_time');
        $this->common_model->initialise('alerts as A');
        $this->common_model->join_tables = array('users as U','master_content as MC');
        $this->common_model->join_on = array("A.user_id = U.id","A.master_content_id = MC.master_content_id");
        $this->common_model->left_join = array('left','left');
        $where =  $device_type;
        $data = $this->common_model->getTable($aColumns, $where, $col = 'A.datecreated', $order = 'desc');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'A.');
                $col = trim($col, 'MC.');
                $col = trim($col, 'U.');

                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            if ($aRow['device_type'] == 0) {
                $row[1]  = "Both";
                //$row[4]  = "<audio src='../audio/veer-lovetone167.mp3' controls ></audio>";
            } else if ($aRow['device_type'] == 2) {
                $row[1]  = "Andriod";
            }else if($aRow['device_type'] == 1){
                $row[1]  = "IOS";
            }
            $row[2]=$aRow['message'];
            //$row[3] = '<img src="http://sprintmedia.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'"  class="test" width="120" height="80">';
			$row[3] = '<img src="http://sprintmedia.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'"  class="test" width="50" height="auto">';
               $row[4] = "<audio src='http://sprintmedia.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."'  width='50' height='auto' controls ></audio>";
			 //$row[4] =  "<audio src='http://sprintmedia.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."' class='test' width='50' height='50' controls ></audio>";
            $row[5] = $aRow['name'];
            $row[6] = $aRow['push_time'];
            $time1=  strtotime($row[6]);
            $time2= strtotime(date('Y-m-d H:i:s'));
            $diff=$time1-$time2;
            $edit='';
            if($diff > 15 && $row[6] != "0000-00-00 00:00:00"){
                $edit='<a href="' . base_url() . 'Admin/alerts/editalert/' . $aRow['alert_id'] .'"><i class="iconred icon-pencil" title="Edit"></i>';
            }
            $row[7] = $edit.'&nbsp;&nbsp;'.'<a href="' . base_url() . 'Admin/alerts/deletealert/' . $aRow['alert_id'] .'"><i class="iconred icon-trash" title="Delete"></i>';
            $output['aaData'][] = $row;

        }
         //echo $output;
         //exit;
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
                $data=array('id'=>  strtotime(date('Y-m-d H:i:s')),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'));
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
        $this->common_model->join_on = "B.master_content_id = M.master_content_id";
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
            $row[] = '<a href="' . base_url() . 'Admin/alerts/deletebalert/' . $aRow['id'] .'"><i class="iconred icon-trash" title="Delete">';
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
            $this->common_model->initialise('master_content');
            $unique_code=$this->common_model->get_record_single(array('master_content_id' => $masterid), '*');
            if(!empty($masterid) && !empty($contetid)){
                $custom_message = array('master_content_id' => $masterid,'content_id' => $contetid,'unique_code' => $unique_code->unique_code);
            }else{
                $custom_message = '';
            }
            $device_token = $this->input->post('device_token');
            $message = $this->input->post('message');
            $device_type = $this->input->post('device_type');
            $this->send_push_notification($device_token,$message,$device_type,$custom_message);
            $this->setFlashmessage('success', 'Alert added successfully');
            //redirect(base_url() . "Admin/alerts");
        }else{
            $this->setFlashmessage('error', 'Please Try again');
            //redirect(base_url() . "Admin/alerts/add");
        }


        $this->layout->view($this->view_dir, $data);
    }

    public function editalert($id){
        $data= array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        $data['alert'] = $this->getalert($id);
        if(isset($_POST['submit'])) {
            if ($this->form_validation->run('addalert') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else {
                $data=array('device_type' => $this->input->post('dtype'),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'user_id' => $this->session->userdata['user_id'],'push_time' => $this->input->post('push_time'));
                $device_type = $this->input->post('dtype');
                $push_time= $this->input->post('push_time');
                $this->common_model->initialise('alerts');
                $where = "DATE(push_time) = DATE('{$push_time}') AND (device_type = 0 OR device_type = $device_type) AND alert_id <> $id";
                $count= $this->common_model->get_records(0, '*', $where);
                $this->common_model->array = $data;
                $where = "alert_id = '$id'";
                $idd=$this->common_model->update($where);
                if($idd == FALSE && count($count) < 2){
                    $this->setFlashmessage('success', 'Alert Updated successfully');
                    redirect(base_url() . "Admin/alerts");
                }elseif(count($count) >= 2){
                    unset($_POST);
                    $this->setFlashmessage('error', 'Already have 2 message for this device type and selected date');
                    redirect(base_url() . "Admin/editalert/$id");
                }else{
                    unset($_POST);
                    $this->setFlashmessage('error', 'Please Try again');
                    redirect(base_url() . "Admin/alerts/editalert/$id");
                }
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    private function getalert($id){
        $this->common_model->initialise('alerts as A');
        $this->common_model->join_tables="master_content as MC";
        $this->common_model->join_on="A.master_content_id = MC.master_content_id";
        $where=array("A.alert_id" => $id);
        $select="A.*,MC.thumb_filename,MC.contentclip_filename";
        return $this->common_model->get_record_single($where,$select);
    }

}
