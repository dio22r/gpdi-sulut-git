      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Umur</h3>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height: 300px; width: 563px;" width="563" height="300"></canvas>


            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Pria Wanita</h3>
            </div>
            <div class="box-body">
              <canvas id="pieChart2" style="height: 300px; width: 563px;" width="563" height="300"></canvas>

              
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Wadah</h3>
            </div>
            <div class="box-body">
              <canvas id="pieChart3" style="height: 300px; width: 563px;" width="563" height="300"></canvas>


            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Kelahiran / Tahun</h3>
            </div>
            <div class="box-body">
              <canvas id="lineChart" style="height: 300px; width: 563px;" width="563" height="300"></canvas>

              
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <script>
        var umurData = <?php echo json_encode($ctlArrUmur); ?>;
        var priaWanitaData = <?php echo json_encode($ctlArrLP); ?>;
        var wadahData = <?php echo json_encode($ctlArrWadah); ?>;
        var tahunData = <?php echo json_encode($ctlArrYear["data"]); ?>;
        var tahunOption = <?php echo json_encode($ctlArrYear["options"]); ?>;
      </script>