<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once "Gereja.php";

class jem_gereja extends gereja {

    protected $activeMenu = "gereja";
    protected $mwId;

    public $userAllowed = "grj";
    
    public function __construct() {
        parent::__construct();
        // load helper
        $this->load->helper("misc");
        $this->load->helper("path");
        $this->load->helper("file");
        $this->load->helper("form");
        
        $this->load->library("image_lib");
        $this->load->library("default_view");

        $this->load->model("tbl_gereja");
        
        // load libraries

        $arrConfig = array("session" => $this->session);

        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage($this->userAllowed); 
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/jem_gereja");
        $this->grjId = $this->session->userdata["arrUser"]["usrt_id"];
    }

	public function index($search = "all", $start = 0) {
        $grjId = $this->grjId;
        parent::profile($grjId);
    }

    public function profile($id = "") {
        $grjId = $this->grjId;
        parent::profile($grjId);
    }

    public function form($id = "") {
        $grjId = $this->grjId;
        parent::form($grjId);
        
    }
    
    public function form_aset($idGereja = "", $idDet = "") {
        $grjId = $this->grjId;
        parent::form_aset($grjId, $idDet);
    }

    public function delete_aset($idGereja, $idDet) {
        $grjId = $this->grjId;
        parent::delete_aset($grjId, $idDet);
    }

    protected function _submit_aset() {
        $grjId = $this->grjId;
        $arrPost = $this->input->post();

        if ($arrPost) {
            if (is_numeric($arrPost["ta_id"])) {
                // update
                $arrUpdate = $arrPost;
                $arrWhere = array(
                    "ta_id" => $arrPost["ta_id"],
                    "rel_tipe" => 2,
                    "rel_id" => $grjId,
                );

                $return = $this->tbl_aset->update_det_by_id($arrUpdate, $arrWhere);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $grjId, "refresh");
                } else {
                    return false;
                }
            } else {
                // insert
                $arrInsert = $arrPost;
                $arrInsert["rel_tipe"] = 2;
                $return = $this->tbl_aset->insert_det_by_id($arrInsert);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $grjId, "refresh");
                } else {
                    return false;
                }
            }
        }
    }
}