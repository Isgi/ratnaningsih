
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">

<div class="row">
     <!--Default Pannel, Primary Panel And Success Panel   -->
     <div class="col-sm-6">
       <div class="card">
         <div class="header">
             Form Ubah Item Pembayaran
         </div>
           <div class="content">
             <form class="" action="{site_url(itempembayaran/actedit)}" method="post">
                  <input type="hidden" name="id" value="<?php echo $data_edit['id'] ?>">
                   <div class="form-group">
                     <label>Jenis Pembayaran</label>
                     <select class="form-control" name="jenis_pembayaran">
                       <?php foreach ($data_jenis_pembayaran as $data): ?>
                         <?php if ($data_edit['jenis_pembayaran'] == $data->id): ?>
                           <option selected value="<?php echo $data->id ?>"><?php echo $data->nama .'('.$data->kode.')' ?></option>
                         <?php endif; ?>
                         <option value="<?php echo $data->id ?>"><?php echo $data->nama .'('.$data->kode.')' ?></option>
                       <?php endforeach; ?>
                     </select>
                   </div>
                   <div class="form-group">
                     <label>Program</label>
                     <?php foreach ($data_program as $data): ?>
                      <?php if ($data_edit['program'] == $data->id): ?>
                        <div class="radio">
                          <input type="radio" class="form-control" checked name="program" required value="<?php echo $data->id ?>"> <?php echo $data->nama ?>
                        </div>
                      <?php else: ?>
                        <div class="radio">
                          <input type="radio" class="form-control" name="program" required value="<?php echo $data->id ?>"> <?php echo $data->nama ?>
                        </div>
                      <?php endif; ?>
                     <?php endforeach; ?>
                   </div>
                   <div class="form-group">
                       <label>Pembayaran Untuk</label>
                       <?php foreach ($data_sekolah as $data): ?>
                         <?php if ($data_edit['sekolah'] == $data->id): ?>
                           <div class="radio">
                             <label><input checked type="radio" name="sekolah" multiple id="checkItem" value="<?php echo $data->id ?>"><div style="text-transform:uppercase"><?php echo $data->nama.' '.$data->derajat?> </div></label>
                           </div>
                         <?php else: ?>
                           <div class="radio">
                             <label><input type="radio" name="sekolah" multiple id="checkItem" value="<?php echo $data->id ?>"><div style="text-transform:uppercase"><?php echo $data->nama.' '.$data->derajat?> </div></label>
                           </div>
                         <?php endif; ?>
                       <?php endforeach; ?>
                   </div>
                   <div class="form-group">
                       <label>Harga (Rp)</label>
                       <input type="text" name="harga" class="form-control border-input" value="<?php echo $data_edit['harga'] ?>" required placeholder="Nama Pembayaran">
                   </div>
                   <button type="submit" class="btn btn-success">Simpan</button>
             </form>
           </div>
       </div>
     </div>
      <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>
