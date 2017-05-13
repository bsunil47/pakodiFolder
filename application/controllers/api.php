<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of API
 * This give webservice for login,signup forgot password and new password for mobile application
 * @author kesav
 */
class API extends My_Controller {

//put your code here
    

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
    }

    //Login Method
    public function ping() {
        if ($this->input->server('REQUEST_METHOD') != 'GET') {
            $this->api_model->response('', 406);
        }
        
        $output = $this->api_model->json(['message'=>'true'], true);
        echo $output;
    }
    
    public function ping1() {
        if ($this->input->server('REQUEST_METHOD') != 'GET') {
            $this->api_model->response('', 406);
        }
        
        $output = $this->api_model->json(['message'=>'true'], true);
        echo $output;
    }
    
    public function dbcheck() {
        if ($this->input->server('REQUEST_METHOD') != 'GET') {
            $this->api_model->response('', 406);
        }
        
        $output = $this->api_model->json(['message'=>'true'], true);
        echo $output;
    }
    
    public function s3check() {
        if ($this->input->server('REQUEST_METHOD') != 'GET') {
            $this->api_model->response('', 406);
        }
        $this->load->library('s3');
        if (($contents = $this->s3->getBucket('omichek')) !== false) {
            $data = ['message'=>'true'];
        }else{
             $data = ['message'=>'false'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }


    public function userupdate(){
        $this->common_model->initialise('user_types as UT');
        $this->common_model->join_tables=('users as U');
        $this->common_model->join_on="UT.user_id = U.id";
        $select=array('U.id','U.password');
        $where=array('UT.user_type <'=> 5);
        $data=$this->common_model->get_records(0,$select,$where);
        $this->common_model->initialise('users');
        foreach($data as $key=>$value)
        {
            $this->common_model->array = array('password' => md5($value->password));
            $update=$this->common_model->update(array('id' => $value->id));
        }
        if($update==0){
            $data['info']=["status" => 1,"Message" => "Sucess"];
        }
        else {
            $data['info'] =["status" => 0,"Message" => "Insufficient Data"];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

}

