      <div class="row">
        <div class="col-xs-12">


          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Struktur Organisasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            	<ul class="nav nav-tabs">
            		<?php foreach($ctlArrTab as $key => $arrVal) { ?>

            			<?php 
            			$active = '';
            			if ($ctlActiveTab == $key) {
            				$active = 'class="active"';
            			}
            			?>
					  <li role="presentation" <?php echo $active; ?>>
					  	<a href="<?php echo $arrVal["url"]; ?>">
					  		<?php echo $arrVal["display"]; ?>
					  	</a>
					  </li>
				  	<?php } ?>
				</ul>
              	<?php
              	
				$arrLine = explode("\n", $ctlDataText);

				$arrValid = array();
				foreach($arrLine as $key => $val) {
					$arrVal = explode(":", $val);
					$arrValid[] = $arrVal;
				}

				$template = array(
			        'table_open'  => '<table class="table table-bordered table-hover dataTable">'

				);

				$this->table->set_template($template);
				echo $this->table->generate($arrValid); 

				?>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
      </div>