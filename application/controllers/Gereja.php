<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class gereja extends CI_Controller {

    protected $activeMenu = "gereja";
    protected $title = "Data Arsip Surat";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Arsip Surat",
        "ctlSubtitle" => "Form Pengisian"
    );
    protected $arrCss = array();
    protected $arrJs = array();
    
    protected $thisurl;
    protected $lib_defaultView;

    protected $mwId;
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

        $this->load->model("tbl_gereja");
        $this->load->model("tbl_wilayah");
        
        // load libraries

        $arrConfig = array("session" => $this->session);

        

        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();   
        $this->lib_login->previlage($this->userAllowed);     
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/".__CLASS__);

        $this->mwId = $this->session->userdata["arrUser"]["usrt_id"];
        $this->usertype = $this->session->userdata["arrUser"]["usertype"];

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
                "tg_nama" => $plainSearch //str_replace(" ", "%%", $plainSearch)
            );
        }

        $perpage = 20;
    	$totalData = $this->_get_count_data($arrLike);
    	$arrData = $this->_get_data($arrLike, $start, $perpage);

        foreach($arrData as $key => $arrVal) {
            $arrData[$key]["tg_tgl_berdiri"] = misc_helper::format_idDate(
                $arrVal["tg_tgl_berdiri"]
            );
        }
    	
		$arrView = array(
            "ctlUrlForm"  => $this->thisurl."/form/",
            "ctlUrlSearch"  => $this->thisurl,
            "ctlUserType" => $this->usertype,
            "ctlPlainSearch" => $plainSearch,
            "ctlArrData" => $arrData,
            "ctlPaging" => $this->_pagination(
        		$this->thisurl."/index/".$search, $totalData, $perpage, 4
        	)
        );        

        $content = $this->load->view("gereja/vw_main", $arrView, true);
        $arrData = array(
            "ctlTitle" => "Data Gereja",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gereja"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $content,
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
        return base64_decode(strtr($input, '._-', '+/='));
    }

    protected function _get_data($arrLike = array(), $start, $perpage) {
    	$arrData = $this->tbl_gereja->retrieve_data(
    		array(), $start, $perpage, "", $arrLike
    	);

    	return $arrData;
    }

    protected function _get_count_data($arrLike) {
    	$count = $this->tbl_gereja->count_data(array(), $arrLike);

    	return $count;
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
        $userType = $this->usertype;

        if ($userType == "mw" || $userType == "gembala") {
            if ($id == "") {
                show_404();
            }
        }

        $this->_submit();

        $arrData = array();
		if ($id != "" && is_numeric($id)) {
			$arrData = $this->_get_data_by_id($id);
			if (!$arrData) {
				show_404();
			} else {
				$arrData = $arrData[0];
                if ($arrData["tg_tgl_berdiri"] == "0000-00-00") {
                    $arrData["tg_tgl_berdiri"] = date("Y-m-d");
                }
			}
		}



        $arrWilayah = $this->tbl_wilayah->retrieve_wilayah();
        $arrWilayah = misc_helper::db_to_dropdown(
            "tw_id", "tw_nama", $arrWilayah
        );

        $arrForm = array(
        	"ctlArrData" => $arrData,
        	"ctlUrlSubmit" => $this->thisurl . "/form/" . $id,
        	"ctlArrMw" => $arrWilayah,
            "ctlUserType" => $this->usertype
        );

        $arrData = array(
            "ctlTitle" => "Data Gereja",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gereja"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("gereja/vw_form_gereja", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/bootstrap-datepicker.min.js"),
                base_url("assets/js/controller/gereja.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/bootstrap-datepicker3.min.css")
            )
        );
        $this->load->view('master_view/master_index', $arrData);

	}

	protected function _submit() {
        $arrPost = $this->input->post();

        if ($arrPost) {
            if ($arrPost["tg_id"] == "") {
                $status = $this->tbl_gereja->insertdata(array($arrPost));
                $id = $this->get_lasti_id();
            } else {
                $status = $this->tbl_gereja->updatedata($arrPost, $arrPost["tg_id"]);
                $id = $arrPost["tg_id"];
            }

            if ($status) {
                redirect($this->thisurl."/profile/". $id, "refresh");
            } else {
                return array(
                    "status" => $status,
                    "arrPost" => $arrPost
                );    
            }
            
        }

	}

    protected function _get_data_by_id($id) {
    	$arrWhere = array("t1.tg_id" => $id);
    	$arrData = $this->tbl_gereja->retrieve_data(
    		$arrWhere, 0, 1
    	);

    	return $arrData;
    }

    public function profile($id = "") {
        $this->load->model("tbl_aset");

        $arrData = $this->_get_data_by_id($id);

        if (!$arrData) {
        	show_404();
        }

        $arrWhere = array(
            "rel_id" => $id,
            "rel_tipe" => 2,
            "ta_status" => 1
        );

        $arrAset = $this->tbl_aset->select_det_by_id($arrWhere);

        $arrProfile = array(
        	"ctlUrlEdit" => $this->thisurl . "/form/" . $id,
        	"ctlArrData" => $arrData[0],
            "ctlArrAset" => $arrAset,
            "ctlUrlBase" => $this->thisurl
        );

        $arrData = array(
            "ctlTitle" => "Data Gereja",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gereja"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("gereja/vw_profile_gereja", $arrProfile, true),
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


    public function form_aset($idGereja = "", $idDet = "") {
        
        $this->load->model("tbl_aset");

        $this->_submit_aset();

        $arrData[0] = array(
            "rel_id" => $idGereja
        );

        if (is_numeric($idDet)) {
            $arrWhere = array(
                "rel_id" => $idGereja,
                "rel_tipe" => 2,
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
            "ctlUrlSubmit" => $this->thisurl . "/form_aset/".$idGereja."/".$idDet,
            "ctlUrlBack" => $this->thisurl . "/profile/".$idGereja,
            "ctlArrData" => $arrData
        );

        $content = $this->load->view(
            "gereja/vw_form_aset", $arrForm, true
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

    protected function _submit_aset() {
        

        $arrPost = $this->input->post();

        if ($arrPost) {
            if (is_numeric($arrPost["ta_id"])) {
                // update
                $arrUpdate = $arrPost;
                $arrWhere = array(
                    "ta_id" => $arrPost["ta_id"],
                    "rel_tipe" => 2,
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
                $arrInsert["rel_tipe"] = 2;
                $return = $this->tbl_aset->insert_det_by_id($arrInsert);

                if ($return) {
                    redirect($this->thisurl . "/profile/" . $arrPost["rel_id"], "refresh");
                } else {
                    return false;
                }
            }
        }
    }

    public function delete_aset($idGereja, $idDet) {
        $this->load->model("tbl_aset");

        $arrWhere = array(
            "rel_tipe" => 2,
            "rel_id" => $idGereja,
            "ta_id" => $idDet
        );
            
        $arrUpdate = array(
            "ta_status" => 0
        );

        $return = $this->tbl_aset->update_det_by_id($arrUpdate, $arrWhere);

        redirect($this->thisurl . "/profile/" . $idGereja, "refresh");

    }
}
    