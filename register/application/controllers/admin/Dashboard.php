<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('user');
    }

	public function index()	{
        $data               = array();
        $data['pagetitle']  = "Dashboard";

        $dashboard  =   array();


        $this->load->view('admin/view_dashboard', $data);

    }

    private function checkCount($data){
        if($data){
            return count($data);
        }else{
            return '0';
        }
    }
}