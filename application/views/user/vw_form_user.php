

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data User</h3>
	</div>
	<form class="form-horizontal" method="post"
		action="<?php echo $ctlUrlSubmit; ?>" >
		<div class="box-body">
				<?php
					echo form_hidden(
						"tu_id", 
             			misc_helper::get_form_value(
              				$ctlArrData, "tu_id"
              			)
          			);
				?>

				<?php if($ctlStatErr == true) { ?>
				<div class="alert alert-danger alert-dismissible">
	                <h4><i class="icon fa fa-ban"></i> Maaf ada kesalahan!</h4>
	                <?php echo ul($ctlArrErr); ?>
              	</div>
				<?php } ?>

				<div class="row">

				</div>

				<div class="row">
					<div class="col-md-6">
		                <div class="form-group">
		                  <label for="tu_display_name" class="col-sm-4 control-label">Nama Pengguna</label>

		                  <div class="col-sm-8">
		                  	<?php

		                  		$id = "tu_display_name";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Nama Pengguna"
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
		                  	<label for="tu_username" class="col-sm-4 control-label">
		                  		Username (login)
	                  		</label>

		                  <div class="col-sm-8">
		                  	<?php
		                  		$id = "tu_username";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Username"
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
		                  	<label for="password_baru" class="col-sm-4 control-label">
		                  		Password
	                  		</label>

		                  <div class="col-sm-8">
		                  	<?php

		                  		$id = "password_baru";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Password Baru",
		                  			"type" => "password"
		                  		);
		                  		echo form_password($id, "", $arrAttr);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="password_confirm" class="col-sm-4 control-label">
		                  		Konfirmasi Password
	                  		</label>

		                  <div class="col-sm-8">
                    		<?php

		                  		$id = "password_confirm";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Konfirmasi Password",
		                  			"type" => "password"
		                  		);
		                  		echo form_password($id, "", $arrAttr);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tu_tipe_user" class="col-sm-4 control-label">
		                  		Tipe Pengguna
	                  		</label>

			                  <div class="col-sm-8">
		                  		<?php
		                  			$id = "tu_tipe_user";
		                  			$val = misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			);

		                  			$arrAttr = array(
		                  				"class" => "form-control ".$id,
		                  				"id" => $id
		                  			);

		                  			echo form_dropdown(
		                  				$id, $ctlArrTipe, $val, $arrAttr
		                  			);
	                  			?>
			                  </div>
		                </div>

		                <div class="form-group mw-dropdown">
		                  	<label for="tipe_id_wil" class="col-sm-4 control-label">
		                  		Majelis Wilayah
	                  		</label>

			                  <div class="col-sm-8">
		                  		<?php
		                  			$id = "tipe_id_wil";
		                  			$val = misc_helper::get_form_value(
		                  				$ctlArrData, "tu_tipe_id"
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

		                <div class="form-group gem-dropdown">
		                  	<label for="tipe_id_grj" class="col-sm-4 control-label">
		                  		Gereja
	                  		</label>

			                  <div class="col-sm-8">
		                  		<?php
		                  			$id = "tipe_id_grj";
		                  			$val = misc_helper::get_form_value(
		                  				$ctlArrData, "tu_tipe_id"
		                  			);

		                  			$arrAttr = array(
		                  				"class" => "form-control",
		                  				"id" => $id
		                  			);

		                  			echo form_dropdown(
		                  				$id, $ctlArrTipe, $val, $arrAttr
		                  			);
	                  			?>
			                  </div>
		                </div>
		                <div class="form-group">
		                  	<label for="tu_status" class="col-sm-4 control-label">
		                  		Status
	                  		</label>

			                  <div class="col-sm-8">
		                  		<?php
		                  			$id = "tu_status";
		                  			$val = misc_helper::get_form_value(
		                  				$ctlArrData, $id
		                  			);

		                  			$arrAttr = array(
		                  				"class" => "form-control",
		                  				"id" => $id
		                  			);

		                  			$arrStatus = array(
		                  				1 => "Aktif",
		                  				0 => "Non-Aktif"
		                  			);
		                  			echo form_dropdown(
		                  				$id, $arrStatus, $val, $arrAttr
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