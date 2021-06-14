<?php require_once 'app/validacionGeneral.php'; ?>
<header class="bg-dark dk header navbar navbar-fixed-top-xs">
  <div class="navbar-header aside-md">
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
      <i class="fa fa-bars"></i>
    </a>
    <a href="index.php" class="navbar-brand" data-toggle="fullscreen"><img src="images/logo.png" class="m-r-sm">HOME</a>
    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
      <i class="fas fa-user-cog"></i>
    </a>
  </div>

  <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="thumb-sm avatar pull-left">
          <img src="images/admin.jpg">
        </span>
        <?php
        echo $_SESSION['USER'];
        ?><b class="caret"></b>
      </a>
      <ul class="dropdown-menu animated fadeInRight">
        <span class="arrow top"></span>
        <li>
          <a href="#">Ajustes</a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="app/logout.php">Cerrar sesión</a>
        </li>
      </ul>
    </li>
  </ul>
</header>