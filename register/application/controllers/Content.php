<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {
	public $pageTitle = "";
	public $error;

	public function __construct(){
		parent::__construct();
        $this->pageTitle = $this->config->item('project_name');
	}

	public function index()	{
		$data               = $this->getOtherData();

        if($this->uri->rsegment(3) != ""){
            $this->load->model('model_content');
            $data['content']    =   $this->model_content->getData(array('slug' => $this->uri->rsegment(3)), true);
            
            if($data['content']){
                $data['pageTitle']  =   $data['content']['title'];
                $this->load->view('view_content', $data);
            }else{
                redirect(base_url('404'));
            }
        }else{
            redirect(base_url('404'));
        }

	}

	public function forms(){
	    $data   =   $this->getOtherData();
	    if($this->uri->rsegment(3) != ""){
	        $data['formName']   =   $this->uri->rsegment(3);
            $data['pageTitle']  =   ucwords(str_replace(array('_', '-'), ' ', $this->uri->rsegment(3)));

	        // check if view exists else redirect to 404
            if(file_exists( APPPATH . 'views/forms/view_' . $this->uri->rsegment(3) . '.php')){
                $this->load->view('forms/view_' . $this->uri->rsegment(3), $data);
            }else{
                redirect(base_url('404'));
            }
        }else{
	        redirect(base_url('404'));
        }
    }


    private function getOtherData(){
        $data   =   array();

        $this->load->model('model_category');
        $data['categories'] =   $this->model_category->getData(array('limit' => 18));

        $this->load->model('model_journal_master');
        $data['journalMasters'] = $this->model_journal_master->getData(array());

        $this->load->model('model_zone');
        $data['countries'] = $this->model_zone->getDataCountry(array());

        return $data;
    }
}
