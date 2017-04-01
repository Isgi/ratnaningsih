
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">

<div class="row">
     <!--Default Pannel, Primary Panel And Success Panel   -->
     <div class="col-sm-6">
       <div class="card">
         <div class="header">
             <i class="ti-pencil"></i> Form Ubah Kelas
         </div>
           <div class="content">
             <form class="" action="{site_url(jenispembayaran/actedit)}" method="post">
               {data_edit}
               <div class="form-group">
                   <label>Nama Kelas</label>
                   <input type="text" name="nama" value="{nama}" class="form-control border-input" placeholder="Nama Kelas" required>
               </div>
               <div class="form-group">
                   <label>Kapasitas</label>
                   <input type="number" name="kapasitas" value="{kapasitas}" min="0" class="form-control border-input" placeholder="Jumlah Kapasitas Murid" required>
               </div>
               <div class="form-group">
                   <label>Kelas Untuk</label>
                   {data_sekolah}
                   <div class="checkbox" required>
                     <label><input type="checkbox" name="sekolah[]" multiple id="checkItem" value="{id}"><div style="text-transform:uppercase">{nama} {derajat}</div></label>
                   </div>
                   {/data_sekolah}
               </div>
               <button type="submit" class="btn btn-success">Simpan</button>
               {/data_edit}
             </form>
           </div>
       </div>
     </div>
      <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>
