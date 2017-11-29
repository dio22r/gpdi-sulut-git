<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">File Submited</h3>

    </div>
    <!-- /.box-header -->
    <!-- form start -->

      <div class="box-body">

        <?php if ($ctlStatus) { ?>
          <div class="alert alert-success">
            <h4><i class="icon fa fa-check"></i> Data Berhasil Ter-Update!</h4>
            Berikut data File yang ter-update
          </div>

          <table class="table">
              <tbody>
                    <tr>
                      <td width="20%">Kode</td>
                      <td width="80%">
                        <?php echo $ctlArrData["tw_nomor_induk"]; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Wilayah</td>
                      <td><?php echo $ctlArrData["tw_nama"]; ?></td>
                    </tr>
                    <tr>
                      <td>Kabupaten / Kota</td>
                      <td><?php echo $ctlArrData["tkab_nama"]; ?></td>
                    </tr>
                    <tr>
                      <td>Struktur Organisasi</td>
                      <td><?php echo $ctlArrData["tw_struktur_organisasi"]; ?></td>
                    </tr>
                    <tr>
                      <td>Inventaris</td>
                      <td><?php echo $ctlArrData["tw_inventaris"]; ?></td>
                    </tr>
                  </tbody>
              </table>

        <?php } else { ?>
          <?php $disable = "disabled"; ?>
          <div class="alert alert-warning">
            <h4><i class="icon fa fa-check"></i> Data Gagal Ter-Update!</h4>
            Silahkan Coba Lagi!
          </div>
        <?php } ?>
      </div>
      
      <!-- /.box-body -->
      <div class="box-footer">
        <a class="btn btn-default" href="<?php echo $ctlEditUrl; ?>">
          <i class="glyphicon glyphicon-chevron-left"></i> &nbsp; Tinjau Kembali
        </a>

        <a type="submit" name="submit" class="btn btn-primary"
          href="<?php echo $ctlUrlOke; ?>">
          <i class="glyphicon glyphicon-play-circle"></i> &nbsp; Oke
        </a>
      </div>
      <!-- /.box-footer -->
    
  </div>


<?php echo "GPdI Sulut: " . $keterangan; ?>