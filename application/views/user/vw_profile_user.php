<div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">
                <?php echo $ctlArrData["tu_display_name"]; ?>
              </h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>username</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["tu_username"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Tipe Pengguna</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["tu_tipe_user"]; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Status</b>
                  <a class="pull-right">
                    <?php echo $ctlArrData["tu_status"]; ?>
                  </a>
                </li>
              </ul>

              <a href="<?php echo $ctlFormUrl; ?>" class="btn btn-warning btn-block">
                <span class="glyphicon glyphicon-edit"></span> <b>Edit Data Pengguna</b>
              </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>