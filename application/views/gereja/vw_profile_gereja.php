<div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">
                <?php echo $ctlArrData["tg_nama"] ?>
              </h3>

              <p class="text-muted text-center">
                <?php echo $ctlArrData["tgem_nama"] ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Wilayah</b>
                  <a class="pull-right">
                  <?php
                    echo $ctlArrData["tw_nomor_induk"] . " "
                      . $ctlArrData["tw_nama"];
                  ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Contact</b> <a class="pull-right">
                    <?php echo $ctlArrData["tgem_no_telp"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Tgl Berdiri</b> <a class="pull-right">
                    <?php echo misc_helper::format_idDate($ctlArrData["tg_tgl_berdiri"]); ?>
                  </a>
                </li>                
              </ul>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Lokasi</strong>

              <p class="text-muted">
                <?php echo $ctlArrData["tg_lokasi"]; ?>
              </p>

              <hr>

              <a href="<?php echo $ctlUrlEdit; ?>" class="btn btn-warning btn-block">
                <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Gereja</b>
              </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-8">
          
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-calendar margin-r-5"></i> Jadwal Ibadah</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <p class="text-muted">
                <?php

                $jadwal = " - Data Belum Di Isi -";

                if ($ctlArrData["tg_jadwal_ibadah"]) {
                  $jadwal = $ctlArrData["tg_jadwal_ibadah"];
                }
                echo nl2br($jadwal);
                ?>

              </p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-server margin-r-5"></i> Inventaris Gereja</h3>
            </div>

            <div class="box-body">
               
               <?php if (count($ctlArrAset) > 0) { ?>
                <table class="table table-bordered table-hover">
                    <tr>
                      <th>Nama Aset</th>
                      <th>Keterangan</th>
                      <th></th>
                    </tr>
                  <?php foreach($ctlArrAset as $key => $arrVal) { ?>
                    <tr>
                      <td>
                        <?php echo $arrVal["ta_nama"]; ?>
                      </td>
                      <td><?php echo $arrVal["ta_ket"]; ?></td>

                      <?php
                          $text = "Anda yakin ingin menghapus data ini -- Aset "
                            .$arrVal["ta_nama"]."?";
                      ?>
                      <td>
                        <a href="<?php echo $ctlUrlBase."/form_aset/".$ctlArrData["tg_id"]."/".
                          $arrVal["ta_id"];?>"
                          class="btn btn-xs btn-default">
                          <i class="fa fa-pencil"></i>
                        </a>

                        <a href="<?php echo $ctlUrlBase."/delete_aset/".$ctlArrData["tg_id"]."/".
                          $arrVal["ta_id"];?>"
                          onclick="return confirm('<?php echo $text; ?>');"
                          class="btn btn-xs btn-default">
                          <i class="fa fa-times"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </table>
                
                <?php } else { ?>
                  <div class="callout callout-warning">
                    <h4>Data Masih Kosong.</h4>
                  </div>
                <?php } ?>

                <hr />
                <a href="<?php echo $ctlUrlBase."/form_aset/". $ctlArrData["tg_id"]; ?>"
                  class="btn btn-xs btn-success pull-right">
                  <i class="fa fa-plus"></i> Tambah Data
                </a>


              </div>
              <!-- /.box-body -->
            </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>