

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data User</h3>
	</div>
	<form class="form-horizontal" method="post"
		autocomplete="off"
		action="<?php echo $ctlUrlSubmit; ?>" >
		<div class="box-body">
				<?php
					echo form_hidden(
						"tg_id", 
             			misc_helper::get_form_value(
              				$ctlArrData, "tg_id"
              			)
          			);
				?>

				<?php if($ctlStatErr == true) { ?>
				<div class="alert alert-danger alert-dismissible">
	                <h4><i class="icon fa fa-ban"></i> Maaf ada kesalahan!</h4>
	                <?php echo ul($ctlArrErr); ?>
              	</div>
				<?php } ?>
 				
 				<?php if($ctlStatSubmit) { ?>
				<div class="alert alert-success alert-dismissible">
	                <h4><i class="icon fa fa-ok"></i> Oke data telah tersimpan</h4>
              	</div>
 				<?php } ?>
				<div class="row">

				</div>

				<div class="row">
					<div class="col-md-6">
		                

		                <div class="form-group">
		                  	<label for="tg_nama" class="col-sm-4 control-label">
		                  		Nama Gereja
	                  		</label>

		                  <div class="col-sm-8">
		                  	<?php
		                  		$id = "tg_nama";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Nama Gereja",
		                  			
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
		                  	<label for="tgem_nama" class="col-sm-4 control-label">
		                  		Nama Gembala
	                  		</label>

		                  <div class="col-sm-8">
		                  	<?php

		                  		$id = "tgem_nama";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Nama Gembala"
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
		                  	<label for="tgem_no_telp" class="col-sm-4 control-label">
		                  		No. Telp Gembala
	                  		</label>

		                  <div class="col-sm-8">
                    		<?php

		                  		$id = "tgem_no_telp";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Telephone Gembala"
		                  		);
		                  		echo form_input(
		                  			$id,
		                  			misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			), $arrAttr
		                  		);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group mw-dropdown">
		                  	<label for="tw_id" class="col-sm-4 control-label">
		                  		Wilayah
	                  		</label>

			                  <div class="col-sm-8">
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

		                  			echo form_dropdown(
		                  				$id, $ctlArrMw, $val, $arrAttr
		                  			);
	                  			?>
			                  </div>
		                </div>


					</div>

				</div>
			
		</div>
		<div class="box-footer">
			<div class="col-md-6" style="text-align:center">
			    <a href="<?php echo $ctlUrlCancel; ?>"
		    		type="submit" class="btn btn-default">Cancel</a>
			    <button type="submit" class="btn btn-info">
			    	<i class="glyphicon glyphicon-saved"></i> Simpan
		    	</button>
		    </div>
	  	</div>
 	</form>
</div>