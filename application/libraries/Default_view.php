<?php
class default_view {
    protected $session;
    protected $loadClass;
    protected $baseUrl;
    protected $libLoginClass;
    protected $arrUserData;

    public function __construct(
		$loadClass = null, $libLoginClass = null, $arrConfig = array()
	) {
    	$this->loadClass = $loadClass;
    	$this->libLoginClass = $libLoginClass;


        foreach ($arrConfig as $key => $value) {
            $this->$key = $value;
        }

        $this->baseUrl = base_url("index.php");

    }
    
    public function set_libLogin($libLoginClass = null){
    	$this->libLoginClass = $libLoginClass;

		$arrSession = $this->libLoginClass->get_session_data();

		$arrUserData = $arrSession["arrUser"];

		$this->arrUserData = array(
			"displayname" => $arrUserData["usr_surename"],
			"menu" => $arrUserData["usertype"],
		);

    }

    public function retrieve_menu($activeMenu = "") {
    	$baseUrl = $this->baseUrl;
		$arrUserData = $this->arrUserData;

    	$usertype = $this->arrUserData["menu"];
		$arrMenu = $this->arrMenu($usertype);

		foreach($arrMenu as $key => $arrVal) {
			if ($key == $activeMenu) {
				$arrMenu[$key]["class"] .= " active";
			}

			if (isset($arrVal["sub"])) {
				foreach($arrVal["sub"] as $key2 => $arrVal2) {
					if ($key2 == $activeMenu) {
						$arrMenu[$key]["sub"][$key2]["class"] .= " active";
						$arrMenu[$key]["class"] .= " active";
					}
				}
			}
		}

    	$arrData = array(
    		"ctlArrMenu" => $arrMenu,
    		"ctlUsername" => $arrUserData["displayname"]
		);

    	$html = $this->loadClass->view("master_view/master_menu", $arrData, true);
  	    
    	return $html;
    }

    public function arrMenu($usertype = "") {
    	$baseUrl = base_url("index.php");
    	$arrMenu = array(
    		"md" => array(
				"dashboard" => array(
					"icon" => "fa-dashboard",
				  	"href" => $baseUrl . "/dashboard",
				  	"title" => "Beranda",
				  	"class" => ""
				),
				"struktur_md" => array(
					"icon" => "fa-cubes",
				  	"href" => $baseUrl . "/struktur_md",
				  	"title" => "Struktur MD",
				  	"class" => ""
				),
				"pengumuman" => array(
					"icon" => "fa-envelope",
				  	"href" => $baseUrl . "/pengumuman",
				  	"title" => "Pengumuman",
				  	"class" => ""
				),
				"wilayah" => array(
					"icon" => "fa-bank",
					"href" => $baseUrl . "/wilayah",
				  	"title" => "Wilayah",
				  	"class" => ""
		        ),
				"gereja" => array(
					"icon" => "fa-home",
					"href" => $baseUrl . "/gereja",
				  	"title" => "Gereja",
				  	"class" => ""
		        ),
				"gembala" => array(
					"icon" => "fa-graduation-cap",
					"href" => $baseUrl . "/gembala",
				  	"title" => "Gembala",
				  	"class" => ""
		        ),
				"jemaat" => array(
					"icon" => "fa-street-view",
					"href" => $baseUrl . "/jemaat",
				  	"title" => "Jemaat",
				  	"class" => ""
		        ),
				"statistik" => array(
					"icon" => "fa-pie-chart",
					"href" => $baseUrl . "/statistik",
				  	"title" => "Statistik",
				  	"class" => ""
		        ),
				"devider" => array(
					"icon" => "",
					"href" => "#",
				  	"title" => "Konfigurasi",
				  	"class" => "header",
		        ),
				"user" => array(
					"icon" => "fa-user text-aqua",
					"href" => $baseUrl . "/user",
				  	"title" => "User",
				  	"class" => "",
				  	"style" => ""
		        )
			),
			"mw" => array(
				"dashboard" => array(
					"icon" => "fa-dashboard",
				  	"href" => $baseUrl . "/dashboard",
				  	"title" => "Beranda",
				  	"class" => ""
				),
				"struktur_md" => array(
					"icon" => "fa-cubes",
				  	"href" => $baseUrl . "/struktur_md",
				  	"title" => "Struktur MD",
				  	"class" => ""
				),
				"pengumuman" => array(
					"icon" => "fa-envelope",
				  	"href" => $baseUrl . "/mw_pengumuman",
				  	"title" => "Pengumuman",
				  	"class" => ""
				),
				"gereja" => array(
					"icon" => "fa-home",
					"href" => $baseUrl . "/mw_gereja",
				  	"title" => "Gereja",
				  	"class" => ""
		        ),
				"gembala" => array(
					"icon" => "fa-graduation-cap",
					"href" => $baseUrl . "/mw_gembala",
				  	"title" => "Gembala",
				  	"class" => ""
		        ),
				"jemaat" => array(
					"icon" => "fa-street-view",
					"href" => $baseUrl . "/mw_jemaat",
				  	"title" => "Jemaat",
				  	"class" => ""
		        ),
				"statistik" => array(
					"icon" => "fa-pie-chart",
					"href" => $baseUrl . "/statistik",
				  	"title" => "Statistik",
				  	"class" => ""
		        )
			)
		);
    	
    	if (!isset($arrMenu[$usertype])) {
    		redirect(base_url("index.php/login/logout"), "refresh");
    	} else {
    		return $arrMenu[$usertype];
    	}
		
    }

    public function retrieve_header() {
    	$baseUrl = $this->baseUrl;
    	$arrUserData = $this->arrUserData;

    	//print_r($arrUserData);

    	$arrData = array(
    		"ctlUrlLogout" => $baseUrl."/login/logout",
    		"ctlUsername" => $arrUserData["displayname"]
		);
    	$html = $this->loadClass->view("master_view/master_headerbar", $arrData, true);
    	return $html;
    }

    public function retrieve_sidebar_r() {

    	$html = $this->loadClass->view("master_view/master_sidebar_r", array(), true);
    	return $html;
    }

    public function retreieve_headtag($arrCss = array()) {
    	
    }

    public function retreieve_scripttag($arrJs = array()) {
    	
    }
}