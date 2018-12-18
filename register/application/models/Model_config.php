<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_config extends CI_Model{
    public function insert($data){
        $query_data    =   array(
            'key'       =>      $data['key'],
            'value'     =>      $data['value']
        );

        $status = $this->db->insert('tbl_config', $query_data);
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('tbl_config', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        $query_data    =   array(
            'key'       =>      $data['key'],
            'value'     =>      $data['value']
        );

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_config', $query_data);

    }

    public function getData($data, $getRow = false){
        $sql    =   "select * from `tbl_config` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and id = " . $data['id'];
        }
        if(isset($data['key']) && $data['key'] != ""){
            $sql .= " and `key` = '" . $data['key'] . "'";
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