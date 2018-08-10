<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
    	parent::__construct();

		$this->load->helper("misc");
		
    	$this->load->model("tbl_user");

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);
	}

	public function index() {
		$return = $this->_submit();

		if ($return["status"]) {
			redirect($return["url"], "refresh");
		} else {
			$arrLogin = array(
				"ctlArrReturn" => $return
			);
			$this->load->view("vw_login", $arrLogin);
		}
	}

	protected function _submit() {
		$arrPost = $this->input->post();

		if (!$arrPost || !is_array($arrPost)) {
            $arrPost = $this->input->post();
        }
        
        if (!$arrPost) {
            $arrReturn = array(
    		    "status" => false,
    		    "url" => base_url()
		    );
            
		    return $arrReturn;
        }
        
        if (!$this->lib_login->check_login()) {
            
            $arrWhere = array(
                "tu_username" => $arrPost["form-username"],
                "tu_status" => 1
            );
            $arrData = $this->tbl_user->retrieve_data($arrWhere);
            $countTry = $this->lib_login->count_try();
            
            $arrReturn = false;
            if ($arrData
            	&& md5($arrPost["form-password"]) ==
                    $arrData[0]["tu_password"]
        	) {

                $arrUserTipe = array(
                    1 => "md",
                    3 => "mw",
                    5 => "grj"
                );

                $userData = array(
                	"usr_id" => $arrData[0]["tu_id"],
            		"usr_username" => $arrData[0]["tu_username"],
            		"usr_surename" => $arrData[0]["tu_display_name"],
            		"usertype" => $arrUserTipe[$arrData[0]["tu_tipe_user"]],
                    "usertype_disp" => $this->_retrieve_tipe_user(
                        $arrData[0]["tu_tipe_user"], $arrData[0]["tu_tipe_id"]
                    ),
            		"usrt_id" => $arrData[0]["tu_tipe_id"]
            	);
                
                $this->lib_login->set_session_data($userData);
                $url = $this->lib_login->check_redir();
                
        		$arrReturn = array(
        		    "status" => true,
        		    "url" => $url
    		    );   
            } else {
            	$arrReturn = array(
        		    "status" => false,
        		    "msg" => "Username atau Password Salah",
        		    "url" => ""
    		    );
            }
            
        } else {
            $arrReturn = array(
    		    "status" => true,
    		    "url" => base_url()
		    );
        }
        

        return $arrReturn;
        /*
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($arrReturn));
        
        return $arrReturn;
        */
	}

    protected function _retrieve_tipe_user($idTipe, $linkedId) {
        $displayType = "Majelis Daerah";

        switch ($idTipe) {
            case 1:
                $displayType = "Majelis Daerah";
                break;
            
            case 3:
                $this->load->model("tbl_wilayah");
                $arrData = $this->tbl_wilayah->select_by_id($linkedId);
                $noInduk = $arrData[0]["tw_nomor_induk"];
                $nama = $arrData[0]["tw_nama"];
                $displayType = "MW ". $noInduk . " " . $nama;
                break;

            case 5:
                $this->load->model("tbl_gereja");
                $arrWhere = array("tg_id" => $linkedId);
                $arrData = $this->tbl_gereja->retrieve_nama_gereja($arrWhere);
                $displayType = $arrData[0]["tg_nama"];
                break;

            default:
                $displayType = "";
                break;
        }

        return $displayType;
    }

	public function logout() {
	    $this->session->sess_destroy();
	    delete_cookie("last_url");
		redirect(base_url("index.php/login"), "refresh");
	}
}