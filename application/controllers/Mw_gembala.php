<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once("Gembala.php");

class mw_gembala extends gembala {

    protected $activeMenu = "mw_gembala";
    protected $title = "Data Arsip Surat";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Data Gembala",
        "ctlSubtitle" => "Tabel Gembala"
    );
    protected $arrCss = array();
    protected $arrJs = array();
    
    protected $thisurl;
    protected $lib_defaultView;
    public $userAllowed = "mw";

    public function __construct() {
        parent::__construct();
        // load helper
        $this->load->helper("misc");
        $this->load->helper("path");
        $this->load->helper("file");
        $this->load->helper("form");
        
        $this->load->library("image_lib");
        $this->load->library("default_view");

        //$this->load->model("tbl_arsip_surat");
        
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage($this->userAllowed); 
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/".__CLASS__);

        $this->mwId = $this->session->userdata["arrUser"]["usrt_id"];
    
    }


    protected function _retrieve_data($start, $limit, $arrLike = array()) {

        $arrWhere = array(
            "t1.tgem_tipe" => 1,
            "t2.tw_id" => $this->mwId
        );

        $arrData = $this->tbl_gembala->retrieve_data(
            $arrWhere, $start, $limit, $arrLike
        );

        return $arrData;
    }

    protected function _count_data($arrWhere = array(), $arrLike = array()) {

        $arrWhere = array(
            "t1.tgem_tipe" => 1,
            "t2.tw_id" => $this->mwId
        );
        $total = $this->tbl_gembala->count_data($arrWhere, $arrLike);

        return $total;
    }

}
    