
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">

<div class="row">
     <!--Default Pannel, Primary Panel And Success Panel   -->
     <div class="col-sm-6">
       <div class="card">
         <div class="header">
             <i class="ti-pencil"></i> Form Ubah Item Pembayaran
         </div>
           <div class="content">
             <form class="" action="<?php echo site_url('murid/actedit') ?>" method="post">
                 <div class="form-group">
                     <label>No Induk</label>
                     <input type="hidden" name="id" value="<?php echo $data_edit['id'] ?>">
                     <input type="text" name="no_induk" value="<?php echo $data_edit['no_induk'] ?>" class="form-control border-input" placeholder="No Induk" required>
                 </div>
                 <div class="form-group">
                     <label>Nama</label>
                     <input type="text" name="nama" value="<?php echo $data_edit['nama'] ?>" class="form-control border-input" required placeholder="Nama">
                 </div>
                 <div class="form-group">
                     <label>Nama Panggilan</label>
                     <input type="text" name="nama_panggilan" value="<?php echo $data_edit['nama_panggilan'] ?>" class="form-control border-input" required placeholder="Nama">
                 </div>
                 <div class="row">
                   <div class="col-sm-6">
                     <div class="form-group">
                       <label for="form-group">Program</label>
                       <?php foreach ($data_program as $data): ?>
                         <div class="radio">
                         <?php if ($data->id == $data_edit['program']): ?>
                           <input type="radio" class="form-control" checked  name="program" required value="<?php echo $data->id ?>"> <?php echo $data->nama ?>
                         <?php else: ?>
                           <input type="radio" class="form-control" name="program" required value="<?php echo $data->id ?>"> <?php echo $data->nama ?>
                         <?php endif; ?>
                        </div>
                       <?php endforeach; ?>
                     </div>
                   </div>
                   <div class="col-sm-6">
                     <div class="form-group">
                       <label for="form-group">Kelas</label>
                       <?php foreach ($data_kelas as $data): ?>
                         <div class="radio">
                         <?php if ($data->id == $data_edit['kelas']): ?>
                           <input type="radio" class="form-control" checked  name="kelas" required value="<?php echo $data->id ?>"> <?php echo $data->nama_kelas ?>
                         <?php else: ?>
                           <input type="radio" class="form-control" name="kelas" required value="<?php echo $data->id ?>"> <?php echo $data->nama_kelas ?>
                         <?php endif; ?>
                        </div>
                       <?php endforeach; ?>
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                     <label>Tempat tanggal lahir</label>
                     <input type="text" name="ttl" value="<?php echo $data_edit['ttl'] ?>" class="form-control border-input" required placeholder="Tempat tanggal lahir">
                 </div>
                 <div class="form-group">
                     <label>Nama Ortu</label>
                     <input type="text" name="ortu" value="<?php echo $data_edit['ortu'] ?>" class="form-control border-input" required placeholder="Nama Ortu">
                 </div>
                 <div class="form-group">
                     <label>Alamat</label>
                     <input type="text" name="alamat" value="<?php echo $data_edit['alamat'] ?>" class="form-control border-input" required placeholder="Nama Ortu">
                 </div>
                 <button type="submit" class="btn btn-success">Simpan</button
             </form>
           </div>
       </div>
     </div>
      <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>
