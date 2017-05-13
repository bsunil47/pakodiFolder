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
class Creports extends My_Controller
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
        $this->common_model->join_tables = array("master_content as MC", "content as C");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.content_id', $having = null);
        $data['share_file'] = $this->report_csv('share',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function viewsreport()
    {
        $data = array();
        $this->common_model->initialise('usercontentview as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.content_id', $having = null);
        $data['views_file'] = $this->report_csv('views',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function downloadsreport()
    {
        $data = array();
        $this->common_model->initialise('usercontentdownload as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.content_id', $having = null);
        $data['downloads_file'] = $this->report_csv('downloads',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function dubsreport()
    {
        $data = array();
        $this->common_model->initialise('userdubs as R');
        $this->common_model->join_tables = array("master_content as MC", "content as C");
        $this->common_model->join_on = array("MC.master_content_id = R.content_id", "MC.master_content_id = C.master_content_id");
        $limit = $this->limit;
        $select = $this->select;
        $where = "date_format(R.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $where = "DATE_FORMAT(R.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
        }
        $where .= "AND C.language_id = 1";
        $data['records'] = $this->common_model->get_records($limit, $select, $where, $col = 'cnt', $order = 'desc', $groupby = 'R.content_id', $having = null);
        $data['dubs_file'] = $this->report_csv('dubs',$data['records']);
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

    public function search(){
        $data = array();
        if(!empty($_POST['search_by']) && !empty($_POST['search_word'])){
            $data['search_by'] = $search_by = $_POST['search_by'];
            $data['search_word']= $search_word = $_POST['search_word'];
            $where = "";
            if(!empty($_POST['fromdate'])){
                $where = "AND DATE_FORMAT(datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "' ";
            }
            $query = "Select * FROM (select unique_code, main_artist, movie_name,
(SELECT COUNT(*) FROM tbl_usercontentview where content_id = C.master_content_id {$where}) as viewCount,
(SELECT COUNT(*) FROM tbl_usercontentdownload where content_id = C.master_content_id {$where}) as downloadCount,
(SELECT COUNT(*) FROM tbl_userdubs where content_id = C.master_content_id {$where}) as dubCount,
(SELECT COUNT(*) FROM tbl_usercontentshare where content_id = C.master_content_id {$where}) as shareCount From tbl_content as C where C.$search_by LIKE '%{$search_word}%' AND C.language_id = 1 ) as  tmp where viewCount <> 0 OR downloadCount <> 0 OR dubCount <> 0 OR shareCount <> 0";

            $data['search']= $search= $this->common_model->pureQuery($query);

            $data['search_file'] = $this->report_csv($search_word,$data['search']);

        }
        $this->layout->view($this->view_dir, $data);
    }

    public function contentreport()
    {
        $data = array();
        if (!empty($_POST['uid'])) {
            $daterange = "date_format(U.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
            if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
                $daterange = " AND DATE_FORMAT(U.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "'";
            }
            $this->common_model->initialise('master_content as MC');
            $this->common_model->join_tables = 'usercontentdownload as U';
            $this->common_model->join_on = 'MC.master_content_id = U.content_id';
            $select = 'count(U.content_id) as downloadcount';
            $where = "MC.unique_code = '" . $_POST['uid'] . "' " . $daterange;
            // $where="MC.unique_code=".$_POST['uid'].$daterange;
            $data['downloadcount'] = $this->common_model->get_record_single($where, $select, 'U.content_id');
            $this->common_model->initialise('master_content as MC');
            $this->common_model->join_tables = 'usercontentshare as U';
            $this->common_model->join_on = 'MC.master_content_id = U.content_id';
            $select = 'count(U.content_id) as sharedcount';
            $where = "MC.unique_code = '" . $_POST['uid'] . "' " . $daterange;
            $data['sharedcount'] = $this->common_model->get_record_single($where, $select, 'U.content_id');
            $this->common_model->initialise('master_content as MC');
            $this->common_model->join_tables = 'usercontentview as U';
            $this->common_model->join_on = 'MC.master_content_id = U.content_id';
            $select = 'count(U.content_id) as viewedcount';
            $where = "MC.unique_code = '" . $_POST['uid'] . "' " . $daterange;
            $data['viewedcount'] = $this->common_model->get_record_single($where, $select, 'U.content_id');
            $this->common_model->initialise('master_content as MC');
            $this->common_model->join_tables = 'userdubs as U';
            $this->common_model->join_on = 'MC.master_content_id = U.dub_done_content_id';
            $select = 'count(U.dub_done_content_id) as dubscount';
            $where = "MC.unique_code = '" . $_POST['uid'] . "' " . $daterange;
            $data['dubscount'] = $this->common_model->get_record_single($where, $select, 'U.dub_done_content_id');
        }

        $this->layout->view($this->view_dir, $data);
    }

	public function langwisereport(){
			$data = array();
			$daterange = " AND date_format(MC.`datecreated`, '%Y-%m')=date_format(now(), '%Y-%m') ";
            if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
				//echo $_POST['fromdate'];exit;
                $daterange = " AND DATE_FORMAT(MC.datecreated,'%m/%d/%Y') between '" . $_POST['fromdate'] . "' and '" . $_POST['todate'] . "'";
			
			}$data_array=$this->common_model->pureQuery("(SELECT count(MC.language_id) as languagecount, MC.content_status, l.language FROM `tbl_master_content` as MC JOIN `tbl_languages` as l ON `MC`.`language_id`=`l`.`lang_id` WHERE MC.content_status = 1 {$daterange} GROUP BY (MC.language_id) ORDER BY `l`.`lang_id` desc)
UNION 
(SELECT count(MC.language_id) as languagecount, MC.content_status, l.language FROM `tbl_master_content` as MC JOIN `tbl_languages` as l ON `MC`.`language_id`=`l`.`lang_id` WHERE MC.content_status <> 1 {$daterange} GROUP BY (MC.language_id) ORDER BY `l`.`lang_id` desc)");
					//echo "<pre>"; print_r($data_array);echo "first records completed";
			$array_ln_list =[];
			foreach($data_array as $key => $value){
				
				if(!in_array($value->language,$array_ln_list)){
					$array_ln_list[] = $value->language;
					$sorted_array[$value->language]['languagecount'] = $value->languagecount;
					if($value->content_status == 1){
						$sorted_array[$value->language]['active'] = $value->languagecount;
					}else{
						$sorted_array[$value->language]['inactive'] = $value->languagecount;
					}
				}else{
					$sorted_array[$value->language]['languagecount'] = $sorted_array[$value->language]['languagecount'] + $value->languagecount;
					if($value->content_status == 1){
						$sorted_array[$value->language]['active'] = $value->languagecount;
					}else{
						$sorted_array[$value->language]['inactive'] = $value->languagecount;
					}
				}

				
				
				
				
			}
			if(@$_POST['category']=="" && @$_POST['language']==""){
			
			$data_array_catlang=$this->common_model->pureQuery("(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 1 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 1 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 2 {$daterange} AND MC.content_status = 1  and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 2 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 3 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 3 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 4 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 4 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 5 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 5 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 6 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 6 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 7 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 7 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 8 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 8 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 9 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 9 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 10 {$daterange} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = 10 {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))");
			
			//print_r($data_array_catlang);exit;
			}else if(@$_POST['category']!="" && @$_POST['language']==""){
			
			/*echo "(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' AND MC.content_status = 1 GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' AND MC.content_status <> 1 GROUP BY (MC.language_id))
)";exit;*/
				
			$data_array_catlang=$this->common_model->pureQuery("(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' {$daterange}  AND MC.content_status = 1 and C.language_id = '1' GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' {$daterange}  AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (MC.language_id))
");	
				
			}else{
				$language=$_POST['language'];
				/*echo "(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id={$language} JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' AND MC.content_status = 1 GROUP BY (MC.language_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id={$language} JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' AND MC.content_status <> 1 GROUP BY (MC.language_id))
";exit;*/
			//(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '1' AND MC.language_id=1 AND MC.content_status = 1 GROUP BY (c.cat_id)) UNION (SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '1' AND MC.language_id=1 AND MC.content_status <> 1 GROUP BY (c.cat_id))

			$data_array_catlang=$this->common_model->pureQuery("(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON MC.language_id=l.lang_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' {$daterange} AND MC.language_id ={$language} AND MC.content_status = 1 and C.language_id = '1' GROUP BY (c.cat_id))
UNION
(SELECT count(MC.master_content_id) as mastr_cat_count, MC.category_id,MC.content_status,l.language,c.category,c.cat_id from tbl_master_content as MC JOIN tbl_languages as l ON l.lang_id=MC.language_id JOIN tbl_categories as c ON MC.category_id=c.cat_id where MC.category_id = '".$_POST['category']."' AND MC.language_id={$language} {$daterange} AND MC.content_status <> 1 and C.language_id = '1' GROUP BY (c.cat_id))
");	
			}
		//echo "<pre>";print_r($data_array_catlang);echo "main arrray completed"; 
		 
				 
		 $array_cat_ln_list =[];
		 //$array_lang_ln_list =[];
		 foreach($data_array_catlang as $keys => $values){
			 //echo "";print_r($keys);echo "first keys";
			 //echo "<pre>";print_r($array_cat_ln_list);echo "first values";
			 if(empty($array_cat_ln_list[$values->cat_id])){
				 //echo "<pre>"; print_r($values);
				 if(!empty($array_cat_ln_list[$values->cat_id]) && in_array($values->language,$array_cat_ln_list[$values->cat_id])){
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['mastr_cat_count']= $sorted_catlangrecords_array[$values->cat_id][$values->language]['mastr_cat_count'] + $values->mastr_cat_count;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['category']= $values->category;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['language']= $values->language;
					 if($values->content_status == 1){
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['active_cat'] = $values->mastr_cat_count;
					//echo $values->mastr_cat_count;echo "i am first count";
					}else{
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['inactive_cat'] = $values->mastr_cat_count;
						//echo $values->mastr_cat_count;echo "i am first else count";
					}
					 
				 }else{
					 //echo "<pre>";print_r($array_cat_ln_list);
					 $array_cat_ln_list[$values->cat_id][] = $values->language;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['mastr_cat_count']= $values->mastr_cat_count;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['category']= $values->category;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['language']= $values->language;
					 if($values->content_status == 1){
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['active_cat'] = $values->mastr_cat_count;
						
					
					}else{
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['inactive_cat'] = $values->mastr_cat_count;
						
					}
					 
				 }
			 }else{
				 if(!empty($array_cat_ln_list[$values->cat_id]) && in_array($values->language,$array_cat_ln_list[$values->cat_id])){
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['mastr_cat_count']= $sorted_catlangrecords_array[$values->cat_id][$values->language]['mastr_cat_count'] + $values->mastr_cat_count;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['category']= $values->category;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['language']= $values->language;
					 if($values->content_status == 1){
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['active_cat'] = $values->mastr_cat_count;
					
					}else{
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['inactive_cat'] = $values->mastr_cat_count;
					}
					 
				 }else{
					 $array_cat_ln_list[$values->cat_id][] = $values->language;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['mastr_cat_count']= $values->mastr_cat_count;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['category']= $values->category;
					 $sorted_catlangrecords_array[$values->cat_id][$values->language]['language']= $values->language;
					 if($values->content_status == 1){
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['active_cat'] = $values->mastr_cat_count;
					
					}else{
					 
						$sorted_catlangrecords_array[$values->cat_id][$values->language]['inactive_cat'] = $values->mastr_cat_count;
					}
					 
				 }
			 }
			 
			 /*if(!in_array($values->language,$array_cat_ln_list)){
				 
				 $array_cat_ln_list[] = $values->language;
				 
				 $sorted_catlangrecords_array[$values->language]['mastr_cat_count']= $values->mastr_cat_count;
				 
				 
				 $sorted_catlangrecords_array[$values->language]['category']= $values->category;
				
				if($values->content_status == 1){
					 
					$sorted_catlangrecords_array[$values->language]['active_cat'] = $values->mastr_cat_count;
					
				 }else{
					 
					 $sorted_catlangrecords_array[$values->language]['inactive_cat'] = $values->mastr_cat_count;
				 }
				 
			 }else{
				 
				 $sorted_catlangrecords_array[$values->language]['mastr_cat_count']=$sorted_catlangrecords_array[$values->language]['mastr_cat_count']+$values->mastr_cat_count;
				 
				 if($values->content_status == 1){
					 
					 $sorted_catlangrecords_array[$values->language]['active_cat'] = $values->mastr_cat_count;
				 
				 }else{
					 
					 $sorted_catlangrecords_array[$values->language]['inactive_cat'] = $values->mastr_cat_count;
				 }

			 }*/
			 
			
		 }
		 
			
			$this->common_model->initialise('languages');
			$data['language']=$this->common_model->get_records(0, '*', array('status' => 1));
			$this->common_model->initialise('categories');
			$data['category'] = $this->common_model->get_records(0, 'cat_id,category', 0,$col = 'cat_id', $order = 'asc', $groupby = 'cat_id');
		 $data['langwisereports'] = @$sorted_array;
		// echo "<pre>";print_r($sorted_array);echo "first table records";
		 $data['catwiselangrecords']=@$sorted_catlangrecords_array;
		 //echo "<pre>";print_r($sorted_catlangrecords_array);exit;
		$this->layout->view($this->view_dir, $data);
		
	}
    public function yearreportdetails($year,$type){
        $data = array();
        $data_tables = array('userviewsreport','userdownloadsreport','userdubsreport','usersharereport');
        $where_query = "";
        $data['records'] = $this->$data_tables[$type]($year,$where_query);
        $data['year_details_file'] = $this->report_csv('year_details',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function monthreportdetails($year,$month,$type){
        $data = array();
        $data_tables = array('userviewsreport','userdownloadsreport','userdubsreport','usersharereport');
        $where_query = $this->month_week_day($month,0,0);
        //echo $data_tables[$type];
        $data['records'] = $this->$data_tables[$type]($year,$where_query);
        //print_r($data); exit;
        $data['month_details_file'] = $this->report_csv('month_details',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function weekreportdetails($year,$month,$week,$type){
        $data = array();
        $data_tables = array('userviewsreport','userdownloadsreport','userdubsreport','usersharereport');
        $where_query = $this->month_week_day($month,$week,0);
        $data['records'] = $this->$data_tables[$type]($year,$where_query);
        $data['week_details_file'] = $this->report_csv('week_details',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    public function dayreportdetails($year,$day,$type){
        $data = array();
        $data_tables = array('userviewsreport','userdownloadsreport','userdubsreport','usersharereport');
        $where_query = $this->month_week_day(0,0,$day);
        $data['records'] = $this->$data_tables[$type]($year,$where_query);
        $data['day_details_file'] = $this->report_csv('day_details',$data['records']);
        $this->layout->view($this->view_dir, $data);
    }

    private function month_week_day($month,$week,$day){
        if(!empty($month) && !empty($week)){
            return $where_query = "AND date_format(`R`.`datecreated`, '%m') = {$month} AND date_format(`R`.`datecreated`, '%u') = {$week}  ";
        }elseif(!empty($month)){
            return $where_query = "AND date_format(`R`.`datecreated`, '%m') = {$month}  ";
        }elseif(!empty($day)){
            return $where_query = "AND date(`R`.`datecreated`) = '{$day}'  ";
        }

    }

    private function userviewsreport($year,$where_query){
        $this->common_model->initialise('usercontentview as R');
        $this->common_model->join_tables = array('master_content as MC','content as C','users as U');
        $this->common_model->join_on = array('MC.master_content_id = R.content_id','MC.master_content_id = C.master_content_id','R.user_id = U.id');
        $where= "date_format(`R`.`datecreated`, '%Y') = {$year}  $where_query  AND C.language_id = 1";
        $select="U.name,MC.unique_code,C.title,MC.thumb_filename,MC.contentclip_filename";
        return $data['records'] = $this->common_model->get_records(0,$select, $where, $col = 'R.ucv_id', $order = 'desc');
    }

    private function userdownloadsreport($year,$where_query){
        $this->common_model->initialise('usercontentdownload as R');
        $this->common_model->join_tables = array('master_content as MC','content as C','users as U');
        $this->common_model->join_on = array('MC.master_content_id = R.content_id','MC.master_content_id = C.master_content_id','R.user_id = U.id');
        $where= "date_format(`R`.`datecreated`, '%Y') = {$year} $where_query  AND C.language_id = 1";
        $select="U.name,MC.unique_code,C.title,MC.thumb_filename,MC.contentclip_filename";
        return $data['records'] = $this->common_model->get_records(0,$select, $where, $col = 'R.ucd_id', $order = 'desc');
    }

    private function userdubsreport($year,$where_query){
        $this->common_model->initialise('userdubs as R');
        $this->common_model->join_tables = array('master_content as MC','content as C','users as U');
        $this->common_model->join_on = array('MC.master_content_id = R.dub_done_content_id','MC.master_content_id = C.master_content_id','R.user_id = U.id');
        $where= "date_format(`R`.`datecreated`, '%Y') = {$year}  $where_query  AND C.language_id = 1";
        $select="U.name,MC.unique_code,C.title,MC.thumb_filename,MC.contentclip_filename";
        return $data['records'] = $this->common_model->get_records(0,$select, $where, $col = 'R.dub_id', $order = 'desc');
    }

    private function usersharereport($year,$where_query){
        $this->common_model->initialise('usercontentshare as R');
        $this->common_model->join_tables = array('master_content as MC','content as C','users as U');
        $this->common_model->join_on = array('MC.master_content_id = R.content_id','MC.master_content_id = C.master_content_id','R.user_id = U.id');
        $where= "date_format(`R`.`datecreated`, '%Y') = {$year} $where_query  AND C.language_id = 1";
        $select="U.name,MC.unique_code,C.title,MC.thumb_filename,MC.contentclip_filename";
        return $data['records'] = $this->common_model->get_records(0,$select, $where, $col = 'R.ucs_id', $order = 'desc');
    }

    private function dashboard_query($type,$where="")
    {
        if ($type == 'year') {
            return "SELECT *
	                    FROM
    	                (
    	                  (SELECT IFNULL(0,0) as dubCount, IFNULL(0,0) as downloadCount,COUNT(*) as viewCount, IFNULL(0,0) as shareCount,date_format(`datecreated`, '%Y') as year FROM tbl_usercontentview UCV GROUP BY date_format(`datecreated`, '%Y')) union
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
        return $data;
    }

    private function report_csv($file_type,$data){
        $special_type =array('share','views','downloads','dubs');
        $period_type = array('day','month','week','year');
        $period_detail_type = array('day_details','month_details','week_details','year_details');
        $file_name = "{$file_type}_".strtotime("now").".csv";
        $file = FCPATH . "appimages/".$file_name;
        $fp = fopen($file, 'w');
        if(in_array($file_type,$special_type)){
            $head = array('Unique_code','Title','Count');
        }elseif(in_array($file_type, $period_type)) {
            $head = array($file_type,'views','downloads','dubs','share');
        }elseif(in_array($file_type, $period_detail_type)){
            $head = array('User Name','Unique_code','Title');
        }else{
            $head = array('Unique_code','Movie Name', 'Main Artist','Views','Downloads','Dubs','Share');
        }

        fputcsv($fp,$head);
        foreach ($data as $fields) {
            if(in_array($file_type,$special_type)){
                $feilds = array($fields->unique_code,$fields->title,$fields->cnt);
            }elseif(in_array($file_type,$period_type)) {
                $feilds = array($fields[$file_type], !empty($fields['viewCount']) ? $fields['viewCount'] : 0, !empty($fields['downloadCount']) ? $fields['downloadCount'] : 0, !empty($fields['dubCount']) ? $fields['dubCount'] : 0, !empty($fields['shareCount']) ? $fields['shareCount'] : 0);
            }elseif(in_array($file_type,$period_detail_type)){
                $feilds = array($fields->name,$fields->unique_code,$fields->title);
            }else{
                $feilds = array($fields->unique_code,$fields->movie_name, $fields->main_artist, $fields->viewCount, $fields->downloadCount, $fields->dubCount,$fields->shareCount);
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
        return $jpg = $this->s3->putObject($file1, 'sprintmedia', "$type/$fp1", $acl = 'public-read', $metaHeaders = array(), $requestHeaders = 'ContentDisposition = attachment; filename='.$fp1);
    }


}//class
