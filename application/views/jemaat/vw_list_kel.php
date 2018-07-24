      <div class="row">
        <div class="col-xs-12">


          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data Keluarga</h3>

              <div class="box-tools">

                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                     <a href="<?php echo $ctlUrlAdd; ?>"
                      class="btn btn-warning">
                        <i class="glyphicon glyphicon-plus"></i> Tambah Data
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
                            <th >No.</th>
                            <th >Nama</th>
                            <th >No. KK</th>
                            <th >Jmlh. Anggota</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($ctlArrData as $key => $arrVal) { ?>
                        <tr role="row" class="odd">
                          <td><?php echo $ctlStart + $key; ?></td>
                          <td><?php echo $arrVal["tjk_nama"]; ?></td>
                          <td><?php echo $arrVal["tjk_no_kk"]; ?></td>
                          <td><?php echo $arrVal["total"]; ?> Jiwa</td>
                          <td>
                            <div class="input-group-btn">
                                <a href="<?php echo $ctlUrlEdit .$arrVal["tjk_id"]; ?>"
                                    class="btn btn-warning btn-xs">
                                    <span class="fa fa-fw fa-edit"></span>
                                </a>
                                <a href="<?php echo $ctlUrlAddAnggota .$arrVal["tjk_id"]; ?>"
                                    class="btn btn-primary btn-xs">
                                    <span class="fa fa-fw fa-plus"></span>
                                </a>
                                <?php
                                  $msg = "Anda ingin Menghapus data " .
                                        $arrVal["tjk_nama"] . " ?";
                                ?>
                                <a href="<?php echo $ctlUrlDelete.$arrVal["tjk_id"]; ?>"
                                    class="btn btn-danger btn-xs"
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