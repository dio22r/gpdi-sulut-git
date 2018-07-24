<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-warning">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle"
              src="<?php echo $ctlUrlImg; ?>" alt="User profile picture">

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
                  <b>Tempat Lahir</b> <a class="pull-right">
                    <?php echo $ctlArrData["tj_tempat_lahir"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Lahir</b> <a class="pull-right">
                    <?php echo misc_helper::format_idDate($ctlArrData["tj_tgl_lahir"]); ?>
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
                <li class="list-group-item">
                  <b>Golongan Darah</b> <a class="pull-right">
                    <?php echo $ctlArrData["tj_gol_darah"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Alamat</b>
                  <p class="text-muted">
                    <?php echo $ctlArrData["alamat"]; ?>
                  </p>
                </li>
                <li class="list-group-item">
                  <b> &nbsp;   </b> <a href="#" class="btn btn-xs btn-success pull-right">
                    lebih detail
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
        <div class="col-md-4">
          
          <!-- About Me Box -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Kerohanian</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              
              <strong><i class="fa fa-child margin-r-5"></i> Diserahkan : </strong>
              <?php echo $ctlArrData["tj_akt_peny_str"]; ?>

              <?php if ($ctlArrData["tj_akt_peny_status"]) { ?>
              <p>
                Tanggal Diserahkan : <?php echo $ctlArrData["tj_akt_peny_tgl"]; ?> <br />
                Oleh : <?php echo $ctlArrData["tj_akt_peny_dilayani_oleh"]; ?> <br />
                di Jemaat : <?php echo $ctlArrData["tj_akt_peny_jemaat"]; ?> <br />
              </p>

              <?php } ?>
              <hr>

              <strong><i class="fa fa-life-ring margin-r-5"></i> Dibaptis : </strong>
              <?php echo $ctlArrData["tj_akt_bap_str"]; ?>

              <?php if ($ctlArrData["tj_akt_bap_status"]) { ?>
              <p>
                Tanggal Dibaptis : <?php echo $ctlArrData["tj_akt_bap_tgl"]; ?> <br />
                Oleh : <?php echo $ctlArrData["tj_akt_bap_dilayani"]; ?> <br />
                di Jemaat : <?php echo $ctlArrData["tj_akt_bap_jemaat"]; ?> <br />
              </p>

              <?php } ?>
              <hr >

              <strong><i class="fa fa-leaf margin-r-5"></i> Wadah </strong> : 
                <?php echo $ctlArrData["tj_roh_wadah"]; ?>


            </div>
          </div>
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Organisasi Gereja</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if (count($ctlArrData["arrOrgGereja"]) > 0) { ?>
              <table class="table table-bordered table-hover">
                  <tr>
                    <th>Jabatan</th>
                    <th>Lingkup</th>
                    <th>Tahun</th>
                    <th></th>
                  </tr>
                <?php foreach($ctlArrData["arrOrgGereja"] as $key => $arrVal) { ?>
                  <tr>
                    <td>
                      <?php echo $arrVal["tog_jabatan"]; ?> <br/>
                      <?php echo $arrVal["tog_bidang"]; ?>
                    </td>
                    <td><?php echo $ctlArrLingkup[$arrVal["tog_lingkup"]]; ?></td>
                    <td>
                      <?php
                        $tahun = " - ";
                        if ($arrVal["tog_tahun_start"] != 0) {
                            $tahun = $arrVal["tog_tahun_start"];

                            if ($arrVal["tog_tahun_end"] == 0) {
                                $tahun .= " - Sekarang";
                            } else {
                                $tahun .= " - " . $arrVal["tog_tahun_end"];
                            }
                        }

                        echo $tahun;

                        $text = "Anda yakin ingin menghapus data ini -- Jabatan "
                          .$arrVal["tog_jabatan"]." ".$arrVal["tog_bidang"]."?";

                      ?>
                    </td>
                    <td>
                      <a href="<?php echo $ctlArrData["urlOrgGereja"]."/".$arrVal["tog_id"];?>"
                        class="btn btn-xs btn-default">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="<?php echo $ctlArrData["urlOrgGerejaDel"]."/".$arrVal["tog_id"];?>"
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
              <a href="<?php echo $ctlArrData["urlOrgGereja"]; ?>" class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus"></i> Tambah Data
              </a>

            </div>
          </div>

          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Pelayanan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if (count($ctlArrData["arrPelayanan"]) > 0) { ?>
              <table class="table table-bordered table-hover">
                  <tr>
                    <th>Nama Pelayanan</th>
                    <th>Tahun</th>
                    <th></th>
                  </tr>
                <?php foreach($ctlArrData["arrPelayanan"] as $key => $arrVal) { ?>
                  <tr>
                    <td><?php echo $arrVal["tp_nama"]; ?></td>
                    <td>
                      <?php
                        $tahun = " - ";
                        if ($arrVal["tp_tahun_mulai"] != 0) {
                            $tahun = $arrVal["tp_tahun_mulai"];

                            if ($arrVal["tp_tahun_selesai"] == 0) {
                                $tahun .= " - Sekarang";
                            } else {
                                $tahun .= " - " . $arrVal["tp_tahun_selesai"];
                            }
                        }

                        echo $tahun;

                        $text = "Anda yakin ingin menghapus data ini -- Pelayanan "
                          .$arrVal["tp_nama"]."?";
                        
                      ?>
                    </td>

                    <td>
                      <a href="<?php echo $ctlArrData["urlPelayanan"]."/".$arrVal["tp_id"];?>"
                        class="btn btn-xs btn-default">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="<?php echo $ctlArrData["urlPelayananDel"]."/".$arrVal["tp_id"];?>"
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
              <a href="<?php echo $ctlArrData["urlPelayanan"]; ?>" class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus"></i> Tambah Data
              </a>

            </div>
          </div>

        </div>

        <div class="col-md-5">
          
        <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Pekerjaan</h3>
            </div>

            <div class="box-body">

              <?php if ($ctlArrData["tj_pk_pekerjaan"]) { ?>
              <strong><i class="fa fa-suitcase margin-r-5"></i> Pekerjaan</strong>
              <p>
                <?php echo $ctlArrData["tj_pk_pekerjaan"]; ?> di
                <?php echo $ctlArrData["tj_pk_nama_ins"]; ?> <br />
                Gaji : Rp. <?php echo number_format($ctlArrData["tj_pk_penghasilan"]); ?>

              </p>

              <hr>
              <?php } ?>

<!--
              <strong><i class="fa fa-suitcase margin-r-5"></i> Pekerjaan Tambahan</strong>
              <p>
                Freelance Programmer
              </p>

-->
            </div>
            <!-- /.box-body -->
          </div>

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat Pendidikan</h3>
            </div>

            <div class="box-body">
              <?php if (count($ctlArrData["arrPendidikan"]) > 0) { ?>
              <table class="table table-bordered table-hover">
                  <tr>
                    <th>Tingkat Pendidikan</th>
                    <th>Instansi</th>
                    <th>Tahun</th>
                    <th> </th>
                  </tr>
                <?php foreach($ctlArrData["arrPendidikan"] as $key => $arrVal) { ?>
                  <tr>
                    <td>
                    <?php
                      echo $arrVal["tpen_tingkat"];
                      if ($arrVal["tpen_jurusan"]) {
                        echo " (".$arrVal["tpen_jurusan"].")";
                      }
                    ?>
                    </td>
                    <td><?php echo $arrVal["tpen_instansi"]; ?></td>
                    <td>
                      <?php
                        $tahun = " - ";
                        if ($arrVal["tpen_tahun_mulai"] != 0) {
                            $tahun = $arrVal["tpen_tahun_mulai"];

                            if ($arrVal["tpen_tahun_selesai"] == 0) {
                                $tahun .= " - Sekarang";
                            } else {
                                $tahun .= " - " . $arrVal["tpen_tahun_selesai"];
                            }
                        }

                        echo $tahun;

                        $text = "Anda yakin ingin menghapus data ini -- Pendidikan tingkat "
                          .$arrVal["tpen_tingkat"]."?";
                        
                      ?>
                    </td>

                    <td>
                      <a href="<?php echo $ctlArrData["urlPendidikan"]."/".$arrVal["tpen_id"];?>"
                        class="btn btn-xs btn-default">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="<?php echo $ctlArrData["urlPendidikanDel"]."/".$arrVal["tpen_id"];?>"
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

              <a href="<?php echo $ctlArrData["urlPendidikan"]; ?>" class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus"></i> Tambah Data
              </a>
          </div>
        </div>


        <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Organisasi Lainnya</h3>
            </div>

            <div class="box-body">
             
              <?php if (count($ctlArrData["arrOrgLain"]) > 0) { ?>
              <table class="table table-bordered table-hover">
                  <tr>
                    <th>Nama Organisasi</th>
                    <th>Jabatan</th>
                    <th>Tahun</th>
                    <th></th>
                  </tr>
                <?php foreach($ctlArrData["arrOrgLain"] as $key => $arrVal) { ?>
                  <tr>
                    <td>
                      <?php echo $arrVal["tol_nama"]; ?>
                    </td>
                    <td><?php echo $arrVal["tol_jabatan"]; ?></td>
                    <td>
                      <?php
                        $tahun = " - ";
                        if ($arrVal["tol_tahun_mulai"] != 0) {
                            $tahun = $arrVal["tol_tahun_mulai"];

                            if ($arrVal["tol_tahun_selesai"] == 0) {
                                $tahun .= " - Sekarang";
                            } else {
                                $tahun .= " - " . $arrVal["tol_tahun_selesai"];
                            }
                        }

                        echo $tahun;

                        $text = "Anda yakin ingin menghapus data ini -- Organisasi "
                          .$arrVal["tol_nama"]."?";
                      ?>
                    </td>
                    <td>
                      <a href="<?php echo $ctlArrData["urlOrgLain"]."/".$arrVal["tol_id"];?>"
                        class="btn btn-xs btn-default">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="<?php echo $ctlArrData["urlOrgLainDel"]."/".$arrVal["tol_id"];?>"
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

              <a href="<?php echo $ctlArrData["urlOrgLain"]; ?>" class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus"></i> Tambah Data
              </a>

            </div>
            <!-- /.box-body -->
          </div>


        <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Aset</h3>
            </div>

            <div class="box-body">
             
             <?php if (count($ctlArrData["arrAset"]) > 0) { ?>
              <table class="table table-bordered table-hover">
                  <tr>
                    <th>Nama Aset</th>
                    <th>Keterangan</th>
                    <th></th>
                  </tr>
                <?php foreach($ctlArrData["arrAset"] as $key => $arrVal) { ?>
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
                      <a href="<?php echo $ctlArrData["urlAset"]."/".$arrVal["ta_id"];?>"
                        class="btn btn-xs btn-default">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="<?php echo $ctlArrData["urlAsetDel"]."/".$arrVal["ta_id"];?>"
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
              <a href="<?php echo $ctlArrData["urlAset"]; ?>"
                class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus"></i> Tambah Data
              </a>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>