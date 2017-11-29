<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class struktur_md extends CI_Controller {

    protected $activeMenu = "struktur_md";
    protected $title = "Data Arsip Surat";
    protected $arrViewContentHeader = array(
        "ctlTitle" => "Data Wilayah",
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

        $this->load->library("default_view");

        $this->load->model("tbl_wilayah");

        $arrConfig = array("session" => $this->session);
        $this->lib_login = new lib_login($arrConfig);

        $this->lib_login->redir_ifnot_login();
        $this->isLogin = $this->lib_login->check_login();
        $this->arrSession = $this->lib_login->get_session_data();
        // endof load libraries

        $this->lib_login->redir_ifnot_login();

        
        $this->lib_defaultView = new default_view($this->load, $this->lib_login);
        $this->lib_defaultView->set_libLogin($this->lib_login);


        $this->thisurl = base_url("index.php/struktur_md");
    }
    
    public function index($index = "md") {

        $arrMenu = array(
            "md" => array(
                "url" => $this->thisurl,
                "display" => "Majelis Daerah"
            ),
            "penghubung" => array(
                "url" => $this->thisurl . "/index/penghubung",
                "display" => "Penghubung"
            ),
            "kd" => array(
                "url" => $this->thisurl . "/index/kd",
                "display" => "Komisi Daerah"
            ),
        );

        $this->load->library("table");
        $arrView = array(
            "ctlActiveTab" => $index,
            "ctlArrTab" => $arrMenu,
            "ctlDataText" => $this->data($index)
        );

        $arrData = array(
            "ctlTitle" => $this->arrViewContentHeader["ctlTitle"],
            "ctlSubTitle" => $this->arrViewContentHeader["ctlSubtitle"],

            "ctlSideBar" => $this->lib_defaultView->retrieve_menu($this->activeMenu),
            "ctlHeaderBar" => $this->lib_defaultView->retrieve_header(),
            "ctlContentArea" => $this->load->view("struktur_md/vw_main", $arrView, true),
            "ctlSideBarR" => $this->load->view("master_view/master_sidebar_r", array(), true),

            "ctlArrJs" => array(
                
            ),
            "ctlArrCss" => array()
        );
        $this->load->view('master_view/master_index', $arrData);
    }
    
    public function data($index = "md") {

        $data["md"] = "Ketua                : Pdt. Ivonne I. Awuy Lantu.
                Wakil Ketua             : Pdt. John R. S. Awuy STh.
                Wakil Ketua         : Pdt. Dr. W. J. Kumendong SH, MH.
                Wakil Ketua         : Pdt. Matheos Sumaa MTh.
                Wakil Ketua         : Pdt. Prof. Dr. D. P. E. Saerang SE, MCom (Hons).
                Sekretaris              : Pdt. Dr. Robby Makal  MTh, MPdK.
                Wakil Sekretaris            : Pdt. Hanny Semuel Daniel Awuy.
                Wakil Sekretaris            : Pdt. Drs. Hanny Kolondam.
                Wakil Sekretaris            : Pdt. Rein Joppie Wotulo STh.
                Bendahara               : Pdt. Th. Pandelaki Tendean MTh.
                Wakil Bendahara         : Pdt. Drs. Julianus Nataniel Kesek MPdK.
                Wakil Bendahara         : Pdt. Dr. Ir. Frangky Mewengkang MTh.
                Wakil Bendahara         : Pdt. Josep Takarendehang.
                .:.
                Biro Penggembalaan      : Pdt. George Tewal MTh.
                Biro Penginjilan            : Pdt. Herry Monengkey STh.
                Biro Pendidikan dan Pengajaran              : Pdt. Dr. J. F. Kaawoan MTh.
                Biro Organisasi         : Pdt. Drs. Albert Awuy.
                Biro Pembangunan Gereja Pedesaan    : Pdt. Lengker Rarumangkay.
                Biro Pelayanan Misi dan Perintisan Gereja Lokal     : Pdt. Ventje Lukar STh.
                Biro Pelayanan Warga Jemaat : Pdt. Lexi Karundeng STh.
                Biro Pelayanan Kesejahteraan Hamba Tuhan            : Pdt. Jefry Manitik STh.
                Biro Penelitian dan Pengembangan    : Pdt. Ronny Luwuk STh.
                Biro Pengawasan Aset Daerah : Pdt. Nogi Rundengan STh.
                Biro Media Cetak dan Elektonik  : Pdt. DR. Berty Motulo MTh.
                Biro Hubungan Antar Lembaga : Pdt. DR. R. O. A. Pessak. MA.
.:.
                Penasehat Majelis Daerah    :
                K e t u a       :  Pdt. DR. Drs. H. Watuseke MTh
                Wakil Ketua :  Pdt. Prof. DR. J. O. Wotulo MTh.
                Anggota         :  Pdt. Moody Wenas.
                            :  Pdt. Edwin Sumilat MA.
                            :  Pdt. Markus Tumbelaka MTh.
                            :  Pdt. John E. I. Pangalila BSc.
                            :  Pdt. Robby Mambo STh
                            :  Pdt. DR. H. Lumingkewas.
                            :  Pdt. H. Pungus STh.
                            :   Pdt. Robby Ticoalu.
                            :  Pdt. B. Ratu.
                            :  Pdt. J. A. Sanger STh.
                            :  Pdt. Minder Malonda STh.
                            :  Pdt. Bobby Rakian STh.";


        $data["penghubung"] = "
            Kota Manado : 1. Pdt. Filemon Assa.
                        : 2. Pdt. Abdulah Husein.
            Kabupaten Minahasa : 1. Pdt. Vecky Mamentu
                        : 2. Pdt. Victor Pantow
            Kabupaten Minahasa Utara : 1. Pdt. Eddy Talumantak, S.Th
                        : 2. Pdt. Hafni Panese, S.Th
            Kota Bitung : 1. Pdt. H. D. Ganda.
                        : 2. Pdt. Yarry Lumangkun
            Kota Tomohon : Pdt. Raymond Sondakh
            Kabupaten Minahasa Selatan  : 1. Pdt. Musa Wowor.
                        : 2. Pdt. John O.E Tiwa.
            Kabupaten Minahasa Tenggara : 1. Pdt. David Massie.
                        : 2. Pdt. Petrus Mandagi, M.Th
            Kabupaten Boltim : Pdt. Moddy Kandow
            Kota Kotamobagu : Pdt. Ahmad Yani Sinaulan, SH
            Kabupaten Bolaang Mongondow Utara : Pdt. Decky Polii, S.Pd.K
            Kabupaten Bolsel : Pdt. Ronald Pondaag, S.Th
            Kabupaten Bolaang Mongondow : 1. Pdt. Frits Kumayas
                        : 2. Pdt. Herny Landeng, S.Th
            Kabupaten Kep. Sitaro : Pdt. Arnold Wowor
            Kabupaten Kep. Sangihe : 1. Pdt. Gustaf Onsu
                        : 2. Pdt. Dr. Aries Lumempouw
            Kabupaten Kep. Talaud : 1. Noldy Karamoy
                        : 2. David Mamalioo";

        $data["kd"] = "
            PELPRIP : Drs. Meki Onibala  Msi 
            : Drs. Max Raintung
            : Pdt. Lendy Rompies
            PELWAP : Pdt. Dra. Frike O Kesek Palealu
            : Pdt. Chresia Makal Bate, STh
            : Pdt. Ch Jeane Takarendehan Tuju
            PELPAP : Pdt. Erel Mamahani
            : Pdt. Port Ropa
            PELRAP : Pdt. Argemiro Manimpurung STh.MA
            : Pdt. Oral Robert Wenas
            : Pdt. William Sengk
            PELNAP : Pdt. Frangky Umboh
            : Pdt. Danny Raintung
            : Henny Ghaghana
            PELAHT : Pdt. Lodewyk Waworuntu
            : Pdt. Denny Momongan
            : Pdt. Jemmy Wongkar
            PELPRUP : Prof. Dr. Yohanes Senduk
            PELMAP : Pdt. DR.dr. Jefrie Sumayku DK, MKes, MTh, DTh.
            : Efraim Nusland
            : Debora Luwuk
            KDP3 (Penginjilan) : Pdt. Dr. Jootje Luntungan
            : Pdt. Morris D. Watuseke, SE, M.Th, M.Pdk
            : Pdt. Benny Narasiang, S.Th, MT.
            BADAN ADVOKASI : Bpk. John Sada SH. MH
            BADAN PENDIDIKAN KRISTEN PANTEKOSTA : Prof. Drs. F. J. Timban MA
            BUMG : Pdt. Max Drs. Max Tamon MHum";

        return $data[$index];
    }
}