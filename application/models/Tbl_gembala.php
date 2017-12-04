<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_gembala extends CI_Model {

    protected $table1 = "tbl_gembala";

    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);
        return $return;
    }

/*    
    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["as_id"]);
        $return = $this->db->update($this->table1, $arrUpdate, "tw_id = ".$id);
        
        return $return;
    }

    public function retrieve_data() {
        $query = $this->db->select("*")
            ->from($this->table1 . " t1")
            ->where("t1.tkab_status", 1)
            ->order_by("t1.tkab_nama ASC");

        $result = $this->db->get();
        $result = $result->result_array();

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
*/
    public function count_data($arrWhere = array()) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->where("t1.tgem_status", 1);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }
}