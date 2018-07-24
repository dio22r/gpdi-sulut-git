<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gembala extends CI_Controller {

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

        $this->load->model("tbl_gembala");
        
        // load libraries

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();  
        $this->lib_login->previlage($this->userAllowed);      
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
        //$this->idWilayah = $this->arrSession["arrUser"]["usrt_id"];
        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/gembala");
        $this->mwId = 0;
    
    }

    public function index($search = "all", $start = 0) {
		
        $arrPost = $this->input->post();

        $arrLike = array();
        $plainSearch = "";
        
        if ($arrPost || $search != "all") {
        	if ($arrPost) {
                $plainSearch = $arrPost["table_search"];
        		$arrLike = array(
        			"tgem_nama" => $plainSearch
        		);
        		$search = $this->_base64_url_encode($plainSearch);
        	} else {
                $plainSearch = $this->_base64_url_decode($search);
        		$arrLike = array(
        			"tgem_nama" => $plainSearch
        		);
        	}
        }

        $perpage = 20;
        $arrData = $this->_retrieve_data($start, $perpage, $arrLike);
        $count = $this->_count_data($arrLike);
        
        $arrJk = array(
            "" => " - ",
            "L" => "Laki-laki",
            "P" => "Perempuan"
        );

        $arrStatusHub = array(
            "" => " - ",
            "M" => "Menikah",
            "S" => "Single",
            "J" => "Janda",
            "D" => "DUda"
        );

        $dataCnt = count($arrData);

        foreach($arrData as $key => $arrVal)  {
            $arrData[$key]["tgem_jk"] = $arrJk[$arrVal["tgem_jk"]];
            $arrData[$key]["tgem_status_nikah"] = 
                $arrStatusHub[$arrVal["tgem_status_nikah"]];
        }


        if ($this->mwId != 0) {
        	$addDisable = false;
        } else {
        	$addDisable = true;
        }

        $arrView = array(
            "ctlArrData" => $arrData,
            "ctlPlainSearch" => $plainSearch,
            "ctlStart" => $start,
            "ctlPerpage" => $dataCnt,
            "ctlCount" => $count,
            "ctlAddDisable" => $addDisable,
            "ctlEditUrl" => $this->thisurl . "/form/",
            "ctlProfileUrl" => $this->thisurl . "/profile/",
            "ctlPagination" => $this->_pagination(
                $this->thisurl."/index/".$search."/", $count, $perpage, 4
            )
        );

        $arrData = array(
            "ctlTitle" => "Data Gembala",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gembala"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view(
                "gembala/vw_main", $arrView, true
            ),
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

    protected function _retrieve_data($start, $limit, $arrLike = array()) {

        $arrWhere = array("t1.tgem_tipe" => 1);
        $arrData = $this->tbl_gembala->retrieve_data(
            $arrWhere, $start, $limit, $arrLike
        );

        return $arrData;
    }

    protected function _count_data($arrLike = array()) {

        $arrWhere = array(
            "t1.tgem_tipe" => 1
        );
        $total = $this->tbl_gembala->count_data($arrWhere, $arrLike);

        return $total;
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
        
        if ($this->mwId != 0 && !is_numeric($id)) {
        	show_404();
        }

        $arrData = array();
        if (is_numeric($id)) {
            $arrData = $this->_retrieve_by_id($id);
            $arrData["tgem_tpt_pelayanan"] = $arrData["tg_nama"];
        }

        $this->_submit();

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/form/" . $id,
            "ctlArrData" => $arrData,
            "ctlUrlBack" => $this->thisurl
        );

        $arrData = array(
            "ctlTitle" => "Data Gembala",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gembala"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("gembala/vw_form_gembala", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/bootstrap-datepicker.min.js"),
                base_url("assets/js/controller/gembala.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);

	}

    protected function _retrieve_by_id($id) {
        

        //$arrWhere = array("t1.tw_id" => $idWilayah);

        $arrWhere = array("tgem_tipe", 1);
        $arrData = $this->tbl_gembala->select_by_id($id);

        if ($arrData) {
            $arrData = $arrData[0];

            $idPas = $arrData["tgem_id_pas"];
            if (is_numeric($idPas)) {
                $arrDataPas = $this->tbl_gembala->select_pasangan($idPas);
                if ($arrDataPas) {
                    $arrDataPas = $arrDataPas[0];
                    $arrTemp = array();
                    foreach($arrDataPas as $key => $val) {
                        $arrTemp["pas_".$key] = $val;
                    }

                    $arrData = array_merge($arrData, $arrTemp);
                }
            }

        } else {
            show_404();
        }

        return $arrData;
    }


    protected function _submit() {
        $arrPost = $this->input->post();
        if ($arrPost) {

            $arrGem = misc_helper::get_form_arrData_todb($arrPost, "tgem_");
            $arrPasangan = misc_helper::get_form_arrData_todb(
                $arrPost, "pas_", "pas_"
            );

            $arrGem["tgem_status"] = 1;
            $arrPasangan["tgem_status"] = 1;

            if ($arrGem["tgem_id"] != "") {
                $arrGem["tgem_tipe"] = 1;
                $status = $this->tbl_gembala->updatedata(
                    $arrGem, $arrGem["tgem_id"]
                );

                $idGem = $arrGem["tgem_id"];
            } else {
                $status = $this->tbl_gembala->insertdata(
                    array($arrGem)
                );
                $idGem = $this->tbl_gembala->get_last_id();
            }

            if ($arrGem["tgem_status_nikah"] == "M") {
                $arrPasangan["tgem_tipe"] = 2;
                $arrPasangan["tgem_tpt_pelayanan"] =
                    $arrGem["tgem_tpt_pelayanan"];
                $arrPasangan["tgem_alamat_pelayanan"] =
                    $arrGem["tgem_alamat_pelayanan"];
                $arrPasangan["tgem_status_nikah"] =
                    $arrGem["tgem_status_nikah"];
                    
                if ($arrPasangan["tgem_id"] != "") {
                    $status = $this->tbl_gembala->updatedata(
                        $arrPasangan, $arrPasangan["tgem_id"]
                    );
                    $idPas = $arrPasangan["tgem_id"];
                } else {
                    if ($arrPasangan["tgem_nama"] != "") {
                        $status = $this->tbl_gembala->insertdata(
                            array($arrPasangan)
                        );
                        $idPas = $this->tbl_gembala->get_last_id();

                        $arrInsert = array(
                            "tgem_id_gem" => $idGem,
                            "tgem_id_pas" => $idPas
                        );
                        $this->tbl_gembala->insert_pasangan($arrInsert);
                    }
                }
            }
            
            if ($idGem > 0 && $status) {
                redirect($this->thisurl . "/profile/" . $idGem, "refresh");
            } else {
                return false;
            }
        }
 
    }


    public function profile($id = "") {
        $arrJk = array(
            "" => " - ",
            "L" => "Laki-laki",
            "P" => "Perempuan"
        );

        $arrStatusHub = array(
            "" => " - ",
            "M" => "Menikah",
            "S" => "Single",
            "J" => "Janda",
            "D" => "Duda"
        ); 

        $arrData = $this->_retrieve_by_id($id);

        $arrData["tgem_jk"] = $arrJk[$arrData["tgem_jk"]];
        $arrData["tgem_status_nikah"] =
            $arrStatusHub[$arrData["tgem_status_nikah"]];
        $arrData["tgem_tgl_lahir"] = 
            misc_helper::format_idDate($arrData["tgem_tgl_lahir"]);

        $arrData["lama_gembala"] = " - ";    
        if ($arrData["tgem_pgbl_pertama_thn"] != 0) {
            $arrData["lama_gembala"] = date("Y") - $arrData["tgem_pgbl_pertama_thn"];    
        }
        
        $arrData["urlPendidikan"] = $this->thisurl . "/form_pendidikan/" . $id;
        $arrData["arrPendidikan"] = array();

        $arrForm = array(
            "ctlArrData" => $arrData,
            "ctlUrlEdit" => $this->thisurl . "/form/" . $id,
            "ctlUrlBack" => $this->thisurl,
        );

        $arrData = array(
            "ctlTitle" => "Data Gembala",
            "ctlSubTitle" => "GPdI Sulawesi Utara",
            
            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gembala"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("gembala/vw_profile_gembala", $arrForm, true),
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
    