
<link href="{base_url(assets/css/back/bootstrap-datetimepicker.css)}" rel="stylesheet">
<?php
  $item = array();
  if (!empty($data_kekurangan_bulana)) {
    foreach ($data_kekurangan_bulanan as $data1){
      $kekurangan1 = $data1->harga - $data1->nominal;
      array_push($item, array('id'=>$data1->item_transaksi_pendapatan_murid,'kekurangan'=>$kekurangan1));
    }
  }

  if (!empty($data_kekurangan_tahunan)) {
    foreach ($data_kekurangan_tahunan as $data2){
      $kekurangan2 = $data2->harga - $data2->nominal;
      array_push($item, array('id'=>$data2->item_transaksi_pendapatan_murid,'kekurangan'=>$kekurangan2));
    }
  }

  if (!empty($data_kekurangan_tdk)) {
    foreach ($data_kekurangan_tdk as $data3){
      $kekurangan3 = $data3->harga - $data3->nominal;
      array_push($item, array('id'=>$data3->item_transaksi_pendapatan_murid,'kekurangan'=>$kekurangan3));
    }
  }

?>
<div class="row">
  <div class="col-sm-7">
    <div class="card">
      <div class="header">
          Form Transaksi
      </div>
      <div class="content">
        <form class="" action="<?php echo site_url('transaksi/pendapatanmuridactadd') ?>" method="get">
            <input type="hidden" name="id_murid" value="<?php echo $data_murid['id'] ?>">
  	        <div class="form-group">
  	            <label>Nama</label>
  	            <input type="text" value="<?php echo $data_murid['nama'] ?>" disabled class="form-control" placeholder="No. Indk / Nama">
  	        </div>
  	        <div class="form-group">
  	            <label>Penyetor</label>
  	            <input type="text" name="penyetor" required class="form-control border-input"  placeholder="Penyetor">
  	        </div>
            <div class="form-group">
  	            <label>Pembayaran</label>
                <select class="form-control border-input"  onchange="harga()" required name="pembayaran" id="itemTransaksiSelected">
                  <option value="">-- Pilih item pembayaran -- </option>
                  <?php foreach ($data_murid_item_pembayaran as $data):?>
                      <option value="<?php echo $data->id ?>" harga="<?php echo $data->harga ?>"><?php echo $data->nama ?> -> <small><?php echo $data->derajat.' '.$data->nama_program ?></small>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Pembayaran untuk ?</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                  <input class="form-control border-input" required placeholder="Pilih tanggal" size="16" type="text" value="" readonly>
                  <input type="hidden" name="tgl_setoran" id="dtp_input2" /><br/>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
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
    <div class="card">
      <div class="header">
          Keterangan Pembayaran
      </div>
      <div class="content">
        <div class="panel panel-default">
          <div class="panel-heading">Bulanan</div>
          <div class="panel-body">
            <p class="text-danger">Kekurangan</p>
            <ul>
              <?php foreach ($data_kekurangan_bulanan as $data): ?>
                <li>
                  <?php
                  $kekurangan = $data->harga - $data->nominal;
                  echo $data->nama.' = Rp.'.$kekurangan.' <i>untuk '.date('M Y', strtotime($data->tgl_setoran)).'</i>';
                  ?>
                </li>
              <?php endforeach; ?>
            </ul>

            <p class="text-success">Lunas</p>
            <ul>
              <?php foreach ($data_lunas_bulanan as $data): ?>
                <li>
                  <?php echo $data->nama.' <i>untuk '.date('M Y', strtotime($data->tgl_setoran)).'</i>' ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Tahunan</div>
          <div class="panel-body">
            <p class="text-danger">Kekurangan</p>
            <ul>
              <?php foreach ($data_kekurangan_tahunan as $data): ?>
                <li>
                  <?php
                    $kekurangan = $data->harga - $data->nominal;
                    echo $data->nama.' = Rp.'.$kekurangan.' <i>untuk '.date('Y', strtotime($data->tgl_setoran)).'</i>';

                  ?>
                </li>
              <?php endforeach; ?>
            </ul>

            <p class="text-success">Lunas</p>
            <ul>
              <?php foreach ($data_lunas_tahunan as $data): ?>
                <li>
                  <?php echo $data->nama.' <i>untuk '.date('M Y', strtotime($data->tgl_setoran)).'</i>' ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Lain - lain</div>
          <div class="panel-body">
            <p class="text-danger">Kekurangan</p>
            <ul>
              <?php foreach ($data_kekurangan_tdk as $data): ?>
                <li>
                  <?php
                    $kekurangan = $data->harga - $data->nominal;
                    echo $data->nama.' = Rp.'.$kekurangan;
                  ?>
                </li>
              <?php endforeach; ?>
            </ul>

            <p class="text-success">Lunas</p>
            <ul>
              <?php foreach ($data_lunas_tdk as $data): ?>
                <li>
                  <?php echo $data->nama ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
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
