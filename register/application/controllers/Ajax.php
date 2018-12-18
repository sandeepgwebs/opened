<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public $pagetitle = "Ajax";
	public $error;

	public function __construct(){
		parent::__construct();
	}

    public function getStates(){
        $this->load->model('model_zone');

        $states = $this->model_zone->getDataStates(array('country_name' => $this->input->post('country')));
        if($states){
            $html = "";
            foreach($states as $key_state => $state){
                $html .= "<option>" . $state['state_name'] . "</option>";
            }

            $json['status']     =   true;
            $json['html']       =   $html;
        }else{
            $json['status']     =   false;
            $json['message']    =   "Unable to get states!";
            $json['msgType']    =   "error";
        }

        $data['json']   =   $json;
        $this->load->view('json', $data);
    }

    public function contact(){
        $this->load->model('model_email');

        $postData = $this->input->post();

        if($this->validateContact($postData)){
            $email_array = array(
                '[name]'       =>  $postData['name'],
                '[email]'      =>  $postData['email'],
                '[phone]'      =>  $postData['phone'],
                '[message]'    =>  $postData['message'],
            );
            $email_status = $this->model_email->sendEmailCI('deepakgarg108gmail.com', 'contact_form', $email_array);

            if($email_status){
                $json['status']     =   true;
                $json['msgType']    =   "success";
                $json['message']    =   "Thank you for your inquiry! We will get back to you soon!";
                $json['resetForm']  =   true;
            }else{
                $json['status']     =   false;
                $json['msgType']    =   "error";
                $json['message']    =   "Unable to submit your inquiry!";
            }
        }else{
            $json['status']     =   false;
            $json['msgType']    =   "error";
            $json['message']    =   $this->error;
        }


        $data['json']   =   $json;
        $this->load->view('json', $data);
    }

    private function validateContact($data){
        if(!isset($data['name']) || $data['name'] == ""){
            $this->error = "Name can't be blank!";
            return false;
        }
        if(!isset($data['phone']) || $data['phone'] == ""){
            $this->error = "Mobile can't be blank!";
            return false;
        }
        if(!isset($data['email']) || $data['email'] == ""){
            $this->error = "Email can't be blank!";
            return false;
        }

        return true;
    }
}
