<div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">
                Wilayah 
                <?php
                  echo $ctlArrData["tw_nomor_induk"] . " ";
                  echo $ctlArrData["tw_nama"];
                ?>
              </h3>

              <p class="text-muted text-center"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Kabupaten / Kota</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["tkab_nama"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Jumlah Gereja</b>
                  <a class="pull-right">
                    <?php echo $ctlCountGereja; ?>
                  </a>
                </li>          
              </ul>

              <?php if ($ctlEditStat) { ?>
              <a href="<?php echo $ctlUrlEdit; ?>"
                  class="btn btn-warning btn-block">
                <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Wilayah</b>
              </a>  
              <?php } ?>
              
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

            </div>
            <!-- /.box-body -->
          </div>

        <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-server margin-r-5"></i> Inventaris Wilayah</h3>
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
                      <a href="<?php echo $ctlUrlBase."/form_aset/".$ctlArrData["tw_id"]."/".
                        $arrVal["ta_id"];?>"
                        class="btn btn-xs btn-default">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="<?php echo $ctlUrlBase."/delete_aset/".$ctlArrData["tw_id"]."/".
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
              <a href="<?php echo $ctlUrlBase."/form_aset/". $ctlArrData["tw_id"]; ?>"
                class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus"></i> Tambah Data
              </a>


            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-8">
          
          <!-- About Me Box -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-header">
              <h3 class="box-title">Daftar Gereja</h3>
            </div>

            <div class="box-body">
              

              <table class="table table-bordered table-hover">
                <thead>
                <tr role="row">
                    <th width="40%">
                      Nama Gereja
                    </th>
                    <th  width="35%">
                      Gembala
                    </th>
                    <th width="15%">
                      Jumlah
                    </th>
                    <th width="10%">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>

                  <?php foreach ($ctlArrGereja as $key => $arrVal) { ?>
                    <tr>
                      <td><?php echo $arrVal["tg_nama"]; ?></td>
                      <td><?php echo $arrVal["tgem_nama"]; ?></td>
                      <td><?php echo $arrVal["total"]; ?> Jiwa</td>
                      <td>

                        <?php
                          $urlEdit = $ctlUrlBaseTbl."/form/".$arrVal["tg_id"];
                          $urlView = $ctlUrlBaseTbl."/profile/".$arrVal["tg_id"];
                         ?>
                          <div class="input-group-btn">
                              <a href="<?php echo $urlEdit; ?>"
                                class="btn btn-warning btn-xs">
                                  <span class="glyphicon glyphicon-edit"></span>
                              </a>
                              <a href="<?php echo $urlView; ?>" class="btn btn-default btn-xs">
                                  <span class="glyphicon glyphicon-eye-open"></span>
                              </a>
                          </div>
                        </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>