<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class tbl_kabupaten extends CI_Model {

    protected $table1 = "tbl_kabupaten";
    protected $table2 = "tbl_wilayah";
    protected $table3 = "tbl_gereja";
    protected $table4 = "tbl_jemaat";


    protected $tblview1 = "vw_jemaat_age_analytics";

    public function __construct() {
        parent::__construct();
    }
    
    public function insertdata($arrInsert = array()) {
        $return = $this->db->insert_batch($this->table1, $arrInsert);
        return $return;
    }
    
    public function updatedata($arrUpdate = array(), $id = "") {
        unset($arrUpdate["as_id"]);
        $return = $this->db->update($this->table1, $arrUpdate, "tkab_id = ".$id);
        
        return $return;
    }

    public function retrieve_data() {
        $query = $this->db->select("t1.*, count(t3.tg_id) as total_gereja")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tkab_id = t2.tkab_id", "left")
            ->join($this->table3 . " t3", "t2.tw_id = t3.tw_id", "left")
            ->where("t1.tkab_status", 1)
            ->order_by("t1.tkab_nama ASC")
            ->group_by("t1.tkab_id");

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

    public function count_wilayah() {
        $query = $this->db->select("t1.tkab_id,
            count(t2.tw_id) as total_wilayah")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tkab_id = t2.tkab_id", "left")
            ->where("t1.tkab_status", 1)
            ->order_by("t1.tkab_nama ASC")
            ->group_by("t1.tkab_id");

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
    }

    public function count_data($arrWhere) {
        $query = $this->db->select("count(*) as total")
            ->from($this->table1 . " t1")
            ->where("t1.tkab_status", 1);

        if ($arrWhere) {
            $query->where($arrWhere);
        }
        
        $result = $this->db->get();
        $result = $result->result_array();
        
        return $result[0]["total"];
    }

    public function count_total_kab($arrWhere = array()) {
        $query = $this->db->select("t1.*, count(t4.tj_id) as jumlah")
            ->from($this->table1 . " t1")
            ->join($this->table2 . " t2", "t1.tkab_id = t2.tkab_id")
            ->join($this->table3 . " t3", "t2.tw_id = t3.tw_id")
            ->join($this->table4 . " t4", "t3.tg_id = t4.tg_id", "left")
            ->where("t1.tkab_status", 1)
            ->order_by("t1.tkab_nama ASC")
            ->group_by("t1.tkab_id");

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
    }

/**

--- view sql ---

SELECT  t1.tj_id, t2.tg_id, t3.tw_id, t4.tkab_id,
FLOOR( DATEDIFF( NOW( ) , STR_TO_DATE( t1.tj_tgl_lahir,  '%Y-%m-%d' ) ) /365 ) AS age
FROM  `tbl_jemaat`  `t1` 
JOIN  `tbl_gereja`  `t2` ON  `t1`.`tg_id` =  `t2`.`tg_id` 
JOIN  `tbl_wilayah`  `t3` ON  `t2`.`tw_id` =  `t3`.`tw_id` 
JOIN  `tbl_kabupaten`  `t4` ON  `t3`.`tkab_id` =  `t4`.`tkab_id` 
WHERE  `t1`.`tj_status` =1
AND  `t2`.`tg_status` =1
AND  `t3`.`tw_status` =1

*/
    public function count_tblView($arrWhere = array()) {
        $query = $this->db->select("t1.*, count(*) as total")
            ->from($this->tblview1 . " t1")
            ->group_by("tkab_id");

        if ($arrWhere) {
            $query->where($arrWhere);
        }

        $result = $this->db->get();
        $result = $result->result_array();
                
        return $result;
    }
}