<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

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
        
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage("md");
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/user");

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
    
    public function index($search = "all", $start = 0) {
		
        $thisurl = $this->thisurl;

        $limit = 20;
        $arrWhere = array();
        $arrData = $this->tbl_user->retrieve_data($arrWhere, $start, $limit);

        $total = $this->tbl_user->count_data($arrWhere);

        $pagination = $this->_pagination($thisurl."/index/".$search, $total, $limit, 4);

        $arrTipe = $this->arrTipe;
        $arrStatus = $this->arrStatus;

        $arrView = array(
            "ctlArrData" => $arrData,
            "ctlArrTipe" => $arrTipe,
            "ctlArrStatus" => $arrStatus,
            "ctlPaging" => $pagination,
            "ctlStart" => $start + 1,
            "ctlLimit" => $limit,
            "ctlTotal" => $total,
            "ctlProfileUrl" => $thisurl . "/profile/",
            "ctlFormUrl" => $thisurl . "/form/",
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("user/vw_main", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                
            ),
            "ctlArrCss" => array()
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
                redirect($this->thisurl . "/after_submit/".$idData, "refresh");
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
                $arrData["tu_tipe_id"] = $arrPost["tipe_id_grj"];
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

        $arrInput = misc_helper::get_form_arrData_todb($arrPost, "tu_");
        $arrError = array();

        $isAllow = true;

        
        if ($arrInput["tu_id"] != "") {
            unset($arrInput["tu_username"]);
            if ($arrPost["password_baru"] != "") {
                if ($arrPost["password_baru"] == $arrPost["password_confirm"]) {
                    $arrInput["tu_password"] = md5($arrPost["password_baru"]);
                } else {
                    $arrError[] = "Password harus sama dengan konfirmasi password";
                }
            }
        } else {
            $arrUser = $this->tbl_user->select_by_username(
                $arrInput["tu_username"]
            );

            if ($arrUser) {
                $arrError[] = "Username sudah ada";
            } else if ($arrInput["tu_username"] == "") {
                $arrError[] = "Username tidak boleh kosong";
            }

            if ($arrPost["password_baru"] != ""
                && $arrPost["password_baru"] == $arrPost["password_confirm"]
            ) {
                $arrInput["tu_password"] = md5($arrPost["password_baru"]);
            } else {
                $arrError[] = "Password tidak boleh kosong dan harus sama dengan konfirmasi";
            }
        }

        if (trim($arrInput["tu_display_name"]) == "") {
            $arrError[] = "Nama tidak boleh kosong";
        } else if (strlen(trim($arrInput["tu_display_name"])) < 5) {
            $arrError[] = "Nama harus lebih dari 5 karakter";
        }

        $statusSubmit = true;
        if ($arrPost["tu_tipe_user"] == 3) {
            $arrInput["tu_tipe_id"] = $arrPost["tipe_id_wil"];
        } else if ($arrPost["tu_tipe_user"] == 5) {
            $arrInput["tu_tipe_id"] = $arrPost["tipe_id_grj"];
        } else {
            $arrInput["tu_tipe_id"] = 0;
        }

        $id = 0;
        $result = false;
        if (count($arrError) == 0) {
            if ($arrInput["tu_id"] == "") { // insert
                $result = $this->tbl_user->insertdata(array($arrInput));
                $id = $this->tbl_user->last_insert_id();
            } else {
                $id = $arrInput["tu_id"];
                $result = $this->tbl_user->updatedata($arrInput, $id);
            }
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

        $arrData[0]["tu_status"] = $this->arrStatus[$arrData[0]["tu_status"]];
        $arrData[0]["tu_tipe_user"] = $this->arrTipe[$arrData[0]["tu_tipe_user"]];

        $arrView = array(
            "ctlArrData" => $arrData[0],
            "ctlFormUrl" => $this->thisurl . "/form/" . $id,
            "ctlProfileUrl" => $this->thisurl . "/form/" . $id
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
    