<?php

class lib_login {
    protected $session;
    
    public function __construct($arrConfig = array()) {
        foreach ($arrConfig as $key => $value) {
            $this->$key = $value;
        }
    }

    public function check_login() {
        $idUser = $this->session->userdata("idUser");
        
        if (!$idUser) {
            $arrCookies = array("last_url", current_url());
            $this->set_cookies($arrCookies);
            
            return false;
        } else {
            $isAllow = $this->check_previlage();

            if ($isAllow) {
                return true;
            } else {
                show_404();
            }
        }
    }

    public function check_previlage() {
        
        return true;
    }

    public function set_cookies($arrCookies) {
        $date = date("Y-m-d H:i:s", strtotime("+ 30 Minutes"));
        foreach ($arrCookies as $key => $val) {
            set_cookie($key, $val, $date, "localhost");
        }
    }
    

    public function set_session_data($arrUser = array(), $arrUserDet = array()) {
        
        $this->session->set_userdata("idUser", $arrUser["usr_id"]);
        $this->session->set_userdata("arrUser", $arrUser);
        $this->session->set_userdata("arrUserDet", $arrUserDet);
        
		$this->session->unset_userdata("count_try");
		
    }

    public function get_session_data() {
        
        if ($this->check_login()) {
            return array(
                "idUser" => $this->session->userdata("idUser"),
                "arrUser" => $this->session->userdata("arrUser"),
            	"arrUserDet" => $this->session->userdata("arrUserDet")
            );
        } else {
            return array();
        }
    }
    
    
    public function check_redir() {
        $lastUrl = get_cookie("last_url");
        
        if ($lastUrl) {
            return $lastUrl;
        } else {
            return base_url();
        }
    }

    public function redir_ifnot_login() {
        $isLogin = $this->check_login();
        
        if (!$isLogin) {
            delete_cookie("last_url");
		    redirect(base_url("index.php/login"), "refresh");
        }
    }
    
    public function redir_if_login() {
        $isLogin = $this->check_login();
        return ;
        if ($isLogin) {
            $lastUrl = get_cookie("last_url");
            if (!$lastUrl) {
                $lastUrl = base_url();
            }
            
		    redirect($lastUrl, "refresh");
        }
    }
    

    public function count_try() {
        $count = $this->session->userdata("count_try");
        
        if ($count === false) {
            $count = 1;
        } else {
            $count ++;
        }
        
        $this->session->set_userdata("count_try", $count);
        
        return $count;
    }
}