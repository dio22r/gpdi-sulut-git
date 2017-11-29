<div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body">

              <div class="col-md-6">

                <h3 class="profile-username">
                  Data Berhasil terupdate
                </h3>

                <table class="table">
                  <tbody>
                      <tr>
                        <td width="40%">Nama</td>
                        <td width="60%">
                          <?php echo $ctlArrData["tu_display_name"]; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Username (Login)</td>
                        <td><?php echo $ctlArrData["tu_username"]; ?></td>
                      </tr>
                      <tr>
                        <td>Tipe</td>
                        <td><?php echo $ctlArrData["tu_tipe_user_str"]; ?></td>
                      </tr>

                      <?php if ($ctlArrData["tu_tipe_user"] == 3 || $ctlArrData["tu_tipe_user"] == 5) { ?>
                        <?php
                          $strTipeUser = $ctlArrData["tu_tipe_user_str"];
                        ?>
                        <tr>
                          <td><?php echo $strTipeUser; ?> di</td>
                          <td><?php echo $ctlArrData["tu_tipe_user_det"]; ?></td>
                        </tr>
                      <?php } ?>

                      <tr>
                        <td>Status</td>
                        <td><?php echo $ctlArrData["tu_status"]; ?></td>
                      </tr>
                  </tbody>
                </table>

                <a href="<?php echo $ctlFormUrl; ?>" class="btn btn-warning">
                  <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Pengguna</b>
                </a>

                <a href="<?php echo $ctlProfileUrl; ?>" class="btn btn-primary">
                  <span class="glyphicon glyphicon-user"></span> <b>Lihat Pofile</b>
                </a>

                <a href="<?php echo $ctlHomeUrl; ?>" class="btn btn-success">
                  <span class="glyphicon glyphicon-ok"></span> <b>Oke</b>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>