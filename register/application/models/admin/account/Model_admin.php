<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_admin extends CI_Model {
    public function checklogin($data){
        $username   =   $this->db->escape($data['username']);
        $password   =   $this->db->escape(md5($data['password']));

        $sql        =   "select * from `user` where username = ". $username ." and password = ". $password;

        $query      =   $this->db->query($sql);

        if($query->num_rows() > 0){
            $row    =   $query->row_array();
            $this->session->set_userdata('userid', $row['id']);
            $this->session->set_userdata('type', 'admin');

            // save session id into database
            //$query_update   =   $this->db->update('user', array('session_id' => $this->session->userdata('session_id')), array('id' => $row['id']));

            $this->user->setusersessionid($this->session->userdata('session_id'));
            return $row;
        }else{
            return false;
        }
    }

    public function checkpassword(){
        $password   =   md5($this->input->get_post('password'));

        $sql    =   "select * from `user` where id = " . $this->user->getuserid() . " and password = '" . $password . "'";
        $query  =   $this->db->query($sql);

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function changepassword(){
        $password       =   md5($this->input->get_post('password'));
        $new_password   =   md5($this->input->get_post('new_password'));

        $sql    =   "select * from `user` where id = " . $this->user->getuserid() . " and password = '" . $password . "'";
        $query  =   $this->db->query($sql);

        if($query->num_rows() > 0){
            $sql_update     =   "update `user` set password = '". $new_password ."' where id = " . $this->user->getuserid();
            if($this->db->query($sql_update)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}