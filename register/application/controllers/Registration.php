<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {
	public $pageTitle = "Register";
	public $error;

	public function __construct(){
		parent::__construct();
	}

	public function index()	{
		$data = $this->getOtherData();

		$this->load->model('model_content');
		$data['content'] = $this->model_content->getData(array('slug' => 'registration_fee'), true);

        $this->load->view('view_registration', $data);
    }

    public function confirm(){
        $data = $this->getOtherData();
        $json = array();

        $postData = $this->input->post();

        if($this->validateSignup($postData)){
            $this->load->model('model_registration');

            if($postData['country'] == "India"){
                $country = "indian";
                $postData['currency']   =   "inr";
            }else{
                $country = "nonindian";
                $postData['currency']   =   "usd";
            }
            $filter = array(
                'category'      =>  $postData['category'],
                'type'          =>  $postData['type'],
                'nationality'   =>  $country,
            );


            $this->load->model('model_fees');
            $feeData = $this->model_fees->getData($filter, true);

            //$registrationCharges = $this->config->item('payment_fee');
            $postData['amount'] =   $feeData['fees'];


            // extra pages
            if(isset($postData['paper_pages']) && $postData['paper_pages'] > 8){
                $filter_extra_paper = array(
                    'category'      =>  'author',
                    'type'          =>  'extra_page',
                    'nationality'   =>  $country,
                );
                $extraPageFee = $this->model_fees->getData($filter_extra_paper, true);
                $postData['amount'] = $postData['amount'] + ($extraPageFee['fees'] * ($postData['paper_pages'] - 8));
            }

            //$this->functions->printResponse($postData);die;

            $error = false;
            foreach($_FILES as $key => $file){
                $file['name']   =   str_replace(' ', '_', $file['name']);
                $image_config   =   $this->functions->file_upload_config($file['name'], $this->config->item('dir_download'), true);
                $this->upload->initialize($image_config);

                if($this->upload->do_upload($key)){
                    $postData[$key] = $image_config['file_name'];
                }else{
                    $error = true;
                    $this->error = $this->upload->display_errors();
                }
            }

            if($error){
                $json['status'] = false;
                $json['msgType'] = "error";
                $json['message'] = $this->error;
            }else{
                $registrationID = $this->model_registration->insert($postData);

                if($registrationID){
                    /*$msgData = array(
                        "[firstname]"           =>  $postData['firstname'],
                        "[lastname]"            =>  $postData['lastname'],
                    );
                    $this->load->model('model_email');
                    $emailStatus = $this->model_email->sendEmailCI($postData['email_id'], 'registration', $msgData);*/

                    $json['status']         =   true;
                    $json['msgType']        =   "success";
                    $json['message']        =   "Thank you for registration. Proceeding to payment gateway. ";
                    $json['redirectURL']    =   base_url('payment/'. $postData['payment_method'] . '/processPayment/' . $registrationID);
                    $json['resetForm']      =   true;
                }else{
                    $json['status']         =   false;
                    $json['msgType']        =   "error";
                    $json['message']        =   "Unable to register!";
                }
            }


        }else{
            $json['status']     =   false;
            $json['message']    =   $this->error;
            $json['msgType']    =   "error";
        }


        $data['json']   =   $json;
        $this->load->view('json', $data);
    }

    private function validateSignup($data){
        $this->load->model('model_registration');

        if(!isset($data['email_id']) || $data['email_id'] == ""){
            $this->error = "Email ID can't be blank!";
            return false;
        }else{
            // check if already registered
            $authorData = $this->model_registration->getData(array('email_id' => $data['email_id'], 'payment_status' => '2'), true);
            if($authorData){
                $this->error = "Email ID already registered!";
                return false;
            }
        }



        return true;
    }

    public function getOtherData(){
        $data = array();

        $data['pageTitle']  =   $this->pageTitle;

        $this->load->model('model_zone');
        $data['countries'] = $this->model_zone->getDataCountry(array());

        return $data;
    }

}
