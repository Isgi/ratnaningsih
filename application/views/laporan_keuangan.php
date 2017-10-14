<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="{base_url(assets/css/back/style.css)}" rel="stylesheet">
<link href="{base_url(assets/css/back/bootstrap-datetimepicker.css)}" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <form class="form-inline" action="<?php echo site_url('laporan/keuangan') ?>" method="get">
        <div class="form-group">
          <div class="input-group date form_date" data-date="" data-date-format="MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control border-input" placeholder="Pilih bulan" size="16" type="text" value="" readonly>
            <input type="hidden" name="tgl" id="dtp_input2" /><br/>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" type="button"><i class="ti-filter"></i></button>
            </span>
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-2">
      <a href="<?php echo site_url('laporan/cetak/'.$this->uri->segment(2).'?'.$_SERVER['QUERY_STRING']) ?>"><button type="button" class="btn btn-default" name="button">Cetak <i class="ti-printer"></i></button></a>
    </div>
  </div>
</div>

<div class="row">
        <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="">
        <table class="table table-striped table-bordered">
          <tbody>
            <tr class="odd gradeX">
              <td style='text-align:center' colspan="3"><strong>PEMASUKAN</strong></td>
            </tr>
            <?php
            $total_pemasukan=0;
            foreach ($data_content as $data): ?>
              <?php if ($data->transaksi_item_jenis == 'pemasukan' || $data->transaksi_jenis == 'pemasukan'):
                $total_pemasukan = $total_pemasukan+$data->nominal?>
                <tr class="odd gradeX">
                  <td><?php echo ($data->transaksi_item_nama ? $data->transaksi_item_nama : $data->transaksi_nama)?></td>
                  <td><?php echo ($data->transaksi_item_kode ? $data->transaksi_item_kode : $data->transaksi_kode) ?></td>
                  <td><?php echo 'Rp. '.$data->nominal?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach ?>
            <tr class="odd gradeX">
              <td style='text-align:center' colspan="2"><strong>Total Pemasukan</strong></td>
              <td><?php echo 'Rp. '.$total_pemasukan ?></td>
            </tr>

            <tr class="odd gradeX">
              <td style='text-align:center' colspan="3"><strong>PENGELUARAN</strong></td>
            </tr>
            <?php
            $total_pengeluaran = 0;
            foreach ($data_content as $data): ?>
              <?php if ($data->transaksi_item_jenis == 'pengeluaran' || $data->transaksi_jenis == 'pengeluaran'):
                $total_pengeluaran = $total_pengeluaran + $data->nominal?>
                <tr class="odd gradeX">
                  <td><?php echo ($data->transaksi_item_nama ? $data->transaksi_item_nama : $data->transaksi_nama)?></td>
                  <td><?php echo ($data->transaksi_item_kode ? $data->transaksi_item_kode : $data->transaksi_kode) ?></td>
                  <td><?php echo 'Rp. '.$data->nominal?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach ?>
            <tr class="odd gradeX">
              <td style='text-align:center' colspan="2"><strong>Total Pengeluaran</strong></td>
              <td><?php echo 'Rp. '.$total_pengeluaran ?></td>
            </tr>
          </tbody>
        </table>
    </div>
        <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>
<!--   Core JS Files   -->
<script src="{base_url(assets/vendor/jquery/jquery-1.10.2.js)}" type="text/javascript"></script>
<script src="{base_url(assets/vendor/bootstrap/js/bootstrap.min.js)}" type="text/javascript"></script>
<script src="{base_url(assets/js/back/bootstrap-datetimepicker.js)}" type="text/javascript"></script>
<script src="{base_url(assets/js/back/bootstrap-datetimepicker.id.js)}" type="text/javascript"></script>

<script type="text/javascript">
$('.form_date').datetimepicker({
      language:  'id',
      weekStart: 1,
      todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 3,
  minView: 3,
  forceParse: 0
  });
</script>
