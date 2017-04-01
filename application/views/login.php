
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url() ?>assets/css/back/paper-dashboard.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>assets/css/back/style.css" rel="stylesheet" />
    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url() ?>assets/back/css/themify-icons.css" rel="stylesheet">
  </head>
  <body style="background-color: #eee">
    <div class="container">
      <div style="text-align:center">
        <h1>RATNANINGSIH <small>(TK, TB)</small> </h1>
      </div>
      <form class="form-signin" method="post" action="auth/actlogin">
        <h2 class="form-signin-heading">Sign in</h2>
        <?php
        $message = $this->session->flashdata('notif');
        if($message){
            echo '<p class="text-danger">'.$message .'</p>';
        }?>
        <label for="inputEmail" class="sr-only">Username</label>
        <input name="username" type="text" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" class="form-control" placeholder="Password" required="">
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br>
        <div style="text-align:center">
          <a  href="#">Forget your password ?</a>
        </div>

      </form>
    </div>
  </body>
  <script src="<?php echo base_url() ?>assets/js/back/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/vendor/js/bootstrap.min.js" type="text/javascript"></script>
</html>
