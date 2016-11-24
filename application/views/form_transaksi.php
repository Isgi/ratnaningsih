<div class="row">
  <div class="col-sm-7">
    <div class="card">
      <div class="header">
          <i class="ti-plus"></i> Form Transaksi
      </div>
      <div class="content">
        <form class="" action="{site_url(transaksi/actadd)}" method="get">

            {data_siswa}
            <input type="hidden" name="id_siswa" value="{id}">
  	        <div class="form-group">
  	            <label>Nama</label>
  	            <input type="text" value="{nama}" disabled class="form-control" placeholder="No. Indk / Nama">
  	        </div>
            {/data_siswa}
  	        <div class="form-group">
  	            <label>Penyetor</label>
  	            <input type="text" name="penyetor" class="form-control border-input"  placeholder="Penyetor">
  	        </div>

            <div class="form-group">
  	            <label>Pembayaran</label>
                <select class="form-control border-input"  onchange="harga()" name="transaksi" id="itemTransaksiSelected">
                  <option value="">-- Pilih item transaksi -- </option>
                  {data_siswa_item_transaksi}
                  <option value="{id}" harga="{harga}">{nama}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>
                  {/data_siswa_item_transaksi}
                </select>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
      	            <label>Nominal pembayaran</label>
      	            <input type="text"  placeholder="Nominal pembayaran" onkeyup="bayar(this.value)" class="form-control border-input" id="bayarCurrency" placeholder="Dalam Rp.">
                    <input type="hidden" name="dibayarkan" id="bayarNumber" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
      	            <label>Yang harus dibayarkan</label>
      	            <input type="text" placeholder="Yang harus dibayarkan" disabled class="form-control border-input" id="hargaCurrency" placeholder="Dalam Rp.">
      	        </div>
              </div>
            </div>
            <div id="sisaLebih"></div>
            <button type="submit" class="btn btn-success">Bayar</button>
  			</form>
      </div>
    </div>
  </div>
  <div class="col-sm-5">

  </div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/jquery.mask.js" type="text/javascript"></script>
<script >


function bayar(value){
  $("#bayarCurrency").mask(
    "000,000,000,000,000",
    {reverse:true}
  );
  var valueNumber = value.replace(/[^0-9]/g, '');

  //jika bayar yg diinputkan lebih dari harga
  if(parseInt(valueNumber) >= parseInt( $("#hargaCurrency").val() )){
    $("#bayarNumber").val($("#hargaCurrency").val());
  }
  else{
    $("#bayarNumber").val(valueNumber);
  }

  var sisaLebih = parseInt($("#hargaCurrency").val()) - parseInt(valueNumber);
  //menentukan sisa atau lebih
  if(sisaLebih > 0){
    $("#sisaLebih").html("<div class='alert alert-danger' role='alert'><b> Kekurangan Rp."+ sisaLebih+"</b></div>");
  }
  else if(isNaN(sisaLebih)){
    $("#sisaLebih").html("");
  }
  else{
    $("#sisaLebih").html("<div class='alert alert-success' role='alert'><b> Kelebihan Rp."+ Math.abs(sisaLebih)+"</b></div>");
  }
}
function harga(){
  $("#hargaCurrency").val($("option:selected").attr('harga'));
}

</script>
