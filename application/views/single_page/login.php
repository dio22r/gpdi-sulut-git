
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo doctype();
header("Expires: Mon, 26 July 1997 01:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$viewTitle = isset($ctlTitle) ? "GPdI SULUT | " . $ctlTitle
    : "GPdI SULUT";
$ctlTitle = isset($ctlTitle) ? $ctlTitle : "Sekretariat";

?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Cache-Control" content="no-cache" />

<title><?php echo $viewTitle ?></title>

<link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css") ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/css/main.css") ?>" />

<script type="text/javascript">
	const BASEURL = "<?php echo base_url("index.php"); ?>/";
</script>
<script src="<?php echo base_url("assets/js/jquery.js") ?>" ></script>
<script src="<?php echo base_url("assets/js/bootstrap.js") ?>" ></script>
<script src="<?php echo base_url("assets/js/controller/login.js") ?>" ></script>
<script src="<?php echo base_url("assets/js/_form_helper.js") ?>" ></script>

</head>
<body>

<div id="big-header">
	<div class="g-warper">
    	<div class="header-logo">
    		<img src="<?php echo base_url("assets/img/logo-big.png"); ?>" />
    	</div>
    	<div class="g-warper-page-sign">
    		<div class="g-page-sign login">
    			&nbsp;
    		</div>	
    	</div>
	</div>
</div>


<div id="body">
	<form name="login-form" method="post">
    	<div class="form-login">
    		<div class="login-item">
    			<div class="login-label">
    				Username
    			</div>
    			<div class="login-texfield">
    				<input type="text" name="login_username" class="textfield" >
    			</div>
    		</div>
    		<div class="login-item">
    			<div class="login-label">
    				Password
    			</div>
    			<div class="login-texfield">
    				<input type="password" name="login_password" class="textfield">
    			</div>
    		</div>
    		<div class="login-item-right">
    			<a href="#" class="gpdi-button">Reset</a>
    			<button type="button" name="submit" class="gpdi-button">Oke!</button>
    		</div>
    	</div>
	</form>
</div>

<div id="footer">
	<div class="warper">
		<div class="copyright">
			&copy; BPKAD | 2017
		</div>
	</div>
</div>

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3></h3>
    </div>
    <div class="modal-body">
    	<div class="alert"></div>
    </div>
    <div class="modal-footer">
        
    </div>
</div>

</body>
</html>
