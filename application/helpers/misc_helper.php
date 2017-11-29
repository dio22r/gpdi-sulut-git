<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class misc_helper {
    static $arrMonth = array(
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember"
    );
    
    static function get_form_arrData_todb($arrData = array(), $prefix = "", $omited ="") {
        $arrRet = array();
        foreach ($arrData as $key => $value) {
            if (strpos($key, $prefix) !== false) {
                $index = str_replace($omited, "", $key);
                $arrRet[$index] = $value;
            }
        }
        
        return $arrRet;
    }
    
    static function db_to_dropdown($indexValue, $indexDisplay, $arrData) {
        $arrResult = array();
        
        foreach ($arrData as $key => $arrVal) {
            $index = $arrVal[$indexValue];
            $value = $arrVal[$indexDisplay];
            $arrResult[$index] = $value;
        }
        
        return $arrResult;
    }
    
    /**
     * fungsi ini digunakan untuk mengambil data dari suatu array
     * dan jika index tidak terdeklarasi maka return kosong
     * 
     * fungsi ini digunakan untuk value pada form
     * 
     * @param unknown_type $variable variable acuan
     * @param unknown_type $index    index dari variable
     * 
     * return NULL|isi dari variable
     */
    static function get_form_value($variable, $index, $defaultVal = "") {
        if (isset($variable[$index])) {
            return $variable[$index];
        } else {
            return $defaultVal;
        }
    }
	
    /**
     * note : fungsi ini sangat bergantung pada helper dari CI
     * 
     * fungsi ini digunakan untuk membuat deretan radio botton
     * 
     * @param string  $name    radio button
     * @param array   $arrData data yang berupa array
     * contoh : array("45" => "Menu Manager", "46" => "Group Permision");
     * @param mixed   $value   index yang aktif
     * @param boolean $inline  penanda apakah menggunakaan inline atau tidak
     * 
     * return array yang berisi html dari tiap radiobutton yang terbentuk
     */
	static function arrFormRadio($name, $arrData, $value, $inline = false) {
	    $arrRadio = array();
	    
    	foreach ($arrData as $key => $val){
            $dataRadio = array(
                'name' => $name,
                'id' => $name.$val,
                'value' => $key
            );
            
            if ($value == $key && $value != "") {
                $dataRadio['checked'] = "checked";
            } else {
                $dataRadio['checked'] = "";
            }
            
            $strData = 
                "<div class='inline'>" . 
                form_radio($dataRadio) .
                "</div><div class='inline'>" .
                form_label($val,$name.$val) . "</div>";
                
            if ($inline === false) {
                $strData .= "<div class='clear'></div>";
            }
            
            $arrRadio[] = $strData;
        }
        
        return $arrRadio;
	}
	
    /**
     * note : fungsi ini sangat bergantung pada helper dari CI
     * 
     * fungsi ini digunakan untuk membuat deretan check box
     * 
     * @param string  $name    nama checkbox
     * @param array   $arrData data yang berupa array
     * contoh : array("45" => "Menu Manager", "46" => "Group Permision");
     * @param array   $value   index yang terpilih
     * contoh : array(45, 47);
     * 
     * return array yang berisi html dari tiap checkbox yang terbentuk
     */
    static function arrFormCheckbox($name, $arrData, $value) {
	    $arrRadio = array();
    	foreach ($arrData as $key => $val){
            $dataCheck = array(
                'name' => $name."[]",
                'id' => $name.$val,
                'value' => $key
            );
            if (in_array($key, $value)) {
                $dataCheck['checked'] = true;
            } else {
                $dataCheck['checked'] = false;
            }
            
            $arrRadio[] =
                "<div class='inline'>" . 
                form_checkbox($dataCheck) .
                "</div><div class='inline'>" .
                form_label($val,$name.$val) . "</div>
                <div class='clear'></div>";
        }
        
        return $arrRadio;
	}
    
	
    /**
     * fungsi ini digunakan untuk membuat format yang diterima oleh pengolahan
     * table pada library table javascript
     * 
     * @param array  $arrData    data yang akan dijadikan table
     * @param string $primaryKey index dari primarykey / index yang akan dijadikan id
     * 
     * return array yang berisi data yang terformat
     */
    static function prepare_to_table($arrData, $primaryKey) {
	    $flexData = array();
	    
	    $idField = $primaryKey;
	    foreach ($arrData as $key => $arrVal) {
	        $cell = array();
	        foreach ($arrVal as $key2 => $val) {
	            if ($key2 == $idField) {
	                $id = $val;
	            } else {
	                $cell[] = $val;
	            }
	        }
	        
	        $flexData[] = array (
	            "id" => $id,
	            "cell" => $cell
	        );
	    }
	    
	    return $flexData;
    }
	
    static function format_idDate($date) {
        $arrMonth = misc_helper::$arrMonth;
        
        list($year, $month, $day) = explode("-", $date);
        
        $strMonth = "";
        if (isset($arrMonth[$month])) {
            $strMonth = $arrMonth[$month];
        }
        $strIdFormat = $day . " " . $strMonth . " " . $year;
        
        return $strIdFormat;
    }
    
    static function str_idDay($date) {
        $arrDay = array(
            "sunday" => "Minggu",
            "monday" => "Senin",
            "tuesday" => "Selasa",
            "wednesday" => "Rabu",
            "thursday" => "Kamis",
            "friday" => "Jum'at",
            "saturday" => "Sabtu"
        );
        
        $strDay = strtolower(date("l", strtotime($date)));
        
        $strDay = $arrDay[$strDay];
        
        return $strDay;
    }
    
    /**
     * Untuk mengetahui umur
     * 
     * input parameter berupa tanggal lahir
     * Enter description here ...
     * @param unknown_type $dateOfBirth
     */

	static function get_age($dateOfBirth = "", $strDateNow = "now") {
	    $arrDate = explode("-", $dateOfBirth);
	    $arrNow = explode("-", date("Y-m-d", strtotime($strDateNow)));
	    
	    $tahun = $arrNow[0] - $arrDate[0];
	    if ($arrDate[1] == $arrNow[1]) {
	        if ($arrDate[2] > $arrNow[2]) {
	            $tahun -= 1;
	        }
	    } else if ($arrDate[1] > $arrNow[1]) {
	        $tahun -= 1;
	    }
	    return $tahun;
	}
}


