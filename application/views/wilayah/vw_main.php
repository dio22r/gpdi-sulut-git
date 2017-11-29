      
      <div class="row">
        <div class="col-xs-12">


          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data Wilayah</h3>

              <div class="box-tools">

                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                     <a href="<?php echo base_url("index.php/wilayah/form/"); ?>" class="btn btn-warning disabled">
                        <i class="glyphicon glyphicon-plus"></i> Tambah Data
                     </a>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div>
              </div>


              <div class="row">

                <div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th width="5%">
                      No.
                    </th>
                    <th width="5%">
                      Kode
                    </th>
                    <th width="15%">
                      Nama Wilayah
                    </th>
                    <th  width="25%">
                      Kabupaten / Kota
                    </th>
                    <th  width="15%">
                      Jumlah Gereja
                    </th>
                    <th  width="5%">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>
                
                
                <?php foreach($ctlArrData as $key => $arrVal) { ?>
                <tr role="row" class="odd">
                  <td><?php echo $ctlStart + $key; ?></td>
                  <td><?php echo $arrVal["tw_nomor_induk"]; ?></td>
                  <td><?php echo $arrVal["tw_nama"]; ?></td>
                  <td><?php echo $arrVal["tkab_nama"]; ?></td>
                  <td><?php echo $arrVal["total"]; ?></td>
                  <td>
                    <div class="input-group-btn">
                        <a href="<?php echo $arrVal["editUrl"]; ?>"
                            class="btn btn-warning btn-xs">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="<?php echo $arrVal["profileUrl"]; ?>" class="btn btn-default btn-xs">
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

                <div class="row" style="text-align: center;">
                  <ul class="pagination pagination-sm no-margin">
                  <?php echo $ctlPaging; ?>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /.box-body -->

          </div>


        </div>
        <!-- /.col -->
      </div>