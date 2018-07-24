<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wilayah extends CI_Controller {

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

    public $userAllowed = "md";

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

        $this->thisurl = base_url("index.php/wilayah");

        $this->thisurlGereja = base_url("index.php/gereja");
    }
    
    public function index($search = "all", $start = 0) {
        $arrPost = $this->input->post();

        $arrLike = array();
        $plainSearch = "";
        

        if ($arrPost || $search != "all") {
            if ($arrPost) {
                $plainSearch = $arrPost["table_search"];
                $search = $this->_base64_url_encode($plainSearch);
            } else {
                $plainSearch = $this->_base64_url_decode($search);
            }

            $arrLike = array(
                "tw_nama" => $plainSearch //str_replace(" ", "%%", $plainSearch)
            );

            if (trim($plainSearch) == "") {
                $search = "all";
            }
        }

		$thisurl = $this->thisurl."/index/".$search;

        $limit = 20;
        $countData = $this->tbl_wilayah->count_data($arrLike);
        $arrData = $this->tbl_wilayah->select_data(
            $arrLike, $start, $limit
        );

        foreach($arrData as $key => $arrVal) {
            $arrData[$key]["editUrl"] =
                $this->thisurl . "/form/" . $arrVal["tw_id"];
            $arrData[$key]["profileUrl"] =
                $this->thisurl . "/profile/" . $arrVal["tw_id"];
        }

        $pagination = $this->_pagination($thisurl, $countData, $limit, 4);

        $arrView = array(
            "ctlArrData" => $arrData,
            "ctlPaging" => $pagination,
            "ctlStart" => $start + 1,
            "ctlUrlSubmit" => $thisurl,
            "ctlSearch" => $plainSearch
        );

        $arrData = array(
            "ctlTitle" => $this->arrViewContentHeader["ctlTitle"],
            "ctlSubTitle" => $this->arrViewContentHeader["ctlSubtitle"],

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("wilayah/vw_main", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }	

    protected function _base64_url_encode($input) {
        return strtr(base64_encode($input), '+/=', '._-');
    }

    protected function _base64_url_decode($input) {
        $str = base64_decode(strtr($input, '._-', '+/='));
        $str = utf8_encode($str);
        return $str;
    }

	public function form($id = "") {

        //redirect(base_url("index.php/wilayah"), "refresh");

        $arrData = $this->tbl_wilayah->select_by_id($id);

        if ($arrData) {
            $arrData = $arrData[0];
        }

        $arrKab = $this->tbl_kabupaten->retrieve_data();
 
        $arrForm = array(
            "ctlArrData" => $arrData,
            "ctlUrlSubmit" => $this->thisurl . "/form_submit",
            "ctlUrlCancel" => $this->thisurl,
            "ctlArrKab" => misc_helper::db_to_dropdown(
                "tkab_id", "tkab_nama", $arrKab
            )
        );

        $arrData = array(
            "ctlTitle" => "Data Wilayah",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("wilayah/vw_form_wilayah", $arrForm, true),
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

    public function profile($id = "") {
        $this->load->model("tbl_aset");

        $arrData = $this->tbl_wilayah->select_by_id($id);

        if (!$arrData) {
            show_404();
        }

        $arrGereja = $this->tbl_gereja->retrieve_data(
            array("t1.tw_id" => $id)
        );

        $count = count($arrGereja);
        $arrWhere = array(
            "rel_id" => $id,
            "rel_tipe" => 3,
            "ta_status" => 1
        );

        $arrAset = $this->tbl_aset->select_det_by_id($arrWhere);

        if ($this->userAllowed == "md") {
            $editStat = true;
        } else {
            $editStat = false;
        }

        $arrForm = array(
            "ctlArrData" => $arrData[0],
            "ctlArrAset" => $arrAset,
            "ctlUrlBase" => $this->thisurl,
            "ctlUrlEdit" => $this->thisurl . "/form/" . $id,
            "ctlArrGereja" => $arrGereja,
            "ctlUrlBaseTbl" => $this->thisurlGereja,
            "ctlCountGereja" => $count,
            "ctlEditStat" => $editStat
        );

        $arrData = array(
            "ctlTitle" => "Data Wilayah",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("wilayah/vw_profile_wilayah",
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
        $arrPost = $this->input->post();
        
        //redirect(base_url("index.php/wilayah"), "refresh");
        if (!$arrPost) {
            show_404();
        }

        if ($arrPost["tw_id"]) { // Update
            $id = $arrPost["tw_id"];
            $result = $this->tbl_wilayah->updatedata(
                $arrPost, $arrPost["tw_id"]
            );
        } else { // Insert
            $result = $this->tbl_wilayah->insertdata(array($arrPost));
            $id = $this->tbl_wilayah->get_last_id();
        }

        $arrData = array();
        $keterangan = "terjadi kegagalan pada sistem";
        if ($result) {
            $arrData = $this->tbl_wilayah->select_by_id($id);
            $arrData = $arrData[0];
        }

        $arrSubmit = array(
            "keterangan" => $keterangan,
            "ctlStatus" => $result,
            "ctlArrData" => $arrData,
            "ctlEditUrl" => $this->thisurl . "/form/" . $id,
            "ctlUrlOke" => $this->thisurl
        );

        $arrData = array(
            "ctlTitle" => "Data Wilayah",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("wilayah/vw_submit_wilayah", $arrSubmit, true),
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

    public function retrieve_csv() {
        $this->load->helper('file');

        redirect(base_url("index.php/wilayah"), "refresh");
        $file = APPPATH."../assets/data/Book1.csv";
        $string = read_file($file);

        $arrLine = explode("\n", $string);

        //print_r($arrLine);

        $arrWilayah = array();
        foreach($arrLine as $key => $val) {
            $arrVal = explode(",", $val);

            if (trim($arrVal[0]) != "") {
                $arrSek = explode(",", $arrLine[$key + 1]);
                $arrKet = explode(",", $arrLine[$key + 2]);

                $struktur = "Ketua : " . $arrVal[3] .
                    "\nSekretaris : " . $arrSek[3] .
                    "\nBendahara : " . $arrKet[3];

                $arrWilayah[] = array(
                    "tw_nomor_induk" => trim($arrVal[0], " ."),
                    "tw_nama" => $arrVal[1],
                    "tw_status" => 1,
                    "tw_struktur_organisasi" => $struktur
                );
            }
        }

        print_r($arrWilayah);

        //$this->tbl_wilayah->insertdata($arrWilayah);
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
            "ctlUrlBack" => $this->thisurl . "/profile/".$idWilayah,
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
    