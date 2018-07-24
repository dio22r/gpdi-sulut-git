
	<div class="row">
        <div class="col-xs-12">
		
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Data Hut Sepekan ~
                        <?php echo $ctlStartDate; ?> s/d
                        <?php echo $ctlEndDate; ?>
                    </h3>

                </div>

                <div class="box-body">
                    <ul class="pagination">
                        <li>
                            <a href="<?php echo $ctlArrLink["prev"]; ?>">
                                <i class="fa fa-fw fa-chevron-left"></i> Prev
                            </a>
                        </li>
                        <li class="active">
                      		<a href="<?php echo $ctlArrLink["now"]; ?>"><?php echo $ctlMinggu; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo $ctlArrLink["next"]; ?>">
                                Next <i class="fa fa-fw fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>

                    <div>
                    <?php
                        if ($ctlArrSorted) {
                            
                            foreach ($ctlArrSorted as $year => $arrVal) {
                                foreach ($arrVal as $month => $arrVal2) {
                                    foreach ($arrVal2 as $day => $arrData) { 
                                        $date = $year."-".str_pad($month, 2, "0", STR_PAD_LEFT)
                                            ."-".str_pad($day, 2, "0", STR_PAD_LEFT);
                                        
                                        echo misc_helper::str_idDay($date) . ", ";
                                        echo misc_helper::format_idDate($date)."<br />";
                                        
                                        foreach ($arrData as $key => $data) {
                                            echo " &nbsp; &nbsp; &gt; <a href='".$data["link"]."' class='hut-black-link'>".
                                            	"<strong>".$data["nama"] . "</strong> (".$data["umur"]." thn)<br />".
                                                "</a>";
                                        }
                                        echo "<hr />";
                                    }
                                }
                            }
                        } else {
                            echo "<div class='center'><strong> ~ Tidak ada data ~ </strong></div>";
                        }
                    ?>
                    </div>

                    <a class="btn btn-warning" href="<? echo $ctlUrlHutPdf; ?>"
                        target="_blank">
                        <i class="fa fa-fw fa-download"></i>
                        Download PDF Hut Sepekan
                        <?php echo date("Y"); ?>
                    </a>

				</div>


		</div>
    </div>
</div>