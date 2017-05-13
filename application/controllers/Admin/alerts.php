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
//        $this->common_model->initialise('content as C');
//        $this->common_model->join_tables="master_content as MC";
//        $this->common_model->join_on = "MC.master_content_id = C.master_content_id";
//        $data['get']=$this->common_model->get_records(0, 'C.master_content_id,C.content_id,title,C.unique_code,MC.thumb_filename,MC.contentclip_filename,C.main_artist', "C.language_id = '1'", '', 'desc', '');
        if(isset($_POST['submit'])) {//print_r($_POST);exit;
            if ($this->form_validation->run('addalert') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else {
                if(!empty($_FILES)){
               $temp = explode(".", $_FILES["img"]["name"]);
               $target_file = 'Gen'.strtotime(date("Y-m-d H:i:s")). '.' . end($temp);
               $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                    $target_dir = FCPATH . "appimages/";
                    //$file_f = $_FILES["img"]["name"];
                    $file_new = move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir . '/' . $target_file);
                    $this->s3upload($target_dir . '/' . $target_file, "appimages");
                    //$data=array('alert_id' => strtotime(date('Y-m-d H:i:s')),'device_type' => $this->input->post('dtype'),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'image' => $target_file,'user_id' => $this->session->userdata['user_id'],'push_time' => $this->input->post('push_time'));
                    $data['image'] = $target_file;
                    
                }else{
                     $this->setFlashmessage('error', 'Please Upload images only');
                }
            }
                $data=array('alert_id' => strtotime(date('Y-m-d H:i:s')),'device_type' => $this->input->post('dtype'),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'user_id' => $this->session->userdata['user_id'],'push_time' => $this->input->post('push_time'));
                $device_type = $this->input->post('dtype');
                $push_time= $this->input->post('push_time');
                $this->common_model->initialise('alerts');
                $where = "DATE(push_time) = DATE('{$push_time}') AND (device_type = 0 OR device_type = $device_type)";
                $count= $this->common_model->get_records(0, '*', $where);
                // $id = $this->db->insert_id();
                if(count($count) < 2){
                    unset($data['language']);
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
			$row[3] = '<img src="http://sprintmediasg.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'"  class="test" width="50" height="50">';
               $row[4] = "<audio src='http://sprintmediasg.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."' class='test' width='50' height='50' controls ></audio>";
			 //$row[4] =  "<audio src='http://sprintmedia.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."' class='test' width='50' height='50' controls ></audio>";
            $row[5] = $aRow['name'];
            $row[6] = $aRow['push_time'];
            $time1=  strtotime($row[6]);
            $time2= strtotime(date('Y-m-d H:i:s'));
            $diff=$time1-$time2;
            $edit='';
            if($diff > 15 && $row[6] != "0000-00-00 00:00:00"){
                $edit='<a href="' . base_url() . 'Admin/alerts/editalert/' . $aRow['alert_id'] .'" title="Edit"><i class="iconred icon-pencil" title="Edit"></i></a>';
            }
            $row[7] = $edit.'&nbsp;&nbsp;'.'<a href="' . base_url() . 'Admin/alerts/deletealert/' . $aRow['alert_id'] .'"><i class="iconred icon-trash" title="Delete">';
            $output['aaData'][] = $row;

        }
         //echo $output;
         //exit;
        echo json_encode($output);
    }
    
    public function getAData(){
        $data=array();
        $wheree = "";
        if(!empty($_POST['sSearch_0'])){
        $where = " AND (C.title like '%".$_POST['sSearch_0']."%' or C.unique_code like '%".$_POST['sSearch_0']."%' or C.main_artist like '%".$_POST['sSearch_0']."%')";
        }
        $aColumns = array('C.master_content_id','C.content_id','title','C.unique_code','MC.thumb_filename','MC.contentclip_filename','C.main_artist');
        $this->common_model->initialise('content as C');
        $this->common_model->join_tables="master_content as MC";
        $this->common_model->join_on = "MC.master_content_id = C.master_content_id";
         $where =  "C.language_id = '1' ".$wheree;
        $data = $this->common_model->getTable($aColumns, $where, $col = 'C.datecreated', $order = 'desc');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'C.');
                $col = trim($col, 'MC.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = $aRow['title'];
            $row[2] = $aRow['unique_code'];
            $row[3] = '<img src="http://sprintmediasg.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'"   width="50" height="50">';
            $row[4] = "<audio src='http://sprintmediasg.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."'  width='50' height='50' controls ></audio>";
            $row[5] = $aRow['main_artist'];
            $row_title= $aRow['title'];
            $row[6]="<input type='radio' name='content' onchange='getval({$aRow['master_content_id']},{$aRow['content_id']},this.value)' value='$row_title' />";
            $output['aaData'][] = $row;

        }
         //echo $output;
         //exit;
        echo json_encode($output);
    }

    public function autocomplete()
    {//print_r($_POST['term']);exit;
        $data=array();
        $this->common_model->initialise('content as C');
        $this->common_model->join_tables="master_content as MC";
        $this->common_model->join_on = "MC.master_content_id = C.master_content_id";
        $get=$this->common_model->get_records(0, 'C.master_content_id,C.content_id,title,C.unique_code,MC.thumb_filename,MC.contentclip_filename,C.main_artist', "C.language_id = '".$_POST['lan']."' and (C.title like '%".$_POST['term']."%' or C.unique_code like '%".$_POST['term']."%' or C.main_artist like '%".$_POST['term']."%') ", '', 'desc', '');
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
                if(!empty($_FILES)){
               $temp = explode(".", $_FILES["img"]["name"]);
               $target_file = 'bir'.strtotime(date("Y-m-d H:i:s")). '.' . end($temp);
               $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                    $target_dir = FCPATH . "appimages/";
                    //$file_f = $_FILES["img"]["name"];
                    $file_new = move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir . '/' . $target_file);
                    $this->s3upload($target_dir . '/' . $target_file, "appimages");
                     $data=array('id'=>  strtotime(date('Y-m-d H:i:s')),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'image' => $target_file  );
                }else{
                     $this->setFlashmessage('error', 'Please Upload images only');
                }
            }else{               
                $data=array('id'=>  strtotime(date('Y-m-d H:i:s')),'message' => $this->input->post('msg'),'language_id' => $this->input->post('language_id'),'master_content_id' => $this->input->post('masterid'),'content_id' => $this->input->post('contentid'),'artist'=>$this->input->post('artist'),'content_type' => $this->input->post('type'));
            }
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

    public function getBData1()
    {

        $aColumns = array('id','message','M.contentclip_filename','B.content_type','B.artist','B.datecreated');
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
            $row[1]=$aRow['message'];
            $row[2]="<audio src='http://sprintmediasg.s3.amazonaws.com/audios/".$aRow['contentclip_filename']."'  controls class='test' ></audio>";
//            $row[3]="<img src='http://sprintmediasg.s3.amazonaws.com/appimages/".$aRow['image']."' width='50' height='auto'/>";
            $row[3]=$aRow['content_type'];
            $row[4]=$aRow['artist'];
            $row[5]=$aRow['datecreated'];
            $row[6] = '<a href="' . base_url() . 'Admin/alerts/editbalert/' . $aRow['id'] .'"><i class="iconred icon-pencil" title="Edit">';
            $output['aaData'][] = $row;

        }
        // echo $output;exit;
        echo json_encode($output);
    }
    
     public function getBData()
    {

        $aColumns = array('id','message','contentclip_filename','image');
        $this->common_model->initialise('birthday_wishes');
        //$this->common_model->join_tables = 'master_content as M';
      //  $this->common_model->join_on = "B.master_content_id = M.master_content_id";
        $where =  '';
        $data = $this->common_model->getTable($aColumns, $where, $col = 'datecreated', $order = 'desc');
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
            $row[1]=$aRow['message'];
            $row[3]="<audio src='http://sprintmediasg.s3.amazonaws.com/birthday/".$aRow['contentclip_filename']."'  controls class='test' ></audio>";
            $row[2]="<img src='http://sprintmediasg.s3.amazonaws.com/birthday/".$aRow['image']."' class='test' width='50' height='auto'/>";
           // $row[3]=$aRow['content_type'];
           // $row[4]=$aRow['artist'];
           // $row[5]=$aRow['datecreated'];
            $row[4] = '<a href="' . base_url() . 'Admin/alerts/editbalert/' . $aRow['id'] .'"><i class="iconred icon-pencil" title="Edit">';
            $output['aaData'][] = $row;

        }
        // echo $output;exit;
        echo json_encode($output);
    }
    
    public function editbalert(){
        $data = array();
        $this->common_model->initialise('birthday_wishes');
        $data['balert']=$this->common_model->get_record_single("id = 1",'*');
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        if(isset($_POST['submit'])) {
            if ($this->form_validation->run('editbalert') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else {
                $id=$this->input->post('id');
                $data['message'] = $this->input->post('msg');
                 if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                    $target_file_img = basename($_FILES['img']["name"]);
                    $imageFileType = pathinfo($target_file_img, PATHINFO_EXTENSION);
                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                        $target_dir = FCPATH . "birthday/";
                        $file_f = $_FILES["img"]["name"];
                        move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir . '/' . $file_f);
                        $this->s3upload($target_dir.'/'.$file_f, "birthday");
                        $data['image'] = $_FILES["img"]["name"];
                    } else {
                        $this->setFlashmessage('error', 'Please Upload Image files only');
                    }
                }//image
                if (is_uploaded_file($_FILES['clip']['tmp_name'])) {
                    $target_file_media = basename($_FILES['clip']["name"]);
                    $mediaFileType = pathinfo($target_file_media, PATHINFO_EXTENSION);
                    $file_f = $_FILES["clip"]["name"];
                   if ($mediaFileType == "mp3" || $mediaFileType == "MP3" || $mediaFileType == "aac" || $mediaFileType == "AAC" ) {
                        $target_dir = FCPATH . "birthday/";
                        move_uploaded_file($_FILES["clip"]["tmp_name"], $target_dir . '/' . $file_f);
                         $this->s3upload($target_dir.'/'.$file_f, "birthday");
                        $data['contentclip_filename'] = $file_f;
                    } else {
                        $this->setFlashmessage('error', 'Please Upload audio/video files only');
                    }
                }//audio 
                unset($data['balert']);
                $this->common_model->initialise('birthday_wishes');
                $this->common_model->array = $data;
                $where = array('id' => $id);
                $result_update = $this->common_model->update($where);
                if($result_update == 0){
                    $this->setFlashmessage('success', 'Birth day Alert Updated Successfully');
                     redirect(base_url() . "Admin/alerts/editbalert");
                 }else{
                    $this->setFlashmessage('error', 'Please Try again');  
                 }
             }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function bautocomplete()
    {//print_r($_POST['term']);exit;
        $data=array();
        $this->common_model->initialise('content as C');
        $this->common_model->join_tables = array('languages as L','master_content as MC');
        $this->common_model->join_on = array("C.language_id = L.lang_id","C.master_content_id = MC.master_content_id");
        $get=$this->common_model->get_records(0, 'C.master_content_id,C.content_id,C.title,C.unique_code,MC.thumb_filename,MC.contentclip_filename,C.main_artist,L.language', "(C.language_id = '".$_POST['lan']."' or C.language_id = '1') and (C.main_artist like '%".$_POST['term']."%') and MC.category_id = '11' ", '', 'desc', '');
        $data=$get;
        echo json_encode($data);
    }
    
    public function bdautocomplete()
    {//print_r($_POST['term']);exit;
        $data=array();
        $this->common_model->initialise('content as C');
        $this->common_model->join_tables = array('languages as L','master_content as MC');
        $this->common_model->join_on = array("C.language_id = L.lang_id","C.master_content_id = MC.master_content_id");
        $get=$this->common_model->get_records(0, 'C.master_content_id,C.content_id,C.title,C.unique_code,MC.thumb_filename,MC.contentclip_filename,C.main_artist,L.language', "C.language_id = '".$_POST['lan']."'  and MC.category_id = '11' ", '', 'desc', '');
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
        //$this->layout->setLayout('blank.php');
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
                    redirect(base_url() . "Admin/alerts/editalert/$id");
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
   
   public function commonusers()
{
    $data = array();
    $this->common_model->initialise('common_users');
    $data['result']=$this->common_model->get_records(0,'*','');
    $this->layout->view($this->view_dir, $data);
}

public function addusers(){
        //$this->layout->setLayout('blank.php');
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        if(isset($_POST['submit'])) {
//          if ($this->form_validation->run('addcuser') == FALSE) {
//                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
//            }else {
                if(!empty($_FILES)){
               $target_file = basename($_FILES['clip']["name"]);
                $clipFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if ($clipFileType == "mp3" || $imageFileType == "MP3" || $clipFileType == "aac" || $clipFileType == "AAC" ){
                    $target_dir = FCPATH . "birthday/";
                   $file_new = move_uploaded_file($_FILES["clip"]["tmp_name"], $target_dir . '/' . $target_file);
                    $this->s3upload($target_dir . '/' . $target_file, "birthday");
                     $data=array('name' => $this->input->post('name'),'clip_filename' => $target_file);
                }}else{
                     $this->setFlashmessage('error', 'Please Upload mp3 or aac files  only');
                }
               $this->common_model->initialise('common_users');
                $this->common_model->array = $data;
                $id=$this->common_model->insert_entry();
                if($id!=NULL){
                    $this->setFlashmessage('success', 'Common user Content  added successfully');
                    redirect(base_url() . "Admin/alerts/commonusers");
                }else{
                    $this->setFlashmessage('error', 'Please Try again');
                    //redirect(base_url() . "Admin/alerts/add");
                }
            }
            if(isset($_POST['esubmit'])){
                if(!empty($_FILES)){
        $target_dir = FCPATH . "zipfiles/";
        $target_file = $target_dir . basename($_FILES["zip"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
           if ($imageFileType != "zip") {
                $return_data = ['status' => 0, 'unique_code' => 'NO ZIP FILE'];
                //echo "Not a zip file";exit;
            } else {
                if (move_uploaded_file($_FILES["zip"]["tmp_name"], $target_file)) {
                    $fileinfo = pathinfo($target_dir . $_FILES["zip"]["name"]);
                    try {
                        $data = $this->zipfileProcessing($_FILES["zip"]["name"], $fileinfo,'userclips');
                        if (!$this->data_mining_flag && $this->endofrows == 0) {
                            $data =array("result"=> "Row until this $this->data_unique_code unique code is uploaded. Rectify the issues on this row and below and try again");
                        } else {
                            $data = array('result'=>'Successfully uploaded');
                            $rm_dir = $target_dir . $fileinfo['filename'] . "/media";
                            exec("rm -rf $rm_dir");
                            $res=$data['result'];
                    $this->setFlashmessage('success', $res);
                    redirect(base_url() . "Admin/alerts/commonusers");
                        }
                    } catch (Exception $ex) {
                        $data['result'] = "something went wrong try again later";
                    }
                } else {
                    $data['result'] = "Sorry, there was an error uploading your file.";
                          $res=$data['result'];
                    $this->setFlashmessage('success', $res);
                }
            }
           }else{
               $data['result'] = "Please Upload Zip File";
                     $res=$data['result'];
                    $this->setFlashmessage('success', $res);
           }
        }
        $this->layout->view($this->view_dir, $data); 
}

 public function artistclips()
{
    $data = array();
    $this->common_model->initialise('artist_clips');
    $data['result']=$this->common_model->get_records(0,'*','');
    $this->layout->view($this->view_dir, $data);
}

public function addartistclip(){
        //$this->layout->setLayout('blank.php');
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        if(isset($_POST['submit'])) {
//          if ($this->form_validation->run('addcuser') == FALSE) {
//                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
//            }else {
                if(!empty($_FILES)){
               $target_file = basename($_FILES['clip']["name"]);
                $clipFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if ($clipFileType == "mp3" || $imageFileType == "MP3" || $clipFileType == "aac" || $clipFileType == "AAC" ){
                    $target_dir = FCPATH . "birthday/";
                   $file_new = move_uploaded_file($_FILES["clip"]["tmp_name"], $target_dir . '/' . $target_file);
                    $this->s3upload($target_dir . '/' . $target_file, "birthday");
                     $data=array('name' => $this->input->post('name'),'clip_filename' => $target_file);
                }}else{
                     $this->setFlashmessage('error', 'Please Upload mp3 or aac files  only');
                }
               $this->common_model->initialise('artist_clips');
                $this->common_model->array = $data;
                $id=$this->common_model->insert_entry();
                if($id!=NULL){
                    $this->setFlashmessage('success', 'Artist clip  added successfully');
                    redirect(base_url() . "Admin/alerts/artistclips");
                }else{
                    $this->setFlashmessage('error', 'Please Try again');
                    //redirect(base_url() . "Admin/alerts/add");
                }
            }
            if(isset($_POST['esubmit'])){
               $target_dir = FCPATH . "zipfiles/";
        $target_file = $target_dir . basename($_FILES["zip"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              if ($imageFileType != "zip") {
                $return_data = ['status' => 0, 'unique_code' => 'NO ZIP FILE'];
                //echo "Not a zip file";exit;
            } else {
                if (move_uploaded_file($_FILES["zip"]["tmp_name"], $target_file)) {
                    $fileinfo = pathinfo($target_dir . $_FILES["zip"]["name"]);
                    try {
                        $data = $this->zipfileProcessing($_FILES["zip"]["name"], $fileinfo,'artistclips');
                        if (!$this->data_mining_flag && $this->endofrows == 0) {
                            $data =array("result"=> "Row until this $this->data_unique_code unique code is uploaded. Rectify the issues on this row and below and try again");
                        } else {
                            $data = array('result'=>'Successfully uploaded');
                            $rm_dir = $target_dir . $fileinfo['filename'] . "/media";
                            exec("rm -rf $rm_dir");
                        }
                    } catch (Exception $ex) {
                        $data['result'] = "something went wrong try again later";
                    }
                } else {
                    $data['result'] = "Sorry, there was an error uploading your file.";
                }
            }
        
            }
            
       // }
        $this->layout->view($this->view_dir, $data); 
}
//userclips excel start
   
private function zipfileProcessing($zipfile, $fileInfo,$type) {
        $pa = $targett_dir = FCPATH . "zipfiles/";
        $target_dir = $targett_dir . date('Y-m-d') . "/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (copy($targett_dir . $fileInfo['basename'], $target_dir . $fileInfo['basename'])) {
            unlink($targett_dir . $fileInfo['basename']);
            $zip = new ZipArchive;
            $res = $zip->open($target_dir . $fileInfo['basename']);
            if ($res === TRUE) {
                $zip->extractTo($target_dir);
                $zip->close();
                chmod($target_dir . $fileInfo['filename'], 0777);
                $file_csv = scandir($target_dir . $fileInfo['filename']);
                //print_r($file_csv);exit;
                foreach ($file_csv as $key => $value) {
                    $fileInfor = pathinfo($target_dir . $fileInfo['filename'] . '/' . $value);
                    //print_r($fileInfor);exit;
                    if (is_file($target_dir . $fileInfo['filename'] . '/' . $value) && ($fileInfor['extension'] == 'xlsx' || $fileInfor['extension'] == 'xls')) {
                        $this->load->library('excel');
                        $inputFileType = PHPExcel_IOFactory::identify($target_dir . $fileInfo['filename'] . "/" . $value);

                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                        $objReader->setReadDataOnly(true);

                        /**  Load $inputFileName to a PHPExcel Object  * */
                        $objPHPExcel = $objReader->load($target_dir . $fileInfo['filename'] . "/" . $value);
                        $total_sheets = $objPHPExcel->getSheetCount();
                        $allSheetName = $objPHPExcel->getSheetNames();
                        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                        $highestRow = $objWorksheet->getHighestRow();
                        $highestColumn = $objWorksheet->getHighestColumn();
                        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

                        for ($row = 2; $row <= $highestRow; ++$row) {
                            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                $value1 = $objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                                $arraydata[$row - 1][$col] = $value1;
                                $rowdata[$col] = $value1;
                            }
                            //echo '<pre>'; print_r($rowdata); exit;
                            if (isset($rowdata[1]) && isset($rowdata[2])  && is_file($target_dir . $fileInfo['filename'] . "/media/". $rowdata[2])) {
                                //echo "testing";exit;
                                 $target_file = $target_dir . $fileInfo['filename'] . "/media/" . $rowdata[2];
                                    $path_parts = pathinfo($target_file);
                                 $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $rowdata[2], 'birthday');
                              $userclips_array = array( 'name'=> $rowdata[1], 'clip_filename' => $rowdata[2]);
                               $user_clips_id = $this->insert_userclips_content($userclips_array,$type);
                                 
                            } else {
                                $this->data_mining_flag = 0;
                                $this->data_unique_code = $rowdata[2];
                                if(empty($rowdata[1]) && empty($rowdata[2])){
                                    $this->endofrows = 1;
                                }
                                return "Please Check the mandatory feilds in excel is set or not,click on download excel for sample";
                            }
                        }

                        if (isset($user_clips_id)) {
                            unlink($target_dir . $fileInfo['basename']);

                            return "Clips Added Sucessfully";
                        } else {
                            return "Please Check the mandatory feilds in excel is set or not,click on download excel for sample";

                        }
                    }

                }
            } else {
                return FALSE;
            }
        }
    }
    private function insert_userclips_content($data,$type) {
        if($type == 'userclips'){
        $this->common_model->initialise('common_users');
        }else if($type == 'artistclips') {
            $this->common_model->initialise('artist_clips');
        }
        $this->common_model->array = $data;
        $insert = $this->common_model->insert_entry();
        return $insert;
    }
	
//userclips excel end


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
   

}
