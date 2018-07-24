<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Daftar Keluarga</h3>
	</div>
	<form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">
		<div class="box-body">
		
		<?php	
        echo form_hidden(
          "tjk_id", misc_helper::get_form_value($ctlArrData, "tjk_id")
        );
        ?>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
	                  <label for="tjk_nama" class="col-sm-6 control-label">
	                  	Nama Keluarga :
	                  </label>

	                  <div class="col-sm-6">
	                  	
			              <?php
			                $id = "tjk_nama";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control disabled",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'disabled'   => "disabled"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label for="tjk_nama" class="col-sm-6 control-label">
	                  	Nama Anggota Keluarga :
	                  </label>
	                  
	                  <div class="col-sm-6">
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
                </div>
            </div>
        </div>

		  <div class="box-footer">

		    <div class="col-sm-12">
		      <a href="<?php echo $ctlUrlBack; ?>"
		        class="btn btn-default" >
		        Kembali Ke Daftar Anggota
		      </a>
		      <button class="btn btn-primary" type="submit">
		          Simpan
		      </button>
		    </div>

		  </div>

    </form>
</div>
