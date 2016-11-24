
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">

<div class="row">
     <!--Default Pannel, Primary Panel And Success Panel   -->
     <div class="col-sm-6">
       <div class="card">
         <div class="header">
             <i class="ti-plus"></i> Form Tambah Item Pembayaran
         </div>

           <div class="content">


             <form class="" action="{site_url(jenispembayaran/actedit)}" method="post">
               {data_edit}
                 <div class="form-group">
                     <label>Kode</label>
                     <input type="text" name="kode" value="{kode}" class="form-control border-input" placeholder="Kode" required>
                     <input type="hidden" name="id" value="{id}">
                 </div>
                 <div class="form-group">
                     <label>Nama Pembayaran</label>
                     <input type="text" name="nama" value="{nama}" class="form-control border-input" required placeholder="Nama Pembayaran">
                 </div>
                 <div class="form-group">
                   <label for="">Periode Transaksi Bulanan</label>
                   <div class="row">
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control"  "{if {periode}==bln} checked {/if}"  name="periode"  required value="bln"> Bulanana
                       </div>
                     </div>
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control" "{if {periode}==6bln} checked {/if}"  name="periode" value="6bln"> 6 Bulanan
                       </div>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control" "{if {periode}==thn} checked {/if}"  name="periode"  required value="thn"> Tahunan
                       </div>
                     </div>
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control" "{if {periode}==tdk} checked {/if}"  name="periode" value="tdk"> Tidak ditentukan
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <label for="">Dibuat untuk</label>
                   <div class="row">
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control" "{if {jenis}==pemasukan} checked {/if}"  name="jenis" required value="pemasukan"> Pemasukan
                       </div>
                     </div>
                     <div class="col-sm-6">
                       <div class="radio">
                           <input type="radio" class="form-control"  "{if {jenis}==pengeluaran} checked {/if}" name="jenis"  value="pengeluaran"> Pengeluaran
                       </div>
                     </div>
                   </div>
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
