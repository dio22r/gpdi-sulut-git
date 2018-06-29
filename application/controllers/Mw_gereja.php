<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once "gereja.php";

class mw_gereja extends gereja {

    protected $activeMenu = "dashboard";
    protected $mwId;

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
        $this->isLogin = $this->lib_login->check_login();
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_login->redir_ifnot_login();
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/gereja");
        $this->mwId = $this->session->userdata["arrUser"]["usrt_id"];
    }
    
    protected function _get_data($search, $start, $perpage) {
        $arrWhere = array("t1.tw_id" => $this->mwId);
        $arrData = $this->tbl_gereja->retrieve_data(
            $arrWhere, $start, $perpage
        );

        return $arrData;
    }

    protected function _get_count_data() {
        $arrWhere = array("t1.tw_id" => $this->mwId);
        $count = $this->tbl_gereja->count_data($arrWhere);

        return $count;
    }
	
}
    