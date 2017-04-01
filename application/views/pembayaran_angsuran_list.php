
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
<?php
if(!empty($this->session->flashdata('message')))
   echo $this->session->flashdata('message');
?>
    <div class="">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="no-sort">No. Induk</th>
            <th class="no-sort">Nama</th>
            <th class="no-sort">Derajat</th>
            <th class="no-sort">Kelas</th>
            <th class="no-sort">Pembayaran</th>
            <th class="no-sort">nominal</th>
            <th class="no-sort">Tgl Setoran</th>
            <th class="no-sort">#</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_content as $data): ?>
          <tr class="odd gradeX">
            <td><?php echo $data->no_induk?></td>
            <td><?php echo $data->nama_murid ?></td>
            <td><?php echo $data->derajat?></td>
            <td><?php echo $data->nama_kelas?></td>
            <td><?php echo $data->nama_pembayaran?></td>
            <td><?php echo $data->nominal?></td>
            <td><?php echo $data->tgl_setoran?></td>
            <td>
              <a title="Ubah data" href="<?php echo site_url('pembayaran/edit/'.$this->uri->segment(2).'/'.$data->id.'?'.$_SERVER['QUERY_STRING']) ?>"><i style="color:orange" class="ti-pencil"></i></a>
              &nbsp  &nbsp
              <a href="javascript:void(0);" title="Hapus data" onclick="
              <?php
                //ex = angsuranbulanan/11?tanggal=2017-03-23&nis=0093988518&pembayaran=4
                $query = $this->uri->segment(2)."/".$data->id."?".$_SERVER['QUERY_STRING'];
                echo "actdelete('$query')"
              ?>"><i style="color:red" class="ti-close"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        <tbody>
      </table>
    </div>



<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>

<script>
var url="<?php echo site_url();?>";
function actdelete(query){
  console.log(query);
   var r=confirm("Anda yakin akan menghapus data ini ?")
    if (r==true)
      window.location = url+"/pembayaran/actdelete/"+query;
    else
      return false;
}
</script>
