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
        $this->load->model("tbl_simple_form");
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
            "ctlArrMw" => $arrWilayah,
            "ctlArrGembala" => array(),
            "ctlStatErr" => $statErr,
            "ctlArrErr" => $arrError,
            "ctlStatSubmit" => $statSubmit
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
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

	public function form($id = "") {
        $arrPost = $this->input->post();
        $statErr = false;
        $arrError = array();
        if ($arrPost) {
            $arrRes = $this->submit();
            $statErr = !$arrRes["status"];

            if ($arrRes["status"] === true) {
                $idData = $arrRes["arrDet"]["id"];

                print_r($arrRes);
                //redirect($this->thisurl . "/after_submit/".$idData, "refresh");
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
            if ($arrPost["tu_tipe_user"] == 3) {
                $arrData["tu_tipe_id"] = $arrPost["tipe_id_wil"];
            } else if ($arrPost["tu_tipe_user"] == 5) {
                $arrData["tu_tipe_id"] = $arrPost["tipe_id_gem"];
            } else {
                $arrData["tu_tipe_id"] = 0;
            }
        }

        $arrWilayah = $this->tbl_wilayah->retrieve_wilayah();

        $arrWilayah = misc_helper::db_to_dropdown(
            "tw_id", "tw_nama", $arrWilayah
        );

        $arrTipe = $this->tbl_user->retrieve_tipe_user();

        $arrForm = array(
            "ctlArrData" => $arrData,
            "ctlArrTipe" => $arrTipe,
            "ctlUrlSubmit" => $this->thisurl."/form/".$id,
            "ctlUrlCancel" => $this->thisurl,
            "ctlArrMw" => $arrWilayah,
            "ctlArrGembala" => array(),
            "ctlStatErr" => $statErr,
            "ctlArrErr" => $arrError
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("user/vw_form_user", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/controller/user.js"),
                base_url("assets/js/select2.full.min.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);

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
            $id = $this->tbl_simple_form->get_last_id();
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

    public function after_submit($id) {
        $arrData = $this->tbl_user->select_by_id($id);
                
        if (!$arrData) {
            show_404();
        }

        $this->load->model("tbl_wilayah");

        $idTipe = $arrData[0]["tu_tipe_id"];
        if ($arrData[0]["tu_tipe_user"] == 3) {
            $arrDetail = $this->tbl_wilayah->select_by_id($idTipe);
            $strNama = "Wilayah ". $arrDetail[0]["tw_nomor_induk"] ." ". $arrDetail[0]["tw_nama"];
        } elseif ($arrData[0]["tu_tipe_user"] == 5) {
            //$arrDetail = $this->tbl_wilayah->select_by_id($id);
            $strNama = "";
        }

        $arrData[0]["tu_status"] = $this->arrStatus[$arrData[0]["tu_status"]];
        $arrData[0]["tu_tipe_user_str"] = $this->arrTipe[$arrData[0]["tu_tipe_user"]];
        $arrData[0]["tu_tipe_user_det"] = $strNama;


        $arrView = array(
            "ctlArrData" => $arrData[0],
            "ctlFormUrl" => $this->thisurl . "/form/" . $id,
            "ctlProfileUrl" => $this->thisurl . "/profile/" . $id,
            "ctlHomeUrl" => $this->thisurl
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("user/vw_after_submit", $arrView, true),
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

    public function profile($id = "") {
        $arrData = $this->tbl_user->select_by_id($id);


        if (!$arrData) {
            show_404();
        }

        $arrData[0]["tu_status"] = $this->arrStatus[$arrData[0]["tu_status"]];
        $arrData[0]["tu_tipe_user"] = 
            $this->arrTipe[$arrData[0]["tu_tipe_user"]];

        $arrView = array(
            "ctlArrData" => $arrData[0],
            "ctlFormUrl" => $this->thisurl . "/form/" . $arrData[0]["tu_id"]
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("user/vw_profile_user", $arrView, true),
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
    