<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_aset extends CI_Model {

    protected $table1 = "tbl_aset";

    public function __construct() {
        parent::__construct();
    }
    
    public function select_det_by_id($arrDet, $orderBy = "") {
        $table = $this->table1;

        $query = $this->db->select("*")
            ->from($table . " t1")
            ->where($arrDet);

        if ($orderBy) {
            $query->order_by($orderBy);
        }

        $result = $this->db->get();
        $result = $result->result_array();
                
        return $result;   
    }

    public function update_det_by_id($arrUpdate, $arrWhere) {
        $table = $this->table1;
        $return = $this->db->update($table, $arrUpdate, $arrWhere);

        return $return;
    }

    public function insert_det_by_id($arrInsert) {
        $table = $this->table1;
        $return = $this->db->insert($table, $arrInsert);

        return $return;
    }

    
}
