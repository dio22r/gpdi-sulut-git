<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_user extends CI_Model {

    protected $table1 = "tbl_user";
    
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
            $this->table1, $arrUpdate, "tu_id = '".$id."'"
        );
        
        return $return;
    }

    public function select_by_username($username) {
        $query = $this->db->select("*")
            ->from($this->table1)
            ->where("tu_username", $username);

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;
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
            ->from($this->table1)
            ->where("tu_status", 1)
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

    public function retrieve_tipe_user() {
        $arrTipe = array(
            1 => "Majelis Daerah",
            3 => "Majelis Wilayah",
            5 => "Gembala"
        );

        return $arrTipe;
    }

    public function last_insert_id() {
         $insertId = $this->db->insert_id();
         return $insertId;
    }
}