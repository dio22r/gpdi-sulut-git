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
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                      <tr role="row">
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
                        <td><?php echo $arrVal["tj_nama"]; ?></td>
                        <td><?php echo $ctlArrJk[$arrVal["tj_jk"]]; ?></td>
                        <td><?php echo $arrVal["age"]; ?> thn</td>
                        <td><?php echo misc_helper::format_idDate($arrVal["tj_tgl_lahir"]); ?></td>
                        <td><?php echo $ctlStsNikah[$arrVal["tj_status_nikah"]]; ?></td>
                        <td>
                          <div class="input-group-btn">
                              <a href="<?php echo $ctlUrlEdit .$arrVal["tg_id"]."/".$arrVal["tj_id"]; ?>" class="btn btn-warning btn-xs">
                                  <span class="glyphicon glyphicon-edit"></span>
                              </a>
                              <a href="<?php echo $ctlUrlProfile.$arrVal["tj_id"]; ?>"
                                  class="btn btn-default btn-xs">
                                  <span class="glyphicon glyphicon-eye-open"></span>
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