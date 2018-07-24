<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once "Wilayah.php";

class mw_wilayah extends wilayah {

    protected $activeMenu = "wilayah";
    protected $title = "Data Arsip Surat";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Data Wilayah",
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

        $this->load->library("default_view");

        $this->load->model("tbl_wilayah");
        $this->load->model("tbl_kabupaten");
        $this->load->model("tbl_gereja");

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage($this->userAllowed);
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/mw_wilayah");
        $this->thisurlGereja = base_url("index.php/mw_gereja");
        $this->mwId = $this->session->userdata["arrUser"]["usrt_id"];
    }
    
    public function index($search = "all", $start = 0) {
        $mwId = $this->mwId;

        parent::profile($mwId);
    }

    public function profile($id = "") {
        $mwId = $this->mwId;
        parent::profile($mwId);
    }

    public function form($id = "") {
        show_404();
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

    public function form_submit() {
        show_404();
    }

    public function form_aset($idWilayah = "", $idDet = "") {
        
        $this->load->model("tbl_aset");

        $this->_submit_aset();

        $arrData[0] = array(
            "rel_id" => $idWilayah
        );

        if (is_numeric($idDet)) {
            $arrWhere = array(
                "rel_id" => $idWilayah,
                "rel_tipe" => 3,
                "ta_id" => $idDet
            );

            $arrData = $this->tbl_aset->select_det_by_id($arrWhere);
            if (!$arrData) {
                show_404();
            }
        }
        
        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form_aset/".$idWilayah."/".$idDet,
            "ctlUrlBack" => $this->thisurl,
            "ctlArrData" => $arrData
        );

        $content = $this->load->view(
            "wilayah/vw_form_aset", $arrForm, true
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $content,
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _submit_aset($type = "") {
        

        $arrPost = $this->input->post();

        if ($arrPost) {
            if (is_numeric($arrPost["ta_id"])) {
                // update
                $arrUpdate = $arrPost;
                $arrWhere = array(
                    "ta_id" => $arrPost["ta_id"],
                    "rel_tipe" => 3,
                    "rel_id" => $arrPost["rel_id"],
                );

                $return = $this->tbl_aset->update_det_by_id($arrUpdate, $arrWhere);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["rel_id"], "refresh");
                } else {
                    return false;
                }
            } else {
                // insert
                $arrInsert = $arrPost;
                $arrInsert["rel_tipe"] = 3;
                $return = $this->tbl_aset->insert_det_by_id($arrInsert);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["rel_id"], "refresh");
                } else {
                    return false;
                }
            }
        }
    }

    public function delete_aset($idJemaat, $idDet) {
        $this->load->model("tbl_aset");

        $arrWhere = array(
            "rel_tipe" => 3,
            "rel_id" => $idJemaat,
            "ta_id" => $idDet
        );
            
        $arrUpdate = array(
            "ta_status" => 0
        );

        $return = $this->tbl_aset->update_det_by_id($arrUpdate, $arrWhere);

        redirect($this->thisurl . "/profile/" . $idJemaat, "refresh");

    }
}
    