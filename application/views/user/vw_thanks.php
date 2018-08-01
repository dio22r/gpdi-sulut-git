<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GPdI Sulut | Form Pendaftaran</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("/assets/css/font-awesome.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url("/assets/css/ionicons.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("/assets/css/AdminLTE.min.css"); ?>">

  <!-- Theme style -->
  <!-- iCheck 
  

  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page" style="text-align:center;">

	<div class="jumbotron text-xs-center">
	  <img src="<?php echo $ctlLogo; ?>" width="70px" /> <br />
	  <h1 class="display-3">Terima Kasih!</h1>
	  <p class="lead"><strong>Hubungi </strong> <i>Administrator GPdI SULUT</i> untuk mengaktifkan akun anda.</p>
	  <hr>

	  <p class="lead">
	    <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>" role="button">Halaman Utama</a>
	  </p>

	  <div style="width: 350px;margin: 2% auto;">
	  	<div class="register-box-body">
	  		<div class="table-responsive" style="text-align: left">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Username :</th>
                <td><?php echo $ctlUsername; ?></td>
              </tr>
              <tr>
                <th>Password :</th>
                <td><?php echo $ctlPassword; ?></td>
              </tr>
            </tbody></table>
          </div>
          Simpan dan gunakan data ini untuk masuk dalam
          <i>Sistem Informasi Jemaat GPdI SULUT</i>
  		</div>
  		<br />
	  	<a href="https://www.facebook.com/MDGPdISulut/"
	  		class="btn btn-block btn-social btn-facebook">
	        <i class="fa fa-facebook"></i> Hubungi Kami
	     </a>
	  
	</div>


	  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMDGPdISulut%2F&tabs&width=340&height=214&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=true&appId" width="340" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	</div>

	<div style="margin:30px auto;text-align:center;">
	<hr>
		<img src="<?php echo $ctlLogoMd; ?>" alt="BootstrapCreative" width="300">
		<br><br>
		<!--
		<a href="https://bootstrapcreative.com/shop/bootstrap-quick-start/?utm_source=codepen&amp;utm_campaign=resources&amp;utm_medium=footer" target="_blank"><strong>Bootstrap 4 Book</strong></a>&emsp;
		<a href="https://bootstrapcreative.com/resources/bootstrap-4-classes-list-reference-cheat-sheet/?utm_source=codepen&amp;utm_campaign=bootstrap4_cheatsheet&amp;utm_medium=footer" target="_blank">Bootstrap 4 Classes Reference</a>&emsp;
		<a href="https://bootstrapcreative.com/pattern/?utm_source=codepen&amp;utm_campaign=bootstrap_patterns&amp;utm_medium=footer" target="_blank">Bootstrap Code Snippets</a>
		-->
	</div>
</body>
</html>