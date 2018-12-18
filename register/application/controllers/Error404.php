<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error404 extends CI_Controller {
	public $pageTitle = "Error 404 - Page Not Found";
	public $error;
	public $theme   =   "_default";
	public $logo    =   "";

	public function __construct(){
		parent::__construct();
	}

	public function index()	{
		$data               = $this->getOtherData();
		
        $this->load->view('view_404', $data);
	}


    private function getOtherData(){
        $data   =   array();
        $data['pageTitle']  =   $this->pageTitle;
        return $data;
    }
}
