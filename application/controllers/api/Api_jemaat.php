<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api_jemaat extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper("misc_helper");

        $this->load->model("tbl_jemaat");
        $this->load->model("tbl_gereja");
        

        $arrConfig = array("session" => $this->session);

        $this->lib_login = new lib_login($arrConfig);

        //$arrUserAllowed = array("md", "mw", "grj");
        $this->lib_login->redir_ifnot_login();
        //$this->lib_login->previlage($this->userAllowed); 
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries
    }



    public function index() {

    }

    public function profile($id = 0) {
		$userType = $this->arrSession["arrUser"]["usertype"];

		//print_r($this->arrSession);

		$arrWhere = array();
    	switch($userType) {
    		case "grj":
    			$idGrj = $this->arrSession["arrUser"]["usrt_id"];
    			$arrWhere = array(
    				"t1.tj_id" => $id,
    				"t2.tg_id" => $idGrj
    			);
    			break;

			case "mw":
				$idMw = $this->session->userdata["arrUser"]["usrt_id"];
    			$arrWhere = array(
    				"t1.tj_id" => $id,
    				"t2.tw_id" => $idMw
    			);
				break;

			case "md":
				$arrWhere = array("t1.tj_id" => $id);
				break;

			default:
				show_404();
    	}


    	if (!$arrWhere) {
    		show_404();
    	}

    	$arrData = $this->tbl_jemaat->retrieve_data($arrWhere);

    	if ($arrData) {
    		$arrData = $arrData[0];
	        $arrJk = array(
	            "L" => "Laki-laki",
	            "P" => "Perempuan"
	        );

    		$arrData["tj_tgl_lahir"] = misc_helper::format_idDate($arrData["tj_tgl_lahir"]);
    		$arrData["tj_jk"] = $arrJk[$arrData["tj_jk"]];
    		$arrData["age"] = $arrData["age"] . " Tahun";
			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($arrData));

    	} else {
    		show_404();
    	}
    }

}