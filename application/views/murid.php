
<link href="<?php echo base_url() ?>assets/css/back/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet">
<div class="row">
  <?php
  if(!empty($this->session->flashdata('message')))
     echo $this->session->flashdata('message');
   ?>
    <!--Default Pannel, Primary Panel And Success Panel   -->
    <div class="row">
        <form action="<?php echo site_url('murid/filter')?>" method="get">
          <div class="col-xs-4">
            <div class="input-group">
              <select class="form-control border-input" name="kelas">
                <option value="">Semua Kelas ...</option>
                <?php foreach ($data_kelas as $data) {
                  if ($this->input->get('kelas') == $data->id) {?>
                    <option selected value="<?php echo $data->id ?>"><?php echo "$data->nama_kelas ($data->derajat)" ?></option>
                  <?php } else {?>
                    <option value="<?php echo $data->id ?>"><?php echo "$data->nama_kelas ($data->derajat)" ?></option>
                <?php }
                } ?>
              </select>
              <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit" type="button">Ok</button>
              </span>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="input-group">
              <input type="text" placeholder="Nama Murid" class="form-control border-input" name="nama_or_nis" value="<?php echo ($this->input->get('nama_or_nis') != "" ? $this->input->get('nama_or_nis') : "")?>">
              <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit" type="button">Cari</button>
              </span>
            </div>
          </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="no-sort">No. Induk</th>
                    <th class="no-sort">Nama</th>
                    <th class="no-sort">Derajat</th>
                    <th class="no-sort">Program</th>
                    <th class="no-sort">Kelas</th>
                    <th class="no-sort">Tahun Ajar</th>
                    <th class="no-sort">#</th>
                </tr>
            </thead>
            <tbody>
                {data_content}
                <tr class="odd gradeX">
                    <td>{no_induk}</td>
                    <td>{murid}</td>
                    <td>{sekolah}</td>
                    <td>{program}</td>
                    <td>{kelas}</td>
                    <td>{tahun_ajaran}</td>
                    <td class="center">
                      <a title="Ubah data {murid}" href="<?php echo site_url('murid/edit/{id_murid}') ?>"><i style="color:orange" class="ti-pencil"></i></a>
                      &nbsp  &nbsp
                      <a href="javascript:void(0);" title="Hapus data {murid}" onclick="actdelete({id_murid})"><i style="color:red" class="ti-close"></i></a>
                    </td>
                </tr>
                {/data_content}
            </tbody>
        </table>
    </div>
    <?php echo $link ?>
        <!--End Default Pannel, Primary Panel And Success Panel   -->
</div>

<!-- Modal add murid -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Transaksi</h4>
      </div>
			<?php echo form_open_multipart('murid/actadd');?>
				<div class="modal-body">
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control border-input" required name="kelas">
              <option value="">Pilih Kelas ...</option>
              {data_kelas}
                <option value="{id}">{nama} {nama_kelas} ({derajat})</option>
              {/data_kelas}
            </select>
          </div>
          <div class="form-group">
            <label>Tahun Ajaran</label>
            <select class="form-control border-input" required name="tahun_ajaran">
              <option selected="selected" value="" >Pilih Tahun Ajaran ...</option>
              <?php
                for($i=date('Y')-10; $i<=date('Y')+10; $i+=1){
                  $j = $i+1;
                  echo"<option value='$i/$j'> $i/$j </option>";
                }
              ?>
            </select>
          </div>
	        <div class="form-group">
	            <label>File Excel</label>
	            <input type="file" name="file" class="form-control border-input" placeholder="Penyetor">
	        </div>
	      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
			</form>
    </div>
  </div>
</div>

<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/back/bootstrap-checkbox-radio.js"></script>

<script>
var url="<?php echo site_url();?>";
function actdelete(id){
   var r=confirm("Anda yakin akan menghapus data ini ?")
    if (r==true)
      window.location = url+"/murid/actdelete/"+id;
    else
      return false;
}
</script>
