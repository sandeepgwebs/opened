<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_fees extends CI_Model{
    public function insert($data){
        @$expectedData    =   array(
            'category'      =>      $data['category'],
            'type'          =>      $data['type'],
            'nationality'   =>      $data['nationality'],
            'fees'          =>      $data['fees'],
            'currency'      =>      $data['currency'],
        );

        $query_data = $this->functions->fixPostData($data, $expectedData);

        $status = $this->db->insert('tbl_fees', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('tbl_fees', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        @$expectedData      =   array(
            'category'      =>      $data['category'],
            'type'          =>      $data['type'],
            'nationality'   =>      $data['nationality'],
            'fees'          =>      $data['fees'],
            'currency'      =>      $data['currency'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_fees', $query_data);

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }

    public function getData($data, $getRow = false){
        $sql    =   "select * from `tbl_fees` where 1";
        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and `id` = " . $data['id'];
        }
        if(isset($data['category']) && $data['category'] != ""){
            $sql .= " and `category` = '" . $data['category'] . "'";
        }
        if(isset($data['type']) && $data['type'] != ""){
            $sql .= " and `type` = '" . $data['type'] . "'";
        }
        if(isset($data['nationality']) && $data['nationality'] != ""){
            $sql .= " and `nationality` = '" . $data['nationality'] . "'";
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