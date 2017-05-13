<?php
header("Content-type: text/html; charset=UTF-8");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();
//base_url()= "http://localhost/icheck_d11-03-2015/merchants";
//$url = $this->config->base_url();
//echo $url;
//echo base_url();
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
class Content extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    public function __construct() {

        parent::__construct();
        //echo base_url();

        if (!$this->_is_home_logged_in()) {
            redirect(base_url());
        }

        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('content_main.php');
    }

     public function index() {
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
foreach($files1 as $keys=>$vals ){
if(strpos($vals,".zip")){
$file=$vals;
$fx=explode(".",$file);
$tt=$fx[0];
$target_dir = $targett_dir.date('Y-m-d')."/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
 if (copy($targett_dir.$file, $target_dir.$file)) {
          unlink($targett_dir.$file);
$zip = new ZipArchive;
    $res = $zip->open($target_dir.$file);
    if ($res === TRUE) {
        $zip->extractTo($target_dir);
        $zip->close();
        $file_csv=scandir($target_dir.$tt);
        
foreach($file_csv as $key => $value){
    
if(strpos($value,".xlsx") || strpos($value,".xls")){
$csv_file=$value;
 $this->load->library('excel');
                        $inputFileType = PHPExcel_IOFactory::identify($target_dir.$tt."/".$csv_file);

                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                        $objReader->setReadDataOnly(true);

                        /**  Load $inputFileName to a PHPExcel Object  * */
                        $objPHPExcel = $objReader->load($target_dir.$tt."/".$csv_file);
                        $total_sheets = $objPHPExcel->getSheetCount();
                        $allSheetName = $objPHPExcel->getSheetNames();
                        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                        $highestRow = $objWorksheet->getHighestRow();
                       $highestColumn = $objWorksheet->getHighestColumn();
                       $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                       
                        for ($row = 3; $row <= $highestRow; ++$row) {
                            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                                $arraydata[$row - 1][$col] = $value;
                            }
                        }
                         foreach ($arraydata as $keyys => $values) {
                            //echo '<pre>';
                             //print_r($arraydata);exit;
                            if ($keyys > 1) {
                               if(isset($values[1]) && isset($values[2]) && isset($values[3]) && isset($values[4]) && isset($values[5]) && isset($values[6]) && isset($values[7]) && isset($values[8]) && isset($values[9]) && isset($values[10])  && isset($values[12]) && isset($values[14]) && $values[3]== $this->session->userdata['user_id']  ){ 
                                         if($values[1]=='insert' || $values[1]=='Insert'){ 
                                             if($values[9]==2){
                                                 $path=FCPATH."audios/";
                                                 }else if($values[9]==1){
                                                 $path=FCPATH."videos/";
                                             }$cc=explode(".",$values[10]);
                                   if(copy($target_dir.$tt."/".$values[10], $path.$values[10]) && copy($target_dir.$tt."/".$cc[0].".aac", $path.$cc[0].".aac") && copy($target_dir.$tt."/".$values[12], FCPATH."appimages/".$values[12])){
                                      
                                       if($values[9]==2){
                                           $path=FCPATH."audios/";
                                          $audio_file = $path.$values[10];
$img_file = FCPATH."appimages/".$values[12];
$video_file = $path."out.mp4";
$cj=explode(".",$values[12]);
$logo_file=FCPATH."appimages/application_50.png";
$out_file=FCPATH."appimages/".$cj[0].".png";
       $mixi = "/usr/local/bin/ffmpeg  -i " . $img_file . " -i " . $logo_file . " -filter_complex ". '"overlay=50:50" ' . $out_file;
  exec($mixi);
    	$mix = "/usr/local/bin/ffmpeg -loop 1 -i " . $out_file . " -i " . $audio_file . " -shortest -acodec copy ". $video_file;
	exec($mix);
        if(copy($video_file,FCPATH."sharevideo/$cj[0]".".mp4"))
        {
            unlink($video_file);
        }

                                       }      
                                       $cat_id=$this->catname($values[6]);
                                             $lang_id=$this->language($values[8]);
                                            $content_array=array('unique_code' => $values[2],'title'=> $values[4],'contentowner_id' => $this->session->userdata['user_id'],'short_desc'=> $values[5],'category_id'=> $cat_id,'parental_advisory'=> $values[7],'language_id'=> $lang_id,'content_type' => $values[9],'contentclip_filename'=> $values[10],'search_keywords'=> $values[11],'thumb_filename'=> $values[12],'movie_name'=> $values[13],'clip_length' => $values[14],'main_artist'=> $values[15],'sub_artists'=> $values[16],'film_director'=> $values[17],'music_director'=> $values[18],'dialog_writer'=> $values[19],'copyright'=>$values[20],'content_expirydate'=> $values[21],'content_status' => 1);
                                            $this->common_model->initialise('content');
                                             $this->common_model->array=$content_array;
                                             $insert=$this->common_model->insert_entry();
                                //}
                                
                               }}}
                         }}

   if(isset($insert)){
        $data['result']= "The Job You Created Done Sucessfully";
       // $data['result']=$this->setFlashmessage("result", "sucess");
                         }else{
                             $data['result']="Please Check the mandatory feilds in excel is set or not,click on download excel for sample";
     // $data['result']= $this->setFlashmessage("result", "Failure");
   }
   
}
}  } else {
        return FALSE;
    }
        }
}
        
                    }  
 
$this->layout->view($this->view_dir, $data);
    }
    
    private function catname($cat){
       $this->common_model->initialise('categories');
       $id=$this->common_model->get_record_single(array('category' => $cat),'cat_id');
       return $id->cat_id;
   }
   private function language($lang){
       $this->common_model->initialise('languages');
       $id=$this->common_model->get_record_single(array('language' => $lang),'lang_id');
       return $id->lang_id;
   }
public function getData() { //echo "I am in getdata method";exit;
        $aColumns = array('content_id', 'title','content_type', 'thumb_filename', 'contentclip_filename', 'content_status','datecreated');
        $this->common_model->initialise('content');
        $where = "contentowner_id = '".$this->session->userdata['user_id']."'";
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
            $path = base_url()."appimages/".$aRow['thumb_filename'];
            $row[2] = "<img src='$path' width='50' height='50'>";
           // $expdate = new DateTime($aRow['content_expirydate']);
          //  $row[3] = $expdate->format('M jS Y');
            
            if($aRow['content_type']==2){
                $apath=  base_url()."audios/".$aRow['contentclip_filename'];
            }else{
                $apath= base_url()."videos/".$aRow['contentclip_filename'];
            }
            $row[3]="<iframe src='$apath' width='150' height='30'></iframe>";
            $status = $aRow['content_status'];
            if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                } else if ($status == 0 || $status == '' || $status == "NULL") {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                } 

            $row[4] = $statusn;

            $row[5] = $aRow['datecreated'] ;
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
}

//class
