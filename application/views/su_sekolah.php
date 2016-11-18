
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
<div class="row">
        <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="table-responsive">
        <table class="table table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th class="no-sort">Yayasan</th>
                    <th class="no-sort">Sekolah</th>
                    <th class="no-sort">Derajat</th>
                    <th class="no-sort">Terdaftar</th>
                    <th class="no-sort">#</th>
                </tr>
            </thead>
            <tbody>
              {data_content}
                <tr class="odd gradeX">
                    <td>{yayasan}</td>
                    <td>{sekolah}</td>
                    <td style="text-transform:uppercase">{derajat}</td>
                    <td>{dibuat}</td>
                    <td>#</td>
                </tr>
              {/data_content}
            </tbody>
        </table>
    </div>
        <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <form class="" action="<?php echo site_url("susekolah/actadd") ?>" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-xs-8">
                      <h4 class="modal-title" id="myModalLabel">Tambah Sekolah</h4>
                    </div>
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pengurus</label>
                    <input type="text" name="pengurus" class="form-control border-input" placeholder="Nama Lengkap Pengurus">
                </div>
                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <input type="typeahead" name="sekolah" placeholder="Nama Sekolah" class="form-control border-input" placeholder="No. Indk / Nama">
                </div>
                <div class="form-group">
                    <label>Yayasan</label>
                    <input type="text" name="yayasan" placeholder="Nama Yayasan" class="form-control border-input" placeholder="Penyetor">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" placeholder="Alamat Yayasan / Alamat Sekolah" class="form-control border-input" placeholder="Penyetor">
                </div>
                <div class="form-group">
                    <label>Derajat</label>
                    {data_derajat}
                    <div class="checkbox">
                        <label><input type="checkbox"  name="derajat[]" multiple id="checkItem" value="{id}"> <div style="text-transform: uppercase;">{nama}</div></label>
                    </div>
                    {/data_derajat}
                </div>
	        </div>
        </div>
    </form>
  </div>
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
