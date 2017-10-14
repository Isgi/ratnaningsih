<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="{base_url(assets/css/back/style.css)}" rel="stylesheet">
<link href="{base_url(assets/css/back/bootstrap-datetimepicker.css)}" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <form class="form-inline" action="<?php echo site_url('laporan/harian') ?>" method="get">
        <div class="form-group">
            <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
              <input class="form-control border-input" placeholder="Pilih tanggal" size="16" type="text" value="" readonly>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="no-sort">TANGGAL</th>
                    <th class="no-sort">KETERANGAN</th>
                    <th class="no-sort">KODE</th>
                    <th class="no-sort">DEBET</th>
                    <th class="no-sort">KREDIT</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($data_content as $data): ?>
                <tr class="odd gradeX">
                    <td><?php echo date('d-M-Y', strtotime($data->tgl_setoran))?></td>
                    <td><?php echo ($data->murid ? $data->transaksi_item_nama.' '.$data->murid : $data->nama.' '.$data->penyetor) ?></td>
                    <td><?php echo ($data->transaksi_item_kode ? $data->transaksi_item_kode : $data->transaksi_kode)?></td>
                    <td><?php echo ($data->transaksi_item_jenis ? ($data->transaksi_item_jenis == 'pemasukan' ? $data->nominal : '') : ($data->transaksi_jenis == 'pemasukan' ? $data->nominal : ''))?></td>
                    <td><?php echo ($data->transaksi_item_jenis ? ($data->transaksi_item_jenis == 'pengeluaran' ? $data->nominal : '') : ($data->transaksi_jenis == 'pengeluaran' ? $data->nominal : ''))?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php echo $link?>
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
  startView: 2,
  minView: 2,
  forceParse: 0
  });
</script>
