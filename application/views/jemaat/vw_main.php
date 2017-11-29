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
                     <a href="<?php echo base_url("index.php/jemaat/form/"); ?>" class="btn btn-warning">
                        <i class="glyphicon glyphicon-plus"></i> Tambah Data
                     </a>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                      Nama
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                      Jenis Kelamin
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                      Tgl. Lahir
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                      Status Menikah
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                      Gereja
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>
                
                
                <?php
                  $ctlArrData = array(
                      array(
                        "tj_nama" => "Donking Tandayu",
                        "tj_jk" => "Pria",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Lajang",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      ),
                      array(
                        "tj_nama" => "Bill Ratar",
                        "tj_jk" => "Pria",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Lajang",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      ),
                      array(
                        "tj_nama" => "Christie Mamentu",
                        "tj_jk" => "Wanita",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Lajang",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      ),
                      array(
                        "tj_nama" => "Anita Rumawouw-Tandayu",
                        "tj_jk" => "Wanita",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Menika",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      ),
                      array(
                        "tj_nama" => "Rhenaldy Pandey",
                        "tj_jk" => "Pria",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Lajang",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      ),
                      array(
                        "tj_nama" => "Maya Lowing-Gerungan",
                        "tj_jk" => "Wanita",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Menikah",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      ),
                      array(
                        "tj_nama" => "Jouns Najoan",
                        "tj_jk" => "Pria",
                        "tj_tgl_lahir" => "28 Februari 1961",
                        "tj_status_menikah" => "Menikah",
                        "tj_gereja" => "GPdI Immanuel Rerer-satu",
                      )

                  );

                ?>
                
                <?php foreach($ctlArrData as $key => $arrVal) { ?>
                <tr role="row" class="odd">
                  <td><?php echo $arrVal["tj_nama"]; ?></td>
                  <td><?php echo $arrVal["tj_jk"]; ?></td>
                  <td><?php echo $arrVal["tj_tgl_lahir"]; ?></td>
                  <td><?php echo $arrVal["tj_status_menikah"]; ?></td>
                  <td><?php echo $arrVal["tj_gereja"]; ?></td>
                  <td>
                    <div class="input-group-btn">
                        <a href="<?php echo base_url("index.php/jemaat/form/"); ?>" class="btn btn-warning btn-xs">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="<?php echo base_url("index.php/jemaat/profile/"); ?>" class="btn btn-default btn-xs">
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

              <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
      </div>