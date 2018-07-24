<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class trans_statistik_jemaat extends CI_Model {

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

    protected $tblview1 = "vw_jemaat_age_analytics";


    public function __construct() {
        parent::__construct();
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

    public function count_tblView($arrWhere = array()) {
        $query = $this->db->select("count(*) as total")
            ->from($this->tblview1 . " tv1")
            ->join($this->table1 . " t1", "t1.tj_id = tv1.tj_id");

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();
                
        return $result[0]["total"];
    }

    public function count_by_year($arrWhere = array()) {
        $query = $this->db->select("YEAR(t1.tj_tgl_lahir) as year, count(*) as total")
            ->from($this->table1 . " t1")
            ->where("t1.tj_status", 1)
            ->group_by("YEAR(t1.tj_tgl_lahir)");

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();
                
        return $result;
    }
}
