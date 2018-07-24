<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="http://127.0.0.1/workspace/gpdi-sulut/assets/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">
                <?php echo $ctlArrData["tgem_nama"]; ?>
              </h3>

              <p class="text-muted text-center">
                <?php echo $ctlArrData["tg_nama"]; ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No. Telp</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["tgem_no_telp"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Umur</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["age"]; ?> tahun
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Lama Penggembalaan</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["lama_gembala"]; ?> tahun
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Jenis Kelamin</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["tgem_jk"]; ?>
                  </a>
                </li>
              </ul>

              <a href="<?php echo $ctlUrlEdit; ?>" class="btn btn-warning btn-block">
                <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Gembala</b>
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

              <strong><i class="fa fa-calendar margin-r-5"></i> Tempat Lahir, Tanggal Lahir</strong>

              <p>
                <?php
                  echo $ctlArrData["tgem_tpt_lahir"] .", ".
                      $ctlArrData["tgem_tgl_lahir"];
                ?>
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>

              <?php if ($ctlArrData["tgem_pend_umum"] != "") { ?>
              <p class="text-muted">
                <b>Pendidikan umum :</b>
                <?php
                  echo $ctlArrData["tgem_pend_umum_gelar"] . " - " . $ctlArrData["tgem_pend_umum"];
                ?>
              </p>
              <?php } ?>

              <?php if ($ctlArrData["tgem_pend_theo"] != "") { ?>
              <p class="text-muted">
                <b>Pendidikan Theologia :</b>
                <?php
                  echo $ctlArrData["tgem_pend_theo_gelar"] . " - " . $ctlArrData["tgem_pend_theo"];
                ?>
              </p>
              <?php } ?>

              <?php if ($ctlArrData["tgem_sa_tkt1"] != "") { ?>
              <p class="text-muted">
                <b>Sekolah Alkitab Tingkat 1 :</b>
                <?php
                  echo $ctlArrData["tgem_sa_tkt1"] . " - " . $ctlArrData["tgem_sa_tkt1_thn"];
                ?>
              </p>
              <?php } ?>

              <?php if ($ctlArrData["tgem_sa_tkt2"] != "") { ?>
              <p class="text-muted">
                <b>Sekolah Alkitab Tingkat 2 :</b>
                <?php
                  echo $ctlArrData["tgem_sa_tkt2"] . " - " . $ctlArrData["tgem_sa_tkt2_thn"];
                ?>
              </p>
              <?php } ?>
              <hr>

              <strong>
                <i class="fa fa-map-marker margin-r-5"></i> Domisili
              </strong>

              <p class="text-muted">
                <?php echo $ctlArrData["tgem_alamat_pelayanan"]?>
              </p>

              <hr>

              <strong>
                <i class="fa fa-pencil margin-r-5"></i> Status Pernikahan
              </strong>

              <p>
                <?php echo $ctlArrData["tgem_status_nikah"]; ?>
              </p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> 
                Catatan Pelayanan
              </strong>

              <p>
                <b>Penggembalaan Pertama:</b>
                <?php
                  echo $ctlArrData["tgem_pgbl_pertama"];
                  echo " (Tahun: ". $ctlArrData["tgem_pgbl_pertama_thn"] .")";
                ?>
                <br />
                <b>Penggembalaan Sekarang:</b>
                <?php
                  echo $ctlArrData["tgem_pgbl_skrg"];
                  echo " (Tahun: ". $ctlArrData["tgem_pgbl_skrg_thn"] .")";
                ?>

              </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-book margin-r-5"></i> Riwayat Pendidikan
              </h3>
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

          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>