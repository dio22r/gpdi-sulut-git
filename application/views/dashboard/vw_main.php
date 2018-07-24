<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $ctlCntGbl; ?></h3>

              <p>Gembala</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $ctlCntGereja; ?></h3>

              <p>Gereja</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $ctlCntWilayah; ?></h3>

              <p>Wilayah</p>
            </div>
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $ctlCntJemaat; ?></h3>

              <p>Jemaat</p>
            </div>
            <div class="icon">
              <i class="fa fa-street-view"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>



      <div class="row">
        <div class="col-md-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-light-blue"><i class="fa fa-male"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Dewasa</span>
              <span class="info-box-number"><?php echo $ctlTotalDewasa; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-child"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Remaja</span>
              <span class="info-box-number"><?php echo $ctlTotalRemaja; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-smile-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Anak-anak</span>
              <span class="info-box-number"><?php echo $ctlTotalAnak; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="row">
          <div class="col-xs-12">
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kabupaten / Kota</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th width="30%">Nama Kabupaten / Kota</th>
                  <th width="10%">Wilayah</th>
                  <th width="10%">Gereja</th>
                  <th width="10%">Dewasa</th>
                  <th width="10%">Remaja</th>
                  <th width="10%">Anak-anak</th>
                  <th width="10%">Total Jiwa</th>
                </tr>

                <?php foreach($ctlArrKab as $key => $arrVal) { ?>

                <tr>
                  <td><?php echo $arrVal["tkab_nama"]; ?></td>
                  <td><?php echo $arrVal["total_wilayah"]; ?></td>
                  <td><?php echo $arrVal["total_gereja"]; ?> </td>
                  <td><?php echo $arrVal["tkab_total_dewasa"]; ?> jiwa</td>
                  <td><?php echo $arrVal["tkab_total_remaja"]; ?> jiwa</td>
                  <td><?php echo $arrVal["tkab_total_anak"]; ?> jiwa</td>
                  <td>
                    <b>
                      <?php echo $arrVal["total"]; ?> jiwa
                    </b>
                  </td>
                </tr>
                <?php } ?>

                <tr>
                  <th >TOTAL</th>
                  <th ><?php echo $ctlCntWilayah; ?> Wilayah</th>
                  <th ><?php echo $ctlCntGereja; ?> Gereja</th>
                  <th ><?php echo $ctlTotalDewasa; ?> jiwa</th>
                  <th ><?php echo $ctlTotalRemaja; ?> jiwa</th>
                  <th ><?php echo $ctlTotalAnak; ?> jiwa</th>
                  <th ><?php echo $ctlCntJemaat; ?> jiwa</th>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        </div>




        <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>