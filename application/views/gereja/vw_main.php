      <div class="row">
        <div class="col-xs-12">


          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data Gereja</h3>

              <div class="box-tools">
                <form method="post" action="<?php echo $ctlUrlSearch; ?>">
                  <div class="input-group input-group-sm" style="width: 250px;">
                  
                    <input type="text" name="table_search"
                      value="<?php echo $ctlPlainSearch; ?>"
                      class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      <?php if ($ctlUserType == "md" || $ctlUserType == "admin") { ?>
                       <a href="<?php echo $ctlUrlForm ?>"
                          class="btn btn-warning">
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
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">

                <table class="table table-bordered table-hover">
                <thead>
                <tr role="row">
                    <th width="5%">
                      No.
                    </th>
                    <th width="25%">
                      Nama Gereja
                    </th>
                    <th width="15%">
                      Alamat
                    </th>
                    <th  width="10%">
                      Tanggal Berdiri
                    </th>
                    <th  width="20%">
                      Gembala
                    </th>
                    <th width="10%">
                      Wilayah
                    </th>
                    <th width="10%">
                      Jumlah
                    </th>
                    <th width="5%">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>
                
                                
                <?php foreach($ctlArrData as $key => $arrVal) { ?>

                <?php
                    $wilayah = $arrVal["tw_nomor_induk"] . " "
                        . $arrVal["tw_nama"];
                ?>
                <tr role="row" class="odd">
                  <td><?php echo $ctlStart + $key + 1; ?></td>
                  <td><?php echo $arrVal["tg_nama"]; ?></td>
                  <td><?php echo $arrVal["tg_lokasi"]; ?></td>
                  <td><?php echo $arrVal["tg_tgl_berdiri"]; ?></td>
                  <td><?php echo $arrVal["tgem_nama"]; ?></td>
                  <td><?php echo $wilayah; ?></td>
                  <td><?php echo $arrVal["total"]; ?> Jiwa</td>
                  <td>
                    <div class="input-group-btn">
                        <a href="<?php echo $ctlUrlSearch . "/form/" . $arrVal["tg_id"]; ?>" class="btn btn-warning btn-xs">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="<?php echo $ctlUrlSearch . "/profile/" . $arrVal["tg_id"]; ?>" class="btn btn-default btn-xs">
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
                  <ul class="pagination pagination-sm no-margin">
                  <?php echo $ctlPaging ?>
                  </ul>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
      </div>