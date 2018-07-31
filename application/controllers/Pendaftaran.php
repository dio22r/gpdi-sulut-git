<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pendaftaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load helper
        $this->load->helper("misc");
        $this->load->helper("path");
        $this->load->helper("file");
        $this->load->helper("form");
        
        // load libraries
        $this->thisurl = base_url("index.php/".__CLASS__);
    }

	public function index() {
		$this->load->model("tbl_gereja");

		$arrPost = $this->input->post();

		$ctlArrData = $arrErr = array();
		if ($arrPost) {
			$ctlArrData = $arrPost;
			$arrRet = $this->_submit($arrPost);

			$arrErr = $arrRet["arrErr"];
		}
		

		$arrGereja = $this->tbl_gereja->retrieve_nama_gereja();

		$arrSelect = array(
			0 => "--- Pilih Gereja ---"
		);
		foreach($arrGereja as $key => $arrVal) {
			$arrSelect[$arrVal["tg_id"]] = $arrVal["tg_nama"];
		}

		asort($arrSelect);
		$arrData = array(
			"ctlArrGereja" => $arrSelect,
			"ctlUrlAction" => base_url("index.php/pendaftaran/"),
			"ctlLogo" => base_url("assets/img/logo-gpdi.png"),
			"ctlArrData" => $ctlArrData,
			"ctlArrErr" => $arrErr,
            "ctlArrJs" => array(
            	base_url("/assets/js/jquery.js"),
                base_url("/assets/js/select2.full.min.js")
            ),
            "ctlArrCss" => array(
                base_url("/assets/css/select2.min.css"),
            )
		);
        $this->load->view('user/vw_pendaftaran', $arrData);
	}

	protected function _submit($arrPost = array()) {
		
		$this->load->model("tbl_user");

		$arrErr = $this->_form_validation($arrPost);
		$arrData = array();
		if (!$arrErr) {
			$status = true;

			$arrData = $arrPost;
			$arrData["tu_password"] = md5($arrPost["tu_password"]);
			$arrData["tu_tipe_user"] = 5;
			$arrData["tu_status"] = 2;
			
			unset($arrData["re_password"]);

			$status = $this->tbl_user->insertdata(array($arrData));
			if ($status) {
				$id = $this->tbl_user->last_insert_id();
		        redirect($this->thisurl . "/success/" . $id, "refresh");
			}
		} else {
			$status = false;
		}

		return array(
			"status" => $status,
			"arrErr" => $arrErr,
			"arrData" => $arrData
		);
	}

	protected function _form_validation($arrPost = array()) {

		// gereja tidak 0
		$arrErr = array();
		if ($arrPost["tu_tipe_id"] == 0) {
			$arrErr["tu_tipe_id"] = "Gereja belum dipilih";
		}

		// cek nama lengkap, tidak kosong
		if (trim($arrPost["tu_display_name"]) == ""
			|| strlen(trim($arrPost["tu_display_name"])) < 5) {
			$arrErr["tu_display_name"] = "Nama Lengkap Harus lebih dari 5 karakter";
		}

		// cek username sudah ada, regex, tidak kosong
		$username = $arrPost["tu_username"];
		if (preg_match('/^[a-z0-9_-]{5,16}$/', $username, $match) == 0) {
			$arrErr["tu_username"] = "Username harus lebih dari 5 karakter dan tidak boleh ada spasi";
		} else {
			$arrData = $this->tbl_user->select_by_username($username);
			if ($arrData) {
				$arrErr["tu_username"] = "Username sudah ada";
			}
		}

		// cek password = re-password

		$password = $arrPost["tu_password"];
		if (preg_match('/^[a-z0-9_-]{5,16}$/', $password, $match) == 0) {
			$arrErr["tu_password"] = "Password harus lebih dari 5 karakter dan tidak boleh ada spasi";
		}

		if ($password != $arrPost["re_password"]) {
			$arrErr["re_password"] = "Password dan Ulangi Password tidak sama";
		}

		return $arrErr;
	}

	public function success($id) {
		$this->load->model("tbl_user");
		$arrData = $this->tbl_user->select_by_id($id);

		print_r($arrData);
	}
}
