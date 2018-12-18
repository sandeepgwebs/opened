<?php
class Settings {
	private $data = array();

    public function __construct(){
        // connect to database and fetch details
        $CI =& get_instance();

        $CI->load->database();
        //$CI->load->config();

        /*$sql    =   "select * from `tbl_config`";
        $query = $CI->db->query($sql);
        if ($query->num_rows() > 0){
            $rows = $query->result_array();
            foreach($rows as $row){
                $this->data[$row['key']] = $row['value'];
            }
        }*/
    }

	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function has($key) {
		return isset($this->data[$key]);
	}
}
?>