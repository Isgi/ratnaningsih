
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
             Form Tambah Jenis Pembayaran
         </div>
           <div class="content">
             <form class="" action="<?php echo site_url('jenistransaksi/actadd') ?>" method="post">
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
                 <div class="form-group">
                     <label>Kode</label>
                     <input type="text" name="kode" class="form-control border-input" placeholder="Kode" required>
                 </div>
                 <div class="form-group">
                     <label>Nama Pembayaran</label>
                     <input type="text" name="nama" class="form-control border-input" required placeholder="Nama Pembayaran">
                 </div>
                 <div class="form-group">
                   <label for="">Periode Transaksi</label>
                   <div class="row">
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control"  name="periode"  required value="bln"> Bulanan
                       </div>
                     </div>
                     <!-- <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control"  name="periode" checked value="6bln"> 6 Bulanan
                       </div>
                     </div> -->
                   </div>
                   <div class="row">
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control"  name="periode"  required value="thn"> Tahunan
                       </div>
                     </div>
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control"  name="periode" checked value="tdk"> Tidak ditentukan
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
                               <th style="width:40%">Nama</th>
                               <th style="width:10%">Periode</th>
                               <th style="width:20%">Jenis</th>
                               <th style="width:20%; text-align:center">#</th>
                           </tr>
                       </thead>
                       <tbody>
                           {data_content}
                           <tr>
                               <td>{kode}</td>
                               <td>{nama}</td>
                               <td>{periode}</td>
                               <td>{jenis}</td>
                               <td style="text-align:center">
                                 <a title="Ubah data {nama}" href="<?php echo site_url('jenistransaksi/edit/{id}') ?>"><i style="color:orange" class="ti-pencil"></i></a>
                                 &nbsp  &nbsp
                                 <a href="javascript:void(0);" title="Hapus data {nama}" onclick="actdelete({id})"><i style="color:red" class="ti-close"></i></a>
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
      window.location = url+"/jenistransaksi/actdelete/"+id;
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
