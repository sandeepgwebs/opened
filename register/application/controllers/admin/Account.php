<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    public $error = "";

    public function __construct(){
        parent::__construct();
        $this->load->library('user');
    }

    public function index(){
        if($this->session->userdata('username') != ""){
            redirect('dashboard');
        }else {
            redirect('account/login');
        }
    }

    public function login()	{
        $this->session->sess_destroy();
        $this->load->library('user');

        $data = array();

        $data['pagetitle']  = "Admin Panel - Login";
        $data['action']     = base_url($this->user->getUserDirectory() . 'account/checklogin');

        $this->load->view('admin/account/view_login', $data);

    }

    public function checklogin(){
        if($this->input->get_post('username', True)){
            if($this->user->getUserType() == "admin"){
                $this->load->model('admin/account/model_admin');
                $status =   $this->model_admin->checklogin($this->input->post());
            }else if($this->user->getUserType() == "institute"){
                $this->load->model('model_institute');
                $filter =   array(
                    'email_id'  =>  $this->input->post('username'),
                    'password'  =>  $this->input->post('password')
                );
                $status =   $this->model_institute->getData($filter, true);
            }

            if($status){
                $this->session->set_userdata('userid', $status['id']);
                redirect($this->user->getUserDirectory() . 'dashboard');
            }else{
                redirect($this->user->getUserDirectory() . 'login/invalid');
            }
        }else{
            redirect($this->user->getUserDirectory() . 'login/invalid');
        }
    }

    private function validateLogin($data){

    }

    public function invalid(){
        $data = array();

        $data['pagetitle']  = "Admin Panel - Login";
        $data['action']     = base_url($this->user->getUserDirectory()  . 'account/checklogin');

        $data['invalid']    = "Invalid Login Details";

        $this->load->view('admin/account/view_login', $data);
    }

    public function changepassword(){
        $data = array();

        $data['pagetitle']  = "Admin Panel - Change Password";

        if($this->input->post('')){
            die('test');
        }

        $this->load->view('admin/account/view_changePassword', $data);
    }

    public function logout(){
        $this->user->logout();
        redirect($this->user->getUserDirectory());
    }
}