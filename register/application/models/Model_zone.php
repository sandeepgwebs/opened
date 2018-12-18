<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_zone extends CI_Model{
    public function getDataCountry($data, $getRow = false){
        $sql    =   "select *, `name` as country_name from `country` where 1";

        if(isset($data['country_id']) && $data['country_id'] != ""){
            $sql .= " and `country_id` = '" . $data['country_id'] . "'";
        }
        if(isset($data['country_name']) && $data['country_name'] != ""){
            $sql .= " and `name` = '" . $data['country_name'] . "'";
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

    public function getDataStates($data, $getRow = false){
        $sql    =   "select c.name as country_name, z.zone_id as state_id, z.name as state_name from `country` c left join `zone` z on z.country_id = c.country_id where 1";

        if(isset($data['country_id']) && $data['country_id'] != ""){
            $sql .= " and z.`country_id` = '" . $data['country_id'] . "'";
        }
        if(isset($data['country_name']) && $data['country_name'] != ""){
            $sql .= " and c.`name` = '" . $data['country_name'] . "'";
        }
        if(isset($data['state_id']) && $data['state_id'] != ""){
            $sql .= " and z.`zone_id` = '" . $data['state_id'] . "'";
        }
        if(isset($data['state_name']) && $data['state_name'] != ""){
            $sql .= " and z.`name` = '" . $data['state_name'] . "'";
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