<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_pengumuman extends CI_Model {

    protected $table1 = "tbl_pengumuman";
    protected $table2 = "tbl_user";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);

        return $return;
    }
    
    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["tu_id"]);
        $return = $this->db->update(
            $this->table1, $arrUpdate, "tpeng_id = '".$id."'"
        );
        
        return $return;
    }

    public function delete($id) {
        $return = $this->db->delete($this->tabl1, array('id' => $id)); 
        return $return;
    }

    public function select_by_id($id) {
        $query = $this->db->select("*")
            ->from($this->table1)
            ->where("tu_id", $id);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;
    }
    
    public function retrieve_data($arrWhere, $start = 0, $limit = 10) {
        $query = $this->db->select("*")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tu_id = t2.tu_id")
            ->where("t1.tpeng_status", 1)
            ->order_by("t1.tpeng_datetime DESC")
            ->limit($limit, $start);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;

    }

    public function count_data($arrWhere) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1)
            ->where("tu_status", 1);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }

}