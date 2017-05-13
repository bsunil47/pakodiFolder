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
 * Description of reports
 *
 * @author xxxxxxxxxxxxx
 */
class Ccreports extends My_Controller
{

    private $view_dir;
    private $admin_base_url;
    private $limit = 10;
    private $select = array('*', 'count(*) as cnt');

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('forgotpassword');
        if (!in_array($this->router->fetch_method(), $allowed_urls) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
        if ($this->session->userdata['user_type'] === 3) {
            $this->admin_base_url = base_url() . 'moderator';
            redirect($this->admin_base_url . '/users/dashboard');
        } elseif ($this->session->userdata['user_type'] == 4) {
            redirect(base_url() . 'content/index');
        }
        $this->view_dir = 'admin/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('admin_main.php');
    }

    public function index()
    {
        $data = array();
        $query = $this->dashboard_query('week');
        $week = $this->common_model->pureQuery($query);
        $data['week'] = $this->sort_data('week',$week);
        $data['week_file'] = $this->report_csv('week',$data['week']);

        $query = $this->dashboard_query('month');
        $month = $this->common_model->pureQuery($query);
        $data['month'] = $this->sort_data('month',$month);
        $data['month_file'] = $this->report_csv('month',$data['month']);

        $query = $this->dashboard_query('year');
        $year = $this->common_model->pureQuery($query);
        $data['year'] = $this->sort_data('year',$year);
        $data['year_file'] = $this->report_csv('year',$data['year']);
        $this->layout->view($this->view_dir, $data);
    }

    public function sharereport()
    {
        $data = array();
        $this->common_model->initialise('usercontentshare as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.user_id', $having = null);
        $data['share_file'] = $this->report_csv('share',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }
    
    public function sharedetails($id,$date1,$date2){
        $data = array();
        $this->common_model->initialise('usercontentshare as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
        $select = '*';
        $where = "R.user_id = '$id' AND (R.datecreated between '$date1' and '$date2') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "R.user_id = '$id' AND DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records(0, $select, $where, $col = 'R.datecreated', $order = 'desc', $groupby = null, $having = null);
        $data['share_file'] = $this->report_csv('sharedetail',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function viewsreport()
    {
        $data = array();
        $this->common_model->initialise('usercontentview as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.user_id', $having = null);
        $data['views_file'] = $this->report_csv('views',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }
    
    public function viewdetails($id,$date1,$date2){
        $data = array();
        $this->common_model->initialise('usercontentview as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
       // $limit = $this->limit;
        $select = '*';
        $where = "R.user_id = '$id' AND (R.datecreated between '$date1' and '$date2') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "R.user_id = '$id' AND DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records(0, $select, $where, $col = 'R.datecreated', $order = 'desc', $groupby = null, $having = null);
        $data['views_file'] = $this->report_csv('viewdetail',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function downloadsreport()
    {
        $data = array();
        $this->common_model->initialise('usercontentdownload as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.user_id', $having = null);
        $data['downloads_file'] = $this->report_csv('downloads',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }
    
    public function downloaddetails($id,$date1,$date2){
        $data = array();
        $this->common_model->initialise('usercontentdownload as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
        $select = '*';
        $where = "R.user_id = '$id' AND (R.datecreated between '$date1' and '$date2') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "R.user_id = '$id' AND DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records(0, $select, $where, $col = 'R.datecreated', $order = 'desc', $groupby = null, $having = null);
        $data['downloads_file'] = $this->report_csv('downloaddetail',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }
    
    public function dubsreport()
    {
        $data = array();
        $this->common_model->initialise('userdubs as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.user_id', $having = null);
        $data['dubs_file'] = $this->report_csv('dubs',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }
    
    public function dubsdetails($id,$date1,$date2){
        $data = array();
        $this->common_model->initialise('userdubs as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C","users as U");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id","R.user_id = U.id");
         $select = '*';
        $where = "R.user_id = '$id' AND (R.datecreated between '$date1' and '$date2') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "R.user_id = '$id' AND DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records(0, $select, $where, $col = 'R.datecreated', $order = 'desc', $groupby = null, $having = null);
        $data['dubs_file'] = $this->report_csv('dubsdetail',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function yearreport($year){
        $data = array();
        $query = $this->dashboard_query('month',"date_format(`datecreated`, '%Y') = {$year}");
        $month = $this->common_model->pureQuery($query);
        $data['month'] = $this->sort_data('month',$month);
        $data['month_file'] = $this->report_csv('month',$data['month']);
        $this->layout->view($this->view_dir, $data);
    }

    public function monthreport($year,$month){
        $data = array();
        $data['month'] =$month;
        $query = $this->dashboard_query('week',"date_format(`datecreated`, '%Y') = {$year} AND date_format(`datecreated`, '%m') = {$month} ");
        $month = $this->common_model->pureQuery($query);
        $data['week'] = $this->sort_data('week',$month);
        $data['week_file'] = $this->report_csv('week',$data['week']);
        $this->layout->view($this->view_dir, $data);
    }

    public function weekreport($year,$month,$week){
        $data = array();
        $data['month'] =$month;
        $query = $this->dashboard_query('day',"date_format(`datecreated`, '%Y') = {$year} AND date_format(`datecreated`, '%m') = {$month} AND date_format(`datecreated`, '%u') = {$week} ");
        $week = $this->common_model->pureQuery($query);
        $data['day'] = $this->sort_data('day',$week);
        $data['day_file'] = $this->report_csv('day',$data['day']);
        $this->layout->view($this->view_dir, $data);
    }

   public function userreport(){
	 $data = array();
	 $this->common_model->initialise('languages');
    $data['language']=$this->common_model->get_records(0, '*', array('status' => 1));
	 $language_id="";
	 if(!empty($_POST['term'])){
		 $term = @$_POST['term'];
	 $this->common_model->initialise('users');
$userid=$this->common_model->get_record_single("name like '%{$term}%' or email like '%{$term}%' or msisdn like '%{$term}%' ",'id','');

$data['userreportsall']=$this->common_model->pureQuery("SELECT name,(SELECT COUNT(content_id) FROM (SELECT content_id FROM tbl_usercontentview where user_id='$userid->id' group by content_id) as tmp_tl) as ViewCount,(SELECT COUNT(content_id) FROM (SELECT content_id FROM tbl_userdubs where user_id='$userid->id' group by content_id) as tmp_tl) as dubcount,(SELECT COUNT(content_id) FROM (SELECT content_id FROM tbl_usercontentlike where user_id='$userid->id' group by content_id) as tmp_tl) as likecount,(SELECT COUNT(content_id) FROM (SELECT content_id FROM tbl_usercontentdownload where user_id='$userid->id' group by content_id) as tmp_tl) as downloadCount,(SELECT COUNT(content_id) FROM (SELECT content_id FROM tbl_usercontentshare where user_id='$userid->id' group by content_id) as tmp_tl) as shareCount from tbl_users where id='$userid->id'");
	 $cat = '';$lang = '';
		  $data['userreportdetails']=$this->getdetails($cat,$lang,$userid->id);
	 }    
if(isset($_POST['delcontentsubmit_new']) && !empty($_POST['term']))	{
$term = @$_POST['term'];
	 $this->common_model->initialise('users');
$userid=$this->common_model->get_record_single("name like '%{$term}%' or email like '%{$term}%' or msisdn like '%{$term}%' ",'id','');

	$cat = '';
	 if(!empty($_POST['category'])){
		 $cat=$_POST['category'];
	 }
	 $lang='';
	 if(!empty($_POST['language'])){
		 $lang = " AND MC.language_id =".$_POST['language'];
	 }
	 $data['userreportdetails']=$this->getdetails($cat,$lang,$userid->id);
	 	 
	 }
	 
	 
	 
$this->layout->view($this->view_dir,$data);
 }
 private function getdetails($cat,$lang,$id){
	 if($cat=='' || $cat=='all'){
		 /*$query ="select M.unique_code,M.thumb_filename,M.contentclip_filename,L.like_status as likestatus,null as downloadstatus,null as dubstatus,null as sharestatus from tbl_master_content as M join tbl_usercontentlike as L on M.master_content_id = L.content_id where  L.user_id = '$id' $lang
union
select M.unique_code,M.thumb_filename,M.contentclip_filename,null as likestatus,D.status as downloadstatus,null as dubstatus,null as sharestatus from tbl_master_content as M join tbl_usercontentdownload as D on M.master_content_id = D.content_id where  D.user_id = '$id' $lang
union
select M.unique_code,M.thumb_filename,M.contentclip_filename,null as likestatus,null as downloadstatus,B.dub_status as dubstatus,null as sharestatus from tbl_master_content as M join tbl_userdubs as B on M.master_content_id = B.dub_done_content_id where  B.user_id = '$id' $lang
union
select M.unique_code,M.thumb_filename,M.contentclip_filename,null as likestatus,null as downloadstatus,null as dubstatus,S.status as sharestatus from tbl_master_content as M join tbl_usercontentshare as S on M.master_content_id = S.content_id where  S.user_id = '$id' $lang";*/

$query="SELECT

                v.content_id, v.ucv_id as viewstatus,

                l.ucl_id as likestatus,

                d.ucd_id as downloadstatus,s.ucs_id as sharestatus,dbs.dub_id as dubstatus, MC.unique_code,MC.thumb_filename,MC.contentclip_filename

FROM tbl_users as u

JOIN (tbl_usercontentview as v)

ON (v.user_id = u.id)

JOIN (tbl_master_content as MC)

ON (v.content_id = MC.master_content_id)

LEFT JOIN (tbl_usercontentlike as l)

ON (l.user_id = u.id and l.content_id = v.content_id)

LEFT JOIN (tbl_usercontentdownload as d)

ON (d.user_id = u.id and d.content_id = v.content_id)

LEFT JOIN (tbl_usercontentshare as s)

ON (s.user_id = u.id and s.content_id = v.content_id)

LEFT JOIN (tbl_userdubs as dbs)

ON (dbs.user_id = u.id and dbs.content_id = v.content_id)

WHERE u.id = '$id'". $lang ." GROUP BY v.content_id" ;
	 $result = $this->common_model->pureQuery($query);
	 
	 /*$this->common_model->initialise('master_content as M');
	 $this->common_model->join_tables = array ('usercontentlike as L','usercontentdownload as D','userdubs as B','usercontentshare as S','');
	 $this->common_model->join_on = array ('M.master_content_id = L.content_id','M.master_content_id = D.content_id','M.master_content_id = B.content_id','M.master_content_id = S.content_id');
	 $select =array('M.unique_code','M.thumb_filename','M.contentclip_filename','L.like_status as likestatus','D.status as downloadstatus','B.dub_status as dubstatus','S.status as sharestatus');
	 $where = "M.content_status =1 and (L.user_id ='$id' or D.user_id ='$id' or B.user_id ='$id' or S.user_id ='$id')".$lang;
	
	$result = $this->common_model->get_records(0,$select,$where,'','','M.unique_code');*/
 }
 else if($cat == 'view'){
	 $this->common_model->initialise('usercontentview as V');
	 $this->common_model->join_tables = array ('master_content as MC');
	 $this->common_model->join_on = array ('MC.master_content_id = V.content_id');
	 $select =array("MC.unique_code","MC.thumb_filename","MC.contentclip_filename","V.ucv_id as viewstatus","IFNULL(0,0) as likestatus","IFNULL(0,0) as downloadstatus","IFNULL(0,0) as dubstatus","IFNULL(0,0) as sharestatus");
	 $where = "(V.user_id ='$id')".$lang;
	$result = $this->common_model->get_records(0,$select,$where,'','','MC.unique_code'); 
 }
 else if($cat == 'like'){
	 $this->common_model->initialise('usercontentlike as L');
	 $this->common_model->join_tables = array ('master_content as MC');
	 $this->common_model->join_on = array ('MC.master_content_id = L.content_id');
	 $select =array("MC.unique_code","MC.thumb_filename","MC.contentclip_filename","L.ucl_id as likestatus","IFNULL(0,0) as viewstatus","IFNULL(0,0) as downloadstatus","IFNULL(0,0) as dubstatus","IFNULL(0,0) as sharestatus");
	 $where = "(L.user_id ='$id')".$lang;
	$result = $this->common_model->get_records(0,$select,$where,'','','MC.unique_code'); 
 }else if($cat == 'dubs'){
	$this->common_model->initialise('userdubs as B');
	 $this->common_model->join_tables = array ('master_content as MC');
	 $this->common_model->join_on = array ('MC.master_content_id = B.content_id');
	 $select =array("MC.unique_code","MC.thumb_filename","MC.contentclip_filename","B.dub_id as dubstatus","IFNULL(0,0) as viewstatus", "IFNULL(0,0) as likestatus","IFNULL(0,0) as downloadstatus","IFNULL(0,0) as sharestatus");
	 $where = "(B.user_id ='$id')".$lang;
	$result = $this->common_model->get_records(0,$select,$where,'','','MC.unique_code');
	 
 }else if($cat == 'share'){
	$this->common_model->initialise('usercontentshare as S');
	 $this->common_model->join_tables = array ('master_content as MC');
	 $this->common_model->join_on = array ('MC.master_content_id = S.content_id');
	 $select =array("MC.unique_code","MC.thumb_filename","MC.contentclip_filename","S.ucs_id as sharestatus","IFNULL(0,0) as viewstatus","IFNULL(0,0) as likestatus","IFNULL(0,0) as downloadstatus","IFNULL(0,0) as dubstatus");
	 $where = "(S.user_id ='$id')".$lang;
	$result = $this->common_model->get_records(0,$select,$where,'','','MC.unique_code'); 
	 
 }else{
	$this->common_model->initialise('usercontentdownload as D');
	 $this->common_model->join_tables = array ('master_content as MC');
	 $this->common_model->join_on = array ('MC.master_content_id = D.content_id');
	 $select =array("MC.unique_code","MC.thumb_filename","MC.contentclip_filename","D.ucd_id as downloadstatus","IFNULL(0,0) as viewstatus","IFNULL(0,0) as likestatus","IFNULL(0,0) as dubstatus","IFNULL(0,0) as sharestatus");
	 $where = "(D.user_id ='$id')".$lang;
	$result = $this->common_model->get_records(0,$select,$where,'','','MC.unique_code'); 
	 
 }
 return $result;
 }

    private function dashboard_query($type,$where="")
    {
        if ($type == 'year') {
            return "SELECT *
	                    FROM
    	                (
    	                  (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount,COUNT(*) as viewCount, IFNULL(0,0) as shareCount,date_format(`datecreated`, '%Y') as year FROM tbl_usercontentview UCV GROUP BY date_format(`datecreated`, '%Y'),user_) union
    	                  (SELECT COUNT(*) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%Y') as year FROM tbl_userdubs UD GROUP BY date_format(`datecreated`, '%Y')) union
    	                  (SELECT IFNULL(0,0) as dubCount,COUNT(*) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%Y') as year FROM tbl_usercontentdownload UCD GROUP BY date_format(`datecreated`, '%Y')) union
	                      (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount,COUNT(*) as shareCount,date_format(`datecreated`, '%Y') as year FROM tbl_usercontentshare UCS GROUP BY date_format(`datecreated`, '%Y'))
	                    ) as tmp ORDER BY year DESC";
        } elseif ($type == 'month') {
            if(empty($where)){
                $where= "date_format(`datecreated`, '%Y') = date_format(now(), '%Y')";
            }
            return "SELECT *
                        FROM
                        (
                          (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount,COUNT(*) as viewCount, IFNULL(0,0) as shareCount,date_format(`datecreated`, '%b') as month, date_format(`datecreated`, '%m') as month_num FROM tbl_usercontentview UCV WHERE {$where} GROUP BY date_format(`datecreated`, '%m')) union
                          (SELECT COUNT(*) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%b') as month, date_format(`datecreated`, '%m') as month_num FROM tbl_userdubs UD WHERE {$where} GROUP BY date_format(`datecreated`, '%m')) union
                          (SELECT IFNULL(0,0) as dubCount,COUNT(*) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%b') as month, date_format(`datecreated`, '%m') as month_num FROM tbl_usercontentdownload UCD WHERE {$where} GROUP BY date_format(`datecreated`, '%m')) union
                          (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount,COUNT(*) as shareCount,date_format(`datecreated`, '%b') as month, date_format(`datecreated`, '%m') as month_num FROM tbl_usercontentshare UCS WHERE {$where} GROUP BY date_format(`datecreated`, '%m'))
                        ) as tmp ORDER BY month_num ASC";
        } elseif ($type == 'week') {
            if(empty($where)){
                $where= "date_format(`datecreated`, '%Y') = date_format(now(), '%Y') AND date_format(`datecreated`, '%m') = date_format(now(), '%m') ";
            }
            return "SELECT *
                        FROM
                        (
                          (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount,COUNT(*) as viewCount, IFNULL(0,0) as shareCount,date_format(`datecreated`, '%u') as week FROM tbl_usercontentview UCV WHERE {$where} GROUP BY date_format(`datecreated`, '%u')) union
                          (SELECT COUNT(*) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%u') as week FROM tbl_userdubs UD WHERE {$where} GROUP BY date_format(`datecreated`, '%u')) union
                          (SELECT IFNULL(0,0) as dubCount,COUNT(*) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%u') as week FROM tbl_usercontentdownload UCD WHERE {$where} GROUP BY date_format(`datecreated`, '%u')) union
                          (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount,COUNT(*) as shareCount,date_format(`datecreated`, '%u') as week FROM tbl_usercontentshare UCS WHERE {$where} GROUP BY date_format(`datecreated`, '%u'))
                        ) as tmp ORDER BY week ASC";
        }elseif($type == 'day'){
            if(empty($where)){
                $where= "date_format(`datecreated`, '%Y') = date_format(now(), '%Y') AND date_format(`datecreated`, '%m') = date_format(now(), '%m') AND date_format(`datecreated`, '%u') = date_format(now(), '%u') ";
            }
            return "SELECT *
                        FROM
                        (
                          (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount,COUNT(*) as viewCount, IFNULL(0,0) as shareCount,date_format(`datecreated`, '%Y-%m-%d') as day FROM tbl_usercontentview UCV WHERE {$where} GROUP BY DAYOFMONTH(`datecreated`)) union
                          (SELECT COUNT(*) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%Y-%m-%d') as day FROM tbl_userdubs UD WHERE {$where} GROUP BY DAYOFMONTH(`datecreated`)) union
                          (SELECT IFNULL(0,0) as dubCount,COUNT(*) as downloadCount, IFNULL(0,0) as viewCount, IFNULL(0,0) as shareCount, date_format(`datecreated`, '%Y-%m-%d') as day FROM tbl_usercontentdownload UCD WHERE {$where} GROUP BY DAYOFMONTH(`datecreated`)) union
                          (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount, IFNULL(0,0) as viewCount,COUNT(*) as shareCount,date_format(`datecreated`, '%Y-%m-%d') as day FROM tbl_usercontentshare UCS WHERE {$where} GROUP BY DAYOFMONTH(`datecreated`))
                        ) as tmp ORDER BY day ASC";
        }
    }


    private function sort_data($type, $records){
        foreach($records as $keys => $values){
            foreach($values as $key => $value){
                if(!empty($value)){
                    $data[$values->$type][$key] = $value;
                }
            }
        }
        if(!empty($data)){
        return $data;}
    }

    private function report_csv($file_type,$data){
        $special_type =array('share','views','downloads','dubs');
        $detail_type = array('sharedetail','viewdetail','downloaddetail','dubsdetail');
        $file_name = "{$file_type}_".strtotime("now").".csv";
        $file = FCPATH . "appimages/".$file_name;
        //header('Content-Type: text/csv');
        //header('Content-Disposition: attachment; filename='. $file);
        //header('Pragma: no-cache');
        //header("Expires: 0");
        $fp = fopen($file, 'w');
        if(in_array($file_type,$special_type)){
            $head = array('Username','Count');
        }elseif(in_array($file_type,$detail_type)){
            $head = array('Username','Unique_code','Title');
        }
        else{
            $head = array($file_type,'views','downloads','dubs','share');
        }

        fputcsv($fp,$head);
        foreach ($data as $fields) {
            if(in_array($file_type,$special_type)){
                $feilds = array($fields->name,$fields->cnt);
            }elseif(in_array($file_type,$detail_type)){
                 $feilds = array($fields->name,$fields->unique_code,$fields->title);
            }
            else {
                $feilds = array($fields[$file_type], !empty($fields['viewCount']) ? $fields['viewCount'] : 0, !empty($fields['downloadCount']) ? $fields['downloadCount'] : 0, !empty($fields['dubCount']) ? $fields['dubCount'] : 0, !empty($fields['shareCount']) ? $fields['shareCount'] : 0);
            }
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
public function search(){
    $data = array();
    if(!empty($_POST['search_by']) && !empty($_POST['search_word'])){
        $search_by = $_POST['search_by'];
 $search_word = $_POST['search_word'];
 $where = "";
 if(!empty($_POST['fromdate'])){
     $where = "AND DATE_FORMAT(datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
 }
 $query = "Select * FROM (select unique_code, main_artist, movie_name,
(SELECT COUNT(*) FROM tbl_usercontentview where content_id = C.master_content_id {$where}) as viewCount,
(SELECT COUNT(*) FROM tbl_usercontentdownload where content_id = C.master_content_id {$where}) as downloadCount,
(SELECT COUNT(*) FROM tbl_userdubs where content_id = C.master_content_id {$where}) as dubCount,
(SELECT COUNT(*) FROM tbl_usercontentshare where content_id = C.master_content_id {$where}) as shareCount From tbl_content as C where C.$search_by LIKE '%{$search_word}%' AND C.language_id = 1 ) as  tmp where viewCount <> 0 OR downloadCount <> 0 OR dubCount <> 0 OR shareCount <> 0";

       $data['search']=$search= $this->common_model->pureQuery($query);
       $data['search_file'] = $this->report_scsv($_POST['search_by'],$data['search']);
    }    
$this->layout->view($this->view_dir, $data);
}
 private function report_scsv($type,$data){
        $file_name = "{$type}_".strtotime("now").".csv";
        $file = FCPATH . "appimages/".$file_name;
        //header('Content-Type: text/csv');
        //header('Content-Disposition: attachment; filename='. $file);
        //header('Pragma: no-cache');
        //header("Expires: 0");
        $fp = fopen($file, 'w');
        $head = array('Unique_code','MovieName','MainArtist','ViewCount','DownloadCount','DubsCount','ShareCount');
        fputcsv($fp,$head);
        foreach ($data as $fields) {//print_r($fields);
           $feilds = array($fields->unique_code,$fields->movie_name,$fields->main_artist,$fields->viewCount,$fields->downloadCount,$fields->dubCount,$fields->shareCount);
          fputcsv($fp, $feilds);
        }
       // $this->s3upload($file, "reports");
        fclose($fp);
        return $file_name;
 }

}//class
