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
class Content extends My_Controller
{

    private $view_dir;
    private $admin_base_url;
    private $data_mining_flag = 1;
    private $data_unique_code = '';
    private $endofrows = 0;

    public function __construct()
    {

        parent::__construct();
        //echo base_url();

        if (!$this->_is_home_logged_in()) {
            redirect(base_url());
        }
        if ($this->session->userdata['user_type'] <= 1) {
            $this->admin_base_url = base_url() . 'Admin';
            redirect($this->admin_base_url . '/users/dashboard');
        } elseif ($this->session->userdata['user_type'] == 3) {
            $this->admin_base_url = base_url() . 'moderator';
            redirect($this->admin_base_url . '/users/dashboard');
        }


        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('content_main.php');
    }

    public function index()
    {
        $data = array();
		$this->common_model->initialise('master_content');
		$select =  'COUNT(*) as count';
		$data['activecontent'] = $this->common_model->get_record_single(array('content_status' => 1), $select);
		$data['inactivecontent'] = $this->common_model->get_record_single(array('content_status' => 0), $select);
		$data['rejectedcontent'] = $this->common_model->get_record_single(array('content_status' => 2), $select);
        $this->layout->view($this->view_dir, $data);
    }
	public function contentupload() {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }
    public function clist()
    {
        $data = array();
        $cid = $this->session->userdata['user_id'];
        $this->common_model->initialise('master_content as C');
        $this->common_model->join_tables = 'languages as L';
        $this->common_model->join_on = "C.language_id = L.lang_id";
        $where = array('C.contentowner_id' => $cid);
        $groupby = 'C.language_id';
        $data['claungages'] = $this->common_model->get_records(0, 'C.language_id,L.language', $where, $col = 0, $order = 'desc', $groupby);
        
		$this->common_model->initialise('categories');
		$data['category'] = $this->common_model->get_records(0, 'cat_id,category', 0,$col = 'cat_id', $order = 'asc', $groupby = 'cat_id');
		  
		$this->layout->view($this->view_dir, $data);
    }

    public function createjob()
    {
        // 
        $data = array();
        $target_dir = FCPATH . "zipfiles/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (isset($_POST["submit"])) {
            if ($imageFileType != "zip") {
                $return_data = ['status' => 0, 'unique_code' => 'NO ZIP FILE'];
            } else {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    $fileinfo = pathinfo($target_dir . $_FILES["file"]["name"]);
                    try {
                        $data = $this->zipfileProcessing($_FILES["file"]["name"], $fileinfo);
                        if (!$this->data_mining_flag && $this->endofrows == 0) {
                            $data = array("result" => "Row until this $this->data_unique_code unique code is uploaded. Rectify the issues on this row and below and try again");
                        } else {
                            $data = array('result' => 'Successfully uploaded');
                            $rm_dir = $target_dir . $fileinfo['filename'] . "/media";
                            exec("rm -rf $rm_dir");
                        }
                    } catch (Exception $ex) {
                        $data['result'] = "something went wrong try again later";
                    }

                    //echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                } else {
                    $data['result'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

//        $targett_dir = FCPATH . "zipfiles/";
//        // chmod($targett_dir,0777);
//        $files1 = scandir($targett_dir);
//        foreach ($files1 as $keys => $vals) {
//            $fileinfo = pathinfo($targett_dir . $vals);
//            if ($vals != "." && $vals != ".." && is_file($targett_dir . $vals) && $fileinfo['extension'] == 'zip') {
//                $data = $this->zipfileProcessing($vals, $fileinfo);
//                if (!$this->data_mining_flag) {
//                    $return_data = ['status' => $this->data_mining_flag, 'unique_code' => $this->data_unique_code];
//                    break;
//                } else {
//                    $return_data = ['status' => $this->data_mining_flag, 'unique_code' => 'none'];
//                }
//            } else {
//                $return_data = ['status' => 0, 'unique_code' => 'NO ZIP FILE'];
//            }
//        }
//        echo json_encode($return_data);
//        exit;
        $this->layout->view($this->view_dir, $data);
    }

    private function mix_video($audio_file, $video_file, $video_file1, $pa, $target_dir)
    {
        $this->load->library('s3');
        $logo_file = $pa . "640Pakodi1.jpg";
        $mixi = "/usr/local/bin/ffmpeg -loop 1 -i  " . $logo_file . " -i  " . $audio_file . " -c:v libx264 -profile:v high -level 3.0 -c:a libfdk_aac -ar 44100 -b:a 128k -shortest -vf scale=640:640 -pix_fmt yuv420p " . $video_file1;
        exec($mixi);
        //$mix = "/usr/local/bin/ffmpeg  -i  " . $video_file1 . " -vf scale=640:640 -pix_fmt yuv420p " . $video_file;
        //exec($mix);
        $fileinfo = pathinfo($video_file);

        $this->s3upload('', $video_file, 'sharevideo');

        //unlink($video_file);

    }

    private function zipfileProcessing($zipfile, $fileInfo)
    {
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

                        for ($row = 3; $row <= $highestRow; ++$row) {
                            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                $value1 = $objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                                $arraydata[$row - 1][$col] = $value1;
                                $rowdata[$col] = $value1;
                            }
                            $target_file = $target_dir . $fileInfo['filename'] . "/media/" . $rowdata[12];
                            $path_parts = pathinfo($target_file);
                            $aac_file = $target_dir . $fileInfo['filename'] . "/media/" . $path_parts['filename'] . ".aac";

                            //echo '<pre>'; print_r($rowdata); exit;
                            if (isset($rowdata[1]) && ($rowdata[1] == 'Delete' || $rowdata[1] == 'DELETE' || $rowdata[1] == 'delete')) {

                                $master_array = array('unique_code' => $rowdata[2]);
                                $insert = $this->update_master_content($master_array, $rowdata[1]);
                            } else if (isset($rowdata[1]) && isset($rowdata[2]) && isset($rowdata[3]) && isset($rowdata[4]) && isset($rowdata[5]) && isset($rowdata[6]) && isset($rowdata[7]) && isset($rowdata[8]) && isset($rowdata[9]) && isset($rowdata[10]) && isset($rowdata[12]) && isset($rowdata[14]) && $rowdata[3] == $this->session->userdata['user_id'] && is_file($target_dir . $fileInfo['filename'] . "/media/" . $rowdata[10]) && is_file($target_dir . $fileInfo['filename'] . "/media/" . $rowdata[12]) && is_file($aac_file)) {
                                $target_file = $target_dir . $fileInfo['filename'] . "/media/" . $rowdata[12];
                                $path_parts = pathinfo($target_file);
                                $output = $target_dir . $fileInfo['filename'] . "/media/" . $path_parts['filename'] . "_110.jpg";
                                $compress_pic = "/usr/local/bin/ffmpeg -y -i $target_file -vf scale=110:90 $output";
                                exec($compress_pic);
                                $compress_pic = "/usr/local/bin/ffmpeg -y -i $target_file -vf scale=320:240 $target_file";
                                exec($compress_pic);

                                if ($rowdata[9] == 2) {
                                    $audio_file_info = pathinfo($target_dir . $fileInfo['filename'] . "/" . $rowdata[10]);
                                    $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $audio_file_info['filename'] . '.mp3', 'audios');
                                    $this->server_upload($target_dir . $fileInfo['filename'] . "/media/", $audio_file_info['filename'] . '.mp3', 'audios');
                                    $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $audio_file_info['filename'] . '.aac', 'audios');
                                    $audio_file = $target_dir . $fileInfo['filename'] . "/media/" . $audio_file_info['filename'] . '.mp3';
                                    $convert_file_mp4 = $target_dir . $fileInfo['filename'] . "/media/" . $audio_file_info['filename'] . '.mp4';
                                    $convert_mp4 = "/usr/local/bin/ffmpeg -i $audio_file -vn $convert_file_mp4";
                                    exec($convert_mp4);
                                    $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $audio_file_info['filename'] . '.mp4', 'audios');
                                    if (!is_dir($pa . "temp/")) {
                                        mkdir($pa . "temp/", 0777);
                                    }
                                    $video_file1 = $pa . "temp/" . $audio_file_info['filename'] . ".mp4";
                                    $video_file = $pa . "temp/" . $audio_file_info['filename'] . ".mp4";
                                    $make = $this->mix_video($audio_file, $video_file, $video_file1, $pa, $target_dir);
                                } else if ($rowdata[9] == 1) {
                                    $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $rowdata[10], 'videos');
                                    // $this->server_upload($target_dir . $fileInfo['filename'] . "/media/", $rowdata[10], 'videos');
                                }
                                $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $rowdata[12], 'appimages');
                                $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $path_parts['filename'] . "_110.jpg", 'appimages');
                                if (file_exists($target_file)) {
                                    $cat_id = $this->catname($rowdata[6]);
                                    if (empty($cat_id)) {
                                        $cat_id = 0;
                                    }
                                    $lang_id = $this->language($rowdata[8]);
                                    $user_name = $this->select_name($lang_id);
                                    if ($rowdata[1] == 'insert' || $rowdata[1] == 'Insert' || $rowdata[1] == 'INSERT') {
                                        $master_array = array('unique_code' => $rowdata[2], 'language_id' => $lang_id, 'contentowner_id' => $this->session->userdata['user_id'], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[11], 'thumb_filename' => $rowdata[12], 'clip_length' => $rowdata[14], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 1, 'vuser_id' => $user_name->id, 'vuser_name' => $user_name->name, 'vuser_type' => 1, 'content_status' => 0/*,'contentowner_name' => $user_name*/);
                                        $master_id = $this->insert_master_content($master_array);
                                    } else if ($rowdata[1] == 'update' || $rowdata[1] == 'Update' || $rowdata[1] == 'UPDATE' || $rowdata[1] == 'delete' || $rowdata[1] == 'Delete' || $rowdata[1] == 'DELETE') {//echo "hi";exit;
                                        $master_array = array('unique_code' => $rowdata[2], 'language_id' => $lang_id, 'contentowner_id' => $this->session->userdata['user_id'], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[11], 'thumb_filename' => $rowdata[12], 'clip_length' => $rowdata[14], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 1, 'vuser_id' => $user_name->id, 'vuser_name' => $user_name->name, 'vuser_type' => 1, 'content_status' => 0/*,'contentowner_name' => $user_name*/);
                                        $master_id = $this->update_master_content($master_array, $rowdata[1]);
                                    }
                                    if ($lang_id != 1) {
                                        if (!empty($rowdata[25])) {
                                            $movie_name = $rowdata[25];
                                        } elseif (!empty($rowdata[13])) {
                                            $movie_name = $rowdata[13];
                                        } else {
                                            $movie_name = 'Movie Name';
                                        }
                                        if ($rowdata[1] == 'insert' || $rowdata[1] == 'Insert' || $rowdata[1] == 'INSERT') {
                                            $content_array1 = array('unique_code' => $rowdata[2], 'master_content_id' => $master_id, 'title' => $rowdata[22], 'contentowner_id' => $this->session->userdata['user_id'], 'short_desc' => $rowdata[23], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'language_id' => $lang_id, 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[24], 'thumb_filename' => $rowdata[12], 'movie_name' => $movie_name, 'clip_length' => $rowdata[14], 'main_artist' => $rowdata[26], 'sub_artists' => $rowdata[27], 'film_director' => $rowdata[28], 'music_director' => $rowdata[29], 'dialog_writer' => $rowdata[30], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 0);
                                            $insert = $this->insert_content($content_array1);
                                        } else if ($rowdata[1] == 'update' || $rowdata[1] == 'Update' || $rowdata[1] == 'UPDATE' || $rowdata[1] == 'delete' || $rowdata[1] == 'Delete' || $rowdata[1] == 'DELETE') {
                                            $content_array1 = array('unique_code' => $rowdata[2], 'master_content_id' => $master_id, 'title' => $rowdata[22], 'contentowner_id' => $this->session->userdata['user_id'], 'short_desc' => $rowdata[23], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'language_id' => $lang_id, 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[24], 'thumb_filename' => $rowdata[12], 'movie_name' => $movie_name, 'clip_length' => $rowdata[14], 'main_artist' => $rowdata[26], 'sub_artists' => $rowdata[27], 'film_director' => $rowdata[28], 'music_director' => $rowdata[29], 'dialog_writer' => $rowdata[30], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 0);
                                            $insert = $this->update_content($content_array1, $rowdata[1]);
                                        }
                                    }
                                    if (!empty($rowdata[13])) {
                                        $movie_name1 = $rowdata[13];
                                    } elseif (!empty($rowdata[25])) {
                                        $movie_name1 = $rowdata[25];
                                    } else {
                                        $movie_name1 = 'Movie Name';
                                    }
                                    if ($rowdata[1] == 'insert' || $rowdata[1] == 'Insert' || $rowdata[1] == 'INSERT') {
                                        $content_array = array('unique_code' => $rowdata[2], 'master_content_id' => $master_id, 'title' => $rowdata[4], 'contentowner_id' => $this->session->userdata['user_id'], 'short_desc' => $rowdata[5], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'language_id' => 1, 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[11], 'thumb_filename' => $rowdata[12], 'movie_name' => $movie_name1, 'clip_length' => $rowdata[14], 'main_artist' => $rowdata[15], 'sub_artists' => $rowdata[16], 'film_director' => $rowdata[17], 'music_director' => $rowdata[18], 'dialog_writer' => $rowdata[19], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 0);
                                        $insert = $this->insert_content($content_array);
                                    } else if ($rowdata[1] == 'update' || $rowdata[1] == 'Update' || $rowdata[1] == 'UPDATE' || $rowdata[1] == 'delete' || $rowdata[1] == 'Delete' || $rowdata[1] == 'DELETE') {
                                        $content_array = array('unique_code' => $rowdata[2], 'master_content_id' => $master_id, 'title' => $rowdata[4], 'contentowner_id' => $this->session->userdata['user_id'], 'short_desc' => $rowdata[5], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'language_id' => 1, 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[11], 'thumb_filename' => $rowdata[12], 'movie_name' => $movie_name1, 'clip_length' => $rowdata[14], 'main_artist' => $rowdata[15], 'sub_artists' => $rowdata[16], 'film_director' => $rowdata[17], 'music_director' => $rowdata[18], 'dialog_writer' => $rowdata[19], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 0);
                                        $insert = $this->update_content($content_array, $rowdata[1]);
                                    }
                                }
                                // }
                            } else {
                                $this->data_mining_flag = 0;
                                $this->data_unique_code = $rowdata[2];
                                if (empty($rowdata[1]) && empty($rowdata[2]) && empty($rowdata[3]) && empty($rowdata[4]) && empty($rowdata[5]) && empty($rowdata[6]) && empty($rowdata[7]) && empty($rowdata[8]) && empty($rowdata[9]) && empty($rowdata[10]) && empty($rowdata[12]) && empty($rowdata[14])) {
                                    $this->endofrows = 1;
                                }
                                return "Please Check the mandatory feilds in excel is set or not,click on download excel for sample";
                            }
                        }

                        if (isset($insert)) {
                            //unlink($target_dir . $fileInfo['basename']);

                            return "The Job You Created Done Sucessfully";

                        } else {
                            // return  $this->session->set_flashdata('result','Please Check the mandatory feilds in excel is set or not,click on download excel for sample');
                            return "Please Check the mandatory feilds in excel is set or not,click on download excel for sample";

                        }
                    }

                }
            } else {
                return FALSE;
            }
        }
    }

    private function s3upload($filepath, $data_array, $type)
    {
        // echo $filepath;
        $this->load->library('s3');
        $file1 = $this->s3->inputFile($filepath . $data_array);
        $fil1 = explode('/', $file1['file']);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        $ff = explode('.', $fp1);
        return $jpg = $this->s3->putObject($file1, 'sprintmedia', "$type/$fp1");
    }

    private function server_upload($filepath, $data_array, $type)
    {
        $file1 = $filepath . $data_array;
        $fil1 = explode('/', $file1);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        if (copy($file1, FCPATH . $type . '/' . $fp1)) {
            return TRUE;
        }
        //return $jpg = $this->s3->putObject($file1, 'sprintmedia', "$type/$fp1");
    }

    private function catname($cat)
    {
        $this->common_model->initialise('categories');
        $id = $this->common_model->get_record_single(array('category' => $cat), 'cat_id');
        if (!empty($id->cat_id)) {
            return $id->cat_id;
        }
        return 0;
    }

    private function language($lang)
    {
        $this->common_model->initialise('languages');
        $id = $this->common_model->get_record_single(array('language' => $lang), 'lang_id');
        return $id->lang_id;
    }

    private function insert_master_content($data)
    {
        $this->common_model->initialise('master_content');
        $this->common_model->array = $data;
        $insert = $this->common_model->insert_entry();
        return $insert;
    }

    private function insert_content($data)
    {
        $this->common_model->initialise('content');
        $this->common_model->array = $data;
        $insert = $this->common_model->insert_entry();
        return $insert;
    }

    private function update_master_content($data, $type)
    {
        $this->common_model->initialise('master_content');
        $getid = $this->common_model->get_record_single(array('unique_code' => $data['unique_code']), '*');
        if (!empty($getid)) {
            if ($type == 'update' || $type == 'Update' || $type == 'UPDATE') {
                $this->common_model->array = $data;
            } else {
                $this->common_model->array = array('content_status' => 2);
            }
            $insert = $this->common_model->update(array('master_content_id' => $getid->master_content_id));
            return $getid->master_content_id;
        } else {
            if ($type == 'update' || $type == 'Update' || $type == 'UPDATE') {
                $getid = $this->insert_master_content($data);
                return $getid;
            }
        }
    }

    private function update_content($data, $type)
    {
        $this->common_model->initialise('content');
        $getid = $this->common_model->get_record_single(array('unique_code' => $data['unique_code'], 'master_content_id' => $data['master_content_id'], 'language_id' => $data['language_id']), '*');
        if (!empty($getid)) {
            if ($type == 'update' || $type == 'Update' || $type == 'UPDATE') {
                $this->common_model->array = $data;
            } else {
                $this->common_model->array = array('content_status' => 2);
            }
            $insert = $this->common_model->update(array('content_id' => $getid->content_id));
            return $getid->content_id;
        } else {
            $getid = $this->insert_content($data);
            return $getid;
        }
    }

    public function getData()
    { //echo "I am in getdata method";exit;
	//$_POST['sSearch_0']='5';
        $language_id = "";
        if (!empty($_POST['sSearch_0'])) {
            $language_id = " AND MC.language_id =" . $_POST['sSearch_0'];
        }
		//$_POST['sSearch_1']='1';
		$category_id = "";
        if (!empty($_POST['sSearch_1'])) {
            $category_id = " AND MC.category_id =" . $_POST['sSearch_1'];
        }
        //print_r($_POST[sSearch_0]); exit;
        //$id='2';
        $aColumns = array('MC.contentowner_id', 'C.title', 'MC.unique_code', 'MC.content_type', 'MC.thumb_filename', 'MC.contentclip_filename','MC.clip_length', 'MC.content_status', 'MC.datecreated');
        $this->common_model->initialise('master_content MC');
        $this->common_model->join_tables = 'content as C';
        $this->common_model->join_on = "MC.master_content_id = C.master_content_id";
        $where = "MC.contentowner_id = '" . $this->session->userdata['user_id'] . "'" . $language_id.$category_id;

        $data = $this->common_model->getTable($aColumns, $where, $col = 'MC.datecreated', $order = 'desc', 'MC.master_content_id');
        $output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['contentowner_id'] == $this->session->userdata['user_id']) {
                $row = array();
                foreach ($aColumns as $col) {
                    $col = trim($col, 'MC.');
                    $col = trim($col, 'C.');
                    $row[] = $aRow[$col];
                }
                $row[0] = $aRow['unique_code'];
                $i = $i + 1;
                //$actdate = new DateTime($aRow['content_activationdate']);
                //$row[2] = $actdate->format('M jS Y');
                //$row[2] = $aRow['unique_code'];
                //$path = "http://sprintmedia.s3.amazonaws.com/appimages/" . $aRow['thumb_filename'];
               //$row[2] = "<img src='$path' width='50' height='auto' class='test'>";
                $row[2] = '<div class="tric"><img src="http://sprintmedia.s3.amazonaws.com/appimages/'.$aRow["thumb_filename"].'" class="test" width="50" height="auto"><div class="redo"><b>'.$aRow['clip_length'].' S'.'</b></div></div>'; 
// $expdate = new DateTime($aRow['content_expirydate']);
                //  $row[3] = $expdate->format('M jS Y');

                if ($aRow['content_type'] == 2) {
                    $apath = "http://sprintmedia.s3.amazonaws.com/audios/" . $aRow['contentclip_filename'];
                    //$row[4]  = "<audio src='../audio/veer-lovetone167.mp3' controls ></audio>";
                } else {
                    $apath = "http://sprintmedia.s3.amazonaws.com/videos/" . $aRow['contentclip_filename'];
                }
                    //$row[3] = "<video src='$apath' width='50' height='auto' class='test' controls ></video>";
                    $row[3] ='<i class="iconred icon-play play-content" title="Play" data-contenttype="'.$aRow['content_type'].'" data-media="'.$aRow['contentclip_filename'].'"></i>';
                    //$row[4]='testing';
                
                //$row[4] = "<iframe src='$apath' width='150' height='30'></iframe>";
                //$row[4]  = "<audio src='$apath' width='150' height='30' controls ></audio>";
                $status = $aRow['content_status'];
                if ($status == 1) {
                    $statusn =/*"<i class='icongreen  icon-ok' title='Active'></i>";*/ "<span  title='Active' style='border:0px solid #cccccc;color:green'>Active</span>";
                } else if ($status == 0 || $status == '' || $status == "NULL") {
                    $statusn =/*"<i class='iconred icon-remove' title='Inactive'></i>";*/ "<span  title='Inactive' style='border:0px solid #cccccc;color:red'>Inactive</span>";
                } else if ($status == 2) {
                    $statusn = /*"<i class='iconred icon-remove' title='Inactive'></i>";*/"<span  title='Inactive' style='border:0px solid #cccccc;color:red'>Deleted</span>";
                }
                $row[4] = $statusn;

                $row[5] = $aRow['datecreated'];

                $output['aaData'][] = $row;
            }
        }
        // echo $output;exit;
        echo json_encode($output);
    }

}

//class
