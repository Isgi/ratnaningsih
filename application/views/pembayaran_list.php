
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
  <div class="row">
    <!--Default Pannel, Primary Panel And Success Panel   -->
    <form class="form-inline" action="<?php echo site_url('pembayaran/'.$this->uri->segment(2)) ?>" method="get">
        <div class="col-xs-4">
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
        </div>
        <div class="col-xs-4">
          <div class="input-group">
            <input type="text" placeholder="NIS" class="form-control border-input" name="nis" value="<?php echo ($this->input->get('nis') != "" ? $this->input->get('nis') : "")?>">
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
            <th class="no-sort">No. Induk</th>
            <th class="no-sort">Nama</th>
            <th class="no-sort">Derajat</th>
            <th class="no-sort">Kelas</th>
            <th class="no-sort">Pembayaran</th>
            <th class="no-sort">nominal</th>
            <th class="no-sort">Tgl Setoran</th>
            <th>Status</th>
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
            <td><?php echo $data->jumlah_nominal?></td>
            <td><?php echo date('d-M-Y', strtotime($data->tgl_setoran))?></td>
            <td><?php
              $hasil = $data->jumlah_nominal - $data->harga;
              if( $hasil >= 0){echo "<small>Lunas > $hasil</small>";} else{echo "<small>Belum Lunas  $hasil</small>";} ?></td>
            <td>
              <a title="Lihat Rincian" href="<?php
              $dt = new DateTime($data->tgl_setoran);
              $date = $dt->format('Y-m-d');
              echo site_url('pembayaran/angsuran'.$this->uri->segment(2).'?tanggal='.$date.'&nis='.$data->no_induk.'&pembayaran='.$data->item_pembayaran) ?>">Angsuran</a>
            </td>
          </tr>
          <?php endforeach; ?>
        <tbody>
      </table>
    </div>
    <?php echo $link?>
    <!--End Default Pannel, Primary Panel And Success Panel   -->
  </div>
</div>



<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>

<script>
var url="<?php echo site_url();?>";
function actdelete(id){
   var r=confirm("Anda yakin akan menghapus data ini ?")
    if (r==true)
      window.location = url+"/pembayaran/actdelete/"+id;
    else
      return false;
}
</script>
