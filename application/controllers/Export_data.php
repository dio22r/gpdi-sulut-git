<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class export_data extends CI_Controller {

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

        $this->load->model("tbl_wilayah");
        $this->load->model("tbl_gereja");
        $this->load->model("tbl_gembala");
        $this->load->model("tbl_kabupaten");
        $this->load->model("tbl_jemaat");
        
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
        
    }
    
    private function _extract_insert_data($id, $filename) {

        //$data = $this->tbl_file->select_file_by_id($id);
        
        $this->load->library("lib_excel");

        $file = APPPATH . "..".$filename;

        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objPHPExcel->setActiveSheetIndex(0);

        //$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

        $worksheet = $objPHPExcel->getActiveSheet();
        $lastrow = $worksheet->getHighestRow();
        $arrData = array();

        //$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
        for($i = 2; $i <= $lastrow; $i++) {
            $ket = $worksheet->getCell("F".$i)->getValue();
            //$arrKet = explode("(",$ket);
            preg_match_all('/\(([A-Z-. ]*)\)/', $ket, $arrKet);

            $tipe = "None";
            $count = count($arrKet[0]);
            if (isset($arrKet[1][$count-1])) {
                $tipe = trim($arrKet[1][$count-1], "() ");
            }
            
            $exceldatestamp = $worksheet->getCell("A".$i)->getFormattedValue();
            
            $arrDate = explode("/", $exceldatestamp);
            if(count($arrDate) == 3) {
                $d = str_pad($arrDate[1], 2, "0", STR_PAD_LEFT);
                $m = str_pad($arrDate[0], 2, "0", STR_PAD_LEFT);
                $y = $arrDate[2];
                $date = $y."-".$m."-".$d;
            } else {
                $date = "0000-00-00";
            }
            
            $arrData[] = array(
                "tf_id" => $id,
                "tpgl_tgl" => $date,
                "tpgl_no_sp2d" => $worksheet->getCell("B".$i)->getValue(),
                "tpgl_jenis" => $worksheet->getCell("C".$i)->getValue(),
                "tpgl_sub_unit" => $worksheet->getCell("D".$i)->getValue(),
                "tpgl_nama_penerima" => $worksheet->getCell("E".$i)->getValue(),
                "tpgl_ket" => $ket,
                "tpgl_bruto" => $worksheet->getCell("G".$i)->getValue(),
                "tpgl_potongan" => $worksheet->getCell("H".$i)->getValue(),
                "tpgl_netto" => $worksheet->getCell("I".$i)->getValue(),
                "tpgl_tipe" => $tipe
            );

            if (count($arrData) == 100) {
                $this->tbl_pengeluaran->insertdata($arrData);
                $arrData = array();
            }
            
        }

        //print_r($arrData);
        $this->tbl_pengeluaran->insertdata($arrData);
    }
}