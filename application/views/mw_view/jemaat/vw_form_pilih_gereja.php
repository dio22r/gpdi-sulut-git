
<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Form Input Data Jemaat</h3>
	</div>
	<div class="box-body">
		
		<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Perhatian!</h4>
            <p>Sebelum melakukan pengisian data jemaat, silahkan <strong>Pilih Gereja</strong> terlebih dahulu</p>
          </div>

		<?php
		foreach($ctlArrGereja as $key => $arrVal) {
			if ($key % 2 == 1) {
				$btn = "btn-default";
			} else {
				$btn = "btn-default";
			}

			$arrAttr = array(
				//"class" => "btn ".$btn." btn-block btn-lg"
				"class" => "btn btn-block btn-social btn-default btn-lg"
			);
			$url = $ctlUrl . $arrVal["tg_id"];
			echo anchor($url, $arrVal["tg_nama"], $arrAttr);
		}
		?>
	</div>
</div>