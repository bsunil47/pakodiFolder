<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class zipfiles extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('index');
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
    public function index(){
        
/*
FTp Code
*/
$dir    = FCPATH."zipfiles";
$local_file = $dir."/".'local.zip';
$conn_id = ftp_ssl_connect('183.82.107.134') or die("Could not connect to '183.82.107.134'");
$ftp_user='pakodiftp';
$ftp_pass='p@kod1ftp';
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    echo "Connected as $ftp_user@183.82.107.134\n";exit;
} else {
    echo "Couldn't connect as pakodiftp\n";exit;
}
//$login_result = ftp_login($conn_id, 'pakodiftp', 'p@kod1ftp');
$server_file=scandir($login_result);
foreach($server_file as $keyy=>$val){
 if(strpos($val,".zip")){
$s_file=$val;   
}}
if (ftp_get($conn_id, $local_file, $s_file, FTP_BINARY)) {
    echo "Successfully written to $local_file\n";
} else {
    echo "There was a problem\n";
}
ftp_close($conn_id);
$files1 = scandir($dir);
foreach($files1 as $keys=>$vals ){
if(strpos($vals,".zip")){
$file=$vals;
$fx=explode(".",$file);
$tt=$fx[0];
$target_dir = $dir."/".date('Y-m-d')."/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
 if (copy($dir."/".$file, $target_dir.$file)) {
          unlink($dir."/".$file);
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
                        for ($row = 2; $row <= $highestRow; ++$row) {
                            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                                $arraydata[$row - 1][$col] = $value;
                            }
                        }
                       foreach ($arraydata as $keys => $values) {
                            if ($keys >2) {
                                         if($values[1]=='insert' || $values[1]=='Insert'){
                                            if(copy($target_dir.$tt."/".$values[8].".mp3", FCPATH."audios/".$values[8].".mp3") && copy($target_dir.$tt."/".$values[8].".aac", FCPATH."audios/".$values[8].".aac") && copy($target_dir.$tt."/".$values[10].".jpg", FCPATH."appimages/".$values[10].".jpg")){
                                             $cat_id=$this->catname($values[5]);
                                             $lang_id=$this->language($values[7]);
                                             $content_array=array('unique_code' => $values[2],'title'=> $values[3],'short_desc'=> $values[4],'category_id'=> $cat_id,'parental_advisory'=> $values[6],'language_id'=> $lang_id,'contentclip_filename'=> $values[8].".mp3",'search_keywords'=> $values[9],'thumb_filename'=> $values[10].".jpg",'movie_name'=> $values[11],'clip_length' => $values[12],'main_artist'=> $values[13],'sub_artists'=> $values[14],'film_director'=> $values[15],'music_director'=> $values[16],'dialog_writer'=> $values[17],'copyright'=>$values[18],'content_expirydate'=> $values[19],'copyright'=>$values[18]);
                                            $this->common_model->initialise('content');
                                             $this->common_model->array=$content_array;
                                             $insert=$this->common_model->insert_entry();
                                         }}
                         }}

   if(isset($insert)){
       echo "sucess";exit;
   }else{
       echo "failure";exit;
   }
   
}
}  } else {
        return FALSE;
    }
        }
}
}
$data['admin_url'] = $this->admin_base_url;
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
}


    

