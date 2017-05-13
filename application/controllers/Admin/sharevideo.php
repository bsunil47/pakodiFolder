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
class Sharevideo extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    public function __construct() {

        parent::__construct();
        //echo base_url();

        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('admin_main.php');
    }

    public function index() {
        $this->common_model->initialise('content');
        $where = array('content_type' => 2);
        $getcontent = $this->common_model->get_records(0, '*', $where);
         if (!empty($getcontent)) {
            foreach ($getcontent as $row) {
                $audio_file = FCPATH . "audios/" . $row->contentclip_filename;
                $img_file = FCPATH . "appimages/" . $row->thumb_filename;
                $video_file = FCPATH . "audios/out.mp4";
                $video_file1 =FCPATH ."audios/tmpout.mp4";
                $cj = explode(".", $row->thumb_filename);
                $cjj=$cj[0];
               $this->mix_video($audio_file, $img_file, $video_file,$video_file1,$cjj);
            }
        }
    }

    function mix_video($audio_file, $img_file, $video_file,$video_file1,$cjj) {
        $logo_file = FCPATH . "zipfiles/640Pakodi1.jpg";
       // $out_file = FCPATH . "appimages/" . $cjj . ".png";
        //ffmpeg -loop 1 -i out.png -i PKDKAR7545.mp3 -c:v mpeg4 -c:a copy -shortest m44.mp4
                //-shortest -acodec copy
       // $mix = "/usr/local/bin/ffmpeg -loop 1 -i  " . $logo_file . " -i  " . $audio_file . " -c:v mpeg4 -c:a copy -shortest  " . $video_file;
        
       // ffmpeg -loop 1 -i        ../zipfiles/PAKODI_SHAREVIDEO_ICON.png  -i ../audios/PKDKAR7501.mp3     -c:v mpeg4 -c:a libfdk_aac -b:a 128k -shortest   tmpPKDKAR7501.mp4;
 $mixi = "/usr/local/bin/ffmpeg -loop 1 -i  " . $logo_file . " -i  " . $audio_file . " -c:v mpeg4 -c:a libfdk_aac -b:a 128k -shortest  " . $video_file1;
 exec($mixi);
 $mix="/usr/local/bin/ffmpeg  -i  " . $video_file1. " -vf scale=640:640  " . $video_file;
 exec($mix);
//ffmpeg -i tmpPKDKAR7501.mp4 -vf scale=640:640 PKDKAR7501.mp4;
        
        
        if (copy($video_file, FCPATH . "sharevideo/$cjj" .".mp4")) {
            unlink($video_file);
            unlink($video_file1);
        }
    }

    public function mtom()
    {
        $this->common_model->initialise('content');
        $where = array('content_type' => 2);
        $getcontent = $this->common_model->get_records(0, '*', $where);
         if (!empty($getcontent)) {
            foreach ($getcontent as $row) {
                $audio_file = FCPATH . "audios/" . $row->contentclip_filename;
                $cj = explode(".", $row->thumb_filename);
                $cjj=$cj[0]; 
                $video_file = FCPATH . "audios/".$cjj.".mp4";
//$mix=for f in *.mp3; do ffmpeg -i "$f" -c:a libfdk_aac -b:a 64k ../audiomp4/"${f%%.mp3}.mp4";    
$mix="/usr/local/bin/ffmpeg  -i  " . $audio_file . " -c:a libfdk_aac -b:a 64k ". $video_file;
exec($mix);
            }
        }
    }
    
    public function imageresize()
    {
        $this->common_model->initialise('content');
        $where = array('content_type' => 2);
        $getcontent = $this->common_model->get_records(0, '*', $where);
         if (!empty($getcontent)) {
            foreach ($getcontent as $row) {
                $image_file = FCPATH . "appimages/" . $row->thumb_filename;
  //              $video_file = FCPATH . "audios/".$cjj.".mp4";
//$mix=for f in *.mp3; do ffmpeg -i "$f" -c:a libfdk_aac -b:a 64k ../audiomp4/"${f%%.mp3}.mp4";    
//$mix="/usr/local/bin/ffmpeg  -i  " . $audio_file . " -c:a libfdk_aac -b:a 64k ". $video_file;
//exec($mix);
            }
        }
    }
}
