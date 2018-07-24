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
          "rel_id", misc_helper::get_form_value($ctlArrData, "rel_id")
        );

        echo form_hidden(
          "ta_id", misc_helper::get_form_value($ctlArrData, "ta_id")
        );
        ?>
			<div class="row">
				<div class="col-md-6">
	                
					<div class="form-group">
	                  <label for="tpen_jurusan" class="col-sm-3 control-label">Nana Aset:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "ta_nama";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Nama Aset"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tpen_instansi" class="col-sm-3 control-label">Tipe Aset:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "ta_tipe";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Tipe / Merek Aset"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="ta_ket" class="col-sm-3 control-label">Keterangan:</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "ta_ket";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Keterangan Aset"
			                );
			                echo form_textarea($arrInput);
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
