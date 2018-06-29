<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mw_jemaat extends CI_Controller {

    protected $idWilayah;
    protected $activeMenu = "jemaat";
    protected $title = "Data Arsip Surat";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Arsip Surat",
        "ctlSubtitle" => "Form Pengisian"
    );
    protected $arrCss = array();
    protected $arrJs = array();
    
    protected $thisurl;
    protected $lib_defaultView;

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

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->isLogin = $this->lib_login->check_login();
        $this->arrSession = $this->lib_login->get_session_data();
        
        $this->idWilayah = $this->arrSession["arrUser"]["usrt_id"];
        
        $this->lib_login->redir_ifnot_login();
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/".__CLASS__);
    }
    
    public function index($search = "all", $start = 0) {
        $idWilayah = $this->idWilayah;

        $arrView = array(
            "arrData" => array(),
            "ctlUrlAdd" => $this->thisurl . "/pilih_gereja/"
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_main",
                $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }   

    public function pilih_gereja() {
        $idWilayah = $this->idWilayah;

        $arrWhere = array("t1.tw_id" => $idWilayah);
        $arrGereja = $this->tbl_gereja->retrieve_data($arrWhere);

        $arrView = array(
            "ctlArrGereja" => $arrGereja,
            "ctlUrl" => $this->thisurl . "/form/"
        );
        
        $content = $this->load->view(
            "mw_view/jemaat/vw_form_pilih_gereja", $arrView, true
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $content,
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function form($idGereja = "", $idJemaat = "") {
        if (!is_numeric($idGereja)) {
            show_404();
        }
        $idWilayah = $this->idWilayah;

        $arrWhere = array(
            "t1.tw_id" => $idWilayah,
            "t1.tg_id" => $idGereja
        );
        $arrGereja = $this->tbl_gereja->retrieve_data($arrWhere);

        if (!$arrGereja) {
            show_404();
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/submit",
            "ctlPilihGereja" => $this->thisurl . "/pilih_gereja",
            "ctlArrGereja" => $arrGereja[0]
        );
        $content = $this->load->view(
            "jemaat/vw_form_jemaat", $arrForm, true
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $content,
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/bootstrap-datepicker.min.js"),
                base_url("assets/js/controller/jemaat.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/jquery-ui.structure.min.css"),
                base_url("assets/css/jquery-ui.theme.min.css"),
                base_url("assets/css/jquery-ui.css"),
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);

    }

    public function profile($id = "") {
        $arrForm = array();

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_profile_jemaat",
                $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
            ),
            "ctlArrCss" => array(
                base_url("assets/css/jquery-ui.structure.min.css"),
                base_url("assets/css/jquery-ui.theme.min.css"),
                base_url("assets/css/jquery-ui.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }
}
    