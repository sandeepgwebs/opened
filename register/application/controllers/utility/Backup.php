<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {
	public $pageTitle = "MINT STREET";
	public $error;

	public function __construct(){
		parent::__construct();
	}

	public function index()	{
        $this->db();
        $this->files();
	}

    private function db(){
        $this->load->dbutil();

        $config = array(
            'format'    =>  'zip',
            'filename'  =>  'mintstreet.sql'
        );
        $backup =& $this->dbutil->backup($config);

        $db_name = "backup-on-" . date('Y-m-d-H-i-s') . '.zip';
        $save = "backup/db" . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);
    }
}
