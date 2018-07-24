

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data Wilayah</h3>
	</div>
	<form class="form-horizontal" method="post"
		action="<?php echo $ctlUrlSubmit; ?>" >
		<div class="box-body">

                <input type="hidden" name="tw_id"
                	value="<?php echo misc_helper::get_form_value($ctlArrData, "tw_id"); ?>">			
				
				<div class="row">
					<div class="col-md-6">
		                <div class="form-group">
		                  <label for="tw_nomor_induk" class="col-sm-3 control-label">Kode Wilayah</label>

		                  <div class="col-sm-9">
		                    <input name="tw_nomor_induk" class="form-control"
		                    id="tw_nomor_induk" placeholder="Kode Wilayah"
		                    value="<?php echo misc_helper::get_form_value($ctlArrData, "tw_nomor_induk"); ?>">
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="tw_nama" class="col-sm-3 control-label">Nama Wilayah</label>

		                  <div class="col-sm-9">
		                    <input name="tw_nama" class="form-control"
		                    id="tw_nama" placeholder="Nama"
		                    value="<?php echo misc_helper::get_form_value($ctlArrData, "tw_nama"); ?>">
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tw_lokasi" class="col-sm-3 control-label">
		                  		Kabupaten / Kota
	                  		</label>

		                  <div class="col-sm-9">
		                  	<?php
		                  		$arrOption = array(
		                  			"class" => "form-control"
		                  		);
		                  		$tempId = misc_helper::get_form_value(
	                  				$ctlArrData, "tkab_id"
	                  			);
		                  		echo form_dropdown(
		                  			"tkab_id", $ctlArrKab, $tempId, $arrOption
		                  		);
		                  	?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tw_struktur_organisasi" class="col-sm-3 control-label">
		                  		Struktur Organisasi
	                  		</label>

		                  <div class="col-sm-9">
		                    <textarea name="tw_struktur_organisasi" id="tw_struktur_organisasi" class="form-control" rows="10" placeholder="Strkutur Organisasi ..."><?php echo misc_helper::get_form_value($ctlArrData, "tw_struktur_organisasi"); ?></textarea>
		                  </div>
		                </div>

					</div>
					
				</div>
			
		</div>
		<div class="box-footer">
			<div class="col-md-12" style="text-align:center">
			    <a href="<?php echo $ctlUrlCancel; ?>"
			    	class="btn btn-default">Cancel</a>
			    <button type="submit" class="btn btn-info">
			    	<i class="glyphicon glyphicon-saved"></i> Simpan
		    	</button>
		    </div>
	  	</div>
 	</form>
</div>