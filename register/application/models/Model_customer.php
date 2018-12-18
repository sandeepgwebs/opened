<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_customer extends CI_Model{
    public function insert($data){
        @$expectedData    =   array(
            'name'          =>      $data['name'],
            'email_id'      =>      $data['email_id'],
            'password'      =>      $data['password'],
            'fcm_id'        =>      $data['fcm_id'],
            'status'        =>      $data['status'],
            'api_key'       =>      $data['api_key'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added']   =   date('Y-m-d h:i:s');
        $query_data['date_login']   =   date('Y-m-d h:i:s');

        $status = $this->db->insert('tbl_customer', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('tbl_customer', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        @$expectedData    =   array(
            'name'          =>      $data['name'],
            'email_id'      =>      $data['email_id'],
            'password'      =>      $data['password'],
            'fcm_id'        =>      $data['fcm_id'],
            'status'        =>      $data['status'],
            'api_key'       =>      $data['api_key'],
            'date_login'    =>      $data['date_login'],
        );

        $query_data = $this->functions->fixPostData($data, $expectedData);

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_customer', $query_data);

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }

    public function getData($data, $getRow = false){
        $sql    =   "select * from `tbl_customer` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and `id` = '" . $data['id'] . "'";
        }
        if(isset($data['email_id']) && $data['email_id'] != ""){
            $sql .= " and `email_id` = '" . $data['email_id'] . "'";
        }
        if(isset($data['password']) && $data['password'] != ""){
            $sql .= " and `password` = '" . md5($data['password']) . "'";
        }
        if(isset($data['fcm_id']) && $data['fcm_id'] != ""){
            $sql .= " and `fcm_id` = '" . $data['fcm_id'] . "'";
        }

        if(isset($data['status']) && $data['status'] != ""){
            $sql .= " and `status` = '" . $data['status'] . "'";
        }

        if(isset($data['api_key']) && $data['api_key'] != ""){
            $sql .= " and `api_key` = '" . $data['api_key'] . "'";
        }

        if(isset($data['order_by']) && $data['order_by'] != ""){
            if(isset($data['order']) && $data['order'] != ""){
                $sql .= " order by " . $data['order_by'] . " " . $data['order'];
            }else{
                $sql .= " order by " . $data['order_by'] . " asc";
            }
        }

        $result      =   $this->db->query($sql);

        if($result->num_rows() > 0){
            $rows = $result->result_array();

            foreach($rows as $key_row => $row){
                if(isset($data['getCustomerBasket']) && $data['getCustomerBasket'] == true){
                    $rows[$key_row]['baskets']    =   $this->getDataCustomerBasket(array('customer_id' => $row['id']));
                }
            }

            if($getRow){
                return $rows[0];
            }else{
                return $rows;
            }
        }else{
            return false;
        }
    }


    public function insertCustomerBasket($data){
        @$expectedData    =   array(
            'customer_id'       =>      $data['customer_id'],
            'basket_id'         =>      $data['basket_id'],
            'payment_status'    =>      $data['payment_status'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);

        $query_data['date_added']   = date('Y-m-d h:i:s');
        $query_data['date_expiry']  = date('Y-m-d h:i:s', strtotime('+10year'));

        $status = $this->db->insert('tbl_customer_basket', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function deleteCustomerBasket($data){
        $status = $this->db->delete('tbl_customer_basket', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function updateCustomerBasket($data){
        @$expectedData    =   array(
            'customer_id'       =>      $data['customer_id'],
            'basket_id'         =>      $data['basket_id'],
            'payment_status'    =>      $data['payment_status'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added']   = date('Y-m-d h:i:s');
        $query_data['date_expiry']  = date('Y-m-d h:i:s', strtotime('+10year'));

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_customer_basket', $query_data);
    }

    public function getDataCustomerBasket($data, $getRow = false){
        $sql    =   "select * from `tbl_customer_basket` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and `id` = '" . $data['id'] . "'";
        }
        if(isset($data['basket_id']) && $data['basket_id'] != ""){
            $sql .= " and `basket_id` = '" . $data['basket_id'] . "'";
        }
        // @todo check expiry
        $result      =   $this->db->query($sql);
        if($result->num_rows() > 0){
            if($getRow){
                return $result->row_array();
            }else{
                return $result->result_array();
            }
        }else{
            return false;
        }
    }


}