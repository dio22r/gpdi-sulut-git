<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once("Jemaat.php");

class jem_data_jemaat extends jemaat {

	protected $activeMenu = "daftar_jemaat";
    public $userAllowed = "grj";
    
    public function __construct() {
        parent::__construct();
        // load helper
        $this->load->helper("misc");
        $this->load->helper("path");
        $this->load->helper("file");
        $this->load->helper("form");
        
        $this->load->library("image_lib");
        $this->load->library("default_view");

        $this->load->model("tbl_jemaat");
        $this->load->model("tbl_gereja");
        
        // load libraries

        $arrConfig = array("session" => $this->session);

        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->lib_login->previlage($this->userAllowed); 
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries

        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);

        $this->thisurl = base_url("index.php/jem_data_jemaat");
        $this->grjId = $this->session->userdata["arrUser"]["usrt_id"];

    }

	public function index($search = "all", $start = 0) {
		$activeMenu = "daftar_jemaat";
        $arrGet = $this->input->get();

        $arrWhere = array(
        	"t2.tg_id" => $this->grjId
        );

        $perpage = 20;


        $arrSortHeader = array(
            "tj_nama" => array(
                "text" => "Nama",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tj_jk" => array(
                "text" => "Jenis Kelamin",
                "sort" => false,
                "class" => ""
            ),
            "age" => array(
                "text" => "Umur",
                "sort" => false,
                "type" => "ASC",
                "class" => ""
            ),
            "tj_tgl_lahir" => array(
                "text" => "Tgl. Lahir",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tj_status_nikah" => array(
                "text" => "Status Menikah",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "tj_status_nikah" => array(
                "text" => "Status Menikah",
                "sort" => true,
                "type" => "ASC",
                "class" => "sorting"
            ),
            "action" => array(
                "text" => "Edit/View",
                "sort" => false,
                "class" => ""
            ),
        );

        $sortUrl = $this->thisurl."";
        foreach ($arrSortHeader as $key => $arrVal)  {
            $class = "sorting";

            $href = "#";
            if ($arrVal["sort"]) {

                if (isset($arrGet["sort_field"]) && $key == $arrGet["sort_field"]) {

                    $class = "sorting_desc";
                    if (strtolower($arrGet["sort_type"]) == "asc") {
                        $arrVal["type"] = "DESC";
                        $class = "sorting_asc";
                    }

                }

                $href = $this->thisurl."?sort_field=".$key."&sort_type=".$arrVal["type"];
                $arrSortHeader[$key]["href"] = $href;
                $arrSortHeader[$key]["class"] = $class;
            }
            

            $arrSortHeader[$key]["href"] = $href;
        }

        $orderBy = "tj_nama ASC";
        if (isset($arrGet["sort_field"]) && isset($arrGet["sort_type"])) {
            $orderBy = $arrGet["sort_field"] . " " . $arrGet["sort_type"];
        }

        
		$arrData = $this->tbl_jemaat->retrieve_data(
            $arrWhere, $start, $perpage,
            "t1.*, t2.*, floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tj_tgl_lahir, '%Y-%m-%d'))/365) as age", $orderBy
        );

        $countTotal = $this->tbl_jemaat->count_data($arrWhere);

        $arrStsNikah = array(
            "S" => "Singel",
            "M" => "Menikah",
            "J" => "Janda",
            "D" => "Duda"
        );

        $arrJk = array(
            "L" => "Laki-laki",
            "P" => "Perempuan"
        );


        $arrView = array(
            "ctlArrData" => $arrData,
            "ctlStsNikah" => $arrStsNikah,
            "ctlArrJk" => $arrJk,
            "ctlUrlAdd" => $this->thisurl . "/form/",
            "ctlUrlEdit" => $this->thisurl . "/form/",
            "ctlUrlProfile" => $this->thisurl . "/profile/",
            "ctlPagination" => $this->_pagination($this->thisurl."/index/all/", $countTotal, $perpage, 4),
            "ctlArrSortHeader" => $arrSortHeader

        );
        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_main_sorting",
                $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array(
                base_url("assets/css/jquery.dataTables.min.css")
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function tambah_data($id = "") {
		
    }

    public function form($idGereja = "", $idJemaat = "") {
    	//$idGereja = $this->grjId;
    	//parent::form($idGereja, $idJemaat);
        $idGereja = $this->grjId;
        //parent::form($idGereja, "");

        if (!is_numeric($idGereja)) {
            show_404();
        }

        $arrWhere = array(
            "t1.tg_id" => $idGereja
        );
        $arrGereja = $this->tbl_gereja->retrieve_data($arrWhere);

        if (!$arrGereja) {
            show_404();
        }

        $arrWhere = array(
            "t2.tg_id" => $idGereja,
            "t1.tj_id" => $idJemaat
        );

        $arrData = $this->tbl_jemaat->retrieve_data($arrWhere, 0, 1);

        if ($arrData) {
            $arrData = $arrData[0];
        } elseif ($idJemaat != "") {
            show_404();
        }

        $arrForm = array(
            "ctlUrlSubmit" => $this->thisurl . "/submit",
            "ctlPilihGereja" => $this->thisurl . "/",
            "ctlArrGereja" => $arrGereja[0],
            "ctlArrData" => $arrData
        );
        $content = $this->load->view(
            "jemaat/vw_form_jemaat", $arrForm, true
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $content,
            "ctlSideBarR" => $this->lib_defaultView->retrieve_sidebar_r(),
            "ctlArrJs" => array(
                base_url("assets/js/bootstrap-datepicker.min.js"),
                base_url("assets/js/controller/jemaat.js")
            ),
            "ctlArrCss" => array(
                base_url("assets/css/jquery-ui.structure.min.css"),
                base_url("assets/css/jquery-ui.theme.min.css"),
                base_url("assets/css/jquery-ui.css"),
                base_url("assets/css/bootstrap-datepicker3.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);

    }

    public function hut_sepekan($minggu = 0) {
    	$activeMenu = "hut_sepekan";

    	$arrDate = $this->_retrieve_date($minggu);

    	$arrWhere = array(
    		"tg_id" => $this->grjId,
    		"tj_status" => 1
    	);

    	$arrData = $this->tbl_jemaat->retrieve_data_week($arrDate["arrMonth"], $arrWhere);

    	$arrData = $this->_sort_data($arrData, $arrDate["arrYearByDate"], $arrDate["now"]);

        $arrView = array(
            "ctlArrSorted" => $arrData,
            "ctlMinggu" => $arrDate["ketMinggu"],
            "ctlStartDate" => date("d M. Y", strtotime($arrDate["dateStart"]." +1days")),
            "ctlEndDate" => date("d M. Y", strtotime($arrDate["dateEnd"])),
            "ctlUrlHutPdf" => $this->thisurl."/hut_setahun_pdf/",
            "ctlArrLink" => array(
                "next" => $this->thisurl."/hut_sepekan/".($minggu+1),
                "prev" => $this->thisurl."/hut_sepekan/".($minggu-1),
                "now" => $this->thisurl."/hut_sepekan/"
            )
        );
        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_hut_sepekan", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _retrieve_date($minggu = 0) {
        
        $minggu = $minggu * 1;
        $ketMinggu = "Minggu Ini";
        $now = "now +0days"; //"2015-01-11"; //
        if (is_int($minggu)) {
            $tempMg = 7 * $minggu;
            if ($minggu < 0) {
                $now = "now ".$tempMg."days";
                $ketMinggu = abs($minggu) . " Minggu Sebelumnya";
            } elseif ($minggu > 0) {
                $now = "now +".$tempMg."days";
                $ketMinggu = $minggu . " Minggu Depan";
            }
        }
        
        
        $gmt = "+7hours";
        $dayOfweek = date("w", strtotime($now." ".$gmt));
        $dateStart = date("Y-m-d", strtotime($now." ".$gmt." -".$dayOfweek."days"));
        $dateEnd = date("Y-m-d", strtotime("$dateStart +7days"));
        
        $arrMonthDay = array();
        $arrYearByDate = array();
        $pivotDate = date("Y-m-d", strtotime($dateStart." +1days"));
        for ($i=1; $i<=7; $i++) {
            list($y, $m, $d) = explode("-", $pivotDate);
            $arrMonthDay[] = $m."-".$d;
            $arrYearByDate[ltrim($m, "0")][ltrim($d, "0")] = $y; 
            $pivotDate = date("Y-m-d", strtotime($pivotDate." +1days"));
        }

        return array(
        	"arrMonth" => $arrMonthDay,
        	"arrYearByDate" => $arrYearByDate,
            "now" => $now,
            "dateStart" => $dateStart,
            "dateEnd" => $dateEnd,
            "ketMinggu" => $ketMinggu
    	);
    }


    protected function _sort_data($arrData, $arrYearByDate = array(), $now = "now") {
        
        foreach ($arrData as $key => $arrVal) {
            list($y, $m, $d) = explode("-", $arrVal["tj_tgl_lahir"]);
            $m = ltrim($m, "0");
            $d = ltrim($d, "0");
            $umur = misc_helper::get_age($arrVal["tj_tgl_lahir"], $now . " +7days");
            

            $prefix = "";
            if ($arrVal["tj_status_nikah"] == "S") {
                if ($umur < 12) {
                    $prefix = "Adik ";
                } else {
                    if ($arrVal["tj_jk"] == "L") {
                        $prefix = "Sdr. ";
                    } else {
                        $prefix = "Sdri. ";
                    }
                }
            } else {
                if ($arrVal["tj_jk"] == "L") {
                    $prefix = "Bpk. ";
                } else {
                    $prefix = "Ibu ";
                }
            }

            $year = $arrYearByDate[$m][$d];
            $arrByDate[$year][$m][$d][] = array(
        		"nama" => $prefix.$arrVal["tj_nama"],
                "umur" => $umur,
                "link" => base_url("index.php/".__CLASS__."/profile/".$arrVal["tj_id"])
            );            
        }
        
        $arrSorted = array();
        $yNow = date("Y", strtotime($now." +7hours"));
        for ($y = $yNow; $y <= $yNow + 1; $y ++) {
            for ($i = 1; $i <= 12; $i ++) {
                for ($j = 1; $j <= 31; $j ++) {
                    if (isset($arrByDate[$y][$i][$j])) {
                        $arrSorted[$y][$i][$j] = $arrByDate[$y][$i][$j];
                    }
                }
            }
        }
        
        return $arrSorted;
    }
    

    public function hut_setahun_pdf($year = "now") {

        if (!is_numeric($year)) {
            $year = date("Y");
        }

        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        
        $this->load->library('fpdf');
        $this->fpdf->SetTitle("Data Hut Sepekan");
        
        $this->num = 1;
        $this->fpdf->SetMargins(10, 10);
        for ($i = 1; $i <= 12; $i ++) {
            $bulan = str_pad($i, 2, "0", STR_PAD_LEFT);
            $this->_print_monthly_data($bulan, $year);
        }

        $this->fpdf->Output();
    }

    protected function _print_monthly_data($bulan, $year = "now") {
        $arrReady = array();

        $arrTemp = $this->tbl_jemaat->select_tbl_jemaat(
            "tj_tgl_lahir, tj_nama, tj_no_telp, tj_jk, tj_al_desa, tj_status_nikah",
            array(
                "tj_status <>" => 0,
                "tj_tgl_lahir LIKE" => "%-".$bulan."-%",
                "tg_id" => $this->grjId
            )
        );


        // Column headings
        $header = array(
            'No', 'Hari', 'Nama', 'Umur', 'Telp.', 'JK', 'Domisili'
        );

        $this->fpdf->AddPage("L", "A4");

        $this->fpdf->SetFont('times','',16);
        $strBulan = misc_helper::$arrMonth[$bulan];
        $this->fpdf->Cell(
            295 - 25,10,"Data Hut Sepekan Bulan ".$strBulan,0,0,'C'
        );
        $this->fpdf->Ln();
        $this->fpdf->Ln();

        $arrTemp = $this->_sort_data_full(
            $arrTemp, $year
        );

        foreach ($arrTemp as $year => $arrVal) {
            foreach ($arrVal as $month => $arrVal2) {
                foreach ($arrVal2 as $day => $arrData) { 
                    
                    foreach ($arrData as $key => $data) {
                        $arrReady[] = $data;
                    }
                }
            }
        }

        $this->fpdf->SetFont('times','',12);
        $this->ImprovedTable($header, $arrReady);        
    }

    // Better table
    public function ImprovedTable($header, $data) {

        $w = array(10, 52, 92, 13, 58, 8, 40);
        // Header Table
        for($i=0;$i<count($header);$i++) {
            $this->fpdf->Cell($w[$i],7,$header[$i],1,0,'C');
        }
        $this->fpdf->Ln();
        // Data

        $this->fpdf->SetFillColor(224,235,255);

        $fill = false;
        $week = isset($data[0]["week"]) ? $data[0]["week"] : "00";

        foreach($data as $row) {
            if ($week != $row["week"]) {
                $week = $row["week"];
                $this->fpdf->Cell(array_sum($w),6,'','T');
                $this->fpdf->Ln();
            }
            $this->fpdf->Cell($w[0],6,$this->num.".", 0, 0, 'R', $fill);
            $this->fpdf->Cell($w[1],6,$row["haritanggal"], 0, 0, 'L', $fill);
            $this->fpdf->Cell($w[2],6,$row["nama"],0, 0, 'L', $fill);
            $this->fpdf->Cell($w[3],6,$row["umur"],0,0,'C', $fill);
            $this->fpdf->Cell($w[4],6,$row["no_telp"], 0, 0, 'L', $fill);
            $this->fpdf->Cell($w[5],6,$row["jk"], 0,0,'C', $fill);
            $this->fpdf->Cell($w[6],6,$row["domisili"], 0, 0, 'L', $fill);

            $fill = !$fill;
            $week = $row["week"];
            $this->fpdf->Ln();
            $this->num ++;
        }
        // Closing line
        $this->fpdf->Cell(array_sum($w),0,'','T');
    }

    protected function _sort_data_full($arrData, $year = 2018) {
        
        foreach ($arrData as $key => $arrVal) {
            list($y, $m, $d) = explode("-", $arrVal["tj_tgl_lahir"]);
            $m = ltrim($m, "0");
            $d = ltrim($d, "0");

            $umur = $year - $y;

            $date = $year."-".str_pad($m, 2, "0", STR_PAD_LEFT)
                        ."-".str_pad($d, 2, "0", STR_PAD_LEFT);
            
            $haritanggal = misc_helper::str_idDay($date) . ", ".
                misc_helper::format_idDate($date);

            $prefix = "";
            if ($arrVal["tj_status_nikah"] == "S") {
                if ($umur < 12) {
                    $prefix = "Adik ";
                } else {
                    if ($arrVal["tj_jk"] == "L") {
                        $prefix = "Sdr. ";
                    } else {
                        $prefix = "Sdri. ";
                    }
                }
            } else {
                if ($arrVal["tj_jk"] == "L") {
                    $prefix = "Bpk. ";
                } else {
                    $prefix = "Ibu ";
                }
            }

            $arrByDate[$year][$m][$d][] = array(
                "haritanggal" => $haritanggal,
                "nama" => $prefix.$arrVal["tj_nama"],
                "umur" => $umur,
                "no_telp" => $arrVal["tj_no_telp"],
                "jk" => $arrVal["tj_jk"],
                "domisili" => $arrVal["tj_al_desa"],
                "week" => date("W", strtotime($date))
            );
        }

        $arrSorted = array();
        $y = $year;
        for ($i = 1; $i <= 12; $i ++) {
            for ($j = 1; $j <= 31; $j ++) {
                if (isset($arrByDate[$y][$i][$j])) {
                    $arrSorted[$y][$i][$j] = $arrByDate[$y][$i][$j];
                }
            }
        }

        return $arrSorted;
    }

    public function daftar_kk($search = "", $start = 0) {
        $activeMenu = "daftar_kk";
        $idGereja = $this->grjId;

        $arrWhere = array(
            "t1e.tg_id" => $idGereja,
            "t1e.tjk_status" => 1
        );
        $arrData = $this->tbl_jemaat->select_tbl_kel(
            "t1e.*, count(t1.tj_id) as total", $arrWhere, "t1f.tjk_id"
        );


        $arrView = array(
            "ctlUrlAdd" => $this->thisurl . "/form_kk/",
            "ctlUrlAddAnggota" => $this->thisurl . "/form_kk_anggota/",
            "ctlUrlEdit" => $this->thisurl . "/form_kk/",
            "ctlUrlDelete" => $this->thisurl . "/delete_kk/",
            "ctlArrData" => $arrData,
            "ctlPagination" => "",
            "ctlStart" => $start + 1
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_list_kel", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    public function form_kk($id = "") {
        $activeMenu = "daftar_kk";

        $arrData = $arrDetail = array();
        if (is_numeric($id)) {
            $arrWhere = array(
                "t1e.tjk_id" => $id
            );
            $arrData = $this->tbl_jemaat->select_tbl_kel(
                "t1e.*", $arrWhere, "t1f.tjk_id"
            );

            if ($arrData) {
                $arrData = $arrData[0];

                $arrWhere = array(
                    "t1e.tjk_id" => $id,
                    "t1f.tjkt_status" => 1,
                    "t1e.tjk_status" => 1,
                    "t1.tj_status" => 1
                );

                $arrDetail = $this->tbl_jemaat->select_tbl_kel(
                    "t1f.tjkt_id, t1.tj_id, t1.tj_nama, t1.tj_jk,
                        floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tj_tgl_lahir, '%Y-%m-%d'))/365) as tj_umur,
                        t1.tj_status_nikah, t1e.tjk_nama
                        ", $arrWhere, "", "tj_umur DESC"
                );
            }
        }

        $arrReturn = $this->_form_kk_submit();


        $arrStsNikah = array(
            "S" => "Singel",
            "M" => "Menikah",
            "J" => "Janda",
            "D" => "Duda"
        );

          $arrJk = array(
            "L" => "Laki-laki",
            "P" => "Perempuan"
          );


        $arrView = array(
            "ctlUrlAdd" => $this->thisurl . "/form_kk_anggota/".$id,
            "ctlUrlDelete" => $this->thisurl . "/delete_kk_anggota/",
            "ctlUrlSubmit" => $this->thisurl . "/form_kk/".$id,
            "ctlUrlBack" => $this->thisurl . "/daftar_kk",
            "ctlArrData" => $arrData,
            "ctlArrDetail" => $arrDetail,
            "ctlArrStsNikah" => $arrStsNikah,
            "ctlArrJk" => $arrJk
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_form_kk", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _form_kk_submit() {
        $arrPost = $this->input->post();
        $arrReturn = array();

        $status = false;
        if ($arrPost) {
            if ($arrPost["tjk_nama"] != "") {
                //print_r($arrPost);
                if ($arrPost["tjk_id"] != "") { // edit
                    $arrUpdate = array(
                        "tjk_nama" => $arrPost["tjk_nama"],
                        "tjk_no_kk" => $arrPost["tjk_no_kk"],
                        "tg_id" => $this->grjId,
                        "tjk_last_update" => date("Y-m-d H:i:s")
                    );

                    $arrWhere = array(
                        "tjk_id" => $arrPost["tjk_id"]
                    );

                    $id = $arrPost["tjk_id"];

                    $status = $this->tbl_jemaat->update_det_by_id(
                        "table1e", $arrUpdate, $arrWhere
                    );
                } else { // new
                    $arrInsert = array(
                        "tjk_nama" => $arrPost["tjk_nama"],
                        "tjk_no_kk" => $arrPost["tjk_no_kk"],
                        "tg_id" => $this->grjId,
                        "tjk_date_created" => date("Y-m-d H:i:s")
                    );

                    $status = $this->tbl_jemaat->insert_det_by_id(
                        "table1e", $arrInsert
                    );

                    $id = $status;
                }
            } else {
                $arrReturn = array(
                    "status" => false,
                    "msg" => "Nama Keluarga tidak boleh kosong"
                );
            }
        }
        
        if ($status) {
            if ($arrPost["tjk_id"] == "") {
                redirect($this->thisurl."/form_kk_anggota/" . $id, "refresh");
            } else {
                redirect($this->thisurl."/form_kk/" . $id, "refresh");
            }
        } else {
            return $arrReturn;
        }
    }

    public function delete_kk($tjk_id) {
        $activeMenu = "daftar_kel";
        $idGereja = $this->grjId;
        
        // cek data anggota = grjId

        $arrWhere = array(
            "t1e.tg_id" => $idGereja,
            "t1e.tjk_id" => $tjk_id
        );

        $arrData = $this->tbl_jemaat->select_tbl_kel("*", $arrWhere);

        // delete data tjkt_id
        if ($arrData) {
            $arrUpdate = array(
                "tjk_status" => 0
            );
            $arrWhere = array(
                "tjk_id" => $tjk_id
            );

            $result = $this->tbl_jemaat->update_det_by_id("table1e", $arrUpdate, $arrWhere);
            if ($result) {
                redirect($this->thisurl."/daftar_kk/", "refresh");
            }
        } else {
            show_404();
        }

    }

    public function form_kk_anggota($tjk_id = "") {
        $activeMenu = "daftar_kk";
        $idGereja = $this->grjId;

        $this->_form_kk_anggota_submit();

        $arrWhere = array(
            "t1e.tjk_id" => $tjk_id
        );
        
        $arrDataKel = $this->tbl_jemaat->select_tbl_kel("t1e.*", $arrWhere);

        $arrData = array();
        if ($arrDataKel) {
            $arrData = $arrDataKel[0];
        } else {
            show_404();
        }

        $arrView = array(
            "ctlUrlBack" => $this->thisurl . "/form_kk/".$tjk_id,
            "ctlUrlSubmit" => $this->thisurl . "/form_kk_anggota/".$tjk_id,
            "ctlArrData" => $arrData,
            "ctlPagination" => ""
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_form_kk_anggota", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("/assets/js/select2.full.min.js"),
                base_url("/assets/js/controller/form_kk_anggota.js")
            ),
            "ctlArrCss" => array(
                base_url("/assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _form_kk_anggota_submit() {
        $arrPost = $this->input->post();

        $id = "";
        $return = false;
        if ($arrPost) {
            $arrInsert = $arrPost;
            $arrInsert["tjkt_status"] = 1;
            $id = $arrPost["tjk_id"];
            $return = $this->tbl_jemaat->insert_det_by_id("table1f", $arrInsert);
        }

        if ($return) {
            redirect($this->thisurl."/form_kk/" . $id, "refresh");
        } else {
            return $return;
        }
    }

    public function delete_kk_anggota($tjkt_id = "") {
        $activeMenu = "daftar_kk";
        $idGereja = $this->grjId;
        
        // cek data anggota = grjId

        $arrWhere = array(
            "t1e.tg_id" => $idGereja,
            "t1f.tjkt_id" => $tjkt_id
        );

        $arrData = $this->tbl_jemaat->select_tbl_kel("*", $arrWhere);

        // delete data tjkt_id
        if ($arrData) {
            $arrUpdate = array(
                "tjkt_status" => 0
            );
            $arrWhere = array(
                "tjkt_id" => $tjkt_id
            );

            $result = $this->tbl_jemaat->update_det_by_id("table1f", $arrUpdate, $arrWhere);
            if ($result) {
                redirect($this->thisurl."/form_kk/" . $arrData[0]["tjk_id"], "refresh");
            }
        } else {
            show_404();
        }
    }

    public function ajax_data_jemaat() {
        $arrInput = $this->input->get();
        $arrData = array();
        if ($arrInput) {
            $query = $arrInput["q"];
            $arrWhere = array(
                "t1.tj_nama LIKE" => "%". $query . "%",
                "t1.tg_id" => $this->grjId,
            );
            $arrData = $this->tbl_jemaat->retrieve_data(
                $arrWhere, 0, 20, "t1.tj_id as id, t1.tj_nama as text"
            );

            $arrData = array(
                "results" => $arrData
            );
        }

        header('Content-Type: application/json');
        echo json_encode($arrData);
    }


    public function mutasi_jemaat() {
        $activeMenu = "mutasi_jemaat";
        $idGereja = $this->grjId;

        $arrReturn = $this->_mutasi_jemaat_submit();

        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl . "/mutasi_jemaat/",
            "ctlArrReturn" => $arrReturn,
            "ctlArrData" => $arrReturn["data"]
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_form_mutasi_jemaat", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),


            "ctlArrJs" => array(
                base_url("/assets/js/select2.full.min.js"),
                base_url("/assets/js/controller/form_kk_anggota.js")
            ),
            "ctlArrCss" => array(
                base_url("/assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _mutasi_jemaat_submit() {
        $arrPost = $this->input->post();

        $msg = "";
        $result = $postStatus = false;
        $arrWhere = array();
        if ($arrPost) {
            $postStatus = true;
            $idUser = $this->arrSession["arrUser"]["usr_id"];
            $sql = "";

            // update table jemaat to 0

            $id = isset($arrPost["tj_id"]) ? $arrPost["tj_id"] : "";
            $arrWhere = array(
                "t1.tj_id" => $id,
                "t2.tg_id" => $this->grjId
            );

            $arrUpdate = array(
                "tj_status" => 0
            );


            $arrData = $this->tbl_jemaat->retrieve_data(
                $arrWhere, 0, 1, "t1.tj_nama, t2.tg_nama"
            );

            $arrWhere = array(
                "tj_id" => $id,
                "tg_id" => $this->grjId
            );

            if ($arrData) {
                $this->db->trans_start();            
                $result = $this->tbl_jemaat->update_det_by_id(
                    "table1", $arrUpdate, $arrWhere
                );

                $arrInsert = array(
                    "tj_id" => $arrPost["tj_id"],
                    "tu_id" => $idUser,
                    "tjm_tipe" => $arrPost["tjm_tipe"],
                    "tjm_ket" => $arrPost["tjm_ket"],
                    "tjm_status" => 1,
                    "tjm_sql_statement" => $sql
                );

                $result = $this->tbl_jemaat->insert_det_by_id("table1g", $arrInsert);

                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $msg = "Data Jemaat Gagal Dimutasi, ada kesalahan pada sistem <br />"
                        . $arrData[0]["tj_nama"] . " dari " . $arrData[0]["tg_nama"];
                    $result = false;
                } else {
                    $this->db->trans_commit();
                    $msg = "Data Jemaat Berhasil Dimutasi <br />"
                        . $arrData[0]["tj_nama"] . "dari " . $arrData[0]["tg_nama"];
                    $result = true;
                }
            } else {
                $result = false;
                $msg = "Tidak ada Data Jemaat yang dimutasi periksa kembali form pengisian mutasi";
            }
        }

        if ($result) {
            return array(
                "postStatus" => $postStatus,
                "status" => true,
                "msg" => $msg,
                "data" => array()
            );
        } else {
            return array(
                "postStatus" => $postStatus,
                "status" => false,
                "msg" => $msg,
                "data" => $arrPost
            );
        }
    }

    public function daftar_mutasi_jemaat($index = "", $start, $cat) {

    }

    public function daftar_kelompok($id = "") {
        $activeMenu = "daftar_kelompok";
        $idGereja = $this->grjId;

        $this->_form_kelompok_submit();

        $arrWhere = array(
            "t1h.tg_id" => $idGereja,
            "t1h.tjkp_status" => 1,
        );

        $arrData = $this->tbl_jemaat->select_tbl_kelompok(
            "t1h.*, count(t1.tj_id) as total", $arrWhere, "t1h.tjkp_id"
        );
        
        $arrKelompok = array();
        foreach($arrData as $key => $arrVal) {
            $idIndex = $arrVal["tjkp_id"];
            $arrKelompok[$idIndex] = $arrVal;
        }


        $arrDetail = array();
        if (is_numeric($id)) {
            if (isset($arrKelompok[$id])) {
                $arrDetail = $arrKelompok[$id];
            } else {
                redirect($this->thisurl."/daftar_kelompok/", "refresh");
            }
        }

        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl . "/daftar_kelompok/",
            "ctlUrlAddAnggota" => $this->thisurl . "/form_kelompok_anggota/",
            "ctlUrlDelete" => $this->thisurl . "/delete_kelompok/",
            "ctlArrData" => $arrData,
            "ctlArrDetail" => $arrDetail,
            "ctlPagination" => "",
            "ctlStart" => 1
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_list_kelompok", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("/assets/js/controller/kelompok.js")
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _form_kelompok_submit() {
        $arrPost = $this->input->post();
        $arrReturn = array();

        $status = false;
        if ($arrPost) {
            if ($arrPost["tjkp_nama"] != "") {
                //print_r($arrPost);
                if ($arrPost["tjkp_id"] != "") { // edit
                    $arrUpdate = array(
                        "tjkp_nama" => $arrPost["tjkp_nama"],
                        "tjkp_ket" => "", //$arrPost["tjkp_ket"],
                        "tg_id" => $this->grjId,
                        "tjkp_last_update" => date("Y-m-d H:i:s"),
                        "tjkp_status" => 1
                    );
                    
                    $arrWhere = array(
                        "tjkp_id" => $arrPost["tjkp_id"]
                    );

                    $id = $arrPost["tjkp_id"];

                    $status = $this->tbl_jemaat->update_det_by_id(
                        "table1h", $arrUpdate, $arrWhere
                    );
                } else { // new
                    $arrInsert = array(
                        "tjkp_nama" => $arrPost["tjkp_nama"],
                        "tjkp_ket" => "", //$arrPost["tjkp_ket"],
                        "tg_id" => $this->grjId,
                        "tjkp_date_created" => date("Y-m-d H:i:s"),
                        "tjkp_status" => 1
                    );

                    $status = $this->tbl_jemaat->insert_det_by_id(
                        "table1h", $arrInsert
                    );

                    $id = $status;
                }
            } else {
                $arrReturn = array(
                    "status" => false,
                    "msg" => "Nama Keluarga tidak boleh kosong"
                );
            }
        }
        
        if ($status) {
            if ($arrPost["tjkp_id"] == "") {
                redirect($this->thisurl."/daftar_kelompok/", "refresh");
            } else {
                redirect($this->thisurl."/daftar_kelompok/", "refresh");
            }
        } else {
            return $arrReturn;
        }
    }

    public function form_kelompok_anggota($id, $search = "", $start = 0) {
        $activeMenu = "daftar_kelompok";
        $idGereja = $this->grjId;

        $this->_form_kelompok_anggota_submit($id);

        $arrWhere = array(
            "t1h.tg_id" => $idGereja,
            "t1h.tjkp_id" => $id,
            "t1h.tjkp_status" => 1
        );

        $arrData = $this->tbl_jemaat->select_tbl_kelompok(
            "t1h.*", $arrWhere, "t1h.tjkp_id"
        );

        $arrWhere = array(
            "t1h.tjkp_id" => $id,
            "t1i.tjkpt_status" => 1,
            "t1h.tjkp_status" => 1,
            "t1.tj_status" => 1
        );

        $order = "tjkpt_date_created DESC";

        $arrDetail = $this->tbl_jemaat->select_tbl_kelompok(
            "t1i.tjkpt_id, t1.tj_id, t1.tj_nama, t1.tj_jk,
                floor(DATEDIFF(NOW(), STR_TO_DATE(t1.tj_tgl_lahir, '%Y-%m-%d'))/365) as tj_umur,
                t1.tj_status_nikah, t1h.tjkp_nama
                ", $arrWhere, "", $order
        );


        $arrStsNikah = array(
            "S" => "Singel",
            "M" => "Menikah",
            "J" => "Janda",
            "D" => "Duda"
        );

        $arrJk = array(
            "L" => "Laki-laki",
            "P" => "Perempuan"
        );

        $arrView = array(
            "ctlUrlSubmit" => $this->thisurl . "/daftar_kelompok/",
            "ctlUrlAddAnggota" => $this->thisurl . "/form_kelompok_anggota/",
            "ctlUrlDelete" => $this->thisurl . "/delete_kelompok_anggota/",
            "ctlArrData" => $arrData,
            "ctlArrDetail" => $arrDetail,
            "ctlArrJk" => $arrJk,
            "ctlArrStsNikah" => $arrStsNikah,
            "ctlStart" => $start + 1,
            "ctlSubTitle" => $arrData[0]["tjkp_nama"]
        );

        $arrData = array(
            "ctlTitle" => "Data Jemaat",
            "ctlSubTitle" => "GPdI Sulawesi Utara",

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("jemaat/vw_list_kelompok_anggota", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                base_url("/assets/js/select2.full.min.js"),
                base_url("/assets/js/controller/form_kk_anggota.js")
            ),
            "ctlArrCss" => array(
                base_url("/assets/css/select2.min.css"),
            )
        );
        $this->load->view('master_view/master_index', $arrData);
    }

    protected function _form_kelompok_anggota_submit($id) {
        $arrPost = $this->input->post();

        $return = false;
        if ($arrPost) {
            $arrInsert = $arrPost;
            $arrInsert["tjkp_id"] = $id;
            $arrInsert["tjkpt_status"] = 1;

            $return = $this->tbl_jemaat->insert_det_by_id("table1i", $arrInsert);
        }

        if ($return) {
            redirect($this->thisurl."/form_kelompok_anggota/" . $id, "refresh");
        } else {
            return $return;
        }
    }

    public function delete_kelompok_anggota($tjkt_id = "") {
        $activeMenu = "daftar_kelompok";
        $idGereja = $this->grjId;
        
        // cek data anggota = grjId

        $arrWhere = array(
            "t1h.tg_id" => $idGereja,
            "t1i.tjkpt_id" => $tjkt_id
        );

        $arrData = $this->tbl_jemaat->select_tbl_kelompok("*", $arrWhere);

        // delete data tjkt_id
        if ($arrData) {
            $arrUpdate = array(
                "tjkpt_status" => 0
            );
            $arrWhere = array(
                "tjkpt_id" => $tjkt_id
            );

            $result = $this->tbl_jemaat->update_det_by_id("table1i", $arrUpdate, $arrWhere);
            if ($result) {
                redirect($this->thisurl."/form_kelompok_anggota/" . $arrData[0]["tjkp_id"], "refresh");
            }
        } else {
            show_404();
        }
    }

}