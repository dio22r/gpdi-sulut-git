
<div class="row">
    <div class="col-xs-12">


      <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Pengumuman</h3>
        </div>

<!--
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

                
        </div>

-->
    </div>

            <ul class="timeline">

                <?php
                    $tempDate = "";
                    $arrColor = array(
                        "yellow", "red", "blue"
                    );
                ?>

                <?php foreach($ctlArrData as $key => $arrVal) { ?>

                <?php
                    list($date, $time) = explode(" ", $arrVal["tpeng_datetime"]);    
                ?>

                <?php if ($tempDate != $date) { ?>
                    <?php
                        $tempDate = $date;
                        $idDate = misc_helper::format_idDate($date);
                    ?>

                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-red">
                    <?php echo $idDate; ?>
                    </span>
                </li>
                <!-- /.timeline-label -->
                <?php } ?>

                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-envelope
                    <?php echo "bg-".$arrColor[$key%3]; ?>
                    "></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i>
                        <?php
                            list($jam, $menit, $detik) = explode(":", $time);
                            echo misc_helper::str_idDay($date) . ", ". $idDate . " " . $jam .":". $menit;
                        ?>
                        </span>

                        <h3 class="timeline-header">
                            <a href="#">
                                <?php echo $arrVal["tu_display_name"]; ?> :
                            </a>
                            <?php echo $arrVal["tpeng_judul"]; ?>
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
