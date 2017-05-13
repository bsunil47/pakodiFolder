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
 * Description of users
 *
 * @author xxxxxxxxxxxxx
 */
class Category extends My_Controller {

    private $view_dir;
    private $admin_base_url;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->admin_base_url = base_url() . 'Admin';
        $allowed_urls = array('forgotpassword');
        if (!in_array($this->router->fetch_method(), $allowed_urls)) {
            if (!$this->_is_logged_in()) {
                redirect(base_url() . "Admin");
            }
        }
        $this->view_dir = 'admin/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->layout->setLayout('admin_main.php');
    }

    public function index() {
        $data = array();
        $this->common_model->initialise('categories');
        //$data['categories'] = $this->common_model->get_records(0, '*', array('status' => 1));
        $data['categories'] = $this->common_model->get_records(0, '*', 0);
        $this->layout->view($this->view_dir, $data);
    }
    public function add() {
        $data = array();
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('category', 'Category Name', 'required|trim');
        $this->form_validation->set_message('required', '%s should not be empty');

        if (isset($_POST['submit'])) {
            if ($this->form_validation->run('category') == FALSE) {

                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $data = array('category' => $this->input->post('category'));
                $this->common_model->initialise('categories');
                $this->common_model->array = $data;
                $this->common_model->insert_entry();
                $id = $this->db->insert_id();
                $data_usertype = array('cat_id' => $this->db->insert_id());
                redirect(base_url() . "Admin/category");
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
     public function update($id,$lang) {
        $data = array();
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_record_single(array('cat_id' => $id, 'language_id'=>$lang), '*');
        //update query
        if (!empty($_POST)) {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('categories');
            $this->common_model->array = $data;
            $where = array('cat_id' => $id, 'language_id'=>$lang);
            $result_update = $this->common_model->update($where);
            $data['category'] = $this->common_model->get_record_single(array('cat_id' => $id), '*');
            if($result_update == 0){
            $this->setFlashmessage('success', 'Category updated successfully');
            redirect(base_url() . "Admin/category");
            }else{
            $this->setFlashmessage('error', 'Please Try again');  
            redirect(base_url() . "Admin/category/update");
        }
        }
        $this->layout->view($this->view_dir, $data);
    }

    public function update1($id) {
        $data = array();
        $this->common_model->initialise('categories');
        $data['category'] = $this->common_model->get_record_single(array('cat_id' => $id), '*');
        //update query
        if (!empty($_POST)) {
            $data = $_POST;
            unset($data['submit']);
            $this->common_model->initialise('categories');
            $this->common_model->array = $data;
            $where = array('cat_id' => $id);
            $result_update = $this->common_model->update($where);
            $data['category'] = $this->common_model->get_record_single(array('cat_id' => $id), '*');
            redirect(base_url() . "Admin/category");
        }
        $this->layout->view($this->view_dir, $data);
    }

    public function categorystatus($id, $status) {
        if ($status == 1) {
            $statusn = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusn = 1;
        }
        $data = $statusn;
        $this->common_model->initialise('categories');
        $this->common_model->status = $data;
        $where = array('cat_id' => $id);
        $this->common_model->set_status($where);
        redirect(base_url() . "Admin/category");
    }
   public function getData() {
        $aColumns = array('language_id', 'cat_id', 'category',  'datecreated', 'status');
        $this->common_model->initialise('categories');
        //$where = array('status' => 1);
        $where = 0;
        
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
	$row[1] = $aRow['category'];
    $row[2] = $aRow['datecreated'];
           /* $status = $aRow['status'];
            if ($status == 1) {
                    $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                } else if ($status == 0 || $status == '' || $status == "NULL") {
                    $statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                }

            $row[3] = $statusn;*/

            //$row[] = '<a href="' . base_url() . 'Admin/category/categorystatus/' . $aRow['cat_id'] . '/' . $aRow['status'] . '"><button class="btn" title="status" style="border:1px solid #cccccc;">Status</button></a>&nbsp;&nbsp;&nbsp;<a href="' . base_url() . 'Admin/category/update/' . $aRow['cat_id'] . '"><button class="btn" title="edit" style="border:1px solid #cccccc;">Edit</button></a>';
            $row[3] = '&nbsp;&nbsp;<a href="' . base_url() . 'Admin/category/update/' . $aRow['cat_id'] .'/' . $aRow['language_id'] .'"><button class="btn" title="edit" style="border:1px solid #cccccc;">Edit</button></a>';
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
}
