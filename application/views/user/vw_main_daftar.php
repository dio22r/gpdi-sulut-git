      <div class="row">
        <div class="col-xs-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Table Data User Mendaftar</h3>

                
                <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Menu</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li ><a href="<?php echo $ctlBaseUrl; ?>">Semua User</a></li>
                        <li class="active"><a href="#">Pendaftar</a></li>
                        </li>
                      </ul>

                      <form class="navbar-form navbar-right">
                        <div class="form-group">
                          <input type="text" name="table_search" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        
                         <a href="<?php echo base_url("index.php/user/form/"); ?>" class="btn btn-warning">
                            <i class="glyphicon glyphicon-plus"></i>
                         </a>
                      
                      </form>
                      
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="row">
                  <div class="col-sm-12">
                    <table id="example2"class="table table-bordered table-hover dataTable" role="grid" >
                <thead>
                <tr role="row">
                    <th width="5%">No.</th>
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
                  <td><?php echo $ctlStart + $key; ?></td>
                  <td class="sorting_1"><?php echo $arrVal["tu_username"]; ?></td>
                  <td><?php echo $arrVal["tu_display_name"]; ?></td>
                  <td><?php echo $ctlArrTipe[$arrVal["tu_tipe_user"]]; ?></td>
                  <td><?php echo $arrVal["tg_nama"]; ?></td>
                  <td>
                    <?php
                      if ($arrVal["tu_status"] == 0) {
                        $class = "btn-danger";
                      } elseif ($arrVal["tu_status"] == 1) {
                        $class = "btn-success";
                      } elseif ($arrVal["tu_status"] == 2) {
                        $class = "btn-warning";
                      } else {
                        $class = "";
                      }

                    ?>
                    <a href="<?php echo $ctlActifasiUrl . $arrVal["tu_id"] . "/" . $arrVal["tu_status"] . "/" . $ctlEncUrl ?>"
                      class="btn-xs <?php echo $class; ?>">
                    <?php echo $ctlArrStatus[$arrVal["tu_status"]]; ?>
                    </a>
                  </td>
                  <td>
                    <?php
                      //list($date, $time) = explode(" ", $arrVal["tu_registered"]);
                      //echo misc_helper::format_idDate($date) . " " . $time;

                      echo $arrVal["tu_registered"];
                    ?>
                      
                  </td>
                  <td>
                    <div class="input-group-btn">
                        <a href="<?php echo $ctlFormUrl.$arrVal["tu_id"]; ?>" class="btn btn-warning btn-xs">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="<?php echo $ctlProfileUrl.$arrVal["tu_id"]; ?>" class="btn btn-default btn-xs">
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
                      echo "Showing ". $ctlStart ." to ". ($ctlStart - 1 + $ctlLimit) ." of ". $ctlTotal ." entries";
                      ?>
                  </div>
                </div>
                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">
                      <?php echo $ctlPaging; ?>
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