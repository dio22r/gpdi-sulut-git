

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data Gembala</h3>
	</div>
	<form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">
		<div class="box-body">
			
	      <?php

	        echo form_hidden(
	          "tgem_id", misc_helper::get_form_value($ctlArrData, "tgem_id")
	        );


	        echo form_hidden(
	          "pas_tgem_id", misc_helper::get_form_value($ctlArrData, "pas_tgem_id")
	        );

	      ?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
		                  <label for="tgem_nomor_induk" class="col-sm-3 control-label">No. Induk : </label>

		                  <div class="col-sm-9">
		                    
				              <?php
				                $id = "tgem_nomor_induk";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nomor Induk Gembala"
				                );
				                echo form_input($arrInput);
				              ?>

		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="tgem_nama" class="col-sm-3 control-label">Nama : </label>

		                  <div class="col-sm-9">
		                    
				              <?php
				                $id = "tgem_nama";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gembala"
				                );
				                echo form_input($arrInput);
				              ?>

		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_tpt_lahir" class="col-sm-3 control-label">
		                  		Tempat Lahir :
	                  		</label>

		                  <div class="col-sm-9">
		                    
				              <?php
				                $id = "tgem_tpt_lahir";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tempat Lahir"
				                );
				                echo form_input($arrInput);
				              ?>

		                  </div>
		                </div>


		                <div class="form-group">
		                  	<label for="tgem_tgl_lahir" class="col-sm-3 control-label">
		                  		Tgl. Lahir :
	                  		</label>

		                  <div class="col-sm-9">
		                  	<div class="input-group">

				              <?php
				                $id = "tgem_tgl_lahir";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control datepicker",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tanggal Lahir: YYYY-MM-DD",
				                  "data-date-format" => "yyyy-mm-dd"
				                );
				                echo form_input($arrInput);
				              ?>

		                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_jk" class="col-sm-3 control-label">
		                  		Jenis Kelamin :
	                  		</label>

		                  <div class="col-sm-9">
		                    	<?php
				                $arrInput = array(
				                  "class" => "form-control"
				                );

				                $option = array(
				                  "L" => "Laki-laki",
				                  "P" => "Perempuan"
				                );

				                echo form_dropdown("tgem_jk", $option, misc_helper::get_form_value(
				                    $ctlArrData, "tgem_jk"), $arrInput
				                )
				                ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_status_nikah" class="col-sm-3 control-label">
		                  		Status Keluarga :
	                  		</label>

		                  <div class="col-sm-9">
		                  		<?php
			                      $arrInput = array(
			                        "class" => "form-control tgem_status_nikah"
			                      );

			                      $option = array(
			                        "S" => "Singel",
			                        "M" => "Menikah",
			                        "J" => "Janda",
			                        "D" => "Duda"
			                      );

			                      echo form_dropdown("tgem_status_nikah", $option, misc_helper::get_form_value(
			                          $ctlArrData, "tgem_status_nikah"), $arrInput
			                      )
			                    ?>
		                  </div>
		                </div>


		                <div class="form-group">
		                  	<label for="tgem_no_telp" class="col-sm-3 control-label">
		                  		No. Telp. :
	                  		</label>

		                  <div class="col-sm-9">
		                    
				              <?php
				                $id = "tgem_no_telp";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nomor Telephoner"
				                );
				                echo form_input($arrInput);
				              ?>

		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_email" class="col-sm-3 control-label">
		                  		Email :
	                  		</label>

		                  <div class="col-sm-9">
		                    
				              <?php
				                $id = "tgem_email";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Alamat Email"
				                );
				                echo form_input($arrInput);
				              ?>

		                  </div>
		                </div>

		                <hr />

		                <div class="form-group">
		                  	<label for="tgem_pend_umum" class="col-sm-3 control-label">
		                  		Pend. Umum :
	                  		</label>

		                  <div class="col-sm-6">
		                    
				              <?php
				                $id = "tgem_pend_umum";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Institusi"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-3">
				              <?php
				                $id = "tgem_pend_umum_gelar";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Gelar"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>


		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Sekolah Alkitab :
	                  		</label>

		                  <label for="tgem_sa_tkt1" class="col-sm-2 control-label">
		                    Tingkat 1
		                  </label>

		                  <div class="col-sm-5">
		                    
				              <?php
				                $id = "tgem_sa_tkt1";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Sekolah"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                  <div class="col-sm-2">
		                    
				              <?php
				                $id = "tgem_sa_tkt1_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		
	                  		</label>

		                  <label class="col-sm-2 control-label">
		                    Tingkat 2
		                  </label>

		                  <div class="col-sm-5">
		                    
				              <?php
				                $id = "tgem_sa_tkt2";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Sekolah"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                  <div class="col-sm-2">
		                    
				              <?php
				                $id = "tgem_sa_tkt2_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_pend_theo" class="col-sm-3 control-label">
		                  		Pend. Teologia :
	                  		</label>

		                  <div class="col-sm-6">
		                    
				              <?php
				                $id = "tgem_pend_theo";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Institusi"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                  <div class="col-sm-3">
				              <?php
				                $id = "tgem_pend_theo_gelar";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Gelar"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>
		                
		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Tgl. di Baptis :
	                  		</label>

		                  <div class="col-sm-9">
		                  	<div class="input-group">
		                    <?php
				                $id = "tgem_tgl_baptis";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control datepicker",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tanggal Baptis",
				                  'data-date-format' => "yyyy-mm-dd"
				                );
				                echo form_input($arrInput);
				              ?>
		                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Kependetaan :
	                  		</label>

                  		  	<label for="tgem_pdp_tempat" class="col-sm-2 control-label">
		                  		Pdp. di :
	                  		</label>

		                  <div class="col-sm-5">
		                    <?php
				                $id = "tgem_pdp_tempat";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "tgem_pdp_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		
	                  		</label>

                  		  	<label for="tgem_pdm_tempat" class="col-sm-2 control-label">
		                  		Pdm. di :
	                  		</label>

		                  <div class="col-sm-5">
		                    <?php
				                $id = "tgem_pdm_tempat";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "tgem_pdp_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		
	                  		</label>

                  		  	<label for="tgem_pdt_tempat" class="col-sm-2 control-label">
		                  		Pdt. di :
	                  		</label>

		                  <div class="col-sm-5">
		                    <?php
				                $id = "tgem_pdt_tempat";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "tgem_pdt_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
	                  </div>

	                 	<div class="form-group">
		                  	<label for="tgem_tpt_pelayanan" class="col-sm-3 control-label">
		                  		Tpt. Pelayanan :
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "tgem_tpt_pelayanan";
				                $arrInput = array(
				                  'name'		  => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja",
				                  
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
	               		</div>

	                 	<div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Almt. Pelayanan :
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "tgem_alamat_pelayanan";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Alamat Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
	               		</div>

	               		<hr />
	               		<h4>Catatan Pelayanan:</h4>
	               		<div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Nomor SK. :
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "tgem_no_sk";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nomor SK Penggembalaan Sekrang"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

	               		</div>
	                 	<div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Penggembalaan Pertama :
	                  		</label>

		                  <div class="col-sm-7">
		                    <?php
				                $id = "tgem_pgbl_pertama";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "tgem_pgbl_pertama_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
	               		</div>

	               		<div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Penggembalaan Sekarang :
	                  		</label>

		                  <div class="col-sm-7">
		                    <?php
				                $id = "tgem_pgbl_skrg";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "tgem_pgbl_skrg_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
	               		</div>
	               		<hr />
					</div>



					<div class="col-md-6 col-partner">

	               		<h4>Data Istri / Suami:</h4>
		                
		                <div class="form-group">
		                  <label for="inputEmail3" class="col-sm-3 control-label">Nama : </label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "pas_tgem_nama";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="pas_tgem_tpt_lahir" class="col-sm-3 control-label">
		                  		Tempat Lahir :
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "pas_tgem_tpt_lahir";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tempat Lahir"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>


		                <div class="form-group">
		                  	<label for="pas_tgem_tgl_lahir" class="col-sm-3 control-label">
		                  		Tgl. Lahir :
	                  		</label>

		                  <div class="col-sm-9">
		                  	<div class="input-group">
		                    <?php
				                $id = "pas_tgem_tgl_lahir";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control datepicker",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tanggal Lahir",
				                  'data-date-format' => "yyyy-mm-dd"
				                );
				                echo form_input($arrInput);
				              ?>
		                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="pas_tgem_jk" class="col-sm-3 control-label">
		                  		Jenis Kelamin :
	                  		</label>

		                  <div class="col-sm-9">
		                    	<?php
				                $arrInput = array(
				                  "class" => "form-control"
				                );

				                $option = array(
				                  "L" => "Laki-laki",
				                  "P" => "Perempuan"
				                );

				                echo form_dropdown(
				                	"pas_tgem_jk", $option,
				                	misc_helper::get_form_value(
				                    	$ctlArrData, "pas_tgem_jk"
				                	), $arrInput
				                );
				                ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="pas_tgem_no_telp" class="col-sm-3 control-label">
		                  		No. Telp. :
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "pas_tgem_no_telp";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nomor Telepon",
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="pas_tgem_email" class="col-sm-3 control-label">
		                  		Email :
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php
				                $id = "pas_tgem_email";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Alamat Email",
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <hr />

		                <div class="form-group">
		                  	<label for="pas_tgem_pend_umum" class="col-sm-3 control-label">
		                  		Pend. Umum :
	                  		</label>

		                  <div class="col-sm-6">
		                    
				              <?php
				                $id = "pas_tgem_pend_umum";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Institusi"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-3">
				              <?php
				                $id = "pas_tgem_pend_umum_gelar";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Gelar"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>


		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Sekolah Alkitab :
	                  		</label>

		                  <label for="pas_tgem_sa_tkt1" class="col-sm-2 control-label">
		                    Tingkat 1
		                  </label>

		                  <div class="col-sm-5">
		                    
				              <?php
				                $id = "pas_tgem_sa_tkt1";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Sekolah"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                  <div class="col-sm-2">
		                    
				              <?php
				                $id = "pas_tgem_sa_tkt1_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		
	                  		</label>

		                  <label class="col-sm-2 control-label">
		                    Tingkat 2
		                  </label>

		                  <div class="col-sm-5">
		                    
				              <?php
				                $id = "pas_tgem_sa_tkt2";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Sekolah"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                  <div class="col-sm-2">
		                    
				              <?php
				                $id = "pas_tgem_sa_tkt2_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="pas_tgem_pend_theo" class="col-sm-3 control-label">
		                  		Pend. Teologia :
	                  		</label>

		                  <div class="col-sm-6">
		                    
				              <?php
				                $id = "pas_tgem_pend_theo";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Institusi"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                  <div class="col-sm-3">
				              <?php
				                $id = "pas_tgem_pend_theo_gelar";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Gelar"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>
		                
		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Tgl. di Baptis :
	                  		</label>

		                  <div class="col-sm-9">
		                  	<div class="input-group">
		                    <?php
				                $id = "pas_tgem_tgl_baptis";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control datepicker",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tanggal Baptis",
				                  'data-date-format' => "yyyy-mm-dd"
				                );
				                echo form_input($arrInput);
				              ?>
		                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Kependetaan :
	                  		</label>

                  		  	<label for="pas_tgem_pdp_tempat" class="col-sm-2 control-label">
		                  		Pdp. di :
	                  		</label>

		                  <div class="col-sm-5">
		                    <?php
				                $id = "pas_tgem_pdp_tempat";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "pas_tgem_pdp_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		
	                  		</label>

                  		  	<label for="pas_tgem_pdm_tempat" class="col-sm-2 control-label">
		                  		Pdm. di :
	                  		</label>

		                  <div class="col-sm-5">
		                    <?php
				                $id = "pas_tgem_pdm_tempat";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "pas_tgem_pdp_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		
	                  		</label>

                  		  	<label for="pas_tgem_pdt_tempat" class="col-sm-2 control-label">
		                  		Pdt. di :
	                  		</label>

		                  <div class="col-sm-5">
		                    <?php
				                $id = "pas_tgem_pdt_tempat";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Nama Gereja"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>

		                  <div class="col-sm-2">
		                    <?php
				                $id = "pas_tgem_pdt_thn";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tahun"
				                );
				                echo form_input($arrInput);
				              ?>
		                  </div>
	                  </div>



		                <div class="form-group">
		                  	<label for="tgem_tgl_pernikahan" class="col-sm-3 control-label">
		                  		Tgl. Pernikahan :
	                  		</label>

		                  <div class="col-sm-9">
		                  	<div class="input-group">
	                  		  <?php
				                $id = "tgem_tgl_pernikahan";
				                $arrInput = array(
				                  'name'          => $id,
				                  'id'            => $id,
				                  'class'         => "form-control datepicker",
				                  'value'         => misc_helper::get_form_value(
				                    $ctlArrData, $id),
				                  'placeholder'   => "Tanggal Pernikahan",
				                  'data-date-format' => "yyyy-mm-dd"
				                );
				                echo form_input($arrInput);
				              ?>
		                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                    </div>
		                  </div>
		                </div>

					</div>
				</div>
			
		</div>
		<div class="box-footer">
			<div class="col-md-12" style="text-align:center">
			    <a href="<?php echo $ctlUrlBack; ?>"
			    	class="btn btn-default">Cancel</a>
			    <button type="submit" class="btn btn-info">
			    	<i class="glyphicon glyphicon-saved"></i> Simpan
		    	</button>
		    </div>
	  	</div>
 	</form>
</div>