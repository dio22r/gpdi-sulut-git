      <div class="row">
        <div class="col-xs-12">


          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data Jemaat</h3>

              <div class="box-tools">

                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                     <a href="<?php echo $ctlUrlAdd; ?>"
                      class="btn btn-warning">
                        <i class="glyphicon glyphicon-plus"></i> Tambah Anggota
                     </a>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                      <tr role="row">
                            <th>No. </th>
                          <?php foreach($ctlArrSortHeader as $key => $arrVal) { ?>
                            <th class="<?php echo $arrVal["class"]; ?>">
                                <a href="<?php echo $arrVal["href"]; ?>" style="display:block;" >
                                  <?php echo $arrVal["text"]; ?>
                                </a>
                            </th>
                          <?php } ?>
                      </tr>
                      </thead>
                      <tbody>

                      <?php foreach($ctlArrData as $key => $arrVal) { ?>
                      <tr role="row" class="odd">
                        <td><?php echo $ctlStart + $key + 1; ?></td>
                        <td><?php echo $arrVal["tj_nama"]; ?></td>
                        <td><?php echo $ctlArrJk[$arrVal["tj_jk"]]; ?></td>
                        <td><?php echo $arrVal["age"]; ?> thn</td>
                        <td><?php echo misc_helper::format_idDate($arrVal["tj_tgl_lahir"]); ?></td>
                        <td><?php echo $ctlStsNikah[$arrVal["tj_status_nikah"]]; ?></td>
                        <td><?php echo $arrVal["tg_nama"]; ?></td>
                        <td>
                          <div class="input-group-btn">
                              <a href="<?php echo $ctlUrlEdit .$arrVal["tg_id"]."/".$arrVal["tj_id"]; ?>" class="btn btn-default btn-xs">
                                  <span class="glyphicon glyphicon-edit" style="color:#f39c12"></span>
                              </a>
                              <a href="#delete<?php echo $arrVal["tj_id"]; ?>" class="btn btn-default btn-xs delete" data-target="#myModal" data-toggle= "modal" data-id="<?php echo $arrVal["tj_id"]; ?>">
                                  <span class="glyphicon glyphicon-trash" style="color:red"></span>
                              </a>
                              <a href="<?php echo $ctlUrlProfile.$arrVal["tj_id"]; ?>"
                                  class="btn btn-default btn-xs">
                                  <span class="glyphicon glyphicon-eye-open" style="color:#337ab7"></span>
                              </a>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>

                      </tbody>
                
                    </table>
                  </div>
                </div>

              <div class="row">
                <div class="col-sm-5">
                  
                </div>
                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">
                      <?php echo $ctlPagination; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
      </div>

      <script>
        var apiUrlProfileJemaat = "<?php echo $ctlUrlProfileJemaat ?>";       

      </script>


<form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">
      <div class="modal fade" tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Mutasi Jemaat</h4>
            </div>
            <div class="modal-body">
              <table class="table">
                  <tbody>
                    <tr>
                      <th style="width:40%">Nama : </th>
                      <td class="data-nama"></td>
                    </tr>
                    <tr>
                      <th>Tgl. Lahir :</th>
                      <td class="data-tgl-lahir">-</td>
                    </tr>
                    <tr>
                      <th>Umur :</th>
                      <td class="data-umur">- tahun</td>
                    </tr>
                    <tr>
                      <th>Jenis Kelamin :</th>
                      <td class="data-jk">-</td>
                    </tr>
                    <tr>
                      <th>Gereja :</th>
                      <td class="data-gereja">-</td>
                    </tr>
                </tbody>
              </table>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="tjm_tipe" class="col-sm-3 control-label">
                      Tipe Mutasi :
                    </label>

                    <div class="col-sm-9">
                      <?php
                        $arrAttr = array(
                            'type'  => 'hidden',
                            'name'  => 'tj_id',
                            'id'    => 'tj_id',
                            'value' => '0',
                            'class' => 'tj_id'
                        );
                        echo form_input($arrAttr);


                        $arrAttr = array(
                            'type'  => 'hidden',
                            'name'  => 'cur_url',
                            'id'    => 'cur_url',
                            'value' => $ctlCurUrl,
                            'class' => 'cur_url'
                        );
                        echo form_input($arrAttr);

                        $id = "tjm_tipe";
                        $val = misc_helper::get_form_value(
                          $ctlArrData, $id
                        );

                        $arrAttr = array(
                          "class" => "form-control",
                          "id" => $id,
                          "style" => "width: 100%;"
                        );

                        $arrSelect = array(
                          "5" => "Hapus Data",
                          "1" => "Meninggal",
                          "2" => "Pindah Jemaat",
                          "3" => "Pindah Gereja",
                          "4" => "Pindah Agama"
                        );

                        echo form_dropdown(
                          $id, $arrSelect, $val, $arrAttr
                        );
                  ?>
                    </div>
                  </div>

                   <div class="form-group">

                      <div class="meninggal">
                        <label for="tjm_tgl_mutasi" class="col-sm-3 control-label tjm_tgl_mutasi">
                          Tgl. Mutasi :
                        </label>

                        <div class="col-sm-9">

                        <?php
                          $id = "tjm_tgl_mutasi";
                          $arrInput = array(
                            'name'          => $id,
                            'id'            => $id,
                            'class'         => "form-control datepicker",
                            'value'         => misc_helper::get_form_value(
                              $ctlArrData, $id),
                            'placeholder'   => "Tanggal Meninggal",
                            "data-date-format" => "yyyy-mm-dd",
                            "autocomplete" => "off"
                          );
                          echo form_input($arrInput);
                        ?>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="pindah">
                      <label for="tjm_ket" class="col-sm-3 control-label">Keterangan :</label>

                      <div class="col-sm-9">

                      <?php
                        $id = "tjm_ket";
                        $arrInput = array(
                          'name'          => $id,
                          'id'            => $id,
                          'class'         => "form-control",
                          'value'         => misc_helper::get_form_value(
                            $ctlArrData, $id),
                          'placeholder'   => "Keterangan Atas Mutasi Jemaat",
                          'required' => 'required'
                        );
                        echo form_textarea($arrInput);
                      ?>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Ya, Mutasikan</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
</form>