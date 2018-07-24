<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mw_pengumuman extends CI_Controller {

    protected $activeMenu = "pengumuman";
    protected $title = "Data Pengumuman";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Pengumuman",
        "ctlSubtitle" => "Form Pengisian"
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

        $this->load->model("tbl_pengumuman");
        
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        //$this->lib_login->previlage($this->userAllowed);
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/mw_pengumuman");
    }
    
    public function index($search = "all", $start = 0) {
		
        //print_r($this->arrSession);
        
        $arrWhere = array(
            "tpeng_status" => 1,
            "tpeng_tipe" => 1
        );
        $arrData = $this->tbl_pengumuman->retrieve_data($arrWhere, 0, 20, "tpeng_datetime DESC");


        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl . "/index",
            "ctlUrlPengumuman" => $this->thisurl . "/index",
            "ctlUrlBerita" => $this->thisurl . "/berita",
            "ctlArrData" => $arrData
        );

        $arrData = array(
            "ctlTitle" => "Pengumuman",
            "ctlSubTitle" => "Informasi Kegiatan",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("pengumuman"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("mw_view/pengumuman/vw_pengumuman", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("assets/js/controller/arsip_surat.js")
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }
	

    public function berita($search = "all", $start = 0) {
        
        //print_r($this->arrSession);
        
        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl . "/index",
            "ctlUrlPengumuman" => $this->thisurl . "/index",
            "ctlUrlBerita" => $this->thisurl . "/berita",
        );

        $arrData = array(
            "ctlTitle" => "Pengumuman",
            "ctlSubTitle" => "Liputan Kegiatan",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("pengumuman"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("mw_view/pengumuman/vw_berita", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("assets/js/controller/arsip_surat.js")
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }
}
    