<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('user');
    }
    public function index()	{
        if($this->session->userdata('username') != ""){
            redirect('dashboard');
        }else {

            $data = array();

            $data['pagetitle']  = "Admin Panel - Login";
            $data['action']     = base_url("account/login/checklogin");

            $this->load->view('admin/account/view_login', $data);
        }
    }
/*
    public function checklogin(){
        die('test1');
        if($this->input->get_post('username', True)){
            $this->load->model('admin/account/model_admin');
            $status =   $this->model_admin->checklogin($_REQUEST);
die('test');
            if($status){
                die($this->config->item('admin_folder') . 'dashboard');
                redirect($this->config->item('admin_folder') . 'dashboard');
            }else{
                redirect($this->config->item('admin_folder') . 'login/invalid');
            }
        }else{
            redirect('login');
        }
    }*/

    public function invalid(){
        $data = array();

        $data['pagetitle']  = "Admin Panel - Login";
        $data['action']     = base_url($this->config->item('admin_folder') . 'login/checklogin');

        $data['invalid']    = "Invalid Login Details";

        $this->load->view('admin/account/view_login', $data);
    }
}