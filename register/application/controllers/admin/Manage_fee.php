<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_fee extends CI_Controller {
    public $error;
    public $pagetitle   =   "Manage Fee";
    public $page        =   "manage_fee";

    function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE));
        $this->load->library('user');
        $this->load->library('ckeditor');
    }

    public function index()	{
        $data               = array();

        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        $data['rows']       = $this->getlist();
        $data['data']       = $this->getOtherData();
        $data['list']       = $data['rows'];
        $data['mode']       = "list";

        $data['btncaption'] = "Add";
        $this->load->view('admin/manage/view_fee', $data);
    }

    public function save(){
        $data   =   array();
        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        if($this->validate($this->input->post())) {
            $this->load->model('model_fees');
            $id = $this->input->post('id');
            $postData = $this->input->post();

            if(isset($id) && $id != ""){
                $status = $this->model_fees->update($postData);
            }else{
                $status = $this->model_fees->insert($postData);
            }

            $data['status']     =   true;
            $data['message']    =   "Record has been Successfully Saved!";
        }else{
            $data['status']     =   false;
            $data['message']    =   $this->error;
            $data['row']        =   $this->input->post();
        }

        $data['mode']   = "save";

        $this->load->model('model_fees');

        $data['rows']       = $this->getlist();
        $data['data']       = $this->getOtherData();
        $data['btncaption'] = "Add";
        $this->load->view('admin/manage/view_fee', $data);
    }

    public function getlist(){
        $this->load->model('model_fees');
        $data = $this->model_fees->getData(array());
        return $data;
    }

    public function edit(){
        $data   =   array();
        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        $id =   $this->input->get('id');
        $this->load->model('model_fees');

        $row    =   $this->model_fees->getData(array('id' => $id), true);
        if($row){
            $data['row']        =   $row;
            $data['btncaption'] = "Update";
        }else{
            $data['status']     =   false;
            $data['message']    =   "Record not found!";
            $data['btncaption'] =   "Add";
        }

        $data['mode']       =   "edit";

        $data['rows']       = $this->getlist();
        $data['data']       = $this->getOtherData();
        $this->load->view('admin/manage/view_fee', $data);
    }

    public function delete(){
        $data   =   array();
        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        $id =   $this->input->get('id');
        $this->load->model('model_fees');
        $row    =   $this->model_fees->getData(array('id' => $id));
        if($row){
            $delete_status  =   $this->model_fees->delete(array('id' => $id));
            if($delete_status){

                $data['status']     =   true;
                $data['message']    =   "Record Deleted!";
            }else{
                $data['status']     =   false;
                $data['message']    =   "Unable to delete this record!";
            }
        }else{
            $data['status']     =   false;
            $data['message']    =   "Record not found!";
        }

        $data['mode']       =   "delete";

        $data['rows']       = $this->getlist();
        $data['data']       = $this->getOtherData();
        $data['btncaption'] = "Add";
        $this->load->view('admin/manage/view_fee', $data);

    }

    private function validate($data){
        $this->load->model('model_fees');

        /*if($data['key'] == ""){
            $this->error = "Key can't be blank!";
            return false;
        }

        if(isset($data['key']) && $data['key'] != "" && $data['id'] == ""){
            $row    =   $this->model_fees->getData(array('key' => $data['key']));
            if($row){
                $this->error = "Key already exists!";
                return false;
            }
        }*/

        return true;
    }

    public function getOtherData(){
        $data = array();

        return $data;
    }
}