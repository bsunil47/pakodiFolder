<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontend
 *
 *
 */
class Cron extends My_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->common_model->initialise('usercontentrating');
        $select = ['AVG(user_rating) as avgrate', 'content_id', 'user_rating', 'datecreated'];
//        $where = 'to_days(datecreated) = (to_days(now()) -1)';
        $where = 'datecreated BETWEEN
        DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)
         AND DATE_SUB(DATE(NOW()), INTERVAL 1 HOUR)';
//$where ="user_rating <> 0";
        $groupby = 'content_id';
        $rating = $this->common_model->get_records(0, $select, $where, $col = 0, $order = 'desc', $groupby);
        if (!empty($rating)) {
            foreach ($rating as $key => $val) {
                $this->common_model->initialise('master_content');
                //$this->common_model->initialise('master_content');
                $wheree = array('master_content_id'=> $val->content_id);
                $rcontent = $this->common_model->get_record_single($wheree, '*');
//echo '<pre>';
                //  print_r($rcontent);
//if(!empty($_POST['language_id'])){
                $rate_avg = ($val->avgrate + $rcontent->content_rating) / 2;
                $avgrate = round($rate_avg,0);


                $this->common_model->initialise('master_content');
                $this->common_model->array = array('content_rating' => $avgrate);
                $this->common_model->update($wheree);
            }
        }


        $this->common_model->initialise('userdubrating');
        $select = ['AVG(user_rating) as avgrate', 'dub_id', 'user_rating', 'datecreated'];
        $where = 'to_days(datecreated) = (to_days(now()) -1)';
        $groupby = 'dub_id';
        $rating = $this->common_model->get_records(0, $select, $where, $col = 0, $order = 'desc', $groupby);
        if (!empty($rating)) {
            foreach ($rating as $key => $val) {
                $this->common_model->initialise('userdubs');
                $wheree = "master_content_id = '$val->dub_id'";
                $rcontent = $this->common_model->get_record_single($wheree, 'dub_rating');
                $rate_avg = ($val->avgrate + $rcontent->dub_rating) / 2;
                $avgrate = round($rate_avg,1);
                $this->common_model->array = array('dub_rating' => $avgrate);
                $this->common_model->update(array('dub_id' => $val->dub_id));
            }
        }

    }


    public function cronalert()
    {
        $this->common_model->initialise('users as U');
        $this->common_model->join_tables="pushnotifications as P";
        $this->common_model->join_on="U.id = P.user_id";
        $where="day(U.dob)=day(curdate()) and month(U.dob)=month(curdate())";
        $select="P.device_token,U.dtype";
        $message="Wish you a Many Happy returns of the day";
        $getd=$this->common_model->get_records(0, $select, $where, 'datecreated', 'DESC','device_token');
        if(!empty($getd)){
            foreach($getd as $key=>$value){
                //print_r($value);exit;
                $this->send_push_notification($value->device_token,$message,$value->dtype);
            }
        }
    }

    public function cronbalert()
    {
        $query = 'SELECT * FROM (SELECT UC.main_artist, U.id, PN.device_type, PN.device_token, PN.device_id, UC.master_content_id, UC.content_id, UC.unique_code, U.app_language, BW.master_content_id as default_master_content_id, BW.content_id as default_content_id, BW.message, UC.title, MC.main_artist as ma  FROM `tbl_users` U
JOIN tbl_pushnotifications as PN ON U.id = PN.user_id
JOIN tbl_birthday_wishes as BW ON BW.language_id = U.app_language
LEFT JOIN tbl_usercontentview as UCV ON U.id = UCV.user_id
LEFT JOIN tbl_content as MC ON (UCV.content_id = MC.master_content_id AND MC.language_id = 1)
LEFT JOIN tbl_content as C ON (C.title LIKE ("%happy birthday%") AND C.language_id = 1 AND C.main_artist = MC.main_artist)
LEFT JOIN tbl_content as UC ON (UC.master_content_id = C.master_content_id AND C.language_id = U.app_language)
WHERE day(U.dob)=day(curdate()) AND month(U.dob)= month(curdate()) AND dob <> "0000-00-00"
GROUP BY MC.main_artist
ORDER BY COUNT(MC.main_artist) DESC) as birthday_temp GROUP BY id;';
        $result = $this->common_model->pureQuery($query);
        if (!empty($result)) {
            foreach ($result as $key=>$val){
                $message = $val->message;
                $custom_message = ['master_content_id' => $val->default_master_content_id,'content_id' => $val->default_content_id, 'unique_code' => $val->unique_code];
                if(!empty($val->master_content_id) && !empty($val->content_id)){
                    $custom_message = ['master_content_id' => $val->default_master_content_id,'content_id' => $val->default_content_id, 'unique_code' => $val->unique_code];
                }
                $this->send_push_notification($val->device_token,$message,$val->device_type,$custom_message);
            }
        }

    }

    public function cronbirth(){
        $query = 'SELECT * FROM (SELECT MC.main_artist, U.name as app_user, U.id, PN.device_type, PN.device_token, PN.device_id,  U.app_language,BW.image as birthday_image,BW.contentclip_filename, BW.master_content_id as default_master_content_id, BW.content_id as default_content_id, BW.message, MC.main_artist as ma, BC.b_media_file, AC.clip_filename as artist_clip, CU.clip_filename as user_clip,AC.id as artist_id, CU.id as common_user_id  FROM `tbl_users` U
JOIN tbl_pushnotifications as PN ON U.id = PN.user_id
JOIN tbl_birthday_wishes as BW ON BW.id = 1
LEFT JOIN tbl_common_users as CU ON CU.name = U.name
LEFT JOIN tbl_usercontentview as UCV ON U.id = UCV.user_id
LEFT JOIN tbl_content as MC ON (UCV.content_id = MC.master_content_id AND MC.language_id = 1)
LEFT JOIN tbl_artist_clips as AC ON AC.name = MC.main_artist
LEFT JOIN tbl_birthday_clips as BC ON (BC.common_user_id = CU.id AND BC.artist_id = AC.id)
WHERE day(U.dob)=day(curdate()) AND month(U.dob)= month(curdate()) AND dob <> "0000-00-00" AND U.status = 1
GROUP BY MC.main_artist
ORDER BY COUNT(MC.main_artist) DESC) as birthday_temp GROUP BY id;';
        $result = $this->common_model->pureQuery($query);
        if (!empty($result)) {
            foreach ($result as $key=>$val){
                if(empty($val->b_media_file) && empty($val->artist_clip) && empty($val->user_clip)){
                    $media_file = $val->contentclip_filename;
                }elseif(empty($val->b_media_file)){
                    $input_file1 ="http://sprintmediasg.s3.amazonaws.com/birthday/{$val->artist_clip}";
                    $input_file2 ="http://sprintmediasg.s3.amazonaws.com/birthday/{$val->user_clip}";
                    $input_out1 = FCPATH."audios/$val->artist_clip";
                    $input_out2 = FCPATH."audios/$val->user_clip";
                    exec("/usr/local/bin/ffmpeg -y -i $input_file1 -ab 128k -ar 44100 -ac 2 $input_out1");
                    exec("/usr/local/bin/ffmpeg -y -i $input_file2 -ab 128k -ar 44100 -ac 2 $input_out2");
                    $file_name = "BIRAU_".strtotime(date('Y-m-d H:i:s')).".mp3";
                    $output =FCPATH."audios/$file_name";
                    exec("/usr/local/bin/ffmpeg -i 'concat:$input_out1|$input_out2' -acodec copy $output");
                    if($this->s3upload(FCPATH."audios/",$file_name,'birthday')){
                        $this->common_model->initialise('birthday_clips');
                        $this->common_model->array=['common_user_id'=>$val->common_user_id, 'artist_id'=>$val->artist_id,'b_media_file'=>$file_name];
                        $this->common_model->insert_entry();
                        $media_file = $file_name;
                    }else{
                        $media_file = $val->contentclip_filename;
                    }
                }else{
                    $media_file = $val->b_media_file;
                }
                $message = $val->message;
                $custom_message = ['code'=> 800, 'birthday_image' => $val->birthday_image,'media_file' => $media_file];
                //print_r($custom_message);
                $this->send_push_notification($val->device_token,$message,$val->device_type,$custom_message);
            }
        }
    }

    public function generalalert(){
        $this->common_model->initialise('alerts');
        $where="WHERE push_time > date_sub(now(), interval 5 minute)";
        $select="*";
        $data_array= $this->common_model->get_records(2, $select, $where);
        foreach($data_array as $keys => $values){
            $send = (array)$values;
            $this->send_not($send);
        }
    }

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
            $custom_message=array('code'=> 801, 'master_content_id'=>$data['master_content_id'],'content_id'=>$data['content_id'],'unique_code' => $unique_code->unique_code );
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




}//class

?>
