<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_admin extends CI_Model{
    public function insert($data){
        @$expectedData    =   array(
            'name'          =>      $data['name'],
            'email'         =>      $data['email'],
            'contact'       =>      $data['contact'],
            'username'      =>      $data['username'],
            'password'      =>      md5($data['password']),
            'last_ip'       =>      $data['last_ip'],
            'status'        =>      $data['status'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added']       =   date('Y-m-d h:i:s');
        $status = $this->db->insert('user', $query_data);
        if($status){
            $userid = $this->db->insert_id();
            return $userid;
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('user', array('id' => $data['user_id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        @$expectedData    =   array(
            'firstname'     =>      $data['firstname'],
            'lastname'      =>      $data['lastname'],
            'email_id'      =>      $data['email_id'],
            'password'      =>      md5($data['password']),
            'contact_number'=>      $data['contact_number'],
            'address'       =>      $data['address'],
            'status'        =>      $data['status']
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $this->db->where('id', $data['id']);
        $this->db->update('user', $query_data);
    }

    public function getData($data, $getRow = false){
        $sql    =   "select * from `user` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and id = " . $data['id'];
        }
        if(isset($data['user_id']) && $data['user_id'] != ""){
            $sql .= " and id = " . $data['user_id'];
        }
        if(isset($data['email_id']) && $data['email_id'] != ""){
            $sql .= " and `email_id` = '" . $data['email_id'] . "'";
        }
        if(isset($data['password']) && $data['password'] != ""){
            $sql .= " and `password` = '" . md5($data['password']) . "'";
        }

        $result      =   $this->db->query($sql);

        if($result->num_rows() > 0){
            $customers = $result->result_array();

            foreach($customers as $key => $customer){
                $user_id =  $customer['id'];
                $customers[$key]['detail']         =   $this->getDataUserDetail(array('user_id' => $user_id));
            }
            if($getRow){
                return $customers[0];
            }else{
                return $customers;
            }
        }else{
            return false;
        }
    }

    public function changePassword($data){
        $query_data    =   array(
            'password'      =>      md5($data['password'])
        );

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_user', $query_data);

        $user = $this->getData(array('id' => $data['id']));
        return $user;
    }

}