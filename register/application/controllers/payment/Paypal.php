<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller {
    public $pageTitle = "Payment";
    public $error;

    public function __construct(){
        parent::__construct();
        //$this->load->library('author');
        $this->load->library('paypal_lib');
    }


    /*function success(){
        //get the transaction data
        $paypalInfo = $this->input->get();

        $data['item_number'] = $paypalInfo['item_number'];
        $data['txn_id'] = $paypalInfo["tx"];
        $data['payment_amt'] = $paypalInfo["amt"];
        $data['currency_code'] = $paypalInfo["cc"];
        $data['status'] = $paypalInfo["st"];

        //pass the transaction data to view
        $this->load->view('paypal/success', $data);
    }*/

    public function cancel(){
        redirect(base_url('registration'));
    }

    public function ipn(){
        //paypal return transaction details array
        $paypalInfo	= $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id']	= $paypalInfo["item_number"];
        $data['txn_id']	= $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status']	= $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;
        $result	= $this->paypal_lib->curlPost($paypalURL,$paypalInfo);

        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            $this->product->insertTransaction($data);
        }
    }
    
    public function processPayment(){
        $this->load->model('model_registration');

        if($this->uri->rsegment(3) != ""){
            $registrationID = $this->uri->rsegment(3);
            $registrationData = $this->model_registration->getData(array('id' => $registrationID), true);

            if(!$registrationData){
                redirect(base_url('404'));
            }


            $payu   =   $this->config->item('payu');

            $returnURL = base_url('payment/paypal/success'); //payment success url
            $cancelURL = base_url('payment/paypal/cancel'); //payment cancel url
            $notifyURL = base_url('payment/paypal/ipn'); //ipn url

            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', "Registration Fee");
            $this->paypal_lib->add_field('item_number',  $registrationID);
            $this->paypal_lib->add_field('amount',  $registrationData['amount']);
            /*$this->paypal_lib->image($logo);*/

            $this->paypal_lib->paypal_auto_form();

            /*$payuData['firstname']          =   $registrationData['firstname'];
            $payuData['lastname']           =   $registrationData['lastname'];
            $payuData['amount']             =   $registrationData['amount'];
            $payuData['email']              =   $registrationData['email_id'];
            $payuData['phone']              =   $registrationData['phone'];
            $payuData['productinfo']        =   "Registration Fee";
            $payuData['key']                =   $payu['key'];
            $payuData['surl']               =   base_url('payment/payu/success');
            $payuData['furl']               =   base_url('payment/payu/failure');
            $payuData['service_provider']   =   'payu_paisa';

            $payuData['txnid']          =   $registrationData['id'];*/

            /*$payuData['udf1']           =   $transactionData['pages']; //$data['order_details']['total_pages'];
            $payuData['udf2']           =   $transactionData['authors']; //$data['order_details']['total_authors'];
            $payuData['udf3']           =   $transactionData['certificates']; //$data['order_details']['certificate'];
            $payuData['udf4']           =   $transactionData['journals']; //$data['order_details']['journal'];*/

            $timestamp = date('YmdHis', time());
        }else{
            redirect(base_url('404'));
        }
    }

    public function success(){
        $this->load->model('model_registration');
        $this->load->model('model_email');

        $postData = $this->input->post();

        //$this->functions->printResponse($postData);

        // update registration
        $updateData = array(
            'id'                =>  $postData['item_number'],
            'payment_status'    =>  '2',
            'payment_response'  =>  serialize($postData),
        );
        $status = $this->model_registration->update($updateData);

        $data['registrationData']   =   $this->model_registration->getData(array('id' => $postData['item_number']), true);

        $this->functions->printResponse($data['registrationData']['payment_response']);
        $data['paymentData']    =   array(
            'mihpayid'  =>  $postData['txn_id'],
            'mode'      =>  'Paypal',
        );
        //unserialize($data['registrationData']['payment_response']);

        $this->load->view('payment/view_receipt', $data);
    }

    public function getCustomer(){
        $this->load->model('model_user');
        $customer_id        =   $this->customer->getCustomerID();
        $filter_customer    =   array('member_id' => $customer_id);
        return $this->model_user->getData($filter_customer);
    }
}