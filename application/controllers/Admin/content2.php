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
class Content extends My_Controller {

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
        /*$this->common_model->initialise('content');
        $data['content'] = $this->common_model->get_records(0, '*', 0);*/
        $this->layout->view($this->view_dir, $data);
    }
    public function add() {
        $data = array();
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_records(0, '*', array('status' => 1));
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');

        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('addcontent') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('title' => $this->input->post('title'), 'content_type' => $this->input->post('content_type'));
                $this->common_model->initialise('content');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                //$id = $this->db->insert_id();
                //$data_usertype = array('content_id' => $this->db->insert_id());
                redirect(base_url() . "Admin/content");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function update($id) {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        
        $this->common_model->initialise('categories');
        //$where = array('status' => 1);
        $data['category'] = $this->common_model->get_records(0, '*', 0);
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        
        $this->common_model->initialise('content');
        $data['content'] = $this->common_model->get_record_single(array('content_id' => $id), '*');
        if($data['content']->content_activationdate != '0000-00-00' && $data['content']->content_activationdate != NULL){
            $actdate = new DateTime($data['content']->content_activationdate);
            $data['content']->content_activationdate = $actdate->format('m/d/Y');
        }
        if($data['content']->content_expirydate != '0000-00-00' && $data['content']->content_expirydate != NULL){
            $expdate = new DateTime($data['content']->content_expirydate);
            $data['content']->content_expirydate = $expdate->format('m/d/Y');
        }
        //update query
        if (!empty($_POST)) {
            if ($this->form_validation->run('updatecontent') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else{
            $data = $_POST;
            unset($data['content_type']);
            
            if($data['content_activationdate'] != '0000-00-00' && $data['content_activationdate'] != NULL){
                $dt = new DateTime($data['content_activationdate']);
                $data['content_activationdate'] = $dt->format('Y-m-d');
            }
            if($data['content_expirydate'] != '0000-00-00' && $data['content_expirydate'] != NULL){
                $dts = new DateTime($data['content_expirydate']);
                $data['content_expirydate'] = $dts->format('Y-m-d');
            }
            if(is_uploaded_file($_FILES['filen']['tmp_name']))
            {
	        $target_file_img = basename($_FILES['filen']["name"]);
		$imageFileType = pathinfo($target_file_img, PATHINFO_EXTENSION);
                
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF" )
                {
                    $target_dir = FCPATH . "appimages/";
		    $file_f = $_FILES["filen"]["name"];
		    move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dir.'/'.$file_f); 
                    $data['thumb_filename'] = $_FILES["filen"]["name"];                    
                }else{
                    $this->setFlashmessage('error', 'Please Upload Image files only');
		}
            }//image
            if(is_uploaded_file($_FILES['file1']['tmp_name']))
            {
                $data['content_type'] = $_POST['content_type'];
                
                $target_file_media = basename($_FILES['file1']["name"]);
                $mediaFileType = pathinfo($target_file_media, PATHINFO_EXTENSION);
                $file_f = $_FILES["file1"]["name"];
                
                if($data['content_type'] == 1 && $mediaFileType == "mp4")
                {
                    $target_dir = FCPATH . "videos/";
		    move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir.'/'.$file_f); 
                    $data['contentclip_filename'] = $file_f;                    
                }else if($data['content_type'] == '0' && $mediaFileType == "mp3"){
                    $target_dir = FCPATH . "audios/";
		    move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir.'/'.$file_f); 
                    $data['contentclip_filename'] = $file_f;                    
		}else{
                    $this->setFlashmessage('error', 'Please Upload audio/video files only');
		}
            }//audio or video
            //echo "<pre>"; print_r($data); exit;
            unset($data['submit']);
            $this->common_model->initialise('content');
            $this->common_model->array = $data;
            $where = array('content_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['conent'] = $this->common_model->get_record_single(array('content_id' => $id), '*');
            redirect(base_url() . "Admin/content");
            }//validation   
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function view($id) {
        $data = array();
        $this->common_model->initialise('content');
        $data['content'] = $this->common_model->get_record_single(array('content_id' => $id), '*');
        //category
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_record_single(array('cat_id' => $data['content']->category_id), 'category')->category;
        //language
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_record_single(array('lang_id' => $data['content']->language_id), 'language')->language;
        
        
        if($data['content']->content_activationdate != '0000-00-00' && $data['content']->content_activationdate != NULL){
            $actdate = new DateTime($data['content']->content_activationdate);
            $data['content']->content_activationdate = $actdate->format('F jS Y');
        }
        if($data['content']->content_expirydate != '0000-00-00' && $data['content']->content_expirydate != NULL){
            $expdate = new DateTime($data['content']->content_expirydate);
            $data['content']->content_expirydate = $expdate->format('F jS Y');
        }
        $this->layout->view($this->view_dir, $data);
    }

    public function contentstatus($id, $status) {
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = $statusn;
        $this->common_model->initialise('content');
        $this->common_model->array = array('content_status' => $data);
        $where = array('content_id' => $id);
        $this->common_model->update($where);
        redirect(base_url() . "Admin/content");
    }
    public function recommend() {
        $data = array();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->common_model->initialise('recommends');
        
        
        //update query
        if (!empty($_POST['submit'])) {
            if ($this->form_validation->run('updaterecommend') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->session->set_userdata('recommend_value', $_POST['recommend_value']);
                $this->session->set_userdata('trending_value', $_POST['trending_value']);
            }else{
            $data = $_POST;
            //echo "<pre>"; print_r($data); exit;
            unset($data['submit']);
            $this->common_model->initialise('recommends');
            $data['dateupdated'] = date('Y-m-d H:i:s');
            $this->common_model->array = $data;
            $where = array('rec_id' => 1);
            $result_update = $this->common_model->update($where);
            //$data['recommend'] = $this->common_model->get_record_single(array('rec_id' => 1), '*');
            redirect(base_url() . "Admin/content/recommend");
            }//validation   
        }else{
            if (!empty($_POST['reset'])) {
                $this->session->unset_userdata('recommend_value');
                $this->session->unset_userdata('trending_value');
            }else{
                $data['recommend'] = $this->common_model->get_record_single(array('rec_id' => 1), '*');
                $this->session->set_userdata('recommend_value', $data['recommend']->recommend_value);
                $this->session->set_userdata('trending_value', $data['recommend']->trending_value);
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function getData() { //echo "I am in getdata method";
        $aColumns = array('content_id', 'title', 'content_activationdate', 'content_expirydate', 'content_status');
        $this->common_model->initialise('content');
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
            $row[2] = '-';
            if($aRow['content_activationdate']!= '0000-00-00' && $aRow['content_activationdate']!= NULL){
                $actdate = new DateTime($aRow['content_activationdate']);
                $row[2] = $actdate->format('M jS Y');
            }
            $row[3] = '-';
            if($aRow['content_expirydate']!= '0000-00-00' && $aRow['content_expirydate']!= NULL){
                $expdate = new DateTime($aRow['content_expirydate']);
                $row[3] = $expdate->format('M jS Y');
            }
            $status = $aRow['content_status'];
            if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                } else if ($status == 0 || $status == '' || $status == "NULL") {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                }

            $row[4] = $statusn;

            $row[] = '<a href="' . base_url() . 'Admin/content/contentstatus/' . $aRow['content_id'] . '/' . $aRow['content_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/update/' . $aRow['content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">Edit</button></a>'
                    . '&nbsp;&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/view/' . $aRow['content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">View</button></a>';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
}
