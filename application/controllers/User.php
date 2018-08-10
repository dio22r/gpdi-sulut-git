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
            5 => "Gereja"
        );

        $this->arrStatus = array(
            0 => "Non-aktif",
            1 => "Aktif",
            2 => "Perlu Konfirmasi"
        );
    }
    
    public function index($search = "all", $start = 0) {
		$arrGet = $this->input->get();
        $thisurl = $this->thisurl;
        $perpage = 20;
        $curUrl = current_url();
        $encCurUrl = $this->_base64_url_encode($curUrl);

        $arrWhere = array();

        $arrSortHeader = array(
            "tu_username" => array(
                "text" => "Username",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tu_display_name" => array(
                "text" => "Nama",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tu_tipe_user" => array(
                "text" => "Tipe User",
                "sort" => false,
                "type" => "ASC",
                "class" => ""
            ),
            "tu_status" => array(
                "text" => "Status",
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

        $sortUrl = $thisurl."/";
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

                $href = $sortUrl."?sort_field=".$key."&sort_type=".$arrVal["type"];
                $arrSortHeader[$key]["href"] = $href;
                $arrSortHeader[$key]["class"] = $class;
            }

            $arrSortHeader[$key]["href"] = $href;
        }

        $orderBy = "tu_registered DESC";
        if (isset($arrGet["sort_field"]) && isset($arrGet["sort_type"])) {
            $orderBy = $arrGet["sort_field"] . " " . $arrGet["sort_type"];
        }

        $arrData = $this->tbl_user->retrieve_data($arrWhere, $start, $perpage, $orderBy);

        $total = $this->tbl_user->count_data($arrWhere);

        $pagination = $this->_pagination($thisurl."/index/".$search, $total, $perpage, 4);

        $arrTipe = $this->arrTipe;
        $arrStatus = $this->arrStatus;

        $arrView = array(
            "ctlArrSortHeader" => $arrSortHeader,
            "ctlEncUrl" => $encCurUrl,
            "ctlActifasiUrl" => $thisurl . "/aktifasi/",
            "ctlArrData" => $arrData,
            "ctlArrTipe" => $arrTipe,
            "ctlArrStatus" => $arrStatus,
            "ctlPaging" => $pagination,
            "ctlStart" => $start + 1,
            "ctlLimit" => $perpage,
            "ctlTotal" => $total,
            "ctlProfileUrl" => $thisurl . "/profile/",
            "ctlFormUrl" => $thisurl . "/form/",
            "ctlUrlPendaftar" => $thisurl . "/proses_daftar/"
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
            "ctlArrCss" => array(
                base_url("assets/css/jquery.dataTables.min.css")
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

    public function aktifasi($id, $status, $urlEncode = "") {

        if ($status != 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $arrUpdate = array(
            "tu_status" =>  $status
        );

        $url = $this->_base64_url_decode($urlEncode);

        print_r($arrUpdate);

        
        $status = $this->tbl_user->updatedata($arrUpdate, $id);
        
        redirect($url, "refresh");
    }

    protected function _base64_url_encode($input) {
        return strtr(base64_encode($input), '+/=', '._-');
    }

    protected function _base64_url_decode($input) {
        return base64_decode(strtr($input, '._-', '+/='));
    }

    public function proses_daftar($search = "all", $start = 0) {
        $arrGet = $this->input->get();
        $thisurl = $this->thisurl;
        $perpage = 20;
        $curUrl = current_url()."?".http_build_query($arrGet);
        $encCurUrl = $this->_base64_url_encode($curUrl);

        $arrWhere = array(
            "tu_tipe_registered" => 1
        );


        $arrSortHeader = array(
            "tu_username" => array(
                "text" => "Username",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tu_display_name" => array(
                "text" => "Nama",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tu_tipe_user" => array(
                "text" => "Tipe User",
                "sort" => false,
                "type" => "ASC",
                "class" => ""
            ),
            "tg_nama" => array(
                "text" => "Nama Gereja",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tu_status" => array(
                "text" => "Status",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tu_registered" => array(
                "text" => "Tanggal Daftar",
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

        $sortUrl = $thisurl."/proses_daftar/";
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

                $href = $sortUrl."?sort_field=".$key."&sort_type=".$arrVal["type"];
                $arrSortHeader[$key]["href"] = $href;
                $arrSortHeader[$key]["class"] = $class;
            }

            $arrSortHeader[$key]["href"] = $href;
        }

        $orderBy = "tu_registered DESC";
        if (isset($arrGet["sort_field"]) && isset($arrGet["sort_type"])) {
            $orderBy = $arrGet["sort_field"] . " " . $arrGet["sort_type"];
        }
        
        $arrData = $this->tbl_user->retrieve_data_user_gereja(
            $arrWhere, $start, $perpage, $orderBy
        );

        $total = $this->tbl_user->count_data($arrWhere);

        $pagination = $this->_pagination(
            $thisurl."/proses_daftar/".$search."/", $total, $perpage, 4
        );

        $arrTipe = $this->arrTipe;
        $arrStatus = $this->arrStatus;

        $arrView = array(
            "ctlArrSortHeader" => $arrSortHeader,
            "ctlEncUrl" => $encCurUrl,
            "ctlActifasiUrl" => $thisurl . "/aktifasi/",
            "ctlArrData" => $arrData,
            "ctlArrTipe" => $arrTipe,
            "ctlArrStatus" => $arrStatus,
            "ctlPaging" => $pagination,
            "ctlStart" => $start + 1,
            "ctlLimit" => $perpage,
            "ctlTotal" => $total,
            "ctlProfileUrl" => $thisurl . "/profile/",
            "ctlFormUrl" => $thisurl . "/form/",
            "ctlBaseUrl" => $thisurl
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("user/vw_main_daftar", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array(
                base_url("assets/css/jquery.dataTables.min.css")
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }
}
    