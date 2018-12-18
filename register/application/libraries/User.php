<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User {
    var $userID = "";
    var $username = "";
    var $usersessionid = "";
    var $userType = "";

    var $userDirectory = "";

    var $CI;

    public function __construct(){
        // connect to database and fetch details
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        //$CI->load->library('url');
        $this->CI->load->database();
        //$CI->load->config();


        $this->CI->session->set_userdata('type', 'admin');

        $this->userID   = $this->CI->session->userdata('userid');
        $this->userType = $this->CI->session->userdata('type');

        $this->userDirectory    =   $this->CI->config->item('admin_folder');

        if(!empty($this->userID)){
            $sql    =   "select * from `user` u where u.id = " . $this->userID;


            $query = $this->CI->db->query($sql);
            if ($query->num_rows() > 0){
                $row = $query->row_array();
                $this->username = $row['username'];
            }
        }else{
            if($this->CI->router->fetch_class() != "account" && ($this->CI->router->fetch_method() != "index" || $this->CI->router->fetch_method() != "checklogin"  || $this->CI->router->fetch_method() != "invalid" )){
                redirect(base_url($this->CI->config->item('admin_folder') . 'login'));
            }
        }
    }

    /*public function getuserid(){
        return $this->userID;
    }*/

    public function getUserID(){
        return $this->userID;
    }

    public function getUserType(){
        return $this->userType;
    }

    public function getusername(){
        return $this->username;
    }

    public function getusersessionid(){
        return $this->usersessionid;
    }

    public function setusersessionid($sessionid){
        $this->usersessionid = $sessionid;
    }


    public function getUserDirectory(){
        return $this->userDirectory;
    }

    public function logout() {
        $this->CI->session->sess_destroy();

        $this->userID         = "";
        $this->userType       = "";
        $this->username       = "";
        $this->usersessionid  = "";
    }
}
?>