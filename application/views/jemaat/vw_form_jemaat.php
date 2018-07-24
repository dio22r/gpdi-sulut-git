

<div class="box box-warning">
  <div class="box-header">
    <h3 class="box-title">
      Jemaat di :
      <strong><u><?php echo $ctlArrGereja["tg_nama"]; ?></u></strong>
    </h3>
  </div>

  <div class="box-body">
  <form class="form-horizontal"
      action="<?php echo $ctlUrlSubmit; ?>"
      method="post">

      <?php
        echo form_hidden(
          "tj_id", misc_helper::get_form_value($ctlArrData, "tj_id")
        );

        echo form_hidden(
          "tg_id", misc_helper::get_form_value($ctlArrGereja, "tg_id")
        );
      ?>

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Data Diri</a></li>
      <li><a data-toggle="tab" href="#menu1">Alamat</a></li>
      <li><a data-toggle="tab" href="#akta">Akta</a></li>
      <!--
      <li><a data-toggle="tab" href="#pendidikan">Pendidikan</a></li>
      <li><a data-toggle="tab" href="#kerohanian">Kerohanian</a></li>
      -->
      <li><a data-toggle="tab" href="#pekerjaan">Pekerjaan</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <h3>Data Diri</h3>
        <div class="col-md-6">
          <div class="form-group">
              <label for="tj_nama" class="col-sm-3 control-label">
                Nama
              </label>

            <div class="col-sm-9">

              <?php
                $id = "tj_nama";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "Nama Lengkap"
                );
                echo form_input($arrInput);
              ?>

            </div>
          </div>
          <div class="form-group">
              <label for="tj_nik" class="col-sm-3 control-label">
                NIK
              </label>

            <div class="col-sm-9">
              
              <?php
                $id = "tj_nik";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "No. KTP"
                );
                echo form_input($arrInput);
              ?>

            </div>
          </div>
          <div class="form-group">
              <label for="tj_nkk" class="col-sm-3 control-label">
                Nomor KK
              </label>

            <div class="col-sm-9">
              
              <?php
                $id = "tj_nkk";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "No. KK"
                );
                echo form_input($arrInput);
              ?>
            </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Tempat Lahir
              </label>

            <div class="col-sm-6">
              
              <?php
                $id = "tj_tempat_lahir";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "Tempat Lahir"
                );
                echo form_input($arrInput);
              ?>
            </div>
          </div>
          <div class="form-group">
              <label for="tj_tgl_lahir" class="col-sm-3 control-label">
                Tanggal Lahir
              </label>

            <div class="col-sm-9">
              <div class="input-group">

                <?php
                $id = "tj_tgl_lahir";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control datepicker",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "Tanggal Lahir",
                  "data-date-format" => "yyyy-mm-dd",
                  "autocomplete" => "off"
                );
                echo form_input($arrInput);
                ?>

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Jenis Kelamin
            </label>

            <div class="col-sm-3">
                <?php
                $arrInput = array(
                  "class" => "form-control"
                );

                $option = array(
                  "L" => "Laki-laki",
                  "P" => "Perempuan"
                );

                echo form_dropdown("tj_jk", $option, misc_helper::get_form_value(
                    $ctlArrData, "tj_jk"), $arrInput
                )
                ?>
            </div>
            
            <label for="inputPassword3" class="col-sm-3 control-label">
              Gol. Darah
            </label>

              <div class="col-sm-3">
                <?php
                $arrInput = array(
                  "class" => "form-control"
                );

                $option = array(
                  "A" => "A",
                  "B" => "B",
                  "AB" => "AB",
                  "O" => "O"
                );

                echo form_dropdown("tj_gol_darah", $option, misc_helper::get_form_value(
                    $ctlArrData, "tj_gol_darah"), $arrInput
                )
                ?>
              </div>

          </div>


        </div>

          <div class="col-md-6">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Tinggi Badan
              </label>

              <div class="col-sm-3">

              <?php
                $id = "tj_tinggi_badan";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "Tinggi : cm"
                );
                echo form_input($arrInput);
              ?>
              </div>
            

              <label for="inputPassword3" class="col-sm-3 control-label">
                Warga Negara
              </label>

                <div class="col-sm-3">
                    <?php
                      $id = "tj_warga_negara";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "WNI / WNA"
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
            </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">
                      Status Nikah
                    </label>

                  <div class="col-sm-9">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "S" => "Singel",
                        "M" => "Menikah",
                        "J" => "Janda",
                        "D" => "Duda"
                      );

                      echo form_dropdown("tj_status_nikah", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_gol_darah"), $arrInput
                      )
                      ?>
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">
                    Nama Ayah
                  </label>

                  <div class="col-sm-9">
                      <?php
                      $id = "tj_nama_ayah";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Nama Ayah"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">
                    Nama Ibu
                  </label>

                  <div class="col-sm-9">
                      <?php
                      $id = "tj_nama_ibu";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Nama Ibu"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">
                    No. Telp
                  </label>

                  <div class="col-sm-9">
                    <?php
                      $id = "tj_no_telp";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Nomor Telepon"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

          </div>
        </div>




        <div id="menu1" class="tab-pane fade">
          <h3>Tempat Tinggal</h3>
          
          <div class="col-md-6">

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Propinsi
                  </label>

                  <div class="col-sm-8">
                    <?php
                      $id = "tj_al_propinsi";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Propinsi"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kabupaten / Kodya
                  </label>

                  <div class="col-sm-8">
                    <?php
                      $id = "tj_al_kab_kodya";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Kabupaten / Kota Madya"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kecamatan
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $id = "tj_al_kec";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Kecamatan"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kelurahan / Desa
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $id = "tj_al_desa";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Kelurahan / Desa"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dusun / Jaga / Kampung
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $id = "tj_al_jaga";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Dusun / Jaga / Kampung"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>
          </div>

          <div class="col-md-6">

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    RT / RW / RK
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $id = "tj_al_rt_rw";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "RT / RW / RK"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kode Kota
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $id = "tj_al_kode_kota";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Kode Kota"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kode Pos
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $id = "tj_al_kode_pos";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Kode Pos"
                      );
                      echo form_input($arrInput);
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kepemilikian Rumah
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "MK" => "Milik Keluarga",
                        "K" => "Kontrak",
                        "MP" => "Milik Pribadi",
                      );

                      echo form_dropdown("tj_al_kepemilikan_rumah", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_al_kepemilikan_rumah"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kondisi Bangunan
                  </label>

                  <div class="col-sm-8">
                    <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "B" => "Baik",
                        "KB" => "Kurang Baik",
                      );

                      echo form_dropdown("tj_al_kondisi_bangunan", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_al_kondisi_bangunan"), $arrInput
                      )
                      ?>
                  </div>
                </div>
          </div>
        </div>

        <div id="akta" class="tab-pane fade">
          <h3>Riwayat Hidup Rohani</h3>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Menjadi Kristen pada Usia
            </label>

            <div class="col-sm-4">
                <?php
                  $id = "tj_akt_usia";
                  $arrInput = array(
                    'name'          => $id,
                    'id'            => $id,
                    'class'         => "form-control",
                    'value'         => misc_helper::get_form_value(
                      $ctlArrData, $id),
                    'placeholder'   => "Contoh : 15"
                  );
                  echo form_input($arrInput);
                ?>
            </div>
            <label for="inputPassword3" class="col-sm-2 control-label">
              Pada Tahun
            </label>

            <div class="col-sm-3">
                <?php
                  $id = "tj_akt_tahun";
                  $arrInput = array(
                    'name'          => $id,
                    'id'            => $id,
                    'class'         => "form-control",
                    'value'         => misc_helper::get_form_value(
                      $ctlArrData, $id),
                    'placeholder'   => "Contoh : 2009"
                  );
                  echo form_input($arrInput);
                ?>
            </div>

          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Dengan Cara
            </label>

            <div class="col-sm-9">
              <?php
                  $id = "tj_akt_cara";
                  $arrInput = array(
                    'name'          => $id,
                    'id'            => $id,
                    'class'         => "form-control",
                    'value'         => misc_helper::get_form_value(
                      $ctlArrData, $id),
                    'placeholder'   => "...."
                  );
                  echo form_input($arrInput);
                ?>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Dari Agama
            </label>

            <div class="col-sm-9">
              <?php
                  $id = "tj_akt_agama_asal";
                  $arrInput = array(
                    'name'          => $id,
                    'id'            => $id,
                    'class'         => "form-control",
                    'value'         => misc_helper::get_form_value(
                      $ctlArrData, $id),
                    'placeholder'   => "...."
                  );
                  echo form_input($arrInput);
                ?>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Gereja Pertama
            </label>

            <div class="col-sm-9">
              <?php
                  $id = "tj_akt_grj_pertama";
                  $arrInput = array(
                    'name'          => $id,
                    'id'            => $id,
                    'class'         => "form-control",
                    'value'         => misc_helper::get_form_value(
                      $ctlArrData, $id),
                    'placeholder'   => "...."
                  );
                  echo form_input($arrInput);
                ?>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Bergabung di Gereja ini tanggal
            </label>

            <div class="col-sm-9">
              <div class="input-group">
                <?php
                $id = "tj_akt_tgl_bergabung";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control datepicker",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "Tanggal Bergabung",
                  "data-date-format" => "yyyy-mm-dd"
                );
                echo form_input($arrInput);
                ?>

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Cara Bergabung
            </label>

            <div class="col-sm-9">
              <?php
                $id = "tj_akt_cara_bergabung";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'class'         => "form-control",
                  'value'         => misc_helper::get_form_value(
                    $ctlArrData, $id),
                  'placeholder'   => "...",
                );
                echo form_input($arrInput);
              ?>
            </div>
          </div>


            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Partisipasi Dalam Pelayanan
              </label>

              <div class="col-sm-9">
                  <?php
                    $arrInput = array(
                      "class" => "form-control"
                    );

                    $option = array(
                      "PELNAP" => "PELNAP",
                      "PELPRUP" => "PELPRUP",
                      "PELPRAP" => "PELPRAP",
                      "PELPAP" => "PELPAP",
                      "PELPRIP" => "PELPRIP",
                      "PELWAP" => "PELWAP",
                      "PELAHT" => "PELAHT",
                      "BUMG" => "BUMG"
                    );

                    echo form_dropdown("tj_roh_wadah", $option, misc_helper::get_form_value(
                        $ctlArrData, "tj_roh_wadah"), $arrInput
                    )
                  ?>
              </div>
            </div>


          <div class="col-md-6">
              <div class="col-sm-12">
                <h4 style="text-align:center"> PENYERAHAN </h4>
                <hr />
              </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Penyerahan
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "0" => "Belum Diserahkan",
                        "1" => "Sudah Diserahkan",
                      );

                      echo form_dropdown("tj_akt_peny_status", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_akt_peny_status"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dengan Cara
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "1" => "Didoakan di Gereja"
                      );

                      echo form_dropdown("tj_akt_peny_cara", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_akt_peny_cara"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dilayani Oleh
                  </label>

                  <div class="col-sm-8">
                      <?php
                        $id = "tj_akt_peny_dilayani_oleh";
                        $arrInput = array(
                          'name'          => $id,
                          'id'            => $id,
                          'class'         => "form-control",
                          'value'         => misc_helper::get_form_value(
                            $ctlArrData, $id),
                          'placeholder'   => "Pdt. ",
                        );
                        echo form_input($arrInput);
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Surat Penyerahan
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "0" => "Belum Punya",
                        "1" => "Sudah Punya",
                      );

                      echo form_dropdown("tj_akt_peny_surat", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_akt_peny_surat"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    No. Surat
                  </label>

                  <div class="col-sm-8">
                      <?php
                        $id = "tj_akt_peny_no_surat";
                        $arrInput = array(
                          'name'          => $id,
                          'id'            => $id,
                          'class'         => "form-control",
                          'value'         => misc_helper::get_form_value(
                            $ctlArrData, $id),
                          'placeholder'   => "Nomor Surat ",
                        );
                        echo form_input($arrInput);
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Di Jemaat
                  </label>

                  <div class="col-sm-8">
                      <?php
                        $id = "tj_akt_peny_jemaat";
                        $arrInput = array(
                          'name'          => $id,
                          'id'            => $id,
                          'class'         => "form-control",
                          'value'         => misc_helper::get_form_value(
                            $ctlArrData, $id),
                          'placeholder'   => "Nama Gereja ",
                        );
                        echo form_input($arrInput);
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Tgl. Penyerahan
                  </label>

                  <div class="col-sm-8">
                      <div class="input-group">
                        <?php
                          $id = "tj_akt_peny_tgl";
                          $arrInput = array(
                            'name'          => $id,
                            'id'            => $id,
                            'class'         => "form-control datepicker",
                            'value'         => misc_helper::get_form_value(
                              $ctlArrData, $id),
                            'placeholder'   => "Tanggal Penyerahan ",
                            'data-date-format' => "yyyy/mm/dd"
                          );
                          echo form_input($arrInput);
                        ?>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                  </div>
                </div>
          </div>

          <div class="col-md-6">
              <div class="col-sm-12">
                <h4 style="text-align:center"> BAPTISAN </h4>
                <hr />
              </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Baptis
                  </label>
                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "0" => "Belum dibaptis",
                        "1" => "Sudah dibaptis",
                      );

                      echo form_dropdown("tj_akt_bap_status", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_akt_bap_status"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dengan Cara
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "1" => "Di selam"
                      );

                      echo form_dropdown("tj_akt_peny_surat", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_akt_peny_surat"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dilayani Oleh
                  </label>

                  <div class="col-sm-8">
                      <?php
                          $id = "tj_akt_bap_dilayani";
                          $arrInput = array(
                            'name'          => $id,
                            'id'            => $id,
                            'class'         => "form-control",
                            'value'         => misc_helper::get_form_value(
                              $ctlArrData, $id),
                            'placeholder'   => "Pdt. ",
                          );
                          echo form_input($arrInput);
                        ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Surat Baptis
                  </label>

                  <div class="col-sm-8">
                      <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "0" => "Belum Punya",
                        "1" => "Sudah Punya"
                      );

                      echo form_dropdown("tj_akt_bap_surat", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_akt_bap_surat"), $arrInput
                      )
                      ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    No. Surat
                  </label>

                  <div class="col-sm-8">
                      <?php
                          $id = "tj_akt_bap_no_surat";
                          $arrInput = array(
                            'name'          => $id,
                            'id'            => $id,
                            'class'         => "form-control",
                            'value'         => misc_helper::get_form_value(
                              $ctlArrData, $id),
                            'placeholder'   => "Nomor ... ",
                          );
                          echo form_input($arrInput);
                        ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Di Jemaat
                  </label>

                  <div class="col-sm-8">
                      <?php
                          $id = "tj_akt_bap_jemaat";
                          $arrInput = array(
                            'name'          => $id,
                            'id'            => $id,
                            'class'         => "form-control",
                            'value'         => misc_helper::get_form_value(
                              $ctlArrData, $id),
                            'placeholder'   => "Nama Gereja",
                          );
                          echo form_input($arrInput);
                        ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Tgl. Baptisan
                  </label>

                  <div class="col-sm-8">
                      <div class="input-group">
                        <?php
                          $id = "tj_akt_bap_tgl";
                          $arrInput = array(
                            'name'          => $id,
                            'id'            => $id,
                            'class'         => "form-control datepicker",
                            'value'         => misc_helper::get_form_value(
                              $ctlArrData, $id),
                            'placeholder'   => "Tanggal Baptis",
                            'data-date-format' => "yyyy-mm-dd"
                          );
                          echo form_input($arrInput);
                        ?>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                  </div>
                </div>
          </div>
        </div>

        <div id="pendidikan" class="tab-pane fade">
          <h3>Pendidikan</h3>
          <div class="col-md-6">
            <div class="col-sm-12">
              <h4 style="text-align:center"> PENDIDIKAN UMUM </h4>
              <h5 style="text-align:center"> (Pendidikan Terakhir) </h5>
              <hr />
            </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Tingkat Pendidikan
                </label>

                <div class="col-sm-8">
                    <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "" => " - ",
                        "TK" => "TK",
                        "SD" => "SD",
                        "SMP" => "SMP",
                        "SMA" => "SMA",
                        "D1" => "D1",
                        "D2" => "D2",
                        "D3" => "D3",
                        "S1" => "S1",
                        "S2" => "S2",
                        "S3" => "S3"
                      );

                      echo form_dropdown("tj_pd_um_tingkat", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_pd_um_tingkat"), $arrInput
                      )
                      ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Jurusan
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_um_jurusan";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Jurusan jika ada",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Nama Instansi
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_um_nama_ins";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Nama Sekolah / Kampus / Universitas",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Alamat Instansi
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_um_alamat_ins";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Alamat Sekolah / Kampus / Universitas",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Telephone
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_um_telp_ins";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Telephone Sekolah / Kampus / Universitas",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>
          </div>

          <div class="col-md-6">
            <div class="col-sm-12">
              <h5 style="text-align:center"> &nbsp; </h5>
              <h4 style="text-align:center"> PENDIDIKAN THEOLOGI </h4>

              <hr />
            </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Tingkat Pendidikan
                </label>

                <div class="col-sm-8">
                    <?php
                      $arrInput = array(
                        "class" => "form-control"
                      );

                      $option = array(
                        "" => " - ",
                        "SA" => "Sekolah Alkitab",
                        "STT" => "Sekolah Tinggi Theologia",
                        "Ins" => "Institut",
                        "Sem" => "Seminari"
                      );

                      echo form_dropdown("tj_pd_teo_tingkat", $option, misc_helper::get_form_value(
                          $ctlArrData, "tj_pd_teo_tingkat"), $arrInput
                      )
                      ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Jurusan
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_teo_jurusan";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Jurusan",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Nama Instansi
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_teo_nama_ins";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Nama Sekolah / Kampus / Universitas",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Alamat Instansi
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_teo_alamat_ins";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Alamat Sekolah / Kampus / Universitas",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Telephone
                </label>

                <div class="col-sm-8">
                    <?php
                      $id = "tj_pd_teo_telp_ins";
                      $arrInput = array(
                        'name'          => $id,
                        'id'            => $id,
                        'class'         => "form-control",
                        'value'         => misc_helper::get_form_value(
                          $ctlArrData, $id),
                        'placeholder'   => "Telephone Sekolah / Kampus / Universitas",
                      );
                      echo form_input($arrInput);
                    ?>
                </div>
              </div>
          </div>
      </div>

        <div id="kerohanian" class="tab-pane fade">
          <h3>Kerohanian</h3>


            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Jabatan
              </label>

              <div class="col-sm-5">
                  <?php
                    $id = "tj_roh_wadah_jab";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Nama Jabatan",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>

              <div class="col-sm-2">
                  <?php
                    $id = "tj_roh_wadah_start";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Thn. Mulai",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>

              <div class="col-sm-2">
                  <?php
                    $id = "tj_roh_wadah_end";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Thn Selesai",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>
            </div>

            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Pelayanan Lainnya
              </label>

              <div class="col-sm-9">
                  <?php
                    $id = "tj_roh_talenta";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "WL / Musik / Singer / Tanners",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Komunitas Lainnya
              </label>

              <div class="col-sm-3">
                  <?php
                    $arrInput = array(
                      "class" => "form-control"
                    );

                    $option = array(
                      "Sektor" => "Sektor",
                      "Rayon" => "Rayon",
                      "Pos Penginjilan" => "Pos Penginjilan"
                    );

                    echo form_dropdown("tj_roh_kl", $option, misc_helper::get_form_value(
                        $ctlArrData, "tj_roh_kl"), $arrInput
                    )
                  ?>
              </div>
            </div>


            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Jabatan
              </label>

              <div class="col-sm-5">
                  <?php
                    $id = "tj_roh_kl_jab";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Nama Jabatan",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>

              <div class="col-sm-2">
                  <?php
                    $id = "tj_roh_kl_start";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Thn. Mulai",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>

              <div class="col-sm-2">
                  <?php
                    $id = "tj_roh_kl_end";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Thn Selesai",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>
            </div>
      </div>



        <div id="pekerjaan" class="tab-pane fade">
          <h3>Pekerjaan</h3>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Pekerjaan
              </label>

              <div class="col-sm-6">
                  <?php
                    $id = "tj_pk_pekerjaan";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Jenis Pekerjaan",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Penghasilan / Bulan
              </label>

              <div class="col-sm-3">
                <?php
                    $id = "tj_pk_penghasilan";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Jumlah Penghasilan",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Tempat Kerja
              </label>

              <div class="col-sm-3">
                  <?php
                    $id = "tj_pk_nama_ins";
                    $arrInput = array(
                      'name'          => $id,
                      'id'            => $id,
                      'class'         => "form-control",
                      'value'         => misc_helper::get_form_value(
                        $ctlArrData, $id),
                      'placeholder'   => "Tempat Kerja",
                    );
                    echo form_input($arrInput);
                  ?>
              </div>
            </div>


      </div>


    </div>


  </div>

  <div class="box-footer">

    <div class="col-sm-12">
      <a href="<?php echo $ctlPilihGereja; ?>"
        class="btn btn-default" >
        <i class="fa fa-chevron-left" ></i> Kembali
      </a>
      <button class="btn btn-primary" type="submit">
          <i class="fa fa-check-square-o" ></i> Simpan
      </button>
    </div>

  </div>

  </form>
</div>