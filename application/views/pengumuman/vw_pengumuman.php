
<div class="row">
    <div class="col-xs-12">


      <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Pengumuman</h3>
        </div>

        <div class="box-body">
            <ul class="nav nav-tabs">
                  <li role="presentation" class="active">
                    <a href="<?php echo $ctlUrlPengumuman; ?>">
                        Pengumuman
                    </a>
                  </li>
                  <li role="presentation" class="berita">
                    <a href="<?php echo $ctlUrlBerita; ?>">
                        Berita
                    </a>
                  </li>
            </ul>


            <form class="form-horizontal" method="post"
                    action="<?php echo $ctlUrlSubmit; ?>" >
                    <div class="box-body">

                            <input type="hidden" name="tw_id"
                                value="">           
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="tw_nomor_induk" class="col-sm-3 control-label">Judul</label>

                                      <div class="col-sm-9">
                                        <input name="tw_nomor_induk" class="form-control"
                                        id="tw_nomor_induk" placeholder="Judul"
                                        value="">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="tw_nama" class="col-sm-3 control-label">Isi
                                      </label>

                                      <div class="col-sm-9">
                                        <textarea class="form-control" placeholder="isi Pengumuman"></textarea>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="tw_nama" class="col-sm-3 control-label">
                                      </label>

                                      <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Submit
                                        </button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </form>
                
        </div>
    </div>


            <?php

            $date = "";
            ?>

            <ul class="timeline">

                <?php

                $arrColor = array("bg-yellow", "bg-red", "bg-blue");

                foreach($ctlArrData as $key => $arrVal) {


                $tempTime = explode(" ", $arrVal["tpeng_datetime"]);

                $tempDate = $tempTime[0];
                
                $strIdDate = misc_helper::format_idDate($tempDate);
                $strDay = misc_helper::str_idDay($tempDate);

                $idColor = $key % 3;

                  $datetime1 = new DateTime($arrVal["tpeng_datetime"]);
                  $datetime2 = new DateTime();
                  $difference = $datetime1->diff($datetime2);
                  
                if ($date != $tempDate) {
                    $date = $tempDate;

                ?>


                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-red">
                        <?php echo date("d M. Y", strtotime($date)); ?>
                    </span>
                </li>
                <!-- /.timeline-label -->

                <?php

                }

                ?>
                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-envelope <?php echo $arrColor[$idColor]; ?>"></i>
                    <div class="timeline-item">
                        <span class="time">
                            <i class="fa fa-clock-o"></i>
                            <?php echo $strDay . ", " . $strIdDate; ?>
                        </span>

                        <h3 class="timeline-header">
                            <a href="#">
                                <?php echo $arrVal["tu_display_name"]; ?>:
                            </a> <?php echo $arrVal["tpeng_judul"]; ?>
                        </h3>

                        <div class="timeline-body">
                            <?php echo nl2br($arrVal["tpeng_isi"]); ?>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->

                <?php } ?>


                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>

</div>
</div>
