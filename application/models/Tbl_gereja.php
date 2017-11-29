<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_gereja extends CI_Model {

    protected $table1 = "tbl_gereja";
    protected $table2 = "tbl_gembala";
    protected $table3 = "tbl_jemaat";

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

    public function retrieve_data($arrWhere, $start = 0, $limit = 20) {
        $query = $this->db->select("t1.*, t2.*, count(t3.tj_id) as total")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tgem_id = t2.tgem_id", "left")
            ->join($this->table3 . " t3", "t1.tg_id = t3.tg_id", "left")
            ->where("t1.tg_status", 1)
            ->group_by("t1.tg_id")
            ->order_by("t1.tg_nama ASC");

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();

        //echo $this->db->last_query();
        return $result;
    }

    public function select_by_id($id) {
        $query = $this->db->select("t1.*")
            ->from($this->table1 . " t1")
            ->where("t1.tkab_id", $id);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;   
    }

    public function count_data($arrWhere) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->where("t1.tkab_status", 1);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }
}