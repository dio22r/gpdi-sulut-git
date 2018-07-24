

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data User</h3>

		<div class="box-tools">

          
             <a href="<?php echo $ctlUrlGereja; ?>" class="btn btn-warning">
                <i class="glyphicon glyphicon-plus"></i> Data Gereja
             </a>

        </div>
      </div>
	<form class="form-horizontal" method="post"
		autocomplete="off"
		action="<?php echo $ctlUrlEdit; ?>" >
		<div class="box-body">
				<?php
					echo form_hidden(
						"tkab_id", 
             			misc_helper::get_form_value(
              				$ctlArrKab, "tkab_id"
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
		                  	<label for="tgem_nama" class="col-sm-4 control-label">
		                  		Nama Kabupaten
	                  		</label>

		                  <div class="col-sm-8">
		                  	<?php

		                  		$id = "tkab_nama";
		                  		$arrAttr = array(
		                  			"class" => "form-control disable",
		                  			"id" => $id,
		                  			"disabled" => "disabled"
		                  		);
		                  		echo form_input(
		                  			$id, 
		                  			misc_helper::get_form_value(
		                  				$ctlArrKab, $id
		                  			),
		                  			$arrAttr
		                  		);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tg_nama" class="col-sm-4 control-label">
		                  		Jumlah Dewasa
	                  		</label>

		                  <div class="col-sm-8">
		                  	<?php
		                  		$id = "tkab_total_dewasa";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Total Dewasa",
		                  			
		                  		);
		                  		echo form_input(
		                  			$id,
		                  			misc_helper::get_form_value(
		                  				$ctlArrKab, $id
		                  			),
		                  			$arrAttr
	                  			);
                  			?>
		                  </div>
		                </div>

		                <div class="form-group">
		                  	<label for="tgem_no_telp" class="col-sm-4 control-label">
		                  		Jumlah Anak-anak
	                  		</label>

		                  <div class="col-sm-8">
                    		<?php

		                  		$id = "tkab_total_anak";
		                  		$arrAttr = array(
		                  			"class" => "form-control",
		                  			"id" => $id,
		                  			"placeholder" => "Total Anak-anak"
		                  		);
		                  		echo form_input(
		                  			$id,
		                  			misc_helper::get_form_value(
		                  				$ctlArrKab, $id
		                  			), $arrAttr
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
		    		type="submit" class="btn btn-default">Reset</a>
			    <button type="submit" class="btn btn-info">
			    	<i class="glyphicon glyphicon-saved"></i> Simpan
		    	</button>
		    </div>
	  	</div>
 	</form>
</div>

<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Data Kabupaten</h3>
	</div>

	<div class="box-body">
		<table class="table table-bordered table-hover">
            <thead>
            <tr role="row">
                <th  width="30%">
                  Nama Kab. / Kota
                </th>
                <th width="20%">
                  Dewasa
                </th>
                <th width="20%">
                  Anak-anak
                </th>
                <th width="20%">
                  Total
                </th>
                <th width="10%">
                  Edit
                </th>
            </tr>
            </thead>
            <tbody>

              <?php foreach ($ctlArrData as $key => $arrVal) { ?>
                <tr>
                  <td><?php echo $arrVal["tkab_nama"]; ?></td>
                  <td><?php echo $arrVal["tkab_total_dewasa"]; ?></td>
                  <td><?php echo $arrVal["tkab_total_anak"]; ?></td>
                  <td><?php echo $arrVal["total"]; ?></td>

                  <td>
                  	<?php

                  		$urlEdit = $ctlUrlEdit . $arrVal["tkab_id"];
              			echo anchor(
              				$urlEdit, 'Edit',
              				array('class' => 'btn btn-xs btn-warning')
              			);

                  	?>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
        </table>
	</div>
</div>