
<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data Gereja</h3>
	</div>
	<form class="form-horizontal"
		action="<?php echo $ctlUrlSubmit; ?>"
      	method="post">
      	
		<div class="box-body">
			<?php
				echo form_hidden(
					"tg_id", 
         			misc_helper::get_form_value(
          				$ctlArrData, "tg_id"
          			)
      			);
      			echo form_hidden(
					"tgem_id", 
         			misc_helper::get_form_value(
          				$ctlArrData, "tgem_id"
          			)
      			);
			?>
				<div class="row">
					<div class="col-md-6">
		                <div class="form-group">
		                  <label for="tg_nama" class="col-sm-3 control-label">Nama</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "tg_nama";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Nama Gereja"
		                  		);
		                  		echo form_input(
		                  			$id, 
		                  			misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			),
		                  			$arrAttr
		                  		);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tg_lokasi" class="col-sm-3 control-label">
		                  		Alamat
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "tg_lokasi";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Alamat Gereja"
		                  		);
		                  		echo form_input(
		                  			$id, 
		                  			misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			),
		                  			$arrAttr
		                  		);
                  			?>
		                  </div>
		                </div>


		                <div class="form-group">
		                  	<label for="tg_tgl_berdiri" class="col-sm-3 control-label">
		                  		Tgl. Berdiri
	                  		</label>

		                  <div class="col-sm-9">
		                  	<div class="input-group">
		                    <?php

		                  		$id = "tg_tgl_berdiri";
		                  		$arrAttr = array(
		                  			"class" => "form-control datepicker",
		                  			"id" => $id,
		                  			"placeholder" => "Tanggal Berdiri",
		                  			"data-date-format" => "yyyy-mm-dd"
		                  		);
		                  		echo form_input(
		                  			$id, 
		                  			misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			),
		                  			$arrAttr
		                  		);
                  			?>
		                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_nama" class="col-sm-3 control-label">
		                  		Gembala Sidang
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "tgem_nama";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Nama Gembala",
		                  			"disabled" => "disabled"
		                  		);
		                  		echo form_input(
		                  			$id, 
		                  			misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			),
		                  			$arrAttr
		                  		);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">
		                  		Wilayah
	                  		</label>

		                  <div class="col-sm-9">
		                    	<?php

		                  			$id = "tw_id";
		                  			$val = misc_helper::get_form_value(
		                  				$ctlArrData, "tw_id"
		                  			);

		                  			$arrAttr = array(
		                  				"class" => "form-control select2",
		                  				"id" => $id,
		                  				"style" => "width: 100%;"
		                  			);

		                  			if ($ctlUserType == "md") {
			                  			echo form_dropdown(
			                  				$id, $ctlArrMw, $val, $arrAttr
			                  			);	
		                  			} else {
		                  				$arrAttr = array(
				                  			"class" => "form-control",
				                  			"disabled" => "disabled"
				                  		);

				                  		if (isset($ctlArrMw[$ctlArrData["tw_id"]])) {
					                  		echo form_input(
					                  			"", 
					                  			$ctlArrMw[$ctlArrData["tw_id"]],
					                  			$arrAttr
					                  		);	
				                  		}
		                  			}

	                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tg_jadwal_ibadah" class="col-sm-3 control-label">
		                  		Jadwal Ibadah
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "tg_jadwal_ibadah";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Jadwal Ibadah"
		                  		);
		                  		echo form_textarea(
		                  			$id, 
		                  			misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			),
		                  			$arrAttr
		                  		);
                  			?>
		                  </div>
		                </div>

					</div>

				</div>
			
		</div>
		<div class="box-footer">
			<div class="col-md-12" style="text-align:center">
			    <button type="submit" class="btn btn-default">Cancel</button>
			    <button type="submit" class="btn btn-info">
			    	<i class="glyphicon glyphicon-saved"></i> Simpan
		    	</button>
		    </div>
	  	</div>
 	</form>
</div>