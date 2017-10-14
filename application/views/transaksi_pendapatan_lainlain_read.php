
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
<?php
if(!empty($this->session->flashdata('message')))
   echo $this->session->flashdata('message');
?>
<div class="row">
  <!--Default Pannel, Primary Panel And Success Panel   -->
  <form class="form-inline" action="<?php echo site_url('transaksi/'.$this->uri->segment(2)) ?>" method="get">
      <!-- <div class="col-xs-4">
        <div class="input-group">
          <select class="form-control border-input" name="kategori">
            <option <?php ($this->input->get('kategori')=='') ? print_r('selected') : ''; ?> value="">Semua Kategori ...</option>
            <option <?php ($this->input->get('kategori')=='lunas') ? print_r('selected') : ''; ?> value="lunas">Lunas</option>
            <option <?php ($this->input->get('kategori')=='belum_lunas') ? print_r('selected') : ''; ?> value="belum_lunas">Belum Lunas</option>
          </select>
          <span class="input-group-btn">
              <button class="btn btn-primary" type="submit" type="button">Ok</button>
          </span>
        </div>
      </div> -->
      <div class="col-xs-4">
        <div class="input-group">
          <input type="text" placeholder="Nama Pendapatan" class="form-control border-input" name="nama" value="<?php echo ($this->input->get('nama') != "" ? $this->input->get('nama') : "")?>">
          <span class="input-group-btn">
              <button class="btn btn-primary" type="submit" type="button">Cari</button>
          </span>
        </div>
      </div>
  </form>
</div>
    <div class="">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="no-sort">Nama Pendapatan</th>
            <th class="no-sort">Penyetor</th>
            <th class="no-sort">Keterangan</th>
            <th class="no-sort">Nominal</th>
            <th class="no-sort">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_content as $data): ?>
          <tr class="odd gradeX">
            <td><?php echo $data->nama?></td>
            <td><?php echo $data->penyetor ?></td>
            <td><?php echo $data->keterangan?></td>
            <td><?php echo $data->nominal?></td>
            <td><?php echo $data->tgl_setoran?></td>
            <td>
              <a title="Ubah data" href="<?php echo site_url('transaksi/edit/'.$this->uri->segment(2).'/'.$data->id.'?'.$_SERVER['QUERY_STRING']) ?>"><i style="color:orange" class="ti-pencil"></i></a>
              &nbsp  &nbsp
              <a href="javascript:void(0);" title="Hapus data" onclick="
              <?php
                //ex = angsuranbulanan/11?tanggal=2017-03-23&nis=0093988518&pembayaran=4
                $query = $data->id;
                echo "actdelete('$query')"
              ?>"><i style="color:red" class="ti-close"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        <tbody>
      </table>
    </div>
    <?php echo $link?>


<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>

<script>
var url="<?php echo site_url();?>";
function actdelete(query){
  console.log(query);
   var r=confirm("Anda yakin akan menghapus data ini ?")
    if (r==true)
      window.location = url+"/transaksi/pendapatanlainlainactdelete/"+query;
    else
      return false;
}
</script>
