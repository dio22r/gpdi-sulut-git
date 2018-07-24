<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_jemaat extends CI_Model {

    protected $table1 = "tbl_jemaat";
    protected $table2 = "tbl_gereja";
    protected $table3 = "tbl_gembala";

    protected $table1a = "tbl_jem_org_gereja";
    protected $table1b = "tbl_jem_org_lain";
    protected $table1c = "tbl_jem_pelayanan";
    protected $table1d = "tbl_jem_pendidikan";

    protected $table1e = "tbl_jem_kel";
    protected $table1f = "tbl_jem_kel_trans";

    protected $table1g = "tbl_jem_mutasi";

    protected $table1h = "tbl_jem_klpk";
    protected $table1i = "tbl_jem_klpk_trans";

    protected $table4 = "tbl_aset";


    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }
    
    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["as_id"]);
        $return = $this->db->update($this->table1, $arrUpdate, "tj_id = ".$id);
        
        return $return;
    }

    public function retrieve_data(
        $arrWhere, $start = 0, $limit = 20,
        $column = "t1.*, t2.*, floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tj_tgl_lahir, '%Y-%m-%d'))/365) as age", $orderBy = "t2.tg_nama ASC"
    ) {
        $query = $this->db->select($column)
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tg_id = t2.tg_id")
            ->where("t1.tj_status", 1)
            ->where("t2.tg_status", 1)
            ->order_by($orderBy)
            ->limit($limit, $start);

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();

        //echo $this->db->last_query();
        return $result;
    }

    public function select_by_id($id) {
        $query = $this->db->select("t1.*, t2.*,
            floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tj_tgl_lahir, '%Y-%m-%d'))/365) as age")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tg_id = t2.tg_id")
            ->where("t1.tj_id", $id);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;   
    }

    public function count_data($arrWhere = array()) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tg_id = t2.tg_id")
            ->where("t1.tj_status", 1)
            ->where("t2.tg_status", 1);

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }

    public function select_det_by_id($table = "", $arrDet, $orderBy = "") {
        $table = $this->$table;

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

    public function update_det_by_id($table = "", $arrUpdate, $arrWhere) {
        $table = $this->$table;
        $return = $this->db->update($table, $arrUpdate, $arrWhere);

        return $return;
    }

    public function insert_det_by_id($table = "", $arrInsert) {
        $table = $this->$table;
        $return = $this->db->insert($table, $arrInsert);

        if ($return) {
            return $this->db->insert_id();
        } else {
            return $return;
        }
    }

    
    public function retrieve_data_week($arrDate = array(), $arrWhere = array()) {
        $this->db->select("*")
            ->from($this->table1);
            
        $this->db->group_start();
        foreach($arrDate as $key => $val) {
            $this->db->or_like("tj_tgl_lahir", $val, "before");
        }
        $this->db->group_end();
        if ($arrWhere) {
            $this->db->where($arrWhere);
        }
        
        $result = $this->db->get();
        
        $result = $result->result_array();
        
        return $result;
    }

    public function select_tbl_jemaat($field = "*", $arrWhere = array()) {
        $query = $this->db->select($field)
            ->from($this->table1 . " t1")
            ->where($arrWhere);

        $result = $this->db->get();
        $result = $result->result_array();
                
        return $result;   
    }

    public function select_tbl_kel(
        $field = "*", $arrWhere = array(), $groupBy = "", $orderBy = ""
    ) {
        $query = $this->db->select($field)
            ->from($this->table1 . " t1")
            ->join($this->table1f . " t1f", "t1.tj_id = t1f.tj_id")
            ->join($this->table1e . " t1e", "t1e.tjk_id = t1f.tjk_id", "right")
            ->where($arrWhere);

        if ($groupBy) {
            $this->db->group_by($groupBy);
        }

        if ($orderBy) {
            $this->db->order_by($orderBy);
        }
        
        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;   
    }


    public function select_tbl_kelompok(
        $field = "*", $arrWhere = array(), $groupBy = "", $orderBy = ""
    ) {
        $query = $this->db->select($field)
            ->from($this->table1 . " t1")
            ->join($this->table1i . " t1i", "t1.tj_id = t1i.tj_id")
            ->join($this->table1h . " t1h", "t1i.tjkp_id = t1h.tjkp_id", "right")
            ->where($arrWhere);

        if ($groupBy) {
            $this->db->group_by($groupBy);
        }

        if ($orderBy) {
            $this->db->order_by($orderBy);
        }
        
        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result;   
    }
}
