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

    public function __construct()
    {

        parent::__construct();
        //echo base_url();

        if (!$this->_is_home_logged_in()) {
            redirect(base_url());
        }

        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('content_main.php');
    }

    public function index()
    {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }

    public function clist()
    {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }

    public function createjob()
    {

        $data = array();
        $targett_dir = FCPATH . "zipfiles/";
        $files1 = scandir($targett_dir);
        foreach ($files1 as $keys => $vals) {
            $fileinfo = pathinfo($targett_dir . $vals);
            if ($vals != "." && $vals != ".." && is_file($targett_dir . $vals) && $fileinfo['extension'] == 'zip') {
                $data = $this->zipfileProcessing($vals, $fileinfo);
                if(!$data){
                    return false;
                }
            }

        }

        $this->layout->view($this->view_dir, $data);
    }

    private function mix_video($audio_file, $video_file,$video_file1, $pa,$target_dir)
    {
        $this->load->library('s3');
        $logo_file = $pa . "PAKODI_SHAREVIDEO_ICON.png";
        //-shortest -acodec copy
        //$mix = "/usr/local/bin/ffmpeg  -loop 1 -i  " . $logo_file . " -i  " . $audio_file . " -c:v mpeg4 -c:a copy -shortest  " . $video_file;
       // exec($mix);
        $mixi = "/usr/local/bin/ffmpeg -loop 1 -i  " . $logo_file . " -i  " . $audio_file . " -c:v mpeg4 -c:a libfdk_aac -b:a 128k -shortest  " . $video_file1;
 exec($mixi);
 $mix="/usr/local/bin/ffmpeg  -i  " . $video_file1. " -vf scale=640:640  " . $video_file;
 exec($mix);
        $fileinfo = pathinfo($video_file);
        //echo $video_file;
        $this->s3upload('',  $video_file, 'sharevideo');
        unlink($video_file);
        unlink($video_file1);

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
                chmod($target_dir . $fileInfo['filename'],0777);
                $file_csv = scandir($target_dir . $fileInfo['filename']);
                foreach ($file_csv as $key => $value) {
                    $fileInfor = pathinfo($target_dir . $fileInfo['filename'] . '/' . $value);
                    if ($fileInfor['extension'] == 'xlsx' || $fileInfor['extension'] == 'xls') {
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
                                $value1 = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                                $arraydata[$row - 1][$col] = $value1;
                                $rowdata[$col] = $value1;
                            }
                            if (isset($rowdata[1]) && isset($rowdata[2]) && isset($rowdata[3]) && isset($rowdata[4]) && isset($rowdata[5]) && isset($rowdata[6]) && isset($rowdata[7]) && isset($rowdata[8]) && isset($rowdata[9]) && isset($rowdata[10]) && isset($rowdata[12]) && isset($rowdata[14]) && $rowdata[3] == $this->session->userdata['user_id']) {
                                if ($rowdata[1] == 'insert' || $rowdata[1] == 'Insert') {
                                    //echo $target_dir . $fileInfo['filename'] . "/", $rowdata[12];
                                    $this->s3upload($target_dir . $fileInfo['filename'] . "/JPEG/", $rowdata[12], 'appimages');
                                    if ($rowdata[9] == 2) {
                                        $audio_file_info = pathinfo($target_dir . $fileInfo['filename'] . "/" . $rowdata[10]);
                                        //$target_dir . $fileInfo['filename'] . "/", $audio_file_info['filename'] . '.mp3';
                                        $this->s3upload($target_dir . $fileInfo['filename'] . "/MP3/", $audio_file_info['filename'] . '.mp3', 'audios');
                                        $this->s3upload($target_dir . $fileInfo['filename'] . "/AAC/", $audio_file_info['filename'] . '.aac', 'audios');
                                        $audio_file = $target_dir . $fileInfo['filename'] . "/MP3/" .$audio_file_info['filename'] . '.mp3';
                                    
                                        $video_file1 = $target_dir . $fileInfo['filename'] . "/tmp" .$audio_file_info['filename'].".mp4";
                                        $video_file = $target_dir . $fileInfo['filename'] . "/" .$audio_file_info['filename'].".mp4";
                                        $make=$this->mix_video($audio_file, $video_file,$video_file1,$pa,$target_dir);
                                    } else if ($rowdata[9] == 1) {
                                        $this->s3upload($target_dir . $fileInfo['filename'] . "/MP4/", $rowdata[10], 'videos');
                                    }
                                    $cat_id = $this->catname($rowdata[6]);
                                    $lang_id = $this->language($rowdata[8]);
                                    if ($lang_id != 1) {
                                        $content_array1 = array('unique_code' => $rowdata[2], 'title' => $rowdata[22], 'contentowner_id' => $this->session->userdata['user_id'], 'short_desc' => $rowdata[23], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'language_id' => $lang_id, 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[24], 'thumb_filename' => $rowdata[12], 'movie_name' => $rowdata[25], 'clip_length' => $rowdata[14], 'main_artist' => $rowdata[26], 'sub_artists' => $rowdata[27], 'film_director' => $rowdata[28], 'music_director' => $rowdata[29], 'dialog_writer' => $rowdata[30], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 1);
                                        $insert = $this->insert_content($content_array1);
                                    }
                                    $content_array = array('unique_code' => $rowdata[2], 'title' => $rowdata[4], 'contentowner_id' => $this->session->userdata['user_id'], 'short_desc' => $rowdata[5], 'category_id' => $cat_id, 'parental_advisory' => $rowdata[7], 'language_id' => 1, 'content_type' => $rowdata[9], 'contentclip_filename' => $rowdata[10], 'search_keywords' => $rowdata[11], 'thumb_filename' => $rowdata[12], 'movie_name' => $rowdata[13], 'clip_length' => $rowdata[14], 'main_artist' => $rowdata[15], 'sub_artists' => $rowdata[16], 'film_director' => $rowdata[17], 'music_director' => $rowdata[18], 'dialog_writer' => $rowdata[19], 'copyright' => $rowdata[20], 'content_expirydate' => $rowdata[21], 'content_status' => 1);
                                    $insert = $this->insert_content($content_array);
                                }
                            }
                        }

                        if (isset($insert)) {
                            return $data['result'] = "The Job You Created Done Sucessfully";
                            // $data['result']=$this->setFlashmessage("result", "sucess");
                        } else {
                            return $data['result'] = "Please Check the mandatory feilds in excel is set or not,click on download excel for sample";
                            // $data['result']= $this->setFlashmessage("result", "Failure");
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
        $this->load->library('s3');
        $file1 = $this->s3->inputFile($filepath . $data_array);
        $fil1 = explode('/', $file1['file']);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        $ff = explode('.', $fp1);
        return $jpg = $this->s3->putObject($file1, 'sprintmedia', "$type/$fp1");
    }

    private function catname($cat)
    {
        $this->common_model->initialise('categories');
        $id = $this->common_model->get_record_single(array('category' => $cat), 'cat_id');
        return $id->cat_id;
    }

    private function language($lang)
    {
        $this->common_model->initialise('languages');
        $id = $this->common_model->get_record_single(array('language' => $lang), 'lang_id');
        return $id->lang_id;
    }

    private function insert_content($data)
    {
        $this->common_model->initialise('content');
        $this->common_model->array = $data;
        $insert = $this->common_model->insert_entry();
        return $insert;
    }

    public function getData()
    { //echo "I am in getdata method";exit;
        $aColumns = array('content_id', 'title', 'content_type', 'thumb_filename', 'contentclip_filename', 'content_status', 'datecreated');
        $this->common_model->initialise('content');
        $where = "contentowner_id = '" . $this->session->userdata['user_id'] . "'";
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
            //$actdate = new DateTime($aRow['content_activationdate']);
            //$row[2] = $actdate->format('M jS Y');
            $path = base_url() . "appimages/" . $aRow['thumb_filename'];
            $row[2] = "<img src='$path' width='50' height='50'>";
            // $expdate = new DateTime($aRow['content_expirydate']);
            //  $row[3] = $expdate->format('M jS Y');

            if ($aRow['content_type'] == 2) {
                $apath = base_url() . "audios/" . $aRow['contentclip_filename'];
            } else {
                $apath = base_url() . "videos/" . $aRow['contentclip_filename'];
            }
            $row[3] = "<iframe src='$apath' width='150' height='30'></iframe>";
            $status = $aRow['content_status'];
            if ($status == 1) {
                $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
            } else if ($status == 0 || $status == '' || $status == "NULL") {
                $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
            }

            $row[4] = $statusn;

            $row[5] = $aRow['datecreated'];
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

}

//class
