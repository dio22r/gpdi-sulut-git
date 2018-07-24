<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Daftar Keluarga</h3>
	</div>
	<form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">
		<div class="box-body">
		
		<?php
		$idKey = misc_helper::get_form_value($ctlArrData, "tjk_id");
        echo form_hidden(
          "tjk_id", misc_helper::get_form_value($ctlArrData, "tjk_id")
        );
        ?>
			<div class="row">
				<div class="col-md-12">
	                <div class="form-group">
	                  <label for="tjk_nama" class="col-sm-3 control-label">
	                  	Nama Keluarga :
	                  </label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tjk_nama";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Nama Keluarga"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

					<div class="form-group">
	                  <label for="tjk_no_kk" class="col-sm-3 control-label">No. KK :</label>

	                  <div class="col-sm-9">

			              <?php
			                $id = "tjk_no_kk";
			                $arrInput = array(
			                  'name'          => $id,
			                  'id'            => $id,
			                  'class'         => "form-control",
			                  'value'         => misc_helper::get_form_value(
			                    $ctlArrData, $id),
			                  'placeholder'   => "Nomor Kartu Keluarga"
			                );
			                echo form_input($arrInput);
			              ?>
	                  </div>
	                </div>

                </div>

                <div class="col-md-12">
            	

                	<?php if ($ctlArrDetail) { ?>

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
	                              $msg = "Anda ingin Menghapus data " . $arrVal["tjk_nama"]
	                              	. " dari ". $arrVal["tjk_nama"] ."?";
	                            ?>
	                            <a href="<?php echo $ctlUrlDelete.$arrVal["tjkt_id"]; ?>"
	                                class="btn btn-danger btn-xs"
	                                onclick='return confirm("<?php echo $msg ?>")'>
	                                <span class="fa fa-trash"></span>
	                            </a>
	                          </td>
	                        </tr>
                		<?php } ?>
                		</tbody>
                	</table>

	                    <a class="btn btn-warning" href="<? echo $ctlUrlAdd; ?>">
	                        <i class="fa fa-fw fa-plus"></i>
	                        Tambah Anggota Keluarga
	                    </a>

                	<?php } else { ?>

                		<?php if ($idKey != "") { ?>
                		<div class="alert alert-info alert-dismissible">
			                <h4><i class="icon fa fa-info"></i> Belum Ada Data!</h4>
			                Data Anggota Keluarga belum ada. Silahkan menambahkan data terlebih dahulu.
			            </div>
	                    <a class="btn btn-warning" href="<? echo $ctlUrlAdd; ?>">
	                        <i class="fa fa-fw fa-plus"></i>
	                        Tambah Anggota Keluarga
	                    </a>
 
	                	<?php } ?>
	            	<?php } ?>

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
