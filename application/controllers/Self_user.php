<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class self_user extends CI_Controller {

    protected $activeMenu = "dashboard";
    protected $title = "Data User";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Data Anda",
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
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/self_user");

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
    
    public function index() {
        show_404();
    }

    public function ganti_pwd() {
		
        $arrRet = $this->_submit();

        $thisurl = $this->thisurl;

        $arrTipe = $this->arrTipe;
        $arrStatus = $this->arrStatus;

        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl ."/ganti_pwd",
            "ctlArrRet" => $arrRet
        );

        $arrData = array(
            "ctlTitle" => "Data User",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("user"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("self_user/vw_ganti_pwd", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _submit() {
        $arrPost = $this->input->post();

        if ($arrPost) {
            $id = $this->arrSession["idUser"];
            $arrData = $this->tbl_user->select_by_id($id);

            if (!$arrData) {
                show_404();
            }

            $arrData = $arrData[0];

            // cek password lama sama ??
            $pwdLamaDB = $arrData["tu_password"];
            $pwdLamaForm = md5($arrPost["pwd_lama"]);

            if ($pwdLamaForm == $pwdLamaDB && $pwdLamaForm != "") {

                // cek password baru sama ??
                $pwdBaru = $arrPost["pwd_baru"];
                $pwdBaruUlang = $arrPost["pwd_baru_ulang"];
                if ($pwdBaru == $pwdBaruUlang && $pwdBaru != "") {
                    $arrUpdate = array(
                        "tu_password" => md5($pwdBaru)
                    );
                    $status = $this->tbl_user->updatedata($arrUpdate, $id);
                    if ($status) {
                        return array(
                            "status" => true,
                            "title" => "Berhasil",
                            "msg" => "Password sudah berubah"
                        );
                    } else {
                        return array(
                            "status" => false,
                            "title" => "Maaf !!!",
                            "msg" => "Terjadi Kesalahan Pada Sistem"
                        );
                    }
                } else {
                    return array(
                        "status" => false,
                        "title" => "Maaf !!!",
                        "msg" => "Password baru salah"
                    );
                }
            } else {
                return array(
                    "status" => false,
                    "title" => "Maaf !!!",
                    "msg" => "Password lama salah"
                );
            }
        } else {
            return array();
        }
    }

}
    