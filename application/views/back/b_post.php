
<!-- Bootstrap core CSS     -->
<link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/paper-dashboard.css" rel="stylesheet"/>
<!--  Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url() ?>assets/css/back/themify-icons.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<div class="row">
  <a href="<?php echo site_url('{url_root}/add') ?>"><button style="width:100px" class="btn btn-primary btn-block">New</button></a>
</div>
<br>
<div class="row">
  <!--Default Pannel, Primary Panel And Success Panel   -->
  <div class="table-responsive">
     <table class="table table-striped" id="dataTables-example">
         <thead>
             <tr>
                 <th style="width:55%" class="no-sort">Title</th>
                 <th style="width:20%" class="no-sort">Author</th>
                 <th style="width:20%" >Create at</th>
                 <th style="width:5%" class="no-sort">#</th>
             </tr>
         </thead>
         <tbody>
             {data_content}
             <tr class="odd gradeX">
                 <td>{judul}</td>
                 <td>{nama}</td>
                 <td>{waktu}</td>
                 <td><a href="<?php echo site_url($url_root.'/edit/{id}') ?>"><i style="color:orange" class="ti-pencil"></i></a>&nbsp&nbsp&nbsp&nbsp<a href="<?php echo site_url($url_root.'/actdelete/{id}') ?>"><i style="color:red" class="ti-close"></i></a></td>
             </tr>
             {/data_content}
         </tbody>
     </table>
   </div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/back/dataTables.bootstrap.js"></script>
<script>
  $('#dataTables-example').dataTable( {
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
