<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class gereja extends CI_Controller {

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

    protected $mwId;

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

        $this->thisurl = base_url("index.php/gereja");
        $this->mwId = $this->session->userdata["arrUser"]["usrt_id"];
    }
    
    public function index($search = "all", $start = 0) {
    	$perpage = 20;
    	$totalData = $this->_get_count_data();

    	$arrData = $this->_get_data($search, $start, $perpage);
    	
		$arrView = array(
            "ctlUrlForm"  => base_url("index.php/gereja/form/"),
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

    protected function _get_data($search, $start, $perpage) {
    	$arrData = $this->tbl_gereja->retrieve_data(
    		array(), $start, $perpage
    	);

    	return $arrData;
    }

    protected function _get_count_data() {
    	$count = $this->tbl_gereja->count_data(array());

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

		if ($id == "") {
			show_404();
		}

        $arrForm = array();

        $arrData = array(
            "ctlTitle" => "Data Gereja",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("gereja"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("gereja/vw_form_gereja", $arrForm, true),
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/controller/arsip_surat.js"),
                base_url("assets/js/jquery-ui.min.js"),
            ),
            "ctlArrCss" => array(
                base_url("assets/css/jquery-ui.structure.min.css"),
                base_url("assets/css/jquery-ui.theme.min.css"),
                base_url("assets/css/jquery-ui.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);

	}

    protected function _get_data_by_id($id) {
    	$arrWhere = array("t1.tg_id" => $id);
    	$arrData = $this->tbl_gereja->retrieve_data(
    		$arrWhere, 0, 1
    	);

    	return $arrData;
    }

    public function profile($id = "") {
        
        $arrData = $this->_get_data_by_id($id);

        if (!$arrData) {
        	show_404();
        }

        
        $arrProfile = array(
        	"ctlUrlEdit" => $this->thisurl . "/form/" . $id,
        	"ctlArrData" => $arrData[0]
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
}
    