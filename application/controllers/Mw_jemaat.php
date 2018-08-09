<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("Jemaat.php");

class mw_jemaat extends jemaat {

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
        $this->load->model("tbl_jemaat");

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage($this->userAllowed);
        $this->arrSession = $this->lib_login->get_session_data();
        
        $this->idWilayah = $this->arrSession["arrUser"]["usrt_id"];
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/".__CLASS__);
    
    }

    public function index($search = "all", $start = 0) {
        $idWilayah = $this->idWilayah;
        $arrGet = $this->input->get();

        $arrWhere = array("t2.tw_id" => $idWilayah);

        $curUrl = current_url() . "?" . http_build_query($arrGet);

        $perpage = 20;


        $arrSortHeader = array(
            "tj_nama" => array(
                "text" => "Nama",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tj_jk" => array(
                "text" => "Jenis Kelamin",
                "sort" => false,
                "class" => ""
            ),
            "age" => array(
                "text" => "Umur",
                "sort" => false,
                "type" => "ASC",
                "class" => ""
            ),
            "tj_tgl_lahir" => array(
                "text" => "Tgl. Lahir",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tj_status_nikah" => array(
                "text" => "Status Menikah",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tj_status_nikah" => array(
                "text" => "Status Menikah",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tg_nama" => array(
                "text" => "Nama Gereja",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "action" => array(
                "text" => "Edit/View",
                "sort" => false,
                "class" => ""
            ),
        );

        $sortUrl = $this->thisurl."";
        foreach ($arrSortHeader as $key => $arrVal)  {
            $class = "sorting";

            $href = "#";
            if ($arrVal["sort"]) {

                if (isset($arrGet["sort_field"]) && $key == $arrGet["sort_field"]) {

                    $class = "sorting_desc";
                    if (strtolower($arrGet["sort_type"]) == "asc") {
                        $arrVal["type"] = "DESC";
                        $class = "sorting_asc";
                    }
                }

                $href = $this->thisurl."?sort_field=".$key."&sort_type=".$arrVal["type"];
                $arrSortHeader[$key]["href"] = $href;
                $arrSortHeader[$key]["class"] = $class;
            }
            

            $arrSortHeader[$key]["href"] = $href;
        }

        $orderBy = "tj_nama ASC";
        if (isset($arrGet["sort_field"]) && isset($arrGet["sort_type"])) {
            $orderBy = $arrGet["sort_field"] . " " . $arrGet["sort_type"];
        }

        
        $arrData = $this->tbl_jemaat->retrieve_data(
            $arrWhere, $start, $perpage,
            "t1.*, t2.*, floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tj_tgl_lahir, '%Y-%m-%d'))/365) as age", $orderBy
        );

        $countTotal = $this->tbl_jemaat->count_data($arrWhere);

        $arrStsNikah = array(
            "S" => "Singel",
            "M" => "Menikah",
            "J" => "Janda",
            "D" => "Duda"
        );

          $arrJk = array(
            "L" => "Laki-laki",
            "P" => "Perempuan"
          );


        $apiUrl = base_url("index.php/api/api_jemaat/profile/");
        $arrView = array(
            "ctlStart" => $start,
            "ctlArrData" => $arrData,
            "ctlStsNikah" => $arrStsNikah,
            "ctlArrJk" => $arrJk,
            "ctlUrlAdd" => $this->thisurl . "/pilih_gereja/",
            "ctlUrlEdit" => $this->thisurl . "/form/",
            "ctlUrlProfile" => $this->thisurl . "/profile/",
            "ctlUrlProfileJemaat" => $apiUrl ,
            "ctlCurUrl" => $curUrl,
            "ctlUrlSubmit" => $this->thisurl . "/submit_mutasi/",
            "ctlPagination" => $this->_pagination($this->thisurl."/index/all/", $countTotal, $perpage, 4),
            "ctlArrSortHeader" => $arrSortHeader
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_main_sorting",
                $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("assets/js/controller/api_jemaat.js"),
                base_url("assets/js/bootstrap-datepicker.min.js"),
            ),
            "ctlArrCss" => array(
                base_url("assets/css/jquery.dataTables.min.css"),
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
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

        $arrData = $this->tbl_jemaat->select_by_id($idJemaat);

        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/submit",
            "ctlPilihGereja" => $this->thisurl . "/pilih_gereja",
            "ctlArrGereja" => $arrGereja[0],
            "ctlArrData" => $arrData
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

    public function submit() {
        $arrPost = $this->input->post();

        if ($arrPost["tj_id"] != "" && is_numeric($arrPost["tj_id"])) {
            $this->tbl_jemaat->updatedata($arrPost, $arrPost["tj_id"]);
            $id = $arrPost["tj_id"];
        } else {
            $id = $this->tbl_jemaat->insertdata(array($arrPost));
        }
        
        redirect($this->thisurl . "/profile/" . $id, "refresh");

    }


}
    