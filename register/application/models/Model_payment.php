<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_payment extends CI_Model{
    public function insertTransaction($data){
        @$expectedData    =   array(
            'manuscript_id' =>      $data['manuscript_id'],
            'pages'         =>      $data['pages'],
            'authors'       =>      $data['authors'],
            'certificates'  =>      $data['certificates'],
            'journals'      =>      $data['journals'],
            'amount'        =>      $data['amount'],
            'amount_usd'    =>      $data['amount_usd'],
            'payment_method'    =>  $data['payment_method'],
            'type'          =>      $data['type'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added'] = date('Y-m-d h:i:s');

        $status = $this->db->insert('tbl_transaction', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function deleteTransaction($data){
        $status = $this->db->delete('tbl_transaction', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function updateTransaction($data){
        @$expectedData    =   array(
            'manuscript_id' =>      $data['manuscript_id'],
            'pages'         =>      $data['pages'],
            'authors'       =>      $data['authors'],
            'certificates'  =>      $data['certificates'],
            'journals'      =>      $data['journals'],
            'amount'        =>      $data['amount'],
            'amount_usd'    =>      $data['amount_usd'],
            'payment_method'    =>  $data['payment_method'],
            'type'          =>      $data['type'],
        );

        $query_data = $this->functions->fixPostData($data, $expectedData);

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_transaction', $query_data);
    }

    public function getDataTransaction($data, $getRow = false){
        $sql    =   "select * from `tbl_transaction` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and `id` = '" . $data['id'] . "'";
        }
        if(isset($data['transaction_id']) && $data['transaction_id'] != ""){
            $sql .= " and `id` = '" . $data['transaction_id'] . "'";
        }
        if(isset($data['manuscript_id']) && $data['manuscript_id'] != ""){
            $sql .= " and `manuscript_id` = '" . $data['manuscript_id'] . "'";
        }
        if(isset($data['payment_method']) && $data['payment_method'] != ""){
            $sql .= " and `payment_method` = '" . $data['payment_method'] . "'";
        }
        if(isset($data['type']) && $data['type'] != ""){
            $sql .= " and `type` = '" . $data['type'] . "'";
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
            if($getRow){
                return $result->row_array();
            }else{
                return $result->result_array();
            }
        }else{
            return false;
        }
    }

    public function insertPayment($data){
        @$expectedData    =   array(
            'txn_id'        =>  $data['txn_id'],
            'response'      =>  $data['response'],
            'order_details' =>  $data['order_details'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added'] = date('Y-m-d h:i:s');

        $status = $this->db->insert('tbl_paymentData', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function deletePayment($data){
        $status = $this->db->delete('tbl_paymentData', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function updatePayment($data){
        @$expectedData    =   array(
            'txn_id'        =>  $data['txn_id'],
            'response'      =>  $data['response'],
            'order_details' =>  $data['order_details'],
        );

        $query_data = $this->functions->fixPostData($data, $expectedData);

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_paymentData', $query_data);
    }

    public function getDataPayment($data, $getRow = false){
        $sql    =   "select * from `tbl_paymentData` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and `id` = '" . $data['id'] . "'";
        }
        if(isset($data['txn_id']) && $data['txn_id'] != ""){
            $sql .= " and `txnid` = '" . $data['txn_id'] . "'";
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