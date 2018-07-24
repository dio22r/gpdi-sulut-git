<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Mutasi Jemaat</h3>
	</div>
	<form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">
		<div class="box-body">
			
		<?php if ($ctlArrReturn["postStatus"]) { ?>
			<?php if ($ctlArrReturn["status"]) { ?>
			<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
	            <?php echo $ctlArrReturn["msg"]; ?>
	          </div>
			<?php } else { ?>
			<div class="alert alert-danger alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-ban"></i> Maaf!</h4>
	            <?php echo $ctlArrReturn["msg"]; ?>
	          </div>
	        <?php } ?>
	    <?php } ?>
	    
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
	                  <label for="tj_id" class="col-sm-3 control-label">
	                  	Nama Jemaat :
	                  </label>
	                  
	                  <div class="col-sm-9">
	                  	<?php
                  			$id = "tj_id";
                  			$val = misc_helper::get_form_value(
                  				$ctlArrData, $id
                  			);

                  			$arrAttr = array(
                  				"class" => "form-control select2",
                  				"id" => $id,
                  				"style" => "width: 100%;"
                  			);

                  			echo form_dropdown(
                  				$id, array(), $val, $arrAttr
                  			);
              			?>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label for="tjm_tipe" class="col-sm-3 control-label">
	                  	Tipe Mutasi :
	                  </label>

	                  <div class="col-sm-9">
	                  	<?php
	                  		$id = "tjm_tipe";
                  			$val = misc_helper::get_form_value(
                  				$ctlArrData, $id
                  			);

                  			$arrAttr = array(
                  				"class" => "form-control",
                  				"id" => $id,
                  				"style" => "width: 100%;"
                  			);

                  			$arrSelect = array(
                  				"1" => "Meninggal",
                  				"2" => "Pindah Jemaat",
                  				"3" => "Pindah Gereja",
                  				"4" => "Pindah Agama",
                  				"5" => "Hapus Data"
                  			);

                  			echo form_dropdown(
                  				$id, $arrSelect, $val, $arrAttr
                  			);
			            ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tjm_ket" class="col-sm-3 control-label">Keterangan :</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tjm_ket";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Keterangan Atas Mutasi Jemaat"
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
		      <button class="btn btn-primary" type="submit">
		          Simpan
		      </button>
		    </div>

		  </div>

    </form>
</div>
