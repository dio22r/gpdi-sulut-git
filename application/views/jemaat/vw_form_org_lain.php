<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Organisasi Laian</h3>
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
          "tol_id", misc_helper::get_form_value($ctlArrData, "tol_id")
        );
        ?>
			<div class="row">
				<div class="col-md-6">
	                <div class="form-group">
	                  <label for="tol_nama" class="col-sm-3 control-label">Organisasi : </label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tol_nama";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Nama Organisasi, Parpol, dll"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="inputEmail3" class="col-sm-3 control-label">Jabatan :</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tol_jabatan";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Ketua / Sekretaris / Bendahara / Anggota / dll"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>


					<div class="form-group">
	                  <label for="inputEmail3" class="col-sm-3 control-label">Tahun Mulai:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tol_tahun_mulai";
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
	                  <label for="inputEmail3" class="col-sm-3 control-label">Tahun Berakhir:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tol_tahun_selesai";
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
