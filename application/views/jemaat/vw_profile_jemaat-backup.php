<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="http://127.0.0.1/workspace/gpdi-sulut/assets/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">
                <?php echo $ctlArrData["tj_nama"]; ?>
              </h3>

              <p class="text-muted text-center">
                <?php echo $ctlArrData["tg_nama"]; ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No. Telp</b> <a class="pull-right">
                    <?php echo $ctlArrData["tj_no_telp"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Umur</b> <a class="pull-right">
                    <?php echo $ctlArrData["age"]; ?> tahun
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Jenis Kelamin</b> <a class="pull-right">
                    <?php echo $ctlArrData["tj_jk"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Status Pernikahan</b> <a class="pull-right">
                    <?php echo $ctlArrData["tj_status_nikah"]; ?>
                  </a>
                </li>
                
              </ul>

              <a href="<?php echo $ctlUrlEdit; ?>"
                class="btn btn-warning btn-block">
                <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Jemaat</b>
              </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-calendar margin-r-5"></i> Tanggal Lahir</strong>

              <p>
                <?php echo $ctlArrData["tj_tgl_lahir"]; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Tempat Lahir</strong>

              <p>
                <?php echo $ctlArrData["tj_tempat_lahir"]; ?>
              </p>

              <hr>

              <strong><i class="fa fa-calendar margin-r-5"></i> Tanggal Baptis</strong>

              <p>
                <?php echo $ctlArrData["tj_akt_bap_tgl"]; ?>
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Pendidikan Umum</strong>

              <p class="text-muted">
                <?php if ($ctlArrData["tj_pd_um_tingkat"] == "") { ?>
                  -
                <?php } else { ?>
                <?php echo $ctlArrData["tj_pd_um_tingkat"]; ?>,
                <?php echo $ctlArrData["tj_pd_um_jurusan"]; ?> <br />
                <?php echo $ctlArrData["tj_pd_um_nama_ins"]; ?> <br />
                <?php echo $ctlArrData["tj_pd_um_alamat_ins"]; ?> <br />
                <?php echo $ctlArrData["tj_pd_um_telp_ins"]; ?>
                <?php } ?>
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Pendidikan Theologia</strong>

              <p class="text-muted">
                <?php if ($ctlArrData["tj_pd_teo_tingkat"] == "") { ?>
                  -
                <?php } else { ?>
                <?php echo $ctlArrData["tj_pd_teo_tingkat"]; ?>,
                <?php echo $ctlArrData["tj_pd_teo_jurusan"]; ?> <br />
                <?php echo $ctlArrData["tj_pd_teo_nama_ins"]; ?> <br />
                <?php echo $ctlArrData["tj_pd_teo_alamat_ins"]; ?> <br />
                <?php echo $ctlArrData["tj_pd_teo_telp_ins"]; ?>
                <?php } ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Domisili</strong>

              <p class="text-muted">
                <?php echo $ctlArrData["tj_al_desa"]; ?>, 
                Kec. <?php echo $ctlArrData["tj_al_kec"]; ?>,
                <?php echo $ctlArrData["tj_al_kab_kodya"]; ?> -
                <?php echo $ctlArrData["tj_al_propinsi"]; ?>
                </p>

              <hr>

              <strong><i class="fa fa-suitcase margin-r-5"></i> Pekerjaan</strong>

              <p>
                <?php echo $ctlArrData["tj_pk_pekerjaan"]; ?>
              </p>

              <hr>

              <strong><i class="fa fa-life-saver margin-r-5"></i> Wadah </strong>

              <p>
                <?php echo $ctlArrData["tj_roh_wadah"]; ?>
              </p>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>