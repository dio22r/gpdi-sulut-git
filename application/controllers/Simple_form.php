<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class simple_form extends CI_Controller {

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

        $this->load->model("tbl_user");
        $this->load->model("tbl_gereja");
        $this->load->model("tbl_simple_form");
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage("md");
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/simple_form");

        $this->arrTipe =  arraY(
            1 => "Majelis Daerah",
            2 => "MD Viewer",
            3 => "Majelis Wilayah",
            4 => "MW Viewer",
            5 => "Gembala"
        );

        $this->arrStatus = array(
            1 => "Aktif",
            2 => "Non-aktif"
        );
    }
    
    public function index($id = "") {
        
        $arrPost = $this->input->post();
        $statErr = false;
        $arrError = array();
        $statSubmit = false;

        if ($arrPost) {
            $arrRes = $this->submit();
            $statErr = !$arrRes["status"];

            if ($arrRes["status"] === true) {
                $idData = $arrRes["arrDet"]["id"];
                $statSubmit = true;
            } else {
                $arrError = $arrRes["arrDet"];
            }
        }

        $this->load->model("tbl_wilayah");
        $arrData = $this->tbl_user->select_by_id($id);

        if ($arrData) {
            $arrData = $arrData[0];
        }

        if ($arrPost) {
            $arrData = $arrPost;
        }

        $arrRecent = $this->tbl_gereja->retrieve_recent();

        $arrWilayah = $this->tbl_wilayah->retrieve_wilayah();
        $arrWilayah = misc_helper::db_to_dropdown(
            "tw_id", "tw_nama", $arrWilayah
        );

        $arrTipe = $this->tbl_user->retrieve_tipe_user();

        $arrForm = array(
            "ctlArrData" => $arrData,
            "ctlArrTipe" => $arrTipe,
            "ctlUrlSubmit" => $this->thisurl."/index/".$id,
            "ctlUrlCancel" => $this->thisurl,
            "ctlEditForm" => $this->thisurl."/edit_table/",
            "ctlArrMw" => $arrWilayah,
            "ctlArrGembala" => array(),
            "ctlStatErr" => $statErr,
            "ctlArrErr" => $arrError,
            "ctlStatSubmit" => $statSubmit,
            "ctlArrRecent" => $arrRecent
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("simple_form"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("simple_form/vw_main_form", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/controller/simple_form.js"),
                base_url("assets/js/select2.full.min.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }   

    protected function _pagination($url, $totalRows, $perpage, $uriSegment) {
        $this->load->library('pagination');

        $config['base_url'] = $url;
        $config['total_rows'] = $totalRows;
        $config['reuse_query_string'] = true;
        $config['per_page'] = $perpage;
        $config['uri_segment'] = $uriSegment;
        $config['num_links'] = 3;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($config); 

        $pagination = $this->pagination->create_links();
 
        return $pagination;
    }

    protected function _get_data($search, $start, $perpage) {
        $arrData = $this->tbl_gereja->retrieve_data(
            $search, $start, $perpage, "t1.tg_id DESC"
        );

        return $arrData;
    }

    protected function _get_count_data() {
        $count = $this->tbl_gereja->count_data(array());

        return $count;
    }

	public function edit_table($start = 0, $idEdit = "", $uriStats = "") {

        $arrPost = $this->input->post();
        $statErr = false;
        $arrError = array();
        $statSubmit = false;

        $ctlArrEditData = array();

        if ($arrPost) {
            $arrRes = $this->submitEdit();
            $statErr = !$arrRes["status"];

            if ($arrRes["status"] === true) {
                $idData = $arrRes["arrDet"]["id"];
                $statSubmit = true;
            } else {
                $arrError = $arrRes["arrDet"];
            }
        }

        if ($idEdit) {
            $arrWhere = array("t1.tg_id" => $idEdit);
            $ctlArrEditData = $this->_get_data($arrWhere, 0, 1);
            $ctlArrEditData = $ctlArrEditData[0];
        }

        if ($uriStats == "delete") {
            $arrRes = $this->deleteData(
                $idEdit, $ctlArrEditData["tgem_id"]
            );
            
            if ($arrRes["status"] === true) {
                $idData = $arrRes["arrDet"]["id"];
                $statSubmit = true;
            } else {
                $arrError = $arrRes["arrDet"];
            }
        }

        
        $this->load->model("tbl_wilayah");
        
        $perpage = 20;
        $arrData = $this->_get_data("", $start, $perpage);
        $totalData = $this->_get_count_data();

        $paging = $this->_pagination(
            $this->thisurl."/edit_table/", $totalData, $perpage, 3
        );


        $arrWilayah = $this->tbl_wilayah->retrieve_wilayah();
        $arrWilayah = misc_helper::db_to_dropdown(
            "tw_id", "tw_nama", $arrWilayah
        );

        $arrTipe = $this->tbl_user->retrieve_tipe_user();

        $arrForm = array(
            "ctlArrEditData" => $ctlArrEditData,
            "ctlArrData" => $arrData,
            "ctlUrlSubmit" => current_url(),
            "ctlUrlEdit" => $this->thisurl . "/edit_table/" . $start,
            "ctlUrlCancel" => $this->thisurl,
            "ctlArrMw" => $arrWilayah,
            "ctlArrGembala" => array(),
            "ctlStatErr" => $statErr,
            "ctlArrErr" => $arrError,
            "ctlStatSubmit" => $statSubmit,
            "ctlPaging" => $paging,
            "ctlStart" => $start
        );

        $arrData = array(
            "ctlTitle" => "Data Gereja & Gembala",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("simple_form"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("simple_form/vw_edit_form", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/controller/simple_form.js"),
                base_url("assets/js/select2.full.min.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
	}

    public function submitEdit() {
        $arrPost = $this->input->post();

        $arrGereja = array(
            "update" => array(
                "tg_nama" => $arrPost["tg_nama"],
                "tw_id" => $arrPost["tw_id"]
                
            ),
            "where" => array(
                "tg_id" => $arrPost["tg_id"]
            )
        );

        $arrGembala = array(
            "update" => array(
                "tgem_nama" => $arrPost["tgem_nama"],
                "tgem_no_telp" => $arrPost["tgem_no_telp"]
            ),
            "where" => array(
                "tgem_id" => $arrPost["tgem_id"]
            )
        );


        $status = $this->tbl_simple_form->updateGereja(
            $arrGereja, $arrGembala
        );

        if ($status) {
            return array(
                "status" => true,
                "arrDet" => array("id" => $arrPost["tg_id"])
            );
        } else {
            return array("status" => false);
        }
    }

    public function deleteData($tg_id, $tgem_id) {
        
        $arrGereja = array(
            "update" => array(
                "tg_status" => 0
            ),
            "where" => array(
                "tg_id" => $tg_id
            )
        );

        $arrGembala = array(
            "update" => array(
                "tgem_status" => 0
            ),
            "where" => array(
                "tgem_id" => $tgem_id
            )
        );        

        $status = $this->tbl_simple_form->updateGereja(
            $arrGereja, $arrGembala
        );

        if ($status) {
            return array(
                "status" => true,
                "arrDet" => array("id" => $tg_id)
            );
        } else {
            return array("status" => false);
        }
    }

    public function submit() {
        $arrPost = $this->input->post();
        $isAllow = true;
        $arrError = array();

        $arrGereja = $arrGembala = array();

        if ($arrPost["tgem_nama"] != "") {
            $arrGembala = array(
                "tgem_nama" => $arrPost["tgem_nama"],
                "tgem_no_telp" => $arrPost["tgem_no_telp"],
                "tgem_status" => 1
            );
        } else {
            $arrError[] = "Nama Gembala tidak boleh kosong";
        }

        if ($arrPost["tg_nama"] != "") {
            $arrGereja = array(
                "tg_nama" => $arrPost["tg_nama"],
                "tw_id" => $arrPost["tw_id"],
                "tg_status" => 1
            );
        } else {
            $arrError[] = "Nama Gereja tidak boleh kosong";
        }

        if ($arrPost["tg_id"] != "") {
            // cek nama gereja

            $result = false;
        } else {

            $result = $this->tbl_simple_form->insertdata(
                $arrGembala, $arrGereja
            );
            $id = $this->tbl_simple_form->get_last_id();
        }
        
        if ($result) {
            return array(
                "status" => true,
                "arrDet" => array(
                    "id" => $id
                )
            );
        } else {
            return array(
                "status" => false,
                "arrDet" => $arrError
            );
        }
    }


    public function data_kabupaten($id = "") {

        $this->load->model("tbl_kabupaten");

        $arrPost = $this->input->post();
        
        $arrKab = array();
        if (is_numeric($id)) {
            $arrKab = $this->tbl_kabupaten->select_by_id($id);
            $arrKab = $arrKab[0];
        }

        if ($arrPost) {
            $arrUpdate = $arrPost;
            $idUpdate = $arrUpdate["tkab_id"];
            unset($arrUpdate["tkab_id"]);
            $return = $this->tbl_kabupaten->updatedata(
                $arrUpdate, $idUpdate
            );
        }

        $arrData = $this->tbl_kabupaten->retrieve_data();

        $totalDewasa = $totalAnak = 0;
        foreach($arrData as $key => $arrVal) {
            $arrData[$key]["total"] = $arrVal["tkab_total_dewasa"] + $arrVal["tkab_total_anak"];
            $totalDewasa += $arrVal["tkab_total_dewasa"];
            $totalAnak += $arrVal["tkab_total_anak"];
        }

        $arrForm = array(
            "ctlArrKab" => $arrKab,
            "ctlArrData" => $arrData,
            "ctlUrlSubmit" => current_url(),
            "ctlUrlEdit" => $this->thisurl . "/data_kabupaten/",
            "ctlUrlCancel" => $this->thisurl . "/data_kabupaten/",
            "ctlUrlGereja" => $this->thisurl,
            "ctlStatErr" => false,
            "ctlStatSubmit" => false
        );

        $arrData = array(
            "ctlTitle" => "Data Kabupaten",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("simple_form"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("simple_form/vw_kab_form", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/controller/simple_form.js"),
                base_url("assets/js/select2.full.min.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

}
    