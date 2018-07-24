<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_gembala extends CI_Model {

    protected $table1 = "tbl_gembala";
    protected $table2 = "tbl_gereja";
    protected $table3 = "tbl_gembala_pasangan";
    protected $table4 = "tbl_gembala";


    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);
        return $return;
    }
    
    public function insert_pasangan($arrInsert = array()) {
        $return = $this->db->insert($this->table3, $arrInsert);
        return $return;
    }

    public function get_last_id() {
        return $this->db->insert_id();
    }

    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["as_id"]);
        $return = $this->db->update($this->table1, $arrUpdate, "tgem_id = ".$id);
        
        return $return;
    }


    public function retrieve_data($arrWhere, $start = 0, $limit = 20, $arrLike = array()) {
        $query = $this->db->select("t1.*, t2.tg_nama,
            floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tgem_tgl_lahir, '%Y-%m-%d'))/365) as age")
            ->from($this->table1 . " t1")
            ->join(
                $this->table2 . " t2", "t1.tgem_id = t2.tgem_id", "left"
            )
            ->where("t1.tgem_status", 1)
            ->order_by("t1.tgem_nama ASC")
            ->limit($limit, $start);

        if ($arrWhere) {
            $query->where($arrWhere);
        }


        if ($arrLike) {
            $query->like($arrLike);
        }


        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
    }

    public function select_by_id($id) {
        $query = $this->db->select("t1.*,
            floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tgem_tgl_lahir, '%Y-%m-%d'))/365) as age,
            t2.*, t3.*")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tgem_id = t2.tgem_id", "left")
            ->join($this->table3 . " t3", "t1.tgem_id = t3.tgem_id_gem", "left")
            ->where("t1.tgem_id", $id);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;   
    }

    public function select_pasangan($id) {
        $query = $this->db->select("t1.*")
            ->from($this->table1 . " t1")
            ->where("t1.tgem_id", $id);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;   
    }

    public function count_data($arrWhere = array(), $arrLike = array()) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->join(
                $this->table2 . " t2", "t1.tgem_id = t2.tgem_id", "left"
            )
            ->where("t1.tgem_status", 1);

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