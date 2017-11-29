<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mw_jemaat extends CI_Controller {

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

        //$this->load->model("tbl_arsip_surat");
        
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

        $this->thisurl = base_url("index.php/dashboard");
    }
    
    public function index($search = "all", $start = 0) {
        
        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_main", array(), true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }   

    public function form($id = "") {
        $arrForm = array();

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_form_jemaat", $arrForm, true),
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
    