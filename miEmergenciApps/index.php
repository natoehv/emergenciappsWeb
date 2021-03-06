<?php 
include_once '../logica/Usuario.php';
include_once '../logica/Sistema.php';
include_once '../logica/Notificacion.php';
session_start();
if(!(isset($_SESSION['usuario']))){
	header ("Location: ../");
	
}
$usuario =   $_SESSION['usuario'];
$prin = Sistema::getInstancia();
$nro = $prin->getCantidadContactos($usuario->getNroTelefono());
$notifications = $prin->findAllNotifications($usuario);
$newNotifications = $prin->findNewNotifications($usuario);
/*
 * Instanciar la clase sistema
 */

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administra tu EmergenciApps</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	
    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">EmergenciApps</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav" id="nav_izq">
            <li class="active" id="li_inicio"><a href="index.php"><i class="fa fa-dashboard"></i> Mis Datos</a></li>
            <li id="li_contacto"><a href="javascript:contacto.cargaContenido('contactos.php');" id="contactos"><i class="fa fa-comments"></i> Contactos</a></li>
            <li id='li_configuracion'><a href="javascript:configuracion.cargaContenido();" ><i class="fa fa-cog fa-spin"></i> Configuración</a></li>
            <li><a href="#"><i class="fa fa-question-circle"></i> Ayuda</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge"><?php echo count($newNotifications);?></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header"><?php echo count($newNotifications);?> nuevos mensajes</li>
                <?php foreach($notifications as $noti){  ?>
                <li class="message-preview">
                  <a href="#">
                    <!--span class="avatar"><img src="http://placehold.it/50x50"></span-->
                    <span class="name"><?php ?></span>
                    <span class="message"><?php echo $noti->getDescripcion();?></span>
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $noti->getFecha(); ?></span>
                  </a>
                </li>
                <li class="divider"></li>
                <?php } ?>
                <li><a href="#">View Inbox <span class="badge"><?php echo count($newNotifications);?></span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usuario->getNombre();?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Tu Cuenta <small>Datos acerca de tu cuenta</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Mi Cuenta</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Bienvenido a tu panel principal de EmergenciApps, si quieres cambiar tu configuración de EmergenciApps puedes 
              acceder al panel de <a class="alert-link" href="javascript:configuracion.cargaContenido()">configuraciones</a> y modificar lo que
              estimes necesarios.
            </div>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?php echo $nro;?></p>
                    <p class="announcement-text">N° de Contactos</p>
                  </div>
                </div>
              </div>
              <a href="javascript:contacto.cargaContenido('contactos.php')">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Ver contactos...
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-check fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">0</p>
                    <p class="announcement-text">N° de Favoritos</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Ver Favoritos...
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-tasks fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">0</p>
                    <p class="announcement-text">Amigos en Peligro!</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Asistir a Amigos...
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">0</p>
                    <p class="announcement-text">Bandeja de Entrada</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Ver Mensajes...
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.blockUI.js"></script>
    

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!--script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script-->
    <!--script src="js/morris/chart-data-morris.js"></script-->
    <script src="js/dataTable/jquery.dataTables.min.js"></script>
    <script src="js/dataTable/dataTables.bootstrap.min.js"></script>
    <script src="js/contacto.js"></script>
    <script src="js/configuracion.js"></script>
    
    
    

  </body>
</html>
