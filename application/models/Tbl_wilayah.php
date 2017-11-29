<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_wilayah extends CI_Model {

    protected $table1 = "tbl_wilayah";
    protected $table2 = "tbl_gereja";
    protected $table3 = "tbl_kabupaten";

    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);
        return $return;
    }
    
    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["as_id"]);
        $return = $this->db->update($this->table1, $arrUpdate, "tw_id = ".$id);
        
        return $return;
    }

    public function select_data($arrWhere, $start = 0, $limit = 10) {
        $query = $this->db->select("t1.*, t3.*, count(t2.tw_id) as total")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tw_id = t2.tw_id", "left")
            ->join($this->table3 . " t3", "t1.tkab_id = t3.tkab_id", "left")
            ->where("t1.tw_status", 1)
            ->limit($limit, $start)
            ->group_by("tw_id");

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;
    }

    public function select_by_id($id) {
        $query = $this->db->select("t1.*, t3.*, count(t2.tw_id) as total")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tw_id = t2.tw_id", "left")
            ->join($this->table3 . " t3", "t1.tkab_id = t3.tkab_id", "left")
            ->group_by("t1.tw_id")
            ->where("t1.tw_id", $id);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;   
    }

    public function count_data($arrWhere) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->where("t1.tw_status", 1);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }

    public function get_last_id() {
        return $this->db->Insert_id();
    }

    public function retrieve_wilayah() {
        $query = $this->db->select("t1.*")
            ->from($this->table1 . " t1")
            ->where("t1.tw_status", 1);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;
    }
}