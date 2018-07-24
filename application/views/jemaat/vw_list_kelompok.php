      <div class="row">
        <div class="col-xs-12">


          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data Kelompok</h3>

              <div class="box-tools">

                <div class="input-group input-group-sm" >
                  
                     <a href="#"
                      class="btn btn-warning tambah-data">
                        <i class="glyphicon glyphicon-plus"></i> Tambah Kelompok
                     </a>

                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
                  <form class="form-horizontal"
                      action="<?php echo $ctlUrlSubmit; ?>"
                      method="post">
                      <?php
                        echo form_hidden(
                          "tjkp_id", misc_helper::get_form_value($ctlArrDetail, "tjkp_id")
                        );
                      ?>

                    <?php
                      $display = 'style="display: none"';
                      if ($ctlArrDetail) {
                        $display = "";
                      }
                    ?>

                    <div class="row form-horizontal form-kelompok" <?php echo $display; ?>>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="tjkp_nama" class="col-sm-4 control-label">
                            Nama Kelompok
                          </label>

                          <div class="col-sm-6">
                            <div class="input-group input-group-sm">
                              <?php
                                $id = "tjkp_nama";
                                $arrInput = array(
                                  'name'          => $id,
                                  'id'            => $id,
                                  'class'         => "form-control",
                                  'value'         => misc_helper::get_form_value(
                                    $ctlArrDetail, $id),
                                  'placeholder'   => "Nama Kelompok"
                                );
                                echo form_input($arrInput);
                              ?>

                              <div class="input-group-btn">
                                 <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-save"></i> Simpan
                                 </button>
                              </div>

                            </div>
                          </div>
                        </div>

                        <hr />
                      </div>
                    </div>

                  </form>

                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th >No.</th>
                            <th >Nama Kelompok</th>
                            <th >Jmlh. Anggota</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($ctlArrData as $key => $arrVal) { ?>
                        <tr role="row" class="odd">
                          <td><?php echo $ctlStart + $key; ?></td>
                          <td><?php echo $arrVal["tjkp_nama"]; ?></td>
                          <td><?php echo $arrVal["total"]; ?> Jiwa</td>
                          <td>
                            <div class="input-group-btn">
                                <a href="<?php echo $ctlUrlSubmit .$arrVal["tjkp_id"]; ?>"
                                    class="btn btn-warning btn-sm">
                                    <span class="fa fa-fw fa-edit"></span>
                                </a>
                                <a href="<?php echo $ctlUrlAddAnggota .$arrVal["tjkp_id"]; ?>"
                                    class="btn btn-primary btn-sm">
                                    <span class="fa fa-fw fa-plus"></span>
                                </a>
                                <?php
                                  $msg = "Anda ingin Menghapus data " .
                                        $arrVal["tjkp_nama"] . " ?";
                                ?>
                                <a href="<?php echo $ctlUrlDelete.$arrVal["tjkp_id"]; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick='return confirm("<?php echo $msg ?>")'>
                                    <span class="fa fa-fw fa-trash"></span>
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