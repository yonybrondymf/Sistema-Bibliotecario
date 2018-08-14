<!DOCTYPE html>
<html lang="ES">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISGEB - <?php echo $title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">

	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/alertify/themes/alertify.core.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/alertify/themes/alertify.default.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dashboard.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<header class="main-header">
		<!-- Logo -->
		<a href="<?php echo base_url(); ?>backend/dashboard" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>SGB</b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>SISGEB</b></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<li class="info-user">
		              Bienvenido, <?php echo $this->session->userdata("user"); ?>
		            </li>
		            <li>
						<a href="<?php echo base_url(); ?>backend/auth/logout" title="Cerrar Sesion" id="logout">
							<img src="<?php echo base_url(); ?>assets/images/logout.png"alt="Cerrar Session" >
						</a>
					</li>
										<!-- Control Sidebar Toggle Button -->

				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!--- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header">MENU DE NAVEGACION</li>
				<li class="<?php echo $this->uri->segment(2) === "dashboard" ? 'active' : '' ?> treeview">
					<a href="<?php echo base_url(); ?>backend/dashboard">
						<i class="fa fa-dashboard"></i>
						<span>DASHBOARD</span>
					</a>
				</li>
				<li class="<?php echo $this->uri->segment(2) === "facultades" ? 'active' : '' ?> treeview">
					<a href="<?php echo base_url(); ?>backend/facultades">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>FACULTADES</span>
					</a>

				</li>
				<li class="<?php echo $this->uri->segment(2) === "lectores" ? 'active' : '' ?> treeview">
					<a href="<?php echo base_url(); ?>backend/lectores">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span>LECTORES</span>
					</a>

				</li>
				<li class="<?php echo $this->uri->segment(2) === "libros" ? 'active' : '' ?> treeview">
					<a href="<?php echo base_url(); ?>backend/libros">
						<i class="fa fa-book" aria-hidden="true"></i>
						<span>LIBROS</span>
					</a>
				</li>
				<li class="<?php echo $this->uri->segment(2) === "prestamos" ? 'active' : '' ?> treeview">
		          	<a href="#">
		            	<i class="fa fa-share-alt" aria-hidden="true"></i>
		            	<span>PRESTAMOS</span>
		            	<span class="pull-right-container">
		              		<i class="fa fa-angle-left pull-right"></i>
		            	</span>
		          	</a>
		          	<ul class="treeview-menu">
		            	<li class="<?php echo $this->uri->segment(3) === "add" ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>backend/prestamos/add"><i class="fa fa-circle-o"></i> Registrar</a></li>
		            	<li class="<?php echo $this->uri->segment(3) === "pending" ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>backend/prestamos/pending"><i class="fa fa-circle-o"></i> Pendientes</a></li>
		            	<li class="<?php echo $this->uri->segment(3) === "all" ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>backend/prestamos/all"><i class="fa fa-circle-o"></i> Todos</a></li>
		          	</ul>
		        </li>
				<li class="<?php echo $this->uri->segment(2) === "usuarios" ? 'active' : '' ?> treeview">
					<a href="<?php echo base_url(); ?>backend/usuarios">
						<i class="fa fa-slideshare" aria-hidden="true"></i>
						<span>USUARIOS</span>
					</a>
				</li>




				<!-- <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->

			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php if ($this->uri->segment(2) != "dashboard"): ?>
					<?php echo strtoupper($this->uri->segment(2)); ?>
				<?php else: ?>
					BIENVENIDO
				<?php endif?>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<!--<li class="active">Dashboard</li> -->
				<?php if ($this->uri->segment(2) && $this->uri->segment(3)): ?>
					<li><a href="<?php echo base_url() . 'backend/' . $this->uri->segment(2); ?>"><?php echo ucwords($this->uri->segment(2)); ?></a></li>
					<li class="active">
						<?php echo $this->uri->segment(3) === "add" || $this->uri->segment(3) === "store" ? 'Nuevo' : 'Editar' ?>
					</li>
				<?php else: ?>
					<?php if ($this->uri->segment(2) != "dashboard"): ?>
						<li class="active"><?php echo ucwords($this->uri->segment(2)); ?></li>
					<?php endif?>

				<?php endif;?>
			</ol>
		</section>

		<!-- Main content -->

		<?php echo $contenido; ?>

		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 2.3.12
		</div>
		<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
		reserved.
	</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/alertify/lib/alertify.min.js"></script>
<script>
    var base_url = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url();?>assets/dist/js/dashboard.js"></script>
</body>
</html>