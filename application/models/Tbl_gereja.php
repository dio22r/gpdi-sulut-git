<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_gereja extends CI_Model {

    protected $table1 = "tbl_gereja";
    protected $table2 = "tbl_gembala";
    protected $table3 = "tbl_jemaat";
    protected $table4 = "tbl_wilayah";

    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);
        return $return;
    }
    
    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["tg_id"]);
        $return = $this->db->update($this->table1, $arrUpdate, "tg_id = ".$id);
        
        return $return;
    }

    public function get_last_id() {
        return $this->db->insert_id();
    }

    public function retrieve_data($arrWhere, $start = 0, $limit = 20, $order_by = "", $arrLike = array()) {
        $query = $this->db->select("t1.*, t2.*, count(t3.tj_id) as total, t4.*")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tgem_id = t2.tgem_id", "left")
            ->join($this->table3 . " t3", "t1.tg_id = t3.tg_id", "left")
            ->join($this->table4 . " t4", "t1.tw_id = t4.tw_id", "left")
            ->where("t1.tg_status", 1)
            ->group_by("t1.tg_id")
            ->limit($limit, $start);

        if ($order_by) {
            $query->order_by($order_by);
        } else {
            $query->order_by("t1.tg_nama ASC");
        }

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        if ($arrLike) {
            $query->like($arrLike);
        }

        $result = $this->db->get();
        $result = $result->result_array();

        //echo $this->db->last_query();
        return $result;
    }

    public function retrieve_recent($arrWhere = array()) {
        $query = $this->db->select("t1.tg_nama, t2.tgem_nama, t2.tgem_no_telp, t4.tw_nama")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tgem_id = t2.tgem_id", "left")
            ->join($this->table4 . " t4", "t1.tw_id = t4.tw_id", "left")
            ->where("t1.tg_status", 1)
            ->order_by("t1.tg_id DESC")
            ->limit(50, 0);

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

    public function count_data($arrWhere = array(), $arrLike = array()) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->where("t1.tg_status", 1);

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        if ($arrLike) {
            $query->like($arrLike);
        }

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }
}