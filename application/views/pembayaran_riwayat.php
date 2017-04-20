
<?php
  $item = array();
  if (!empty($data_kekurangan_bulana)) {
    foreach ($data_kekurangan_bulanan as $data1){
      $kekurangan1 = $data1->harga - $data1->nominal;
      array_push($item, array('id'=>$data1->item_pembayaran,'kekurangan'=>$kekurangan1));
    }
  }

  if (!empty($data_kekurangan_tahunan)) {
    foreach ($data_kekurangan_tahunan as $data2){
      $kekurangan2 = $data2->harga - $data2->nominal;
      array_push($item, array('id'=>$data2->item_pembayaran,'kekurangan'=>$kekurangan2));
    }
  }

  if (!empty($data_kekurangan_tdk)) {
    foreach ($data_kekurangan_tdk as $data3){
      $kekurangan3 = $data3->harga - $data3->nominal;
      array_push($item, array('id'=>$data3->item_pembayaran,'kekurangan'=>$kekurangan3));
    }
  }

?>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="header">

      </div>
      <div class="content">
        <div class="row">
          <div class="col-sm-4">
            <div class="panel panel-default">
              <div class="panel-heading">Bulanan</div>
              <div class="panel-body">
                <p class="text-danger">Kekurangan</p>
                <ul>
                  <?php foreach ($data_kekurangan_bulanan as $data): ?>
                    <li style="font-size:11px">
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
                    <li style="font-size:11px">
                      <?php echo $data->nama.' <i>untuk '.date('M Y', strtotime($data->tgl_setoran)).'</i>' ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="panel panel-default">
              <div class="panel-heading">Tahunan</div>
              <div class="panel-body">
                <p class="text-danger">Kekurangan</p>
                <ul>
                  <?php foreach ($data_kekurangan_tahunan as $data): ?>
                    <li style="font-size:11px">
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
                    <li style="font-size:11px">
                      <?php echo $data->nama.' <i>untuk '.date('M Y', strtotime($data->tgl_setoran)).'</i>' ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="panel panel-default">
              <div class="panel-heading">Lain - lain</div>
              <div class="panel-body">
                <p class="text-danger">Kekurangan</p>
                <ul>
                  <?php foreach ($data_kekurangan_tdk as $data): ?>
                    <li style="font-size:11px">
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
                    <li style="font-size:11px">
                      <?php echo $data->nama ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
