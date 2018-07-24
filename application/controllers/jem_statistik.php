<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jem_statistik extends CI_Controller {

    protected $activeMenu = "dashboard";
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

        $this->load->model("trans_statistik_jemaat");
        
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->isLogin = $this->lib_login->check_login();
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/dashboard");
        $this->grjId = $this->session->userdata["arrUser"]["usrt_id"];
    }
    
    public function index($search = "all", $start = 0) {
		
        $arrWhere = array(
            "t1.tj_jk" => "L",
            "t2.tg_id" => $this->grjId
        );
        $countL = $this->trans_statistik_jemaat->count_data($arrWhere);

        $arrWhere["t1.tj_jk"] = "P";
        $countW = $this->trans_statistik_jemaat->count_data($arrWhere);

        $arrLP = array(
            "labels" => array("Laki-laki", "Perempuan"),
            "datasets" => array(
                array(
                    "data" => array($countL, $countW),
                    "backgroundColor" => array("#f56954", "#00c0ef"),
                )
            )
        );


        $arrCountYear = $this->trans_statistik_jemaat->count_by_year(
            array(
                "t1.tg_id" => $this->grjId,
                "YEAR(t1.tj_tgl_lahir) >" => date("Y") - 20
        )

        );

        $arrYear = $arrtotal = array();

        foreach($arrCountYear as $key => $arrVal) {
            $arrYear[] = $arrVal["year"];
            $arrtotal[] = $arrVal["total"];
        }

        $arrYear = array(
            "labels" => $arrYear,
            "datasets" => array(
                array(
                              
                    "label" => "Kelahiran / Tahun",
                    "fill" => "false",
                    "borderColor" => "#3e95cd",
                    "data" => $arrtotal
                )
            )
        );

        $arrView = array(
            "ctlArrUmur" => $this->_countUmur(),
            "ctlArrLP" => $arrLP,
            "ctlArrWadah" => $this->_count_wadah(),
            "ctlArrYear" => $arrYear
        );

        $arrData = array(
            "ctlTitle" => "Statistik",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("statistik"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("statistik/vw_jemaat_main", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                
                base_url("assets/js/jquery-ui.min.js"),
                base_url("assets/js/Chart.js"),
                base_url("assets/js/controller/statistik.js"),
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _countUmur() {

        $arrWhere = array(
            "age <" => 12,
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalAnak = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "age >=" => 12,"age <" => 18,
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalRemaja = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "age >=" => 18, "age <" => 60,
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalDewasa = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "age >=" => 60,
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalLansia = $this->trans_statistik_jemaat->count_tblView($arrWhere);

        $arrUmur = array(
            "labels" => array("Lansia", "Dewasa", "Remaja", "Anak-anak"),
            "datasets" => array(
                array(
                    "data" => array($totalLansia, $totalDewasa, $totalRemaja, $totalAnak),
                    "backgroundColor" => array("#f56954", "#00a65a", "#f39c12", "#00c0ef"),
                )
            )
        );

        return $arrUmur;
    }


    protected function _count_wadah() {

        $arrWhere = array(
            "t1.tj_status_nikah !=" => "S",
            "t1.tj_jk" => "P",
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totaPelwap = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "age >=" => 12,"age <" => 18,
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalPelprip = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "t1.tj_status_nikah !=" => "S",
            "t1.tj_jk" => "L",
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalPelnap = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "age >=" => 17,
            "t1.tj_status_nikah" => "S",
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalPelpap = $this->trans_statistik_jemaat->count_tblView($arrWhere);
        $arrWhere = array(
            "age <=" => 17,
            "age >" => 12,
            "t1.tj_status_nikah" => "S",
            "t1.tg_id" => $this->grjId,
            "t1.tj_status" => 1
        );
        $totalPelrap = $this->trans_statistik_jemaat->count_tblView($arrWhere);

        $arrUmur = array(
            "labels" => array("Pelwap", "Pelprip", "Pelnap", "Pelpap", "Pelrap"),
            "datasets" => array(
                array(
                    "data" => array(
                        $totaPelwap, $totalPelprip, $totalPelnap, $totalPelpap, $totalPelrap
                    ),
                    "backgroundColor" => array(
                        "#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc"
                    ),
                )
            )
        );

        return $arrUmur;
    }

    protected function _count_birth_year() {

    }

}
    