<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_registration extends CI_Model{
    public function insert($data){
        @$expectedData    =   array(
            'firstname'         =>      $data['firstname'],
            'lastname'          =>      $data['lastname'],
            'state'             =>      $data['state'],
            'country'           =>      $data['country'],
            'organization'      =>      $data['organization'],
            'qualification'     =>      $data['qualification'],
            'email_id'          =>      $data['email_id'],
            'phone'             =>      $data['phone'],
            'status'            =>      $data['status'],
            'paper_id'          =>      $data['paper_id'],
            'paper_title'       =>      $data['paper_title'],
            'paper_authors'     =>      $data['paper_authors'],
            'paper_pages'       =>      $data['paper_pages'],
            'category'          =>      $data['category'],
            'type'              =>      $data['type'],
            'ieee_member'       =>      $data['ieee_member'],
            'amount'            =>      $data['amount'],
            'currency'          =>      $data['currency'],
            'payment_method'    =>      $data['payment_method'],
            'payment_status'    =>      $data['payment_status'],
            'payment_response'  =>      $data['payment_response'],
            'file_paper'        =>      $data['file_paper'],
            'file_copyright'    =>      $data['file_copyright'],
        );

        $query_data = $this->functions->fixPostData($data, $expectedData);
        $query_data['date_added']    =   date('Y-m-d h:i:s');

        $status = $this->db->insert('tbl_registration', $query_data);
        if($status){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('tbl_registration', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        @$expectedData      =   array(
            'firstname'         =>      $data['firstname'],
            'lastname'          =>      $data['lastname'],
            'state'             =>      $data['state'],
            'country'           =>      $data['country'],
            'organization'      =>      $data['organization'],
            'qualification'     =>      $data['qualification'],
            'email_id'          =>      $data['email_id'],
            'phone'             =>      $data['phone'],
            'status'            =>      $data['status'],
            'paper_id'          =>      $data['paper_id'],
            'paper_title'       =>      $data['paper_title'],
            'paper_authors'     =>      $data['paper_authors'],
            'paper_pages'       =>      $data['paper_pages'],
            'category'          =>      $data['category'],
            'type'              =>      $data['type'],
            'ieee_member'       =>      $data['ieee_member'],
            'amount'            =>      $data['amount'],
            'currency'          =>      $data['currency'],
            'payment_method'    =>      $data['payment_method'],
            'payment_status'    =>      $data['payment_status'],
            'payment_response'  =>      $data['payment_response'],
            'file_paper'        =>      $data['file_paper'],
            'file_copyright'    =>      $data['file_copyright'],
        );
        $query_data = $this->functions->fixPostData($data, $expectedData);
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_registration', $query_data);

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }

    public function getData($data, $getRow = false){
        $sql    =   "select * from `tbl_registration` where 1";
        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and id = " . $data['id'];
        }
        if(isset($data['email_id']) && $data['email_id'] != ""){
            $sql .= " and `email_id` = '" . $data['email_id'] . "'";
        }
        if(isset($data['payment_status']) && $data['payment_status'] != ""){
            $sql .= " and `payment_status` = '" . $data['payment_status'] . "'";
        }

        if(isset($data['date_added']) && $data['date_added'] != ""){
            $sql .= " and date(`date_added`) = '" . $data['date_added'] . "'";
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