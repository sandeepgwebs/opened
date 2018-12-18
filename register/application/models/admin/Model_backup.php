<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_backup extends CI_Model {

    public function backup(){
        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup =& $this->dbutil->backup();

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('C:\wamp\www\cricfeed\db_backup\db_backup/'. date('m-d-Y-H-i-s', time()) .'.gz', $backup);
    }
}