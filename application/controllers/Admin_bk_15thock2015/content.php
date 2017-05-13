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
        /* $this->common_model->initialise('content');
          $data['content'] = $this->common_model->get_records(0, '*', 0); */
        $this->layout->view($this->view_dir, $data);
    }

    public function add() {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        //list of categories
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_records(0, '*', array('status' => 1));
        //list of languages
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));

        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('addcontent') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('title' => $this->input->post('title'), 'content_type' => $this->input->post('content_type'));
                $this->common_model->initialise('content');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                redirect(base_url() . "Admin/content");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }

    public function update($id) { 
        $page = $this->uri->segment(5);	
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');

        $this->common_model->initialise('categories');
        //$where = array('status' => 1);
        $data['category'] = $this->common_model->get_records(0, '*', 0,$col = 'cat_id', $order = 'asc', $groupby = 'cat_id');
        $this->common_model->initialise('languages');
        $data['language'] = $this->common_model->get_records(0, '*', array('status' => 1));
        $data['content'] = $this->getcontent($id);
        if ($data['content'][0]->content_activationdate != '0000-00-00' && $data['content'][0]->content_activationdate != NULL) {
            $actdate = new DateTime($data['content'][0]->content_activationdate);
            $data['content'][0]->content_activationdate = $actdate->format('m/d/Y');
        }
        if ($data['content'][0]->content_expirydate != '0000-00-00' && $data['content'][0]->content_expirydate != NULL) {
            $expdate = new DateTime($data['content'][0]->content_expirydate);
            $data['content'][0]->content_expirydate = $expdate->format('m/d/Y');
        }
        //update query
        if (!empty($_POST)) {//print_r($_POST);exit;
            if ($this->form_validation->run('updatecontent') == FALSE) {//echo "hi";exit;
               $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = $_POST;
                unset($data['content_type']);
                unset($data['title0']);
                unset($data['short_desc0']);
                unset($data['movie_name0']);
                unset($data['main_artist0']);
                unset($data['sub_artists0']);
                unset($data['film_director0']);
                unset($data['music_director0']);
                unset($data['dialog_writer0']);
                unset($data['cid0']);
                unset($data['title1']);
                unset($data['short_desc1']);
                unset($data['movie_name1']);
                unset($data['main_artist1']);
                unset($data['sub_artists1']);
                unset($data['film_director1']);
                unset($data['music_director1']);
                unset($data['dialog_writer1']);
                 unset($data['cid1']);
                $data_c0=array("title" => $this->input->post('title0'),"short_desc" => $this->input->post('short_desc0'),"movie_name" => $this->input->post('movie_name0'),"main_artist" => $this->input->post('main_artist0'),"sub_artists" => $this->input->post('sub_artists0'),"film_director" => $this->input->post('film_director0'),"music_director" => $this->input->post('music_director0'),"dialog_writer" => $this->input->post('dialog_writer0'));
                $data_c1=array("title" => $this->input->post('title1'),"short_desc" => $this->input->post('short_desc1'),"movie_name" => $this->input->post('movie_name1'),"main_artist" => $this->input->post('main_artist1'),"sub_artists" => $this->input->post('sub_artists1'),"film_director" => $this->input->post('film_director1'),"music_director" => $this->input->post('music_director1'),"dialog_writer" => $this->input->post('dialog_writer1'));
               if ($data['content_activationdate'] != '0000-00-00' && $data['content_activationdate'] != NULL) {
                    $dt = new DateTime($data['content_activationdate']);
                    $data['content_activationdate'] = $dt->format('Y-m-d');
                }
                if ($data['content_expirydate'] != '0000-00-00' && $data['content_expirydate'] != NULL) {
                    $dts = new DateTime($data['content_expirydate']);
                    $data['content_expirydate'] = $dts->format('Y-m-d');
                }
                if (is_uploaded_file($_FILES['filen']['tmp_name'])) {
                    $target_file_img = basename($_FILES['filen']["name"]);
                    $imageFileType = pathinfo($target_file_img, PATHINFO_EXTENSION);

                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                        $target_dir = FCPATH . "appimages/";
                        $file_f = $_FILES["filen"]["name"];
                        move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dir . '/' . $file_f);
                        $this->s3upload($target_dir.'/'.$file_f, "appimages");
                        $data['thumb_filename'] = $_FILES["filen"]["name"];
                    } else {
                        $this->setFlashmessage('error', 'Please Upload Image files only');
                    }
                }//image
                if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
                    $data['content_type'] = $_POST['content_type'];

                    $target_file_media = basename($_FILES['file1']["name"]);
                    $mediaFileType = pathinfo($target_file_media, PATHINFO_EXTENSION);
                    $file_f = $_FILES["file1"]["name"];

                    if ($data['content_type'] == 1 && ($mediaFileType == "mp4" || $mediaFileType == "aac")) {
                        $target_dir = FCPATH . "videos/";
                        move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir . '/' . $file_f);
                         $this->s3upload($target_dir.'/'.$file_f, "videos");
                        $data['contentclip_filename'] = $file_f;
                    } else if ($data['content_type'] == 2 && ($mediaFileType == "mp3" || $mediaFileType == "aac")) {
                        $target_dir = FCPATH . "audios/";
                        move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir . '/' . $file_f);
                         $this->s3upload($target_dir.'/'.$file_f, "audios");
                        $data['contentclip_filename'] = $file_f;
                    } else {
                        $this->setFlashmessage('error', 'Please Upload audio/video files only');
                    }
                }//audio or video
               // echo "<pre>"; print_r($data); exit;
                unset($data['submit']);
                $this->common_model->initialise('master_content');
                $this->common_model->array = $data;
                $where = array('master_content_id' => $id);
                $result_update = $this->common_model->update($where);
                $this->common_model->initialise('content');
                $this->common_model->array=$data_c0;
                $where0=array('master_content_id' => $id,'content_id' => $this->input->post('cid0'));
                $result_update1 = $this->common_model->update($where0);
                $this->common_model->initialise('content');
                $this->common_model->array=$data_c1;
                $where1=array('master_content_id' => $id,'content_id' => $this->input->post('cid1'));
                $result_update2 = $this->common_model->update($where1);
                if($result_update == 0 && $result_update1 == 0 && $result_update2 == 0){
                    $this->setFlashmessage('success', 'Content Updated Successfully');
                 }else{
                    $this->setFlashmessage('error', 'Please Try again');  
                 }
               // $data['conent'] = $this->getcontent($id);
                if($page!=""){
                redirect(base_url() . "Admin/content/$page");
			   }else{ 
			   redirect(base_url() . "Admin/content/");
			   }
           }//validation   
        }
        $this->layout->view($this->view_dir, $data);
    }
    private function getcontent($id)
    {
        $this->common_model->initialise('master_content as MC');
                $this->common_model->join_tables="content as C";
                $this->common_model->join_on="MC.master_content_id = C.master_content_id";
                $where=array("MC.master_content_id" => $id);
                $select="MC.*,C.content_id,C.title,C.short_desc,C.movie_name,C.main_artist,C.sub_artists,C.film_director,C.music_director,C.dialog_writer";
                return $this->common_model->get_records(0,$select,$where);
    }
    public function view($id) {
        $data = array();
        $data['content'] = $this->getcontent($id);
        //category
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_record_single(array('cat_id' => $data['content'][0]->category_id), 'category')->category;
        //language
        $this->common_model->initialise('languages');
        if($data['content'][0]->language_id==0){$lang=1;}else{$lang=$data['content'][0]->language_id;}
        $data['language'] = $this->common_model->get_record_single(array('lang_id' => $lang), 'language')->language;


        if ($data['content'][0]->content_activationdate != '0000-00-00' && $data['content'][0]->content_activationdate != NULL) {
            $actdate = new DateTime($data['content']->content_activationdate);
            $data['content'][0]->content_activationdate = $actdate->format('F jS Y');
        }
        if ($data['content'][0]->content_expirydate != '0000-00-00' && $data['content'][0]->content_expirydate != NULL) {
            $expdate = new DateTime($data['content']->content_expirydate);
            $data['content'][0]->content_expirydate = $expdate->format('F jS Y');
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
        $this->common_model->initialise('master_content');
        $this->common_model->array = array('content_status' => $data);
        $where = array('master_content_id' => $id);
       $update= $this->common_model->update($where);
       if($update==0){
           $this->setFlashmessage('success', 'Content Updated Successfully');
       }else{
           $this->setFlashmessage('error', 'Plase Try again');
       }
        redirect(base_url() . "Admin/content");
    }

    public function recommendstatus($id, $status) {
        if ($status == 2) {
            $statusn = 1;
        }
        if ($status == 1 || $status == '' || $status == "NULL") {
            $statusn = 2;
        }
        $data = $statusn;
        $this->common_model->initialise('master_content');
        $this->common_model->array = array('recommend_type' => $data);
        $where = array('master_content_id' => $id);
        $update=$this->common_model->update($where);
        if($update==0){
            $this->setFlashmessage('success', 'Content Updated Successfully');
        }else{
            $this->setFlashmessage('error', 'Please Try Again');
        }
        redirect(base_url() . "Admin/content");
    }
    
    private function s3upload($filepath, $type)
    {

        $this->load->library('s3');
        $file1 = $this->s3->inputFile($filepath);
        $fil1 = explode('/', $file1['file']);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        $ff = explode('.', $fp1);
        return $jpg = $this->s3->putObject($file1, 'sprintmedia', "$type/$fp1");
    }
    
    public function recommend() {
        $data = array();
        $this->common_model->initialise('recommends');
        $data['recommends'] = $this->common_model->get_records(0,'*',0);
        $this->layout->view($this->view_dir, $data);
    }
    
    public function recupdate($id){
        $data=array();
        $this->common_model->initialise('recommends');
        $data['recommends']= $this->common_model->get_record_single(array('rec_id' => $id), '*');
        if(!empty($_POST)){
        $data=$_POST;
        unset($data['submit']);
        $data['dateupdated'] = date('Y-m-d H:i:s');
        $this->common_model->initialise('recommends');
        if($data['recommend_value']=='recommend_sort'){
            $data['recommend_filter']='Desc';
        }
        $data_c=array('column_name' => $data['recommend_value'],'filter_interval' => $data['recommend_filter'],'dateupdated'=>$data['dateupdated']);
        $this->common_model->array = $data_c;
        $update=$this->common_model->update(array('rec_id' => $id));
        if($update == 0){
             $this->setFlashmessage('success', 'Recommends Updated Successfully');
        }else{
            $this->setFlashmessage('error', 'Please Try again');
        }
        redirect(base_url() . "Admin/content/recommend");
        }
        $this->layout->view($this->view_dir, $data);
    }
  
    public function recommend1() {
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
            } else {
                $data = $_POST;
                //echo "<pre>"; print_r($data); exit;
                unset($data['priorty']);
                unset($data['DataTables_Table_0_length']);
                unset($data['submit']);
                //$this->common_model->initialise('recommends');
                $data['dateupdated'] = date('Y-m-d H:i:s');
               // $this->common_model->array = $data;
                //$where = array('rec_id' => 1);
               // $result_update = $this->common_model->update($where);
               
		$this->common_model->initialise('recommends');
                $this->common_model->array = array('column_name' => $data['trending_value'],'filter_interval' => $data['trending_filter'],'dateupdated'=>$data['dateupdated']);
                $update=$this->common_model->update(array('rec_id' => 1));
		$this->common_model->array = array('column_name' => $data['recommend_value'],'filter_interval' => $data['recommend_filter'],'dateupdated'=>$data['dateupdated']);
                $update=$this->common_model->update(array('rec_id' => 2));
		$this->common_model->array = array('column_name' => 'general','filter_interval' => $data['content_filter'],'dateupdated'=>$data['dateupdated']);
                $update=$this->common_model->update(array('rec_id' => 3));
		if($update == 0){
                    $this->setFlashmessage('success', 'Recommends Updated Successfully');
                 }else{
                    $this->setFlashmessage('error', 'Please Try again');  
                 }
                //$data['recommend'] = $this->common_model->get_record_single(array('rec_id' => 1), '*');
                redirect(base_url() . "Admin/content/recommend");
            }//validation   
        } else {
            if (!empty($_POST['reset'])) {
                //$this->session->unset_userdata('recommend_value');
                //$this->session->unset_userdata('trending_value');
            } else {
                $data['recommend'] = $this->common_model->get_record_single(array('rec_id' => 1), '*');
                $this->session->set_userdata('trending_value', $data['recommend']->column_name);
				$this->session->set_userdata('trending_filter', $data['recommend']->filter_interval);
				$data['recommend'] = $this->common_model->get_record_single(array('rec_id' => 2), '*');
                $this->session->set_userdata('recommend_value', $data['recommend']->column_name);
				$this->session->set_userdata('recommend_filter', $data['recommend']->filter_interval);
				$data['recommend'] = $this->common_model->get_record_single(array('rec_id' => 3), '*');
                $this->session->set_userdata('content_filter', $data['recommend']->filter_interval);
            }
            
        }
        $this->layout->view($this->view_dir, $data);
    }

    public function getData() { //echo "I am in getdata method";
        $aColumns = array('MC.master_content_id', 'C.title', 'MC.content_activationdate', 'MC.content_expirydate', 'MC.content_status', 'MC.recommend_type');
        $this->common_model->initialise('master_content as MC');
        $this->common_model->join_tables="content as C";
        $this->common_model->join_on="MC.master_content_id = C.master_content_id";
        $where = array("C.language_id"=>1,"MC.content_status"=>1);
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
		 $where = "DATE_FORMAT(MC.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' and '".$_POST['sSearch_1']."'";
        }
        $data = $this->common_model->getTable($aColumns, $where,'master_content_id','desc','master_content_id');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'MC.');
                 $col = trim($col, 'C.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[2] = '-';
            if ($aRow['content_activationdate'] != '0000-00-00' && $aRow['content_activationdate'] != NULL) {
                $actdate = new DateTime($aRow['content_activationdate']);
                $row[2] = $actdate->format('M jS Y');
            }
            $row[3] = '-';
            if ($aRow['content_expirydate'] != '0000-00-00' && $aRow['content_expirydate'] != NULL) {
                $expdate = new DateTime($aRow['content_expirydate']);
                $row[3] = $expdate->format('M jS Y');
            }
            $status = $aRow['content_status'];
            if ($status == 1) {
                $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
            } else if ($status == 0 || $status == '' || $status == "NULL") {
                $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
            }
            $statusr = $aRow['recommend_type'];
            if ($statusr == 2) {
                $statusrn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Rec Active</button>";
            } else if ($statusr == 1) {
                $statusrn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Rec Inactive</button>";
            }

            $row[4] = $statusn . " " . $statusrn;

            $row[5] = '<a href="' . base_url() . 'Admin/content/contentstatus/' . $aRow['master_content_id'] . '/' . $aRow['content_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/update/' . $aRow['master_content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">Edit</button></a>'
                    . '&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/view/' . $aRow['master_content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">View</button></a>&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/recommendstatus/' . $aRow['master_content_id'] . '/' . $aRow['recommend_type'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Rec Status</button></a>';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
    
    public function getData1() { //echo "I am in getdata method";
        $aColumns = array('content_id', 'title', 'content_activationdate', 'content_expirydate', 'content_status', 'recommend_type');
        $this->common_model->initialise('content');
        $where = 0;
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
		 $where = "DATE_FORMAT(datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' and '".$_POST['sSearch_1']."'";
        }
        $data = $this->common_model->getTable($aColumns, $where,$col=0,'desc','master_content_id');
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
            if ($aRow['content_activationdate'] != '0000-00-00' && $aRow['content_activationdate'] != NULL) {
                $actdate = new DateTime($aRow['content_activationdate']);
                $row[2] = $actdate->format('M jS Y');
            }
            $row[3] = '-';
            if ($aRow['content_expirydate'] != '0000-00-00' && $aRow['content_expirydate'] != NULL) {
                $expdate = new DateTime($aRow['content_expirydate']);
                $row[3] = $expdate->format('M jS Y');
            }
            $status = $aRow['content_status'];
            if ($status == 1) {
                $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
            } else if ($status == 0 || $status == '' || $status == "NULL") {
                $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
            }
            $statusr = $aRow['recommend_type'];
            if ($statusr == 2) {
                $statusrn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Rec Active</button>";
            } else if ($statusr == 1) {
                $statusrn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Rec Inactive</button>";
            }

            $row[4] = $statusn . " " . $statusrn;

            $row[5] = '<a href="' . base_url() . 'Admin/content/contentstatus/' . $aRow['content_id'] . '/' . $aRow['content_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/update/' . $aRow['content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">Edit</button></a>'
                    . '&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/view/' . $aRow['content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">View</button></a>&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/recommendstatus/' . $aRow['content_id'] . '/' . $aRow['recommend_type'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Rec Status</button></a>';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }


    public function getRData() {
        $aColumns = array('MC.master_content_id', 'C.title', 'MC.content_type', 'MC.thumb_filename', 'MC.contentclip_filename', 'MC.recommend_type', 'MC.recommend_sort');
        $this->common_model->initialise('master_content as MC');
        $this->common_model->join_tables="content as C";
        $this->common_model->join_on="MC.master_content_id = C.master_content_id";
        $where = array('MC.recommend_type' => 2);
        $data = $this->common_model->getTable($aColumns, $where,'master_content_id','desc','master_content_id');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'MC.');
                $col = trim($col, 'C.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            //$path = base_url() . "appimages/" . $aRow['thumb_filename'];
            $path = "http://sprintmedia.s3.amazonaws.com/appimages/" . $aRow['thumb_filename'];
            $row[2] = "<img src='$path' width='50' height='50'>";
            if ($aRow['content_type'] == 2) {
                $apath = "http://sprintmedia.s3.amazonaws.com/audios/" . $aRow['contentclip_filename'];
				$row[3]  = "<audio width='0' height='30' controls ><source src='$apath' type='audio/mpeg'></audio>";
            } else {
                $apath = "http://sprintmedia.s3.amazonaws.com/videos/" . $aRow['contentclip_filename'];
				$row[3]  = "<video  width='0' height='150' controls ><source src='$apath' type='video/mp4'></video>";
            }
            $row[4] = "<select name='priorty' id='priorty' onchange='changepriority(this.value,$aRow[master_content_id])'>";
              $row[4] = $row[4] . "<option value=''>-Select Priority-</option>";
            for ($p = 1; $p < 16; $p++) {
                if ($aRow['recommend_sort'] == $p) {
                    $row[4] = $row[4] . "<option value='$p' SELECTED >$p</option>";
                } else {
                  
                    $row[4] = $row[4] . "<option value='$p'>$p</option>";
                }
            }

            $row[4] = $row[4] . "</select>";

            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    public function setpriority(){
       $pro=$this->input->post('priority');
       $id=$this->input->post('id');
       $this->common_model->initialise('master_content');
       $cont_id=$this->common_model->get_record_single(array('recommend_sort' => $pro), 'master_content_id');
       if(!empty($cont_id)){
            $this->common_model->array = array('recommend_sort' => 0);
                $where = array('master_content_id' => $cont_id->master_content_id);
                $result_update = $this->common_model->update($where);
       }
       $this->common_model->array=array('recommend_sort' => $pro);
       $wheree=array('master_content_id' => $id);
       $update=$this->common_model->update($wheree);
       $this->common_model->initialise('recommends');
       $this->common_model->array=array('column_name' => 'recommend_sort');
       $wher=array('rec_id' =>2);
       $updatee=$this->common_model->update('$wher');
       
       if($update==FALSE){
           echo TRUE;
       }else{
           echo False;
       }
    }
    /*DEleted Content start*/
    public function deletedcontentlist(){
		$data = array();
		$this->layout->view($this->view_dir, $data);		
	}
        
    public function getMData() { //echo "I am in getdata method";
        $aColumns = array('MC.master_content_id', 'C.title', 'MC.content_activationdate', 'MC.content_expirydate', 'MC.content_status', 'MC.recommend_type');
        $this->common_model->initialise('master_content as MC');
        $this->common_model->join_tables="content as C";
        $this->common_model->join_on="MC.master_content_id = C.master_content_id";
        $where = array("C.language_id"=>1, "MC.content_status"=>2);
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
		 $where = "DATE_FORMAT(MC.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' and '".$_POST['sSearch_1']."'";
        }
        $data = $this->common_model->getTable($aColumns, $where,'master_content_id','desc','master_content_id');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'MC.');
                 $col = trim($col, 'C.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[2] = '-';
            if ($aRow['content_activationdate'] != '0000-00-00' && $aRow['content_activationdate'] != NULL) {
                $actdate = new DateTime($aRow['content_activationdate']);
                $row[2] = $actdate->format('M jS Y');
            }
            $row[3] = '-';
            if ($aRow['content_expirydate'] != '0000-00-00' && $aRow['content_expirydate'] != NULL) {
                $expdate = new DateTime($aRow['content_expirydate']);
                $row[3] = $expdate->format('M jS Y');
            }
            $status = $aRow['content_status'];
            if ($status == 2) {
                $statusn = "<button class='btn-danger' title='Active' style='border:0px solid #cccccc;'>Inactive</button>";
            } else if ($status == 1 || $status == '' || $status == "NULL") {
                $statusn = "<button class='btn-success' title='Inactive' style='border:0px solid #cccccc;'>Active</button>";
            }
            $row[4] = $statusn;

            $row[5] = '<a href="' . base_url() . 'Admin/content/delcontentstatus/' . $aRow['master_content_id'] . '/' . $aRow['content_status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/update/' . $aRow['master_content_id'] .'/deletedcontentlist'. '"><button class="btn" title="edit" style="border:1px solid #cccccc;">Edit</button></a>'
			. '&nbsp;&nbsp;<a href="' . base_url() . 'Admin/content/view/' . $aRow['master_content_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">View</button></a>';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
    /*Deleted Content End*/
   /* Content Waiting for Approval Start */
    public function waiting(){
         $data = array();
         $this->layout->view($this->view_dir, $data);
        }
    public function getWData()
    {
       $aColumns = array('U.id','U.name','count(MC.master_content_id)as count');
        $this->common_model->initialise('users as U');
        $this->common_model->join_tables=array("master_content as MC","user_types as UT");
        $this->common_model->join_on=array("MC.contentowner_id = U.id","UT.user_id = U.id");
        $where = array('UT.user_type' => 4,'MC.content_status'=>0);
        $data = $this->common_model->getTable($aColumns, $where,'id','desc','id');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'U.');
                $col = trim($col, 'MC.');
                //$row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1]=$aRow['name'];
            $row[2]=$aRow['count'];
            $row[3] = '<a href="' . base_url() . 'Admin/content/getwdetails/' . $aRow['id'].'"><button class="btn" title="status" style="border:1px solid #cccccc;">Details</button></a>';
          $output['aaData'][] = $row;
        }
        echo json_encode($output); 
    }
    public function getwdetails($id){
             $data = array();
             $data['user_id']=$id;
             $this->layout->view($this->view_dir, $data); 
    }
    
    public function getWDData(){//echo $this->input->post('id');exit;
        $aColumns = array('MC.master_content_id', 'C.title', 'MC.content_activationdate', 'MC.content_expirydate');
        $this->common_model->initialise('master_content as MC');
        $this->common_model->join_tables="content as C";
        $this->common_model->join_on="MC.master_content_id = C.master_content_id";
        $where = array("MC.contentowner_id"=>$_POST['id'],"MC.content_status"=>0);
        if(!empty($_POST['sSearch_0']) && !empty($_POST['sSearch_1'])){
		 $where = "DATE_FORMAT(MC.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' and '".$_POST['sSearch_1']."'";
        }
        $data = $this->common_model->getTable($aColumns, $where,'master_content_id','desc','master_content_id');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        $j=$this->input->get_post('iDisplayStart');
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'MC.');
                 $col = trim($col, 'C.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $j=$j+1;
            $row[2] = '-';
            if ($aRow['content_activationdate'] != '0000-00-00' && $aRow['content_activationdate'] != NULL) {
                $actdate = new DateTime($aRow['content_activationdate']);
                $row[2] = $actdate->format('M jS Y');
            }
            $row[3] = '-';
            if ($aRow['content_expirydate'] != '0000-00-00' && $aRow['content_expirydate'] != NULL) {
                $expdate = new DateTime($aRow['content_expirydate']);
                $row[3] = $expdate->format('M jS Y');
            }
            $row[4] = '<input type="checkbox" class="checkbox_s" onclick="chk(this)" name="approve[]" id="ch'.$j.'" value="'. $aRow['master_content_id'] .'">';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
    
    public function waitapprove(){
       $content_id=json_decode($this->input->post('content'));
       $content_id=implode(',',$content_id);
       $this->common_model->initialise('master_content');
       $wheree="master_content_id in($content_id)";
       $this->common_model->array=array('content_status' => 1);
       $update=$this->common_model->update($wheree);
      if($update==FALSE){
           echo TRUE;
       }else{
           echo False;
       }
    }
    /* Content Waiting for Approval End */
    
}
