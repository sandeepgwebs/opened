<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public $pageTitle = "";
	public $error;

	public function __construct(){
		parent::__construct();
	}

	public function testElastic()	{
        $postData   =   array(
            'firstname'     =>  'Ishmeet',
            'lastname'      =>  'Narula',
            'email_id'      =>  'email@ishmeetnarula.in',
            'activation_code'   =>      'abc',
        );

        $msgData = array(
            "[firstname]"           =>  $postData['firstname'],
            "[lastname]"            =>  $postData['lastname'],
            "[activation_link]"     =>  base_url('activateAccount?email=' . $postData['email_id'] . '&activation_code=' . $postData['activation_code']),
        );

        $attachments    =   array(
            array('fileName' => 'samplepdf', 'filePath' => 'download/samplepdf.pdf')
        );
        $this->load->model('model_email');
        $emailStatus = $this->model_email->sendEmailCI($postData['email_id'], 'registration', $msgData, array(), $attachments, 'elastic');

        var_dump($emailStatus);
    }
}
