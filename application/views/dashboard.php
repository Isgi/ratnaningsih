
<div class="row">
  <div class="col-md-6">
      <div class="card">
          <div class="header">
              <h4 class="title">Prosentase SPP</h4>
              <p class="category">TK & KB Ratnaningsih</p>
          </div>
          <div class="content">
              <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
              <div class="footer">
                  <div class="chart-legend">
                      <i class="fa fa-circle text-info"></i> Lunas
                      <i class="fa fa-circle text-warning"></i> Belum Lunas
                  </div>
                  <hr>
                  <div class="stats">
                      <i class="ti-timer"></i> <?php echo date("M Y"); ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <div class="col-md-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-warning text-center">
                            <i class="ti-server"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Banyak Murid</p>
                            <?php echo $banyak_murid.' murid' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="header">
                <h4 class="title">Grafik pendapatan dan pengeluaran</h4>
                <p class="category"><?php echo date("Y"); ?></p>
            </div>
            <div class="content" style="padding-left:10px">
                <div id="chartActivity" class="ct-chart"></div>

                <div class="footer">
                    <div class="chart-legend">
                        <i class="fa fa-circle text-info"></i> Pendapatan
                        <i class="fa fa-circle text-warning"></i> Pengeluaran
                    </div>
                    <hr>
                    <div class="stats">
                        <!-- <i class="ti-check"></i> Data information certified -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="row">
    
  <div class="col-md-6">
      <div class="card">
          <div class="header">
              <h4 class="title">Rata - rata pendapatan</h4>
              <p class="category">TK & KB Ratnaningsih</p>
          </div>
          <div class="content">
              <div id="chartHours" class="ct-chart"></div>
              <div class="footer">
                  <div class="chart-legend">
                      <i class="fa fa-circle text-info"></i> TK
                      <i class="fa fa-circle text-danger"></i> KB
                  </div>
                  <hr>
                  <div class="stats">
                      <i class="ti-timer"></i> <?php echo date("M Y"); ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>-->

<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="<?php echo base_url() ?>assets/js/back/chartist.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/back/paper-dashboard.js"></script>

<script type="text/javascript">
    var graph_pendapatan = <?php echo json_encode($graph_pendapatan); ?>;
    var graph_pengeluaran = <?php echo json_encode($graph_pengeluaran); ?>;
    var prosentase_spp = <?php echo json_encode($prosentase_spp); ?>;
    $(document).ready(function(){

      //line area chart
      var dataSales = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        series: [
           [287, 385, 490, 562, 594, 626, 698, 895, 952, 698, 895, 952],
          [67, 152, 193, 240, 387, 435, 535, 642, 744, 535, 642, 744]
        ]
      };

      var optionsSales = {
        lineSmooth: false,
        low: 0,
        high: 1000,
        showArea: true,
        height: "245px",
        axisX: {
          showGrid: false,
        },
        lineSmooth: Chartist.Interpolation.simple({
          divisor: 3
        }),
        showLine: true,
        showPoint: false,
      };

      var responsiveSales = [
        ['screen and (max-width: 640px)', {
          axisX: {
            labelInterpolationFnc: function (value) {
              return value[0];
            }
          }
        }]
      ];

      Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);

      // chart line
      var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        series: [
          graph_pengeluaran,
          graph_pendapatan,
        ]
      };

      var options = {
          seriesBarDistance: 10,
          axisX: {
              showGrid: false
          },
          height: "245px"
      };

      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function (value) {
              return value[0];
            }
          }
        }]
      ];

      Chartist.Line('#chartActivity', data, options, responsiveOptions);

      // pie chart
      Chartist.Pie('#chartPreferences', {
        labels: [prosentase_spp['lunas']+'%',prosentase_spp['belum_lunas']+'%'],
        series: [prosentase_spp['lunas'], prosentase_spp['belum_lunas']]
      });
    });
</script>
