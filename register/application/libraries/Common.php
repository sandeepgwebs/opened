<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {
    var $CI;

    public function __construct(){
        // connect to database and fetch details
        $this->CI =& get_instance();
    }

    public function getCommon(){
        $data = array();

        return $data;
    }
}
?>