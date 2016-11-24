<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="{base_url(assets/css/back/style.css)}" rel="stylesheet">
<link href="{base_url(assets/css/back/bootstrap-datetimepicker.css)}" rel="stylesheet">

<div class="container">
    <form class="form-inline" action="{site_url(laporan/tahunan)}" method="get">
      <div class="form-group">
        <div class="row">
            <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
              <input class="form-control border-input" placeholder="Pilih tahun" size="16" type="text" value="" readonly>
              <input type="hidden" name="thn" id="dtp_input2" /><br/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
              <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit" type="button"><i class="ti-filter"></i></button>
              </span>
            </div>
        </div>
      </div>
    </form>
</div>

<div class="row">
        <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="">
        <table class="table table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th class="no-sort">No. Induk</th>
                    <th class="no-sort">Nama</th>
                    <th class="no-sort">Program</th>
                    <th class="no-sort">Transaksi</th>
                    <th class="no-sort">Harga</th>
                    <th class="no-sort">#</th>
                </tr>
            </thead>
            <tbody>
                {data_content}
                <tr class="odd gradeX">
                    <td>{no_induk}</td>
                    <td>{murid}</td>
                    <td>{program}</td>
                    <td>{transaksi}</td>
                    <td>{harga}</td>
                    <td>#</td>
                </tr>
                {/data_content}
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
<script src="<?php echo base_url() ?>assets/js/back/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/back/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$('.form_date').datetimepicker({
      language:  'id',
      weekStart: 1,
      todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 4,
  minView: 4,
  forceParse: 0
  });

  $('#dataTables-example').dataTable( {
          // "bLengthChange" : false,
      "order": [],
      "columnDefs": [ {
      "targets"  : 'no-sort',
      "orderable": false,
      }],
      "oLanguage": {
      "sProcessing":   "Sedang memproses...",
      "sLengthMenu":   "Tampilkan _MENU_ data",
      "sZeroRecords":  "Tidak ditemukan data yang sesuai",
      "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 data",
      "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
      "sInfoPostFix":  "",
      "sSearch":       "<i class='ti-search'></i>&nbsp&nbsp&nbsp",
      "sUrl":          "",
      "oPaginate": {
          "sFirst":    "Pertama",
          "sPrevious": "Sebelumnya",
          "sNext":     "Selanjutnya",
          "sLast":     "Terakhir"
      }
      }
      });
</script>
