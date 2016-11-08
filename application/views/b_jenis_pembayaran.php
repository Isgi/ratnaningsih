
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">

<div class="row">
     <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="col-sm-4">
      <div class="card">
        <div class="header">
            <i class="ti-plus"></i> Form Tambah Item Pembayaran
        </div>
          <div class="content">
            <form class="" action="<?php echo site_url('bjenispembayaran/actadd') ?>" method="post">
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="kode" class="form-control border-input" required placeholder="Kode">
                </div>
                <div class="form-group">
                    <label>Nama Pembayaran</label>
                    <input type="text" name="nama" class="form-control border-input" required placeholder="Nama Pembayaran">
                </div>
                <div class="form-group">
                  <label for="">Periode Transaksi Bulanan</label>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="radio">
                          <input type="radio" class="form-control"  name="periode"  required value="ya"> Ya
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="radio">
                          <input type="radio" class="form-control"  name="periode" checked value="tidak"> Tidak
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Dibuat untuk</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="radio">
                          <input type="radio" class="form-control"  name="jenis" checked required value="pemasukan"> Pemasukan
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="radio">
                          <input type="radio" class="form-control"  name="jenis"  value="pengeluaran"> Pengeluaran
                      </div>
                    </div>
                  </div>
                </div>
              <button type="submit" class="btn btn-success">Simpan</button>
            </form>
          </div>
      </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="help-block">
                  Tabel Jenis Pembayaran
                </div>
            </div>
            <div class="panel-body">
              <div  >
                  <table class="table table-striped" id="dataTables-example" style="font-size:12px">
                      <thead>
                          <tr>
                              <th style="width:10%">Kode</th>
                              <th style="width:50%">Nama</th>
                              <th style="width:10%">Bulanan</th>
                              <th style="width:20%">Jenis</th>
                              <th style="width:10%">#</th>
                          </tr>
                      </thead>
                      <tbody>
                          {data_content}
                          <tr>
                              <td>{kode}</td>
                              <td>{nama}</td>
                              <td>{periode_bulanan}</td>
                              <td>{jenis}</td>
                              <td><a href="#"><i style="color:red" class="ti-close"></i></a></td>
                          </tr>
                          {/data_content}
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>

      <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>
<script src="<?php echo base_url() ?>assets/js/back/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/back/dataTables.bootstrap.js"></script>

<script>
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
