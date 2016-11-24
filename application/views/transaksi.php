
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
<div class="row">
  <div class="col-sm-3">
      <div class="card">
        <div class="header">
            <i class="ti-plus"></i> No Induk / Nama
        </div>
        <div class="content">
          <form  action="{site_url(transaksi/searchsiswa)}" method="get">
            <div class="from-group">
              <input type="text" name="cari" placeholder="No Induk / Nama" class="form-control border-input" value="">
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Cari</button>
            </div>
          </form>
          <hr>
          <ul class="list-unstyled team-members">
            <?php if ($data_siswa): ?>
              {data_siswa}
                <li>
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-7">
                            {nama}
                            <br />
                            <span class="text-success"><small>{no_induk}</small></span>
                        </div>

                        <div class="col-xs-3 text-right">
                            <a href="{site_url(transaksi/bayar/)}{id}"><btn title="Bayar" class="btn btn-sm btn-success btn-icon"><i class="ti ti-money"></i></btn></a>
                        </div>
                    </div>
                </li>
              {/data_siswa}
            <?php else: ?>
              <p>Tidak ditemukan...</p
            <?php endif; ?>
        </ul>
        </div>
      </div>
  </div>
  <div class="col-sm-9">
    <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="">
      <table class="table table-striped" id="dataTables-example">
        <thead>
          <tr>
            <th class="no-sort">No. Induk</th>
            <th class="no-sort">Nama</th>
            <th class="no-sort">Derajat</th>
            <th class="no-sort">Kelas</th>
            <th class="no-sort">Pembayaran</th>
            <th class="no-sort">Dibayarkan</th>
            <th>Tgl</th>
            <th class="no-sort">#</th>
          </tr>
        </thead>
        <tbody>
          {data_content}
          <tr class="odd gradeX">
            <td>{no_induk}</td>
            <td>{nama_murid}</td>
            <td>{derajat}</td>
            <td>{nama_kelas}</td>
            <td>{nama_transaksi}</td>
            <td>{dibayarkan}</td>
            <td>{tgl}</td>
            <td></td>
          </tr>
          {/data_content}
        <tbody>
      </table>
    </div>
    <!--End Default Pannel, Primary Panel And Success Panel   -->
  </div>
</div>



<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>
<script src="<?php echo base_url() ?>assets/js/back/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/back/dataTables.bootstrap.js"></script>

<script>
$('#dataTables-siswa').delegate('tbody > tr', 'click', function ()
{
    var data =  $('#dataTables-siswa').DataTable().row( this ).data();
    window.open('<?php echo site_url('siswasiswi/') ?>'+data[0]);
});
// $('#dataTables-siswa').dataTable({
//         // "bLengthChange" : false,
//
//
//     "order": [],
//     "iDisplayLength": 5,
//     "bLengthChange" : false,
//     "info" :false,
//     // "paging":   false,
//     // "ordering": false,
//     "dom": '<"top"f>rtip',
//     "columnDefs": [ {
//       "targets"  : 'no-sort',
//       "orderable": false,
//     }],
//     "oLanguage": {
//       "sProcessing":   "Sedang memproses...",
//       "sSearch":       "Cari Murid :",
//       "sUrl":          "",
//     }
// });
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
