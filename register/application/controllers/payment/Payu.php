<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payu extends CI_Controller {
    public $pageTitle = "Payment";
    public $error;

    public function __construct(){
        parent::__construct();
    }
    
    public function processPayment(){
        $this->load->model('model_registration');

        if($this->uri->rsegment(3) != ""){
            $registrationID = $this->uri->rsegment(3);
            $registrationData = $this->model_registration->getData(array('id' => $registrationID), true);

            if(!$registrationID){
                redirect(base_url('404'));
            }

            $payu   =   $this->config->item('payu');

            $payuData['firstname']          =   $registrationData['firstname'];
            $payuData['lastname']           =   $registrationData['lastname'];
            $payuData['amount']             =   $registrationData['amount'];
            $payuData['email']              =   $registrationData['email_id'];
            $payuData['phone']              =   $registrationData['phone'];
            $payuData['productinfo']        =   "Registration Fee";
            $payuData['key']                =   $payu['key'];
            $payuData['surl']               =   base_url('payment/payu/success');
            $payuData['furl']               =   base_url('payment/payu/failure');
            $payuData['service_provider']   =   'payu_paisa';

            $payuData['txnid']          =   $registrationData['id'];

            $payuData['udf1']           =   "";
            $payuData['udf2']           =   "";
            $payuData['udf3']           =   "";
            $payuData['udf4']           =   "";

            $timestamp = date('YmdHis', time());

            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';
            foreach($hashVarsSeq as $hash_var) {
                $hash_string .= isset($payuData[$hash_var]) ? $payuData[$hash_var] : '';
                $hash_string .= '|';
            }
            $hash_string .= $payu['salt'];
            //var_dump($hash_string);

            $payuData['hash']       =   strtolower(hash('sha512', $hash_string));
            $payuData['action']     =   $payu['url'] . '/_payment';

            $data['payuData']   =   $payuData;

            //$this->functions->printResponse($payuData);
            //die;

            $this->load->view('payment/payu/view_processPayment', $data);
        }else{
            redirect(base_url('404'));
        }
    }

    public function success(){
        $this->load->model('model_registration');
        $this->load->model('model_email');

        $postData = $this->input->post();
        //$this->functions->printResponse($postData);

        $paymentData = array(
            'id'                =>  $postData['txnid'],
            'payment_status'    =>  '2',
            'payment_response'  =>  serialize($postData),
        );
        $status = $this->model_registration->update($paymentData);

        $data['registrationData']   =   $this->model_registration->getData(array('id' => $postData['txnid']), true);

        //$this->functions->printResponse($data['registrationData']['payment_response']);
        $data['paymentData']    =   unserialize($data['registrationData']['payment_response']);

        //$this->functions->printResponse($data);die;
        $this->load->view('payment/view_receipt', $data);
    }

    public function failure(){
        $data = array();
        $data['pageTitle']  =   "Payment Failed!";
        //$this->functions->printResponse($this->input->post());

        $this->load->model('model_registration');
        $this->load->model('model_email');

        $postData = $this->input->post();
        //$this->functions->printResponse($postData);

        $paymentData = array(
            'id'                =>  $postData['txnid'],
            'payment_status'    =>  '3',
            'payment_response'  =>  serialize($postData),
        );
        $status = $this->model_registration->update($paymentData);

        $data['response']   =   $postData;

        $data['redirectURL']    =   base_url('registration');

        $this->load->view('payment/payu/view_paymentFailed', $data);
    }
}