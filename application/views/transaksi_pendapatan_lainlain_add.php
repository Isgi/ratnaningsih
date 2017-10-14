
<link href="{base_url(assets/css/back/bootstrap-datetimepicker.css)}" rel="stylesheet">
<div class="row">
  <div class="col-sm-7">
    <?php
	  if(!empty($this->session->flashdata('message')))
	     echo $this->session->flashdata('message');
	   ?>
    <div class="card">
      <div class="header">
          Form tambah pendapatan lain-lain
      </div>
      <div class="content">
        <form class="" action="<?php echo site_url('transaksi/pendapatanlainlainactadd') ?>" method="get">
  	        <div class="form-group">
  	            <label>Nama Pendapatan</label>
  	            <input type="text" class="form-control border-input" name="nama_pendapatan" placeholder="ex: BOS (Bantuan Operasional Sekolah)">
  	        </div>
  	        <div class="form-group">
  	            <label>Penyetor</label>
  	            <input type="text" name="penyetor" required class="form-control border-input"  placeholder="ex: Ibu Heni (Kepala)">
  	        </div>
            <div class="form-group">
  	            <label>Keterangan</label>
  	            <textarea name="keterangan" class="form-control border-input">
                </textarea>
  	        </div>
            <div class="row">
              <div class="form-group col-sm-6">
                  <label>Tanggal pendapatan</label>
                  <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control border-input" required placeholder="Pilih tanggal" size="16" type="text" value="" readonly>
                    <input type="hidden" name="tgl_setoran" id="dtp_input2" /><br/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
      	            <label>Nominal pembayaran</label>
      	            <input type="text" required placeholder="Nominal pembayaran" onkeyup="bayar(this.value)" class="form-control border-input" id="bayarCurrency" placeholder="Dalam Rp.">
                    <input type="hidden" name="nominal" id="bayarNumber" >
                </div>
              </div>
            </div>
            <div id="sisaLebih"></div>
            <button type="submit" class="btn btn-success">Simpan</button>
  			</form>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/jquery.mask.js" type="text/javascript"></script>
<script src="{base_url(assets/js/back/bootstrap-datetimepicker.js)}" type="text/javascript"></script>
<script src="{base_url(assets/js/back/bootstrap-datetimepicker.id.js)}" type="text/javascript"></script>
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
$('.form_date').datetimepicker({
      language:  'id',
      weekStart: 1,
      todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
  });
</script>
