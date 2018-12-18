<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_content extends CI_Model{
    public function insert($data){
        @$expectedData    =   array(
            'title'             =>      $data['title'],
            'slug'              =>      $data['slug'],
            'content'           =>      $data['content'],
            'sort_order'        =>      $data['sort_order'],
            'status'            =>      $data['status'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added'] = date('Y-m-d h:i:s');

        $status = $this->db->insert('tbl_content', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('tbl_content', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        @$expectedData    =   array(
            'title'             =>      $data['title'],
            'slug'              =>      $data['slug'],
            'content'           =>      $data['content'],
            'sort_order'        =>      $data['sort_order'],
            'status'            =>      $data['status'],
        );

        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_updated'] = date('Y-m-d h:i:s');

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_content', $query_data);
    }

    public function getData($data, $getRow = false){
        $sql    =   "select c.* from `tbl_content` c where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and c.`id` = '" . $data['id'] . "'";
        }
        if(isset($data['slug']) && $data['slug'] != ""){
            $sql .= " and c.`slug` = '" . $data['slug'] . "'";
        }
        if(isset($data['status']) && $data['status'] != ""){
            $sql .= " and c.`status` = '" . $data['status'] . "'";
        }
        if(isset($data['order_by']) && $data['order_by'] != ""){
            if(isset($data['order']) && $data['order'] != ""){
                $sql .= " order by " . $data['order_by'] . " " . $data['order'];
            }else{
                $sql .= " order by " . $data['order_by'] . " asc";
            }
        }else{
            $sql .=" order by c.`sort_order` asc";
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

    public function getDataPages($data, $getRow = false){
        $sql    =   "select * from `tbl_page` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and `id` = '" . $data['id'] . "'";
        }
        if(isset($data['page']) && $data['page'] != ""){
            $sql .= " and `page` = '" . $data['page'] . "'";
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