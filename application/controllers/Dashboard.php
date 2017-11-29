<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

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

    public function __construct() {
        parent::__construct();
        // load helper
        $this->load->helper("misc");
        $this->load->helper("path");
        $this->load->helper("file");
        $this->load->helper("form");
        
        $this->load->library("image_lib");
        $this->load->library("default_view");

        //$this->load->model("tbl_arsip_surat");
        
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

        $this->thisurl = base_url("index.php/dashboard");
    }
    
    public function index($search = "all", $start = 0) {
		
        //print_r($this->arrSession);
        
        $arrData = array(
            "ctlTitle" => "Dashboard",
            "ctlSubTitle" => "Halaman Utama Database GPdI SULUT",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("dashboard"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("dashboard/vw_main", array(), true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("assets/js/controller/arsip_surat.js")
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }
	
    public function view_table() {

        $arrConfig = array(
            "tablehead" => array(
                array(
                    "content" => "Thumbnail",
                    "data-fieldname" => "as_dari",
                    "data-sort" => true,
                    "class" => "",
                    "width" => "20%"
                ),
                array(
                    "content" => "Data Arsip Surat",
                    "data-fieldname" => "",
                    "data-sort" => true,
                    "class" => "",
                    "width" => "70%"
                ),
                array(
                    "content" => "Action",
                    "data-fieldname" => "fk_status",
                    "data-sort" => true,
                    "class" => "",
                    "width" => "10%"
                )
            ),
            "searchfield" => array(
                "fk_nama" => "Name",
                "fk_keterangan" => "Keterangan"
            ),
            "defaultfield" => "as_dari",
            "tableurl" => base_url("index.php/ajax/ajx_arsip_surat/retrieve_data"),
            "selParent" => "#table-data"
        );
    }

	public function form($id = "") {
        
        
        $data = array();

        if ($id) {
            $data = $this->tbl_arsip_surat->retrieve_by_id($id);
            if ($data) {
                $status = "edit";
                $data = $data[0];
                $data["as_file"] = json_decode($data["as_file"]);
                $data["as_diteruskan"] = json_decode($data["as_diteruskan"]);
                $data["as_ket"] = json_decode($data["as_ket"]);

                 $cancelUrl = $this->thisurl . "/view_data/".$id;
            } else {
                show_404();
            }
        } else {
            $status = "new";
            $cancelUrl = $this->thisurl;
        }


        $arrForm = array(
            "ctlId" => $id,
            "ctlArrData" => $data,
            "ctlThisUrl" => $this->thisurl,
            "ctlCancelUrl" => $cancelUrl,
            "ctlSubmitUrl" => $this->thisurl . "/submit",
            "ctlUrlTable" => $this->thisurl,
        );

        $arrData = array(
            "ctlTitle" => "Arsip Surat",
            "ctlSubTitle" => "Sekretariat BPKAD",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu("surat_masuk"),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("arsip/vw_form_arsip", $arrForm, true),
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

    public function view_data($id = "") {

        $data = $this->tbl_arsip_surat->retrieve_by_id($id);

        if (!$data) {
            show_404();
        } else {

            $data = $data[0];

            if ($data["as_file"]) {
                $data["as_file"] = json_decode($data["as_file"]);
            } else {
                $data["as_file"] = array();
            }

            $data["as_url_print"] = $this->thisurl . "/print_data/" . $data["as_id"];
            $data["as_tgl_surat"] = misc_helper::format_idDate($data["as_tgl_surat"]);
            $data["as_tgl_diterima"] = misc_helper::format_idDate($data["as_tgl_diterima"]);
            $data["as_diteruskan"] = json_decode($data["as_diteruskan"]);
            $data["as_ket"] = json_decode($data["as_ket"]);

            $arrData = array(
                "ctlArrData" => $data,
                "ctlUrlEdit" => $this->thisurl . "/form/".$data["as_id"],
                "ctlUrlTable" => $this->thisurl
            );

            $arrData = array(
                "ctlTitle" => "Arsip Surat",
                "ctlSubTitle" => "Sekretariat BPKAD",

                "ctlSideBar" => $this->lib_defaultView->retrieve_menu("surat_masuk"),
                "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
                "ctlContentArea" => $this->load->view("arsip/vw_data_detail", $arrData, true),
                "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),
                "ctlArrJs" => array(),
                "ctlArrCss" => array()
            );
            $this->load->view('master_view/master_index', $arrData);
        }
    }
    
    private function _set_data($arrPost) {
        $status = false;
        $arrPost["as_status"] = 1;

        if (in_array("Lain-lain ...", $arrPost["as_diteruskan"])) {
            $arrPost["as_diteruskan"][] = $arrPost["as_diteruskan_lain"];
        }
        $arrPost["as_diteruskan"] = json_encode($arrPost["as_diteruskan"]);

        if (in_array("Lain-lain ...", $arrPost["as_ket"])) {
            $arrPost["as_ket"][] = $arrPost["as_ket_lain"];
        }
        $arrPost["as_ket"] = json_encode($arrPost["as_ket"]);

        unset($arrPost["as_diteruskan_lain"]);
        unset($arrPost["as_ket_lain"]);

        if (!isset($arrPost["as_id"]) || trim($arrPost["as_id"]) == "") {
            $status = $this->tbl_arsip_surat->insertdata($arrPost);
        } else {
            $status = $this->tbl_arsip_surat->updatedata($arrPost, $arrPost["as_id"]);
        }

        return $status;
    }
    
    private function _upload_file() {
    
        $filepath = APPPATH."../assets/img/sa-scan-file";
        
        $config['upload_path'] = $filepath;
		$config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = date("YmdHisu");
		$config['max_size']	= '5000';
        
        // this library must be init just in here..
		$this->load->library('upload', $config);

        print_r($_FILES);

        $data = array();
        $status = false;
        $arrFileUpload = $_FILES["surat"];
        foreach($arrFileUpload["name"] as $key => $val) {
            $_FILES["surat"] = array(
                "name" => $val,
                "type" => $arrFileUpload["type"][$key],
                "tmp_name" => $arrFileUpload["tmp_name"][$key],
                "error" => $arrFileUpload["error"][$key],
                "size" => $arrFileUpload["size"][$key],
            );
    		if ( ! $this->upload->do_upload("surat")) {
    			$error = array('error' => $this->upload->display_errors());
                print_r($error);
    			$status = false;
    		}
    		else
    		{
    			$data[] = array('upload_data' => $this->upload->data());
                $status = true;
    		}
        }
        if ($status) {
            return $data;
        } else {
            return false;
        }
        
    }

    private function _cron_update_thumb() {

        $this->load->model("log_arsip_surat_thumb");
        $arrData = $this->tbl_arsip_surat->retrieve_no_thumb(0, 10);

        if (!$arrData) {
            return true;
        }

        $arrInsert = array();
        foreach ($arrData as $key => $arrVal) {
            $arrFile = json_decode($arrVal["as_file"]);

            $filepath = APPPATH."..".$arrFile[0];

            $status = $this->_create_thumbnail($filepath);

            if ($status) {
                if ($arrVal["las_status"] != null) {
                    $arrUpdate = array(
                        "las_status" => 1,
                        "las_tgl_generate" => date("Y-m-d h:i:s")
                    );    
                    $status = $this->log_arsip_surat_thumb->updatedata($arrUpdate, $arrVal["as_id"]);
                } else {
                    $arrInsert[] = array(
                        "as_id" => $arrVal["as_id"],
                        "las_status" => 1,
                        "las_tgl_generate" => date("Y-m-d h:i:s")
                    );    
                }
                
            }
        }

        if ($arrInsert) {
            $status = $this->log_arsip_surat_thumb->insertdata($arrInsert);
        }
        return $status;

    }

    private function _create_thumbnail($filepath) {
        #360x205
        
        $config['source_image'] = $filepath;
        $config['width'] = 360;
        $config['height'] = 205;
        $config['maintain_ratio'] = true;
        $config['master_dim'] = "width";
        $config['new_image'] = str_replace("sa-scan-file", "sa-scan-file/resize", $filepath);

        $this->image_lib->initialize($config); 

        if ( ! $this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }

        $this->image_lib->clear();
        
        $config['source_image'] = str_replace("sa-scan-file", "sa-scan-file/resize", $filepath);
        $config['new_image'] = str_replace("sa-scan-file", "sa-scan-file/thumb", $filepath);
        $config['width'] = 360;
        $config['height'] = 205;
        $config['maintain_ratio'] = FALSE;
        $config['x_axis'] = 0;
        $config['y_axis'] = 0;

        $this->image_lib->initialize($config); 

        if ( ! $this->image_lib->crop())
        {
            return false; //$this->image_lib->display_errors();
        } else {
            return true;
        }
    }
    
	public function submit() {
        
        $arrPost = $this->input->post();

        if (!$arrPost) {
            show_404();
        }

        $status = true;

        $dataUpload = $this->_upload_file();

        if ($dataUpload) { // new
            $arrFile = array();
            foreach ($dataUpload as $key => $arrVal) {
                $arrFile[] = "/assets/img/sa-scan-file/".$arrVal["upload_data"]["file_name"];
            }
 
            $arrPost["as_file"] = json_encode($arrFile);
        } else if ($arrPost["as_id"] > 0) { // edit
            unset($arrPost["as_file"]);
        } else {
            $status = false;
            $arrError[] = "file tidak diupload";
        }

        if ($status) {
            echo "test";
            $arrPost["as_search_index"] = $this->_exec_search_index($arrPost);
            $return = $this->_set_data($arrPost);

            if ($return) {
                $this->load->model("log_arsip_surat_thumb");
                $arrUpdate = array(
                    "las_status" => 0
                );

                if ($arrPost["as_id"] > 0) {
                    $this->log_arsip_surat_thumb->updatedata($arrUpdate, $arrPost["as_id"]);
                }
            }
        }

        redirect(base_url(), 'refresh');
    }

    private function _exec_search_index($arrVal) {
        $arrText = array(
            "dari" => $arrVal["as_dari"],
            "nomor surat" => $arrVal["as_no_surat"],
            "tanggal surat" => $arrVal["as_tgl_surat"],
            "1tanggal surat" => misc_helper::format_idDate($arrVal["as_tgl_surat"]),
            "tanggal diterima" => $arrVal["as_tgl_diterima"],
            "1tanggal diterima" => misc_helper::format_idDate($arrVal["as_tgl_diterima"]),
            "agenda" => $arrVal["as_no_agenda"],
            "sifat" => $arrVal["as_sifat"],
            "perihal" => $arrVal["as_perihal"],
            "diteruskan" => $arrVal["as_diteruskan"],
            "keterangan" => $arrVal["as_ket"],
            "catatan" => $arrVal["as_catatan"],
        );  

        $jsontext = json_encode($arrText);

        return $jsontext;
    }
    
    public function test() {
        $arrData = $this->tbl_arsip_surat->retrieve_by_limit("", 0, 10);

        foreach($arrData as $key => $arrVal) {
            $arrTemp["as_search_index"] = $this->_exec_search_index($arrVal);

            $status = $this->tbl_arsip_surat->updatedata($arrTemp, $arrVal["as_id"]);
            $arrTemp = array();
        }   
    }
    
    public function print_data($id = "") {

        if ($id == "") {
            show_404();
        }

        $this->load->library("fpdf");

        $fpdf = new fpdf();

        $arrData = $this->tbl_arsip_surat->retrieve_by_id($id);

        if (!$arrData) {
            show_404();
        }

        $fileUrl = base_url($arrData[0]["as_file"]);

        $fpdf->setTitle("Print: ".$arrData[0]["as_no_agenda"]);

        $fpdf->addPage();
        $fpdf->Image($fileUrl, 2, 2, 206, 0,'jpg');
        $fpdf->output();
    }
}
    