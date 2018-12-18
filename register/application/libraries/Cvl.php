<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cvl {
    var $username       =   "";
    var $password       =   "";
    var $encryptPass    =   "";
    var $passKey        =   "";

    var $server         =   "";

    var $_ci;

    var $PANStatus;

    public function __construct($mode = "test"){
        $this->_ci =& get_instance();
        $this->_ci->load->library('restclient');
        $this->_ci->load->library('format');

        if($mode == "test"){
            $this->username =   "WEBELITIO";
            $this->password =   "web@12345";
            $this->passKey  =   "ELITIO";
            $this->server   =   "http://test.cvlkra.com/PANInquiry.asmx/";
        }else if($mode == "live"){
            $this->username =   "APIUSER";
            $this->password =   "Upraise$2016";
            $this->passKey  =   "2500006588";
            $this->server   =   "https://www.cvlkra.com/PANInquiry.asmx/";
        }
        $this->login();
    }

    private function config($data = array()){
        return array(
            'server'    =>  $this->server,
        );
    }

    public function login(){
        $postData   =   array(
            'password'  =>  $this->password,
            'PassKey'   =>  $this->passKey,
        );
        $this->_ci->restclient->initialize($this->config());
        $response   =   $this->_ci->restclient->get('GetPassword', $postData);

        if(isset($response[0]) && $response[0] != ""){
            $this->encryptPass = $response[0];
            return $this->encryptPass;
        }else{
            return false;
        }
    }

    public function getPANStatus($data){
        $postData   =   array(
            'panNo'     =>  $data['pan_number'],
            'username'  =>  $this->username,
            'PosCode'   =>  $this->passKey,
            'password'  =>  $this->encryptPass,
            'PassKey'   =>  $this->passKey,
        );
        $this->_ci->restclient->initialize($this->config());
        $response   =   $this->_ci->restclient->get('GetPanStatus', $postData);
        $response   =   $this->_ci->format->to_array($response);

        $this->PANStatus    =   $response;
        return $response;
    }

    public function getPANDetails($data){
        $inputXML = "
        <APP_REQ_ROOT>
            <APP_PAN_INQ>
                <APP_PAN_NO>". $data['pan_number'] ."</APP_PAN_NO>
                <APP_DOB_INCORP>". $data['dob'] ."</APP_DOB_INCORP>
                <APP_POS_CODE>". $this->passKey ."</APP_POS_CODE>
                <APP_RTA_CODE>". $this->passKey ."</APP_RTA_CODE>
                <APP_KRA_CODE></APP_KRA_CODE>
                <FETCH_TYPE>X</FETCH_TYPE>
            </APP_PAN_INQ>
        </APP_REQ_ROOT>
        ";
        $postData   =   array(
            'inputXML'  =>  $inputXML,
            'username'  =>  $this->username,
            'PosCode'   =>  $this->passKey,
            'password'  =>  $this->encryptPass,
            'PassKey'   =>  $this->passKey,
        );
        
        $this->_ci->restclient->initialize($this->config());
        $response   =   $this->_ci->restclient->post('SolicitPANDetailsFetchALLKRA', $postData);
        $response   =   $this->_ci->format->to_array($response);

        return $response;
    }
}
?>