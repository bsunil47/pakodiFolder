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
 * Description of dubbed users
 *
 * @author xxxxxxxxxxxxx
 */
class Loginusers extends My_Controller {

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
		$this->common_model->initialise('loginusers as L');
        //$this->common_model->join_tables=('users as U');
		$this->common_model->join_tables = array("users as U", "pushnotifications as P");
        //$this->common_model->join_on="L.user_id = U.id";
		$this->common_model->join_on = array("L.user_id = U.id", "L.user_id = P.user_id");
        $where ="date(L.datecreated)=CURDATE()";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(L.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $data['records'] = $this->common_model->get_records(0, 'U.name,L.user_id, L.datecreated,P.device_type,P.device_id,count(L.user_id) AS Countval', $where, $col = 'L.datecreated', $order = 'desc', $groupby = 'L.user_id', $having = null);
        $data['loginusers'] = $this->report_csv('login',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }
	
	public function getData() {
		if(!empty($_POST['sSearch_0'])&& !empty($_POST['sSearch_1'])){
           $where = "DATE_FORMAT(L.datecreated,'%m/%d/%Y') between '".$_POST['sSearch_0']."' and '".$_POST['sSearch_1']."'";
        }else{
			$where ="date(L.datecreated)=CURDATE()";
			}
		$aColumns = array('U.name','L.user_id', 'L.datecreated','count(L.user_id)');
		$this->common_model->initialise('loginusers as L');
        $this->common_model->join_tables = 'users as U';
        $this->common_model->join_on = "U.id = L.user_id";
		
		$group_by = 'user_id';
        
        $data = $this->common_model->getTable($aColumns, $where,'L.datecreated','desc',$group_by);
		$output = $data['output'];
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                 $col = trim($col, 'U.');
                 $col = trim($col, 'L.');
                $row[] = $aRow[$col];
				
            }
            //$row[0] = $i;
            $i = $i + 1;
	$row[1] = $aRow['name'];
	$row[2] = $aRow['count(L.user_id)'];
    $row[3] = $aRow['datecreated'];
           
        $output['aaData'][] = $row;
        }
		echo json_encode($output);
    }

	private function report_csv($file_type,$data){
        $file_name = "{$file_type}_".strtotime("now").".csv";
        $file = FCPATH . "appimages/".$file_name;
        //header('Content-Type: text/csv');
        //header('Content-Disposition: attachment; filename='. $file);
        //header('Pragma: no-cache');
        //header("Expires: 0");
        $fp = fopen($file, 'w');
      
            $head = array('Username','Count','Date');
       
        fputcsv($fp,$head);
        foreach ($data as $fields) {
           
                $feilds = array($fields->name,$fields->Countval,$fields->datecreated);
           
            fputcsv($fp, $feilds);
        }
        $this->s3upload($file, "reports");
        fclose($fp);
        return $file_name;

    }
	
	private function s3upload($filepath, $type)
    {

        $this->load->library('s3');
        $file1 = $this->s3->inputFile($filepath);
        $fil1 = explode('/', $file1['file']);
        $c1 = count($fil1);
        $fp1 = $fil1[$c1 - 1];
        $ff = explode('.', $fp1);
        return $jpg = $this->s3->putObject($file1, 'sprintmediasg', "$type/$fp1", $acl = 'public-read', $metaHeaders = array(), $requestHeaders = 'ContentDisposition = attachment; filename='.$fp1);
    }
	
}//class

