
<link href="{base_url(assets/css/back/bootstrap-datetimepicker.css)}" rel="stylesheet">
<div class="row">
  <div class="col-sm-7">
    <?php
	  if(!empty($this->session->flashdata('message')))
	     echo $this->session->flashdata('message');
	   ?>
    <div class="card">
      <div class="content">
        <form class="" onsubmit="alert('Untuk memakai fitur ini, Anda harus menggunakan Full Version')" action="#" method="get">
  	        <div class="form-group">
  	            <label>Tujuan</label>
  	            <input type="text" class="form-control border-input" name="tujuan" placeholder="ex: 0822*********">
  	        </div>
  	        <div class="form-group">
  	            <label>Isi</label>
  	            <textarea class="form-control border-input" name="isi"></textarea>
  	        </div>
            <div id="sisaLebih"></div>
            <button type="submit" class="btn btn-success">Kirim</button>
  			</form>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/jquery.mask.js" type="text/javascript"></script>
