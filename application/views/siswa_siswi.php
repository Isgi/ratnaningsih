
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
<div class="row">
        <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="table-responsive">
        <table class="table table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th class="no-sort">No. Induk</th>
                    <th class="no-sort">Nama</th>
                    <th class="no-sort">Derajat</th>
                    <th class="no-sort">Kelas</th>
                    <th class="no-sort">#</th>
                </tr>
            </thead>
            <tbody>
                {data_content}
                <tr class="odd gradeX">
                    <td>{no_induk}</td>
                    <td>{murid}</td>
                    <td>{sekolah}</td>
                    <td>{kelas}</td>
                    <td class="center">2016/1017</td>
                </tr>
                {/data_content}
            </tbody>
        </table>
    </div>
        <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Transaksi</h4>
      </div>
			<?php echo form_open_multipart('siswasiswi/actadd');?>
				<div class="modal-body">
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control" required name="kelas">
              <option value="">Pilih Kelas ...</option>
              {data_kelas}
                <option value="{id}">{nama} {nama_kelas} ({derajat})</option>
              {/data_kelas}
            </select>
          </div>
	        <div class="form-group">
	            <label>File Excel</label>
	            <input type="file" name="file" class="form-control" placeholder="Penyetor">
	        </div>
	      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
			</form>


    </div>
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
