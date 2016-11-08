<!-- Bootstrap core CSS     -->
<link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/back/paper-dashboard.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet"/>
<!--  Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url() ?>assets/css/back/themify-icons.css" rel="stylesheet">
<!-- text editor -->
<link href="<?php echo base_url() ?>assets/vendor/summernote/summernote.css" rel="stylesheet">

<div class="row">

  <form enctype='multipart/form-data' action="<?php echo site_url('{url}') ?>" method="post">
    {data_content}
    <input type="hidden" name="id" value="{id}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{judul}" required class="form-control border-input" placeholder="Title">
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Image Header</label>
                <input type="file" name="userfile" placeholder="Title"><p style="color:green"><small>Old image </small><b>{gambar}</b></p>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div  class="col-md-12">
        <label>Content</label>
        <textarea name="content" required id="summernote">{isi}</textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-default" style="width:100%">Submit</button>
      </div>
    </div>
    {/data_content}
  </form>

</div>
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- text editor -->
<script src="<?php echo base_url() ?>assets/vendor/summernote/summernote.js"></script>
<script>
  $(document).ready(function() {
      $('#summernote').summernote({
        height: 500,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null
      });
  });
</script>
