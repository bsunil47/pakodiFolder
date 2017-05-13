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
class dubscontent extends My_Controller
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

    public function dubsupload() {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }

    public function dubslist(){
        $data=array();
        $cid = $this->session->userdata['user_id'];
        $this->common_model->initialise('master_content as C');
        $this->common_model->join_tables = 'languages as L';
        $this->common_model->join_on = "C.language_id = L.lang_id";
        $where = array('C.contentowner_id' => $cid);
        $groupby = 'C.language_id';
        $data['claungages'] = $this->common_model->get_records(0,'C.language_id,L.language',$where,$col = 0, $order = 'desc', $groupby);
        $this->layout->view($this->view_dir, $data);
    }

    public function createdub() {
        $data = array();
        $target_dir = FCPATH . "zipfiles/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (isset($_POST["submit"])) {
            if ($imageFileType != "zip") {
                $return_data = ['status' => 0, 'unique_code' => 'NO ZIP FILE'];
                //echo "Not a zip file";exit;
            } else {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    $fileinfo = pathinfo($target_dir . $_FILES["file"]["name"]);
                    try {
                        $data = $this->zipfileProcessingdubs($_FILES["file"]["name"], $fileinfo);
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
        $this->layout->view($this->view_dir, $data);
    }

    private function zipfileProcessingdubs($zipfile, $fileInfo) {
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
                            //echo '<pre>'; print_r($rowdata); exit;
                            if (isset($rowdata[1]) && isset($rowdata[2]) && isset($rowdata[3]) && isset($rowdata[4]) && isset($rowdata[5]) && isset($rowdata[6]) && isset($rowdata[7]) && isset($rowdata[8]) && isset($rowdata[9]) && isset($rowdata[10])  && $rowdata[3] == $this->session->userdata['user_id'] && is_file($target_dir . $fileInfo['filename'] . "/media/". $rowdata[7]) && is_file($target_dir . $fileInfo['filename'] . "/media/". $rowdata[8])) {
                                //echo "testing";exit;
                                if ($rowdata[1] == 'insert' || $rowdata[1] == 'Insert' || $rowdata[1] == 'INSERT') {
                                    $target_file = $target_dir . $fileInfo['filename'] . "/media/" . $rowdata[8];
                                    $path_parts = pathinfo($target_file);
                                    if ($rowdata[6] == 1) {
                                        $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $rowdata[7], 'dubs');
                                    }
                                    $this->s3upload($target_dir . $fileInfo['filename'] . "/media/", $rowdata[8], 'dubs');

                                        $lang_id = $this->language($rowdata[5]);
                                        $dubs_array = array('user_id' => $this->session->userdata['user_id'], 'artist'=> $rowdata[10], 'dubclip_title' => $rowdata[4], 'dubclip_filename' => $rowdata[7], 'parental_advisory' => 'ALL', 'language_id'=>$lang_id, 'clip_length' => $rowdata[9],  'dub_status' => 1, 'record_type' =>1, 'thumb_filename' => $rowdata[8]);
                                        $dubs_id = $this->insert_dubs_content($dubs_array);
                                    }
                            } else {
                                $this->data_mining_flag = 0;
                                $this->data_unique_code = $rowdata[2];
                                if(empty($rowdata[1]) && empty($rowdata[2]) && empty($rowdata[3]) && empty($rowdata[4]) && empty($rowdata[5]) && empty($rowdata[6]) && empty($rowdata[7]) && empty($rowdata[8]) && empty($rowdata[9]) && empty($rowdata[10])){
                                    $this->endofrows = 1;
                                }
                                return "Please Check the mandatory feilds in excel is set or not,click on download excel for sample";
                            }
                        }

                        if (isset($dubs_id)) {
                            unlink($target_dir . $fileInfo['basename']);

                            return "Dubs Created Sucessfully";
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

    private function insert_dubs_content($data) {
        $this->common_model->initialise('userdubs');
        $this->common_model->array = $data;
        $insert = $this->common_model->insert_entry();
        return $insert;
    }


    public function getDublistData() {
        $language_id = "";
        if(!empty($_POST['sSearch_0'])){
            $language_id = " AND D.language_id =".$_POST['sSearch_0'];
        }
        //$aColumns = array('D.dub_id', 'U.name', 'D.dubclip_title', 'D.moderatedby', 'D.dub_status', 'D.record_type', 'D.isdub_moderate','D.thumb_filename','D.dubclip_filename','D.datecreated');
        $aColumns = array('D.dub_id', 'D.dubclip_title','D.thumb_filename', 'D.dubclip_filename','D.dub_status', 'D.datecreated','D.record_type',);
        $this->common_model->initialise('userdubs as D');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = D.user_id";
        $where = "D.dub_status != '2' AND D.record_type = '1' AND D.user_id = '" . $this->session->userdata['user_id'] . "'".$language_id;
        //$where = "D.dub_status != '2' AND D.record_type = '1'";
        $data = $this->common_model->getTable($aColumns, $where,'dub_id');
        $output = $data['output'];
        //print_r($output); exit;
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            if ($aRow['record_type'] == 1 ) {
                $count++;
                $row = array();
                unset($aColumns[4]);
                unset($aColumns[5]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'D.');
                    $col = trim($col, 'U.');
                    $row[] = $aRow[$col];
                }
                $row[1] = $aRow['dubclip_title'];
                $path = "http://sprintmediasg.s3.amazonaws.com/appimages/" . $aRow['thumb_filename'];
                $row[2] = "<img src='$path' width='50' height='50'>";
                //$row[3] = $aRow['dubclip_filename'];
                $apath = "http://sprintmediasg.s3.amazonaws.com/dubs/" . $aRow['dubclip_filename'];
                //$row[3]  = "<video src='$apath' width='0' height='50' controls ></video>";
                $row[3]  = "<video width='200' height='100' controls><source src='$apath' type='video/mp4'></video>";
                $row[0] = $i;
                $i = $i + 1;
                $status = $aRow['dub_status'];
                if ($status == 1) {
                    $statusn = "<span style='border:0px solid #cccccc;color:green' title='Active'>Active</span>";
                } else  {
                    $statusn = "<span style='border:0px solid #cccccc;color:red' title='Active'>Inactive</span>";
                }
                $row[4] = $statusn;
                $row[5] = $aRow['datecreated'];
                $output['aaData'][] = $row;
            }
        }
        if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
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
        return $jpg = $this->s3->putObject($file1, 'sprintmediasg', "$type/$fp1");
    }
}

//class
