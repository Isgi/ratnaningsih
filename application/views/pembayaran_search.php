<div class="row">
	<div class="col-sm-6">
		<?php
	  if(!empty($this->session->flashdata('message')))
	     echo $this->session->flashdata('message');
	   ?>
	  <div class="card">
	    <div class="header">
	        <i class="ti-plus"></i> No Induk / Nama
	    </div>
	    <div class="content">
	      <form  action="<?php echo site_url('pembayaran/search') ?>" method="get">
	        <div class="from-group">
	          <input type="text" name="cari" placeholder="No Induk / Nama" class="form-control border-input" value="">
	        </div>
	        <br>
	        <div class="form-group">
	          <button type="submit" class="btn btn-default">Cari</button>
	        </div>
	      </form>
	      <hr>
	      <ul class="list-unstyled team-members">
	        <?php if ($data_murid): ?>
	          <?php foreach ($data_murid as $data): ?>
	          	<li>
	                <div class="row">
	                    <div class="col-xs-2"></div>
	                    <div class="col-xs-7">
	                        <?php echo $data->nama ?>
	                        <br />
	                        <span class="text-success"><small><?php echo $data->no_induk ?></small></span>
	                    </div>

	                    <div class="col-xs-3 text-right">
	                        <a href="<?php echo site_url('pembayaran/bayar/'.$data->id) ?>"><btn title="Bayar" class="btn btn-sm btn-success btn-icon"><i class="ti ti-money"></i></btn></a>
	                    </div>
	                </div>
	            </li>
	          <?php endforeach ?>
	        <?php else: ?>
	          <p>Tidak ditemukan...</p
	        <?php endif; ?>
	    </ul>
	    </div>
	  </div>
	</div>
</div>
