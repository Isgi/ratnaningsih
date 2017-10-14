
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">

<div class="row">
     <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="col-sm-4">
      <?php
      if(!empty($this->session->flashdata('message')))
         echo $this->session->flashdata('message');
       ?>
      <div class="card">
        <div class="header">
            Form Tambah Item Pembayaran
        </div>
          <div class="content">
            <form class="" action="<?php echo site_url('itemtransaksimurid/actadd') ?>" method="post">
                <div class="form-group">
                    <label>Jenis Pembayaran</label>
                    <select class="form-control" required name="jenis_pembayaran">
                      <option value="">Pilih Jenis Pembayaran ...</option>
                      {data_jenis_pembayaran}
                        <option value="{id}">{nama} ({kode})</option>
                      {/data_jenis_pembayaran}
                    </select>
                </div>
                <div class="form-group">
                  <label for="">Program</label>
                  {data_program}
                  <div class="radio">
                      <input type="radio" class="form-control" checked  name="program" required value="{id}"> {nama}
                  </div>
                  {/data_program}
                </div>
                <div class="form-group">
                    <label>Pembayaran Untuk</label>
                    {data_sekolah}
                    <div class="checkbox" required>
                      <label><input type="checkbox" name="sekolah[]" multiple id="checkItem" value="{id}"><div style="text-transform:uppercase">{nama} {derajat}</div></label>
                    </div>
                    {/data_sekolah}
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="text" name="harga" class="form-control border-input" required placeholder="Nama Pembayaran">
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
                  Tabel Item Pembayaran
                </div>
            </div>
            <div class="panel-body">
              <div >
                  <table class="table table-striped" id="dataTables-example" style="font-size:12px">
                      <thead>
                          <tr>
                              <th style="width:40%">Pembayaran</th>
                              <th style="width:20%">Program</th>
                              <th style="width:10%">Untuk</th>
                              <th style="width:10%">Harga</th>
                              <th style="width:20%; text-align:center">#</th>
                          </tr>
                      </thead>
                      <tbody>
                          {data_content}
                          <tr>
                              <td>{jenis_transaksi}</td>
                              <td>{program}</td>
                              <td><b style="text-transform:uppercase">{derajat}</b></td>
                              <td>{harga}</td>
                              <td style="text-align:center">
                                <a title="Ubah data {jenis_transaksi}" href="<?php echo site_url('itemtransaksimurid/edit/{id}') ?>"><i style="color:orange" class="ti-pencil"></i></a>
                                &nbsp  &nbsp
                                <a href="javascript:void(0);" title="Hapus data {jenis_transaksi}" onclick="actdelete({id})"><i style="color:red" class="ti-close"></i></a>
                              </td>
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
var url="<?php echo site_url();?>";
function actdelete(id){
   var r=confirm("Anda yakin akan menghapus data ini ?")
    if (r==true)
      window.location = url+"/itemtransaksimurid/actdelete/"+id;
    else
      return false;
}
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
