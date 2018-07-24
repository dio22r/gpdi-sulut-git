<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Daftar Anggota Kelompok</h3>
		<p class="text-muted"> <?php echo $ctlSubTitle; ?> </p>

      <div class="box-tools">

<!--
        <div class="input-group input-group-sm" style="width: 250px;">
          <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

          <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </div>

        </div>
-->
	</div>
	<form class="form-horizontal"
      method="post">
		<div class="box-body">

			<div class="row">
				<div class="col-md-12">
	                <div class="form-group">
	                  <label for="tjk_nama" class="col-sm-4 control-label">
	                  	Nama  :
	                  </label>
	                  
	                  <div class="col-sm-6">
	                  	<div class="input-group input-group-sm">
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
              				<div class="input-group-btn">
		                    <button type="submit" class="btn btn-primary" href="#">
		                        <i class="fa fa-fw fa-plus"></i>
		                        Tambahkan
		                    </button>
		                	</div>
              			</div>
	                  </div>
	                </div>

                </div>

                <div class="col-md-12">

                	<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
	                        <tr role="row">
	                            <th >No.</th>
	                            <th >Nama</th>
	                            <th >Umur</th>
	                            <th >Jenis Kelamin</th>
	                            <th >Status Nikah</th>
	                            <th >Action</th>
	                        </tr>
                        </thead>

                        <tbody>
                		<?php foreach($ctlArrDetail as $key => $arrVal) { ?>
	                		<tr role="row" class="odd">
	                          <td><?php echo $key + 1; ?></td>
	                          <td><?php echo $arrVal["tj_nama"]; ?></td>
	                          <td><?php echo $arrVal["tj_umur"]; ?></td>
	                          <td><?php echo $ctlArrJk[$arrVal["tj_jk"]]; ?></td>
	                          <td>
	                          	<?php echo $ctlArrStsNikah[$arrVal["tj_status_nikah"]]; ?>
                          	  </td>
	                          <td>
	                          	<?php
	                              $msg = "Anda ingin Menghapus data " . $arrVal["tj_nama"]
	                              	. " dari ". $arrVal["tjkp_nama"] ."?";
	                            ?>
	                            <a href="<?php echo $ctlUrlDelete.$arrVal["tjkpt_id"]; ?>"
	                                class="btn btn-danger btn-xs"
	                                onclick='return confirm("<?php echo $msg ?>")'>
	                                <span class="fa fa-trash"></span>
	                            </a>
	                          </td>
	                        </tr>
                		<?php } ?>
                		</tbody>
                	</table>

            	</div>
            </div>
        </div>

    </form>
</div>
