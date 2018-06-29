

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

      <?php echo form_hidden("tj_id", $ctlId); ?>

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Data Diri</a></li>
      <li><a data-toggle="tab" href="#menu1">Alamat</a></li>
      <li><a data-toggle="tab" href="#akta">Akta</a></li>
      <li><a data-toggle="tab" href="#pendidikan">Pendidikan</a></li>
      <li><a data-toggle="tab" href="#kerohanian">Kerohanian</a></li>
      <li><a data-toggle="tab" href="#pekerjaan">Pekerjaan</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <h3>Data Diri</h3>
        <div class="col-md-6">
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Nama
              </label>

            <div class="col-sm-9">

              <?php
                $id = "tj_nama";
                $arrInput = array(
                  'name'          => $id,
                  'id'            => $id,
                  'value'         => misc_helper::get_form_value($ctl,
                  'maxlength'     => '100',
                  'size'          => '50',
                  'style'         => 'width:50%'
                );
                echo form_input("tj_id", $ctlId);
              ?>
              <input class="form-control" id="inputEmail3" placeholder="Nama Lengkap">
            </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                NIK
              </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="NIK sesuai KTP">
            </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Nomor KK
              </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Sesuai nomor kartu keluraga">
            </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Tempat Lahir
              </label>

            <div class="col-sm-6">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Tempat Lahir">
            </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Tanggal Lahir
              </label>

            <div class="col-sm-9">
              <div class="input-group">
                <input class="form-control datepicker" id="tglLahir" 
                data-date-format="yyyy/mm/dd"
                placeholder="Tanggal Lahir">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Jenis Kelamin
            </label>

            <div class="col-sm-3">
                <select class="form-control">
                  <option>Laki-laki</option>
                  <option>Perempuan</option>
                </select>
            </div>
            
            <label for="inputPassword3" class="col-sm-3 control-label">
              Gol. Darah
            </label>

              <div class="col-sm-3">
                  <select class="form-control">
                    <option>A</option>
                    <option>B</option>
                    <option>AB</option>
                    <option>O</option>
                  </select>
              </div>

          </div>


        </div>

          <div class="col-md-6">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Tinggi Badan
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Tinggi: cm">
              </div>
              <label for="inputPassword3" class="col-sm-3 control-label">
                Warga Negara
              </label>

                <div class="col-sm-3">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Warga Negara">
                </div>
            </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">
                      Status Nikah
                    </label>

                  <div class="col-sm-9">
                      <select class="form-control">
                        <option>Singel</option>
                        <option>Menikah</option>
                        <option>Janda</option>
                        <option>Duda</option>
                      </select>
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">
                    Nama Ayah
                  </label>

                  <div class="col-sm-9">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Ayah">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">
                    Nama Ibu
                  </label>

                  <div class="col-sm-9">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Ibu">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">
                    No. Telp
                  </label>

                  <div class="col-sm-9">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="No. Telp">
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
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Propinsi">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kabupaten / Kodya
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Kabupaten / Kodya">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kecamatan
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Kecamatan">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kelurahan / Desa
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Kecamatan">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dusun / Jaga / Kampung
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Kecamatan">
                  </div>
                </div>
          </div>

          <div class="col-md-6">

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    RT / RW / RK
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="RT / RW / RK">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kode Kota
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Kode Kota">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kode Pos
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Kode Pos">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kepemilikian Rumah
                  </label>

                  <div class="col-sm-8">
                      <select class="form-control">
                        <option>Milik Keluarga</option>
                        <option>Kontrak</option>
                        <option>Miliki Pribadi</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Kondisi Bangunan
                  </label>

                  <div class="col-sm-8">
                    <select class="form-control">
                      <option>Baik</option>
                      <option>Kurang Baik</option>
                    </select>
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
                <input type="email" class="form-control" id="inputEmail3" placeholder="Umur: Contoh 8">
            </div>
            <label for="inputPassword3" class="col-sm-2 control-label">
              Pada Tahun
            </label>

            <div class="col-sm-3">
                <input type="email" class="form-control" id="inputEmail3" placeholder="2009">
            </div>

          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Dengan Cara
            </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="...">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Dari Agama
            </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="...">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Gereja Pertama
            </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="...">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Bergabung di Gereja ini
            </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="...">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">
              Cara Bergabung
            </label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="...">
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
                      <select class="form-control">
                        <option>Sudah diserahkan</option>
                        <option>Belum Diserahkan</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dengan Cara
                  </label>

                  <div class="col-sm-8">
                      <select class="form-control">
                        <option>Didoakan di Gereja</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dilayani Oleh
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Pendeta">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Surat Penyerahan
                  </label>

                  <div class="col-sm-8">
                      <select class="form-control">
                        <option>Sudah Punya</option>
                        <option>Belum Punya</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    No. Surat
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Nomor. Surat">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Di Jemaat
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Gereja">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Tgl. Penyerahan
                  </label>

                  <div class="col-sm-8">
                      <div class="input-group">
                        <input class="form-control datepicker" id="tglLahir" 
                        data-date-format="yyyy/mm/dd"
                        placeholder="Tanggal Penyerahan">

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
                      <select class="form-control">
                        <option>Sudah dibaptis</option>
                        <option>Belum dibaptis</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dengan Cara
                  </label>

                  <div class="col-sm-8">
                      <select class="form-control">
                        <option>Diselam</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Dilayani Oleh
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Pendeta">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Surat Baptis
                  </label>

                  <div class="col-sm-8">
                      <select class="form-control">
                        <option>Sudah Punya</option>
                        <option>Belum Punya</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    No. Surat
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Nomor Surat">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Di Jemaat
                  </label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Gereja">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">
                    Tgl. Baptisan
                  </label>

                  <div class="col-sm-8">
                      <div class="input-group">
                        <input class="form-control datepicker" id="tglLahir" 
                        data-date-format="yyyy/mm/dd"
                        placeholder="Tanggal Baptis">

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
                    <select class="form-control">
                      <option>TK</option>
                      <option>SD</option>
                      <option>SMP</option>
                      <option>SMA</option>
                      <option>D1</option>
                      <option>D2</option>
                      <option>D3</option>
                      <option>S1</option>
                      <option>S2</option>
                      <option>S3</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Jurusan
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Jurusan">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Nama Instansi
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Sekolah / Kampus / Universitas" >
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Alamat Instansi
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Alamat Sekolah / Kampus / Universitas">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Telephone
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Telephone Sekolah / Kampus / Universitas">
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
                    <select class="form-control">
                      <option>Sekolah Alkitab</option>
                      <option>STT</option>
                      <option>Institut</option>
                      <option>Seminari</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Jurusan
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Jurusan">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Nama Instansi
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Sekolah / Kampus / Universitas" >
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Alamat Instansi
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Alamat Sekolah / Kampus / Universitas">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">
                  Telephone
                </label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Telephone Sekolah / Kampus / Universitas">
                </div>
              </div>
          </div>
      </div>

        <div id="kerohanian" class="tab-pane fade">
          <h3>Kerohanian</h3>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Partisipasi Dalam Pelayanan
              </label>

              <div class="col-sm-3">
                  <select class="form-control">
                    <option>Sudah Melayani</option>
                    <option>Belum Melayani</option>
                  </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Talenta
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Pisahkan dengan tanda koma">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Karunia
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Pisahkan dengan tanda koma">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Keimanan
              </label>

              <div class="col-sm-3">
                  <select class="form-control">
                    <option>Kurang</option>
                    <option>Sedang</option>
                    <option>Teguh</option>
                  </select>
              </div>
            </div>


            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Kepengurusan
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Pisahkan dengan tanda koma">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Pelayanan
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Pisahkan dengan tanda koma">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Kepribadian
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Kecerdasan
              </label>

              <div class="col-sm-3">
                  <select class="form-control">
                    <option>Baik</option>
                    <option>Cukup</option>
                    <option>Kurang Baik</option>
                  </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Pertumbuhan
              </label>

              <div class="col-sm-3">
                  <select class="form-control">
                    <option>Cepat</option>
                    <option>Lambat</option>
                    <option>Sedang</option>
                  </select>
              </div>
            </div>
      </div>

        <div id="pekerjaan" class="tab-pane fade">
          <h3>Pekerjaan</h3>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Status Kerja
              </label>

              <div class="col-sm-3">
                  <select class="form-control">
                    <option>Bekerja</option>
                    <option>Menganggur</option>
                    <option>Pensiun</option>
                  </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Pekerjaan
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Pekerjaan">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Penghasilan / Bulan
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Contoh 2 - 5 jt / bulan">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Nama Tempat Kerja
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Contoh 2 - 5 jt / bulan">
              </div>
            </div>


            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Alamat Tempat Kerja
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Alamat">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Rutinitas Kerja
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Jam Berangkat">
              </div>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Jam Pulang">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">
                Transportasi
              </label>

              <div class="col-sm-3">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="">
              </div>
            </div>

      </div>


    </div>


  </form>
  </div>

  <div class="box-footer">

    <div class="col-sm-12">
      <a href="<?php echo $ctlPilihGereja; ?>"
        class="btn btn-default" >
        Pilih ulang Gereja
      </a>
      <button class="btn btn-primary" type="submit">
          Simpan
      </button>
    </div>

  </div>

</div>