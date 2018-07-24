<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jemaat extends CI_Controller {

    protected $activeMenu = "jemaat";
    protected $title = "Data Arsip Surat";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Arsip Surat",
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

        $this->load->model("tbl_jemaat");
        $this->load->model("tbl_gereja");
        
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage($this->userAllowed); 
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
                
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/jemaat");

    }

    public function index($search = "all", $start = 0) {

        $arrRet = $this->retrieve_data($search, $start);

        $arrData = $arrRet[0];
        $countTotal = $arrRet[1];
        $perpage = 20;

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

        $arrView = array(
            "ctlArrData" => $arrData,
            "ctlStsNikah" => $arrStsNikah,
            "ctlArrJk" => $arrJk,
            "ctlUrlAdd" => $this->thisurl . "/pilih_gereja/",
            "ctlUrlEdit" => $this->thisurl . "/form/",
            "ctlUrlProfile" => $this->thisurl . "/profile/",
            "ctlPagination" => $this->_pagination($this->thisurl."/index/all/", $countTotal, $perpage, 4),

        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_main",
                $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function retrieve_data($search, $start) {
        $perpage = 20;
        $arrWhere = array();
        $arrData = $this->tbl_jemaat->retrieve_data($arrWhere, $start, $perpage);
        $countTotal = $this->tbl_jemaat->count_data($arrWhere);

        return array($arrData, $countTotal);
    }

    protected function _pagination($url, $totalRows, $perpage, $uriSegment) {
        $this->load->library('pagination');

        $config['base_url'] = $url;
        $config['total_rows'] = $totalRows;
        $config['reuse_query_string'] = true;
        $config['per_page'] = $perpage;
        $config['uri_segment'] = $uriSegment;
        $config['reuse_query_string'] = true;
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


    public function retrieve_gereja() {
        $arrWhere = array();
        $arrGereja = $this->tbl_gereja->retrieve_data(
            $arrWhere, 0, 1600);

        return $arrGereja;
    }

    public function pilih_gereja() {
        
        $arrGereja = $this->retrieve_gereja();

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

        $arrWhere = array(
            "t1.tg_id" => $idGereja
        );
        $arrGereja = $this->tbl_gereja->retrieve_data($arrWhere);

        if (!$arrGereja) {
            show_404();
        }

        $arrWhere = array(
            "t2.tg_id" => $idGereja,
            "t1.tj_id" => $idJemaat
        );

        $arrData = $this->tbl_jemaat->retrieve_data($arrWhere, 0, 1);

        if ($arrData) {
            $arrData = $arrData[0];
        } elseif ($idJemaat != "") {
            show_404();
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

    public function profile($id = "") {

        $arrData = $this->tbl_jemaat->select_by_id($id);

        if ($arrData) {
            $arrData = $arrData[0];
        } else {
            show_404();
        }

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

        $arrLingkup = array(
            1 => "Jemaat",
            2 => "Wilayah",
            3 => "Daerah",
            4 => "Nasional"
        );

        $arrData["tj_jk"] = $arrJk[$arrData["tj_jk"]];
        $arrData["tj_status_nikah"] = $arrStsNikah[$arrData["tj_status_nikah"]];

        $alamat = "";
        if ($arrData["tj_al_desa"]) {
            $alamat .= $arrData["tj_al_desa"];
        }
        if ($arrData["tj_al_kec"]) {
            $alamat .= " - Kec. " . $arrData["tj_al_kec"];
        }
        if ($arrData["tj_al_kab_kodya"]) {
            if ($alamat) {
                $alamat .= ", " . $arrData["tj_al_kab_kodya"];    
            } else {
                $alamat = $arrData["tj_al_kab_kodya"];    
            }
            
        }
        if ($arrData["tj_al_propinsi"]) {
            if ($alamat) {
                $alamat .= " - " . $arrData["tj_al_propinsi"];
            } else {
                $alamat = $arrData["tj_al_propinsi"];
            }
        }

        $arrData["alamat"] = $alamat;
        $arrYesNo = array(
            0 => "Tidak / Belum",
            1 => "Ya / Sudah"
        );

        $arrData["tj_akt_peny_str"] = $arrYesNo[$arrData["tj_akt_peny_status"]];
        $arrData["tj_akt_bap_str"] = $arrYesNo[$arrData["tj_akt_bap_status"]];
        $arrData["tj_akt_peny_tgl"] = misc_helper::format_idDate($arrData["tj_akt_peny_tgl"]);
        $arrData["tj_akt_bap_tgl"] = misc_helper::format_idDate($arrData["tj_akt_bap_tgl"]);
        
        $arrData["arrOrgGereja"] = $this->tbl_jemaat->select_det_by_id(
            "table1a", array("tj_id" => $id, "tog_status" => 1), "tog_tahun_start ASC"
        );
        $arrData["urlOrgGereja"] = $this->thisurl . "/form_organisasi_gereja/" . $id;
        $arrData["urlOrgGerejaDel"] = $this->thisurl . "/delete/tog/" . $id;

        $arrData["arrPelayanan"] = $this->tbl_jemaat->select_det_by_id(
            "table1c", array("tj_id" => $id, "tp_status" => 1), "tp_tahun_mulai ASC"
        );        
        $arrData["urlPelayanan"] = $this->thisurl . "/form_pelayanan/" . $id;
        $arrData["urlPelayananDel"] = $this->thisurl . "/delete/tp/" . $id;

        $arrData["arrPendidikan"] = $this->tbl_jemaat->select_det_by_id(
            "table1d", array("tj_id" => $id, "tpen_status" => 1), "tpen_tahun_mulai ASC"
        );
        $arrData["urlPendidikan"] = $this->thisurl . "/form_pendidikan/" . $id;
        $arrData["urlPendidikanDel"] = $this->thisurl . "/delete/tpen/" . $id;

        $arrData["arrOrgLain"] = $this->tbl_jemaat->select_det_by_id(
            "table1b", array("tj_id" => $id, "tol_status" => 1), "tol_tahun_mulai ASC"
        );
        $arrData["urlOrgLain"] = $this->thisurl . "/form_organisasi_lain/" . $id;
        $arrData["urlOrgLainDel"] = $this->thisurl . "/delete/tol/" . $id;

        $arrData["arrAset"] = $this->tbl_jemaat->select_det_by_id(
            "table4", array(
                "rel_id" => $id,
                "rel_tipe" => 1,
                "ta_status" => 1
            ), "ta_nama ASC"
        );
        $arrData["urlAset"] = $this->thisurl . "/form_aset/" . $id;
        $arrData["urlAsetDel"] = $this->thisurl . "/delete_aset/" . $id;

        $arrForm = array(
            "ctlUrlImg" => base_url("/assets/img/user2-160x160.jpg"),
            "ctlArrLingkup" => $arrLingkup,
            "ctlArrData" => $arrData,
            "ctlUrlEdit" => $this->thisurl . "/form/". $arrData["tg_id"]."/".$arrData["tj_id"]
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_profile_jemaat",
                $arrForm, true),
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

    public function delete($type = "", $idJemaat, $idDet) {
        
        switch ($type) {
            case "tog":
                $idName = "tog_id";
                $tblName = "table1a";
                break;
            case "tol":
                $idName = "tol_id";
                $tblName = "table1b";
                break;
            case "tp":
                $idName = "tp_id";
                $tblName = "table1c";
                break;
            case "tpen":
                $idName = "tpen_id";
                $tblName = "table1d";
                break;
            default:
                return false;
        }
        
        $arrWhere = array(
            $idName => $idDet,
            "tj_id" => $idJemaat
        );
            
        $arrUpdate = array(
            $type."_status" => 0
        );

        $return = $this->tbl_jemaat->update_det_by_id($tblName, $arrUpdate, $arrWhere);

        redirect($this->thisurl . "/profile/" . $idJemaat, "refresh");

    }

    protected function _submit_detail($type = "") {
        $arrPost = $this->input->post();

        switch ($type) {
            case "tog":
                $idName = "tog_id";
                $tblName = "table1a";
                break;
            case "tol":
                $idName = "tol_id";
                $tblName = "table1b";
                break;
            case "tp":
                $idName = "tp_id";
                $tblName = "table1c";
                break;
            case "tpen":
                $idName = "tpen_id";
                $tblName = "table1d";
                break;
            default:
                return false;
        }
 
        if ($arrPost) {
            if (is_numeric($arrPost[$idName])) {
                // update
                $arrUpdate = $arrPost;
                $arrWhere = array(
                    $idName => $arrPost[$idName],
                    "tj_id" => $arrPost["tj_id"]
                );

                $return = $this->tbl_jemaat->update_det_by_id($tblName, $arrUpdate, $arrWhere);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["tj_id"], "refresh");
                } else {
                    return false;
                }
            } else {
                // insert
                $arrInsert = $arrPost;
                $return = $this->tbl_jemaat->insert_det_by_id($tblName, $arrInsert);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["tj_id"], "refresh");
                } else {
                    return false;
                }
            }
        }
    }


    public function form_organisasi_gereja($idJemaat = "", $togId = "") {
        if (!is_numeric($idJemaat)) {
            show_404();
        }

        $this->_submit_detail("tog");

        $arrData[0] = array(
            "tj_id" => $idJemaat
        );

        if (is_numeric($togId)) {
            $arrWhere = array(
                "tj_id" => $idJemaat,
                "tog_id" => $togId
            );

            $arrData = $this->tbl_jemaat->select_det_by_id("table1a", $arrWhere);
            if (!$arrData) {
                show_404();
            }
        }

        
        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form_organisasi_gereja/".$idJemaat."/".$togId,
            "ctlUrlBack" => $this->thisurl . "/profile/".$idJemaat."/".$togId,
            "ctlArrData" => $arrData
        );
        $content = $this->load->view(
            "jemaat/vw_form_org_gereja", $arrForm, true
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


    public function form_pelayanan($idJemaat = "", $idDet = "") {
        
        $this->_submit_detail("tp");

        $arrData[0] = array(
            "tj_id" => $idJemaat
        );

        if (is_numeric($idDet)) {
            $arrWhere = array(
                "tj_id" => $idJemaat,
                "tp_id" => $idDet
            );

            $arrData = $this->tbl_jemaat->select_det_by_id("table1c", $arrWhere);
            if (!$arrData) {
                show_404();
            }
        }

        
        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form_pelayanan/".$idJemaat."/".$idDet,
            "ctlUrlBack" => $this->thisurl . "/profile/".$idJemaat."/".$idDet,
            "ctlArrData" => $arrData
        );

        $content = $this->load->view(
            "jemaat/vw_form_pelayanan", $arrForm, true
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
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function form_pendidikan($idJemaat = "", $idDet = "") {
        
        $this->_submit_detail("tpen");

        $arrData[0] = array(
            "tj_id" => $idJemaat
        );

        if (is_numeric($idDet)) {
            $arrWhere = array(
                "tj_id" => $idJemaat,
                "tpen_id" => $idDet
            );

            $arrData = $this->tbl_jemaat->select_det_by_id("table1d", $arrWhere);
            if (!$arrData) {
                show_404();
            }
        }

        
        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form_pendidikan/".$idJemaat."/".$idDet,
            "ctlUrlBack" => $this->thisurl . "/profile/".$idJemaat."/".$idDet,
            "ctlArrData" => $arrData
        );

        $content = $this->load->view(
            "jemaat/vw_form_pendidikan", $arrForm, true
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
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function form_organisasi_lain($idJemaat = "", $idDet = "") {
        
        $this->_submit_detail("tol");

        $arrData[0] = array(
            "tj_id" => $idJemaat
        );

        if (is_numeric($idDet)) {
            $arrWhere = array(
                "tj_id" => $idJemaat,
                "tol_id" => $idDet
            );

            $arrData = $this->tbl_jemaat->select_det_by_id("table1b", $arrWhere);
            if (!$arrData) {
                show_404();
            }
        }
        
        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form_organisasi_lain/".$idJemaat."/".$idDet,
            "ctlUrlBack" => $this->thisurl . "/profile/".$idJemaat,
            "ctlArrData" => $arrData
        );

        $content = $this->load->view(
            "jemaat/vw_form_org_lain", $arrForm, true
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
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function form_aset($idJemaat = "", $idDet = "") {
        
        $this->_submit_aset();

        $arrData[0] = array(
            "rel_id" => $idJemaat
        );

        if (is_numeric($idDet)) {
            $arrWhere = array(
                "rel_id" => $idJemaat,
                "rel_tipe" => 1,
                "ta_id" => $idDet
            );

            $arrData = $this->tbl_jemaat->select_det_by_id("table4", $arrWhere);
            if (!$arrData) {
                show_404();
            }
        }
        
        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form_aset/".$idJemaat."/".$idDet,
            "ctlUrlBack" => $this->thisurl . "/profile/".$idJemaat,
            "ctlArrData" => $arrData
        );

        $content = $this->load->view(
            "jemaat/vw_form_aset", $arrForm, true
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
                    "rel_id" => $arrPost["rel_id"],
                );

                $return = $this->tbl_jemaat->update_det_by_id("table4", $arrUpdate, $arrWhere);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["rel_id"], "refresh");
                } else {
                    return false;
                }
            } else {
                // insert
                $arrInsert = $arrPost;
                $arrInsert["rel_tipe"] = 1;
                $return = $this->tbl_jemaat->insert_det_by_id("table4", $arrInsert);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["rel_id"], "refresh");
                } else {
                    return false;
                }
            }
        }
    }

    public function delete_aset($idJemaat, $idDet) {
        $arrWhere = array(
            "rel_tipe" => 1,
            "rel_id" => $idJemaat,
            "ta_id" => $idDet
        );
            
        $arrUpdate = array(
            "ta_status" => 0
        );

        $return = $this->tbl_jemaat->update_det_by_id("table4", $arrUpdate, $arrWhere);

        redirect($this->thisurl . "/profile/" . $idJemaat, "refresh");

    }
}