
<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Ubah Password</h3>
	</div>
	<form class="form-horizontal"
		action="<?php echo $ctlUrlSubmit; ?>"
      	method="post">
      	
		<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<?php if ($ctlArrRet) { ?>
							<?php

								if ($ctlArrRet["status"]) {
									$callout = "callout-success";
								} else {
									$callout = "callout-danger";
								}
							?>

							<div class="callout <?php echo $callout; ?>">
				                <h4><?php echo $ctlArrRet["title"]; ?></h4>
				                <p><?php echo $ctlArrRet["msg"]; ?></p>
			              	</div>

			            <?php } ?>
		                <div class="form-group">
		                  <label for="tg_nama" class="col-sm-3 control-label">Password Lama</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "pwd_lama";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Password Lama",
		                  			"type" => "password"
		                  		);
		                  		echo form_password($id, "",$arrAttr);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tg_lokasi" class="col-sm-3 control-label">
		                  		Password Baru
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "pwd_baru";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Password Baru"
		                  		);
		                  		echo form_password($id, "",$arrAttr);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_nama" class="col-sm-3 control-label">
		                  		Ulangi Password Baru
	                  		</label>

		                  <div class="col-sm-9">
		                    <?php

		                  		$id = "pwd_baru_ulang";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Ulangi Password Baru"
		                  		);
		                  		echo form_password($id, "",$arrAttr);
                  			?>
		                  </div>
		                </div>
	                </div>

			</div>
		<div class="box-footer">
			<div class="col-md-6" style="text-align:center">
			    <button type="submit" class="btn btn-default">Cancel</button>
			    <button type="submit" class="btn btn-info">
			    	<i class="glyphicon glyphicon-saved"></i> Simpan
		    	</button>
		    </div>
	  	</div>
 	</form>
</div>