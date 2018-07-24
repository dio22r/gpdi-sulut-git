<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pengumuman extends CI_Controller {

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
    public $userAllowed = "md";
    
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
        $this->lib_login->previlage($this->userAllowed);
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/pengumuman");
    }
    
    public function index($search = "", $idEdit = "") {
		
        $this->_submit();

        $arrWhere = array(
            "tpeng_status" => 1,
            "tpeng_tipe" => 1
        );
        $arrData = $this->tbl_pengumuman->retrieve_data($arrWhere, 0, 20, "tpeng_datetime DESC");

        $arrEdit = array();
        if ($search = "edit" && is_numeric($idEdit)) {
            $arrWhere = array(
                "tpeng_id" => $idEdit
            );
            $arrEdit = $this->tbl_pengumuman->retrieve_data($arrWhere);
            $arrEdit = $arrEdit[0];
        }

        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl . "/index",
            "ctlUrlPengumuman" => $this->thisurl . "/index",
            "ctlUrlBerita" => $this->thisurl . "/berita",
            "ctlUrlEdit" => $this->thisurl . "/index/edit/",
            "ctlUrlDelete" => $this->thisurl . "/delete/",
            "ctlArrData" => $arrData,
            "ctlArrEdit" => $arrEdit,
        );

        $arrData = array(
            "ctlTitle" => "Pengumuman",
            "ctlSubTitle" => "Informasi Kegiatan",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("pengumuman"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("pengumuman/vw_pengumuman", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _submit() {
        $arrPost = $this->input->post();

        if ($arrPost) {
            if (is_numeric($arrPost["tpeng_id"])) {
                $arrUpdate = $arrPost;
                $arrWhere = array("tpeng_id" => $arrPost["tpeng_id"]);
                unset($arrUpdate["tpeng_id"]);

                $status = $this->tbl_pengumuman->updatedata($arrUpdate, $arrWhere);
            } else {
                $arrInsert = $arrPost;

                $userId = $this->arrSession["idUser"];

                $arrInsert["tu_id"] = $userId;
                $arrInsert["tpeng_tipe"] = 1;
                $arrInsert["tpeng_status"] = 1;
                
                $status = $this->tbl_pengumuman->insertdata($arrInsert);
            }
            

            if ($status) {
                redirect($this->thisurl, "refresh");
            } else {
                return array(
                    "error" => "Data tidak masuk"
                );
            }
        }
    }
	
    public function delete($id) {

        if (is_numeric($id)) {
            $arrUpdate = array("tpeng_status" => 0);
            $arrWhere = array("tpeng_id" => $id);

            $status = $this->tbl_pengumuman->updatedata($arrUpdate, $arrWhere);

            if ($status) {
                redirect($this->thisurl, "refresh");
            } else {
                return array(
                    "error" => "Data tidak masuk"
                );
            }    
        } else {
            show_404();
        }

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
            "ctlContentArea" => $this->load->view("pengumuman/vw_berita", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("assets/js/controller/arsip_surat.js")
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }
}
    