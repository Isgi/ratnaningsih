<div class="row">
  <div class="col-sm-7">
    <div class="card">
      <div class="header">
          <i class="ti-plus"></i> Form Transaksi
      </div>
      <div class="content">
        <form class="" action="<?php echo site_url('pembayaran/actedit/'.$this->uri->segment(3)) ?>" method="get">
            <input type="hidden" name="redirect" value="<?php echo $_SERVER['QUERY_STRING']?>">
            <input type="hidden" name="id_pembayaran" value="<?php echo $data_edit['id'] ?>">
  	        <div class="form-group">
  	            <label>Penyetor</label>
  	            <input type="text" name="penyetor" value="<?php echo $data_edit['penyetor'] ?>" class="form-control border-input"  placeholder="Penyetor">
  	        </div>

            <div class="form-group">
  	            <label>Pembayaran</label>
                <select class="form-control border-input" name="pembayaran">
                  <?php foreach ($data_item_pembayaran as $datas): ?>
                    <?php if ($datas->id == $data_edit['item_pembayaran']): ?>
                      <option value="<?php echo $datas->id ?>" selected><?php echo $datas->nama ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>
                    <?php else: ?>
                      <option value="<?php echo $datas->id ?>"><?php echo $datas->nama ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
      	            <label>Nominal pembayaran</label>
      	            <input type="text"  placeholder="Nominal pembayaran" value="<?php echo $data_edit['nominal'] ?>" onkeyup="bayar(this.value)" class="form-control border-input" id="bayarCurrency" placeholder="Dalam Rp.">
                    <input type="hidden" value="<?php echo $data_edit['nominal'] ?>" name="nominal" id="bayarNumber" >
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
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
  $("#bayarNumber").val(valueNumber);
}

</script>
