<div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">
                Wilayah <?php echo $ctlArrData["tw_nomor_induk"] . " " . $ctlArrData["tw_nama"]; ?>
              </h3>

              <p class="text-muted text-center"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Kabupaten / Kota</b>
                  <a class="pull-right"><?php echo $ctlArrData["tkab_nama"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Jumlah Gereja</b>
                  <a class="pull-right"><?php echo $ctlArrData["total"]; ?></a>
                </li>          
              </ul>

              <a href="<?php echo $ctlUrlEdit; ?>" class="btn btn-warning btn-block">
                <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Wilayah</b>
              </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- About Me Box -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-calendar margin-r-5"></i> Struktur Organisasi</strong>

              <p class="text-muted">
                <?php

                $jadwal = $ctlArrData["tw_struktur_organisasi"];

                echo nl2br($jadwal);
                ?>

              </p>

              <hr>

              <strong><i class="fa fa-server margin-r-5"></i> Inventaris Wilayah</strong>

              <p class="text-muted">
                <?php

                $inventaris = $ctlArrData["tw_inventaris"];
                
                echo nl2br($inventaris);
                ?>

              </p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <!-- /.col -->
        <div class="col-md-8">
          
         
          
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>