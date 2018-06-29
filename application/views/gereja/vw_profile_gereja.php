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
                    <?php echo $ctlArrData["tg_tgl_berdiri"]; ?>
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
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-calendar margin-r-5"></i> Jadwal Ibadah</strong>

              <p class="text-muted">
                <?php

                $jadwal = "Minggu, Pkl 08.00 ~ Ibadah Raya - di Gereja
                Minggu, Pkl 08.00 ~ Sekolah Minggu - di Gereja
                Minggu, Pkl 19.00 ~ Ibadah P.S. Immanuel

                Senin, Pkl. 18.00 ~ Doa Bidston - di Gereja

                Selasa, Pkl. 15.00 ~ Ibadah Pelwap - di

                Rabu, Pkl. 14.00 ~ Doa dan Puasa Umum - di Gereja
                Rabu, Pkl. 19.00 ~ Ibadah Pelprip - di 

                Kamis, Pkl. 15.00 ~ KCA - di 
                Kamis, Pkl. 19.00 ~ Ibadah Kamis Malam - di Gereja

                Jumat, Pkl. 14.00 ~ Doa dan Puasa Umum/Masal - di Gereja
                Jumat, Pkl. 19.00 ~ Ibadah Pelprap & Kel. Muda - di 

                Sabtu, Pkl. 17.00 ~ Doa & Latihan Pelayan Altar untuk Ibadah Raya - di Gereja";

                if ($ctlArrData["tg_jadwal_ibadah"]) {
                  $jadwal = $ctlArrData["tg_jadwal_ibadah"];
                }
                echo nl2br($jadwal);
                ?>

              </p>

              <hr>

              <strong><i class="fa fa-server margin-r-5"></i> Inventaris Gereja</strong>

              <p class="text-muted">
                <?php

                $inventaris = " - Gedung Gereja
                - Peralatan Musik
                - Pastori";
                
                if ($ctlArrData["tg_inventaris"]) {
                  $inventaris = $ctlArrData["tg_inventaris"];
                }

                echo nl2br($inventaris);
                ?>

              </p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>