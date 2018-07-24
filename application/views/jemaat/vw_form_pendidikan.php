<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Pendidikan</h3>
	</div>
	<form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">
		<div class="box-body">
		
		<?php	
        echo form_hidden(
          "tj_id", misc_helper::get_form_value($ctlArrData, "tj_id")
        );

        echo form_hidden(
          "tpen_id", misc_helper::get_form_value($ctlArrData, "tpen_id")
        );
        ?>
			<div class="row">
				<div class="col-md-6">
	                <div class="form-group">
	                  <label for="tp_nama" class="col-sm-3 control-label">Tingkat Pendidikan : </label>

	                  <div class="col-sm-9">

			                <?php
		                      $arrInput = array(
		                        "class" => "form-control"
		                      );

		                      $option = array(
		                        "" => " - ",
		                        "TK" => "TK",
		                        "SD" => "SD",
		                        "SMP" => "SMP",
		                        "SMA" => "SMA",
		                        "D1" => "D1",
		                        "D2" => "D2",
		                        "D3" => "D3",
		                        "S1" => "S1",
		                        "S2" => "S2",
		                        "S3" => "S3",

		                        "SA" => "Sekolah Alkitab",
		                        "STT" => "Sekolah Tinggi Theologia",
		                        "Ins" => "Institut",
		                        "Sem" => "Seminari"
		                      );

		                      echo form_dropdown("tpen_tingkat", $option, misc_helper::get_form_value(
		                          $ctlArrData, "tpen_tingkat"), $arrInput
		                      )
		                    ?>

	                  </div>
	                </div>


					<div class="form-group">
	                  <label for="tpen_jurusan" class="col-sm-3 control-label">Jurusan:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tpen_jurusan";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Jurusan"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tpen_instansi" class="col-sm-3 control-label">Instansi:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tpen_instansi";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Nama Instansi"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tpen_alamat" class="col-sm-3 control-label">Alamat:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tpen_alamat";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Alamat Instansi"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tpen_telp" class="col-sm-3 control-label">Telepon:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tpen_telp";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Nomor Telepon Instansi"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tp_tahun_mulai" class="col-sm-3 control-label">Tahun Mulai:</label>

	                  <div class="col-sm-6">

			              <?php
			                $id = "tpen_tahun_mulai";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "contoh: 2018"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tp_tahun_selesai" class="col-sm-3 control-label">Tahun Berakhir:</label>

	                  <div class="col-sm-6">

			              <?php
			                $id = "tpen_tahun_selesai";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Biarkan kosong jika belum berkakhir"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

                </div>
            </div>
        </div>

		  <div class="box-footer">

		    <div class="col-sm-12">
		      <a href="<?php echo $ctlUrlBack; ?>"
		        class="btn btn-default" >
		        Kembali
		      </a>
		      <button class="btn btn-primary" type="submit">
		          Simpan
		      </button>
		    </div>

		  </div>

    </form>
</div>
