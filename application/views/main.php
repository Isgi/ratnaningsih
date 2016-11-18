<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url() ?>assets/css/back/animate.min.css" rel="stylesheet"/>
    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url() ?>assets/css/back/paper-dashboard.css" rel="stylesheet"/>
    <!--  Fonts and icons     -->
    <link href="<?php echo base_url() ?>assets/css/back/themify-icons.css" rel="stylesheet">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
    	 <div class="sidebar-wrapper">
          <div class="logo">
              <a href="http://www.creative-tim.com" class="simple-text">
                  YAC <small>Admin</small>
              </a>
          </div>

          <ul class="nav">
            {side_bar}
              <li>
                  <a href=<?php echo site_url() ?>/{url}>
                      <i class={icon}></i>
                      <p>{nama}</p>
                  </a>
              </li>
            {/side_bar}
          </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">{title}</a>{button}
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#"><i class="ti-settings"></i><p>&nbsp&nbspSettings</p></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('bauth/actLogout') ?>"><i class="ti-power-off"></i><p>&nbsp&nbspLog Out</p></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                {content}
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url() ?>assets/js/back/paper-dashboard.js"></script>
</body>


</html>
