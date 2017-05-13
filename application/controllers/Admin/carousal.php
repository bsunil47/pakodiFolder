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
 * Description of carousal
 *
 * @author xxxxxxxxxxxxx
 */
class Carousal extends My_Controller
{

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct()
    {
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

    public function index()
    {
        $data = array();
        $this->common_model->initialise('carousel');
        $data['carousel'] = $this->common_model->get_records(0, '*', '', 'car_id');
        $this->layout->view($this->view_dir, $data);
    }

    public function add()
    {
        //$this->layout->setLayout('blank.php');
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s should not be empty');
        if (isset($_POST['submit']) && !empty($_FILES)) {
             if ($this->form_validation->run('addcarousal') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }else {
            //echo  $this->input->post('expdate');exit;
            $data = array('type' => $this->input->post('file_type'));
            $uploadOk = 1;
            $target_file = basename($_FILES['file']["name"]);
            $target_filesn = basename($_FILES['filen']["name"]);
            $target_files = basename($_FILES['file1']["name"]);
            $expdate = strtotime($this->input->post('expdate'));
            $exp_date = date('Y-m-d', $expdate);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $imageFileType2 = pathinfo($target_filesn, PATHINFO_EXTENSION);
            $imageFileType1 = pathinfo($target_files, PATHINFO_EXTENSION);

           if ($data['type'] == 0) {
                $type = 'image';
               $url =$this->input->post('url');
                if (empty($url)) {
                    $clickable = 0;
                } else {
                    $clickable = 1;
                }
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                    $target_dir = FCPATH . "appimages/";
                    $file_f = $_FILES["file"]["name"];
                    $file_new = move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . '/' . $file_f);
                    $this->s3upload($target_dir . '/' . $file_f, "appimages");
                    $data = array('type' => $type, 'is_clickable' => $clickable, 'car_image' => $file_f, 'action' => $this->input->post('url'), 'expdate' => $exp_date, 'status' => 1);
                    $this->common_model->initialise('carousel');
                    $this->common_model->array = $data;
                    if ($this->common_model->insert_entry()) {
                        $this->setFlashmessage('success', 'Carousal added Successfully');
                        redirect(base_url() . "Admin/carousal");
                    }
                } else {
                    $this->setFlashmessage('error', 'Please Upload images only');
                }
            }  else if ($data['type'] == 1) {
                $type = 'audio';
                $clickable = 1;
                if (($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg" || $imageFileType2 == "gif" || $imageFileType2 == "JPG" || $imageFileType2 == "PNG" || $imageFileType2 == "JPEG" || $imageFileType2 == "GIF") && ($imageFileType1 === 'mp3' || $imageFileType1 === 'MP3')) {
                    $file_n = $_FILES["filen"]["name"];
                    $file_s = $_FILES["file1"]["name"];
                    $target_dira = FCPATH . "audios/";
                    $target_dirimg = FCPATH . "appimages/";
                    $file_new = move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dirimg . '/' . $file_n);
                    $file_news = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dira . '/' . $file_s);
                    $this->s3upload($target_dirimg . '/' . $file_n, "appimages");
                    $this->s3upload($target_dira . '/' . $file_s, "audios");
                    $data = array('type' => $type, 'is_clickable' => $clickable, 'car_image' => $file_n, 'car_audio' => $file_s, 'expdate' => $exp_date, 'status' => 1);
                    $this->common_model->initialise('carousel');
                    $this->common_model->array = $data;
                    if ($this->common_model->insert_entry()) {
                        $this->setFlashmessage('success', 'Carousal added Successfully');
                        redirect(base_url() . "Admin/carousal");
                    }
                } else {
                    $this->setFlashmessage('error', 'Please Upload audio files only');
                }

            } else if ($data['type'] == 2) {
                $type = 'video';
                $clickable = 1;
                if (($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg" || $imageFileType2 == "gif" || $imageFileType2 == "JPG" || $imageFileType2 == "PNG" || $imageFileType2 == "JPEG" || $imageFileType2 == "GIF") && ($imageFileType1 === 'mp4' || $imageFileType1 === 'MP4')) {
                    $file_n = $_FILES["filen"]["name"];
                    $file_s = $_FILES["file1"]["name"];
                    $target_dirv = FCPATH . "videos/";
                    $target_dirimg = FCPATH . "appimages/";
                    $file_new = move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dirimg . '/' . $file_n);
                    $file_news = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dirv . '/' . $file_s);
                    $this->s3upload($target_dirimg . '/' . $file_n, "appimages");
                    $this->s3upload($target_dirv . '/' . $file_s, "videos");
                    $data = array('type' => $type, 'is_clickable' => $clickable, 'car_image' => $file_n, 'car_video' => $file_s, 'expdate' => $exp_date, 'status' => 1);
                    $this->common_model->initialise('carousel');
                    $this->common_model->array = $data;
                    if ($this->common_model->insert_entry()) {
                        $this->setFlashmessage('success', 'Carousal added Successfully');
                        redirect(base_url() . "Admin/carousal");
                    }
                } else {
                    $this->setFlashmessage('error', 'Please Upload video files only');
                }
            }


            redirect(base_url() . "Admin/carousal");

        }
        }
        $this->layout->view($this->view_dir, $data);
    }

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

    public function edit($id)
    {
        //$this->layout->setLayout('blank.php');
        $data = array();
        $this->common_model->initialise('carousel');
        $data['carouseledit'] = $this->common_model->get_record_single(array('car_id' => $id), '*');
        if (!empty($_POST)) {
            $uploadOk = 1;
            $target_file = basename($_FILES['file']["name"]);
            $target_filesn = basename($_FILES['filen']["name"]);
            $target_files = basename($_FILES['file1']["name"]);
            $expdate = strtotime($this->input->post('expdate'));
            $exp_date = date('Y-m-d', $expdate);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $imageFileType2 = pathinfo($target_filesn, PATHINFO_EXTENSION);
            $imageFileType1 = pathinfo($target_files, PATHINFO_EXTENSION);
            if (!is_uploaded_file($_FILES['file']['tmp_name']) && !is_uploaded_file($_FILES['filen']['tmp_name']) && !is_uploaded_file($_FILES['file1']['tmp_name'])) {//not uploaded
                $url =$this->input->post('url');
                if (empty($url)) {
                    $clickable = 0;
                } else {
                    $clickable = 1;
                }
                $data = array('action' => $this->input->post('url'), 'is_clickable' => $clickable, 'expdate' => $exp_date);
                unset($data['submit']);
                $this->common_model->initialise('carousel');
                $this->common_model->array = $data;
                $where = array('car_id' => $id);
                $result_update = $this->common_model->update($where);
                $data['carouseledit'] = $this->common_model->get_record_single(array('car_id' => $id), '*');
                $this->setFlashmessage('success', 'Carousal Updated Successfully');
                redirect(base_url() . "Admin/carousal");
            } else {
                $expdate =$this->input->post('expdate');
                $file_type= $this->input->post('file_type');
                if ($file_type == 'image') {
                    $type = 'image';
                    if (empty($url)) {
                        $clickable = 0;
                    } else {
                        $clickable = 1;
                    }
                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF") {
                        $target_dir = FCPATH . "appimages";
                        $file_f = $_FILES["file"]["name"];
                        $file_new = move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . '/' . $file_f);
                        $this->s3upload($target_dir . '/' . $file_f, "appimages");
                        $data = array('type' => 'image', 'is_clickable' => $clickable, 'car_image' => $file_f, 'action' => $this->input->post('url'), 'car_audio' => '', 'car_video' => '', 'expdate' => $exp_date, 'status' => 1);
                        unset($data['submit']);
                        $this->common_model->initialise('carousel');
                        $this->common_model->array = $data;
                        $where = array('car_id' => $id);
                        $result_update = $this->common_model->update($where);
                        $data['carouseledit'] = $this->common_model->get_record_single(array('car_id' => $id), '*');
                    } else {
                        $this->setFlashmessage('error', 'Please Upload images only');
                    }
                } else if ($file_type == 'audio') {
                    $type = 'audio';
                    $clickable = 1;
                    if (!empty($_FILES["filen"]["name"]) && !empty($_FILES["file1"]["name"])) {
                        if (($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg" || $imageFileType2 == "gif" || $imageFileType2 == "JPG" || $imageFileType2 == "PNG" || $imageFileType2 == "JPEG" || $imageFileType2 == "GIF") && ($imageFileType1 === 'mp3' || $imageFileType1 === 'MP3')) {
                            $file_n = $_FILES["filen"]["name"];
                            $file_s = $_FILES["file1"]["name"];
                            $target_dira = FCPATH . "audios";
                            $target_dirimg = FCPATH . "appimages";
                            $file_new = move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dirimg . '/' . $file_n);
                            $file_news = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dira . '/' . $file_s);
                            $this->s3upload($target_dirimg . '/' . $file_n, "appimages");
                            $this->s3upload($target_dira . '/' . $file_s, "audios");
                            $data = array('type' => 'audio', 'is_clickable' => $clickable, 'car_image' => $file_n, 'car_audio' => $file_s, 'car_video' => '', 'expdate' => $exp_date, 'status' => 1);
                        } else {
                            $this->setFlashmessage('error', 'Please Upload audio files only');
                        }
                    } else if (!empty($_FILES["filen"]["name"])) {
                        if (($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg" || $imageFileType2 == "gif" || $imageFileType2 == "JPG" || $imageFileType2 == "PNG" || $imageFileType2 == "JPEG" || $imageFileType2 == "GIF")) {
                            $file_n = $_FILES["filen"]["name"];
                            $target_dirimg = FCPATH . "appimages";
                            $file_new = move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dirimg . '/' . $file_n);
                            $this->s3upload($target_dirimg . '/' . $file_n, "appimages");
                            $data = array('type' => 'audio', 'is_clickable' => $clickable, 'car_image' => $file_n, 'car_video' => '', 'expdate' => $exp_date, 'status' => 1);

                        } else {
                            $this->setFlashmessage('error', 'Please Upload Image files only');
                        }
                    } else if (!empty($_FILES["file1"]["name"])) {
                        if (($imageFileType1 == 'mp3' || $imageFileType1 == 'MP3')) {
                            $file_s = $_FILES["file1"]["name"];
                            $target_dira = FCPATH . "audios";
                            $file_news = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dira . '/' . $file_s);
                            $this->s3upload($target_dira . '/' . $file_s, "audios");
                            $data = array('type' => 'audio', 'is_clickable' => $clickable, 'car_audio' => $file_s, 'car_video' => '', 'expdate' => $exp_date, 'status' => 1);

                        } else {
                            $this->setFlashmessage('error', 'Please Upload audio files only');
                        }

                    }
                    unset($data['submit']);
                    unset($data['carouseledit']);
                    $this->common_model->initialise('carousel');
                    if (!empty($data)) {
                        $this->common_model->array = $data;
                        $where = array('car_id' => $id);
                        $result_update = $this->common_model->update($where);
                    }
                    $data['carouseledit'] = $this->common_model->get_record_single(array('car_id' => $id), '*');
                } else if ($file_type == 'video') {
                    $type = 'video';
                    $clickable = 1;
                    if (!empty($_FILES["filen"]["name"]) && !empty($_FILES["file1"]["name"])) {
                        if (($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg" || $imageFileType2 == "gif" || $imageFileType2 == "JPG" || $imageFileType2 == "PNG" || $imageFileType2 == "JPEG" || $imageFileType2 == "GIF") && ($imageFileType1 === 'mp4' || $imageFileType1 === 'MP4')) {
                            $file_n = $_FILES["filen"]["name"];
                            $file_s = $_FILES["file1"]["name"];
                            $target_dirv = FCPATH . "videos/";
                            $target_dirimg = FCPATH . "appimages/";
                            $file_new = move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dirimg . '/' . $file_n);
                            $file_news = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dirv . '/' . $file_s);
                            $this->s3upload($target_dirimg . '/' . $file_n, "appimages");
                            $this->s3upload($target_dirv . '/' . $file_s, "videos");
                            $expdate = strtotime(($expdate));
                            $exp_date = date('Y-m-d', $expdate);
                            $data = array('type' => 'video', 'is_clickable' => $clickable, 'car_image' => $file_n, 'car_audio' => '', 'car_video' => $file_s, 'expdate' => $exp_date, 'status' => 1);
                            //print_r($data);exit;
                        } else {
                            $this->setFlashmessage('error', 'Please Upload video files only');
                        }
                    } else if (!empty($_FILES["filen"]["name"])) {
                        if (($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg" || $imageFileType2 == "gif" || $imageFileType2 == "JPG" || $imageFileType2 == "PNG" || $imageFileType2 == "JPEG" || $imageFileType2 == "GIF")) {
                            $file_n = $_FILES["filen"]["name"];
                            $target_dirimg = FCPATH . "appimages/";
                            $file_new = move_uploaded_file($_FILES["filen"]["tmp_name"], $target_dirimg . '/' . $file_n);
                            $this->s3upload($target_dirimg . '/' . $file_n, "appimages");
                            $expdate = strtotime($expdate);
                            $exp_date = date('Y-m-d', $expdate);
                            $data = array('type' => 'video', 'is_clickable' => $clickable, 'car_image' => $file_n, 'car_audio' => '', 'expdate' => $exp_date, 'status' => 1);
                        } else {
                            $this->setFlashmessage('error', 'Please Upload Image files only');
                        }
                    } else if (!empty($_FILES["file1"]["name"])) {
                        if (($imageFileType1 === 'mp4' || $imageFileType1 === 'MP4')) {
                            $file_s = $_FILES["file1"]["name"];
                            $target_dirv = FCPATH . "videos/";
                            $file_news = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dirv . '/' . $file_s);
                            $this->s3upload($target_dirv . '/' . $file_s, "videos");
                            $expdate = strtotime($expdate);
                            $exp_date = date('Y-m-d', $expdate);
                            $data = array('type' => 'video', 'is_clickable' => $clickable, 'car_audio' => '', 'car_video' => $file_s, 'expdate' => $exp_date, 'status' => 1);

                        } else {
                            $this->setFlashmessage('error', 'Please Upload video files only');
                        }

                    }
                    unset($data['submit']);
                    unset($data['carouseledit']);

                    $this->common_model->initialise('carousel');
                    if (!empty($data)) {
                        $this->common_model->array = $data;
                        $where = array('car_id' => $id);
                        $result_update = $this->common_model->update($where);
                    }
                    $data['carouseledit'] = $this->common_model->get_record_single(array('car_id' => $id), '*');
                }
                if ($result_update == 0) {
                    $this->setFlashmessage('success', 'Carousal Updated Successfully');
                    redirect(base_url() . "Admin/carousal");
                } else {
                    $this->setFlashmessage('error', 'Please Try again');
                    redirect(base_url() . "Admin/carousal/edit");
                }
            }//uploaded files
        }
        $this->layout->view($this->view_dir, $data);
    }

    public function carouselstatus($id, $status)
    {
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = $statusn;
        $this->common_model->initialise('carousel');
        $this->common_model->status = $data;
        $where = array('car_id' => $id);
        $this->common_model->set_status($where);
        redirect(base_url() . "Admin/carousal");
    }



}    
