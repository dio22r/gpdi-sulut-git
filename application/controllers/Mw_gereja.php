<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once "Gereja.php";

class mw_gereja extends gereja {

    protected $activeMenu = "gereja";
    protected $mwId;

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

        $this->thisurl = base_url("index.php/mw_gereja");
        $this->mwId = $this->session->userdata["arrUser"]["usrt_id"];
    }

    public function index($search = "all", $start = 0) {
        $arrPost = $this->input->post();

        $arrLike = array();
        $plainSearch = "";

        if ($arrPost || $search != "all") {
            if ($arrPost) {
                $plainSearch = $arrPost["table_search"];
                $search = $this->_base64_url_encode($plainSearch);
            } else {
                $plainSearch = $this->_base64_url_decode($search);
            }

            $arrLike = array(
                "tg_nama" => $plainSearch //str_replace(" ", "%%", $plainSearch)
            );
        }

        $perpage = 20;
        $totalData = $this->_get_count_data($arrLike);
        $arrData = $this->_get_data($arrLike, $start, $perpage);

        foreach($arrData as $key => $arrVal) {
            $arrData[$key]["tg_tgl_berdiri"] = misc_helper::format_idDate(
                $arrVal["tg_tgl_berdiri"]
            );
        }
        
        $arrView = array(
            "ctlStart" => $start,
            "ctlUrlForm"  => $this->thisurl."/form/",
            "ctlUrlSearch"  => $this->thisurl,
            "ctlUserType" => $this->usertype,
            "ctlPlainSearch" => $plainSearch,
            "ctlArrData" => $arrData,
            "ctlPaging" => $this->_pagination(
                $this->thisurl."/index/".$search, $totalData, $perpage, 4
            )
        );        

        $content = $this->load->view("gereja/vw_main_mw", $arrView, true);
        $arrData = array(
            "ctlTitle" => "Data Gereja",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gereja"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $content,
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }   

    protected function _get_data($arrLike, $start, $perpage) {
        $arrWhere = array("t1.tw_id" => $this->mwId);
        $arrData = $this->tbl_gereja->retrieve_data(
            $arrWhere, $start, $perpage
        );

        return $arrData;
    }

    protected function _get_count_data($arrLike = array()) {
        $arrWhere = array("t1.tw_id" => $this->mwId);
        $count = $this->tbl_gereja->count_data($arrWhere);

        return $count;
    }
	
}
    