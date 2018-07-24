      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">
                <div class="margin">
                    <div class="input-group-btn">
                      <a href="#" class="btn btn-primary">
                          Semua Data
                      </a>
                      <a href="#" class="btn btn-default">
                          Gembala
                      </a>
                      <a href="#" class="btn btn-default">
                          Ibu/Bpk. Rohani
                      </a>
                   </div>
                 </div>
               </p>
            </div>
            
          </div>

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data Gembala</h3>

              <div class="box-tools">

                <form method=post>
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control pull-right" 
                    value="<?php echo $ctlPlainSearch; ?>"
                    placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      <?php if($ctlAddDisable) { ?>
                       <a href="<?php echo $ctlEditUrl; ?>" class="btn btn-warning">
                          <i class="glyphicon glyphicon-plus"></i> Tambah Data
                       </a>
                      <?php } ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th width="5%">
                      No.
                    </th>
                    <th width="30%">
                      Nama Gembala
                    </th>
                    <th width="10%">
                      Jenis Kelamin
                    </th>
                    <th width="10%">
                      Umur
                    </th>
                    <th width="10%">
                      Tanggal Lahir
                    </th>
                    <th width="10%">
                      Status Nikah
                    </th>
                    <th width="25%">
                      Tempat Pelayanan
                    </th>
                    <th width="10%">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>
                
                
                <?php foreach($ctlArrData as $key => $arrVal) { ?>
                <tr role="row" class="odd">
                  <td ><?php echo ($ctlStart + $key + 1); ?></td>
                  <td class="sorting_1"><?php echo $arrVal["tgem_nama"]; ?></td>
                  <td><?php echo $arrVal["tgem_jk"]; ?></td>

                  <td><?php echo ($arrVal["age"]) ? $arrVal["age"] . " thn" : "-"; ?></td>
                  <td><?php echo misc_helper::format_idDate($arrVal["tgem_tgl_lahir"]); ?></td>
                  <td><?php echo $arrVal["tgem_status_nikah"]; ?></td>
                  <td><?php echo $arrVal["tg_nama"]; ?></td>
                  <td>
                    <div class="input-group-btn">
                        <a href="<?php echo $ctlEditUrl . $arrVal["tgem_id"]; ?>" class="btn btn-warning btn-xs">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="<?php echo $ctlProfileUrl . $arrVal["tgem_id"]; ?>" class="btn btn-default btn-xs">
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
                  <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                    <?php
                      echo ($ctlStart + 1) ." - ".
                        ($ctlStart + $ctlPerpage) . " dari ". $ctlCount ." data";
                    ?>
                    </div>
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