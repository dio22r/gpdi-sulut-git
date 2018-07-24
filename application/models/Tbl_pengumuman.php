<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_pengumuman extends CI_Model {

    protected $table1 = "tbl_pengumuman";
    protected $table2 = "tbl_user";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert($this->table1, $arrInsert);

        return $return;
    }
    
    public function updatedata($arrUpdate = array(), $arrWhere = array()) {
        $return = $this->db->update(
            $this->table1, $arrUpdate, $arrWhere
        );
        
        return $return;
    }

    public function retrieve_data(
        $arrWhere = array(), $start = 0, $limit = 10,
        $orderBy = ""
    ) {
        $query = $this->db->select("*")
            ->from($this->table1 . " as t1")
            ->join($this->table2 . " as t2", "t1.tu_id = t2.tu_id")
            ->limit($limit, $start);

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        if ($orderBy) {
            $query->order_by($orderBy);
        }

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;
    }

    public function count_data($arrWhere) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1);

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }

    public function last_insert_id() {
         $insertId = $this->db->insert_id();
         return $insertId;
    }
}