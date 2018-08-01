
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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("/assets/css/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("/assets/css/select2.min.css"); ?>">
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <img src="<?php echo $ctlLogo; ?>" width="50px" /> <br />
    <a href="<?php echo base_url(); ?>"><b>GPdI</b>SULUT</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg"><b>Pendaftaran User Baru</b></p>
    <form action="<?php echo $ctlUrlAction; ?>" method="post">

      
        <?php
          $id = "tu_tipe_id";

          $val = misc_helper::get_form_value(
            $ctlArrData, $id
          );
          $arrAttr = array(
            "class" => "form-control select2",
            "id" => $id
          );
          $forminput = form_dropdown($id, $ctlArrGereja, $val, $arrAttr);

          $errMsg = misc_helper::get_form_value(
              $ctlArrErr, $id
            );

          $classErr = "";
          if ($errMsg) {
            $classErr = "has-error";
          }
        ?>

      <div class="form-group has-feedback <?php echo $classErr; ?>">
        <?php echo $forminput; ?>
        <span class="help-block has-error"><?php echo $errMsg; ?></span>
      </div>

      
        <?php

          $id = "tu_display_name";
          $arrAttr = array(
            "class" => "form-control",
            "id" => $id,
            "placeholder" => "Nama Lengkap"
          );

          $forminput = form_input(
            $id, 
            misc_helper::get_form_value(
              $ctlArrData, $id
            ),
            $arrAttr
          );

          $errMsg = misc_helper::get_form_value(
              $ctlArrErr, $id
            );

          $classErr = "";
          if ($errMsg) {
            $classErr = "has-error";
          }
        ?>

      <div class="form-group has-feedback <?php echo $classErr; ?>">
        <?php echo $forminput; ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span class="help-block has-error"><?php echo $errMsg; ?></span>
      </div>
    
        <?php

          $id = "tu_contact";
          $arrAttr = array(
            "class" => "form-control",
            "id" => $id,
            "placeholder" => "No. Telp / Email"
          );

          $forminput = form_input(
            $id, 
            misc_helper::get_form_value(
              $ctlArrData, $id
            ),
            $arrAttr
          );

          $errMsg = misc_helper::get_form_value(
              $ctlArrErr, $id
            );

          $classErr = "";
          if ($errMsg) {
            $classErr = "has-error";
          }
        ?>

      <div class="form-group has-feedback <?php echo $classErr; ?>">
        <?php echo $forminput; ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="help-block has-error"><?php echo $errMsg; ?></span>
      </div>
      
        <?php

          $id = "tu_username";
          $arrAttr = array(
            "class" => "form-control",
            "id" => $id,
            "placeholder" => "Nama User"
          );
          $forminput = form_input(
            $id, 
            misc_helper::get_form_value(
              $ctlArrData, $id
            ),
            $arrAttr
          );


          $errMsg = misc_helper::get_form_value(
              $ctlArrErr, $id
            );

          $classErr = "";
          if ($errMsg) {
            $classErr = "has-error";
          }
        ?>
      <div class="form-group has-feedback <?php echo $classErr; ?>">
        <?php echo $forminput; ?>
        <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
        <span class="help-block has-error"><?php echo $errMsg; ?></span>
      </div>

        <?php

          $id = "tu_password";
          $arrAttr = array(
            "class" => "form-control",
            "id" => $id,
            "placeholder" => "Password"
          );
          $forminput = form_password(
            $id, 
            misc_helper::get_form_value(
              $ctlArrData, $id
            ),
            $arrAttr
          );

          $errMsg = misc_helper::get_form_value(
              $ctlArrErr, $id
            );

          $classErr = "";
          if ($errMsg) {
            $classErr = "has-error";
          }
        ?>
        
      <div class="form-group has-feedback <?php echo $classErr; ?>">
        <?php echo $forminput; ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block has-error"><?php echo $errMsg; ?></span>
      </div>
      
        <?php

          $id = "re_password";
          $arrAttr = array(
            "class" => "form-control",
            "id" => $id,
            "placeholder" => "Ulangi Password"
          );
          $forminput = form_password(
            $id, 
            misc_helper::get_form_value(
              $ctlArrData, $id
            ),
            $arrAttr
          );

          $errMsg = misc_helper::get_form_value(
              $ctlArrErr, $id
            );

          $classErr = "";
          if ($errMsg) {
            $classErr = "has-error";
          }
        ?>

      <div class="form-group has-feedback <?php echo $classErr; ?>">
        <?php echo $forminput; ?>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <span class="help-block has-error"><?php echo $errMsg; ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">
            <span class="glyphicon glyphicon-send"></span> &nbsp; Daftar  
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
    </div>
-->
    <div class="social-auth-links text-center">
      <p>- Atau -</p>
      
      <a href="<?php echo base_url("index.php/login"); ?>"
        class="btn btn-block btn-social btn-success">
        <i class="fa fa-check-square-o"></i> Saya sudah terdaftar.
      </a>
    </div>

  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->

<!-- iCheck -->

  <?php foreach($ctlArrJs as $key => $val) { ?> 
      <script src="<?php echo $val; ?>"></script>
  <?php } ?>

<script>
  $(function () {
    $('.select2').select2();
  });
</script>
</body>
</html>
